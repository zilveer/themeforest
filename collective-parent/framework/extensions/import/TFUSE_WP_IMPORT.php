<?php
/**
 * Description of TFUSE_WP_IMPORT
 *
 */
class TFUSE_WP_IMPORT extends TF_WP_Import
{
    /** @var string Site url used in imported xml (from what site it was exported) */
    public $old_site_url = '';

    /** @var string Current site url that imports xml */
    public $new_site_url = '';

    /** @var string Url to imported xml */
    public $upload_url_old = '';

    /** @var string Url to install folder, where are all imported files (images, uploads, etc.) */
    public $install_url = '';

    /** @var array Framework options and other themefuse options (sidebars, ...) */
    public $tfuse_options = array();

    function __construct()
    {
        parent::__construct();

        $this->framework =& get_instance();

        $this->install_url = get_template_directory_uri() .'/install';
        $this->install_dir = get_template_directory() .'/install';

        // in case when user by mistake copied entire folder in /uploads or /files
        if (is_dir(get_template_directory() .'/install/uploads')) {
            $this->install_url .= '/uploads';
            $this->install_dir .= '/uploads';
        } elseif (is_dir(get_template_directory() .'/install/files')) {
            $this->install_url .= '/files';
            $this->install_dir .= '/files';
        }
    }

    /** Import page html header */
    function header()
    {
        echo '<div id="tfuse_fields" class="wrap metabox-holder">';
        $this->framework->interface->page_header_info();
    }

    /** Display import page for every step */
    function dispatch()
    {
        $this->header();

        $step = (int)$this->framework->request->REQUEST('step');

        switch ($step) {
            case 0:
                $this->tf_install();
                break;
            case 1:
            case 2:
                check_admin_referer( 'themefuse-import-wordpress' );

                $this->fetch_attachments = true;
                $this->id                = (int)$this->framework->request->POST('import_id');
                $file                    = get_attached_file($this->id);

                set_time_limit(0);

                $this->import($file);
                break;
        }

        $this->footer();
    }

    function import_start($file)
    {
        if (!is_file($file)) {
            echo '<p><strong>'. __('Sorry, there has been an error.', 'wordpress-importer') .'</strong><br/>';
            echo __('The file does not exist, please try again.', 'wordpress-importer') .'</p>';
            $this->footer();
            die();
        }

        $import_data = $this->parse($file);

        if (is_wp_error($import_data)) {
            echo '<p><strong>'. __('Sorry, there has been an error.', 'wordpress-importer') .'</strong><br/>';
            echo esc_html($import_data->get_error_message()) . '</p>';
            $this->footer();
            die();
        }

        $this->version      = $import_data['version'];
        $this->get_authors_from_import( $import_data );
        $this->posts        = $import_data['posts'];
        $this->terms        = $import_data['terms'];
        $this->categories   = $import_data['categories'];
        $this->tags         = $import_data['tags'];
        $this->base_url     = esc_url( $import_data['base_url'] );

        // fix for: 'http://localhost/justmarriedmarried' = str_replace('http://localhost/just', 'http://localhost/justmarried', 'http://localhost/justmarried')
        $this->wrong_replace = (network_home_url() !== ($wrong_replace = str_replace($this->base_url, network_home_url(), network_home_url())))
            ? $wrong_replace
            : false;

        wp_defer_term_counting( true );
        wp_defer_comment_counting( true );

        do_action( 'import_start' ); // deprecated
        do_action( 'tf_ext_import_start' );
    }

    function parse( $file )
    {
        $parser = new WXR_Parser();

        // TFUSE 2012.02.10
        $this->tfuse_import_options( $file );

        return $parser->parse( $file );
    }

