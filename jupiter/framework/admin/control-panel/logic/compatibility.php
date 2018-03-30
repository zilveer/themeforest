<?php
/**
 * This class is responsible for checking all stats and jupiter needs such as
 * directory permission and notify user about warnings and errors
 *
 *
 * @author       Reza Marandi <reza@marandi.ir>
 * @copyright    Artbees LTD (c)
 * @link         http://artbees.net
 * @since        5.4
 * @version      1.0
 * @package      jupiter
 */
class Compatibility
{
    private $template_dir;
    private $schedule;

    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }
    public function getSchedule()
    {
        return $this->schedule;
    }

    public function setTemplateDir($template_dir)
    {
        $this->template_dir = $template_dir;
    }
    public function getTemplateDir()
    {
        return $this->template_dir;
    }
    private $assets_dir;
    public function setAssetsDir($assets_dir)
    {
        $this->assets_dir = $assets_dir;
    }
    public function getAssetsDir()
    {
        return $this->assets_dir;
    }
    public function __construct()
    {
    }
    public function setMkTemplatesDirectory()
    {
        $upload_path = wp_upload_dir();
        $this->setTemplateDir($upload_path['basedir'] . "/mk_templates/");
    }
    public function compatibilityCheck()
    {
        // Set upload path
        $upload_path = wp_upload_dir();
        $this->setTemplateDir($upload_path['basedir'] . "/mk_templates/");
        $this->setAssetsDir($upload_path['basedir'] . "/mk_assets/");

        // Check folder permission and create them if not exist
        //
        $response = [];
        // If response is a multidimentional array ,
        // we should merge it to general response ,
        // general response is always 2 level array not more.
        $php_ini_response = $this->phpIniCheck();
        $response         = array_merge($php_ini_response, $response);
        $response[]       = $this->checkAndCreate($this->getTemplateDir());
        $response[]       = $this->checkAndCreate($this->getAssetsDir());

        // if schedule is setted or not
        if ($this->getSchedule() == 'off')
        {
            return $this->prepareMessage($response);
        }
        else
        {
            if (($value = get_transient('compatibility_check')) === false)
            {
                set_transient('compatibility_check', true, $this->getSchedule());
                return $this->prepareMessage($response);
            }
            else
            {
                return;
            }
        }

    }
    /**
     * This method will verify if directory is wirtable or not.
     *
     * @param string $path Set directory path that need to be check
     *
     * @author Reza Marandi <reza@marandi.ir>
     *
     * @return bool
     */
    public function isWritable($path)
    {
        return is_writable($path);
    }
    /**
     * This method will create directory if dir path is not exist and return errors.
     *
     * @param string $path Set directory path that need to be check
     *
     * @author Reza Marandi <reza@marandi.ir>
     *
     * @return array array of messages
     */
    public function checkAndCreate($path)
    {
        if (file_exists($path) == true)
        {
            if ($this->isWritable($path) == false)
            {
                return [
                    'sys_msg'       => $path . ' ' . __('directory is not writable,', 'mk_framework') . ' ',
                    'sys_recommend' => __('Set read/write (0775) permission for this directory .', 'mk_framework'),
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            else
            {
                return [
                    'status' => true,
                ];
            }
        }
        else
        {
            if (@mkdir($path, 0775, true) == false)
            {
                return [
                    'sys_msg'       => 'Jupiter can\'t create ' . $path . ' directory. ',
                    'sys_recommend' => __('Please check permission on this directory.', 'mk_framework'),
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            else
            {
                return [
                    'status' => true,
                ];
            }

        }
    }
    /**
     * This method will verify all php.ini variables and requirement that wordpress need.
     *
     *
     * @author Bob Ulusoy , Reza Marandi <reza@marandi.ir>
     *
     * @return array array of messages
     */
    public function phpIniCheck()
    {
        $max_execution_time            = ini_get("max_execution_time");
        $max_input_time                = ini_get("max_input_time");
        $upload_max_filesize           = ini_get("upload_max_filesize");
        $max_input_vars                = ini_get("max_input_vars");
        $suhosin_post_maxvars          = ini_get( 'suhosin.post.max_vars' );
        $suhosin_request_maxvars       = ini_get( 'suhosin.request.max_vars' );

        $incorrect_max_execution_time  = ($max_execution_time < 60 && $max_execution_time > 0);
        $incorrect_max_input_time      = ($max_input_time < 60 && $max_input_time > 0);
        $incorrect_memory_limit        = ($this->let_to_num(WP_MEMORY_LIMIT) < 100663296);
        $incorrect_upload_max_filesize = ($this->let_to_num($upload_max_filesize) < 10485760);

        $incorrect_max_input_vars      = ($max_input_vars < 4000);
        $incorrect_suhosin_maxvars = (( $suhosin_post_maxvars != '' && $suhosin_request_maxvars < 4000 ) ||
                                            ( $suhosin_post_maxvars != '' && $suhosin_request_maxvars < 4000 ));
        $current_post_vars_count = mk_detect_count_post_vars();


        $response                      = [];
        if ($incorrect_max_execution_time || $incorrect_max_input_time || $incorrect_memory_limit || $incorrect_upload_max_filesize)
        {
            $response = [];
            if ($incorrect_max_execution_time)
            {
                $response[] = [
                    'sys_msg'       => __('Maximum Execution Time', 'mk_framework') . ': ' . $max_execution_time . ' ' . __('seconds,', 'mk_framework') . ' ',
                    'sys_recommend' => __('max_execution_time should be at least 60 seconds.', 'mk_framework'),
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            if ($incorrect_max_input_time)
            {
                $response[] = [
                    'sys_msg'       => __('Maximum Input Time', 'mk_framework') . ': ' . $max_input_time . ' ' . __(' seconds, ', 'mk_framework') . ' ',
                    'sys_recommend' => __('max_input_time should be at least 60 seconds.', 'mk_framework'),
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            if ($incorrect_memory_limit)
            {
                $response[] = [
                    'sys_msg'       => __('Wordpress Memory Limit', 'mk_framework') . ': ' . WP_MEMORY_LIMIT . ', ',
                    'sys_recommend' => __('memory_limit should be at least 96MB.', 'mk_framework'),
                    'link_href'     => 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP',
                    'link_title'    => __('Increasing memory allocated to PHP', 'mk_framework'),
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            if ($incorrect_upload_max_filesize)
            {
                $response[] = [
                    'sys_msg'       => __('Maximum Upload File Size', 'mk_framework') . ': ' . $upload_max_filesize . ', ',
                    'sys_recommend' => __('upload_max_filesize should be at least 10MB.', 'mk_framework'),
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            if ($incorrect_max_input_vars)
            {
                $response[] = [
                    'sys_msg'       => __('Maximum Input Vars', 'mk_framework') . ': ' . $max_input_vars . ', ',
                    'sys_recommend' => __('max_input_vars should be at least 4000.', 'mk_framework'),
                    'link_href'     => 'https://artbees.net/themes/docs/max-input-vars/',
                    'link_title'    => __('Increasing Maximum Input Vars', 'mk_framework'),
                    'type'          => 'error',
                    'status'        => false,
                ];
                $estimate = ( $max_input_vars - $current_post_vars_count ) / 14;
                $estimate = ( $estimate < 0 ) ?  0 : $estimate;
                $response[] = [
                    'sys_msg'       => __('Menu Item Post variable count on last save', 'mk_framework') . ': ' . $current_post_vars_count . ', ',
                    'sys_recommend' => __('Approximate remaining menu items' , 'mk_framework') . ': ' . floor( $estimate ),
                    'link_href'     => '',
                    'link_title'    => '',
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            if ($incorrect_suhosin_maxvars)
            {
                $response[] = [
                    'sys_msg'       => __('Your are running Suhosin, and your current settings are', 'mk_framework') . ' suhosin.post.max_vars: ' . $suhosin_post_maxvars . ' suhosin.post.request_maxvars: ' . $suhosin_request_maxvars . ' , ',
                    'sys_recommend' => __('uhosin.post.max_vars and suhosin.post.request_maxvars should be at least 4000.', 'mk_framework'),
                    'link_href'     => 'https://artbees.net/themes/docs/max-input-vars/',
                    'link_title'    => __('Increasing Maximum Input Vars', 'mk_framework'),
                    'type'          => 'error',
                    'status'        => false,
                ];
            }
            return $response;
        }
        else
        {
            return [];
        }

    }
    /**
     * This method will prepare class reponses to wordpress admin notification structure.
     *
     * @param array $messages set of messages data
     *
     * @author Reza Marandi <reza@marandi.ir>
     *
     * @return string
     */
    public function prepareMessage($messages)
    {
        if (empty($messages) == false && is_array($messages))
        {
            $warning_message = $error_message = $response = '';
            foreach ($messages as $key => $value)
            {
               if(isset($value['type'])) {
                    switch ($value['type'])
                    {
                        case 'error':
                            $error_message .= '<li style="margin-bottom:10px;"><strong>' . $value['sys_msg'] . '</strong>' . $value['sys_recommend'] . '&nbsp;&nbsp;&nbsp;<a href="' . $value['link_href'] . '">' . $value['link_title'] . '</a></li>';
                            break;
                        case 'warning':
                            $warning_message .= '<li style="margin-bottom:10px;"><strong>' . $value['sys_msg'] . '</strong>' . $value['sys_recommend'] . '&nbsp;&nbsp;&nbsp;<a href="' . $value['link_href'] . '">' . $value['link_title'] . '</a></li>';
                            break;
                    }
                }
            }
            if (empty($error_message) == false)
            {
                $response .= '<div class="notice notice-error is-dismissible" style="font-size:14px !important;"><br><strong>'.__('Please resolve these issues for maximum compatibility!', 'mk_framework').'</strong>
    <ol>' . $error_message . '</ol><button type="button" class="notice-dismiss"><span class="screen-reader-text">'.__('Dismiss this notice.', 'mk_framework').'</span></button></div>';
            }
            if (empty($warning_message) == false)
            {
                $response .= '<div class="notice notice-warning is-dismissible" style="font-size:14px !important;"><br><strong>'.__('Please read this warnings carefully', 'mk_framework').'</strong>
    <ol>' . $error_message . '</ol><button type="button" class="notice-dismiss"><span class="screen-reader-text">'.__('Dismiss this notice.', 'mk_framework').'</span></button></div>';
            }

            return $response;
        }
        else
        {
            return;
        }
    }
    private function let_to_num($size)
    {
        $l   = substr($size, -1);
        $ret = substr($size, 0, -1);

        switch (strtoupper($l))
        {
            case 'P':
                $ret *= 1024;
            case 'T':
                $ret *= 1024;
            case 'G':
                $ret *= 1024;
            case 'M':
                $ret *= 1024;
            case 'K':
                $ret *= 1024;
        }

        return $ret;
    }
}
