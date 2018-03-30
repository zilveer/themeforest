<?php
/**
 * @package berg-wp
 */
?>
<?php

$sidebar = '';
$posts_size_content = '';
$post_meta = get_post_meta(get_the_id());
$sidebar_settings = isset($post_meta['sidebar_posts'][0]) ? $post_meta['sidebar_posts'][0] : 'default';
$post_width = isset($post_meta['post_width'][0]) ? $post_meta['post_width'][0] : 'default';
$class = '';

if ($sidebar_settings == 'disabled' || YSettings::g('berg_post_sidebar') == 1) {
	// $post_width = $post_meta['post_width'][0];

	if ($post_width != 'default') {
		if ($post_width == 'post_width_1') {
			$class = 'col-md-8 col-md-offset-2';
		} else if($post_width == 'post_width_2') {
			$class = 'col-md-6 col-md-offset-3';
		} else if($post_width == 'post_width_3') {
			$class = 'col-md-10 col-md-offset-1';
		}
	} else {
		if (YSettings::g('berg_post_content_width') == 1) {
			$class = 'col-md-8 col-md-offset-2';
		} else if(YSettings::g('berg_post_content_width') == 2) {
			$class = 'col-md-6 col-md-offset-3';
		} else if(YSettings::g('berg_post_content_width') == 3) {
			$class = 'col-md-10 col-md-offset-1';
		}
	}
} 
// else {
// 	$class = 'col-md-10 col-md-offset-1';	
// }

// if (isset($post_meta['sidebar_posts'][0])) {
	// $sidebar_settings = $post_meta['sidebar_posts'][0];

	if ($sidebar_settings != 'default') {
		if ($sidebar_settings == 'disabled') {
			$sidebar = 'hidden';
			// $class = '';
		}

		if ($sidebar_settings == 'right') {
			$sidebar = 'sidebar-right';
			$class = 'col-md-8';
		}

		if ($sidebar_settings == 'left') {
			$sidebar = 'sidebar-left';
			$class = 'col-md-8 content-right';
		}
	} else {
		if (YSettings::g('berg_post_sidebar') == 1) {
			$sidebar = 'hidden';
			// $class = '';
		} else if(YSettings::g('berg_post_sidebar') == 2) {
			$sidebar = 'sidebar-left';
			$class = 'col-md-8 content-right';
		} else if(YSettings::g('berg_post_sidebar') == 3) {
			$sidebar = 'sidebar-right';
			$class = 'col-md-8';
		}
	}
// }

$thumbnail = has_post_thumbnail(); 
?>
<section id="post" class="section-scroll main-section blog">
	<div class="container-fluid">
		<div class="row">
			<article class="post">
				<?php if($thumbnail) : ?>
				<a href="#" class="img-post ">
					<figure>
						<?php the_post_thumbnail('blog_thumb'); ?>
					</figure>
				</a>
				<?php endif;?>
				<div class="post-content <?php if (!$thumbnail) : ?>post-no-thumbnail<?php endif;?>">
					<div class="post-wrapper">
						<div class="post-wrapper-inner"> 
							<?php if(YSettings::g('posts_show_date') == 1): ?>
								<span class="date"><?php berg_wp_posted_on(); ?></span>
							<?php endif; ?>
	
							<?php //the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
							<?php the_title( sprintf( '<h3 class="entry-title">', esc_url( get_permalink() ) ), '</h3>' ); ?>

							<?php echo get_post_details('', 'posts', get_the_ID()); ?>
							<?php
								$post_meta = get_post_meta(get_the_ID());
								if (isset($post_meta['social_media_share'][0])) {
									$social_sharer = $post_meta['social_media_share'][0];

									if ($social_sharer != 'default') {
										if ($social_sharer == 'enabled') {
											get_template_part('social', 'share');
										}
									} else {
										if (YSettings::g('berg_sharer_posts') == 1) {
											get_template_part('social', 'share'); 
										}
									} 
								} else {
									if (YSettings::g('berg_sharer_posts') == 1) {
										get_template_part('social', 'share'); 
									}
								}
							?>
							<?php //get_template_part('social', 'share'); ?>

							<?php edit_post_link( __( 'Edit', 'BERG'), '<span class="edit-link">', '</span>' ); ?>
						</div>
					</div>
				</div>
			</article>
			<div class="container">
				<div class="row">
					<div class="post-text col-xs-12 <?php echo $class; ?>">
						<article>
							<?php the_content(); ?>
							<?php if (YSettings::g('posts_show_tag') == 1): ?>
								<div class="berg-tags"><?php the_tags(); ?></div>
							<?php endif; ?>
						</article>
					</div>
					<div class="col-xs-12 col-md-4 widget-sidebar <?php echo $sidebar;?>">
						<?php get_sidebar('posts'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>