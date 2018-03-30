

<div class="inner">
<div id="jslidernews3" class="lof-slidecontent">
	<div class="preload"><div></div></div>
                   
    <div class="main-slider-content" >
    <ul class="sliders-wrap-inner">
	
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
				
    <li>
	
	<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	<?php $image = aq_resize( $thumbnailSrc, 1140, 400, true ); ?>
	<img alt="<?php the_title(); ?>" src="<?php echo $image ?>" />         
    
	<div class="slider-description">
        <div class="slider-meta"><?php the_category(' '); ?> <i> <?php the_time('F j, Y'); ?> </i></div>
        <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></h1>
        
		<p>
		<?php $post_text = get_post_meta($post->ID, 'r_post_text', true); ?>
	    <?php if($post_text !== '') { ?>

	    <?php echo $post_text; ?>
	
	    <?php } else { ?>
		<?php the_excerpt(); ?>
        <?php } ?>
		
        <?php $custom_read_more = get_post_meta($post->ID, 'r_custom_read_more', true); ?>
	    <?php if($custom_read_more !== '') { ?>
	    <div class="custom_read_more">
		
		<?php $custom_rm_link = get_post_meta($post->ID, 'r_custom_rm_link', true); ?>
	    <?php if($custom_rm_link !== '') { ?>
		<a href="<?php echo $custom_rm_link; ?>" title="<?php the_title(); ?>" target="_blank">
		<?php } else { ?>	
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">					
	    <?php } ?>	
		
	    <?php echo $custom_read_more; ?> &raquo;
		
		</a>
        </div>
		
	    <?php } else { ?>
		
	    <div class="custom_read_more">
		
		<?php $custom_rm_link = get_post_meta($post->ID, 'r_custom_rm_link', true); ?>
	    <?php if($custom_rm_link !== '') { ?>
		<a href="<?php echo $custom_rm_link; ?>" title="<?php the_title(); ?>" target="_blank">
		<?php } else { ?>	
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">					
	    <?php } ?>	
		
		<?php echo get_option('op_read_more'); ?>
		
		</a>
        </div>
		<?php } ?>
		
        </p>
    </div>
    </li> 

    <?php endwhile; wp_reset_query(); ?> 
    <?php endif; ?>         
                
    </ul>  	
    </div>
 
	
    <div class="navigator-content">
    <div class="navigator-wrapper">
    <ul class="navigator-wrap-inner">
	
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
	
    <li>
    <div>
	
	<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	<?php $image = aq_resize( $thumbnailSrc, 60, 60, true ); ?>
	<img alt="<?php the_title(); ?>" src="<?php echo $image ?>" /> 
    <h3><?php the_title(); ?></h3>
                                 
    </div>    
    </li>
                               
    <?php endwhile; wp_reset_query(); ?> 
    <?php endif; ?>  
	
    </ul>
    </div>
   
    </div> 

 </div> 
 </div> 
 
 
 <?php wp_enqueue_script('loft_slider', BASE_URL . 'js/loft_slider.js', false, '', true); ?>

<script type="text/javascript">
jQuery(document).ready(function($){  
	var buttons = { 
	previous:$('#jslidernews3 .button-previous') ,
	next:$('#jslidernews3 .button-next')
	};
		
	$('#jslidernews3').lofJSidernews({ 
	interval:5000,
	easing:'easeInSine',
	direction:'opacity',
	duration: 500,
	auto: true,
	mainWidth:1140,
	mainHeight:400,
	navigatorHeight		: 100,
	navigatorWidth		: 400,
	maxItemDisplay: 4,
	buttons:buttons
	});						
});
</script>