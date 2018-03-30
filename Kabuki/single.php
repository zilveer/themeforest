<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="content">
<div class="post-wrapper">
				<div class="post-header">
				<h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				</div><div class="clearleft"></div><!--.postHeader-->
			<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

			<article>
				
				<div class="post-edit"><?php edit_post_link(); ?></div>
				<?php if ( has_post_thumbnail() ) { /* loads the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>'; } ?>
				<div class="post-content">
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
				</div><!--.post-content-->
			</article>

			<div id="post-meta">
				<?php  if( has_tag()) { echo "<span class='meta-img' id='meta-tag'><img src='"; echo get_stylesheet_directory_uri(); echo "/images/misc_icons/grey_light/tag_fill_12x12.png' alt='tag' /></span><span class='post-tags'>"; the_tags('',', ',''); echo "</span><div class='meta-delimiter'></div>"; } ?>
					<span class="meta-img"><img src="<?php echo get_stylesheet_directory_uri().'/images/misc_icons/grey_light/clock_12x12.png' ?>" alt="date" /></span>
					<span class="meta-date"><?php $arc_year = get_the_time('Y'); $arc_month = get_the_time('m'); $arc_day = get_the_time('d');  echo '<a href="'.get_day_link($arc_year, $arc_month, $arc_day).'">'.get_the_date().'</a>'; ?></span>
					<span class="meta-img"><img src="<?php echo get_stylesheet_directory_uri().'/images/misc_icons/grey_light/user_9x12.png' ?>" alt="author" /></span>
					<span class="meta-author"><?php the_author_posts_link(); ?></span>
					<?php if(in_category(range(0,9999))) { echo "<span class='meta-img'><img src='"; echo get_stylesheet_directory_uri(); echo "/images/misc_icons/grey_light/list_12x11.png' alt='category' /></span>"; } ?>
					<span class="meta-cat"><?php the_category(', '); ?></span>
					<span class="meta-img"><img src="<?php echo get_stylesheet_directory_uri().'/images/misc_icons/grey_light/comment_alt2_stroke_11x12.png' ?>" alt="comments" /></span>
					<span class="meta-comment-count"><?php $nocomm = __('No comments', 'satori'); $onecomm = __('comment', 'satori'); $comm = __('comments', 'satori'); comments_popup_link($nocomm, '1 '.$onecomm, '% '.$comm, 'meta-comments-count'); ?></span>
				<div class="clearboth"></div>
			</div><!--#post-meta-->

			<?php /* If a user fills out their bio info, it's included here */ ?>
			<div id="post-author">
				<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); /* This avatar is the user's gravatar (http://gravatar.com) based on their administrative email address */  } ?>
				<div id="authorDescription">
					<h3><?php echo __('Posted by', 'satori').' '; the_author() ?></h3>
					<?php the_author_meta('description') ?> <?php echo __('View all posts by', 'satori').' '; the_author_posts_link() ?> 
				</div><!--#author-description -->
			</div><!--#post-author-->

		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>

	<?php endwhile; /* end loop */ ?>
</div><!--#post-wrapper-->
</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>