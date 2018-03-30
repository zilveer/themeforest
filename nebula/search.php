<?php
/**
 * The main template file for display blog page.
 *
 * @package WordPress
*/

get_header(); 
?>

<br class="clear"/>
<div id="page_caption">
	<div class="page_title_wrapper">
		<h1><?php printf( __( 'Search Results for &quot;%s&quot;', '' ), '' . get_search_query() . '' ); ?></h1>
		<?php echo dimox_breadcrumbs(); ?>
	</div>
</div>
<br class="clear"/>

<?php
$page_sidebar = 'Search Sidebar';
?>

<!-- Begin content -->

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div class="sidebar_content full_width nomargintop">

    			<div class="sidebar_content">
    			
    			<div class="search_form_wrapper">
	    			<h5><?php _e( 'New Search', THEMEDOMAIN ); ?></h5>
	    			<?php _e( "If you didn't find what you were looking for, try a new search.", THEMEDOMAIN ); ?><br/><br/>
	    			
	    			<form class="searchform" role="search" method="get" action="<?php echo home_url(); ?>">
						<input style="width:96%" type="text" class="field searchform-s" name="s" value="<?php the_search_query(); ?>" title="<?php _e( 'Type and hit enter', THEMEDOMAIN ); ?>">
					</form>
    			</div>
				
				<br/><br/>
					
<?php

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
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
		    	if(!empty($image_thumb))
		    	{
		    		$small_image_url = wp_get_attachment_image_src($image_id, 'gallery_3', true);
		    ?>
		    
		    <div class="one_third">
			    <div class="post_img small medium">
			    	<a href="<?php the_permalink(); ?>">
			    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class="" style="width:<?php echo $small_image_url[1]; ?>px;height:<?php echo $small_image_url[2]; ?>px;"/>
			    		<div class="mask">
	                    	<div class="mask_circle">
			                    <i class="fa fa-share"/></i>
							</div>
		                </div>
			    	</a>
			    </div>
		    </div>
		    
		    <?php
		    	}
		    ?>
	    
			<div <?php if(!empty($image_thumb)) { ?>class="two_third last"<?php } else { ?>class="one"<?php } ?>>
			    <div class="post_header">
			    	<h6><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
				    
				    <?php
				    	the_excerpt();
				    ?>
			    </div>
			</div>
			
			<hr/>
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
			<a class="read_more" href="<?php the_permalink(); ?>"><?php echo _e( 'Read More', THEMEDOMAIN ); ?></a>
	    </div>
	    
	</div>

</div>
<br class="clear"/>
<!-- End each blog post -->

<?php endwhile; endif; ?>

    	<?php
		    if($wp_query->max_num_pages > 1)
		    {
		    	if (function_exists("wpapi_pagination")) 
		    	{
		?>
				<br class="clear"/>
		<?php
		    	    wpapi_pagination($wp_query->max_num_pages);
		    	}
		    	else
		    	{
		    	?>
		    	    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
		    	<?php
		    	}
		    ?>
		    <div class="pagination_detail">
		     	<?php
		     		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		     	?>
		     	<?php _e( 'Page', THEMEDOMAIN ); ?> <?php echo $paged; ?> <?php _e( 'of', THEMEDOMAIN ); ?> <?php echo $wp_query->max_num_pages; ?>
		     </div>
		     <?php
		     }
		?>
    		
    	</div>
    	
    		<div class="sidebar_wrapper">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar($page_sidebar); ?>
    					</ul>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    	</div>
    	
    </div>
    <!-- End main content -->

</div>  
<br class="clear"/><br/><br/>
<?php get_footer(); ?>