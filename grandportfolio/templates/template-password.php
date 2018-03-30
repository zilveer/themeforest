<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/

session_start();

/**
*	Get current page id
**/
$current_page_id = '';

/**
*	Get Current page object
**/

$page = get_page($post->ID);

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if password protected
$gallery_password = get_post_meta($current_page_id, 'gallery_password', true);

if(!empty($gallery_password) && (!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id])))
{
	$notice_text = '';
	if(isset($_POST['gallery_password']))
	{
		//check gallery password
		$portfolio_password = get_post_meta($current_page_id, 'gallery_password', true);
		
		if($_POST['gallery_password'] != $portfolio_password)
		{
			$notice_text = esc_html__('Error Password is incorrect', 'grandportfolio-translation' );
		}
		else
		{	
			$_SESSION['gallery_page_'.$current_page_id] = $current_page_id;
			
			$permalink = get_permalink($current_page_id);
			header("Location: ".$permalink);
			exit;
		}
	}
	
	$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
	grandportfolio_set_homepage_style('fullscreen');
	
	get_header(); 
	?>
	
	<br class="clear"/>
	
	<?php
	if(has_post_thumbnail($current_page_id, 'original'))
	{
		$image_id = get_post_thumbnail_id($current_page_id); 
		$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
	?>
	<?php
	}
	?>
	<div class="password_overlay"></div>
	<div class="password_container" <?php if(isset($image_thumb[0]) && !empty($image_thumb[0])) { ?>style="background-image:url(<?php echo esc_url($image_thumb[0]); ?>);"<?php }?>>
		<div class="password_wrapper">
			<!-- Begin main content -->
		    <div class="vertical_center_wrapper transparentbg" style="text-align:center">
			    <div class="overlay_gallery_wrapper">
				    <div class="overlay_gallery_border">
					    <div class="overlay_gallery_content">
							
							<h1><?php the_title(); ?></h1>
							<hr class="title_break"/>
							<?php
								$gallery_excerpt = get_the_excerpt();
				
						    	if(!empty($gallery_excerpt))
						    	{
						    ?>
						    	<hr class="title_break"/>
						    	<div class="page_tagline">
						    		<?php echo wp_kses_post($gallery_excerpt); ?>
						    	</div>
						    <?php
						    	}
						    ?>
					    	
					        <p><strong><?php esc_html_e('To continue it please enter your password below', 'grandportfolio-translation' ); ?></strong></p><br/>
					        	
					        <?php 
					            if(!empty($notice_text))
					            {
					        ?>
					            	<span class="error"><?php echo esc_html($notice_text); ?></span>
					        <?php
					            }
					        ?>
					        <form id="gallery_password_form" method="post" action="<?php echo get_permalink($current_page_id); ?>">
					            <input id="gallery_password" name="gallery_password" type="password" placeholder="<?php echo esc_attr(esc_html__('Password', 'grandportfolio-translation' )); ?>"/><br/><br/>
					            <input type="submit" value="<?php echo esc_html__('Authenticate', 'grandportfolio-translation' ); ?>" class="login_gallery"/>
					        </form>
					    </div>
				    </div>
			    </div>
		    </div>
		</div>
	</div>
	<?php get_footer(); ?>
<?php

exit;
}
?>