<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }
$info_background = $html404 = $html_search_icon = '';
$e404 = __('404', 'dfd');
if (is_404()) {
	//$info_background = __('Oops', 'dfd');
	$html404 = '<p class="namber404">'.$e404.'</p>';
	$html_search_icon = '<i class="dfd-added-font-icon-konus"></i>';
} else {
	//$info_background = __('Sorry', 'dfd');
	$html404 = '';
	$html_search_icon = '<i class="dfd-icon-zoom"></i>';
}

?>

<article id="post-0" class="not-found404 clearfix">

	<div class="info-wrap-empty">
		<h1 class="info-background-empty"><?php echo _e( 'Oops', 'dfd' ); ?></h1>
		<div class="info-content-empty">
			<div class="icon-empty">
				<?php echo $html_search_icon; ?>
			</div>
			<div class="info-empty">
				<?php echo $html404; ?>
				<p class="cart-empty-text"><?php _e( 'Nothing was found', 'dfd' ) ?></p>
				<p class="cart-empty-subtext"><?php _e( 'Perhaps searching, or one of the links below, can help.', 'dfd' ) ?></p>
				<p class="button-on-page"><a class="wc-backward" href="<?php echo home_url(); ?>"><?php _e( 'Go to homepage', 'dfd' ) ?></a></p>
			</div>
		</div>
	</div>

	<div class="container-shortcodes row">
		<div class="columns six">
			<div class="arhives404 eight">
				<p class="label-form"><?php _e( 'Search in archives', 'dfd' ) ?></p>
				<div class="arhives">
					<select name="archive-menu" onChange="document.location.href = this.options[this.selectedIndex].value;">
						<option value=""></option>
						<?php wp_get_archives('type=monthly&format=option'); ?>
					</select>
				</div>
			</div>
		</div>

		<div class="columns six">
			<div class="search404 eight">
				<p class="label-form"><?php _e( 'Search on site', 'dfd' ) ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>

</article>