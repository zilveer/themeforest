


<div id="ei-slider-category" class="ei-slider">
    <ul class="ei-slider-large">
	
	<?php 
	$curent_cat = single_cat_title('', false);
    $featucat = get_option('op_category_feat_cat');
	$slides = get_option('op_category_feat_slides');
	if (get_option('op_category_rec_feat_cat') == 'Recent posts') {
	$my_query = new WP_Query('showposts='. $slides .'&category_name='. $curent_cat .'');	
	} else {
    $my_query = new WP_Query('showposts='. $slides .'&category_name='. $featucat .'');	
	}
    if ($my_query->have_posts()) :
    ?>				

    <?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>			
	
    <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	<?php $image = aq_resize( $thumbnailSrc, 1100, 450, true ); ?>	

        <li>
            <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" />
            <div class="ei-title">
            <h2><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <h3>			
			<?php if (get_option('op_slider_time_variant') == 'Standard') { ?>
				<?php the_time('F j, Y'); ?>
			<?php } else { ?>	
                <?php $time_ago = (get_option('op_time_ago')) ?>
		        <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . $time_ago ; ?>
	        <?php } ?>	
			</h3>
            </div>
        </li>
  
    <?php endwhile; wp_reset_query(); ?> 
    <?php endif; ?>  
	
    </ul>
	
	
    <ul class="ei-slider-thumbs">
	
	<?php 
	$curent_cat = single_cat_title('', false);
    $featucat = get_option('op_category_feat_cat');
	$slides = get_option('op_category_feat_slides');
	if (get_option('op_category_rec_feat_cat') == 'Recent posts') {
	$my_query = new WP_Query('showposts='. $slides .'&category_name='. $curent_cat .'');	
	} else {
    $my_query = new WP_Query('showposts='. $slides .'&category_name='. $featucat .'');	
	}
    if ($my_query->have_posts()) :
    ?>					
	
    <li class="ei-slider-element">Current</li>
	
    <?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>		
	
    <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	<?php $image = aq_resize( $thumbnailSrc, 150, 80, true ); ?>		

        <li>
            <a href="#"><?php the_title(); ?></a>
            <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" />
        </li>
   
    <?php endwhile; wp_reset_query(); ?> 
    <?php endif; ?>   
   
    </ul>
	
</div>

<?php wp_enqueue_script('eislideshow', BASE_URL . 'js/jquery.eislideshow.js', false, '', true); ?>

<script type="text/javascript">
jQuery(document).ready(function($){  
$('#ei-slider-category').eislideshow({
	animation			: 'center',
	autoplay			: true,
	slideshow_interval	: 5000,
	titlesFactor		: 0
});
});
</script>