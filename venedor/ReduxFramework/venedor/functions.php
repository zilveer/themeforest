<?php

if (get_option('venedor_init_theme', '0') == '1') {

    add_action('redux/options/venedor_design/saved', 'venedor_save_design');

    function venedor_save_design() {

        global $reduxVenedorDesign;

        $reduxFramework = $reduxVenedorDesign->ReduxFramework;
        $template_dir = TEMPLATEPATH;

        ob_start();
        require_once dirname( __FILE__ ) . '/config_admin.php';
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/_config/system_admin_'.get_current_blog_id().'.css';

        if (is_writable(dirname($filename)) == false){
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

        ob_start();
        require_once dirname( __FILE__ ) . '/config.php';
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/_config/system_'.get_current_blog_id().'.css';

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));
    }
}

update_option('venedor_init_theme', '1');

?>