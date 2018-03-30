<?php
/*
	Template for displaying single post content.
*/

	print '
		<header>
			<div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div>';
		
			if(get_post_format() == 'link'){
				
				print '<a href="'.get_post_meta($post->ID,'tp_postf_link',true).'" title="'; the_title_attribute(); print '" target="_blank"><h1>'.get_the_title().'</h1></a>';
				
			}else{
				print '<h1>'.get_the_title().'</h1>';
			}
			
			print '
			<div class="info">
				<p><i class="fa fa-user"></i> '.__('BY ','ingrid'); the_author_posts_link(); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-comment"></i> '; comments_number( __('0 COMMENT','ingrid'), __('1 COMMENT','ingrid'), __('% COMMENTS','ingrid') ); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-tag"></i> '.str_replace('rel="category"','',get_the_category_list( __( ', ', 'ingrid' ) )).'</p>
			</div>
		</header>';


	print '<article id="post-.'.get_the_ID().'" class="'; 
	$allclasses = get_post_class(); 
	print implode(' ',$allclasses);
	print '">';

	
	
		
		if(get_post_format() == 'image'){
			
			print get_the_post_thumbnail( $post->ID, 'full') . '<div class="clear"></div>';		
			
			
		}elseif(get_post_format() == 'gallery'){
		
		
		}elseif(get_post_format() == 'quote'){
			if($GLOBALS['nu_wp_version'] == '1'){
				$format_meta = get_post_format_meta($post->ID);
				if(!empty($format_meta['quote'])){
					if(strstr($format_meta['quote'],'<blockquote>')){
						print $format_meta['quote'];
					}else{
						print '<blockquote>'.$format_meta['quote'].'</blockquote>';
					}
				}
				
				if(!empty($format_meta['quote_source']) && !empty($format_meta['url'])){
					print '<a href="'.$format_meta['url'].'" target="_blank"><em>- '.$format_meta['quote_source'].'</em></a>';
				}
				elseif(!empty($format_meta['quote_source'])){
					print '<em>- '.$format_meta['quote_source'].'</em>';
				}
				print '<div class="clear"></div>';		
			}else{
				
			}
			
		}elseif(get_post_format() == 'video'){
			$pattern = '/(width)="[0-9]*"/i';
			
				print preg_replace($pattern,'width="99%"',get_post_meta($post->ID,'tp_postf_video',true));
			
			
		}elseif(get_post_format() == 'audio'){
			
				if(strstr(get_post_meta($post->ID,'tp_postf_audio',true), '.mp3')){
					print '
					<div id="audioplayer_'.$post->ID.'" class="flash-audio">'.__('Couldn\'t load the Audio Player!','ingrid').'</div>
					<div class="clear"></div>
					<script type="text/javascript">
					';  			
					if(empty($audio_printed)){
						$audio_printed = '1';
						
						print '
						AudioPlayer.setup(\''.get_bloginfo('template_url').'/swf/player.swf\', {  
							width: 400,
							height: 50,
							initialvolume: 75,  
							transparentpagebg: \'no\',  
							bg: \'f8f8f8\',
							noinfo: \'yes\',  
							animation: \'no\',
							bg: \'f6f6f6\',
							border: \'f2f2f2\',
							leftbg: \'f8f8f8\',
							rightbg: \'f8f8f8\',
							loader: \'f8f8f8\',
							track: \'e9e9e9\',
							lefticon: \'4a4a4a\',
							righticon: \'4a4a4a\',
							tracker: \'4a4a4a\',
							righticon: \'volslider\',
							righticonhover: \'e9e9e9\',
							rightbghover: \'f8f8f8\',
							voltrack: \'e9e9e9\'
						}); 
						';
					}
					print '
						AudioPlayer.embed("audioplayer_'.$post->ID.'", {soundFile: "'.get_post_meta($post->ID,'tp_postf_audio',true).'"});  
					</script>  
					';
				}else{
					$pattern = '/(width)="[0-9]*"/i';
					print preg_replace($pattern,'width="99%"',get_post_meta($post->ID,'tp_postf_audio',true));
				}
			
		}
		
	//content	
		//check review box
			$tp_post_review_style = get_post_meta($post->ID,'tp_post_review_style',true);
			$tp_post_review_position = get_post_meta($post->ID,'tp_post_review_position',true);
			
			if($tp_post_review_style != ''){
				$tp_post_review_title = get_post_meta($post->ID,'tp_post_review_title',true);
				$tp_post_review_lines = get_post_meta($post->ID,'tp_post_review_lines',true); if(!empty($tp_post_review_lines)){ $tp_post_review_lines = maybe_unserialize($tp_post_review_lines);}
				$tp_post_review_lines_scores = get_post_meta($post->ID,'tp_post_review_lines_scores',true); if(!empty($tp_post_review_lines_scores)){ $tp_post_review_lines_scores = maybe_unserialize($tp_post_review_lines_scores);}
				$tp_post_review_overall = get_post_meta($post->ID,'tp_post_review_overall',true);
				$tp_post_review_overall_score = get_post_meta($post->ID,'tp_post_review_overall_score',true);
				
				//display box function
					function tp_display_review_box($tp_post_review_style, $tp_post_review_lines, $tp_post_review_lines_scores, $tp_post_review_overall, $tp_post_review_overall_score){
						
							//review line	
								if(is_array($tp_post_review_lines)){
									$fctr = '0';
									foreach($tp_post_review_lines as $line){
										print '<div class="line">
											<div class="text">'.$line.'</div>';
										
										if($tp_post_review_style == 'stars'){
											print '<div class="score">';
												if($tp_post_review_lines_scores[$fctr] > 0 && $tp_post_review_lines_scores[$fctr] <= 5){																						
													for($i = '1'; $i <= 5; $i++){
														if($tp_post_review_lines_scores[$fctr] >= $i){
															print '<img src="'.get_bloginfo('template_url').'/images/review-star.png" alt="review star" />';
														}else{
															print '<img src="'.get_bloginfo('template_url').'/images/review-star-off.png" alt="review star" />';
														}
													}
												}
											print '
												</div>';
										}elseif($tp_post_review_style == 'score'){
											print '<div class="score"><strong>'.intval($tp_post_review_lines_scores[$fctr]).'</strong> '.__('out of 10').'</div>';
										}elseif($tp_post_review_style == 'percent'){
											print '<div class="score">'.intval($tp_post_review_lines_scores[$fctr]).'%</div>';
										}
												
										print '</div>';
										$fctr++;
									}
									print '<div class="empty"></div>';
								}
								
							//overall						
								if(!empty($tp_post_review_overall)){
									print '
									<div class="line">
										<div class="text overall">'.$tp_post_review_overall.'</div>
										<div class="score">';
										if($tp_post_review_style == 'stars'){
											if($tp_post_review_overall_score > 0 && $tp_post_review_overall_score <= 5){																						
												for($i = '1'; $i <= 5; $i++){
													if($tp_post_review_overall_score >= $i){
														print '<img src="'.get_bloginfo('template_url').'/images/review-star.png" alt="review star" />';
													}else{
														print '<img src="'.get_bloginfo('template_url').'/images/review-star-off.png" alt="review star" />';
													}
												}
											}
										}elseif($tp_post_review_style == 'score'){
											print '<div class="score"><strong>'.intval($tp_post_review_overall_score).'</strong> '.__('out of 10').'</div>';
										}elseif($tp_post_review_style == 'percent'){
											print '<div class="score">'.intval($tp_post_review_overall_score).'%</div>';
										}
									print '</div>
									</div>';	
								}
					}
				
				
				if($tp_post_review_position == 'fw-before'){
					print '
					<div class="review_box full">
						<div class="review">';
							if($tp_post_review_title){print '<h3>'.$tp_post_review_title.'</h3>
							<hr />';}
						
							tp_display_review_box($tp_post_review_style, $tp_post_review_lines, $tp_post_review_lines_scores, $tp_post_review_overall, $tp_post_review_overall_score);						
							
							print '										
						</div>
					</div>';
				}elseif($tp_post_review_position == 'right'){
					print '
					<div class="review_box right">
						<div class="review">';
							if($tp_post_review_title){print '<h3>'.$tp_post_review_title.'</h3>
							<hr />';}
						
							tp_display_review_box($tp_post_review_style, $tp_post_review_lines, $tp_post_review_lines_scores, $tp_post_review_overall, $tp_post_review_overall_score);						
							
							print '
						</div>
					</div>';
				}elseif($tp_post_review_position == ''){
					print '
					<div class="review_box">
						<div class="review">';
							if($tp_post_review_title){print '<h3>'.$tp_post_review_title.'</h3>
							<hr />';}
							
							tp_display_review_box($tp_post_review_style, $tp_post_review_lines, $tp_post_review_lines_scores, $tp_post_review_overall, $tp_post_review_overall_score);						
						
							print '						
						</div>
					</div>';
				}
			}
		
		
	// the content
		
			the_content();
		
		
		
				
		//check review box
			if($tp_post_review_style != '' && $tp_post_review_position == 'fw-after'){
				print '
					<div class="review_box full">
						<div class="review">';
							if($tp_post_review_title){print '<h3>'.$tp_post_review_title.'</h3>
							<hr />';}
						
							tp_display_review_box($tp_post_review_style, $tp_post_review_lines, $tp_post_review_lines_scores, $tp_post_review_overall, $tp_post_review_overall_score);						
							
							print '										
						</div>
					</div>';
			}
	
	
		print '<div class="vspace"></div>';
		
	//tags
		$tp_post_bottom_tags = get_post_meta($post->ID,'tp_post_bottom_tags');	
		if(!empty($tp_post_bottom_tags) && $tp_post_bottom_tags[0] == '1'){			
			print '<p class="widget_tag_cloud"><span>'.__('Tags: ','ingrid').'</span>';
			
			$posttags = get_the_tags( $post->ID );
			if ($posttags) {
			  foreach($posttags as $tag) {
				echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>'; 
			  }
			}
			
			print '</p>
			<p>&nbsp;</p>';
		}
		
		
		
	//social sharing
		$tp_post_bottom_social_fb = get_post_meta($post->ID,'tp_post_bottom_social_fb');	
		$tp_post_bottom_social_twitter = get_post_meta($post->ID,'tp_post_bottom_social_twitter');	
		$tp_post_bottom_social_gplus = get_post_meta($post->ID,'tp_post_bottom_social_gplus');	
		$tp_post_bottom_social_pin = get_post_meta($post->ID,'tp_post_bottom_social_pin');	
		if(!empty($tp_post_bottom_social_fb) && !empty($tp_post_bottom_social_twitter) && !empty($tp_post_bottom_social_gplus) && !empty($tp_post_bottom_social_pin)){
		if($tp_post_bottom_social_fb[0] == '1' || $tp_post_bottom_social_twitter[0] == '1' || $tp_post_bottom_social_gplus[0] == '1' || $tp_post_bottom_social_pin[0] == '1'){
			print '<ul class="social_share">';
			
			if($tp_post_bottom_social_fb[0] == '1'){				
				print '<li id="facebook"><iframe frameborder="0" src="//www.facebook.com/plugins/like.php?href='.urlencode(curPageURL()).'&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" style="border:none; overflow:hidden; width:450px; height:21px;"></iframe></li>';
			}
			if($tp_post_bottom_social_twitter[0] == '1'){		
				print '<li id="twitter">
				    <iframe frameborder="0" src="https://platform.twitter.com/widgets/tweet_button.html?url='.urlencode(curPageURL()).'&amp;text='.urlencode(curPageURL()).'" style="width:100px; height:20px;"></iframe>
				</li>';
			}
			if($tp_post_bottom_social_gplus[0] == '1'){		
				print '<li id="gplus"><!-- Place this tag where you want the +1 button to render. -->
					<div class="g-plusone" data-size="medium" data-annotation="bubble" data-width="120" data-href="'.curPageURL().'"></div>

					<!-- Place this tag after the last +1 button tag. -->
					<script type="text/javascript">
					  (function() {
						var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
						po.src = \'https://apis.google.com/js/plusone.js\';
						var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
					  })();
					</script></li>';
			}
			if($tp_post_bottom_social_pin[0] == '1'){		
				print '<li id="pinterest"><a data-pin-config="beside" href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="pinterest button" /></a>
				<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script></li>';
			}
			
			print '</ul>';
		}
		}
		
	
	//print '<hr />';
	
	
	//author
		$tp_post_bottom_author = get_post_meta($post->ID,'tp_post_bottom_author');	
		if(!empty($tp_post_bottom_author) && $tp_post_bottom_author[0] == '1'){					
			$author_url = get_the_author_meta('user_url');
			print '			
			<section class="author">
			';
				if(!empty($author_url)){
					print '<a href="'.$author_url.'" rel="author" target="_blank">'.get_avatar(get_the_author_meta('user_email')).'</a>';
				}else{
					print get_avatar(get_the_author_meta('user_email'));
				}
				print '
					
				<h3>Author: '. get_the_author() . '</h3>
						
				<p>'.get_the_author_meta('description').'</p>
						
			</section>
					
			<div class="vspace"></div>			
			';
						
		}
		
		
		
	comments_template( '', true );		
		
?>

</article>