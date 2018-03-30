<?php
/**
 * Template Name: Page Sidebar
 * The main template file for display page.
 *
 * @package WordPress
*/


/**
*	Get Current page object
**/
$page = get_page($post->ID);


/**
*	Get current page id
**/
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

get_header(); 
?>
		<br class="clear"/>

		<!-- Begin content -->
		<div id="content_wrapper">
			
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">
				
				<div class="sidebar_content">
				
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
						
							<h2 class="widgettitle header"><?php the_title(); ?></h2>
							
							<div class="page_fullwidth">			
								<?php do_shortcode(the_content()); ?>
							</div>

					<?php endwhile; ?>
					
				</div>
				
				<div class="sidebar_wrapper">
    				<?php
					    $twitter_id = get_option('pp_twitter_username');
					    $pp_facebook_username = get_option('pp_facebook_username');
					    
					    if(!empty($twitter_id) OR !empty($pp_facebook_username)):
					?>
					<div class="social_profile">
					    <div class="profile">
					    	<a href="<?php echo $pp_facebook_username; ?>">
					    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_facebook.png" alt="" class="alignleft social"/>
					    	</a>
					    	<h4><?php pp_facebook_fans(); ?></h4>
					    	<span class="count">fans</span>
					    </div>
					
					    <?php
					    	$pp_twitter_consumer_key = get_option('pp_twitter_consumer_key');
					    	$pp_twitter_consumer_secret = get_option('pp_twitter_consumer_secret');
					    	$pp_twitter_access_token = get_option('pp_twitter_access_token');
					    	$pp_twitter_access_token_secret = get_option('pp_twitter_access_token_secret');
					    ?>
					    <?php
					    	if(!empty($pp_twitter_consumer_key) && !empty($pp_twitter_consumer_secret) && !empty($pp_twitter_access_token) && !empty($pp_twitter_access_token_secret))
					    	{
					    ?>
					    <div class="profile">
					    	<a href="http://twitter.com/<?php echo $twitter_id; ?>">
					    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_twitter.png" alt="" class="alignleft social"/>
					    	</a>
					    	<h4><?php pp_twitter_followers($pp_twitter_consumer_key, $pp_twitter_consumer_secret, $pp_twitter_access_token, $pp_twitter_access_token_secret); ?></h4>
					    	<span class="count">followers</span>
					    </div>
					    <?php
					    	}
					    ?>
					    
					     <br class="clear"/>
					</div>
					<?php
					    endif; 
					?>
    				
    				<div class="ads125_wrapper">
					    <?php
					        $pp_side_banner = get_option('pp_side_banner');
					    
					        if(!empty($pp_side_banner))
					        {
					        	echo stripslashes($pp_side_banner);
					        }
					    ?>
					</div>
    			
    				<div class="sidebar">
    				
    					<div class="content">
    				
    						<ul class="sidebar_widget">
    						<?php dynamic_sidebar($page_sidebar); ?>
    						</ul>
    					
    					</div>
    			
    				</div>
    				<br class="clear"/>

    			</div>
    			
    			<br class="clear"/>
				
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
			</div>
			
		</div>
		<!-- End content -->

<br class="clear"/>
<?php get_footer(); ?>