    function tfuse_change_link(&$item, $key)
    {
        if ( !empty($key) && in_array($key, $this->cfg_install_options['tax']) )
        {
            if ( is_numeric($item) && isset($this->processed_terms[intval($item)]) )
            {
                // daca aceasta este o optiune care salveaza ID de taxonomie,
                // si daca acest ID a fost schimbat in urma importului
                $item = $this->processed_terms[intval($item)];
            }
            elseif (preg_match('/[0-9]/', $item))
            {
                // sliderul de ex. salveaza categoriile separate prin virgula
                $itemsArr = (array) explode(',',$item);
                $processed_ids = array();
                foreach ($itemsArr as $t_id)
                    if (isset($this->processed_terms[intval($t_id)]))
                        $processed_ids[] = $this->processed_terms[intval($t_id)];

                if (count($processed_ids))
                    $item = implode(',',$processed_ids);
            }
        }
        elseif ( !empty($key) && in_array($key, $this->cfg_install_options['pos']) )
        {
            if ( is_numeric($item) && isset($this->processed_posts[intval($item)]) )
            {
                // daca aceasta este o optiune care salveaza ID de post,
                // si daca acest ID a fost schimbat in urma importului
                $item = $this->processed_posts[intval($item)];
            }
            else
            {
                // sliderul de ex. salveaza posturile separate prin virgula
                $itemsArr = (array) explode(',',$item);
                $processed_ids = array();
                foreach ($itemsArr as $p_id)
                    if (isset($this->processed_posts[intval($p_id)]))
                        $processed_ids[] = $this->processed_posts[intval($p_id)];

                $item = implode(',',$processed_ids);
            }
        }
        elseif ( isset($this->url_remap[$item]) )
        {
            // daca este link, si acest file a fost deja importat in Media,
            // atunci il inlocuim cu linkul nou
            $item = $this->url_remap[$item];
        }
        elseif ( !empty($key) && !empty($item) && $key != 'upload_url' && false !== strstr($item, $this->upload_url_old) && false === strstr($item, "\n") && false === strstr($item, ' ') )
        {
            // daca avem un link care nu a fost importat in Media,
            // incercam sa importam fisierul. Folosim ob_start() pentru a nu intrerupe
            // procesul in acz de eroare la importul fisierului
            ob_start();
            $this->fetch_remote_file( $item, array('upload_date' => null, 'guid' => $item) );
            ob_end_clean();
            if ( isset($this->url_remap[$item]) )
                $item = $this->url_remap[$item];
        }
        // elseif ( !empty($key) && !empty($item) && $key == 'text' ) // remap url in widget_text
        elseif ( !empty($key) && !empty($item) && !is_numeric($item) ) // remap url in widget_text, textareas options
        {
            $item = str_replace(array_keys($this->url_remap), $this->url_remap, $item);
            $item = str_replace($this->base_url, network_home_url(), $item); // Replace links in html

            if ( $this->wrong_replace )
            {
                $item = str_replace($this->wrong_replace, network_home_url(), $item);
            }
        }
    } // end tfuse_change_link()

    function tfuse_import_options( $file )
    {
        $xmlObj = simplexml_load_file($file);
        if($xmlObj === false)
            return;

        if(!isset($xmlObj->tfuse_options))
            return;

        $count_imported_options = 0;
        foreach($xmlObj->tfuse_options->children() as $child)
        {
            if(isset($child->name) && isset($child->value)){
                $this->tfuse_options[ (string)$child->name ] = (string)$child->value;

                $count_imported_options++;
            }
        }
        if(!$count_imported_options)
            return;

        $this->upload_url_old   = rtrim( $this->tfuse_options['upload_url'], '/' );
        $this->install_url      = get_template_directory_uri() . '/install';
        // in az ca useru din greseala a copiat tot folderul upload sau files
        $upload_folder = explode('/', $this->upload_url_old);
        $upload_folder = end( $upload_folder );
        if ( is_dir( get_template_directory() . '/install/' . $upload_folder ) )
            $this->install_url .= '/' . $upload_folder;

    } // end tfuse_import_options()

