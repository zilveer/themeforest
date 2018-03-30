<?php get_header(); ?>
<?php 
global $theme_shortname;
 
$cat_title ='';
$cat_desc ='';

$post_number = get_option($theme_shortname . '_cat_posts');
if(is_category())  {  $cat_title = single_cat_title('',false); } 

if(is_search())  {  $cat_title = __('Search results ','Bonanza');
$cat_desc = get_search_query(); }

if(is_tag()) { 
    $cat_title = __('Tag ','Bonanza');
    $cat_desc = single_tag_title(); 
 }
 
if(is_author()) {
global $wp_query;
$curauth = $wp_query->get_queried_object(); 
$cat_title = __('Posted by ','Bonanza'); 	   
$cat_desc =  $curauth->nickname; 
 }                                             
   
if(is_day()) {
    $cat_title = __('Posted on ','Bonanza');
    $cat_desc = get_the_time('F jS, Y'); 
} 
 
if(is_month()) {
    $cat_title = __('Posted on ','Bonanza');
    $cat_desc = get_the_time('F, Y'); 
}

if(is_year()) {
    $cat_title = __('Posted in ','Bonanza');
    $cat_desc = get_the_time('Y'); 
} 
?>

<?php global $query_string;
      query_posts($query_string . "&showposts=" . $post_number); ?>
    
<div id="index-page">
    <div id="left" <?php if ( 'portfolio' == get_post_type() ) echo 'class="full-width"'; ?>>
		<div id="head-line"> 
	    <?php if($cat_title <> '') { ?><h1 class="title"><?php echo $cat_title;  ?></h1><?php } ?>
	    </div>
		<?php if (have_posts()) : ?>
			
			<?php if ( 'portfolio' == get_post_type() ) { ?>
				  	<div class="galleries">
						<div class="<?php echo $theme_options['portfolio_layout'] . '-column'; ?>">
			<?php } ?>
			
			<!-- The Loop -->
    		<?php while (have_posts()) : the_post(); ?>
					
				<?php if ( 'portfolio' == get_post_type() ) { ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
						<div class="gallery-image-wrap">
					            <?php if ( has_post_thumbnail() ) { ?>

									<?php $thumbid = get_post_thumbnail_id($post->ID);
										$img = wp_get_attachment_image_src($thumbid,'full');
										$img['title'] = get_the_title($thumbid); ?>

											<a href="<?php the_permalink(); ?>" class="portfolio-item-permalink">
											  <?php the_post_thumbnail("gallery-thumb"); ?>
											</a>

										<a href="<?php echo $img[0]; ?>" class="zoom-icon" rel="shadowbox" ></a>

				        		<?php } else { ?>
										<a href="<?php the_permalink(); ?>">
										<?php echo '<img src="'.get_stylesheet_directory_uri().'/images/no-portfolio-archive.png" class="wp-post-image"/>'; ?>			</a>
								<?php } ?>
						<?php $args = array(
							'post_type' 	=> 'attachment',
							'numberposts' 	=> -1,
							'post_status' 	=> null,
							'post_parent' 	=> $post->ID,
							'post_mime_type'=> 'image',
							'orderby'		=> 'menu_order',
							'order'			=> 'ASC'
						);
						$attachments = get_posts($args); 
						$count = count($attachments); ?>
										
						<?php if ( $count > 1 ) { ?>
							<span class="image-count"><?php echo $count . __(' Images', 'Arcturus'); ?></span>
						<?php } ?>
						</div>
						<h2 class="gallery-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_excerpt(); ?>
					</article><!-- #post-<?php the_ID(); ?> -->

				<?php } else {
					 
    	 	
					get_template_part( 'content', get_post_format() ); 
				
				} 
				
				endwhile;?>
				
				<?php if ( 'portfolio' == get_post_type() ) { ?>
							</div>
						</div> <!-- .galleries -->
				<?php } ?>
			
			<?php if(function_exists('wp_pagenavi')) { ?>
				 
					<?php wp_pagenavi(); ?>
				
				<?php } else { ?> 
						
					<?php get_template_part( 'navigation', 'index' ); ?>
						 
				<?php } else : ?>
			
					<?php get_template_part( 'no-results', 'index' ); ?>
			
				<?php endif; wp_reset_query(); 
			?>
       
	</div> <!--  end #left  -->
    
<?php if ( 'portfolio' != get_post_type() ) get_sidebar(); ?> 
</div>   <!--  end #index-page  -->
<?php get_footer();?>