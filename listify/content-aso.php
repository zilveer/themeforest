<?php
/**
 * The template for displaying the call to action
 */

$title = listify_theme_mod( 'as-seen-on-title', '' );
$logos = listify_theme_mod( 'as-seen-on-logos', '' );

if ( '' == $logos ) {
	return;
}
?>

<div class="as-seen-on">
	<div class="container">

		<h1 class="aso-title"><?php echo esc_attr( $title ); ?></h1>

		<div class="aso-content">
			<?php echo $logos; ?>
		</div>

	</div>
</div>