    function tfuse_process_options()
    {
        if ( empty($this->tfuse_options) )
            return;
        $this->cfg_install_options = $this->framework->theme->theme_info['install_options'];

        foreach ( $this->tfuse_options as $name => $value ) {

            // Urlencoded string cannot contain ':}";' characters
            $imposible_urlencoded_chars = array(':','{', '"', ';');

            $is_CDATA = false;
            foreach($imposible_urlencoded_chars as $char){
                if(stripos($value, $char) !== false){
                    // If value contains that char, that means it can't be urlencoded, it is value from CDATA
                    $is_CDATA       = true;

                    $CDATA_value    = tf_cdata_decode($value); // it chan't contain <![CDATA[ because it is extracted via SimpleXML class, but just to be sure

                    break;
                }
            }

            $new_val = ( $is_CDATA
                ? @tf_mb_unserialize($CDATA_value)
                : tfuse_unpk($value)
            );

            if ( $new_val === false ){
                if($is_CDATA){
                    $new_val = $CDATA_value;
                } else {
                    $new_val = $value;
                }
            }

            $tmp = intval($new_val);
            if ( ($name == 'page_on_front' || $name == 'page_for_posts') && !empty( $tmp ) )
                $new_val = $this->processed_posts[intval($new_val)];

            // verificam id-urile posturilor si categoriilor din sidebars
            if ( TF_THEME_PREFIX . '_tfuse_sidebars' == $name && !empty($new_val['settings']) )
            {
                // obtinem setarile pentru fiecare placeholder
                $settings = array_keys($new_val['settings']);
                foreach ($settings as $setting)
                {
                    $isposts = explode('by_id_',$setting);
                    $isposts = post_type_exists(end($isposts));
                    // cele care pastreaza id-uri de post-uri
                    if ( strstr($setting, 'by_id_') && $isposts )
                    {
                        // fiecare palceholder are un id sau mai multe separate prin virgula
                        $palceholders = array_keys($new_val['settings'][$setting]);
                        foreach ($palceholders as $_ids)
                        {
                            $processed_ids = array();
                            $p_ids = explode(',',$_ids);
                            foreach ($p_ids as $p_id)
                                $processed_ids[] = ( isset($this->processed_posts[intval($p_id)]) ) ?
                                    $this->processed_posts[intval($p_id)] : $p_id;
                            $new_ids = implode(',',$processed_ids);

                            $old_val = $new_val['settings'][$setting][$_ids];
                            unset($new_val['settings'][$setting][$_ids]);
                            $new_val['settings'][$setting][$new_ids] = $old_val;
                        }
                    }
                    // cele care pastreaza id-uri de categorii/taxonomii
                    if ( strstr($setting, 'by_category_') || (strstr($setting, 'by_id_') && !$isposts) )
                    {
                        // fiecare palceholder are un id sau mai multe separate prin virgula
                        $palceholders = array_keys($new_val['settings'][$setting]);
                        foreach ($palceholders as $_ids)
                        {
                            $processed_ids = array();
                            $p_ids = explode(',',$_ids);
                            foreach ($p_ids as $p_id)
                                $processed_ids[] = ( isset($this->processed_terms[intval($p_id)]) ) ?
                                    $this->processed_terms[intval($p_id)] : $p_id;
                            $new_ids = implode(',',$processed_ids);

                            $old_val = $new_val['settings'][$setting][$_ids];
                            unset($new_val['settings'][$setting][$_ids]);
                            $new_val['settings'][$setting][$new_ids] = $old_val;
                        }
                    }
                }
            }

            if ( $name == 'theme_mods' ) {
                unset($this->tfuse_options[$name]);
                $name .= '_' . get_stylesheet();
                $menu_id = 0;
                if ( !empty($new_val['nav_menu_locations']) && is_array($new_val['nav_menu_locations']) )
                    foreach($new_val['nav_menu_locations'] as $arrid => $key) {
                        if( !isset($this->processed_terms[intval($key)]) ) continue;
                        $menu_id = $this->processed_terms[intval($key)];
                        $new_val['nav_menu_locations'][$arrid] = $menu_id;
                    }
            }

            // schimbam idurile la taxonomy options
            if ( $name == TF_THEME_PREFIX . '_tfuse_taxonomy_options' && is_array($new_val) ) {
                $new_tax_array = array();
                foreach ( $new_val as $key => $ops ) {
                    if ( isset($this->processed_terms[$key]) ) {
                        $new_tax_array[$this->processed_terms[$key]] = $ops;
                    }
                    else {
                        $new_tax_array[$key] = $ops;
                    }
                }
                $new_val = $new_tax_array;
            }

            if ( is_array($new_val) && TF_THEME_PREFIX . '_tfuse_sidebars' != $name )
                array_walk_recursive($new_val, array($this,'tfuse_change_link'));

            $this->tfuse_options[$name] = $new_val;
            update_option($name,$new_val);
        }

    } // end tfuse_process_options()

