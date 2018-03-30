<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header(); 

?>

<br class="clear"/>

<div id="page_caption">
	<div class="page_title_wrapper">
    	<h1><?php the_title() ?></h1>
		<?php echo dimox_breadcrumbs(); ?>
	</div>
</div>
<br class="clear"/>

<?php
//If display feat content
$pp_blog_feat_content = get_option('pp_blog_feat_content');

/**
*	Get current page id
**/

$current_page_id = $post->ID;
$post_gallery_id = '';
if(!empty($pp_blog_feat_content))
{
	$post_gallery_id = get_post_meta($current_page_id, 'post_gallery_id', true);
}

/*
    Check if post item has featured gallery
*/
if(!empty($post_gallery_id))
{
    //Run flow gallery data
    wp_enqueue_script("script-flow-gallery", get_template_directory_uri()."/templates/script-flow-gallery.php?gallery_id=".$post_gallery_id."&location=portfolio", false, THEMEVERSION, true);
?>
<div class="single_portfolio_gallery">
	<i class="fa fa-spinner fa-spin"></i>
    <div id="imageFlow" class="single_portfolio">
    	<div class="text">
    		<div class="title"></div>
    		<div class="legend"></div>
    	</div>
    </div>
    
    <input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>
    <?php
    	$pp_enable_reflection = get_option('pp_enable_reflection');
    ?>
    <input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo $pp_enable_reflection; ?>"/>
</div>	

<?php
}
?>
<div id="page_content_wrapper" <?php if(!empty($post_gallery_id)) { ?>style="margin-top:0"<?php }?>>
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

    		<div class="sidebar_content">
					
<?php

global $more; $more = false; # some wordpress wtf logic

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(!empty($pp_blog_feat_content) && has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	}
?>
						
<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
	    
	    <div class="post_content_wrapper">
	    
	    	<?php
		    	if(!empty($image_thumb) && empty($post_gallery_id))
		    	{
		    		$small_image_url = wp_get_attachment_image_src($image_id, 'large', true);
		    ?>
		    
		    <div class="post_img">
		    	<a class="img_frame" href="<?php echo $small_image_url[0]; ?>">
		    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
		    	</a>
		    </div>
		    
		    <?php
		    	}
		    ?>
	    
		    <div class="post_header">
		    	<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5><br/>
			    <?php
			    	the_content();
			    	wp_link_pages();
			    ?>
		    </div>
		    <div class="post_excerpt post_tag" style="text-align:left">
		    	<i class="fa fa-tags"></i>
		    	<?php the_tags('', ', ', '<br />'); ?>
		    </div>
		    
		    <div class="post_detail">
			    <?php
					$author_ID = get_the_author_meta('ID');
			    	$author_name = get_the_author();
			    	$author_url = get_author_posts_url($author_ID);
					
					if(!empty($author_name))
					{
				?>
					<i class="fa fa-user marginright"></i><?php echo _e( 'By', THEMEDOMAIN ); ?>&nbsp;<a href="<?php echo $author_url; ?>"><?php echo $author_name; ?></a>
				<?php
					}
		    	?>
		    	<?php echo _e( 'On', THEMEDOMAIN ); ?>&nbsp;<?php echo get_the_time(THEMEDATEFORMAT); ?>&nbsp;
			    <i class="fa fa-comment marginright"></i><a href="<?php comments_link(); ?>"><?php comments_number(__('0 Comment', THEMEDOMAIN), __('1 Comment', THEMEDOMAIN), __('% Comments', THEMEDOMAIN)); ?></a>
			</div>
			<br class="clear"/>
		    
		    <?php
				//Get Social Share
				get_template_part("/templates/template-share");
			?>
			
	    </div>
	    
	</div>

</div>
<!-- End each blog post -->

