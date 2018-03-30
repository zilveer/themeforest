<?php
/**
 * Template Name: Page Split Screen
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header();

$grandportfolio_topbar = grandportfolio_get_topbar();

/**
*	Get current page id
**/

$current_page_id = $post->ID;

/**
*	Get current page id
**/

$current_page_id = $post->ID;
$post_gallery_id = '';
if(!empty($tg_blog_feat_content))
{
	$post_gallery_id = get_post_meta($current_page_id, 'post_gallery_id', true);
}

//Include custom header feature
$grandportfolio_screen_class = grandportfolio_get_screen_class();
grandportfolio_set_screen_class('split');

$grandportfolio_page_content_class = grandportfolio_get_page_content_class();
grandportfolio_set_page_content_class('split');

get_template_part("/templates/template-header");
?>
	<div class="post_caption">
	    <h1><?php echo the_title(); ?></h1>
	    <?php
	    	//Get current page tagline
			$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
	    
		    if(!empty($page_tagline))
		    {
		?>
			<hr class="title_break"/>
		    <div class="page_tagline">
		    	<?php echo wp_kses_post($page_tagline); ?>
		    </div>
		<?php
		    }
		?>
	</div>

    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				 	<?php the_content(); ?>
				 <?php endwhile; ?>
				 
				 <?php
				if (comments_open($post->ID)) 
				{
				?>
				<div class="fullwidth_comment_wrapper">
					<?php comments_template( '', true ); ?>
				</div>
				<?php
				}
				?>

				<?php
					get_template_part("/templates/template-footer-split");
				?>
    	
    	</div>
    
    </div>
    <!-- End main content -->
   
</div>

<br class="clear"/><br/><br/>
</div>
<?php get_footer(); ?>