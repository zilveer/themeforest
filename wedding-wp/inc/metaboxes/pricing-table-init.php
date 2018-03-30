<?php
$page_options_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_pricing_table_meta',
	'title' => 'Pricing Table',
	'types' => array('pricing-table'),
	
	'template' => get_template_directory() . '/inc/metaboxes/pricing-table.php',
		
));
/*
add_action('admin_print_footer_scripts','my_admin_print_footer_scripts',99);
function my_admin_print_footer_scripts()
{
    ?><script type="text/javascript">
        jQuery(function($)
        {
            var i=1;
            $('.pricingtablefeatures').each(function(e)
            {
                var id = $(this).attr('id');
 
                if (!id)
                {
                    id = 'pricingtablefeatures-' + i++;
                    $(this).attr('id',id);
                }
 
                tinyMCE.execCommand('mceAddControl', false, id);
                 
            });
        });
   </script><?php
}

add_filter('admin_head','ShowTinyMCE');
function ShowTinyMCE() {
	// conditions here
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
}
*/