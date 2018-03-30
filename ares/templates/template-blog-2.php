<?php
$count = 0;

if (have_posts()) : while (have_posts()) : the_post();
    $count++;
    $image_thumb = '';
    							
    if(has_post_thumbnail(get_the_ID(), 'blog_half_ft'))
    {
        $image_id = get_post_thumbnail_id(get_the_ID());
        $image_thumb = wp_get_attachment_image_src($image_id, 'blog_half_ft', true);
    }
    
    $post_categories = wp_get_post_categories( get_the_ID() );
    $cats = array();
        
    foreach($post_categories as $c){
        $cat = get_category( $c );
        
        if($pp_featured_cat != $cat->term_id)
        {
        	$cats[0] = array( 'name' => $cat->name );
        	break;
        }
    }
?>
    
    
    <!-- Begin each blog post -->
    <div class="post_wrapper half<?php if($count%2==0) { ?> last<?php } ?>" <?php if(empty($featured_posts_arr) && $count<3) { ?>style="margin-top:15px;"<?php } ?>>
    
    	<?php
    		if(!empty($image_thumb))
    		{
    	?>
    	
    	<div class="post_img">
    		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
    			<img src="<?php echo $image_thumb[0]; ?>" alt="" class=""/>
    		</a>
    		
    		<?php
    		    if(isset($cats[0]))
    		    {
    		?>
    		
    		<div class="caption_cat half"><?php echo $cats[0]['name']; ?></div>
    		
    		<?php
    		    }
    		    else
    		    {
    		?>
    		
    		<div class="caption_cat half" style="visibility:hidden">None</div>
    		
    		<?php
    			}
    		?>

    	</div>
    	
    	<?php
    		}
    	?>
    	
    	<div class="post_inner_wrapper half" <?php if(empty($image_thumb)) { ?>style="margin-top:10px"<?php } ?>>
    	
    	<div class="post_header_wrapper half">
    		<div class="post_header half">
    			<h4>
    				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    			</h4>
    		</div>
    		
    		<br class="clear"/>
    		
    		<div class="post_detail half">
    		
    		<?php echo _e( 'Posted by', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
    		<a href="<?php the_permalink(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
    		</div>
    	</div>
    	
    	<br class="clear"/><br/><hr/>
    	
    	<?php the_excerpt(); ?>
    	<a href="<?php the_permalink(); ?>"><?php echo _e( 'Read more', THEMEDOMAIN ); ?> →</a>
    	
    	</div>
    	
    </div>
    <!-- End each blog post -->
    
    <?php
    if($count%2==0 OR ($count%2==1 && $count==count( $posts )))
    {
    ?>
    <br class="clear"/>
    <?php
    }
    ?>

<?php endwhile; endif; ?>

<div class="pagination">
     <?php 
     	if (function_exists("wpapi_pagination")) {
     		wpapi_pagination($wp_query->max_num_pages); 
     	}
     ?>
 </div>