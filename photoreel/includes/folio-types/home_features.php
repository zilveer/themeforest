<?php 
	$features_style = get_post_meta($post->ID, 'themnific_features_style', true);
	$features_link = get_post_meta($post->ID, 'themnific_feature_url', true);
	$features_iframe = get_post_meta($post->ID, 'themnific_feature_iframe', true);
?>

<div class="<?php if($features_style == 'Right')  { echo 'features_right' ?><?php } else echo 'features_left' ?>">


	<?php if($features_iframe) {?>
    
            <?php echo ($features_iframe); ?>
            
    <?php } else {?>
    
        <?php the_post_thumbnail('full',array('title' => "")); ?>
    
    <?php }?> 
    
    <div class="item_fea">
    
		<?php if ($features_link) { ?>
        
            <h3><a href="<?php echo $features_link; ?>"><?php the_title(  ); ?></a></h3>
            
        <?php } else { ?>
        
            <h3><?php the_title(  ); ?></h3>
            
        <?php } ?> 
        
        <span class="spanner"></span>
        
        <?php the_content(); ?>
    
    </div>

</div>

