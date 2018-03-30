<?php
/**
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

$page_style = get_post_meta($current_page_id, 'page_style', true);
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
}

$add_sidebar = FALSE;
if($page_style == 'Right Sidebar')
{
	$add_sidebar = TRUE;
	$page_class = 'sidebar_content';
}
else
{
	$page_class = "full_width";
}
get_header(); 
?>

		<?php
			if(has_post_thumbnail($current_page_id, 'full'))
			{
			    $image_id = get_post_thumbnail_id($current_page_id); 
			    $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
			    $pp_page_bg = $image_thumb[0];
			}
			else
			{
				$pp_page_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
			}
		?>
		<script type="text/javascript"> 
			jQuery.backstretch( "<?php echo $pp_page_bg; ?>", {speed: 'slow'} );
		</script>

		<!-- Begin content -->
		<div id="page_content_wrapper">
		
			<div class="inner">
			
			<!-- Begin main content -->
			<div class="inner_wrapper">
			    
			    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
			    	
			    	<div class="sidebar_content <?php echo $page_class; ?>">
			    	
			    			<h1 class="cufon"><?php the_title(); ?></h1><br/><hr/>
			    			<?php do_shortcode(the_content()); ?>
			    			
			    	</div>

			    <?php endwhile; ?>
			    
			    <?php
			    	if($add_sidebar)
			    	{
			    ?>
			    	<div class="sidebar_wrapper">
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
			    <?php
			    	}
			    ?>
			
			</div>
			<!-- End main content -->
			</div>
			<br class="clear"/>
			
			</div>
			<br class="clear"/><br class="clear">
			</div>

<?php get_footer(); ?>