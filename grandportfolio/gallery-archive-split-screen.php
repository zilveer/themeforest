<?php
/**
 * Template Name: Gallery Archive Fullscreen Split Screen
 * The main template file for display gallery page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$ob_page = get_page($post->ID);
$current_page_id = '';

if(isset($ob_page->ID))
{
    $current_page_id = $ob_page->ID;
}

//important to apply dynamic header & footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();

get_header();

wp_enqueue_style("fullPage", get_template_directory_uri()."/css/jquery.fullPage.css", false, THEMEVERSION, "all");
wp_enqueue_script("fullPage", get_template_directory_uri()."/js/jquery.fullPage.min.js", false, THEMEVERSION, true);
wp_enqueue_script("grandportfolio-custom-fullpage", get_template_directory_uri()."/js/custom_fullpage.js", false, THEMEVERSION, true);
?>

<?php
	$grandportfolio_hide_title= grandportfolio_get_hide_title();
	grandportfolio_set_hide_title(1);
	
	$grandportfolio_page_content_class = grandportfolio_get_page_content_class();
	grandportfolio_set_page_content_class('wide');

    //Include custom header feature
	get_template_part("/templates/template-header");
?>

<!-- Begin content -->   
<div id="fullpage" class="split">
	
	<?php
	    //Get galleries
	    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	    $pp_portfolio_items_page = -1;
	    
	    $query_string = 'paged='.$paged.'&orderby=menu_order&order=ASC&post_type=galleries&posts_per_page=-1&suppress_filters=0';
	    
	    if(!empty($term))
	    {
	        $query_string .= '&gallerycat='.$term;
	    }
	    
	    if(THEMEDEMO)
	    {
		    $query_string .= '&gallerycat='.DEMOGALLERYID;
	    }

	    query_posts($query_string);
	
	    $key = 0;
	    if (have_posts()) : while (have_posts()) : the_post();
	    	$small_image_url = array();
	        $image_url = '';
	        $gallery_ID = get_the_ID();
	        		
	        if(has_post_thumbnail($gallery_ID, 'original'))
	        {
	            $image_id = get_post_thumbnail_id($gallery_ID);
	            $small_image_url = wp_get_attachment_image_src($image_id, 'original', true);
	        }
	        
	        $permalink_url = get_permalink($gallery_ID);

	        $content_class = 'even';
	        if($key%2!=0)
	        {
		        $content_class = 'odd';
	        }
	        else
	        {
		        $content_class = 'even';
	        }
	        
		    if(!empty($small_image_url[0]))
		    {
		?>	
		    <div class="section gallery_archive">
		    	<a href="<?php echo esc_url($permalink_url); ?>">
		    		<div class="background_image split <?php echo esc_attr($content_class); ?>" style="background-image: url('<?php echo esc_url($small_image_url[0]); ?>');"></div>
		    	</a>
		    	<div class="gallery_archive_info split <?php echo esc_attr($content_class); ?>">
		    		<div class="gallery_archive_info_wrapper">
		    			<div class="gallery_archive_info_content">
		    				<div class="post_info_cat">
		    					<?php the_excerpt(); ?>
		    				</div>
							<h1><?php the_title(); ?></h1>
							<hr class="title_break left">
							<?php the_content(); ?>
							<br/><br/>
							<a href="<?php echo esc_url($permalink_url); ?>" class="button ghost"><?php esc_html_e('View Gallery', 'grandportfolio-translation' ); ?></a>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		<?php
		    }

	    $key++;
	    endwhile; endif;	
	?>
	
</div>
<?php get_footer(); ?>
<!-- End content -->