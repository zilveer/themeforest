<?php
get_header();

require(get_template_directory().'/inc/cb-general-options.php');

?>
</div>

</div>
<!-- bg_head end -->

<div id="middle" class="homer">
	<div class="wrapper_p">
	<?php
	if($home_cat=='') $home_cat=1;
	if($home_number=='') $home_number=3;

	$cc=1;
	$columns=$home_template;

	require(get_template_directory().'/inc/cb-little-head.php');
	if(!isset($mcc))$mcc='';


	$fr='frame'; $frin='framein';

	$col_v='col'.$columns;
	$coll=$columns;

	$mmb='';
	if(!isset($roundy))$roundy='';
	if(!isset($mediumblog))$mediumblog='';

	$h=300;
	if($coll==1) { $h=500; $con_lg='300'; }
	if($coll==2) { $h=400; $con_lg='200'; }
	if($coll==3) { $h=300; $con_lg='100'; }
	if($coll==4) { $h=200; $con_lg='75'; }

	$mths='';

	?>

	<?php if($h_sid!='') { if ($sidebar=='left') { ?>
		<div id="sidebar_l">
			<ul>
			<?php if($h_sid!='') { dynamic_sidebar($h_sid); } else { dynamic_sidebar('sidebar'); } ?>
			</ul>
		</div>
		<!-- sidebar #end -->
		<?php } } ?>
		<div id="blog-masonry" <?php if($h_sid!='') { ?> class="side"
		<?php } ?>>

			<?php

			// blog title & featured image

			/* -------------------------------------------------------------------------------- */
			/* -------------------------------------------------------------------------------- */

			?>

			<div id="blog-inside">

			<?php
			$cc=1;
			$sticky=get_option( 'sticky_posts' );
			rsort( $sticky );
			if(!isset($sticky[0])) $sticky[0]='';
			query_posts( array( 'post__in' => $sticky,'ignore_sticky_posts' => 1 ) );
			if(have_posts()&&$sticky[0]) :
			while(have_posts()) : the_post() ?>
			<?php require('inc/cb-post-options.php');
			$columns=$coll;
			$catcount = get_the_category();
			$max_posts=$catcount[0]->category_count;
			?>

				<div id="post-<?php echo $post->ID; ?>"
					class="postbox post-cat <?php echo $col_v; ?>">
					<div
						class="<?php if (has_post_format('quote')) echo 'post_quote';  if (has_post_format('link')) echo 'post_link';  if (has_post_format('gallery')) echo 'post_gallery'; echo ' ddd';?> blog_inside_post">

						<?php

						$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID);
						$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
						$murl='';$video='';$video='';$sl_space=''; // reset values in the loop
						$post_type=get_post_meta($post->ID, 'cb5_cb_type', $single = true);
						$s_beh=get_post_meta($post->ID, 'cb5_s_beh', $single = true);

						/* -------------------------------------------------------------------------------- */
						/* -------------------------------------------------------------------------------- */

						//audio & video
						$mcc='';
						if($post_type=='audio'||$post_type=='video'){
							wp_enqueue_script('videojs',WP_THEME_URL.'/inc/js/video-js/video.min.js', array('jquery'), '1.0', true);
							$pos=false;
							$aurl=get_post_meta($post->ID, 'cb5_aurl', $single = true);
							$vurl=get_post_meta($post->ID, 'cb5_vurl', $single = true);

							if($post_type=='audio') $murl=$aurl; else $murl=$vurl;
							$pos = strpos($murl,'vimeo.com');
							if(!isset($ss)) $ss='';
							if(preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $murl, $match)) { $video=$match[1]; }
							if($video!='') { echo '<div class="'.$fr.' '.$roundy.' in cb5_media"><div class="'.$frin.'">'.$mcc.'<iframe class="cb5_media" height="'.$h.'" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent&amp;controls=1&amp;showinfo=0" title="'.get_the_title().'"></iframe></div></div>'; }

							if($pos===false) { } else {
								$video=substr($murl,17,8);
								echo '<div class="'.$fr.' '.$roundy.' in cb5_media"><div class="'.$frin.'">'.$mcc.'<iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0"></iframe></div></div>';
							}

							if($video==''&&$pos===false&&$murl!='') {

								if($post_type=='audio') $h2='42'; else $h2=$h;
								if($post_type=='audio') $aa='2'; else $aa='';
								echo '<div class="'.$fr.' '.$roundy.' in cb5_media'.$aa.'"><div class="'.$frin.'">'.$mcc.'<video id="media-'.$post->ID.'" class="video-js vjs-default-skin cb5_media'.$aa.'" controls preload="none" width="'.$w.'" height="'.$h.'" poster="" data-setup=> <source src="'.$murl.'" type="video/mp4" /> </video></div></div>';
							}

						} //audio & video end

						/* -------------------------------------------------------------------------------- */
						/* -------------------------------------------------------------------------------- */

						//slider
						if($post_type=='slider'&&$s_beh!='cat') {
							wp_enqueue_style('any', WP_THEME_URL.'/inc/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
							wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
							wp_enqueue_script('any',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
							wp_enqueue_script('anyfx',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.fx.min.js', array('jquery'), '1.0', true);


							$sl_space='<div class="cl"></div>';

							$pid=$post->ID; $slid_id=substr(rand(),0,3);

							if($s_beh!='cat') $rc='true'; else $rc='false';

							echo '<script type="text/javascript">
		jQuery(function(){
		 jQuery(\'#slider'.$slid_id.$pid.'\').anythingSlider({
			resizeContents      : false,	
			hashTags            : false,
			autoPlay            : '.$s_auto.',     
			pauseOnHover        : true,    
			resumeOnVideoEnd    : true,
			delay               : '.$s_delay.',     
			animationTime       : '.$s_ani_time.',    
			easing              : \''.$s_easing.'\'
		  });
		});
	</script><div class="any-slider-container"><div class="'.$fr.' '.$roundy.' in"><div class="'.$frin.'">'.$mcc.'<div><ul id="slider'.$slid_id.$pid.'" class="slider any-slider">';

							if($s_beh!='cat'){

								$imgs=get_children('post_type=attachment&order=asc&orderby=menu_order&post_mime_type=image&post_parent='.$post->ID);

								foreach ($imgs as $att_id => $att) {
									$gall_img=wp_get_attachment_image_src($att_id,'full');
									echo '<li><div class="textSlide"><a href="'.$gall_img[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($gall_img[0], array('width' => 980, 'height'=>980, 'crop' => true)).'" class="'.$roundy.' fade-s" alt="slide image"/><div class="cl"></div></div></a></li>';
								}

							} echo '</ul></div></div></div></div>';

						} // slider end

						/* -------------------------------------------------------------------------------- */
						/* -------------------------------------------------------------------------------- */

						if(($post_type!='slider'&&$post_type!='video'&&$post_type!='audio')||$post_type=='slider'&&$s_beh=='cat') {

							if($isrc) { ?>
						<div class="blog_item <?php echo $fr; ?> fade in">
							<div class="<?php echo $frin; ?>">
							<?php if($coll=='1'){ ?>
								<div class="fade_c">
									<div class="fade_icons">
										<div class="fade_icons_in">
											<a class="icon i2" href="<?php echo $isrc[0]; ?>"
												data-rel="pp"><i class="icon-eye-open"></i> </a> <a
												class="icon i1" href="<?php echo get_permalink();?>"><i
												class="icon-link"></i> </a>
										</div>
									</div>
								</div>
								<?php } else { ?>
								<div class="fade_c">
									<div class="see_more_wrap">
										<div class="see_wrap2">
											<a href="<?php echo get_permalink();?>"> <img
												src="<?php echo WP_THEME_URL; ?>/img/icons/arr_rw.png"
												class="fade-s fade_arr_r"
												alt="<?php _e('see more','cb-cosmetico');?>" />
												<h1>
													<span class="fade_see"><?php _e('see more','cb-cosmetico'); ?>
													</span>
												</h1> </a>
										</div>
									</div>
									<div class="cl"></div>
								</div>
								<?php } ?>
								<a href="<?php echo get_permalink(); ?>"><img
									src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'crop' => true)); ?>"
									class="fade-s fade-si" alt="featured image" /> </a>
								<div class="cl"></div>
							</div>
						</div>
						<?php }

						} // else end
						//echo $div_left;
						?>


						<div class="recent_inside">

						<?php if($columns==2&&$side!='yes') { ?>
							<style>
ul.post_details2 li.cat {
	display: block !important;
}
</style>
<?php } ?>

<?php $datee=' <h3 class="date_title skin-text"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_avatar(get_the_author_meta('ID'),32).get_the_author().'</a> <i class="icon-time"></i> '.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</h3>'; ?>
<?php if($coll!='1'){echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end; } else {
	echo '<h1 class="mbimp blog_title"><a href="'.get_permalink().'">'.get_the_title().'</a></h1>';
}
if($coll!='1'){echo $datee;} else {
	echo ' <h3 class="date_title skin-text"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_avatar(get_the_author_meta('ID'),32).get_the_author().'</a> <i class="icon-time"></i> '.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'';
	$tags=''; $posttags=get_the_tags(); if ($posttags) { foreach($posttags as $tag) { if($tag->name!='') $tags .='<a href="'.get_tag_link($tag->term_id).'">'.$tag->name . '</a> '; } }
	if($tags!='') { echo '<span class="tags"><i class="icon-tags"></i> '.$tags.'</span>'; $tags='';  }
	echo '<span class="comments"><i class="icon-comments"></i> '; echo comments_number('0 Comments', '1 Comments', '% Comments'); echo '</span>';
	$categories = get_the_category(); $output = ''; echo '<span class="cats">';
	foreach($categories as $category) {
		$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, ';
	}
	echo '<i class="icon-folder-open"></i> Posted in: '.substr(trim($output),0,-1).'</span>';
	echo '</h3>';
} ?>
							<p>
							<?php
							$con=get_the_content();
							echo strip_cn($con,$con_lg);
							?>
							</p>



							<?php if($coll!='1'){?>
							<a href="<?php echo get_permalink(); ?>" class="bttn_big"><?php _e('read more','cb-cosmetico');?>
							</a>
							<?php } else {?>
							<div class="cat_read_more">
								<div class="cb_social">
									<a
										onClick="MyWindow=window.open('http://twitter.com/home?status=Currently Reading <?php the_title(); ?> (<?php the_permalink(); ?>)','MyWindow','width=600,height=400'); return false;"
										title="Share on Twitter" target="_blank" id="twitter-share"><i
										class="icon-twitter"></i> </a> <a
										href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>"
										onClick="window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent('<?php the_permalink() ?>')+’&amp;title=’+encodeURIComponent('<?php the_title() ?>'),'sharer', 'toolbar=no,width=550,height=550'); return false;"
										title="Share on Facebook" target="_blank" id="fbook-share"><i
										class="icon-facebook"></i> </a> <a
										onClick="MyWindow=window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','MyWindow','width=600,height=400'); return false;"
										title="Share on Google+" target="_blank" id="google-share"><i
										class="icon-google-plus"></i> </a> <a
										onClick="MyWindow=window.open('http://pinterest.com/pin/create/button/','MyWindow','width=600,height=400'); return false;"
										class="pin-it-button" count-layout="none" target="_blank"
										id="pinterest-share"><i class="icon-pinterest"></i> </a> <a
										onClick="MyWindow=window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php echo home_url(); ?>','MyWindow','width=600,height=400'); return false;"
										title="Share on LinkedIn" target="_blank" id="linkedin-share"><i
										class="icon-linkedin"></i> </a>
								</div>
								<a class="bttn blog_bttn" href="<?php echo get_permalink();?>"><?php _e('read more','cb-cosmetico');?>
								</a>
							</div>
							<?php }?>
						</div>


						<?php echo $div_close; ?>
						<div class="cl"></div>
						<?php echo $sl_space; ?>
					</div>
					<!--/blog post inside end-->
				</div>
				<!--/blog post end-->

				<div class="cl"></div>

				<?php $cc++;
				endwhile; else : ?>


				<?php endif; ?>

				<?php wp_reset_query();
				$cc=1;
				$cpo='0';
				if($home_number>0){ query_posts('cat='.$home_cat.'&posts_per_page='.$home_number);
				if(have_posts()) :
				while(have_posts()) : the_post() ?>
				<?php require('inc/cb-post-options.php');
				$columns=$coll;
				$catcount = get_the_category();
				$max_posts=$catcount[0]->category_count;
				?>

				<div id="post-<?php echo $post->ID; ?>"
					class="postbox post-cat <?php echo $col_v; ?>">
					<div
						class="<?php if (has_post_format('quote')) echo 'post_quote';  if (has_post_format('link')) echo 'post_link';  if (has_post_format('gallery')) echo 'post_gallery'; echo ' ddd';?> blog_inside_post">

						<?php

						$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID);
						$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
						$murl='';$video='';$video='';$sl_space=''; // reset values in the loop
						$post_type=get_post_meta($post->ID, 'cb5_cb_type', $single = true);
						$s_beh=get_post_meta($post->ID, 'cb5_s_beh', $single = true);

						/* -------------------------------------------------------------------------------- */
						/* -------------------------------------------------------------------------------- */

						//audio & video
						$mcc='';
						if($post_type=='audio'||$post_type=='video'){
							wp_enqueue_script('videojs',WP_THEME_URL.'/inc/js/video-js/video.min.js', array('jquery'), '1.0', true);
							$pos=false;
							$aurl=get_post_meta($post->ID, 'cb5_aurl', $single = true);
							$vurl=get_post_meta($post->ID, 'cb5_vurl', $single = true);

							if($post_type=='audio') $murl=$aurl; else $murl=$vurl;
							$pos = strpos($murl,'vimeo.com');
							if(!isset($ss)) $ss='';
							if(preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $murl, $match)) { $video=$match[1]; }
							if($video!='') { echo '<div class="'.$fr.' '.$roundy.' in cb5_media"><div class="'.$frin.'">'.$mcc.'<iframe class="cb5_media" height="'.$h.'" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent&amp;controls=1&amp;showinfo=0" title="'.get_the_title().'"></iframe></div></div>'; }

							if($pos===false) { } else {
								$video=substr($murl,17,8);
								echo '<div class="'.$fr.' '.$roundy.' in cb5_media"><div class="'.$frin.'">'.$mcc.'<iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0"></iframe></div></div>';
							}

							if($video==''&&$pos===false&&$murl!='') {

								if($post_type=='audio') $h2='42'; else $h2=$h;
								if($post_type=='audio') $aa='2'; else $aa='';
								echo '<div class="'.$fr.' '.$roundy.' in cb5_media'.$aa.'"><div class="'.$frin.'">'.$mcc.'<video id="media-'.$post->ID.'" class="video-js vjs-default-skin cb5_media'.$aa.'" controls preload="none" width="'.$w.'" height="'.$h.'" poster="" data-setup=> <source src="'.$murl.'" type="video/mp4" /> </video></div></div>';
							}

						} //audio & video end

						/* -------------------------------------------------------------------------------- */
						/* -------------------------------------------------------------------------------- */

						//slider
						if($post_type=='slider'&&$s_beh!='cat') {
							wp_enqueue_style('any', WP_THEME_URL.'/inc/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
							wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
							wp_enqueue_script('any',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
							wp_enqueue_script('anyfx',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.fx.min.js', array('jquery'), '1.0', true);


							$sl_space='<div class="cl"></div>';

							$pid=$post->ID; $slid_id=substr(rand(),0,3);

							if($s_beh!='cat') $rc='true'; else $rc='false';

							echo '<script type="text/javascript">
		jQuery(function(){
		 jQuery(\'#slider'.$slid_id.$pid.'\').anythingSlider({
			resizeContents      : false,	
			hashTags            : false,
			autoPlay            : '.$s_auto.',     
			pauseOnHover        : true,    
			resumeOnVideoEnd    : true,
			delay               : '.$s_delay.',     
			animationTime       : '.$s_ani_time.',    
			easing              : \''.$s_easing.'\'
		  });
		});
	</script><div class="any-slider-container"><div class="'.$fr.' '.$roundy.' in"><div class="'.$frin.'">'.$mcc.'<div><ul id="slider'.$slid_id.$pid.'" class="slider any-slider">';

							if($s_beh!='cat'){

								$imgs=get_children('post_type=attachment&order=asc&orderby=menu_order&post_mime_type=image&post_parent='.$post->ID);

								foreach ($imgs as $att_id => $att) {
									$gall_img=wp_get_attachment_image_src($att_id,'full');
									echo '<li><div class="textSlide"><a href="'.$gall_img[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($gall_img[0], array('width' => 980, 'height'=>980, 'crop' => true)).'" class="'.$roundy.' fade-s" alt="slide image"/><div class="cl"></div></div></a></li>';
								}

							} echo '</ul></div></div></div></div>';

						} // slider end

						/* -------------------------------------------------------------------------------- */
						/* -------------------------------------------------------------------------------- */

						if(($post_type!='slider'&&$post_type!='video'&&$post_type!='audio')||$post_type=='slider'&&$s_beh=='cat') {

							if($isrc) { ?>
						<div class="blog_item <?php echo $fr; ?> fade in">
							<div class="<?php echo $frin; ?>">
							<?php if($coll=='1'){ ?>
								<div class="fade_c">
									<div class="fade_icons">
										<div class="fade_icons_in">
											<a class="icon i2" href="<?php echo $isrc[0]; ?>"
												data-rel="pp"><i class="icon-eye-open"></i> </a> <a
												class="icon i1" href="<?php echo get_permalink();?>"><i
												class="icon-link"></i> </a>
										</div>
									</div>
								</div>
								<?php } else { ?>
								<div class="fade_c">
									<div class="see_more_wrap">
										<div class="see_wrap2">
											<a href="<?php echo get_permalink();?>"> <img
												src="<?php echo WP_THEME_URL; ?>/img/icons/arr_rw.png"
												class="fade-s fade_arr_r"
												alt="<?php _e('see more','cb-cosmetico');?>" />
												<h1>
													<span class="fade_see"><?php _e('see more','cb-cosmetico'); ?>
													</span>
												</h1> </a>
										</div>
									</div>
									<div class="cl"></div>
								</div>
								<?php } ?>
								<a href="<?php echo get_permalink(); ?>"><img
									src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'crop' => true)); ?>"
									class="fade-s fade-si" alt="featured image" /> </a>
								<div class="cl"></div>
							</div>
						</div>
						<?php }

						} // else end
						//echo $div_left;
						?>


						<div class="recent_inside">

						<?php if($columns==2&&$side!='yes') { ?>
							<style>
ul.post_details2 li.cat {
	display: block !important;
}
</style>
<?php } ?>

<?php $datee=' <h3 class="date_title skin-text"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_avatar(get_the_author_meta('ID'),32).get_the_author().'</a> <i class="icon-time"></i> '.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</h3>'; ?>
<?php if($coll!='1'){echo $headi.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.$headi_end; } else {
	echo '<h1 class="mbimp blog_title"><a href="'.get_permalink().'">'.get_the_title().'</a></h1>';
}
if($coll!='1'){echo $datee;} else {
	echo ' <h3 class="date_title skin-text"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_avatar(get_the_author_meta('ID'),32).get_the_author().'</a> <i class="icon-time"></i> '.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'';
	$tags=''; $posttags=get_the_tags(); if ($posttags) { foreach($posttags as $tag) { if($tag->name!='') $tags .='<a href="'.get_tag_link($tag->term_id).'">'.$tag->name . '</a> '; } }
	if($tags!='') { echo '<span class="tags"><i class="icon-tags"></i> '.$tags.'</span>'; $tags='';  }
	echo '<span class="comments"><i class="icon-comments"></i> '; echo comments_number('0 Comments', '1 Comments', '% Comments'); echo '</span>';
	$categories = get_the_category(); $output = ''; echo '<span class="cats">';
	foreach($categories as $category) {
		$output .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, ';
	}
	echo '<i class="icon-folder-open"></i> Posted in: '.substr(trim($output),0,-1).'</span>';
	echo '</h3>';
} ?>
							<p>
							<?php
							$con=get_the_content();
							echo strip_cn($con,$con_lg);
							?>
							</p>



							<?php if($coll!='1'){?>
							<a href="<?php echo get_permalink(); ?>" class="bttn_big"><?php _e('read more','cb-cosmetico');?>
							</a>
							<?php } else {?>
							<div class="cat_read_more">
								<div class="cb_social">
									<a
										onClick="MyWindow=window.open('http://twitter.com/home?status=Currently Reading <?php the_title(); ?> (<?php the_permalink(); ?>)','MyWindow','width=600,height=400'); return false;"
										title="Share on Twitter" target="_blank" id="twitter-share"><i
										class="icon-twitter"></i> </a> <a
										href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>"
										onClick="window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent('<?php the_permalink() ?>')+’&amp;title=’+encodeURIComponent('<?php the_title() ?>'),'sharer', 'toolbar=no,width=550,height=550'); return false;"
										title="Share on Facebook" target="_blank" id="fbook-share"><i
										class="icon-facebook"></i> </a> <a
										onClick="MyWindow=window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','MyWindow','width=600,height=400'); return false;"
										title="Share on Google+" target="_blank" id="google-share"><i
										class="icon-google-plus"></i> </a> <a
										onClick="MyWindow=window.open('http://pinterest.com/pin/create/button/','MyWindow','width=600,height=400'); return false;"
										class="pin-it-button" count-layout="none" target="_blank"
										id="pinterest-share"><i class="icon-pinterest"></i> </a> <a
										onClick="MyWindow=window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php echo home_url(); ?>','MyWindow','width=600,height=400'); return false;"
										title="Share on LinkedIn" target="_blank" id="linkedin-share"><i
										class="icon-linkedin"></i> </a>
								</div>
								<a class="bttn blog_bttn" href="<?php echo get_permalink();?>"><?php _e('read more','cb-cosmetico');?>
								</a>
							</div>
							<?php }?>
						</div>


						<?php echo $div_close; ?>
						<div class="cl"></div>
						<?php echo $sl_space; ?>
					</div>
					<!--/blog post inside end-->
				</div>
				<!--/blog post end-->

				<div class="cl"></div>

				<?php $cc++;
				endwhile; else : ?>

				<h1>
				<?php _e('Configure this page in Wordpress Settings &raquo; Reading or load Demo Content.','cb-cosmetico'); ?>
				</h1>

				<?php endif;
				wp_reset_query();
				} ?>


				<?php if(get_the_title()=='Hello world!'&&$cpo=='1') echo '<h3>Load demo content in Cosmetico->Demo Content<br/><br/>or<br/><br/>Configure this area in Settings->Reading<h3/>'; ?>
			</div>


			<?php
			$masend='';
			$massdnm='
      columnWidth: function( containerWidth ) {
              return containerWidth /'.$coll.';
            }';

			echo '

