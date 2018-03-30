<?php
if (have_posts()) : while (have_posts()) : the_post();
    $count++;
    $image_thumb = '';
    							
    if(has_post_thumbnail(get_the_ID(), 'blog_ft'))
    {
        $image_id = get_post_thumbnail_id(get_the_ID());
        $image_thumb = wp_get_attachment_image_src($image_id, 'blog_ft', true);
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
    <div class="post_wrapper" <?php if(empty($featured_posts_arr) && $count==1 && is_home()) { ?>style="margin-top:15px;"<?php } ?>>
    
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
    		
    		<div class="caption_cat"><?php echo $cats[0]['name']; ?></div>
    		
    		<?php
    		    }
    		    else
    		    {
    		?>
    		
    		<div class="caption_cat" style="visibility:hidden">None</div>
    		
    		<?php
    			}
    		?>
    	</div>
    	
    	<?php
    		}
    	?>
    	
    	<div class="post_inner_wrapper" <?php if(empty($image_thumb)) { ?>style="margin-top:10px"<?php } ?>>
    	
    	<div class="post_header_wrapper">
    		<div class="post_header">
    			<h3>
    				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    			</h3>
    		</div>
    		
    		<br class="clear"/>
    		
    		<div class="post_detail">
    		
    		<?php echo _e( 'Posted by', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
    		<a href="<?php the_permalink(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
    		</div>
    	</div>
    	
    	<?php
    	$pp_blog_display_social = get_option('pp_blog_display_social');
    	
    	if(!empty($pp_blog_display_social)):
    	?>
    	<div class="post_social">
    		<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink()); ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=268239076529520" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe>
    		
    		<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-text="<?php the_title(); ?>" data-url="<?php echo get_permalink(); ?>">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
    	</div>
    	<?php
    	endif; ?>
    	
    	<br class="clear"/><br/><hr/>
    	
    	<?php
    		$pp_blog_display_full = get_option('pp_blog_display_full');
    		
    		if(!empty($pp_blog_display_full))
    		{
    			the_content();
    		}
    		else
    		{
    			the_excerpt();
    	?>
    	
    			<a href="<?php the_permalink(); ?>"><?php echo _e( 'Read more', THEMEDOMAIN ); ?> →</a>
    	
    	<?php
    		}
    	?>
    	
    	
    	</div>
    	
    </div>
    <!-- End each blog post -->

<?php endwhile; endif; ?>

<div class="pagination">
     <?php 
     	if (function_exists("wpapi_pagination")) {
     		wpapi_pagination($wp_query->max_num_pages); 
     	}
     ?>
 </div>