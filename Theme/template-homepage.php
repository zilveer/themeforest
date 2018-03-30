<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>
<!-- Start Featured -->
  	<div id="featured">
	
	<div id="featured_left">
	<h1><?php echo get_option('cs_welcome_h1'); ?></h1>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h2><?php echo get_option('cs_welcome_text'); ?></h2>
	</div>
	
	<!-- Start Slider Wrapper -->
	<div id="featured_right">
		
		<div id="slider">
			
      	<ul>	
			<?php 
				$ycategory = get_catid(get_option('cs_portfolio'));
				$yposts = get_option('cs_portfolio_slider');
			?>
		<?php $the_query = new WP_Query('showposts='.$yposts.'&cat='.$ycategory); while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<?php $thumb = get_post_meta($post->ID, 'thumb-small', true); ?>
			<li><a href="<?php echo get_permalink('8'); ?>"><img src="<?php echo $thumb; ?>" width="304" height="225" alt="<?php the_title_attribute(); ?>" /></a></li>
		<?php endwhile; ?>	
		</ul> 

 		</div>
		
	</div>
	<!-- End Slider Wrapper -->
		
	</div>
	<!-- End Featured -->
	
	<!-- Start Featured Sub -->
	<? if (get_option('cs_imgbox_left_img') || get_option('cs_imgbox_center_img') || get_option('cs_imgbox_right_img')) { ?>
	<div id="featured_sub_wrapper">
	<table width="912" border="0" cellpadding="0" cellspacing="0">
  	<tr>
    <td align="left" valign="top"><div><a href="<?php echo get_option('cs_imgbox_left_url'); ?>"><img src="<?php echo get_option('cs_imgbox_left_img'); ?>" alt="" width="294" height="100" id="Sub1" /></a></div></td>
    <td align="center" valign="top"><div><a href="<?php echo get_option('cs_imgbox_center_url'); ?>"><img src="<?php echo get_option('cs_imgbox_center_img'); ?>" alt="" width="294" height="100" id="Sub2" /></a></div></td>
    <td align="right" valign="top"><div><a href="<?php echo get_option('cs_imgbox_right_url'); ?>"><img src="<?php echo get_option('cs_imgbox_right_img'); ?>" alt="" width="294" height="100" id="Sub3" /></a></div></td>
	</tr>
	</table>
	</div>
	<? } ?>
	<!-- End Featured Sub -->
	
	<!-- Start Content Rounded Corners Top -->
	<div id="content_rt"></div>
	<!-- End Content Rounded Corners Top -->
	
	<!-- Start Content -->
	<div id="content">
	
		<!-- Start Content Left -->
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	  <div id="content_left" class="content">
	  	<div class="content_left_h"><h3><?php if (function_exists('the_subheading')) { the_subheading(); } else { the_title(); } ?></h3></div>
		<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
	  </div>
	    <?php endwhile; endif; ?>
		<!-- End Content Left -->
		
		<!-- Start Content Right -->
	 	<? if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Widget') ) : ?>
		
		<? endif; ?>
		<!-- End Content Right -->
		
		<br style="clear:both" /> <!-- DO NOT REMOVE THIS LINE!!! -->		
	</div>
	<!-- End Content -->
	
	<!-- Start Content Rounded Corners Bottom -->
	<div id="content_rb"></div>
	<!-- End Content Rounded Corners Bottom -->


<?php get_footer(); ?>
