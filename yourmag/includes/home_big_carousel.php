


<div id="example10" class="showbiz-container fullwidth nopaddings ">
	<div class="showbiz sb-modern-skin">

	<div class="overflowholder">
	
	<ul>
	
	<?php 
    $featucat = get_option('op_feat_cat');
	$slides = get_option('op_feat_slides');
	if (get_option('op_recent_featured_flex') == 'Recent posts') {
	$my_query = new WP_Query('showposts='. $slides .'');	
	} else {
    $my_query = new WP_Query('showposts='. $slides .'&category_name='. $featucat .'');	
	}
    if ($my_query->have_posts()) :
    ?>					
		
    <?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	
		
	<li class="sb-modern-skin">

	<div class="mediaholder">
	<div class="mediaholder_innerwrap">
	<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	<?php $image = aq_resize( $thumbnailSrc, 400, 400, true ); ?>
		<img alt="<?php the_title(); ?>" src="<?php echo $image ?>" />
	</div>
	</div>

	<div class="darkhover"></div>

	<div class="detailholder">
		<div class="showbiz-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></div>
		<div class="divide20"></div>
		
		<?php $post_text = get_post_meta($post->ID, 'r_post_text', true); ?>
	    <?php if($post_text !== '') { ?>

		<p class="excerpt">
	    <?php echo $post_text; ?>
	    </p>
	    <?php } else { ?>

		<?php the_excerpt(); ?>
        <?php } ?>
			<div class="divide20"></div>
		
											
		<div class="sb-post-details leftfloat"><span class="rm15">
		
			<?php if (get_option('op_slider_time_variant') == 'Standard') { ?>
				<?php the_time('F j, Y'); ?>
			<?php } else { ?>	
                <?php $time_ago = (get_option('op_time_ago')) ?>
		        <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . $time_ago ; ?>
	        <?php } ?>	
		
		
		</span><span class="rm15"><?php the_category(', '); ?></span></div>
	    <div class="sb-readmore rightfloat"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_option('op_read_more'); ?></a></div>
	</div>

	</li>
		
    <?php endwhile; wp_reset_query(); ?> 
    <?php endif; ?>   
		
    </ul>
	
	</div>

	</div>
</div>

<?php 
wp_enqueue_script('carousel', BASE_URL . 'js/carousel.min.js', false, '', true);
wp_enqueue_script('carousel_plugins', BASE_URL . 'js/carousel_plugins.min.js', false, '', true);
?>

<script type="text/javascript">
(function($){ 
$(window).load(function(){ 
$('#example10').showbizpro({
	dragAndScroll:"on",
	visibleElementsArray:[3,3,2,1],
	carousel:"off",
	entrySizeOffset:0,
	allEntryAtOnce:"off"
});
})
})(jQuery);

jQuery(document).ready(function($){  
$( "#example10 .detailholder p" ).addClass( "excerpt" );
});

</script>