<script type="text/javascript">
"use strict";
  jQuery(function(){
   var widd=jQuery(document).width();
   if(widd>768) {
jQuery(\'#blog-masonry\').imagesLoaded( function(){
   jQuery(\'.blog-masonry.hidden_blog\').show();
   jQuery(\'.hidden_blog_loader\').hide();

   jQuery(\'#blog-masonry\').masonry({
      itemSelector: \'.postbox\', 
      '.$massdnm.'
    });

   var gridh=jQuery(\'.grid_fullw #blog-masonry\').height();
   jQuery(\'.grid_fullw #blog-masonry\').parent().next(\'.grid_spacer\').height(gridh);

    });
	}
else {
   jQuery(\'.hidden_blog_loader\').hide();
   jQuery(\'.blog-masonry.hidden_blog\').show();
}
  });
</script>';

			if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
			else if ($wp_query->max_num_pages > 1) : ?>
			<div id="nav-below" class="navigation">
				<div class="nav-previous">
					<?php next_posts_link(__('&larr; Older posts','cb-cosmetico')); ?>
				</div>
				<div class="nav-next">
					<?php previous_posts_link(__('Newer posts &rarr;','cb-cosmetico')); ?>
				</div>
			</div>
			<?php endif; ?>

			<div class="load_wrap"></div>

		</div>
		<!--/ blog end-->

	</div>

	<?php if($h_sid!='') { if ($sidebar=='right') { ?>
	<div id="sidebar_r">
		<ul>
			<?php if($h_sid!='') { dynamic_sidebar($h_sid); } else { dynamic_sidebar('sidebar'); } ?>
		</ul>
	</div>
	<!-- sidebar #end -->
	<?php } } ?>

	<div class="cl"></div>


</div>
<!-- wrapper #end -->
</div>
<!-- middle #end -->

<div class="cl"></div>

<?php get_footer(); ?>