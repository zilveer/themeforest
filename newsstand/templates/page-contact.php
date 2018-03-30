<?php
	/* Template Name: Contact Page */
get_header(); ?>

<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

<div class="contact-block hasMap">

    <div class="container">
        <div id="contact-map" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"></div>

        <div class="contact-content">
            <div class="cc-title"><?php the_title(); ?></div>
            <div class="cc-content">
                <div class="whitepart">
                    <?php while(have_posts()): the_post();?>
                    	<?php the_content(); ?>
                    <?php endwhile; ?>

                    <?php
                    	$cf_shortcode = get_post_meta( get_the_ID(), 'newsstand_contact_page_shortcode', 1, true );
                    ?>
                    <?php if (!empty($cf_shortcode)): ?>
                    	<?php echo do_shortcode($cf_shortcode); ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	$gmaps_latlng = get_post_meta( get_the_ID(), 'newsstand_gmaps_latlng', 1, true );
	$gmaps_zoom = get_post_meta( get_the_ID(), 'newsstand_gmaps_zoom', 1, true );
	$gmaps_style = get_post_meta( get_the_ID(), 'newsstand_gmaps_style', 1, true );
?>

<?php if (!empty($gmaps_latlng)): ?>
	<script>
		(function($) {

		    $(document).on('ready', function() {
		    	function gmaps() {
		    	    var mapCanvas = document.getElementById('contact-map');
		    	    var mapOptions = {
		    	      center: new google.maps.LatLng(<?php echo esc_js($gmaps_latlng); ?>),
		    	      zoom: <?php echo esc_js($gmaps_zoom); ?>,
		    	      scrollwheel: false,
		    	      mapTypeId: google.maps.MapTypeId.ROADMAP,
		    	      <?php if (!empty($gmaps_style)) { ?>
		    	      	styles: <?php echo wp_kses($gmaps_style, ''); ?>,
		    	      <?php }; ?>
		    	    }
		    	    var map = new google.maps.Map(mapCanvas, mapOptions)
		    	}
		    	google.maps.event.addDomListener(window, 'load', gmaps);
		    });

		})(jQuery);
	</script>
<?php endif ?>



<?php wp_reset_query(); ?>

<?php get_template_part('inc/theme/strip_text'); ?>

<?php get_footer(); ?>