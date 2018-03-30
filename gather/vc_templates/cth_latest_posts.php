<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $count
 * @var $order_by
 * @var $order
 * @var $ids
 * @var //$com_web
 * @var //$content
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Latest_Posts
 */
$el_class = $count = $order_by = $order = $ids = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(!empty($ids)){
	$ids = explode(",", $ids);
	$args = array(
	    'post_type'		 => 'post',
	    'post__in' => $ids,
	    'order_by'=> $order_by,
	    'order'=> $order,
	);
}else{
	$args = array(
	    'post_type'		 => 'post',
	    'posts_per_page' => $count,
	    'order_by'=> $order_by,
	    'order'=> $order,
	);
}
$posts = new WP_Query($args);
?>
<div class="row">
<?php if($posts->have_posts()) {               
    while($posts->have_posts()) : $posts->the_post();  
    ?>

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail wow fadeInUp">
            <?php the_post_thumbnail('gatherblog-thumb' ); ?>
            <div class="caption">
                <h6 class="caption-title"><?php the_title( );?></h6>
                <p class="caption-text">
                <?php //if($cththemes_options['blog_author']) :?>
                    <?php the_author_posts_link( );?>
                <?php //endif;?> 
                <?php //if($cththemes_options['blog_date']) :?>
                <?php _e('on ','gather');?><a class="meta_date" href="<?php echo get_day_link((int)get_the_time('Y' ), (int)get_the_time('m' ), (int)get_the_time('d' )); ?>"> <?php the_time(__('M d Y','gather'));?></a>
                <?php //endif;?>
                </p>
                <p class="text-center"><a href="<?php the_permalink();?>" class="btn btn-outline" role="button"><?php _e('Read More','gather');?></a> </p>
            </div>
        </div>
    </div>

<?php 
    endwhile;
}

/* Restore original Post Data */
wp_reset_postdata();

?>
</div><!-- /.row -->
