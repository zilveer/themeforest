<?php
/*

Template Name: Services

*/

get_header();

if (have_posts()) : while ( have_posts() ) : the_post();

$service_slug = get_post_meta(get_the_ID(), 'si_page_service_slug', true);

$page_title = get_post_meta(get_the_ID(), 'si_page_title', true);
$page_second = get_post_meta(get_the_ID(), 'si_page_second', true);
$page_icon = get_post_meta(get_the_ID(), 'si_page_icon', true);

?>

<div id="page_<?php echo $post->post_name; ?>" class="inner">

	<?php if ($page_title != "yes") : ?>
	
		<h1 id="page_title">
		
			<?php if ($page_icon != "") : ?><i class="page_icon <?php echo $page_icon; ?>"></i><?php endif; ?>
			
			<?php the_title(); ?>
		
		</h1>
	
	<?php endif; ?>
	
	<?php if ($post->post_content != '') : ?>
	
		<?php the_content(); ?>
		
		<div id="divider"></div>
	
	<?php endif; ?>

<?php endwhile; endif; wp_reset_query(); ?>

	<?php  if (have_posts()) : ?>
	
	<ul id="services" class="<?php echo $service_slug; ?>">
	
		<?php
			
			query_posts("services=".$service_slug."&ignore_sticky_posts=1post_type=service");
			while (have_posts()) : the_post(); 
			
			$icon = get_post_meta(get_the_ID(), 'si_service_icon', true);
			$last = get_post_meta(get_the_ID(), 'si_service_last', true);
			$btn_url = get_post_meta(get_the_ID(), 'si_service_button_url', true);
			$btn_text = get_post_meta(get_the_ID(), 'si_service_button_text', true);
			
		?>
		
			<li class="service one-third<?php if ($last == "yes") { echo " column-last"; } ?>">
			
				<i class="font_icon <?php echo $icon; ?>"></i>
				
				<h4><?php the_title(); ?></h4>
				
				<?php the_content(); ?>
				
				<?php if ($btn_url != "" && $btn_text != "") : ?><a href="<?php echo $btn_url; ?>" class="btn" target="_blank"><?php echo $btn_text; ?></a><?php endif; ?>
			
			</li>
			
		<?php endwhile; ?>
	
	<?php endif; wp_reset_query(); ?>
	
	</ul>
	
	<?php if ($page_second) { 
	
	echo "<div id='divider'></div>";
	echo apply_filters('meta_content', do_shortcode( stripslashes( $page_second ) )); 
	
	} ?>
	
</div>

<?php get_footer(); ?>