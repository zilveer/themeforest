<?php
/**
 * Template Name: Page Left Sidebar
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

$page_style = 'Right Sidebar';
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
}

$add_sidebar = TRUE;

get_header(); 
?>

<br class="clear"/>

<?php
    //Get Page LayerSlider
    $page_layerslider = get_post_meta($current_page_id, 'page_layerslider', true);
    
    if($page_layerslider > 0)
    {
    	echo '<div class="page_layerslider">'.do_shortcode('[layerslider id="'.$page_layerslider.'"]').'</div>';
    }
?>

<?php
//Get page header display setting
$page_hide_header = get_post_meta($current_page_id, 'page_hide_header', true);

if(empty($page_hide_header))
{
?>
<div id="page_caption">
	<div class="page_title_wrapper">
		<h1><?php the_title(); ?></h1>
		<?php echo dimox_breadcrumbs(); ?>
	</div>
</div>
<br class="clear"/>
<?php
}
else
{
?>
<br class="clear"/>
<?php
}
?>

<!-- Begin content -->
<div id="page_content_wrapper">

    <div class="inner">
    
    <!-- Begin main content -->
    <div class="inner_wrapper">
    	
    	<div class="sidebar_wrapper left_sidebar">
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
        	
        <div class="sidebar_content left_sidebar">
        	
        	 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			 	<?php the_content(); ?>
			 <?php endwhile; ?>
        			
        </div>
    
    </div>
    <!-- End main content -->
</div>
<br class="clear"/><br/>
<?php get_footer(); ?>
