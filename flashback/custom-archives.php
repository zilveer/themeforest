<?php
/*

Template Name: Archives

*/

get_header();

$page_title = get_post_meta(get_the_ID(), 'si_page_title', true);
$page_icon = get_post_meta(get_the_ID(), 'si_page_icon', true);

?>

<div id="page-<?php the_ID(); ?>" class="inner">
	
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
	
	<div id="archives">
	
		<div class="one-third">
		
			<h4><?php _e("Latest Projects", "shorti"); ?></h4>
			
			<ul class="all_projects">
			
			<?php
			query_posts("post_type=project&orderby=date&posts_per_page=25");
            if (have_posts()) : while (have_posts()) : the_post();
            ?>
            
	            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            
            <?php endwhile; endif; wp_reset_query(); ?>
            
            </ul>
		
		</div>
		
		<div class="one-third">
		
            <div class="bump">
            
	            <h4><?php _e("Latest Posts", "shorti"); ?></h4>
				
				<ul><?php wp_get_archives("type=postbypost&sort_column=menu_order'"); ?></ul>
			
			</div>
			
			<div class="bump">
			
				<h4><?php _e("Pages", "shorti"); ?></h4>
			
				<ul><?php wp_list_pages("title_li="); ?></ul>
			
			</div>
			
		</div>
		
		<div class="one-third column-last">
		
			<div class="bump">
			
				<h4><?php _e("Posts By Month", "shorti"); ?></h4>
				
				<ul><?php wp_get_archives("type=daily"); ?></ul>
			
			</div>
			
			<div class="bump">
			
				<h4><?php _e("Posts By Month", "shorti"); ?></h4>
				
				<ul><?php wp_get_archives("type=monthly"); ?></ul>
			
			</div>
			
			<div class="bump">
			
				<h4><?php _e("Posts By Year", "shorti"); ?></h4>
				
				<ul><?php wp_get_archives("type=yearly"); ?></ul>
			
			</div>
		
		</div>
	
	</div>

</div>



<?php get_footer(); ?>