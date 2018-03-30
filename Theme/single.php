<?php get_header(); ?>


	
	<!-- Start Featured Under -->
  	<div id="featured_under">
	
	<div id="featured_under_h">
	<h1>BLOG - LATEST NEWS </h1>
	</div>
	
	</div>
	<!-- End Featured -->
	
	<!-- Start Content Rounded Corners Top -->
	<div id="content_rt"></div>
	<!-- End Content Rounded Corners Top -->
	
	<!-- Start Content -->
	<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<!-- Start Portfolio Wrapper -->
	<div id="content_blog_wrapper" class="content">
	
		<!-- Start Content -->
	  <div class="content_blog">
		<h4><strong><?php the_title(); ?></strong></h4>
		<p><em><?php the_time('l, F jS, Y') ?></em></p>
		<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
	  </div>
		<!-- End Content -->
		
				<br style="clear:both" /> <!-- DO NOT REMOVE THIS LINE!!! -->	
		
		<div class="content_blog_sep"><img src="<?php bloginfo('template_url'); ?>/graphic/sep.gif" alt=""/></div>
		
		
		<div class="content_blog_icon_line">
			<a href="http://delicious.com/post?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&notes=<?php the_excerpt(); ?>"><img src="<?php bloginfo('template_url'); ?>/social/delicious_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
			<a href="http://www.designfloat.com/submit.php?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/social/designfloat_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
			<a href="http://digg.com/submit?phase=2&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&bodytext=<?php the_excerpt(); ?>"><img src="<?php bloginfo('template_url'); ?>/social/digg_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
			<a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/social/facebook_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
			<a href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php the_permalink(); ?>&title=<?php the_title(); ?>&annotation=<?php the_excerpt(); ?>"><img src="<?php bloginfo('template_url'); ?>/social/google_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
			<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=<?php the_excerpt(); ?>"><img src="<?php bloginfo('template_url'); ?>/social/linkedin_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
			<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/social/rss_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
			<a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/social/stumbleupon_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
			<a href="http://technorati.com/faves?add=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/social/technorati_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
			<a href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/social/twitter_32.png" alt="" width="32" height="32" class="blog_icons" /></a>
		</div>

		<?php comments_template(); ?>
			
	</div>
	<!-- End Portfolio Wrapper -->	
			
		<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>
	</div>
	<!-- End Content -->
	
	<!-- Start Content Rounded Corners Bottom -->
	<div id="content_rb"></div>
	<!-- End Content Rounded Corners Bottom -->
	
<?php get_footer(); ?>
