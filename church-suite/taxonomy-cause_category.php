<?php
	get_header();
	$webnus_options = webnus_options();
?>
<section id="headline"><div class="container"><h2><?php printf(  '%s', single_term_title( '', false ) ); ?></h2></div></section>
<section class="container page-content" ><hr class="vertical-space2">
<?php
echo '<section class="col-md-12 omega causes causes-list">';
if(have_posts()):
	while( have_posts() ): the_post();
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
			$out=$percentage.'% DONATED OF '.$currency.$amount;
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
		$permalink = get_the_permalink();
		$content ='<p>'.webnus_excerpt(36).'</p>';
		$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog2_thumb','echo'=>false, ) );	
		$title = '<h4><a class="cause-title" href="'.$permalink.'">'.get_the_title().'</a></h4>';

?>
	<article id="post-<?php the_ID(); ?>">
	<div class="row">
		<div class="col-md-4">
			<?php echo ($image)?'<figure class="cause-img">'.$image.'</figure>':''; ?>
		</div>
		<div class="col-md-8">
			<?php
			echo '<div class="cause-content">'.$title;
			?>
			<div class="postmetadata">
				<ul class="cause-metadata">
				<?php
				$webnus_options['webnus_cause_date'] = isset( $webnus_options['webnus_cause_date'] ) ? $webnus_options['webnus_cause_date'] : '';
				if($webnus_options['webnus_cause_date']){ ?>	
				<li class="cause-date"> <i class="fa-calendar-o"></i><span><?php the_time('F d, Y') ?></span> </li>
				<?php }
				$webnus_options['webnus_cause_category'] = isset( $webnus_options['webnus_cause_category'] ) ? $webnus_options['webnus_cause_category'] : '';
				if($webnus_options['webnus_cause_category']){ ?>
				<li class="cause-comments"> <i class="fa-folder"></i><span><?php the_terms(get_the_id(), 'cause_category', '',' | ','' ); ?></span> </li>
				<?php }
				$webnus_options['webnus_cause_comments'] = isset( $webnus_options['webnus_cause_comments'] ) ? $webnus_options['webnus_cause_comments'] : '';
				if($webnus_options['webnus_cause_comments']){ ?>
				<li class="cause-comments"> <i class="fa-comments"></i><span><?php comments_number(); ?></span> </li>
				<?php }
				$webnus_options['webnus_cause_views'] = isset( $webnus_options['webnus_cause_views'] ) ? $webnus_options['webnus_cause_views'] : '';
				if($webnus_options['webnus_cause_views']){ ?>
				<li  class="cause-views"> <i class="fa-eye"></i><span><?php echo webnus_getViews(get_the_ID()); ?></span><?php esc_html_e(' Views','webnus_framework');?></li>
				<?php } ?>
				</ul>
			</div>
			<?php echo $content.'<div class="cause-meta">'.$progressbar;
			$webnus_options['webnus_donate_form'] = isset( $webnus_options['webnus_donate_form'] ) ? $webnus_options['webnus_donate_form'] : '';
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
		<?php } ?>
		</div>
	</div>
	</article>
<?php
	endwhile;
endif;

if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
	echo '<div class="wp-pagenavi">';
	next_posts_link(esc_html__('&larr; Previous page', 'webnus_framework'));
	previous_posts_link(esc_html__('Next page &rarr;', 'webnus_framework'));
	echo '<hr class="vertical-space">';
} ?>
</section>

</section>
<?php get_footer(); ?>