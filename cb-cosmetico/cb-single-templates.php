<?php /* cosmetico single post templates */

require(get_template_directory().'/inc/cb-general-options.php');
require('inc/cb-post-options.php');

require(get_template_directory().'/inc/cb-little-head.php');
if(!isset($sidebar_post_name))$sidebar_post_name='';
if(!isset($sidebar_post))$sidebar_post='';
if($sidebar_post=='') $sidebar_post='no';
if($sidebar_post_name=='') $sidebar_post_name='0';
if($sidebar_post=='no'&&$sideb_post=='yes') $sidebar_post=$sideb_col;

$side='';
if($sidebar_post!='none'&&$sidebar_post!='no') $side='yes';

if($cb_type=='gallery') require('cb-single-gallery.php'); else {
	//single start

	$img_res_thumb1='95';$img_res_thumb2='65';

	if(!isset($roundy)) $roundy='';
 
	if($side=='yes'&&$sidebar_post!='none'&&$sidebar_post!='') { //with sidebar
		$img_res_thumb1='101'; $img_res_thumb2='65'; $ss='1'; $w='693'; $h='350';

	} else {  //without sidebar
		$div_close='<hr/>'; $w='958'; $h='550';

	}
	?>

	<?php
	if(have_posts()) :
	while(have_posts()) : the_post() ?>

	<?php
	$con=apply_filters('the_content', get_the_content());
	?>

	<?php   if($cb_type!='slider'){ $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
	if($cb_type=='portfolio') $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
	$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

	if($cb_type=='portfolio'&&$header_bg_image=='')  { $ph='550';
	?>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery(".slider_top").backstretch("<?php echo $isrc[0]; ?>");
jQuery(window).on("backstretch.show", function (e, instance) {
  jQuery("#loading").hide();
});
});
</script>


	<?php
	} else if($header_bg_image!=''){
		?>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery(window).on("backstretch.show", function (e, instance) {
  jQuery("#loading").hide();
});
});
</script>
		<?php
		$ph='310';
	}

	if($isrc&&$cb_type!='portfolio'&&$sf!='no') { ?>
<div
	class="<?php echo $fr; ?> frame_main fade <?php echo $roundy; ?> in">
	<div class="<?php echo $frin; ?> <?php echo $roundy; ?>">
		<div class="fade_c">
			<div class="fade_icons">
				<div class="fade_icons_in">
					<a class="icon i2" href="<?php echo $isrc[0]; ?>" data-rel="pp"><i
						class="icon-eye-open"></i> </a> <a class="icon i1"
						href="<?php echo get_permalink();?>"><i class="icon-link"></i> </a>
				</div>
			</div>
		</div>
	<a href="<?php echo $isrc[0]; ?>"
			data-rel="pp[post-<?php echo $post->ID; ?>]">
			<?php if($sfc!='no'){?><img
			src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'crop' => true)); ?>"
			class="<?php echo $roundy; ?> fade" alt="featured image" /><?php }
			else {?><img
src="<?php echo $isrc[0]; ?>" class="<?php echo $roundy; ?> fade norm_image" alt="featured image" /><?php } ?> </a>
		<div class="cl"></div>

		<div class="cl"></div>

		<?php if($si!='no') { foreach ($imgs as $att_id => $att) {
			$gall_img=wp_get_attachment_image_src($att_id);
			$gall_img_large=wp_get_attachment_image_src($att_id,'full');
			if(!isset($roundy)) $roundy='';
			if($gall_img_large[0]!=$isrc[0]) echo '<div style="float:left;margin-top:1px;margin-left:0px;margin-right:2px;" class="fade"><a href="'.$gall_img_large[0].'" data-rel="pp[post-'.$post->ID.']"><div class="fade_c"></div><img src="'.bfi_thumb($gall_img[0], array('width' => $img_res_thumb1, 'height'=>$img_res_thumb2, 'crop' => true)).'" class="'.$roundy.' fade" alt="thumb"/></a><div class="cl"></div></div>';
		} } ?>

		<div class="cl"></div>
	</div>
