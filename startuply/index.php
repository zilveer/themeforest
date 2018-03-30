<?php
/*
 * The main template file
 *
*/
get_header();

?>

<div id="main-content">
	<div class="container inner">
		<div class="col-md-8 col-sm-12 blogs">
			<?php
			if ( have_posts() ) :

				// Start the Loop.
				while ( have_posts() ) : the_post();

					$thumb_id = get_post_thumbnail_id($post->ID);
					$post_thumbnail_url = wp_get_attachment_url($thumb_id);
					$comments_count = wp_count_comments(get_the_ID());
					$post_title = get_the_title() ? get_the_title() : get_the_ID();
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

					$show_date = (startuply_option('blog_dates', '') == '' ? true : false);
					$show_meta = (startuply_option('blog_meta', '') == '' ? true : false);

					$blog_content = startuply_option('blog_content_type', '');
					$blog_tpl = startuply_option('blog_img_tpl', '');
					$max_title_len = (startuply_option('blog_title_len', '') == '' ? 50 : startuply_option('blog_title_len', ''));

					if (strlen($post_title) > $max_title_len) {$post_title = substr($post_title, 0, $max_title_len)."...";};
					if($post_thumbnail_url){ $col = "col-sm-7"; } else { $col = "col-sm-12"; };

						// Big images blog layout
						if ( (is_sticky($post->ID) && $blog_tpl != 'small_img' ) || ($blog_tpl == 'big_img' ) ) : ?>

							<?php //get_template_part( 'content', 'sticky-post' );?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
								<?php if ($show_date): ?>
									<span class="post-date base_clr_bg sticky-post-date">
										<?php $date = date_parse(get_the_date()); ?>
										<span class="day"><?php echo $date["day"]; ?></span>
										<span class="month"><?php echo strftime("%b", mktime(0, 0, 0, $date["month"])); ?></span>
										<span class="year"><?php echo $date["year"]; ?></span>
									</span>
								<?php endif; ?>

								<div class="entry-content row">
									<div class="col-sm-12">
										<div class="thumb-wrapper post-thumbnail">
											<?php if($post_thumbnail_url): ?>
												<img src="<?php echo aq_resize( $post_thumbnail_url, BLOG_IMAGE_LARGE_W, BLOG_IMAGE_LARGE_H, true ); ?>" alt="" />
											<?php endif; ?>
										</div><!--end post-thumbnail-->

										<div class="title-wrap">
											<h2 class="entry-title sticky-img-title">
												<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo $post_title; ?></a>
											</h2>
										</div><!--end post-title-->

										<?php if ($show_meta): ?>
											<div class="post-meta post-meta-sticky">
												<span class="post-comments"><i class="fa fa-comment-o"></i><a href="<?php echo get_comments_link(); ?>"><?php echo $comments_count->approved; ?></a></span>
												<span class="post-author"><i class="fa fa-user"></i><?php echo get_the_author(); ?></span>
												<span class="post-cat"><i class="fa fa-folder-o"></i><?php echo get_the_category_list(", "); ?></span>
											</div><!--end post-meta-->
										<?php endif; ?>

										<?php
											//Theme options check on how to show posts content
											if ($blog_content == '' || $blog_content == 'excerpt'){
												the_excerpt();
											} else {
												the_content();
											}
										?>

									</div>
								</div>
							</article>

						<?php

						// Small/default images blog layout
						else :

						?>

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
								<?php if ($show_date): ?>
									<span class="post-date base_clr_bg sticky-post-date">
										<?php $date = date_parse(get_the_date()); ?>
										<span class="day"><?php echo $date["day"]; ?></span>
										<span class="month"><?php echo strftime("%b", mktime(0, 0, 0, $date["month"])); ?></span>
										<span class="year"><?php echo $date["year"]; ?></span>
									</span>
								<?php endif; ?>

								<div class="entry-content row">

									<?php if($post_thumbnail_url): //show thumbnail only if present ?>

										<div class="col-sm-5">
											<div class="post-thumbnail">
												<a href="<?php the_permalink(); ?>" data-pretty="prettyPhoto[port_gal]" title="<?php the_title(); ?>">
													<img src="<?php echo aq_resize( $post_thumbnail_url, BLOG_IMAGE_SMALL_W, BLOG_IMAGE_SMALL_H, true ); ?>" alt="" />
													<span class="entry-image-overlay"></span>
												</a>
											</div>
										</div><!--end post-thumbnail col-->

									<?php endif; ?>

									<div class="<?php echo $col;?>">

										<header class="entry-header">
											<h2 class="entry-title">
												<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo $post_title; ?></a>
											</h2>
										</header><!-- .entry-header -->

										<?php if ($show_meta): ?>
											<div class="post-meta">
												<span class="post-comments"><i class="fa fa-comment-o"></i><a href="<?php echo get_comments_link(); ?>"><?php echo $comments_count->approved; ?></a></span>
												<span class="post-author"><i class="fa fa-user"></i><?php echo get_the_author(); ?></span>
												<span class="post-cat"><i class="fa fa-folder-o"></i><?php echo get_the_category_list(", "); ?></span>
											</div><!-- end post meta -->
										<?php endif; ?>

										<?php
											//Theme options check on how to show posts content
											if ($blog_content == '' || $blog_content == 'excerpt'){
												the_excerpt();
											} else {
												the_content();
											}
										?>

									</div> <!-- end post contents -->
								</div>
							</article>

						<?php endif; //end if sticky check ?>

				<?php endwhile; //end main_loop?>

				<?php
				global $wp_query;
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<div class="entry-navigation paging aligncenter">
						<?php vsc_pagination(2); ?>
					</div>
				<?php endif; //navigation check ?>

			<?php endif; //end if have_pots() check ?>

		</div><!-- end col-sm-8 blogs-->

		<?php get_sidebar(); ?>

	</div><!--end container-inner-->
</div><!--end main-content-->

<?php get_footer(); ?>
