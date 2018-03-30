<?php
/*
 * Single post template
 *
*/

get_header();
the_post();

global $numpages;

$thumbnail_id = get_post_thumbnail_id($post->ID);
$thumbnail_url = wp_get_attachment_url($thumbnail_id);
$comments_count = wp_count_comments(get_the_ID());

?>

<div id="main-content">
	<div class="container inner">
		<div class="col-sm-8 blogs">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

				<header class="entry-header">
					<h2 class="entry-title"><?php the_title(); ?> </h2>
				</header><!-- .entry-header -->

				<div class="post-meta">
					<span class="post-date base_clr_bg sticky-post-date">
						<?php $date = date_parse(get_the_date()); ?>
						<span class="day"><?php echo $date["day"]; ?></span>
						<span class="month"><?php echo strftime("%b", mktime(0, 0, 0, $date["month"])); ?></span>
						<span class="year"><?php echo $date["year"]; ?></span>
					</span>
					<span class="post-author"><i class="fa fa-user"></i> <?php echo get_the_author(); ?></span>
					<span class="post-cat"><i class="fa fa-folder-o"></i><?php echo get_the_category_list(", "); ?></span>
				</div>

				<div class="entry-content">
					<?php if ($thumbnail_url) : ?>
						<div class="post-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div><!--end .post-thumbnail-->
					<?php endif; ?>

					<?php the_content(); ?>

				</div>

				<?php
				if ($numpages > 1): ?>
					<div class="posts-links-box">
						<?php wp_link_pages(array(
								'before' => '<div class="page-link">' . '',
								'after' => '</div>',
								'link_before' => '<div class="page-link-num base_clr_brd">' . '',
								'link_after' => '</div>'
							));
						?>
					</div><!--end post links-->
				<?php endif; ?>

				<div class="tags-box">
					<?php

						$tag_list = get_the_tag_list( '', __( ' ', 'vivaco' ) );
						if ( $tag_list ) { echo '<i class="icon icon-shopping-08"></i> <span class="tags-links">' . $tag_list . '</span>'; }

						$temp_post = get_next_post();
						$next_post_title = !empty( $temp_post ) ? $temp_post->post_title : '';

						$temp_post = get_previous_post();
						$prev_post_title = !empty( $temp_post ) ? $temp_post->post_title : '';

						if (strlen($next_post_title) > MAX_NAV_TITLE_LENGTH){
							$next_post_title = substr($next_post_title,0, MAX_NAV_TITLE_LENGTH)."...";
						};

						if (strlen($prev_post_title) > MAX_NAV_TITLE_LENGTH){
							$prev_post_title = substr($prev_post_title,0, MAX_NAV_TITLE_LENGTH)."...";
						};

					?>
				</div><!--end tags-->

				<div class="entry-navigation aligncenter">
					<?php previous_post_link('<div class="prev-post"><i class="icon icon-arrows-03"></i><strong>%link</strong></div>', $prev_post_title); ?>
						<div class="share-box">
							<p class="title">
								<a href="javascript:;" class="share facebook img-circle" onClick="FacebookShare()"><i class="fa fa-facebook"></i></a>
								<a href="javascript:;" class="share twitter img-circle" onClick="TwitterShare()"><i class="fa fa-twitter"></i></a>
								<a href="javascript:;" class="share google img-circle" onClick="GoogleShare()"><i class="fa fa-google-plus"></i></a>
								<a href="javascript:;" class="share linkedin img-circle" onClick="LinkedinShare()"><i class="fa fa-linkedin"></i></a>
								<a href="javascript:;" class="share pinterest img-circle" onClick="PinterestShare()"><i class="fa fa-pinterest"></i></a>
							</p>
						</div>
					<?php next_post_link('<div class="next-post"><strong>%link</strong><i class="icon icon-arrows-04"></i></div>', $next_post_title); ?>
				</div><!--end navigation & social sharing-->

				<div class="author-box">
					<div class="avatar-wrap"><span class="avatar rounded"><?php echo get_avatar( get_the_author_meta('email') , 100 ); ?></span></div>
						<span class="author name"><strong><?php echo get_the_author_meta('nickname'); ?></strong></span>
							<p>
								<?php echo get_the_author_meta('description'); ?>
							</p>
				</div><!--end author bio-->

				<h4 class="comments-count"><?php printf(__('This entry has %s replies','vivaco'), '<span class="comments-count base_clr_txt">' . $comments_count->approved . '</span>');?></h4>
				<?php comments_template(); ?>
				<!--end comments-->

			</article>

			</div><!-- end col-sm-8 -->

		<?php get_sidebar(); ?>

	</div><!--end container-inner-->

</div><!--end main-content-->

<?php get_footer(); ?>
