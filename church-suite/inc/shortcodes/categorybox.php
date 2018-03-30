<?php
function webnus_category_box($attributes, $content = null){
	extract(shortcode_atts(	array(
		'show_title'=>'enable',
		'title'=>'',
		'post_count'=>5,
		'show_date'=>'enable',
		'show_category'=>'enable',
		'show_author'=>'enable',
		'category'=>'',
		'author'=>'',
	), $attributes));
	ob_start();	
	echo '<div class="latest-cat-box">';
	echo($show_title)?'<div class="sub-content"><h6 class="h-sub-content">'.esc_html($title).'</h6></div>':'';
	$query = new WP_Query('posts_per_page='.$post_count.'&category_name='.$category.'&author_name='.$author);
	while ($query -> have_posts()) : $query -> the_post();	
		$w_date = ($show_date)?get_the_time('F d, Y'):'';
		$w_author = ($show_author)?' / <strong>'.esc_html__('by', 'webnus_framework').' </strong>'.get_the_author():'';
	if(empty($w_done)){?>
		<article class="blog-post lc-main clearfix">
			<figure>
			<?php // Show Image
				$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'latestfromblog' ,'echo'=>false) );
				echo($image)?$image:'<img src="'.get_template_directory_uri() . '/images/featured.jpg">';
			?>
			</figure>	
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<p class="blog-author"><?php echo $w_date.$w_author; ?></p>
			<p class="blog-detail"><?php echo webnus_excerpt(31); ?></p>
		</article>
	<?php $w_done = true;
	}else{ ?>
		<div class="lc-items">
			<article class="blog-line clearfix">
			<figure>
			<?php // Show Image
				$image = get_the_image( array( 'meta_key' => array( 'Thumbnail', 'Thumbnail' ), 'size' => 'tabs-img' ,'echo'=>false,'link_to_post' => true,) ); 
				echo($image)?$image:'<img src="'.get_template_directory_uri() . '/images/featured_140x110.jpg" />';
			?>
			</figure>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<p class="blog-author"><?php echo $w_date.$w_author; ?></p>
			</article>
		</div>
	<?php }
	endwhile;
	echo '</div>';
	$out = ob_get_contents();
	ob_end_clean();	
	wp_reset_postdata();
	return $out;
}
add_shortcode('categorybox', 'webnus_category_box');
?>