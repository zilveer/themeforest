<?php get_header();

/* cosmetico blog page template */
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');

/* dynamic or default sidebar */
if(!isset($sidebar_post_name))$sidebar_post_name='';
if(!isset($sidebar_post))$sidebar_post='';
if($sidebar_post=='') $sidebar_post='no';
if($sidebar_post_name=='') $sidebar_post_name='0';
if($sidebar_post=='no'&&$sideb_post=='yes') $sidebar_post=$sideb_col;

$side='';
if($sidebar_post!='none'&&$sidebar_post!='no') $side='yes';
?>

<?php if($show_bread=='yes'&&$header_type!='slider_head'){ if(function_exists('yoast_breadcrumb')){ yoast_breadcrumb('<div class="bread_wrap"><div class="wrapper_p"><div id="breadcrumbs">','</div><div class="cl"></div></div></div>'); } } ?>

</div>

</div>
<!-- bg_head end -->


<div id="middle">
	<div class="wrapper_p">

		<div class="wrapper_p head_title">
			<h1 class="title">
			<?php _e('Search Results for','cb-cosmetico');?>
			<?php the_search_query(); ?>
			</h1>
		</div>
		<div class="cl"></div>

		<?php if($sidebar_post=='left') { ?>
		<div id="sidebar_l">
		<?php dynamic_sidebar('sidebar'); ?>
		</div>
		<!-- sidebar #end -->
		<?php } ?>

		<?php if(!isset($mcc))$mcc='';

		$hgf='383';
		$gw='20';

		if($side=='yes') {
			$ss='1';
			$w='770'; $h='250'; $hei='286px'; $hgf='455';

			$slider_res='width:770px;height:330px;'; $con_lg='358'; $headi='<h3 class="mbimp">'; $headi_end='</h3>'; $w='693'; $h='450'; $col_width='695'; $gw='30'; $hei='358px';

		} else {

			$w='980'; $h='350'; $hei='217px'; $hgf='456';

			$slider_res='width:980px;height:420px;'; $con_lg='520'; $headi='<h3 class="mbimp">'; $headi_end='</h3>'; $w='958'; $h='550'; $col_width='980'; $gw='28'; $hei='458px';

		}
		if(!isset($roundy))$roundy='';
		?>

		<div id="blog-masonry" <?php if($side=='yes') { ?>
			class="side <?php if($sidebar=='left') echo 'side_right'; if($sidebar=='right') echo 'side_left'; else echo 'side'; ?>"
			<?php } ?>>



			<div id="blog-inside">

			<?php
			if(have_posts()) :
			while(have_posts()) : the_post() ?>



				<div id="post-<?php echo $post->ID; ?>"
					class="postbox <?php echo $col_v; if($columns=='1') echo ' post-cat'; ?>">



					<?php
					$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID);
					$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
					$murl='';$video='';$video='';$sl_space=''; // reset values in the loop
					$post_type=get_post_meta($post->ID, 'cb5_cb_type', $single = true);
					$s_beh=get_post_meta($post->ID, 'cb5_s_beh', $single = true);

					/* -------------------------------------------------------------------------------- */
					/* -------------------------------------------------------------------------------- */

					//audio & video
					if($post_type=='audio'||$post_type=='video'){
						wp_enqueue_style('videojs', WP_THEME_URL.'/inc/js/video-js/video-js.css', false, '1.0', 'screen');
						wp_enqueue_script('videojs',WP_THEME_URL.'/inc/js/video-js/video.min.js', array('jquery'), '1.0', true);
						$pos=false;
						$aurl=get_post_meta($post->ID, 'cb5_aurl', $single = true);
						$vurl=get_post_meta($post->ID, 'cb5_vurl', $single = true);

						if($post_type=='audio') $murl=$aurl; else $murl=$vurl;
						$pos = strpos($murl,'vimeo.com');
						if(!isset($ss)) $ss='';
						if(preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $murl, $match)) { $video=$match[1]; }
						if($video!='') { echo '<div class="'.$fr.' '.$roundy.' in cb5_media"><div class="'.$frin.'">'.$mcc.'<iframe class="cb5_media" width="100%" height="'.$h.'" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent&amp;controls=1&amp;showinfo=0" title="'.get_the_title().'"></iframe></div></div>'; }

						if($pos===false) { } else {
							$video=substr($murl,17,8);
							echo '<div class="'.$fr.' '.$roundy.' in cb5_media"><div class="'.$frin.'">'.$mcc.'<iframe class="cb5_media" width="100%" height="'.$h.'" src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0"></iframe></div></div>';
						}

						if($video==''&&$pos===false&&$murl!='') {

							if($post_type=='audio') $h2='42'; else $h2=$h;
							if($post_type=='audio') $aa='2'; else $aa='';
							echo '<div class="'.$fr.' '.$roundy.' in cb5_media'.$aa.'"><div class="'.$frin.'">'.$mcc.'<video id="media-'.$post->ID.'" class="video-js vjs-default-skin cb5_media'.$aa.'" controls preload="none" width="100%" height="'.$h2.'" poster="" data-setup=> <source src="'.$murl.'" type="video/mp4" /> </video></div></div>';
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
			delay               : 8000,     
			animationTime       : 400
		  });
		});
	</script><div class="'.$fr.' '.$roundy.' in"><div class="'.$frin.'">'.$mcc.'<div class="any-slider-container"><div><ul id="slider'.$slid_id.$pid.'" class="slider any-slider">';

						if($s_beh!='cat'){

							$imgs=get_children('post_type=attachment&order=asc&orderby=menu_order&post_mime_type=image&post_parent='.$post->ID);

							foreach ($imgs as $att_id => $att) {
								$gall_img=wp_get_attachment_image_src($att_id,'full');
								echo '<li><div class="textSlide"><a href="'.$gall_img[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($gall_img[0], array('width' => 980, 'crop' => true)).'" class="'.$roundy.' fade-s" alt="slide image"/><div class="cl"></div></a></div></li>';
							}

						} echo '</ul></div></div></div></div>';

					} // slider end

					/* -------------------------------------------------------------------------------- */
					/* -------------------------------------------------------------------------------- */

					if(($post_type!='slider'&&$post_type!='video'&&$post_type!='audio')||$post_type=='slider'&&$s_beh=='cat') {

						if($isrc) { ?>
					<div class="blog_item <?php echo $fr; ?> <?php echo $roundy; ?> in">
						<div class="<?php echo $frin; ?> fade <?php echo $roundy; ?>">
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
							<img
								src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'crop' => true)); ?>"
								class="<?php echo $roundy; ?> fade-s fade-si"
								alt="featured image" />
							<div class="cl"></div>
						</div>
					</div>
					<?php }

					} // else end
					//echo $div_left;
					?>

					<div class="cl"></div>
					<div class="cat_single">

					<?php if($columns==2&&$side!='yes') { ?>
						<style>
ul.post_details2 li.cat {
	display: block !important;
}
</style>
<?php } ?>



<?php echo '<h1 class="mbimp blog_title"><a href="'.get_permalink().'">'.get_the_title().'</a></h1>'; ?>

<?php if($post_details=='yes') {

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

						<?php echo $div_close; ?>
						<div class="cl"></div>


					</div>
					<?php echo $sl_space; ?>
				</div>
				<!--/blog post end-->

				<div class="cl"></div>

				<?php endwhile; else : ?>

				<h1 class="h_large">
				<?php _e('Nothing found','cb-cosmetico'); ?>
				</h1>
				<h1>
				<?php _e('Please try again','cb-cosmetico'); ?>
				</h1>
				<div class="cl"></div>

				<?php endif; ?>

			</div>



			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
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

		</div>
		<!--/ blog end-->




		<?php if ($sidebar_post=='right') { ?>
		<div id="sidebar_r">
			<ul>
			<?php dynamic_sidebar('sidebar'); ?>
			</ul>
		</div>
		<!-- sidebar #end -->
		<?php } ?>

		<div class="cl"></div>

	</div>
	<!-- wrapper #end -->
</div>
<!-- middle #end -->

<?php get_footer(); ?>
