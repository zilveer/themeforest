<?php
$args = array( 
		'post_type' => 'post',
		'posts_per_page' => 20,
		'post__not_in' => get_option( 'sticky_posts' ),
		'meta_query' => array(
		'relation' => 'OR',
			array(
				'key' => 'oi_featuredd',
				'value' => 'Yes',
				'compare' => 'LIKE'
			)
	)
	);
	
$the_query = new WP_Query( $args );
$catt = get_the_terms( $post->ID, 'category' );
	if (isset($catt) && ($catt!='')){
	$slugg = '';
	$slug = ''; 
	foreach($catt  as $vallue=>$key){
		$slugg .= strtolower($key->slug) . " ";
		$slug  .= ''.$key->name.', ';
	}
	
	};

if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-image-featured'); ?>
    <div class="oi_col-md-4 oi_img_grid">
    	<a href="<?php echo the_permalink(); ?>"><img class="img-responsive"  src="<?php echo $large_image_url[0]?>"></a>
        <div class="oi_f_post_meta">
        	<div class="oi_f_cat"><?php the_category(' , ')?></div>
        	<h5><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h5>
        </div>
    
    </div>
<?php endwhile;  ?> 
<?php endif; ?>