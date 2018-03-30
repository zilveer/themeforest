<?php global $unf_options; ?>
<div class="theloop blog-loop">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php
		// IF VIDEO FORMAT
		if ( has_post_format( 'video' )) {
			get_template_part( 'library/formats/video');
		}
		// IF IMAGE FORMAT
		else if ( has_post_format( 'image' )) {
			get_template_part( 'library/formats/image');
		}
		// IF LINK FORMAT
		else if ( has_post_format( 'link' )) {
			get_template_part( 'library/formats/link');
		}
		// IF QUOTE FORMAT
		else if ( has_post_format( 'quote' )) {
			get_template_part( 'library/formats/quote');
		}
		// IF GALLERY FORMAT
		else if ( has_post_format( 'gallery' )) {
			get_template_part( 'library/formats/gallery');
		}
		// STANDARD POST FORMAT
		else {
			get_template_part( 'library/formats/standard');
		}?>
    <?php endwhile;
    endif; ?>
</div>