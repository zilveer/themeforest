<?php
 function webnus_latestnews( $attributes, $content = null ) {
extract(shortcode_atts(	array(
	'type'=>'1',
	'category'=>'',
	'author'=>'',
	'scount'=>'4',
	'rcount'=>'2',
), $attributes));
	ob_start();
$count = 0;
echo '<div class="latestnews'.$type.'">';
$query = new WP_Query('posts_per_page='.$scount.'&category_name='.$category.'&author_name='.$author);
while ($query -> have_posts()) : $query -> the_post();		
	$image = get_the_image( array( 'meta_key' => array( 'Thumbnail', 'Thumbnail' ), 'size' => 'square' ,'echo'=>false) );
	if($type==1){
		echo($count == 0)?'<div class="ln-row">':'';
		echo '<article class="ln-item"><figure class="ln-image">'.$image.'</figure>
		<div class="ln-content">
			<h3><a class="ln-title" href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
			<p class="ln-date">'.get_the_date().'</p>
			<a href="'.get_the_permalink().'" class="ln-button">'.esc_html__('VIEW NOW','webnus_framework').'</a>
		</div></article>';
		$count ++;
		if($count==$rcount){
			echo '</div>';
			$count = 0;
		}
	}elseif($type==2){
		echo '<article class="ln-item">
		<div class="ln-date"><div class="ln-day">'.get_the_date('d').'</div><div class="ln-month">'.get_the_date('M').'</div></div>
		<div class="ln-content">
			<h3><a class="ln-title" href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
			<p class="ln-excerpt">'.webnus_excerpt(16).'</p>
			<a href="'.get_the_permalink().'" class="ln-button magicmore">'.esc_html__('Read More','webnus_framework').'</a>
		</div>
		</article>';
	}
endwhile;
echo($type==1 && $count != 0)?'</div>':'';
echo '</div>';
	$out = ob_get_contents();
	ob_end_clean();	
	wp_reset_postdata();
	return $out;
 }
 add_shortcode('latestnews', 'webnus_latestnews');
?>