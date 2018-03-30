<?php
/**
 * Template Name: Blog Masonry Right Sidebar
 * The main template file for display blog page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
if(!is_null($post))
{
	$page_obj = get_page($post->ID);
}

$current_page_id = '';

/**
*	Get current page id
**/

if(!is_null($post) && isset($page_obj->ID))
{
    $current_page_id = $page_obj->ID;
}

get_header(); 

//Include post featured slider
$tg_blog_slider_layout = kirki_get_option('tg_blog_slider_layout');

if(THEMEDEMO && isset($_GET['slider']))
{
	$tg_blog_slider_layout = $_GET['slider'];
}

if(!empty($tg_blog_slider_layout))
{
	get_template_part("/templates/template-".$tg_blog_slider_layout);
}

$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

//If not select sidebar then select default one
if(empty($page_sidebar))
{
	$page_sidebar = 'Blog Sidebar';
}

$is_display_page_content = TRUE;
$is_standard_wp_post = FALSE;

if(is_tag())
{
    $is_display_page_content = FALSE;
    $is_standard_wp_post = TRUE;
    $page_sidebar = 'Tag Sidebar';
} 
elseif(is_category())
{
    $is_display_page_content = FALSE;
    $is_standard_wp_post = TRUE;
    $page_sidebar = 'Category Sidebar';
}
elseif(is_archive())
{
    $is_display_page_content = FALSE;
    $is_standard_wp_post = TRUE;
    $page_sidebar = 'Archives Sidebar';
} 		

//Include custom header feature
get_template_part("/templates/template-header");
?>
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<?php if ( have_posts() && $is_display_page_content) while ( have_posts() ) : the_post(); ?>		
					
		    	<div class="page_content_wrapper"><?php the_content(); ?></div>
		
		    <?php endwhile; ?>
    		
    		<div id="blog_grid_wrapper" class="sidebar_content">

					
<?php
if(is_front_page())
{
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
else
{
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}

//If theme built-in blog template then add query
if(!$is_standard_wp_post)
{
    $query_string ="post_type=post&paged=$paged&suppress_filters=0";
    
    if(THEMEDEMO)
    {
	    $query_string.= '&posts_per_page=7';
    }
    
    query_posts($query_string);
}
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
		    //Get post featured content
		    $post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
		    
		    switch($post_ft_type)
		    {
		    	case 'Image':
		    	default:
		        	if(!empty($image_thumb))
		        	{
		        		$small_image_url = wp_get_attachment_image_src($image_id, 'grandportfolio-gallery-masonry', true);
		?>
		
		    	    <div class="post_img small static">
		    	    	<a href="<?php the_permalink(); ?>">
		    	    		<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="" style="width:<?php echo esc_attr($small_image_url[1]); ?>px;height:<?php echo esc_attr($small_image_url[2]); ?>px;"/>
		                </a>
		    	    </div>
		
		<?php
		    		}
		    	break;
		    	
		    	case 'Vimeo Video':
		    		$post_ft_vimeo = get_post_meta(get_the_ID(), 'post_ft_vimeo', true);
		?>
		    		<?php echo do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="670" height="377"]'); ?>
		    		<br/>
		<?php
		    	break;
		    	
		    	case 'Youtube Video':
		    		$post_ft_youtube = get_post_meta(get_the_ID(), 'post_ft_youtube', true);
		?>
		    		<?php echo do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="670" height="377"]'); ?>
		    		<br/>
		<?php
		    	break;
		    	
		    } //End switch
		?>
	    
	    <div class="blog_grid_content">
			<?php
		    	//Check post format
		    	$post_format = get_post_format(get_the_ID());
				
				switch($post_format)
				{
					case 'quote':
			?>		
					<div class="post_quote_wrapper">
						<div class="post_quote_title">
						    <?php the_content(); ?>
						</div>
						<div class="post_detail">
					        <?php the_title(); ?>
						</div>
					</div>
			<?php
					break;
					
					case 'link':
			?>		
					<div class="post_header quote">
						<div class="post_quote_title grid">
							<?php the_content(); ?>
							<div class="post_detail">
						    	<?php echo date_i18n(THEMEDATEFORMAT, get_the_time('U')); ?>
						    	<?php
						    		//Get Post's Categories
						    		$post_categories = wp_get_post_categories($post->ID);
						    		if(!empty($post_categories))
						    		{
						    	?>
						    		<?php echo esc_html_e('In', 'grandportfolio-translation' ); ?>
						    	<?php
						    	    	foreach($post_categories as $c)
						    	    	{
						    	    		$cat = get_category( $c );
						    	?>
						    	    	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
						    	<?php
						    	    	}
						    	    }
						    	?>
						    </div>
						</div>
					</div>
			<?php
					break;
					
					default:
		    ?>
			    <div class="post_header grid">
			    	<div class="post_info_cat">
			    			<?php echo date_i18n(THEMEDATEFORMAT, get_the_time('U')); ?>&nbsp;/&nbsp;
						    <?php
						    	//Get Post's Categories
						    	$post_categories = wp_get_post_categories($post->ID);
						    	
						    	$count_categories = count($post_categories);
								$i = 0;
						    	
						    	if(!empty($post_categories))
						    	{
						        	foreach($post_categories as $key => $c)
						        	{
						        		$cat = get_category( $c );
						    ?>
						        	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
						    <?php
						    			if(THEMEDEMO && $i == 0)
										{
										    break;
										}
						    
						    			if(++$i != $count_categories) 
						    			{
						    				echo '&nbsp;/&nbsp;';
						    			}
						        	}
						        }
						    ?>
				    	</div>
			    	<h6><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
			    </div>
			    
			    <?php
			    	echo grandportfolio_substr(get_the_excerpt(), 170);
			    ?>
		    <?php
		    		break;
		    	}
		    ?>
	    </div>
	    
	</div>

</div>
<!-- End each blog post -->

<?php $key++; ?>
<?php endwhile; endif; ?>
    		
    	</div>
    	
    	<div class="sidebar_wrapper">
    		
    	    <div class="sidebar_top"></div>
    	
    	    <div class="sidebar">
    	    
    	    	<div class="content">
    	    
    	    		<?php 
					$page_sidebar = sanitize_title($page_sidebar);
					
					if (is_active_sidebar($page_sidebar)) { ?>
	    	    		<ul class="sidebar_widget">
	    	    		<?php dynamic_sidebar($page_sidebar); ?>
	    	    		</ul>
	    	    	<?php } ?>
    	    	
    	    	</div>
    	
    	    </div>
    	    <br class="clear"/>
    	
    	    <div class="sidebar_bottom"></div>
    	</div>
    	
    </div>
    <!-- End main content -->
    <?php
	    if($wp_query->max_num_pages > 1)
	    {
	    	if (function_exists("grandportfolio_pagination")) 
	    	{
	?>
			<br class="clear"/><br/>
	<?php
	    	    grandportfolio_pagination($wp_query->max_num_pages);
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
	     	<?php esc_html_e('Page', 'grandportfolio-translation' ); ?> <?php echo esc_html($paged); ?> <?php esc_html_e('of', 'grandportfolio-translation' ); ?> <?php echo esc_html($wp_query->max_num_pages); ?>
	     </div>
	     <?php
	     }
	?>

</div>  
<br class="clear"/><br/>
</div>
<?php get_footer(); ?>