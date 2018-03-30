<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$tags = wp_get_post_tags( $post->ID );
	if(!empty($tags)) { ?>
		<div class="post-tags">
			<ul>
				<?php foreach($tags as $tag) : ?>
					<li class="post-tags-item">
						<a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php } ?>