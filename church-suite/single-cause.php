<?php
/******************/
/**  Single Cause
/******************/
get_header();
?>
<section class="container page-content" >
<hr class="vertical-space2">
<?php
$webnus_options = webnus_options();
$progressbar = $cause_days = $cause_donate = '';
$received = $percentage = 0;
$cause_meta_w = $cause_meta->the_meta();
if($cause_meta_w){
	$received = $cause_meta_w['cause_amount_received'];
	$amount = $cause_meta_w['cause_amount']; 
	$end = $cause_meta_w['cause_end']; 
	$webnus_options['webnus_cause_currency'] = isset( $webnus_options['webnus_cause_currency'] ) ? $webnus_options['webnus_cause_currency'] : '';
	$currency = $webnus_options['webnus_cause_currency'];
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
$webnus_options['webnus_singlecause_sidebar'] = isset( $webnus_options['webnus_singlecause_sidebar'] ) ? $webnus_options['webnus_singlecause_sidebar'] : '';
if($webnus_options['webnus_singlecause_sidebar'] == 'left'){ ?>
	<aside class="col-md-3 sidebar leftside">
		<?php dynamic_sidebar( 'Left Sidebar' ); ?>
	</aside>
<?php } ?>
<section class="<?php echo ($webnus_options['webnus_singlecause_sidebar']=='none')?'col-md-12':'col-md-9 cntt-w'?>">
<?php if( have_posts() ): while( have_posts() ): the_post();  ?>
<article class="blog-single-post">
<?php
webnus_setViews(get_the_ID());
$content = get_the_content(); ?>
<div class="post-trait-w"> <?php
if(!isset($background)) { ?>
<h2 class="cause-title"><?php the_title() ?></h2> <?php }	
?>
</div>
<div <?php post_class('post'); ?>>
<div class="row">
	<div class="col-md-8">
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
		<?php 
		$webnus_options['webnus_cause_featuredimage'] = isset( $webnus_options['webnus_cause_featuredimage'] ) ? $webnus_options['webnus_cause_featuredimage'] : '';
		if(  $webnus_options['webnus_cause_featuredimage'] && !isset($background) ){
		get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full', 'link_to_post' => false, ) ); 
		}
		echo apply_filters('the_content',$content); 
		?>
	</div>
	<div class="col-md-4">
	<div class="cause-box">
	<?php
		echo $progressbar.'<p class="cause-days">'.$cause_days.'</p>';
		$webnus_options['webnus_donate_form'] = isset( $webnus_options['webnus_donate_form'] ) ? $webnus_options['webnus_donate_form'] : '';
		if($days_left>=0 && $percentage<100 && $webnus_options['webnus_donate_form']){
			echo webnus_modal_donate();
		}else{
			echo '<p class="cause-completed">'.esc_html__('Has been completed','webnus_framework').'</p>';
		}	
		$webnus_options['webnus_cause_social_share'] = isset( $webnus_options['webnus_cause_social_share'] ) ? $webnus_options['webnus_cause_social_share'] : '';
		if($webnus_options['webnus_cause_social_share']) { ?>	
			<div class="cause-sharing">
				<i class="cause-sharing-icon fa-share-alt"></i>
				<div class="cause-social">
				<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><?php esc_html_e('FACEBOOK','webnus_framework');?></a>
				<a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><?php esc_html_e('GOOGLE+','webnus_framework');?></a>
				<a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><?php esc_html_e('TWITTER','webnus_framework');?></a>
				</div>
			</div>
		<?php } ?>
	</div>
	</div>
</div>
<br class="clear"> 
<?php the_tags( '<div class="post-tags"><i class="fa-tags"></i>', '', '</div>' ); ?><!-- End Tags --> 
<div class="next-prev-posts">
<?php $args = array(
'before'           => '',
'after'            => '',
'link_before'      => '',
'link_after'       => '',
'next_or_number'   => 'next',
'nextpagelink'     => '&nbsp;&nbsp; '.esc_html__('Next Page','webnus_framework'),
'previouspagelink' => esc_html__('Previous Page','webnus_framework').'&nbsp;&nbsp;',
'pagelink'         => '%',
'echo'             => 1
); 
wp_link_pages($args);
?>	  
</div><!-- End next-prev post -->

</div>
</article>
<?php 
endwhile;
endif;
comments_template(); ?>
</section>
<!-- end-main-conten -->

<?php
if($webnus_options['webnus_singlecause_sidebar'] == 'right' ){ ?>
	<aside class="col-md-3 sidebar">
		<?php dynamic_sidebar( 'Right Sidebar' ); ?>
	</aside>
<?php } ?>

<div class="white-space"></div>
</section>
<?php 
get_footer();
?>