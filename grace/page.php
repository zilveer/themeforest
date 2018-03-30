<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */

get_header();
st_before_content($columns = '');
get_template_part( 'loop', 'page' );
st_after_content();
get_sidebar();
get_footer();

?>