    /**
     * Perform a HTTP HEAD or GET request.
     *
     * If $file_path is a writable filename, this will do a GET request and write
     * the file to that path.
     *
     * @since 2.5.0
     *
     * @param string $url URL to fetch.
     * @param string|bool $file_path Optional. File path to write request to.
     * @param int $red (private) The number of Redirects followed, Upon 5 being hit, returns false.
     * @return bool|string False on failure and string of headers if HEAD request.
     */
    function tf_wp_get_http( $url, $file_path = false, $red = 1 )
    {
        @set_time_limit( 0 );

        if ( $red > 5 )
            return false;

        $options = array();
        $options['redirection'] = 5;
        $options['timeout']     = 268435455; // pow(2, 28) - 1

        if ( false == $file_path )
            $options['method'] = 'HEAD';
        else
            $options['method'] = 'GET';

        $response = wp_remote_request($url, $options);

        if ( is_wp_error( $response ) )
            return false;

        $headers = wp_remote_retrieve_headers( $response );
//        $headers['content-length'] = mb_strlen( $response['body'], 'UTF-8' );
        $headers['response'] = wp_remote_retrieve_response_code( $response );

        // WP_HTTP no longer follows redirects for HEAD requests.
        if ( 'HEAD' == $options['method'] && in_array($headers['response'], array(301, 302)) && isset( $headers['location'] ) ) {
            return wp_get_http( $headers['location'], $file_path, ++$red );
        }

        if ( false == $file_path )
            return $headers;

        // GET request - write it to the supplied filename
        $out_fp = fopen($file_path, 'w');
        if ( !$out_fp )
            return $headers;

        fwrite( $out_fp,  wp_remote_retrieve_body( $response ) );
        fclose($out_fp);
        clearstatcache();

        return $headers;
    }

    function fetch_remote_file( $url, $post )
    {
        // extract the file name and extension from the url
        $file_name = basename( $url );

        // TFUSE: verificam daca am importat deja acest link ca sa nu dublam imaginile
        if ( isset($this->url_remap[$url]) )
        {
            $upload = $upload_dir = array();
            $new_file = '';
            $upload_dir = wp_upload_dir( $post['upload_date'] );
            $new_file = $upload_dir['path'] . "/$file_name";
            $upload['file'] = $new_file;
            $upload['url'] = $this->url_remap[$url];
            $upload['error'] = false;
            return $upload;
        }

        // get placeholder file in the upload dir with a unique, sanitized filename
        $upload = wp_upload_bits( $file_name, 0, '', $post['upload_date'] );
        if ( $upload['error'] )
            return new WP_Error( 'upload_dir_error', $upload['error'] );

        // TFUSE: de obicei $url este localhost ... si in aces caz wp_get_http
        // nu se poate conecta la server, de aceea schimbam url ca sa downloadeze
        // din folderul install al temei

        // fetch the remote url and write it to the placeholder file
        //$headers = wp_get_http( $url, $upload['file'] );

        $tfuse_url = str_ireplace($this->upload_url_old, $this->install_url, $url);
        $headers = $this->tf_wp_get_http( $tfuse_url, $upload['file'] );

        //fix for fetch_remote_file 3.10.2012
        $filesize = filesize( $upload['file'] );
        if ( ! $headers || $headers['response'] != '200' || 0 == $filesize )
        {
            @unlink( $upload['file'] );

            $tfuse_url = str_ireplace($this->upload_url_old, $this->install_dir, $url);
            $bits = file_get_contents($tfuse_url);
            $upload = wp_upload_bits( $file_name, 0, $bits, $post['upload_date'] );
            if ( $upload['error'] )
                return new WP_Error( 'upload_dir_error', $upload['error'] );
        }

        $max_size = (int) $this->max_attachment_size();
        if ( ! empty( $max_size ) && $filesize > $max_size ) {
            @unlink( $upload['file'] );
            return new WP_Error( 'import_file_error', sprintf(__('Remote file is too large, limit is %s', 'wordpress-importer'), size_format($max_size) ) );
        }

        // keep track of the old and new urls so we can substitute them later
        $this->url_remap[$url] = $upload['url'];
        $this->url_remap[$post['guid']] = $upload['url']; // r13735, really needed?
        // keep track of the destination if the remote url is redirected somewhere else
        if ( isset($headers['x-final-location']) && $headers['x-final-location'] != $url )
            $this->url_remap[$headers['x-final-location']] = $upload['url'];

        return $upload;
    }

