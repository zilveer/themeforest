<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/loop/home-flexslider.php
 * @file	 	1.0
 */
?>
<?php global $data, $prefix; ?>

<?php
	$slider=$data[$prefix."home_slider_slides"];
	if(count($slider)>0) {
		function show_content($slide) {
			if($slide['title']!="") {
				echo '<h1 class="slider-title">'.$slide['title'].'</h1>';
			}
			if($slide['caption']!="") {
				echo '<div class="clear"></div><p>';
				echo '<div class="slide-caption">';
					echo apply_filters('the_content', $slide['caption']);
				//echo nl2br($slide['caption']);
				echo '</div>';
				echo '</p>';
			}
			if($slide['showbutton']=="1") {
				if($slide['buttontext']!="") {
					echo '<div class="slider-button"><a href="'.$slide['buttonlink'].'" class="button large '.$slide['buttonstyle'].'">'.$slide['buttontext'].'</a></div>';
				}
			}
			if($slide['showprice']=="1") {
				if($slide['pricevalue']!="") {
					echo '<div class="'.$slide['priceposition'].'">';
						echo '<h4>'.$slide['pricevalue'].'</h4>';
					echo '</div>';
				}
			}
		}
		function show_video($id,$number) {
			return  '<iframe id="player_'.$number.'" class="vimeo" src="http://player.vimeo.com/video/'.$id.'?api=1&byline=0&title=0&&portrait=0&player_id=player_'.$number.'" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		}


?>
	<?php
		if($data[$prefix."home_slider_type"]=="boxed") {
			echo '<div class="row container clearfix slider-boxed"><div class="twelve columns clearfix">';
		}
		if(!isset($data[$prefix."home_slider_bg"])) $data[$prefix."home_slider_bg"] = '';
		$slider_bg = $data[$prefix."home_slider_bg"];
		$custom_slider_bg = strstr($slider_bg,'custom_bg');
		$none_slider_bg = strstr($slider_bg,'none_bg');
		if($custom_slider_bg!="" || $none_slider_bg!="") {
			$slider_bg = false;
		}
	?>
	<div id="home_slider" class="flexslider <?php echo $data[$prefix.'home_slider_type']; ?>" style="min-height:<?php echo $data[$prefix.'home_slider_minheight']; ?>px;<?php if($data[$prefix.'home_slider_boxshadow']!="1") { echo "box-shadow:none;"; } ?><?php if($slider_bg!=false) { echo 'background-image:url('.$slider_bg.');'; }?>">
		<ul class="slides" style="min-height:<?php echo $data[$prefix.'home_slider_minheight']; ?>px;">
			<?php
				if(is_array($slider)) {
					foreach($slider as $number=>$slide) { ?>
						<li class="slide-<?php echo $number; ?>" style="min-height:<?php echo $data[$prefix.'home_slider_minheight']; ?>px;">
							<?php
								$slidelayout = $slide['slidelayout'];
								$mediatype = $slide['mediatype'];

								switch($slidelayout) {
									case "Content above media":

										switch ($mediatype) {
											case "Image" :
												echo '<div class="slide-media absolute-pos" style="background-image:url('.$slide['imageurl'].');background-size:'.$slide['imagebg'].'"></div>';
												break;
											case "Video" :
												echo '<div class="slide-media absolute-pos">';
													echo show_video($slide['videourl'],$number);
												echo '</div>';
												break;
										}

										if($slide['showtext']=="1") {
											$class = '';
											switch($slide['positiontext']) {
												case "left" :
													break;
												case "right" :
													$class = " push-six "; break;
												case "center" :
													$class = " centered ";
											}
											if($slide['contentbackground']=="1") {
												$class .= ' shadow ';
											}
											echo '<div class="row container"><div class="slide-content '.$slide['contentstyle'].' six columns '.$class.'">';
											show_content($slide);
											echo '</div></div>';
										}

										break;
									default :

										echo '<div class="row container">';

											$class = '';
											if($slide['contentbackground']=="1") {
												$class .= ' shadow ';
											}
											echo '<div class="slide-content six columns '.$slide['contentstyle'] .$class;
												if($slidelayout == "Media Left/Content right") echo ' push-six ';
											echo '">';
												show_content($slide);
											echo '</div>';
											echo '<div class="six columns slide-media ';
												if($slidelayout == "Media Left/Content right") echo ' pull-six ';
											echo '">';
											switch ($mediatype) {
													case "Image" :
														echo "<img src='".$slide['imageurl']."' title='".$title."' />";
														break;
													case "Video" :
															echo show_video($slide['videourl'],$number);
														break;
												}
											echo '</div>';

										echo '</div>';

										break;

								}
							?>
						</li>
			<?php
					}
				}
			?>
		</ul>
	</div>
	<?php
		if($data[$prefix."home_slider_type"]=="boxed") {
			echo '</div></div>';
		}
	?>
<?php } ?>