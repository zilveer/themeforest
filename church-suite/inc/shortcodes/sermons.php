<?php
 function webnus_sermons( $attributes, $content = null ) {
extract(shortcode_atts(	array(
	'type'=>'toggle',
	'category'=>'',
	'count'=>'6',
	'page'=>'',
	'sort'=>'',
	'icon'=>'',
), $attributes));
	ob_start();		
	$view =($sort=='view')?"'&orderby=meta_value_num&meta_key=webnus_views":"";
	$paged = ( is_front_page() ) ? 'page' : 'paged' ;
	$pages = ($page)?'&paged='.get_query_var($paged):'&paged=1';
	$query = new WP_Query('post_type=sermon&posts_per_page='.$count.'&category_name='.$category.$pages.$view);
	if(empty($count)){
		$count=1;
	}
	$rcount= 1 ;
?>
<div class="container sermons-<?php echo $type ?>">
<?php	
	while ($query -> have_posts()) : $query -> the_post();
		//terms		
		$post_id = get_the_ID();  
		$terms = get_the_terms( $post_id , 'sermon_speaker' );
		if(is_array($terms)){
			$sermon_speaker= array();
			foreach($terms as $term){
				$sermon_speaker[] = $term->slug;
			}
		}else $sermon_speaker=array();
		$terms = get_the_terms(get_the_id(), 'sermon_speaker' );
		$terms_slug_str = '';
		if ($terms && ! is_wp_error($terms)) :
			$term_slugs_arr = array();
		foreach ($terms as $term) {
			$term_slugs_arr[] = $term->name;
		}
		$terms_slug_str = implode( ", ", $term_slugs_arr);
		endif;

		//cats
		$cats = get_the_terms( $post_id , 'sermon_category' );
		if(is_array($cats)){
			$sermon_category = array();
			foreach($cats as $cat){
				$sermon_category[] = $cat->slug;
			}
		}else $sermon_category=array();
		$cats = get_the_terms(get_the_id(), 'sermon_category' );
		$cats_slug_str = '';
		if ($cats && ! is_wp_error($cats)) :
			$cat_slugs_arr = array();
		foreach ($cats as $cat) {
			$cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'sermon_category') .'">' . $cat->name . '</a>';
		}
		$cats_slug_str = implode( ", ", $cat_slugs_arr);
		endif;
		
		$content ='<p>'.webnus_excerpt(36).'</p>';
		$category = ($cats_slug_str)?esc_html__('Category: ','webnus_framework') . $cats_slug_str:'';
		$date = get_the_time('F d, Y');
		$sep = ($cats_slug_str && $terms_slug_str )?' / ':'';
		$sep2 = ($date && $terms_slug_str )?' | ':'';
		$speaker = ($terms_slug_str)?esc_html__('Speaker: ','webnus_framework') . $terms_slug_str:'';
		$title = get_the_title();
		$permalink = get_the_permalink();
		$desc = $category.$sep.$speaker;
		$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'sermons-grid','echo'=>false, ) );
		global $sermon_meta;
		$w_sermon_meta = $sermon_meta->the_meta();
		$button=($type=='toggle')?'button dark-gray medium':'';
		if(!empty($w_sermon_meta)){
		$sermon_video = (array_key_exists('sermon_video',$w_sermon_meta))?'<a href="'.$w_sermon_meta['sermon_video'].'" class="fancybox-media '.$button.'" target="_self"><i class="fa-play-circle"></i><span class="media_label">'.esc_html__('WATCH','webnus_framework').'</span></a>':'';
		$sermon_audio = (array_key_exists('sermon_audio',$w_sermon_meta))?'<a href="#w-audio-'.$post_id.'" class="inlinelb '.$button.'" target="_self"><i class="fa-headphones"></i><span class="media_label">'.esc_html__('LISTEN','webnus_framework').'</span></a><div style="display:none"><div class="w-audio" id="w-audio-'.$post_id.'">'.do_shortcode('[audio mp3="'.$w_sermon_meta['sermon_audio'].'"][/audio]').'</div></div>':'';
		$sermon_pdf = (array_key_exists('sermon_pdf',$w_sermon_meta))?'<a href="'.$w_sermon_meta['sermon_pdf'].'" class="'.$button.'" target="_blank"><i class="fa-download"></i><span class="media_label">'.esc_html__('DOWNLOAD','webnus_framework').'</span></a>':'';
		}else{
			$sermon_audio=$sermon_video=$sermon_pdf='';
		}
		$sermon_read ='<a href="'.$permalink.'" class="'.$button.'" target="_self"><i class="fa-book"></i><span class="media_label">'.esc_html__('READ MORE','webnus_framework').'</span></a>';
		if ($type=='toggle'){	
			echo '[accordion title="'.$title.'"]'. $desc .'<br/>'.$date . $content . '<div class="media-links">'. $sermon_audio . $sermon_video . $sermon_pdf . $sermon_read. '</div>[/accordion]';
		}else if ($type=='minimal'){
			$icon=($icon)?$icon:'fa-microphone';
			$sermon_icon=($icon!='none')?'<i class="sermon-icon '.$icon.'"></i>':'';
			echo '<article><a href="'.$permalink.'">'.$sermon_icon.'<h4>'.$title.'</h4></a><div class="sermon-detail">'. $desc.'</div><div class="media-links">'. $sermon_audio . $sermon_video . $sermon_pdf . $sermon_read. '</div></article>';  
		}else if ($type=='grid'){
			$col = ($count<2)? 12/$count:6;
			$row = 12/$col;
			echo ($rcount == 1)?'<div class="row">':'';
			$image_media=($image)?'<figure class="sermon-img">'.$image.'</figure><div class="media-links abs-top">'. $sermon_audio . $sermon_video . $sermon_pdf . $sermon_read. '</div>':'<div class="media-links">'. $sermon_audio . $sermon_video . $sermon_pdf . $sermon_read. '</div>';			
			echo '<div class="col-md-'.$col.'"><article><div class="container s-area"><div class="col-md-9"><h5>'.$category.'</h5></div><div class="col-md-3"><div class="sermon-count"><i class="fa-eye"></i>'.webnus_getViews(get_the_ID()).'</div></div></div>'.$image_media.'<div class="container s-area"><div class="col-md-12"><h4><a href="'.$permalink.'">'.$title.'</a></h4><div class="sermon-detail">'.$speaker.$sep2.$date.'</div>'.$content.'</div></div></article></div>';
			if($rcount == $row){
				echo '</div>';
				$rcount = 0;
			}
			$rcount++;
		}else if ($type=='simple'){
			$col = ($count<5)? 12/$count:2;
			$row = 12/$col;
			$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'square','echo'=>false, ) );
			echo ($rcount == 1)?'<div class="row">':'';
			$image_media=($image)?'<figure class="sermon-img">'.$image.'</figure>':'';			
			echo '<div class="col-md-'.$col.' col-sm-'.$col.'"><article>'
				.$image_media.
				'<h4><a href="'.$permalink.'">'.$title.'</a></h4>
			</article></div>';
			if($rcount == $row){
				echo '</div>';
				$rcount = 0;
			}
			$rcount++;
		}else if ($type=='clean'){
			$col = ($count<5)? 12/$count:4;
			$row = 12/$col;
			$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'latest-cover','echo'=>false, ) );
			echo ($rcount == 1)?'<div class="row">':'';
			$image_media=($image)?'<figure class="sermon-img">'.$image.'</figure>':'';			
			echo '<div class="col-md-'.$col.' col-sm-'.$col.'"><article>'
				.$image_media.
				'<h4><a href="'.$permalink.'">'.$title.'</a></h4>
				<div class="sermon-detail">'.$speaker.$sep2.$date.'</div>
				<div class="media-links">'. $sermon_audio . $sermon_video . $sermon_pdf . $sermon_read. '</div>
			</article></div>';
			if($rcount == $row){
				echo '</div>';
				$rcount = 0;
			}
			$rcount++;
		}
	endwhile;
	echo "</div>";
		
if($page){ ?>
	<section class="container aligncenter">
        <?php 
			if(function_exists('wp_pagenavi')) {
				wp_pagenavi( array( 'query' => $query ) );
			}
	    ?>
        <hr class="vertical-space2">
    </section>  
	<?php }
		$out = ob_get_contents();
		ob_end_clean();	
		wp_reset_postdata();
		return $out;
	}
 add_shortcode('sermons', 'webnus_sermons');
?>