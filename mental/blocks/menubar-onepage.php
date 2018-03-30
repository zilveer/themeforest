<?php
/**
 * Menu bar onepage template part
 *
 * @author Edgar <support@azelab.com>
 * @package Mental WP
 * @link http://azelab.com
 */
?>
<?php
if(is_numeric($background_image_id = get_mental_option('menubar_background_image')))
$background_image = wp_get_attachment_url($background_image_id);

// Video background
if ( get_mental_option( 'menubar_background_video' ) ) {
	$menubar_background_video = get_mental_option( 'menubar_background_video' );
}
if ( get_mental_option( 'menubar_background_video_opacity' ) ) {
	$menubar_background_video_opacity = get_mental_option( 'menubar_background_video_opacity' );
}
?>

<div id="menu-bar" style="<?php if ( ! empty( $background_image ) ) { echo ' background-image: url(\'' . esc_url( $background_image ) . '\');'; } ?>">

	<?php if ( ! empty( $menubar_background_video ) ): ?>
		<div class="st-video-background"
		     style="opacity: <?php echo esc_attr( $menubar_background_video_opacity ); ?>; z-index: -1;">
			<video autoplay="autoplay" loop="loop" muted="muted">
				<?php $videos = explode( ',', $menubar_background_video ); ?>
				<?php foreach ( $videos as $video ): ?>
					<?php
					$video_url = wp_get_attachment_url($video);
					$type = pathinfo( $video_url, PATHINFO_EXTENSION );
					if ( $type == 'ogv' ) {
						$type = 'ogg';
					}
					?>
					<source src="<?php echo esc_url($video_url); ?>" type="video/<?php echo esc_attr($type); ?>">
				<?php endforeach ?>
			</video>
		</div>
	<?php endif ?>

	<aside>
		<div class="mb-body">

			<div class="mb-header hidden-xs">
				<a class="logo" href="<?php echo site_url(); ?>"><?php echo get_mental_image( get_mental_option( 'logo_invert' ) , 'full' ) ?></a>
				<?php if( get_mental_option('logo_show_tagline') ): ?>
					<p class="mb-site-descr"><?php bloginfo( 'description' ); ?></p>
				<?php endif ?>
			</div>
			<div class="mb-content">

				<?php if ( function_exists( 'icl_get_languages' ) ): ?>
					<?php $wpml_languages = icl_get_languages( 'skip_missing=0&orderby=id&order=asc' ) ?>
					<?php foreach ( $wpml_languages as $key => $lang ) {
						if ( $lang['active'] ) {
							$active_lang = $lang;
							unset( $wpml_languages[ $key ] );
							break;
						}
					} ?>

					<ul id="mental_lang_sel">
						<li>
							<a href="<?php echo esc_url($active_lang['url']); ?>"><?php echo esc_html($active_lang['native_name']); ?></a>
							<ul>
								<?php foreach ( $wpml_languages as $lang ): ?>
									<li><a href="<?php echo esc_url($lang['url']); ?>"><?php echo esc_html($lang['native_name']); ?></a></li>
								<?php endforeach ?>
							</ul>
						</li>
					</ul>
				<?php endif ?>

				<nav id="mb-main-menu" class="smoothscroll">
					<?php wp_nav_menu( array(
						'theme_location' => 'menubar-menu-onepage',
						//'menu_id'        => 'mb-main-menu',
						'menu_class'     => 'menu ' . ( get_mental_option( 'menubar_menu_accodrion_type' ) ? 'menu-accordion-type' : '' ),
					) ); ?>
				</nav>
			</div>

			<div class="mb-footer">
				<?php if ( $about_us = get_mental_option( 'menubar_aboutus' ) ): ?>
					<h4>About us</h4>
					<p><?php echo stripslashes($about_us); ?></p>
				<?php endif ?>
				<?php get_template_part( 'blocks/social-links' ) ?>
				<div class="mb-copyright">
					<p><?php echo stripslashes(get_mental_option( 'menubar_copyright' )) ?></p>
				</div>
			</div>
		</div>
		<!-- mb-body -->
		<a href="#" class="mb-toggler"><i class="fa fa-bars"></i></a>
	</aside>
</div> <!-- menu-bar -->