<?php

/**
 * Post heade template
 *
 * @package wpv
 */

global $post;

$show = !has_post_format('status') && !has_post_format('aside');

if($show):
	$link = has_post_format('link') ?
				get_post_meta($post->ID, 'wpv-post-format-link', true) :
				get_permalink();
	?>
		<header class="single">
			<div class="content">
				<?php if($news && !isset($post_data['media'])) WpvTemplates::post_format_icon($format); ?>
				<h3>
					<a href="<?php echo $link ?>" title="<?php the_title_attribute()?>"><?php the_title(); ?></a>
				</h3>
			</div>
		</header>
	<?php
endif;