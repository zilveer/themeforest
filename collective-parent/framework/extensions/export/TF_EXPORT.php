<?php

if (!defined('TFUSE'))
    wp_die(__('Direct access forbidden.', 'tfuse'));

/**
 * Description of EXPORT
 *
 * 
 */
class TF_EXPORT extends TF_TFUSE {

    public $_the_class_name = 'EXPORT';

    function __construct() {
        parent::__construct();
        //$this->framework=&get_instance();
    }

    function __init() {
        //add_action('admin_menu', array(&$this, 'add_menu'), 20);

        add_action('init', array($this, 'make_export'), 101);

    }
    function tfuse_post_title_export($title){
        return htmlspecialchars($title);
    }

    function make_export() {

        if ( $this->request->isset_GET('download') && ( $this->request->isset_GET('page') && $this->request->GET('page') == 'tf_export' ) )
        {
            remove_filter( 'the_title_rss',      'strip_tags'      );
            remove_filter( 'the_title_rss',      'ent2ncr',      8 );
            remove_filter('the_title_rss',      'esc_html'       );
            add_filter('the_title_rss',      array($this, 'tfuse_post_title_export'), 99, 1);
            ob_start();
            require_once('./includes/export.php');
            export_wp( array('content' => 'all') );
            if ( version_compare(PHP_VERSION, '5.3.0', '>=') )
            {
                header_remove( 'Content-Description' );
                header_remove( 'Content-Disposition' );
            }
            else
            {
                header("Content-Description: ");
                header("Content-Disposition: ");
            }
            $buffer = ob_get_contents();
            ob_end_clean();

            $buffer = explode('</rss>', $buffer);
            $tmp    = explode( '/', site_url() );
            $multi  = ( is_multisite() ) ? '-' . end( $tmp ) : '';
            $this->export_wp_filename = 'wordpress-' . TF_THEME_PREFIX . $multi . '.xml_.txt';
            $this->content = $buffer[0] . $this->tfuse_options_export() . '</rss>';
//            $this->download_export($this->content);
//            die();
        }
    }

    function add_menu() {
        add_submenu_page('themefuse', __('Export', 'tfuse'), __('Export', 'tfuse'), 'manage_options', 'tf_export', array($this, 'export'));
    }
    
    function option_item( $name, $value ) {
        $this->item = '';
        // if ( is_array($value) ) $value = tfuse_pk($value); // Do not export as urlencoded

        if( is_array($value) ) $value = serialize($value);

        $value = wxr_cdata( $value ); // export as <![CDATA[ ... ]]>

        $this->item .= '<item>' . PHP_EOL;  
        $this->item .= '<name>' . $name . '</name>' . PHP_EOL;
        $this->item .= '<value>' . $value . '</value>' . PHP_EOL;
        $this->item .= '</item>' . PHP_EOL . PHP_EOL;

        return $this->item;
    }

    function tfuse_options_export() {
        global $wpdb;
        $this->tf_options = PHP_EOL . '<tfuse_options>' . PHP_EOL;

        $this->tf_options .= $this->option_item( TF_THEME_PREFIX . '_tfuse_framework_options', get_option(TF_THEME_PREFIX . '_tfuse_framework_options') );
        $this->tf_options .= $this->option_item( TF_THEME_PREFIX . '_tfuse_taxonomy_options', get_option(TF_THEME_PREFIX . '_tfuse_taxonomy_options') );
        $this->tf_options .= $this->option_item( TF_THEME_PREFIX . '_tfuse_slider', get_option(TF_THEME_PREFIX . '_tfuse_slider') );
        $this->tf_options .= $this->option_item( TF_THEME_PREFIX . '_tfuse_sidebars', get_option(TF_THEME_PREFIX . '_tfuse_sidebars') );
        $this->tf_options .= $this->option_item( TF_THEME_PREFIX . '_tfuse_newsletter', get_option(TF_THEME_PREFIX . '_tfuse_newsletter') );
        $this->tf_options .= $this->option_item( TF_THEME_PREFIX . '_tfuse_contact_forms', get_option(TF_THEME_PREFIX . '_tfuse_contact_forms') );
        $this->tf_options .= $this->option_item( TF_THEME_PREFIX . '_tfuse_contact_form_general', get_option(TF_THEME_PREFIX . '_tfuse_contact_form_general') );

        $this->tf_options .= $this->option_item( 'posts_per_page', get_option('posts_per_page') );
        $this->tf_options .= $this->option_item( 'show_on_front', get_option('show_on_front') );
        $this->tf_options .= $this->option_item( 'page_on_front', get_option('page_on_front') );
        $this->tf_options .= $this->option_item( 'page_for_posts', get_option('page_for_posts') );
        $this->tf_options .= $this->option_item( 'permalink_structure', get_option('permalink_structure') );

        // Upload URL
        $upload = wp_upload_dir();
        $this->tf_options .= $this->option_item( 'upload_url', $upload['baseurl'] );

        // Navigation
        $current_template = get_option('stylesheet');
        $this->tf_options .= $this->option_item( 'theme_mods', get_option("theme_mods_{$current_template}") );

        // Sidebars
        $this->tf_options .= $this->option_item( 'sidebars_widgets', get_option('sidebars_widgets') );
        $widgets = $wpdb->get_results( "SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE 'widget_%'" );
        foreach($widgets as $widget){
            $this->tf_options .= $this->option_item( $widget->option_name, get_option($widget->option_name) );
        }

        $extra_options = apply_filters('tf_export_extra_options', array());
        if(sizeof($extra_options)){
            foreach($extra_options as $extop_name=>$extop_value){
                $this->tf_options .= $this->option_item( $extop_name, $extop_value );
            }
        }

        $this->tf_options .= '</tfuse_options>' . PHP_EOL;

        return $this->tf_options;
    }

