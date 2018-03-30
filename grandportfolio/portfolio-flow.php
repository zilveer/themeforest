<?php
/**
 * Template Name: Portfolio Flow
 * The main template file for display portfolio page.
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

//important to apply dynamic header and footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
grandportfolio_set_homepage_style('flow');

get_header(); 

//Run flow gallery data
wp_enqueue_script("ppflip", get_template_directory_uri()."/js/jquery.ppflip.js", false, THEMEVERSION, true);
wp_enqueue_script("touchwipe", get_template_directory_uri()."/js/jquery.touchwipe.1.1.1.js", false, THEMEVERSION, true);
?>

</div>

<a id="imgflow-prevslide" class="load-item"></a>
<a id="imgflow-nextslide" class="load-item"></a>

<div id="imageFlow">
	<div class="text">
		<div class="title"></div>
		<div id="legend_portfolio" class="legend"></div>
	</div>
</div>

<?php
	$tg_flow_enable_reflection = kirki_get_option('tg_flow_enable_reflection');
?>
<input type="hidden" id="tg_flow_enable_reflection" name="tg_flow_enable_reflection" value="<?php echo esc_attr($tg_flow_enable_reflection); ?>"/>

<?php
	//Get all portfolio items
	$query_string = 'orderby=menu_order&order=ASC&post_type=portfolios&numberposts=-1&suppress_filters=0&posts_per_page=-1';
		
	if(!empty($term))
	{
	    $ob_term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	    $custom_tax = $wp_query->query_vars['taxonomy'];
	    $query_string .= '&posts_per_page=-1&'.$custom_tax.'='.$term;
	}
	query_posts($query_string);
?>
<div id="fancy_gallery" style="display:none">
<?php
$key = 0;
if (have_posts()) : while (have_posts()) : the_post();

	$image_url = '';
	$portfolio_ID = get_the_ID();
	    	
	if(has_post_thumbnail($portfolio_ID, 'original'))
	{
	    $image_id = get_post_thumbnail_id($portfolio_ID);
	    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
	}
	
	$image_title = get_the_title();
	
	$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
	$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
	
	switch($portfolio_type)
	{
	    case 'External Link':
	    	$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
?>
<a id="fancy_gallery<?php echo esc_attr($key); ?>" href="<?php echo esc_url($portfolio_link_url); ?>" title="<?php echo esc_html($image_title); ?>"></a>
<?php
		break;

		case 'Portfolio Content':
		default:
?>
<a id="fancy_gallery<?php echo esc_attr($key); ?>" href="<?php echo esc_url(get_permalink($portfolio_ID)); ?>" title="<?php echo esc_html($image_title); ?>"></a>
<?php
		break;

		case 'Image':
	    	$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
?>
<a id="fancy_gallery<?php echo esc_attr($key); ?>" data-caption="<?php echo esc_attr(get_the_title()); ?>" href="<?php echo esc_url($image_url[0]); ?>" class="fancy-gallery"></a>
<?php
		break;
		
		case 'Youtube Video':
?>
<a id="fancy_gallery<?php echo esc_attr($key); ?>" href="https://www.youtube.com/embed/<?php echo esc_attr($portfolio_video_id); ?>" class="lightbox_youtube" data-options="width:900, height:488"></a>
<?php
		break;
		
		case 'Vimeo Video':
?>
<a id="fancy_gallery<?php echo esc_attr($key); ?>" href="https://player.vimeo.com/video/<?php echo esc_attr($portfolio_video_id); ?>?badge=0" class="lightbox_vimeo" data-options="width:900, height:506"></a>
<?php
		break;
		
		case 'Self-Hosted Video':
				    
		//Get video URL
		$portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
		$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
?>
<a id="fancy_gallery<?php echo esc_attr($key); ?>" href="<?php echo esc_url($portfolio_mp4_url); ?>" class="lightbox_vimeo"></a>
<?php
		break;
	}

$key++;
endwhile; endif;
?>
</div>

<?php
	//Print flow gallery javascript
?>
<script>
jQuery(document).ready(function() {
	var calScreenWidth = jQuery(window).width();
	var imgFlowSize = 0.6;
	if(calScreenWidth > 480)
	{
	imgFlowSize = 0.4;
	}
	else
	{
	imgFlowSize = 0.2;
	}
	<?php
	$ajax_nonce = wp_create_nonce('tgajax-post-contact-nonce');
	
	if(empty($term))
	{
	?>
	imf.create("imageFlow", '<?php echo admin_url('admin-ajax.php'); ?>?action=grandportfolio_portfolio_flow_xml&tg_security=<?php echo $ajax_nonce; ?>', 0.6, 0.4, 0, 10, 8, 4);
	<?php
	}
	else
	{
	?>
	imf.create("imageFlow", '<?php echo admin_url('admin-ajax.php'); ?>?action=grandportfolio_portfolio_flow_xml&portfolioset=<?php echo esc_attr($term); ?>&tg_security=<?php echo $ajax_nonce; ?>', 0.6, 0.4, 0, 10, 8, 4);
	<?php
	}
	?>
});
</script>

<?php
	//important to apply dynamic footer style
	$grandportfolio_homepage_style = 'flow';
	
	get_footer();
?>