<?php
if (!defined('ABSPATH')) exit();

get_header();

$show_post_metadata = TMM::get_option("blog_single_show_all_metadata");
$blog_single_show_category = TMM::get_option("blog_single_show_category");
$blog_single_show_date = TMM::get_option("blog_single_show_date");
$blog_single_show_author = TMM::get_option("blog_single_show_author");
$blog_single_show_tags = TMM::get_option("blog_single_show_tags");
$blog_single_show_comments = TMM::get_option("blog_single_show_comments");
$blog_single_show_fb_comments = TMM::get_option("blog_single_show_fb_comments");
$blog_single_show_bio = TMM::get_option("blog_single_show_bio");
$blog_single_show_likes = TMM::get_option("blog_single_show_likes");
$blog_single_show_social_share = TMM::get_option("blog_single_show_social_share");
$blog_single_show_posts_nav = TMM::get_option("blog_single_show_posts_nav");
$blog_single_show_related_posts = TMM::get_option("blog_single_show_related_posts");

$post_types = array(
	'audio',
	'video',
	'quote',
	'gallery',
);

if (have_posts()) {
	while (have_posts()) {
		the_post();
		TMM_Helper::tmm_set_post_views($post->ID);

		$post_template = get_post_meta($post->ID, 'post_template', 1);

		$post_class = (isset($post_template) && $post_template == 'alternate') ? 'full-width-alternate' : 'full-width';

		$post_pod_type = get_post_format();
		$post_type_values = get_post_meta($post->ID, 'post_type_values', true);

		$user = get_userdata($post->post_author);

		if (!in_array($post_pod_type, $post_types)) {
			$post_pod_type = 'default';
		}

		if ($blog_single_show_posts_nav !== '0') {
			$next_post = get_next_post();
			$prev_post = get_previous_post();

			$next_post_url = "";
			$prev_post_url = "";

			$next_post_title = "";
			$prev_post_title = "";

			if (is_object($next_post)) {
				$next_post_url = get_permalink($next_post->ID);
				$next_post_title = $next_post->post_title;
			}

			if (is_object($prev_post)) {
				$prev_post_url = get_permalink($prev_post->ID);
				$prev_post_title = $prev_post->post_title;
			}
		}

		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		    <div class="post <?php echo esc_attr($post_class); ?>">

				<?php get_template_part('article', $post_pod_type); ?>

			    <header class="entry-header">

				    <h2 class="entry-title"><?php the_title(); ?></h2>

				    <?php if ($show_post_metadata !== '0') { ?>

					    <div class="entry-meta">

						    <?php  if ($blog_single_show_date !== '0') { ?>
							    <span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y'))); ?>"><?php echo get_the_date(TMM::get_option('date_format')); ?></a></span>
						    <?php } ?>
						    <?php  if ($blog_single_show_author !== '0' && get_the_author()) { ?>
							    <span class="byline"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
						    <?php } ?>
						    <?php  if ($blog_single_show_tags !== '0' && get_the_tags()) { ?>
							    <span class="tags-links"><?php the_tags('', ', ', ''); ?></span>
						    <?php } ?>
						    <?php  if ($blog_single_show_comments !== '0') { ?>
							    <span class="comments-link"><a href="<?php the_permalink(); ?>#comments"><?php echo get_comments_number(); ?></a></span>
						    <?php } ?>

					    </div>

				    <?php } ?>


			    </header>

			    <div class="entry-content">

				    <?php
				    the_content();
				    tmm_link_pages();
				    tmm_layout_content($post->ID, 'default');
				    ?>

			    </div>

			    <?php if ($show_post_metadata !== '0') { ?>

				    <footer class="entry-footer">
					    <?php  if ($show_post_metadata !== '0') { ?>

						    <div class="left">
							    <?php  if ($blog_single_show_category !== '0') { ?>
								    <span class="cat-links"><?php echo get_the_category_list(', '); ?></span>
							    <?php } ?>
						    </div>

						    <div class="right">
							    <?php  if ($blog_single_show_likes !== '0') { ?>
									<?php echo TMM_Helper::get_post_like($post->ID); ?>
							    <?php } ?>
						    </div>

					    <?php } ?>
				    </footer>

				<?php } ?>

		    </div><!--/ .post-->

			<?php if ($blog_single_show_social_share !== '0') { ?>

			<div class="social-shares">

				<?php TMM_Helper::display_share_buttons('', $post->ID); ?>

			</div><!--/ .social-shares-->

			<?php } ?>

			<?php if ($blog_single_show_posts_nav !== '0') { ?>

				<div class="single-nav clearfix">

					<?php if (!empty($prev_post_url)){ ?>

						<a title="<?php _e('Previous post', 'diplomat'); ?>" href="<?php echo esc_url($prev_post_url); ?>" class="prev">
							<?php _e('Previous article', 'diplomat'); ?>
							<b><?php echo $prev_post_title; ?></b>
						</a>

					<?php } ?>

					<?php if (!empty($next_post_url)){ ?>

						<a title="<?php _e('Next post', 'diplomat'); ?>" href="<?php echo esc_url($next_post_url); ?>" class="next">
							<?php _e('Next article', 'diplomat'); ?>
							<b><?php echo $next_post_title; ?></b>
						</a>

					<?php } ?>

				</div><!--/ .single-nav-->

			<?php } ?>

			<?php if ($blog_single_show_bio !== '0' && is_object($user)){ ?>

				<div class="author-holder clearfix">

					<div class="author-thumb">
						<div class="avatar">
							<?php echo get_avatar($user->user_email, 100); ?>
						</div>
					</div>

					<div class="author-about">
						<h4 class="author-title"><?php echo $user->display_name ?></h4>
						<p><?php echo stripslashes($user->description); ?></p>
						<div class="author-contacts">
							<?php TMM_Users::my_author_social_links($user->ID); ?>
						</div>

					</div><!--/ .author-about-->

				</div><!--/ .author-holder-->

			<?php } ?>

			<?php
			if ($blog_single_show_related_posts !== '0'){

				$posts_per_page = TMM::get_option('related_posts_count');

				if (!isset($posts_per_page)) {
					$posts_per_page = 4;
				}

				$this_id = $post->ID;
				$tags = wp_get_post_tags($this_id);

				if (!empty($tags) && is_array($tags)) {

					$tag_ids = array();

					foreach ($tags as $tag ) {
						$tag_ids[] = (int) $tag->term_id;
					}

					if (!empty($tag_ids)) {

						$args = array(
							'tag__in' => $tag_ids,
							'post_type' => get_post_type($this_id),
							'showposts' => $posts_per_page,
							'ignore_sticky_posts'=> 1,
							'orderby' => 'rand',
							'post__not_in' => array($this_id)
						);
						if (TMM::get_option('blog_single_show_related_posts_with_image')){
							$args['meta_key'] = '_thumbnail_id';
						}

						$my_query = get_posts($args);

						if (!empty($my_query)) {
							?>

							<div class="related-article-area">

								<h2 class="section-title"><?php _e('Related Articles', 'diplomat'); ?></h2>

								<div class="row">

									<?php
									$wp_query->posts = $my_query;

									foreach ($my_query as $post) {
										setup_postdata($post);

										get_template_part( 'article', 'related-post' );

									}
									wp_reset_postdata();
									?>

								</div><!--/ .row-->

							</div><!--/ .related-article-area-->

							<?php
						}
					}
				}

			}
			?>

		    <?php if ($blog_single_show_comments !== '0'){ ?>

			    <section class="section section-content">

				    <?php comments_template(); ?>

				    <?php
					if ($blog_single_show_fb_comments !== '0' && !empty($blog_single_show_fb_comments)) { ?>
					    <div class="separator"></div>
					    <div class="fb-comments" data-href="<?php the_permalink() ?>" data-width="100%"></div>
				    <?php } ?>

			    </section><!--/ .section-->
		    <?php } ?>

        </article><!--/ .entry-->

		<?php
    }
}
?>

<?php get_footer(); ?>
