<?php
/**
 * Template Name: Event Fullwidth
 * The main template file for display event page.
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

$is_display_page_content = TRUE;
$is_standard_wp_post = FALSE;

if(is_tag())
{
    $is_display_page_content = FALSE;
    $is_standard_wp_post = TRUE;
} 
elseif(is_category())
{
    $is_display_page_content = FALSE;
    $is_standard_wp_post = TRUE;
}
elseif(is_archive())
{
    $is_display_page_content = FALSE;
    $is_standard_wp_post = TRUE;
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
    		
    		<div class="sidebar_content full_width">

	    		<?php if ( have_posts() && $is_display_page_content) while ( have_posts() ) : the_post(); ?>		
					
		    		<div class="page_content_wrapper"><?php the_content(); ?></div>
		
		    	<?php endwhile; ?>
					
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
    //Get current time to filter upcoming events
    if(THEMEDEMO)
	{
	    $current_time = 0;
	}
	else
	{
	    $current_time = time()-(3600*24);
	}
    
    $args = array(
	    'post_type' => 'events',
	    'paged' => $paged,
	    'order' => 'ASC',
	    'orderby' => 'meta_value',
	    'suppress_filters' => 0,
	    'meta_query' => array(
	        array(
	            'key' => 'event_date_raw',
	            'value' => $current_time,
	            'compare' => '>='
	        ),
	    )
	);
    
    query_posts($args);
}

$post_counter = 0;
$post_counts = $wp_query->post_count;

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	}
	
	$post_counter++;
?>

<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper floatleft">
	    
	    <div class="post_content_wrapper">
	    
	    	<?php
	    		//Get event data
	    		$event_date = '';
	    		$event_from_time = '';
	    		$event_to_time = '';
	    		$event_location = '';
	    		
	    		$event_date = get_post_meta(get_the_ID(), 'event_date');
	    		if(isset($event_date[0]))
	    		{
		    		$event_date = $event_date[0];
	    		}
	    		
				$event_from_time = get_post_meta(get_the_ID(), 'event_from_time');
				if(isset($event_from_time[0]))
	    		{
		    		$event_from_time = $event_from_time[0];
	    		}
				
				$event_to_time = get_post_meta(get_the_ID(), 'event_to_time');
				if(isset($event_to_time[0]))
	    		{
		    		$event_to_time = $event_to_time[0];
	    		}
				
				$event_location = get_post_meta(get_the_ID(), 'event_location');
				if(isset($event_location[0]))
	    		{
		    		$event_location = $event_location[0];
	    		}
	    	?>
	    	<div class="one_half">
	    		<?php
				     if(!empty($event_date))
				     {
				 ?>
		    		<div class="post_date">
		    			<div class="month"><?php echo date_i18n('M', strtotime($event_date)); ?></div>
		    			<hr class="title_break left"/>
		    			<div class="day"><?php echo date_i18n('m', strtotime($event_date)); ?></div>
		    		</div>
	    		<?php
	    			}
	    		
					//Check if has event featured image
					$small_image_url = '';
					if(has_post_thumbnail(get_the_ID(), 'large'))
					{
					    $image_id = get_post_thumbnail_id(get_the_ID());
						$small_image_url = wp_get_attachment_image_src($image_id, 'grandportfolio-blog', true);
					}
					
					if(isset($small_image_url[0]) && !empty($small_image_url[0]))
					{
				?>
		    
		    	<div class="post_img static <?php if(!empty($event_date)) { ?>withdate<?php } ?>">
				 	<a href="<?php the_permalink(); ?>">
				 		<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="" style="width:<?php echo esc_attr($small_image_url[1]); ?>px;height:<?php echo esc_attr($small_image_url[2]); ?>px;"/>
				    </a>
				</div>
						
				<br class="clear"/>
				<?php
					}
				?>
	    	</div>
	    	
	    	<div class="one_half last">
		    	<div class="post_header textalignleft">
				    <div class="post_header_title textalignleft">
				    	<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
				    	<?php
				    		if(!empty($event_date) OR !empty($event_location))
				    		{
				    	?>
				    	<div class="ppb_subtitle event" style=""><?php echo date_i18n('D, F j', strtotime($event_date)); ?></div>
				    	<?php
				    		if(!empty($event_location))
				    		{
				    	?>
					    	<hr class="title_break left"/>
					    	<div class="post_detail">
					    		<span class="post_info_date">
					        		<?php echo nl2br($event_location); ?>
					    		</span>
					    	</div>
				    	<?php
				    		}
				    		//End if event location not empty
				    	
				    		}
				    	?>
				    </div>
				</div>
				
				<?php
				    echo grandportfolio_substr(get_the_content(), 150);
				?>
				<div class="post_button_wrapper textalignleft">
					<?php
						//Check if has buy ticket URL
						$event_ticket_url = get_post_meta(get_the_ID(), 'event_ticket_url');
						
						if(!empty($event_ticket_url))
						{
					?>
					<a class="button buyticket" href="<?php echo esc_url($event_ticket_url[0]); ?>" target="_blank"><?php echo esc_html_e('Buy Ticket', 'grandportfolio-translation' ); ?></a>
					<?php
						}
					?>
				    <a class="readmore" href="<?php the_permalink(); ?>"><?php echo esc_html_e('View Event Detail', 'grandportfolio-translation' ); ?> →</a>
				</div>
	    	</div>
	    </div>
	    
	</div>

</div>
<br class="clear"/>
<!-- End each blog post -->

<?php endwhile; endif; ?>

    	<?php
		    if($wp_query->max_num_pages > 1)
		    {
		    	if (function_exists("grandportfolio_pagination")) 
		    	{
		?>
				<br class="clear"/>
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
    	
    </div>
    <!-- End main content -->

</div>  
</div>
<?php get_footer(); ?>