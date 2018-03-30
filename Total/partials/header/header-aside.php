<?php
/**
 * Header aside content used in Header Style Two, Three and Four
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get header style
$header_style = wpex_global_obj( 'header_style' );

// Get content
$content = wpex_global_obj( 'header_aside_content' );

// Display header aside if content exists or it's header style 2 and the main search is enabled
if ( $content || ( wpex_get_mod( 'main_search', true ) && 'two' == $header_style ) ) :

	// Add classes
	$classes = 'clr';
	if ( $visibility = wpex_get_mod( 'header_aside_visibility', 'visible-desktop' ) ) {
		$classes .= ' '. $visibility;
	}
	if ( $header_style ) {
		$classes .= ' header-'. $header_style .'-aside';
	} ?>

	<aside id="header-aside" class="<?php echo esc_attr( $classes ); ?>">

		<div class="header-aside-content clr">

			<?php echo do_shortcode( $content ); ?>

		</div><!-- .header-aside-content -->

		<?php
		// Show header search field if enabled in the theme options panel and it's header style 2
		if ( wpex_get_mod( 'header_aside_search', true ) && 'two' == $header_style ) : ?>

			<div id="header-two-search" class="clr">
				<form method="get" class="header-two-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" id="header-two-search-input" name="s" value="<?php esc_attr_e( 'search', 'total' ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
					<button type="submit" value="" id="header-two-search-submit">
						<span class="fa fa-search"></span>
					</button>
				</form><!-- #header-two-searchform -->
			</div><!-- #header-two-search -->

		<?php endif; ?>

	</aside><!-- #header-two-aside -->

<?php endif; ?>