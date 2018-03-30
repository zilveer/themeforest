<?php

global $TFUSE,$post;

$full_path = __FILE__;
$path_parts = explode('wp-content', $full_path);
require_once( $path_parts[0] . '/wp-load.php' );
$tfuse_theme_css = get_template_directory_uri() . '/style.css';
$post_id = $TFUSE->request->POST('preview_shortcode_post_id');
$post = get_post($post_id);
$shc = do_shortcode($TFUSE->request->POST('preview_shortcode'));
$shortcodes = $TFUSE->ext->shortcodes->get_shortcodes();
$sh_type = $TFUSE->request->POST('preview_shortcode_type');
$before_preview = isset($shortcodes[$sh_type]['atts']['before_preview']) ? $shortcodes[$sh_type]['atts']['before_preview'] : '';
$after_preview = isset($shortcodes[$sh_type]['atts']['after_preview']) ? $shortcodes[$sh_type]['atts']['after_preview'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head profile="http://gmpg.org/xfn/11">
        <link rel="stylesheet" href="<?php echo $tfuse_theme_css; ?>" media="all" />
        <?php
        tfuse_head();
        wp_head();
        ?>
        <script type="text/javascript">
            parent.start_auto_preview(10);
        </script>
        <style type="text/css">
            #wpadminbar {
                display:none;
            }
        </style>
    </head>
    <body <?php body_class(); ?>>
        <?php
        echo $before_preview;
        echo $shc;
        echo $after_preview;
        ?>
        <?php wp_footer(); ?>
    </body>
</html>