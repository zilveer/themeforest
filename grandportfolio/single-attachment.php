<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header();

global $photography_topbar;

/**
*	Get current page id
**/

$current_page_id = $post->ID;

//If display feat content
$tg_blog_feat_content = kirki_get_option('tg_blog_feat_content');

/**
*	Get current page id
**/

$current_page_id = $post->ID;

//Include custom header feature
get_template_part("/templates/template-post-header");
?>
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
<?php
if (have_posts()) : while (have_posts()) : the_post();
?>
						
<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
	    
	    <div class="post_content_wrapper">
	    
	    	<?php
	    		$large_image_url = wp_get_attachment_image_src($current_page_id, 'original', true);
			?>
			
			<img src="<?php echo esc_url($large_image_url[0]); ?>" alt="" class="" />
			
	    </div>
	    
	</div>

</div>
<!-- End each blog post -->


<?php
if (comments_open($post->ID)) 
{
?>
<br class="clear"/>
<div class="fullwidth_comment_wrapper">
	<?php comments_template( '', true ); ?>
</div>
<?php
}
?>

<?php endwhile; endif; ?>
    	
    	</div>
    
    </div>
    <!-- End main content -->
   
</div>

<br class="clear"/><br/><br/>
</div>
<?php get_footer(); ?>