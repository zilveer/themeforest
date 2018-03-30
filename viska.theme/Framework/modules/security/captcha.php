<?php

/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/15/14
 * Time: 3:13 PM
 */
Class AWECaptcha extends AWESecurity
{
    private $errors;
    private $session_ids; // use for math captcha
    private $captcha_error_messages;
    private $session_number = 0;
    public function __construct()
    {
        $this->security_refresh_options();

        //are you human config
        if($this->captcha_options['settings']['type']==3)
        {
            if(!empty($this->captcha_options['human']['public-key']) && !empty($this->captcha_options['human']['private-key']))
            {
                require_once(AWE_ROOT_DIR.'/lib/ayah/ayah.php');
                define( 'AYAH_PUBLISHER_KEY', $this->captcha_options['human']['public-key']);
                define( 'AYAH_SCORING_KEY', $this->captcha_options['human']['private-key']);
                $this->ayah = new AYAH();
            }
        }

        $this->captcha_error_messages = array(
            'fill' => '<strong>'. __('ERROR',       self::LANG).'</strong>: '.__('Please enter captcha value.',     self::LANG),
            'wrong' => '<strong>'. __('ERROR',      self::LANG).'</strong>: '.__('Invalid captcha value.',          self::LANG),
            'time' => '<strong>'. __('ERROR',       self::LANG).'</strong>: '.__('Captcha time expired.',           self::LANG)
        );
        if($this->captcha_options['settings']['type']==1)
            add_action( 'init',                             array(&$this,   'init_captcha_session'));

        add_action( 'login_head',                           array($this,    'login_captcha_style'));

        if($this->captcha_options['settings']['login-form']==1)
        {
            add_action( 'login_form',                       array($this,    'login_show_captcha') );
            add_action( 'authenticate',                     array($this,    'login_check'),                             1000, 3 );
        }

        if($this->captcha_options['settings']['registration-form']==1)
        {
            add_action( 'register_form',                    array($this,    'login_show_captcha'));
            add_action( 'register_post',                    array($this,    'register_check'),                          10,3);
        }

        if($this->captcha_options['settings']['reset-password-form'])
        {
            add_action( 'lostpassword_form',                array($this,    'login_show_captcha'));
            add_action( 'lostpassword_post',                array($this,    'lostpassword_check'),                      10,3);
        }

        if($this->captcha_options['settings']['comments-form'])
        {
            add_action( 'comment_form_after_fields',        array($this,    'login_show_captcha'));
            add_action( 'comment_form_logged_in_after',     array($this,    'login_show_captcha'));
            add_action( 'preprocess_comment',               array($this,    'comments_check'));

        }
        // hook contact form 7
        if($this->captcha_options['settings']['contact-form']==1 && $this->form_7_is_active())
        {
            add_action('admin_init',                        array($this,    'wpcf7_add_tag_generator'),                 16);
            add_action('wpcf7_admin_notices',               array($this,    'wpcf7_display_warning_message'));
            add_filter('wpcf7_messages',                    array($this,    'wpcf7_messages'));
            add_filter('wpcf7_validate_awecaptcha',         array($this,    'wpcf7_validation_filter'),                 10, 2);
            add_action('init',                              array($this,    'wpcf7_add_shortcode'),                     5);
        }


    }




    /*
    *  CAPTCHA
    */

    public function check_role()
    {
        global $current_user;

        //switch type captha
        if($this->captcha_options['settings']['type']==2)
            if ( ! $this->captcha_options['google']['public-key'] || ! $this->captcha_options['google']['private-key'] || '' == $this->captcha_options['google']['public-key'] || '' == $this->captcha_options['google']['private-key'])
                return true;
        if($this->captcha_options['settings']['type']==3)
        if(empty($this->captcha_options['human']['public-key']) || empty($this->captcha_options['human']['private-key']))
            return true;
        if ( ! is_user_logged_in() )
            return false;
        $role = $current_user->roles[0];
        if (isset($this->captcha_options['role'][ $role ]) && '1' == $this->captcha_options['role'][ $role ] )
            return true;
        else
            return false;
    }

    public function display_captcha()
    {
        if ( $this->check_role() )
            return;

        switch($this->captcha_options['settings']['type']){
            case 1:
                ?>
                <p class="awe-math-captcha">
                    <label style="float:left;padding:5px 0; width: 120px;"><?php echo $this->captcha_options['math']['title']." "; ?></label>
                    <span><?php echo $this->generate_match_captcha(); ?></span>

                </p>
                <?php
                break;
            case 2:
                require_once( AWE_ROOT_DIR.'/lib/recaptcha/recaptchalib.php' );
                $public_key = $this->captcha_options['google']['public-key'];
                $private_key = $this->captcha_options['google']['private-key']; ?>
                <style type="text/css" media="screen">
                    #recaptcha_response_field {
                        max-height: 35px;
                    }
                </style>
                <script type='text/javascript'>
                    var RecaptchaOptions = { theme : "<?php echo $this->captcha_options['google']['theme']; ?>" };
                    var gglcptch_path = "<?php echo plugins_url( 'google_captcha_check.php', __FILE__ ); ?>";
                    var gglcptch_error_msg = "<?php _e( 'Error: You have entered an incorrect CAPTCHA value.', self::LANG ); ?>";
                    var gglcptch_private_key = "<?php echo $private_key; ?>";
                </script>
                <?php
                return recaptcha_get_html( $public_key );
                break;
            case 3: // are you human captcha

                echo $this->ayah->getPublisherHTML();
                break;
        }


    }

    /*
     * Style google captcha
     */
    public function login_captcha_style()
    {
        if($this->captcha_options['settings']['type']==1)
        {
            ?>
            <style type="text/css" media="screen">
                .awe-math-captcha{
                    clear: both;
                }
                .awe-math-captcha > label {
                    float: none !important;
                }
                .awe-math-captcha > span {
                    display: block;
                    margin: 12px 0;
                }
            </style>
        <?php
        }
        if($this->captcha_options['settings']['type']==2)
        {
            $from_width = ($this->captcha_options['google']['theme'] == 'clean')? 450:320;

            ?>
            <style type="text/css" media="screen">
                #loginform,
                #lostpasswordform,
                #registerform {
                    width: <?php echo $from_width; ?>px !important;
                }
                .message {
                    width: <?php echo $from_width + 20; ?>px !important;
                }
            </style>
        <?php
        }
    }

    /*
     * Display captcha
     */
    public function login_show_captcha()
    {
        echo $this->display_captcha();
        return true;
    }

    /*
     * check submit login form with captcha
     */

    public function login_check($user, $username, $password)
    {
        if ( $this->check_role())
            return $user;
        if ( isset( $_POST['wp-submit'] ) ) {
            if($this->security_options['captcha']==1 && $this->captcha_options['settings']['login-form']==1){
                switch($this->captcha_options['settings']['type'])
                {
                    case 1:
                        if(isset($_POST['awe-captcha'])&& $_POST['awe-captcha']!='')
                        {
                            if($this->session_ids['default'] !== '' && get_transient('awe_'.$this->session_ids['default']) !== FALSE)
                            {
                                if(strcmp(get_transient('awe_'.$this->session_ids['default']), sha1(AUTH_KEY.$_POST['awe-captcha'].$this->session_ids['default'], FALSE)) !== 0)
                                    $error = 'wrong';
                            }
                            else
                                $error = 'time';

                        }else
                            $error = 'fill';
                        break;
                    case 2:
                        require_once( AWE_ROOT_DIR.'/lib/recaptcha/recaptchalib.php' );
                        $private_key = ($this->captcha_options['google']['private-key'] && $this->captcha_options['google']['private-key']!=0)? $this->captcha_options['google']['private-key']:false;
                        $public_key = ($this->captcha_options['google']['public-key'] && $this->captcha_options['google']['public-key']!=0)? $this->captcha_options['google']['public-key']:false;
                        if($private_key && $public_key){
                            if(isset($_POST['recaptcha_challenge_field'])&&$_POST['recaptcha_response_field'])
                            {
                                $resp = recaptcha_check_answer( $private_key,
                                    $_SERVER['REMOTE_ADDR'],
                                    $_POST['recaptcha_challenge_field'],
                                    $_POST['recaptcha_response_field'] );
                                if ( ! $resp->is_valid ) {
                                    $error = 'wrong';
                                }
                            }else
                            {
                                $error = 'fill';
                            }
                        }
                        break;
                    case 3:
                        $score = $this->ayah->scoreResult();
                        if (!$score)
                        {
                            $error = 'wrong';
                        }

                        break;

                }

            }
            if(!empty($error))
            {
                //destroy cookie
                wp_clear_auth_cookie();
                $user = new WP_Error();
                $user->add('captcha-error', $this->captcha_error_messages[$error]);
            }
        }

        return $user;
    }

    /*
     * Check submit register form
     */
    public function register_check($login, $email, $errors)
    {
        if ( $this->check_role())
            return;

        switch($this->captcha_options['settings']['type'])
        {
            case 1:
                if(isset($_POST['awe-captcha'])&& $_POST['awe-captcha']!='')
                {
                    if($this->session_ids['default'] !== '' && get_transient('awe_'.$this->session_ids['default']) !== FALSE)
                    {
                        if(strcmp(get_transient('awe_'.$this->session_ids['default']), sha1(AUTH_KEY.$_POST['awe-captcha'].$this->session_ids['default'], FALSE)) !== 0)
                            $error = 'wrong';
                    }
                    else
                        $error = 'time';

                }else
                    $error = 'fill';
                break;
            case 2:
                require_once( AWE_ROOT_DIR.'/lib/recaptcha/recaptchalib.php' );
                $private_key = ($this->captcha_options['google']['private-key'] && $this->captcha_options['google']['private-key']!=0)? $this->captcha_options['google']['private-key']:false;
                $public_key = ($this->captcha_options['google']['public-key'] && $this->captcha_options['google']['public-key']!=0)? $this->captcha_options['google']['public-key']:false;
                if($private_key && $public_key){
                    if(isset($_POST['recaptcha_challenge_field'])&&isset($_POST['recaptcha_response_field'] ))
                    {
                        $resp = recaptcha_check_answer( $private_key,
                            $_SERVER['REMOTE_ADDR'],
                            $_POST['recaptcha_challenge_field'],
                            $_POST['recaptcha_response_field'] );
                        if ( ! $resp->is_valid ) {
                            $error = 'wrong';

                        }
                    }else $error = 'fill';

                }
                break;
            case 3:
                $score = $this->ayah->scoreResult();
                if (!$score)
                {
                    $error = 'wrong';
                }
                break;
        }
        if(!empty($error))
        {
            $errors->add('captcha-error', $this->captcha_error_messages[$error]);
        }
        return;
    }

    public function lostpassword_check()
    {
        if ( $this->check_role())
            return;
        $this->errors = new WP_Error();
        $user_error = FALSE;
        $user_data = NULL;
        switch($this->captcha_options['settings']['type'])
        {
            case 1:
                if(isset($_POST['awe-captcha'])&& $_POST['awe-captcha']!='')
                {
                    if($this->session_ids['default'] !== '' && get_transient('awe_'.$this->session_ids['default']) !== FALSE)
                    {
                        if(strcmp(get_transient('awe_'.$this->session_ids['default']), sha1(AUTH_KEY.$_POST['awe-captcha'].$this->session_ids['default'], FALSE)) !== 0)
                            $error = 'wrong';
                    }
                    else
                        $error = 'time';

                }else
                    $error = 'fill';
                break;
            case 2:
                require_once( AWE_ROOT_DIR.'/lib/recaptcha/recaptchalib.php' );
                $private_key = ($this->captcha_options['google']['private-key'] && $this->captcha_options['google']['private-key']!=0)? $this->captcha_options['google']['private-key']:false;
                $public_key = ($this->captcha_options['google']['public-key'] && $this->captcha_options['google']['public-key']!=0)? $this->captcha_options['google']['public-key']:false;
                if($private_key && $public_key){
                    if(isset($_POST['recaptcha_challenge_field'])&&isset($_POST['recaptcha_response_field'] ))
                    {
                        $resp = recaptcha_check_answer( $private_key,
                            $_SERVER['REMOTE_ADDR'],
                            $_POST['recaptcha_challenge_field'],
                            $_POST['recaptcha_response_field'] );
                        if ( ! $resp->is_valid ) {
                            $error = 'wrong';
                        }
                    }else $error = 'fill';

                }
                break;
            case 3:
                $score = $this->ayah->scoreResult();
                if (!$score)
                {
                    $error = 'wrong';
                }
                break;
        }

        //checks user_login (from wp-login.php)
        if(empty($_POST['user_login']))
            $user_error = TRUE;
        elseif(strpos($_POST['user_login'], '@'))
        {
            $user_data = get_user_by('email', trim($_POST['user_login']));

            if(empty($user_data))
                $user_error = TRUE;
        }
        else
            $user_data = get_user_by('login', trim($_POST['user_login']));

        if(!$user_data)
            $user_error = TRUE;
        if(!empty($error))
            $this->errors->add('captcha-error',$this->captcha_error_messages[$error]);
        //something went wrong?
        if(!empty($this->errors->errors))
        {
            if($user_error === FALSE)
                add_filter('allow_password_reset', array(&$this, 'add_lostpassword_wp_message'));
            else
                add_filter('login_errors', array(&$this, 'add_lostpassword_captcha_message'));
        }

    }

    //Adds lost password errors
    public function add_lostpassword_captcha_message($errors)
    {
        return $errors.$this->errors->errors['captcha-error'][0];
    }

    //Adds lost password errors (special way)

    public function add_lostpassword_wp_message()
    {
        return $this->errors;
    }


    /*
     * Check submit comment form with captcha
     */
    public function comments_check($comment)
    {
        if ( $this->check_role())
            return $comment;
        /* Skip captcha for comment replies from the admin menu */
        if ( isset( $_REQUEST['action'] ) && 'replyto-comment' == $_REQUEST['action'] &&
            ( check_ajax_referer( 'replyto-comment', '_ajax_nonce', false ) || check_ajax_referer( 'replyto-comment', '_ajax_nonce-replyto-comment', false ) ) ) {
            /* Skip capthca */
            return $comment;
        }
        /* Skip captcha for trackback or pingback */
        if ( '' != $comment['comment_type'] && 'comment' != $comment['comment_type'] ) {
            return $comment;
        }
        switch($this->captcha_options['settings']['type'])
        {
            case 1:
                if(isset($_POST['awe-captcha'])&& $_POST['awe-captcha']!='')
                {
                    if($this->session_ids !== '' && get_transient('awe_'.$this->session_ids['default']) !== FALSE)
                    {
                        if(strcmp(get_transient('awe_'.$this->session_ids['default']), sha1(AUTH_KEY.$_POST['awe-captcha'].$this->session_ids['default'], FALSE)) === 0)
                            return $comment;
                        else
                            wp_die($this->captcha_error_messages['wrong']);
                    }
                    else
                        wp_die($this->captcha_error_messages['time']);
                }else
                    wp_die($this->captcha_error_messages['fill']);

            case 2:
                require_once( AWE_ROOT_DIR.'/lib/recaptcha/recaptchalib.php' );
                $private_key = ($this->captcha_options['google']['private-key'] && $this->captcha_options['google']['private-key']!=0)? $this->captcha_options['google']['private-key']:false;
                $public_key = ($this->captcha_options['google']['public-key'] && $this->captcha_options['google']['public-key']!=0)? $this->captcha_options['google']['public-key']:false;
                if($private_key && $public_key){
                    if(isset($_POST['recaptcha_challenge_field'])&&isset($_POST['recaptcha_response_field'] ))
                    {
                        $resp = recaptcha_check_answer( $private_key,
                            $_SERVER['REMOTE_ADDR'],
                            $_POST['recaptcha_challenge_field'],
                            $_POST['recaptcha_response_field'] );
                        if ( ! $resp->is_valid ) {
                            wp_die($this->captcha_error_messages['wrong']);

                        }
                    }else wp_die($this->captcha_error_messages['fill']);

                }
                break;
            case 3:
                if ( $this->ayah->scoreResult() ) {
                    return $comment;
                } else {
                    wp_die($this->captcha_error_messages['wrong']);
                }
                break;
        }

        return $comment;

    }



    /*
     * Match captcha function
     * This function is referenced from wp-math-captcha
     */
    public function NumberToWord($number)
    {
        $words = array(
            1 => __('one', self::LANG),
            2 => __('two', self::LANG),
            3 => __('three', self::LANG),
            4 => __('four', self::LANG),
            5 => __('five', self::LANG),
            6 => __('six', self::LANG),
            7 => __('seven', self::LANG),
            8 => __('eight', self::LANG),
            9 => __('nine', self::LANG),
            10 => __('ten', self::LANG),
            11 => __('eleven', self::LANG),
            12 => __('twelve', self::LANG),
            13 => __('thirteen', self::LANG),
            14 => __('fourteen', self::LANG),
            15 => __('fifteen', self::LANG),
            16 => __('sixteen', self::LANG),
            17 => __('seventeen', self::LANG),
            18 => __('eighteen', self::LANG),
            19 => __('nineteen', self::LANG),
            20 => __('twenty', self::LANG),
            30 => __('thirty', self::LANG),
            40 => __('forty', self::LANG),
            50 => __('fifty', self::LANG),
            60 => __('sixty', self::LANG),
            70 => __('seventy', self::LANG),
            80 => __('eighty', self::LANG),
            90 => __('ninety', self::LANG)
        );
        if(isset($words[$number]))
            return $words[$number];
        else
        {
            $reverse = FALSE;
            switch(get_bloginfo('language'))
            {
                case 'de-DE':
                    $spacer = 'und';
                    $reverse = TRUE;
                    break;

                case 'nl-NL':
                    $spacer = 'en';
                    $reverse = TRUE;
                    break;
                default:
                    $spacer = ' ';
            }
            $first = (int)(substr($number, 0, 1) * 10);
            $second = (int)substr($number, -1);
            return ($reverse === FALSE ? $words[$first].$spacer.$words[$second] : $words[$second].$spacer.$words[$first]);
        }
    }

    public function generate_match_captcha($atts=false)
    {

        $ops = array(
            'add' => '+',
            'sub' => '&#8722;',
            'mul' => '&#215;',
            'div' => '&#247;',
        );
        $operations = $displays = array();
        foreach($this->captcha_options['math']['operations'] as $operation => $value)
        {
            if($value == 1)
                $operations[] = $operation;
        }

        foreach($this->captcha_options['math']['display'] as $display => $value)
        {
            if($value == 1)
                $displays[] = $display;
        }

        $random_op = $operations[mt_rand(0, count($operations) - 1)];
        $random_input = mt_rand(0, 2); //position where user have to enter number
        $name_op = $ops[$random_op];
        switch($random_op)
        {
            case 'add':
                switch($random_input)
                {
                    case 0:
                        $number[0] = mt_rand(1, 10);
                        $number[1] = mt_rand(1, 89);
                        break;
                    case 1:
                        $number[0] = mt_rand(1, 89);
                        $number[1] = mt_rand(1, 10);
                        break;
                    case 2:
                        $number[0] = mt_rand(1, 9);
                        $number[1] = mt_rand(1, 10 - $number[0]);
                        break;

                }
                $number[2] = $number[0] + $number[1];
                break;
            case 'sub':
                switch($random_input)
                {
                    case 0:
                        $number[0] = mt_rand(2, 10);
                        $number[1] = mt_rand(1, $number[0] - 1);
                        break;
                    case 1:
                        $number[0] = mt_rand(11, 99);
                        $number[1] = mt_rand(1, 10);
                        break;
                    case 2:
                        $number[0] = mt_rand(11, 99);
                        $number[1] = mt_rand($number[0] - 10, $number[0] - 1);
                        break;
                }
                $number[2] = $number[0] - $number[1];
                break;
            case 'mul':
                switch($random_input)
                {
                    case 0:
                        $number[0] = mt_rand(1, 10);
                        $number[1] = mt_rand(1, 9);
                        break;
                    case 1:
                        $number[0] = mt_rand(1, 9);
                        $number[1] = mt_rand(1, 10);
                        break;
                    case 2:
                        $number[0] = mt_rand(1, 10);
                        $number[1] = ($number[0] > 5 ? 1 : ($number[0] === 4 && $number[0] === 5 ? mt_rand(1, 2) : ($number[0] === 3 ? mt_rand(1, 3) : ($number[0] === 2 ? mt_rand(1, 5) : mt_rand(1, 10)))));
                        break;
                }
                $number[2] = $number[0] * $number[1];
                break;
            case 'div':
                switch($random_input)
                {
                    case 0:
                        $divide = array(2 => array(1, 2), 3 => array(1, 3), 4 => array(1, 2, 4), 5 => array(1, 5), 6 => array(1, 2, 3, 6), 7 => array(1, 7), 8 => array(1, 2, 4, 8), 9 => array(1, 3, 9), 10 => array(1, 2, 5, 10));
                        $number[0] = mt_rand(2, 10);
                        $number[1] = $divide[$number[0]][mt_rand(0, count($divide[$number[0]]) - 1)];
                        break;
                    case 1:
                        $divide = array(1 => 99, 2 => 49, 3 => 33, 4 => 24, 5 => 19, 6 => 16, 7 => 14, 8 => 12, 9 => 11, 10 => 9);
                        $number[1] = mt_rand(1, 10);
                        $number[0] = $number[1] * mt_rand(1, $divide[$number[1]]);
                        break;
                    case 2:
                        $divide = array(1 => 99, 2 => 49, 3 => 33, 4 => 24, 5 => 19, 6 => 16, 7 => 14, 8 => 12, 9 => 11, 10 => 9);
                        $number[2] = mt_rand(1, 10);
                        $number[0] = $number[2] * mt_rand(1, $divide[$number[2]]);
                        $number[1] = (int)($number[0] / $number[2]);
                        break;
                }
                if(!isset($number[2]))
                {
                    $number[2] = (int)($number[0] / $number[1]);
                }
                break;

        }

        if(count($displays)==1 && $displays[0]=='words') // only words
        {
            switch($random_input)
            {
                case 0:
                    $number[1] = $this->NumberToWord($number[1]);
                    $number[2] = $this->NumberToWord($number[2]);
                    break;
                case 1:
                    $number[0] = $this->NumberToWord($number[0]);
                    $number[2] = $this->NumberToWord($number[2]);
                    break;
                case 2:
                    $number[0] = $this->NumberToWord($number[0]);
                    $number[1] = $this->NumberToWord($number[1]);
                    break;
            }
        }
        elseif(count($displays)==2) //numbers and words
        {
            $num_words = mt_rand(1,2);
            switch($random_input)
            {
                case 0:
                    if($num_words==2) // 2 words
                    {
                        $number[1] = $this->NumberToWord($number[1]);
                        $number[2] = $this->NumberToWord($number[2]);
                    }else // one of them is word
                    {
                        $tmp = mt_rand(1, 2);
                        $number[$tmp] = $this->NumberToWord($number[$tmp]);
                    }
                    break;
                case 1:
                    if($num_words==2)
                    {
                        $number[0] = $this->NumberToWord($number[0]);
                        $number[2] = $this->NumberToWord($number[2]);
                    }else
                    {
                        $tmp = array_rand(array(0 => 0, 2 => 2), 1);
                        $number[$tmp] = $this->NumberToWord($number[$tmp]);
                    }
                    break;
                case 2:
                    if($num_words==2)
                    {
                        $number[0] = $this->NumberToWord($number[0]);
                        $number[1] = $this->NumberToWord($number[1]);
                    }else
                    {
                        $tmp = mt_rand(0, 1);
                        $number[$tmp] = $this->NumberToWord($number[$tmp]);
                    }
                    break;
            }
        }

        // generate html to return
        if($atts) {
            $transient_name = "cf7";
            $session_id = $this->session_ids['cf7'];//[$this->session_number++];
            $input = sprintf('<input aria-required="true" class="wpcf7-form-control %1$s" maxlength="2" size="2" value="" name="%2$s" type="text"><input type="hidden" value="'.($this->session_number - 1).'" name="%3$s-sn" />',$atts['class'],$atts['name'],$atts['name']);

        }
        else {
            $transient_name = "awe";
            $session_id = $this->session_ids['default'];
            $input = "<input type=\"text\" autocomplete=\"off\" size=\"2\" length=\"2\" name=\"awe-captcha\" aria-required=\"true\" style=\"display: inline-block;width: 60px!important; vertical-align: middle;margin-bottom: 0;\">";
        }
        switch($random_input)
        {
            case 0:
                $return = $input.' '.$name_op.' '.$this->number_convert($number[1]).' = '.$this->number_convert($number[2]);
                break;
            case 1:
                $return = $this->number_convert($number[0]).' '.$name_op.' '.$input.' = '.$this->number_convert($number[2]);
                break;
            case 2:
                $return = $this->number_convert($number[0]).' '.$name_op.' '.$this->number_convert($number[1]).' = '.$input;
                break;
        }

        set_transient($transient_name."_".$session_id, sha1(AUTH_KEY.$number[$random_input].$session_id, FALSE), apply_filters('math_captcha_time', $this->captcha_options['math']['time']));
        return $return;
    }

    /*
     * Initializes cookie-session
     */
    public function init_captcha_session()
    {

        if(!is_admin()){
            if(isset($_COOKIE['awe_captcha_session_ids']))
                $this->session_ids = $_COOKIE['awe_captcha_session_ids'];
            else
            {
                foreach(array('default', 'cf7') as $name)
                {
                    $this->session_ids[$name] = sha1(wp_generate_password(64, FALSE, FALSE));
                }
            }

            if(!isset($_COOKIE['awe_captcha_session_ids']))
            {;
                //set default session
                setcookie('awe_captcha_session_ids[default]', $this->session_ids['default'], current_time('timestamp', TRUE) + $this->captcha_options['math']['time'], COOKIEPATH, COOKIE_DOMAIN, (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? TRUE : FALSE), TRUE);
                //set session for contact form 7
                setcookie('awe_captcha_session_ids[cf7]', $this->session_ids['cf7'], current_time('timestamp', TRUE) + $this->captcha_options['math']['time'], COOKIEPATH, COOKIE_DOMAIN,(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? TRUE : FALSE), TRUE);

            }
            return false;
        }

    }

    /*
     * Encodes chars
     */

    private function number_convert($string)
    {
        $chars = str_split($string);
        $seed = mt_rand(0, (int)abs(crc32($string) / strlen($string)));

        foreach($chars as $key => $char)
        {
            $ord = ord($char);

            //ignore non-ascii chars
            if($ord < 128)
            {
                //pseudo "random function"
                $r = ($seed * (1 + $key)) % 100;

                if($r > 60 && $char !== '@') {} // plain character (not encoded), if not @-sign
                elseif($r < 45) $chars[$key] = '&#x'.dechex($ord).';'; //hexadecimal
                else $chars[$key] = '&#'.$ord.';'; //decimal (ascii)
            }
        }

        return implode('', $chars);
    }





    /**
     * HOOK CONTACT FORM 7
     */

    public function wpcf7_add_shortcode()
    {
        wpcf7_add_shortcode('awecaptcha',                   array($this,'wpcf7_shortcode_handler'),                 TRUE);
    }


    public function wpcf7_shortcode_handler($tag)
    {
        if($this->check_role())
            return;

        $tag = new WPCF7_Shortcode($tag);

        if(empty($tag->name))
            return '';

        $validation_error = wpcf7_get_validation_error($tag->name);
        $class = wpcf7_form_controls_class($tag->type);

        if($validation_error)
            $class .= ' wpcf7-not-valid';

        $atts = array();
        $atts['class'] = $tag->get_class_option($class);
        $atts['id'] = $tag->get_option('id', 'id', true);
        $atts['name'] = $tag->name;


        switch($this->captcha_options['settings']['type'])
        {
            case 1:
                $return = sprintf('<p class="row-capcha">%1$s:  <span class="wpcf7-form-control-wrap %2$s">%3$s</span></p>',$this->captcha_options['math']['title'],$tag->name,$this->generate_match_captcha($atts));
                break;
            case 2:
                require_once( AWE_ROOT_DIR.'/lib/recaptcha/recaptchalib.php' );
                $public_key = $this->captcha_options['google']['public-key'];
                $private_key = $this->captcha_options['google']['private-key']; ?>
                <span class="wpcf7-form-control-wrap <?php echo $tag->name;?>"></span>
                <style type="text/css" media="screen">
                    #recaptcha_response_field {
                        max-height: 35px;
                    }
                </style>
                <script type='text/javascript'>
                    var RecaptchaOptions = { theme : "<?php echo $this->captcha_options['google']['theme']; ?>" };
                    var gglcptch_path = "<?php echo plugins_url( 'google_captcha_check.php', __FILE__ ); ?>";
                    var gglcptch_error_msg = "<?php _e( 'Error: You have entered an incorrect CAPTCHA value.', self::LANG ); ?>";
                    var gglcptch_private_key = "<?php echo $private_key; ?>";
                </script>
                <?php
                $return = recaptcha_get_html( $public_key ).'<span class="wpcf7-form-control-wrap awe-captcha '.$tag->name.'"></span>';
                break;
            case 3:
                $return ="<p> <span class=\"wpcf7-form-control-wrap awe-captcha\"></span>{$this->ayah->getPublisherHTML()}</p>";

                break;
        }
        return $return;
    }

    public function wpcf7_validation_filter($result, $tag)
    {


        $tag = new WPCF7_Shortcode($tag);
        $name = $tag->name;
        if($this->check_role())
            return $result;
        switch($this->captcha_options['settings']['type'])
        {
            case 1:
                if(isset($_POST[$name])&& $_POST[$name]!='')
                {
                    if($this->session_ids['cf7'] !== '' && get_transient('cf7_'.$this->session_ids['cf7']) !== FALSE)
                    {
                        if(strcmp(get_transient('cf7_'.$this->session_ids['cf7']), sha1(AUTH_KEY.$_POST[$name].$this->session_ids['cf7'], FALSE)) !== 0){
                            $result['valid'] = FALSE;
                            $result['reason'][$name] = wpcf7_get_message('awecaptcha_wrong');
                        }

                    }
                    else{
                        $result['valid'] = FALSE;
                        $result['reason'][$name] = wpcf7_get_message('awecaptcha_time');
                    }


                }else{
                    $result['valid'] = FALSE;
                    $result['reason'][$name] = wpcf7_get_message('awecaptcha_fill');
                }

                break;

            case 2:
                require_once( AWE_ROOT_DIR.'/lib/recaptcha/recaptchalib.php' );
                $private_key = ($this->captcha_options['google']['private-key'] && $this->captcha_options['google']['private-key']!=0)? $this->captcha_options['google']['private-key']:false;
                $public_key = ($this->captcha_options['google']['public-key'] && $this->captcha_options['google']['public-key']!=0)? $this->captcha_options['google']['public-key']:false;
                if($private_key && $public_key){
                    if(isset($_POST['recaptcha_challenge_field']) && isset($_POST['recaptcha_response_field'])){
                        $resp = recaptcha_check_answer( $private_key,
                            $_SERVER['REMOTE_ADDR'],
                            $_POST['recaptcha_challenge_field'],
                            $_POST['recaptcha_response_field'] );
                        if ( ! $resp->is_valid ) {
                            $result['valid'] = FALSE;
                            $result['reason'][$name] = "Invalid Captcha<script>Recaptcha.reload();</script>";
                        }
                    }
                    else
                    {
                        $result['valid'] = FALSE;
                        $result['reason'][$name] = wpcf7_get_message('awecaptcha_fill');
                    }

                }
                break;
            case 3:
                $score = $this->ayah->scoreResult();
                if (!$score)
                {
                    $result['valid'] = FALSE;
                    $result['reason']['awe-captcha'] = wpcf7_get_message('awecaptcha_wrong');
                }
                break;
        }

        return $result;
    }

    public function wpcf7_messages($messages)
    {

        return array_merge(
            $messages,
            array(
                'awecaptcha_wrong' => array(
                    'description' => __('Invalid captcha value.', self::LANG),
                    'default' => $this->captcha_error_messages['wrong']
                ),
                'awecaptcha_fill' => array(
                    'description' => __('Please enter captcha value.', self::LANG),
                    'default' => $this->captcha_error_messages['fill']
                ),
                'awecaptcha_time' => array(
                    'description' => __('Captcha time expired.', self::LANG),
                    'default' => $this->captcha_error_messages['time']
                )
            )
        );
    }

    public function wpcf7_display_warning_message()
    {
        if(!isset($_GET['post']))
            return;
        $contact_form = wpcf7_contact_form( $_GET['post']);
        if(empty($_GET['post']) || !($contact_form))
            return;

        $has_tags = (bool)$contact_form->form_scan_shortcode(array('type' => array('awecaptcha')));

        if(!$has_tags)
            return;
    }

    public function wpcf7_add_tag_generator()
    {
        if(!function_exists('wpcf7_add_tag_generator'))
            return;

        wpcf7_add_tag_generator('awecaptcha', __('AWE Captcha', self::LANG), 'wpcf7-awecaptcha', array($this,'wpcf7_tg_pane_awe_captcha'));
    }

    public function wpcf7_tg_pane_awe_captcha( $contact_form ) {
        ?>
        <div id="wpcf7-awecaptcha" class="hidden">
            <form action="">
                <table>
                    <tr>
                        <td>
                            <?php echo esc_html(__('Name', self::LANG));?><br />
                            <input type="text" name="name" class="tg-name oneline" />
                        </td>
                    </tr>
                </table>
                <div class="tg-tag">
                    <?php echo esc_html(__('Copy this code and paste it into the form left.', self::LANG));?><br />
                    <input type="text" name="awecaptcha" class="tag" readonly="readonly" onfocus="this.select()" />
                </div>
            </form>
        </div>
    <?php
    }



}