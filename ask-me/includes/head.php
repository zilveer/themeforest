<?php
global $post,$blog_style,$vbegy_sidebar_all;
$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
$video_mp4 = rwmb_meta('vbegy_video_mp4','text',$post->ID);
$video_m4v = rwmb_meta('vbegy_video_m4v','text',$post->ID);
$video_webm = rwmb_meta('vbegy_video_webm','text',$post->ID);
$video_ogv = rwmb_meta('vbegy_video_ogv','text',$post->ID);
$video_wmv = rwmb_meta('vbegy_video_wmv','text',$post->ID);
$video_flv = rwmb_meta('vbegy_video_flv','text',$post->ID);
$video_image = rwmb_meta('vbegy_video_image','upload',$post->ID);
$video_mp4 = (isset($video_mp4) && $video_mp4 != ""?" mp4='".$video_mp4."'":"");
$video_m4v = (isset($video_m4v) && $video_m4v != ""?" m4v='".$video_m4v."'":"");
$video_webm = (isset($video_webm) && $video_webm != ""?" webm='".$video_webm."'":"");
$video_ogv = (isset($video_ogv) && $video_ogv != ""?" ogv='".$video_ogv."'":"");
$video_wmv = (isset($video_wmv) && $video_wmv != ""?" wmv='".$video_wmv."'":"");
$video_flv = (isset($video_flv) && $video_flv != ""?" flv='".$video_flv."'":"");
$video_image = (isset($video_image) && $video_image != ""?" poster='".$video_image."'":"");
$featured_image = vpanel_options("featured_image");
if ($vbegy_what_post == "image" || $vbegy_what_post == "video" || $vbegy_what_post == "lightbox") {
	if ($vbegy_sidebar_all == "full") {
		if ($vbegy_what_post == "image" || $vbegy_what_post == "lightbox") {
			if (has_post_thumbnail()) {
				$show_featured_image = 1;
				if ($featured_image == 1 && is_singular()) {
					$show_featured_image = 0;
				}
				if ($show_featured_image == 1) {
					if ($blog_style == "blog_2") {
						if ($vbegy_what_post == "lightbox") {
							echo get_aq_resize_img('full',250,160,$img_lightbox = "lightbox");
						}else {
							echo get_aq_resize_img('full',250,160);
						}
					}else {
						if ($vbegy_what_post == "lightbox") {
							echo get_aq_resize_img('full',1100,600,$img_lightbox = "lightbox");
						}else {
							echo get_aq_resize_img('full',1100,600);
						}
					}
				}
			}
		}else if ($vbegy_what_post == "video") {
			if ($video_type == "html5") {
				echo do_shortcode('[video'.$video_mp4.$video_m4v.$video_webm.$video_ogv.$video_wmv.$video_flv.$video_image.']');
	    	}else {
		    	echo '<iframe height="600" src="'.$type.'"></iframe>';
	    	}
		}
	}else {
		if ($vbegy_what_post == "image" || $vbegy_what_post == "lightbox") {
			if (has_post_thumbnail()) {
				$show_featured_image = 1;
				if ($featured_image == 1 && is_singular()) {
					$show_featured_image = 0;
				}
				if ($show_featured_image == 1) {
					if ($blog_style == "blog_2") {
						if ($vbegy_what_post == "lightbox") {
							echo get_aq_resize_img('full',250,190,$img_lightbox = "lightbox");
						}else {
							echo get_aq_resize_img('full',250,190);
						}
					}else {
						if ($vbegy_what_post == "lightbox") {
							echo get_aq_resize_img('full',810,450,$img_lightbox = "lightbox");
						}else {
							echo get_aq_resize_img('full',810,450);
						}
					}
				}
			}
		}else if ($vbegy_what_post == "video") {
			if ($video_type == "html5") {
				echo do_shortcode('[video'.$video_mp4.$video_m4v.$video_webm.$video_ogv.$video_wmv.$video_flv.$video_image.']');
			}else {
	    		echo '<iframe height="450" src="'.$type.'"></iframe>';
	    	}
		}
	}
}else if ($vbegy_what_post == "google" || $vbegy_what_post == "slideshow") {
	if ($vbegy_what_post == "google") {
		echo $vbegy_google;
	}else if ($vbegy_what_post == "slideshow") {
		if ($vbegy_slideshow_type == "custom_slide") {
			$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = 'vbegy_upload_images' AND post_id = {$post->ID}");?>
			<div class="flexslider blog_silder margin_b_20 post-img">
			    <ul class="slides">
			    	<?php
			    	$builder_slide_item = get_post_meta($post->ID,'builder_slide_item');
			    	if($builder_slide_item){
			    		$builder_slide_item = $builder_slide_item[0];
			    		foreach ($builder_slide_item as $builder_slide) {
			    		    $src = wp_get_attachment_image_src($builder_slide['image_id'],'full');
			    		    $src = $src[0];
			    		    if ($vbegy_sidebar_all == "full") {
			    		    	if ($blog_style == "blog_2") {
			    		    	    $src = get_aq_resize_img_url($src,"full",250,160);
			    		    	}else {
			    		    	    $src = get_aq_resize_img_url($src,"full",1100,600);
			    		    	}
			    		    }else {
			    		    	if ($blog_style == "blog_2") {
			    		    	    $src = get_aq_resize_img_url($src,"full",250,190);
			    		    	}else {
			    		    	    $src = get_aq_resize_img_url($src,"full",810,450);
			    		    	}
			    		    }
			    		    ?>
			    		    <li>
				    		    <?php if ($builder_slide['slide_link'] != "") {echo "<a href='".$builder_slide['slide_link']."'>";}
					    	        echo $src;
				    	        if ($builder_slide['slide_link'] != "") {echo "</a>";}?>
			    	        </li>
			    		<?php }
			    	}?>
			    </ul>
			</div><!-- End flexslider -->
			<?php
		}else if ($vbegy_slideshow_type == "upload_images") {
			$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = 'vbegy_upload_images' AND post_id = {$post->ID}");?>
			<div class="flexslider blog_silder margin_b_20 post-img">
			    <ul class="slides">
			    	<?php
			    	foreach ($result as $results) {
			    	    $slideshow_imgs = $results->meta_value.',';
			    	    $slideshow_imgs = explode(",",$slideshow_imgs);
			    	    $images = $wpdb->get_col("
			    	    SELECT ID FROM $wpdb->posts
			    	    WHERE post_type = 'attachment'
			    	    AND ID IN ('".implode("','",$slideshow_imgs)."')
			    	    ORDER BY menu_order ASC");
			    	    foreach ($images as $att) {
			    	    $src = wp_get_attachment_image_src($att,'full');
			    	    $src = $src[0];?>
			    	    <li>
				    	    <?php
				    	    if ($vbegy_sidebar_all == "full") {
				    	    	if ($blog_style == "blog_2") {
				    	    	    $src = get_aq_resize_img_url($src,"full",250,160);
				    	    	}else {
				    	    	    $src = get_aq_resize_img_url($src,"full",1100,600);
				    	    	}
				    	    }else {
				    	    	if ($blog_style == "blog_2") {
				    	    	    $src = get_aq_resize_img_url($src,"full",250,190);
				    	    	}else {
				    	    	    $src = get_aq_resize_img_url($src,"full",810,450);
				    	    	}
				    	    }
				    	    echo $src;
				    	    ?>
				        </li>
			    	<?php
			    	    }
			    	}?>
			    </ul>
			</div><!-- End flexslider -->
			<?php
		}
	}
}else {
	if (has_post_thumbnail()) {
		$show_featured_image = 1;
		if ($featured_image == 1 && is_singular()) {
			$show_featured_image = 0;
		}
		if ($show_featured_image == 1) {
			if ($vbegy_sidebar_all == "full") {
				if ($blog_style == "blog_2") {
					echo get_aq_resize_img('full',250,160);
				}else {
					echo get_aq_resize_img('full',1100,600);
				}
			}else {
				if ($blog_style == "blog_2") {
					echo get_aq_resize_img('full',250,190);
				}else {
					echo get_aq_resize_img('full',810,450);
				}
			}
		}
	}
}
?>