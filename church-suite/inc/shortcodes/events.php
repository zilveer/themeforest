<?php
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if ( is_plugin_active('the-events-calendar/the-events-calendar.php') ) {
function webnus_events( $attributes, $content = null ) {
	extract(shortcode_atts(	array(
		'type'=>'list',
		'count'=>'6',
		'page'=>'',
		'upcoming'=>'enable',
		'category'=>'',
	), $attributes));
	ob_start();
	$paged = ( is_front_page() ) ? 'page' : 'paged' ;
	$pages = ($page)?'&paged='.get_query_var($paged):'&paged=1';
	$display = ($upcoming)?'list':'custom';
	$args = ($category)?array(array('taxonomy' => 'tribe_events_cat','terms' => $category,),):null;
	$events = tribe_get_events(
			array(
				'posts_per_page'=>$count.$pages,
				'eventDisplay'=>$display,
				'tax_query'=> $args,
			)
	);
	echo '<div class="container events event-'.$type.'">';
	$col = ($count<5)? 12/$count:4;
	$row = 12/$col;
	$rcount= 1 ;
	foreach($events as $event){
		$ddate = tribe_get_start_date($event,false,'d');
		$mdate = tribe_get_start_date($event,false,'M');
		$fdate = tribe_get_start_date($event,false,'F');
		$day = tribe_get_start_date($event,false,'l');
		$year = tribe_get_start_date($event,false,'Y');
		$id = $event->ID;
		$title = $event->post_title;
		$place = tribe_get_venue($id);
		$address = tribe_get_address($id);
		$permalink = get_permalink($id);
		$cat =   tribe_get_event_categories($id);
		$sep = ($day  && $place )?', ':'';

		if ($type=='list'){
			echo '<article class="event-article container"><div class="col-md-9 col-sm-9"><div class="event-date"><span>'.$ddate.'</span>'.$mdate.'</div><h4 class="event-title">'.$title.'</h4><div class="event-detail">'.$day.$sep.$place.'</div></div><div class="col-md-3 col-sm-3 btn-wrapper"><a class="button dark-gray medium" href="'.$permalink.'">'.esc_attr__( 'EVENT DETAIL', 'webnus_framework' ).'</a></div></article>';
		}if ($type=='list2'){
			echo '<article class="event-article container">
			<div class="col-md-2 col-sm-2">
				<div class="event-date"><div class="event-d">'.$ddate.'</div><div class="event-f">'.$fdate.'</div><div class="event-da">'.$day.'</div></div>
			</div>
			<div class="col-md-6 col-sm-6">
			<h4 class="event-title"><a href="'.$permalink.'">'.$title.'</a></h4><div class="event-detail">'.$place.' | '.$address.'</div>';
			?>

			<ul class="event-sharing">
					<li class="event-share"><i class="event-sharing-icon fa-share-alt"></i>
					<ul class="event-social">
						<li><a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $permalink ;?>&amp;t=<?php the_title(); ?>" target="blank"><i class="fa-facebook"></i></a></li>
						<li><a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php echo $permalink ;?>" target="_blank"><i class="fa-google-plus"></i></a></li>
						<li><a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php echo $permalink ;?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php echo $permalink ;?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="fa-twitter"></i></a></li>
					</ul></li>
					<li class="event-map"><a class="fancybox-media" href="<?php echo esc_url(tribe_get_map_link($id));?>"><i class="fa-map-marker"></i></a></li>
					<li><a class="inlinelb" href="#w-contact"><i class="fa-envelope-o"></i></a></li>
				</ul>
			<?php
			echo'</div><div class="col-md-4 col-sm-4 btn-wrapper">';
			$webnus_options = webnus_options();
			$webnus_options['webnus_booking_enable'] = isset( $webnus_options['webnus_booking_enable'] ) ? $webnus_options['webnus_booking_enable'] : '';
				if($webnus_options['webnus_booking_enable']){
					$form_id=$webnus_options['webnus_booking_form'];
					echo webnus_modal_booking($id,$form_id,$title);
				}else{
					echo '<a class="button medium" href="'.$permalink.'">'.esc_attr__( 'EVENT DETAIL', 'webnus_framework' ).'</a>';
				}
			echo '</div></article>';
		}else if ($type=='minimal'){
			echo '<article class="event-article container"><div class="event-date"><span>'.$ddate.'</span>'.$mdate.'</div><h4 class="event-title"><a href="'.$permalink.'">'.$title.'</a></h4><div class="event-detail">'.$day.$sep.$place.'</div></article>';
		}else if ($type=='cover'){
			echo ($rcount % 2 != 0)?'<div class="row">':'';
			echo ($count == 1)?'<div class="col-md-12 col-sm-12">':'<div class="col-md-6 col-sm-6">';
			echo '<article class="event-article container">';
			echo tribe_event_featured_image($event->ID ,'latest-cover',true );
			echo '<div class="event-overlay"></div>
			<div class="event-content">
				<i class="event-icon fa-calendar"></i>
				<div class="event-date">'.$mdate.'<span> '.$ddate.'</span></div>
				<div class="event-date">'.$day.'</div>
				<h4 class="event-title">'.$title.'</h4>
				<div class="btn-wrapper">
					<a class="event-button" href="'.$permalink.'">'.esc_attr__( 'EVENT DETAIL', 'webnus_framework' ).'</a>
				</div>
			</div>
			</article>
			</div>';
			echo ($rcount % 2 == 0)?'</div>':'';
			$rcount++;

		}	else if ($type=='grid'){
			echo ($rcount == 1)?'<div class="row">':'';
			echo '<div class="col-md-'.$col.' col-sm-'.$col.'">';
			echo '<article class="event-article container">';
			echo tribe_event_featured_image($id ,'latest-cover',false );
			echo '<div class="event-content">
				<div class="event-detail">'.$mdate.'<span> '.$ddate.'</span> / '.$place.'</div>
				<a href="'.$permalink.'"><h4 class="event-title">'.$title.'</h4></a>
				<p>'.$address.'</p>
				</div>';
				?>
				<ul class="event-sharing">
					<li class="event-share"><i class="event-sharing-icon fa-share-alt"></i>
					<ul class="event-social">
						<li><a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $permalink ;?>&amp;t=<?php the_title(); ?>" target="blank"><i class="fa-facebook"></i></a></li>
						<li><a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php echo $permalink ;?>" target="_blank"><i class="fa-google-plus"></i></a></li>
						<li><a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php echo $permalink ;?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php echo esc_url($permalink) ;?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="fa-twitter"></i></a></li>
					</ul></li>
					<li class="event-map"><a class="fancybox-media" href="<?php echo esc_url(tribe_get_map_link($id));?>"><i class="fa-map-marker"></i></a></li>
					<li><a class="inlinelb" href="#w-contact"><i class="fa-envelope-o"></i></a></li>


				<?php $webnus_options = webnus_options();
				$webnus_options['webnus_booking_enable'] = isset( $webnus_options['webnus_booking_enable'] ) ? $webnus_options['webnus_booking_enable'] : '';
				if($webnus_options['webnus_booking_enable']){
					$form_id=$webnus_options['webnus_booking_form'];
					echo webnus_modal_booking($id,$form_id,$title);
				} ?>
				</ul>
			<?php echo '</article>
				</div>';
			if($rcount == $row){
				echo '</div>';
				$rcount = 0;
			}
			$rcount++;
			}else if ($type=='clean'){
			echo ($rcount == 1)?'<div class="row">':'';
			echo ($count == 1)?'<div class="col-md-12 col-sm-12">':'<div class="col-md-4 col-sm-4">';
			echo '<article class="event-article container"><div class="event-date">
			<span>'.$ddate.'</span>'.$mdate.'</div>
			<a href="'.$permalink.'"><h4 class="event-title">'.$title.'</h4></a>';
			echo ($place)?'<div class="event-detail">'.$place.'</div>':'';
			echo '</article></div>';
			if($rcount == 3){
				echo '</div>';
				$rcount = 0;
			}
			$rcount++;
			}else if ($type=='modern'){
			echo ($rcount % 2 != 0)?'<div class="row">':'';
			echo ($count == 1)?'<div class="col-md-12 col-sm-12">':'<div class="col-md-6 col-sm-6">';
			echo '<div class="event-wrapper"><article class="event-article">';
			echo tribe_event_featured_image($event->ID ,'latest-cover',true );
			echo '<div class="event-overlay"></div>
			<div class="event-content">
				<a href="'.$permalink.'"><h4 class="event-title">'.$title.'</h4></a>
				<div class="event-detail">'.$place.'</div>
				<div class="event-category">'.$cat.'</div>
			</div>
			</article>
			<div class="event-date"><div class="dday"> '.$ddate.'</div><div class="dmonth">'.$mdate.'</div><div class="dyear">'.$year.'</div></div>
			</div>
			</div>';
			echo ($rcount % 2 == 0)?'</div>':'';
			$rcount++;
		}
	}
	echo((($type=='cover') OR ($type=='modern'))&&($rcount % 2==0))?'</div>':'';
	echo((($type=='grid')OR($type=='clean'))&&($rcount !=1))?'</div>':'';
	echo '</div>';
	$out = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();
	return $out;
}
add_shortcode('events', 'webnus_events');
}
?>