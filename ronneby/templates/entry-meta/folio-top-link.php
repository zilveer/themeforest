<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
$folio_page_url = '';
$folio_link_src = (isset($dfd_ronneby['folio_top_link_src']) && !empty($dfd_ronneby['folio_top_link_src'])) ? $dfd_ronneby['folio_top_link_src'] : 'page';
if(isset($dfd_ronneby['folio_top_page_url']) && !empty($dfd_ronneby['folio_top_page_url']) && $folio_link_src == 'url') {
	$folio_page_url = $dfd_ronneby['folio_top_page_url'];
} elseif(isset($dfd_ronneby['folio_top_page_select']) && !empty($dfd_ronneby['folio_top_page_select'])) {
	$folio_page_url = get_page_link($dfd_ronneby['folio_top_page_select']);
}

if($folio_page_url) : ?>
	<a href="<?php echo esc_url($folio_page_url) ?>" title="<?php echo esc_attr__('Portfolio','dfd') ?>" class="dfd-blog-page-icon">
		<span></span>
		<span></span>
		<span></span>
	</a>
<?php endif;