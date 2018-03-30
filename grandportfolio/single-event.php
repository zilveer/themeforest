<?php
/**
 * The main template file for display single event page.
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

//Include custom header feature
get_template_part("/templates/template-post-header");
?>
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
<?php
if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(!empty($tg_blog_feat_content) && has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	}
?>
						
<!-- Begin each event post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
	    
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
	    		
	    		$event_get_direction = get_post_meta(get_the_ID(), 'event_get_direction');
	    	?>
	    	<div class="one_half">
	    		<h5 class="event_title"><?php esc_html_e('Detail', 'grandportfolio-translation' ); ?></h5>
	    		<?php
				    the_content();
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
				</div>
	    	</div>
	    	
	    	<div class="one_half last">
		    	<div class="post_header textalignleft">
				    <div class="post_header_title textalignleft">
				    	<?php
				    		if(!empty($event_date) OR !empty($event_location))
				    		{
				    	?>
				    	<h5 class="event_title"><?php esc_html_e('Start Date', 'grandportfolio-translation' ); ?></h5>
				    	<div class="ppb_subtitle event" style="">
				    		<?php echo date_i18n('D, F j', strtotime($event_date)); ?> 
				    		<?php 
				    			if(!empty($event_from_time) OR !empty($event_to_time))
				    			{
				    				echo esc_html($event_from_time).' - '.esc_html($event_to_time);
				    			}
				    		?>
				    	</div>
				    	<br class="clear"/>
				    	<?php
				    		if(!empty($event_location))
				    		{
				    	?>
				    		<h5 class="event_title"><?php esc_html_e('Location', 'grandportfolio-translation' ); ?></h5>
					    	<div class="post_detail">
					    		<span class="post_info_date">
					        		<?php echo nl2br($event_location); ?>
					    		</span>
					    	</div>
					    	<?php
					    		//Check if display get direction from google map
					    		if(!empty($event_get_direction))
					    		{
					    	?>
					    	<br class="clear"/>
					    	<div class="post_button_wrapper textalignleft">
								<a class="readmore" target="_blank" href="https://maps.google.com?saddr=Current+Location&daddr=<?php echo urlencode($event_location); ?>"><?php echo esc_html_e('Get Directions', 'grandportfolio-translation' ); ?> →</a>
							</div>
					    	<?php
					    		}
				    		}
				    		//End if event location not empty
				    	
				    		}
				    	?>
				    </div>
				</div>
	    	</div>
			
	    </div>
	    
	</div>

</div>
<!-- End each event post -->

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

<?php endwhile; endif; ?>
    	
    	</div>
    
    </div>
    <!-- End main content -->
   
</div>

<br class="clear"/><br/><br/>
</div>
<?php get_footer(); ?>