    function tf_export_file() {
        // wp_upload_bits() creaza file nou daca $filename exista deja.
        // noua ne trebuie ca acest xml sa fie exportat direct in folderul 
        // /uploads, nu in /uploads/2012, de aceea schimbam folderul upload
        // sa fie basedir, fara subdir.
        add_filter( 'upload_dir', array($this,'change_upload_dir') );

        // pentru multisite, txt de obicei nu este permis, de aceea adaugam in lista
        add_filter( 'upload_mimes', array($this,'change_upload_mimes') );

        // wp_upload_bits() foloseste functia wp_unique_filename(). Pentru a 
        // preveni sa creeze un file cu alt nume, von sterge filul precendet daca exista

        $filename = $this->export_wp_filename;
        global $wpdb;
        $attachments = $wpdb->get_results( $wpdb->prepare("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_title='%s'", $filename) );
        foreach ( $attachments as $attachment ) {
            wp_delete_attachment($attachment->ID);
        }
        $upload_dir = wp_upload_dir();
        $this->upload_basedir = $upload_dir['basedir'];

        if ( is_file( $upload_dir['basedir'] . '/' . $filename ) )
            @unlink($upload_dir['basedir'] . '/' . $filename);

        $upload = wp_upload_bits( $filename, 0, $this->content );
        remove_filter( 'upload_dir', array($this,'change_upload_dir') );
        remove_filter( 'upload_mimes', array($this,'change_upload_mimes') );
        
        if ( $upload['error'] )
            return new WP_Error( 'upload_dir_error', $upload['error'] );

        return $upload;
    }
    
    function download_export($buffer) {
        
        header( 'Content-Description: File Transfer' );
        header( 'Content-Disposition: attachment; filename=' . $this->export_wp_filename );
        header( 'Content-Type: text/xml; charset=' . get_option( 'blog_charset' ), true );
        echo $buffer;
    }
   
    function change_upload_dir($uploads) {
        $uploads['path'] = str_replace($uploads['subdir'], '', $uploads['path']);
        $uploads['url'] = str_replace($uploads['subdir'], '', $uploads['url']);
        return $uploads;
    }
    
    function change_upload_mimes($mimes) {
        $mimes['txt'] = 'text/plain';
        return($mimes);
    }
    
    function export() {
        echo '<div id="tfuse_fields" class="wrap metabox-holder">';
        $this->interface->page_header_info();

        echo '<div class="install">
                <div style="clear:both;height:10px;"></div>';
        
        if ( $this->request->isset_GET('download') && $this->request->isset_GET('page') && $this->request->GET('page') == 'tf_export' )
        {
            $this->tf_export_file = $this->tf_export_file();           
            
            if ( is_wp_error( $this->tf_export_file ) )
            {
                $this->load->ext_view($this->_the_class_name, 'after_download');
            }
            else
            {
                $this->load->ext_view($this->_the_class_name, 'after_download');
            }

        }
        else
        {
            $this->load->ext_view($this->_the_class_name, 'before_download');
        }
        
        echo '</div></div>';
    }  
}
