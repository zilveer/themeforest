
<div id="myScroller">

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
	
	<?php 
		$format = get_post_format(); if ( false === $format ) { 
		$post_format_image = '<div class="post_format"></div>'; 
		}
					
		if(has_post_format('video')) { 
		$post_format_image = '<div class="post_format_video"></div>';
		}
					
		if(has_post_format('image')) {
		$post_format_image = '<div class="post_format_image"></div>';
		}
		
		if(has_post_format('audio')) {
		$post_format_image = '<div class="post_format_audio"></div>';
		}
	?> 		
	
    <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	<?php $image = aq_resize( $thumbnailSrc, 377, 353, true ); ?>
	
    <div class="scroller-el">
    <div class="scroller_item">
	<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
    <img src="<?php echo $image ?>" alt="Image" alt="<?php the_title(); ?>"/>
	</a>
    <div class="scroler_content"><h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1></div>
    
		<div class="cats_and_formats_box">
        
		<?php $category = get_the_category();
        if ($category) {
        echo '<a class="custom_cat_class" href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "%s", "my-text-domain" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
        }
        ?>
		
		<?php echo $post_format_image ?>
		</div>
	
	</div>
    </div>

    <?php endwhile; wp_reset_query(); ?> 
    <?php endif; ?>  

</div>
<div class="clear"></div>

<?php wp_enqueue_script('row_slider', BASE_URL . 'js/jquery.radiant_scroller-min.js', false, '', true); ?>

<script type="text/javascript">
jQuery(document).ready(function($){  

var sc = $('#myScroller').radiantScroller({
elementWidth: 385,
cols: 3,
rows: <?php echo get_option("op_rows_count"); ?>,
useMouseWheel: false,
addPagination: false,
nextButtonText: '', 
prevButtonText: ''
});

});

(function($){ 
$(window).load(function(){ 
$("#myScroller").css({ visibility: "visible" });
$(".radiant_scroller").css({ visibility: "visible" });
})
})(jQuery);
</script>
