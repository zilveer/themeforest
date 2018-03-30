<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>
<?php while(have_posts()): the_post(); ?>

<div class="container fix">
		
	<div id="page-title">
		<h2><?php echo wpb_page_title(); ?></h2>
	</div><!--/page-title-->
	
	<div id="content">
		<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>
			<?php get_template_part('_page-image'); ?>
			<div class="pad">
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
				<div class="sitemap fix">
					<div class="one-third">
						<h4 class="heading"><?php _e('Pages','feather'); ?></h4>
						<ul><?php wp_list_pages("title_li=" ); ?></ul>								
					</div>
					<div class="one-third">
						<h4 class="heading"><?php _e('All Blog Posts:','feather'); ?></h4>
						<ul><?php $archive_query = new WP_Query('showposts=1000'); while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
								(<?php comments_number('0', '1', '%'); ?>)
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
					<div class="one-third last">
						<h4 class="heading"><?php _e('Feeds','feather'); ?></h4>
						<ul>
							<li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS','feather'); ?></a></li>
							<li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed','feather'); ?></a></li>
						</ul>
						<h4 class="heading"><?php _e('Categories','feather'); ?></h4>
						<ul><?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0&feed=RSS&title_li='); ?></ul>
						<h4 class="heading"><?php _e('Archives','feather'); ?></h4>
						<ul><?php wp_get_archives('type=monthly&show_post_count=true'); ?></ul>
					</div>
				</div><!--/sitemap-->
			</div>
		</article>
	</div><!--/content-->

</div><!--/container-->

<?php endwhile;?>
<?php get_footer(); ?>