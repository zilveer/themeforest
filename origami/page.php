<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */

 global $pagename;
 $wpsc_found = FALSE;
 if ($pagename != '')
    {
         if ($pagename == 'products-page')
            $wpsc_found = TRUE;
    }
    
 if (isset($obj->post_type) && $obj->post_type == 'wpsc-product')
    $wpsc_found = TRUE;
    
 if (isset($obj->taxonomy) && $obj->taxonomy == 'wpsc_product_category')
    $wpsc_found = TRUE; 
    
 if ($wpsc_found === TRUE)
    {
        include('template-wpsc.php');
        return;   
    }
 
get_header(); ?>
    <div id="page-title" class="clearfix">
      <div class="container_12">
        <div class="grid_12">
          <h1><?php the_title();?></h1>
        </div>
      </div>
    </div>
    <?php if (get_option('themeteam_origami_enable_breadcrumbs') == 'true'){ ?>
	<div id="breadcrumbs" class="clearfix">
		<div class="container_12">
	    	<div class="grid_12">
			<?php breadcrumbs(get_option('themeteam_origami_enable_breadcrumbs')); ?>
			</div>
		</div>
	</div>
	<?php } ?>
    <div id="container" class="clearfix">
    	<div class="container_12">
        	<div class="col1-layout">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php
					$themeteam_header_text = get_post_meta($post->ID, "themeteam_header_text", true); 
			    	$themeteam_video_embed = get_post_meta($post->ID, "themeteam_video_embed", true); 
			    	$themeteam_video_height = get_post_meta($post->ID, "themeteam_video_height", true); 
			    	$themeteam_video_width = get_post_meta($post->ID, "themeteam_video_width", true); 
			    	$video_width = $themeteam_video_width + 2;
			    	$video_height = $themeteam_video_height + 2;
		    	?>
            		<div class="pageTemp">
				    	<?php if($themeteam_video_embed) { ?>
		
		          			<div class="imgframe grid_12" style="width:<?php echo $video_width; ?>;height:<?php echo $video_height; ?>;">
		          				<?php echo $themeteam_video_embed; ?><span class="frame"><span><span><span><span><span class="empty"><em class="play"> </em></span></span></span></span></span></span>
		          			</div>
		                 	<div class="clear"> </div>
		              	<?php } else if (has_post_thumbnail()) { ?>
		             		<div class="imgframe grid_12">
								<?php the_post_thumbnail('thumb940'); ?>
		             			 <span class="frame"><span><span><span><span><span class="empty"><em class="zoom"> </em></span></span></span></span></span></span>
		             		</div>
		                 	<div class="clear"> </div>
		              	<?php } ?>
			  			<div class="entry"><?php the_content(''); ?></div>
			  			
					</div>
				<?php endwhile; endif; ?>
				
      		</div>
      		<div class="clear"> </div>
    	</div>
    </div>
    <!-- div#container end -->

<?php get_footer(); ?>