<?php
    $pp_blog_display_related = get_option('pp_blog_display_related');
    
    if($pp_blog_display_related)
    {
?>

<?php
//for use in the loop, list 9 post titles related to post's tags on current post
$tags = wp_get_post_tags($post->ID);

if ($tags) {

    $tag_in = array();
  	//Get all tags
  	foreach($tags as $tags)
  	{
      	$tag_in[] = $tags->term_id;
  	}

  	$args=array(
      	  'tag__in' => $tag_in,
      	  'post__not_in' => array($post->ID),
      	  'showposts' => 3,
      	  'ignore_sticky_posts' => 1,
      	  'orderby' => 'date',
      	  'order' => 'DESC'
  	 );
  	$my_query = new WP_Query($args);
  	$i_post = 1;
  	
  	if( $my_query->have_posts() ) {
  	  	echo '<h5><span>'.__( 'You might also like', THEMEDOMAIN ).'</span></h5><br class="clear"/>';
 ?>
 	<ul class="posts blog">
    	 <?php
    	 	global $have_related;
    	    while ($my_query->have_posts()) : $my_query->the_post();
    	    $have_related = TRUE; 
    	 ?>
    	    <li>
    	    	<?php
    	    		if(has_post_thumbnail($post->ID, 'thumbnail'))
    				{
    					$image_id = get_post_thumbnail_id($post->ID);
    					$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
    	    	?>
    	    	<div class="post_circle_thumb">
    	    		<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img class="post_ft" src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>"/></a>
    	    	</div>
    	    	<?php
    	    		}
    	    	?>
    	    	<a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br/>
    	    	<span class="post_attribute"><?php echo date(THEMEDATEFORMAT, strtotime($post->post_date)); ?></span>
    		</li>
    	  <?php
    	  		if($i_post%3==0)
				{
					echo '<br class="clear"/>';
				}
    	  		
    	  		$i_post++;
    			endwhile;
    			    
    			wp_reset_query();
    	  ?>
      
  	</ul>
    <hr/><br class="clear"/><br/>
<?php
  	}
}
?>

<?php
    } //end if show related
?>

<?php comments_template( '' ); ?>

<?php endwhile; endif; ?>
						
    	</div>

    		<div class="sidebar_wrapper">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar('Single Post Sidebar'); ?>
    					</ul>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    
    </div>
    <!-- End main content -->
   
</div>

<?php
	global $prev_post;
	
    //Get More Story Module
    $pp_blog_more_story = get_option('pp_blog_more_story');
    
    if(!empty($prev_post) && !empty($pp_blog_more_story))
    {
    	$post_more_image = '';
    	if(has_post_thumbnail(get_the_ID(), 'blog_g'))
    	{
    	    $post_more_image_id = get_post_thumbnail_id($prev_post->ID);
    	    $post_more_image = wp_get_attachment_image_src($post_more_image_id, 'blog_g', true);
    	}
?>
<div id="post_more_wrapper" class="hiding">
    <a href="javascript:;" id="post_more_close"><i class="fa fa-times-circle"></i></a>
    <h5><span><?php _e( 'More Story', THEMEDOMAIN ); ?></span></h5><br/>
    <?php
    	if(!empty($post_more_image))
    	{
    ?>
    <div class="post_img grid">
	    <a href="<?php echo get_permalink($prev_post->ID); ?>">
	    	<img src="<?php echo $post_more_image[0]; ?>" alt="" class="" style="width:<?php echo $post_more_image[1]; ?>px;height:<?php echo $post_more_image[2]; ?>px;"/>
	    	<div class="mask">
            	<div class="mask_circle">
	            	<i class="fa fa-share"/></i>
	    		</div>
	        </div>
	    </a>
	</div>
    <?php
    	}
    ?>
    <a class="post_more_title" href="<?php echo get_permalink($prev_post->ID); ?>">
    	<h6 style="margin-top:-5px"><?php echo $prev_post->post_title; ?></h6>
    </a>
    <?php echo pp_substr(strip_tags(strip_shortcodes($prev_post->post_content)), 90); ?>
    
    <br/><br/>
	<hr/>
	<div class="post_detail">
	    <?php echo date(THEMEDATEFORMAT, strtotime($prev_post->post_date)); ?>
	</div>
	<a class="read_more" href="<?php echo get_permalink($prev_post->ID); ?>"><?php echo _e( 'Read More', THEMEDOMAIN ); ?></a>
	<br class="clear"/><hr/>
</div>
<?php
    }
?> 
<br class="clear"/><br/>
<?php get_footer(); ?>