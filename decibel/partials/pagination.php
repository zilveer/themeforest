<div class="clearfix"></div>
<?php
/**
 * Pagination
 */
if ( wolf_get_theme_option( 'blog_infinite_scroll' ) && 'masonry' == wolf_get_theme_option( 'blog_type' ) ) {
	wolf_paging_nav();
} else {
	wolf_pagination();
}