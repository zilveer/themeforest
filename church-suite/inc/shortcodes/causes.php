<?php
 function webnus_causes( $attributes, $content = null ) {
extract(shortcode_atts(	array(
	'type'=>'grid',
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
	$query = new WP_Query('post_type=cause&posts_per_page='.$count.'&category_name='.$category.$pages.$view);
?>
<div class="container causes causes-<?php echo $type ?>">
<?php
	if(empty($count)){
		$count=1;
	}
	$col = ($count<5)? 12/$count:4;
	$row = 12/$col;
	$rcount= 1 ;
	while ($query -> have_posts()) : $query -> the_post();	
		$post_id = get_the_ID();
		$cats = get_the_terms( $post_id , 'cause_category' );
		if(is_array($cats)){
			$cause_category = array();
			foreach($cats as $cat){
				$cause_category[] = $cat->slug;
			}
		}else $cause_category=array();
		$cats = get_the_terms($post_id, 'cause_category' );
		$cats_slug_str = '';
		if ($cats && ! is_wp_error($cats)) :
			$cat_slugs_arr = array();
		foreach ($cats as $cat) {
			$cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'cause_category') .'">' . $cat->name . '</a>';
		}
		$cats_slug_str = implode( ", ", $cat_slugs_arr);
		endif;
		
	
		$category = ($cats_slug_str)?esc_html__('Category: ','webnus_framework') . $cats_slug_str:'';
		$date = get_the_time('F d, Y');
		$permalink = get_the_permalink();
		$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'sermons-gridmons-grid','echo'=>false, ) );
		$image2 = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog2_thumb','echo'=>false, ) );	
		$title = '<h4><a class="cause-title" href="'.$permalink.'">'.get_the_title().'</a></h4>';
		$content ='<p>'.webnus_excerpt(16).'</p>';
		$view = '<div class="cause_view"><i class="fa-eye"></i>'.webnus_getViews($post_id).'</div>';
		$webnus_options = webnus_options();
		$webnus_options['webnus_donate_form'] = isset( $webnus_options['webnus_donate_form'] ) ? $webnus_options['webnus_donate_form'] : '';
		global $cause_meta;
		$progressbar = $cause_days = $cause_donate = '';
		$received = $percentage = 0;
		$cause_meta_w = $cause_meta->the_meta();
		if($cause_meta_w){
			$received = $cause_meta_w['cause_amount_received'];
			$amount = $cause_meta_w['cause_amount']; 
			$end = $cause_meta_w['cause_end']; 
			$webnus_options['webnus_cause_currency'] = isset( $webnus_options['webnus_cause_currency'] ) ? $webnus_options['webnus_cause_currency'] : '';
			$currency = esc_html($webnus_options['webnus_cause_currency']);
		}
		if($amount) {
			$percentage = ($received/$amount)*100;
			$percentage = round($percentage);
			$out=$percentage.'% '.esc_html__('DONATED OF ','webnus_framework').$currency.$amount;
			$progressbar = do_shortcode('[vc_progress_bar values="'.$percentage.'|'.$out.'" bgcolor="custom" options="striped,animated" custombgcolor="#f9c41e"]');
		}
		$now = date('Y-m-d 23:59:59');
		$now = strtotime($now);
		$end_date = $end.' 23:59:59';
		$your_date = strtotime($end_date);
		$datediff = $your_date - $now;
		$days_left = floor($datediff/(60*60*24)); 
		$date_msg = '';
		if($days_left==0) {$date_msg = '1';}
		elseif($days_left<0) {$date_msg = 'No';}
		else {$date_msg = $days_left+'1'.'';}
		$cause_days = ($percentage<100)?'<span>'.$date_msg.'</span> '.esc_html__('Days left to achieve target','webnus_framework'):esc_html__('Thank You','webnus_framework');
		if ($type=='grid'){
			echo ($rcount == 1)?'<div class="row">':'';		
			echo '<div class="col-md-'.$col.' col-sm-'.$col.'"><article>'.$image;
			echo '<div class="cause-content">'.$title.$content;
			echo '<div class="cause-meta">'.$progressbar.'<p class="cause-days">'.$cause_days.'</p>';
			if($days_left>=0 && $percentage<100 && $webnus_options['webnus_donate_form']){
				echo webnus_modal_donate();
			}else{
				echo '<p class="cause-completed">'.esc_html__('Has been completed','webnus_framework').'</p>';
			}	
			echo '</div></article></div>';
			if($rcount == $row){
				echo '</div>';
				$rcount = 0;
			}
			$rcount++;
		}
		elseif ($type=='list'){
			echo '<article id="post-'.$post_id.'"><div class="row"><div class="col-md-4">';
			echo ($image)?'<figure class="cause-img">'.$image2.'</figure>':'';
			echo '</div><div class="col-md-8"><div class="cause-content">'.$title.'<div class="postmetadata">';
			?>
			<ul class="cause-metadata">
			<?php
			$webnus_options['webnus_cause_date'] = isset( $webnus_options['webnus_cause_date'] ) ? $webnus_options['webnus_cause_date'] : '';
			if($webnus_options['webnus_cause_date']){ ?>	
			<li class="cause-date"> <i class="fa-calendar-o"></i><span><?php the_time('F d, Y') ?></span> </li>
			<?php }
			$webnus_options['webnus_cause_category'] = isset( $webnus_options['webnus_cause_category'] ) ? $webnus_options['webnus_cause_category'] : '';
			if($webnus_options['webnus_cause_category']){ ?>
			<li class="cause-comments"> <i class="fa-folder"></i><span><?php the_terms($post_id, 'cause_category', '',' | ','' ); ?></span> </li>
			<?php }
			$webnus_options['webnus_cause_comments'] = isset( $webnus_options['webnus_cause_comments'] ) ? $webnus_options['webnus_cause_comments'] : '';
			if($webnus_options['webnus_cause_comments']){ ?>
			<li class="cause-comments"> <i class="fa-comments"></i><span><?php comments_number(); ?></span> </li>
			<?php }
			$webnus_options['webnus_cause_views'] = isset( $webnus_options['webnus_cause_views'] ) ? $webnus_options['webnus_cause_views'] : '';
			if($webnus_options['webnus_cause_views']){ ?>
			<li  class="cause-views"> <i class="fa-eye"></i><span><?php echo webnus_getViews($post_id); ?></span><?php esc_html_e(' Views','webnus_framework');?></li>
			<?php } ?>
			</ul>
			</div>
			<?php echo $content.'<div class="cause-meta">'.$progressbar;
			if($days_left>=0 && $percentage<100 && $webnus_options['webnus_donate_form']){
				echo webnus_modal_donate();
			}else{
				echo '<p class="cause-completed">'.esc_html__('Has been completed','webnus_framework').'</p>';
			}				
			$webnus_options['webnus_cause_social_share'] = isset( $webnus_options['webnus_cause_social_share'] ) ? $webnus_options['webnus_cause_social_share'] : '';
			if($webnus_options['webnus_cause_social_share']) { ?>	
			<div class="cause-sharing">
				<div class="cause-social">
				<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><i class="cause-sharing-icon fa-facebook"></i></a>
				<a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="cause-sharing-icon fa-google-plus"></i></a>
				<a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="cause-sharing-icon fa-twitter"></i></a>
				</div>
			</div>
			<?php }
			echo '</div></div></article>';
		}
	endwhile;
	echo(($type=='grid')&&($rcount !=1))?'</div>':'';
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
 add_shortcode('causes', 'webnus_causes');
?>