    function backfill_attachment_urls()
    {
        global $wpdb;

        // TFUSE: mai intii procesam optiunile din framework
        $this->tfuse_process_options();
        $rows = $wpdb->get_results( $wpdb->prepare("SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key='%s'", TF_THEME_PREFIX.'_tfuse_post_options') );
        foreach ( $rows as $row )
        {
            $new_val = tfuse_unpk($row->meta_value);
            if ( $new_val === false )
                $new_val = $row->meta_value;

            if ( is_array($new_val) )
                array_walk_recursive($new_val, array($this,'tfuse_change_link'));

            tf_update_post_meta($row->post_id, TF_THEME_PREFIX.'_tfuse_post_options', $new_val);
            $this->tfuse_post_options[$row->post_id] = $new_val;
        }

        $this->url_remap[$this->base_url] = network_home_url();

        // make sure we do the longest urls first, in case one is a substring of another
        uksort( $this->url_remap, array($this, 'cmpr_strlen') );

        // append this to the end of array to be executed last (after 'cmpr_strlen' that changes the order)
        if ( $this->wrong_replace )
        {
            $this->url_remap[$this->wrong_replace] = network_home_url();
        }

        foreach ( $this->url_remap as $from_url => $to_url ) {
            // remap urls in post_content
            $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->posts} SET post_content = REPLACE(post_content, %s, %s)", $from_url, $to_url) );
            // remap enclosure urls
            $result = $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->postmeta} SET meta_value = REPLACE(meta_value, %s, %s) WHERE meta_key='enclosure'", $from_url, $to_url) );
        }
    }

    function change_upload_mimes($mimes)
    {
        $mimes['txt'] = 'text/plain';
        return($mimes);
    }

    function tf_install()
    {
        $error = false;

        foreach ( glob( $this->install_dir . '/wordpress-' . TF_THEME_PREFIX . '*.xml_.txt') as $filename)
        {
            add_filter( 'upload_mimes', array($this,'change_upload_mimes') );
            $this->upload_url_old = $this->install_url;
            $url = $this->install_url . '/' . basename($filename);
            $this->import_file = $this->fetch_remote_file($url , array('upload_date' => null, 'guid' => $url) );
            remove_filter( 'upload_mimes', array($this,'change_upload_mimes') );

            if ( is_wp_error( $this->import_file ) ) {
                $data = array('import_file'=>&$this->import_file);
                $this->framework->load->ext_view('IMPORT', 'install_error', $data);
                return;
            }

            $url = $this->import_file['url'];
            $file = $this->import_file['file'];
            $filename = basename($filename);

            // Construct the object array
            $object = array( 'post_title' => $filename,
                'post_content' => $url,
                'guid' => $url,
                'context' => 'import',
                'post_status' => 'private'
            );

            // Save the data
            $id = wp_insert_attachment( $object, $file );
            $this->id = (int) $id;

            // schedule a cleanup for one day from now in case of failed import or missing wp_import_cleanup() call
            wp_schedule_single_event( time() + 86400, 'importer_scheduled_cleanup', array( $id ) );
            $data = array('id' => $id);
            $this->framework->load->ext_view('IMPORT', 'install_demo', $data);
            // ne intereseaza primul fisier gasit
            return;
        }

        // daca nu a gasit filul, afisam eroare
        $error = new WP_Error( 'import_file_error', 'The import file could not be found at <code>'.$this->install_dir.'</code>.' );
        if ( is_wp_error( $error ) ) {
            $data = array('import_file'=>$error);
            $this->framework->load->ext_view('IMPORT', 'install_error', $data);
            return;
        }
    }
}
