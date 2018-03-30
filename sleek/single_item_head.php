<?php
	$theme_settings = sleek_theme_settings();
	$post_format = get_post_format();
?>

<div class="single__header">



	<?php

	if( !get_post_meta( get_the_ID(), 'show_featured_image', true ) ){
		echo '<div class="format-head"></div>'; // print empty for consistent layout
	}else{

		switch ($post_format) {
			case 'video':
				get_template_part('format_head', 'video');
				break;

			case 'audio':
				get_template_part('format_head', 'audio');
				break;

			case 'image':
				get_template_part('format_head', 'image');
				break;

			case 'quote':
				get_template_part('format_head', 'quote');
				break;

			case 'status':
				get_template_part('format_head', 'status');
				break;

			case 'aside':
				get_template_part('format_head', 'aside');
				break;

			case 'link':
				get_template_part('format_head', 'link');
				break;

			default:
				// Standard post has no format head.
				// Featured image is printed below, as intro content.
				// get_template_part('format_head');
				break;
		}

	}

	?>



	<!--  Post Heading Block  -->
	<div class="post__head">

		<?php

			if( get_post_meta( get_the_ID(), 'show_author_badge', true ) ){
				get_template_part('post_badge');
			}

			get_template_part('post_meta');

			if(
				$post_format != 'image'
				&& $post_format != 'link'
			){
				echo '<h1>'.get_the_title().'</h1>';
			}

		?>

		<?php if( $theme_settings->posts['post_navigation'] ): ?>

			<!-- posts nav -->
			<div class="post__navigation">

				<?php

				$same_cat = $theme_settings->posts['post_navigation_category'];

				if( is_rtl() ){
					previous_post_link( '%link',  __('Previous', 'sleek') . '<i class="icon-arrow-right"></i> ', $same_cat );
					next_post_link( '%link', '<i class="icon-arrow-left"></i>' . __('Next', 'sleek'), $same_cat );
				}else{
					previous_post_link( '%link', '<i class="icon-arrow-left"></i> ' . __('Previous', 'sleek'), $same_cat );
					next_post_link( '%link', __('Next', 'sleek') . ' <i class="icon-arrow-right"></i>', $same_cat );
				}

				?>
			</div>
			<!-- /posts nav -->

		<?php endif; ?>

	</div>
	<!--  /Post Heading Block  -->



</div> <!-- /post head -->
