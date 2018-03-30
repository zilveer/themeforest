<?php
/** Single Apartment
  *
  * This file is used to display a single apartment. It is
  * very much like the single post page, except a big slider
  * may be placed on top showing uploaded images
  *
  * @package The Beauty Salon
  *
  */
  global $framework, $theme_options;
?>
<div <?php post_class( 'attachment-layout-default' ) ?>>
	<div class='box smallpadding image-container'>
		<div class='image'>
			<?php echo wp_get_attachment_image( get_the_ID(), 'rf_col_1' ) ?><div class='shadow'></div>
		</div>
		<div class='shadow-full'></div>
	</div>

	<div class='box'>
		<h1 class='title'><?php the_title() ?></h1>

		<div class='content'>
			<?php
				$content = get_the_content();
				echo wpautop( $content );
			?>
		</div>
	</div>
</div>