</div>

		<?php } //if src end
	} //if != slider end


	if ($cb_type=='audio'||$cb_type=='video') {
		wp_enqueue_style('videojs', WP_THEME_URL.'/inc/js/video-js/video-js.css', false, '1.0', 'screen');
		wp_enqueue_script('videojs',WP_THEME_URL.'/inc/js/video-js/video.min.js', array('jquery'), '1.0', true);
		if ($cb_type=='audio') $murl=$aurl; if ($cb_type=='video') $murl=$vurl;;
		if (preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $murl, $match)) {
			$video = $match[1]; }
			if(!isset($video))$video='';
			if(!isset($roundy))$roundy='';
			if(!isset($alt))$alt='';
			if($video!='') { echo '<div class="'.$fr.' '.$roundy.' cb5_media"><div class="'.$frin.'"><iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent&amp;controls=1&amp;showinfo=0" title="'.get_the_title().'" frameborder="0"></iframe></div></div>'; }

			$pos = strpos($murl,'vimeo.com');

			if($pos === false) { } else {
				$video = substr($murl,17,8);
				echo '<div class="'.$fr.' '.$roundy.' cb5_media"><div class="'.$frin.'"><iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0" title="'.$alt.'" frameborder="0"></iframe></div></div>';
			}

			if($video==''&&$pos===false&&$murl!='') {
				if($cb_type=='audio') $h='50';
				echo '<div class="'.$fr.' '.$roundy.' cb5_media"><div class="'.$frin.'"><video id="media-'.$post->ID.'" class="video-js vjs-default-skin cb5_media" controls preload="none" width="'.$w.'" height="'.$h.'" poster="" data-setup=> <source src="'.$murl.'" type="video/mp4" /> </video></div></div>';
			}
	}



	if($cb_type=='slider') { $pid=$post->ID; $slid_id=substr(rand(),0,3);
	wp_enqueue_style('any', WP_THEME_URL.'/inc/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
	wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
	wp_enqueue_script('any',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('anyfx',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.fx.min.js', array('jquery'), '1.0', true);


	if($s_beh!='cat') $rc='true'; else $rc='false';

	if($s_frame=='yes') { $s_fr='<div class="frame '.$roundy.'"><div class="framein '.$roundy.'">'; $s_fr_end='</div></div>'; }

	if($sidebar!='none'&&$sidebar!='no') { //with sidebar
		$slider_res='width:695px;height:390px;'; if($s_frame=='yes') $slider_res='width:691px;height:390px;';
		$img_res1='695'; $img_res2='380'; if($s_frame=='yes') $img_res='691'; $img_res2='380';
	} else {  //without sidebar
		$slider_res='width:980px;height:390px;'; if($s_frame=='yes') $slider_res='width:956px;height:390px;';
		$img_res1='980'; $img_res2='380'; if($s_frame=='yes') $img_res='956'; $img_res2='380';
	}
	if(!isset($s_fr)) $s_fr='';
	if(!isset($s_fr_end)) $s_fr_end='';
	echo '<script type="text/javascript">
		jQuery(function(){
		 jQuery(\'#slider'.$slid_id.$pid.'\').anythingSlider({
			resizeContents       : '.$rc.',	
			hashTags            : false,
			autoPlay            : '.$s_auto.',     
			pauseOnHover        : true,    
			resumeOnVideoEnd    : true,
			delay               : '.$s_delay.',     
			animationTime       : '.$s_ani_time.',    
			easing              : \''.$s_easing.'\'
		  });
		});
		</script>'.$s_fr.'<ul id="slider'.$slid_id.$pid.'" style="'.$slider_res.'list-style:none;overflow-y:auto;overflow-x:hidden;" class="slider">';

	if($s_beh!='cat'){
		$imgs=get_children('post_type=attachment&order=asc&orderby=menu_order&post_mime_type=image&post_parent='.$post->ID );

		foreach ($imgs as $att_id => $att) {

			$gall_img=wp_get_attachment_image_src($att_id,'full');
			echo '<li><a href="'.$gall_img[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($gall_img[0], array('width' => $img_res1, 'height'=>$img_res2, 'crop' => true)).'" class="'.$roundy.' fade"/></a><div class="cl"></div></li>';

		}


	} else {
		$slide_q = new WP_Query('cat='.$cats.'&order=ASC');
		while ($slide_q->have_posts()) : $slide_q->the_post();

		$isrc_slide=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');

		if($isrc_slide) echo '<li><a href="'.$isrc_slide[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($isrc_slide[0], array('width' => $img_res1, 'height'=>$img_res2, 'crop' => true)).'" class="'.$roundy.' fade" alt="slide image"/></a><div class="cl"></div></li>';
		else echo '<li>'.apply_filters('the_content', get_the_content()).'</li>';

		endwhile;
	}// slider cat else end

	echo '</ul>'.$s_fr_end.'<div class="cl" style="margin-bottom:20px;"></div>';

	} //slider end
	?>

	<?php
	if($cb_type=='portfolio') {
		echo '<div class="port_item_in"><h2 class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
		$port_url=get_post_meta($post->ID,'cb5_port_url','true');
		$port_client=get_post_meta($post->ID,'cb5_port_client','true');
		$port_author=get_post_meta($post->ID,'cb5_port_author','true');
		$port_key=get_post_meta($post->ID,'cb5_port_key','true');
		if($port_author!='') echo '<h3 class="author">by: '.$port_author.'</h3>';
		echo '<ul>';
		if($port_client!='') echo '<li><h3>'.__('Project Client').':</h3>'.$port_client.'</li>';
		if($port_key!='') echo '<li><h3>'.__('Keywords').':</h3><i>'.$port_key.'</i></li>';
		echo '</ul>';
		echo '<h3>Project Details:</h3>';
		echo get_the_content();
		if($port_url!='') echo '<div class="view_project"><a href="'.$port_url.'" target="_blank" class="bttn_big very alt"><i class="icon-external-link"></i>'.__('view project','cb-cosmetico').'</a></div>';
		echo '</div>';
		echo '<div id="im" class="portfolio_hide">';
		the_content();
		echo '</div>';
	}
	else { ?>

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
	<?php
	echo $con;
	echo $brs;  ?>
<div class="cat_read_more">
	<div class="cb_social">
		<a
			onClick="MyWindow=window.open('http://twitter.com/home?status=Currently Reading <?php the_title(); ?> (<?php the_permalink(); ?>)','MyWindow','width=600,height=400'); return false;"
			title="Share on Twitter" target="_blank" id="twitter-share"><i
			class="icon-twitter"></i> </a> <a
			href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>"
			onClick="window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent('<?php the_permalink() ?>')+Õ&amp;title=Õ+encodeURIComponent('<?php the_title() ?>'),'sharer', 'toolbar=no,width=550,height=550'); return false;"
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
</div>
	<?php
	}
	?>

<div class="cl"></div>
	<?php echo '<div class="wp-pagenavi page_list">'; wp_link_pages(array('before'=>'<p>', 'next_or_number'=>'next', 'previouspagelink' => __('Previous Page','cb-cosmetico'), 'nextpagelink'=>__('Next Page','cb-cosmetico'))); echo '</div>'; ?>

<div class="cl"></div>

	<?php if(is_active_sidebar('after-post')){?>
<div class="after-post">
	<ul>
	<?php dynamic_sidebar('after-post');?>
	</ul>
</div>
	<?php } ?>



	<?php if ( ! post_password_required() ) { comments_template(); }  ?>



	<?php endwhile; else : ?>

	<?php get_template_part('cb-404'); ?>

	<?php endif; ?>

	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
	else if ($wp_query->max_num_pages > 1) : ?>
<div id="nav-below" class="navigation">
<?php wp_link_pages(); ?>
</div>
<?php endif; ?>

<!--/ post end-->
<?php } // end ?>