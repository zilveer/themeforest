<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/


get_header(); 
?>

<br class="clear"/>

<div id="page_caption">
	<div class="page_title_wrapper">
		<h1><?php _e( 'Page Not Found', THEMEDOMAIN ); ?></h1>
		<?php echo dimox_breadcrumbs(); ?>
	</div>
</div>
<br class="clear"/>

<!-- Begin content -->
<div id="page_content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
	    	<div class="sidebar_content full_width">
	    		<div class="search_form_wrapper">
	    			<h5><?php _e( 'New Search', THEMEDOMAIN ); ?></h5>
	    			<?php _e( "Oops, This Page Could Not Be Found. Try a new search.", THEMEDOMAIN ); ?><br/><br/>
	    			
	    			<form class="searchform" role="search" method="get" action="<?php echo home_url(); ?>">
						<input style="width:96%" type="text" class="field searchform-s" name="s" value="<?php the_search_query(); ?>" title="<?php _e( 'Type and hit enter', THEMEDOMAIN ); ?>">
					</form>
    			</div>	    		
	    	</div>
	    	
	    	<br class="clear"/><br/>
	    		<h4><?php _e( 'Or try to browse our latest posts instead?', THEMEDOMAIN ); ?></h4><br/><br/>
	    		
	    		<div id="blog_grid_wrapper" class="sidebar_content full_width">
	    		<?php
				global $more; $more = false; 
				
				$query_string ="items=6&post_type=post&paged=$paged";
				query_posts($query_string);
				$key = 0;
				
				if (have_posts()) : while (have_posts()) : the_post();
					
					$animate_layer = $key+7;
					$image_thumb = '';
												
					if(has_post_thumbnail(get_the_ID(), 'large'))
					{
					    $image_id = get_post_thumbnail_id(get_the_ID());
					    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
					}
				?>
				
				<!-- Begin each blog post -->
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<div class="post_wrapper grid_layout">
					
						<?php
					    	if(!empty($image_thumb))
					    	{
					    		$small_image_url = wp_get_attachment_image_src($image_id, 'blog_g', true);
					    ?>
					    
					    <div class="post_img grid">
					    	<a href="<?php the_permalink(); ?>">
					    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class="" style="width:<?php echo $small_image_url[1]; ?>px;height:<?php echo $small_image_url[2]; ?>px;"/>
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
					    
					    <div style="width:100%;margin:auto;">
						    <div class="post_header grid">
						    	<h6><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
						    </div>
						    <div style="height:10px"></div>
						    
						    <?php
						    	echo pp_substr(get_the_excerpt(), 90);
						    ?>
						    
						    <br/><br/>
					    	<hr/>
						    <div class="post_detail">
							    <a href="<?php comments_link(); ?>"><?php comments_number(__('0 Comment', THEMEDOMAIN), __('1 Comment', THEMEDOMAIN), __('% Comments', THEMEDOMAIN)); ?></a> / <?php echo get_the_time(THEMEDATEFORMAT); ?>
							</div>
							<a class="read_more" href="<?php the_permalink(); ?>"><?php echo _e( 'Read More', THEMEDOMAIN ); ?></a>
							<br class="clear"/><hr/>
					    </div>
					    
					</div>
				
				</div>
				<!-- End each blog post -->
				
				<?php $key++; ?>
				<?php endwhile; endif; ?>
	    		</div>
    		
    	</div>
    	
    </div>
</div>
<br class="clear"/><br/>
<?php get_footer(); ?>