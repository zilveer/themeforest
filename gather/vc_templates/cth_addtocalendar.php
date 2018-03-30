<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $event_start
 * @var $event_end
 * @var $timezone
 * @var $event_title
 * @var $location
 * @var $organizer
 * @var $organizer_email
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_AddToCalendar
 */
$el_class = $event_start = $event_end = $timezone = $event_title = $location = $organizer = $organizer_email = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="text-center <?php echo esc_attr($el_class );?>">
<!-- Add to Calendar Plugin. 
	     For Customization, Visit https://addtocalendar.com/ -->
	<span class="addtocalendar atc-style-theme">
	<a class="atcb-link"><?php _e('<i class="fa fa-calendar"></i> Add to My Calendar','gather');?></a>
	  	<var class="atc_event">
	  	<?php if(!empty($event_start)) :?>
			<var class="atc_date_start"><?php echo esc_html($event_start);?></var>
		<?php else :?>
	      	<var class="atc_date_start">2016-05-04 12:00:00</var>
	    <?php endif;?>

	    <?php if(!empty($event_end)) :?>
			<var class="atc_date_end"><?php echo esc_html($event_end);?></var>
		<?php else :?>
	      	<var class="atc_date_end">2016-05-04 18:00:00</var>
	    <?php endif;?>

	    <?php if(!empty($timezone)) :?>
			<var class="atc_timezone"><?php echo esc_html($timezone);?></var>
		<?php else :?>
	      	<var class="atc_timezone">Europe/London</var>
	    <?php endif;?>

	    <?php if(!empty($event_title)) :?>
			<var class="atc_title"><?php echo esc_html($event_title);?></var>
		<?php else :?>
	      	<var class="atc_title">Gather Event template</var>
	    <?php endif;?>

	    <?php if(!empty($content)) :?>
			<var class="atc_description"><?php echo strip_tags($content); ?></var>
		<?php else :?>
	      	<var class="atc_description">Gather is a responsive event theme with many awesome features including add to my calendar feature. Awesome. huh?</var>
	    <?php endif;?>

	    <?php if(!empty($location)) :?>
			<var class="atc_location"><?php echo esc_html($location);?></var>
		<?php else :?>
	      	<var class="atc_location">Stockholm, Sweden</var>
	    <?php endif;?>

	    <?php if(!empty($organizer)) :?>
			<var class="atc_organizer"><?php echo esc_html($organizer);?></var>
	    <?php endif;?>
		
		<?php if(!empty($organizer_email)) :?>
			<var class="atc_organizer_email"><?php echo esc_html($organizer_email);?></var>
	    <?php endif;?>
	  	</var>
	</span>
</div>
