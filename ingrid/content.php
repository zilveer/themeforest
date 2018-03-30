<?php

/* Display posts */

	print '<article id="post-.'.get_the_ID().'" class="'; 
	$allclasses = get_post_class(); 
	print implode(' ',$allclasses);
	if ( has_post_thumbnail() || get_post_format() == 'video' ) { print ' has-thumb'; }
	print '">';

	if(is_search()){
		//search results
		print '<a href="'.get_permalink().'" title="'; the_title_attribute(); print '"><h3>'.get_the_title().'</h3></a>';
				
		
			the_excerpt();
		
		
		print '<hr class="hr3" />';
	}else{
		//review is enabled?
			$show_review = get_post_meta($post->ID,'tp_post_review_showoverall',true);
	
			
		if(get_post_format() == 'link'){
		// link
			
			if ( has_post_thumbnail() ) {
				print '<div class="post-thumb"><a href="'.get_permalink().'">'.get_the_post_thumbnail( $post->ID, array(347,158)).'</a><div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div></div>';			
			}else{
				print '<div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div>';			
			}
			
			print '<a href="'.get_post_meta($post->ID,'tp_postf_link',true).'" title="'; the_title_attribute(); print '" target="_blank"><h3>'.get_the_title().'</h3></a>';
			
			
			
			if(has_excerpt()){
				the_excerpt();
			}
			
			if($show_review){
				print '<div class="post-review">'.get_post_meta($post->ID,'tp_post_review_overall',true).'&nbsp;&nbsp;&nbsp;&nbsp;';	
					$tp_post_review_style = get_post_meta($post->ID,'tp_post_review_style',true);
					$tp_post_review_overall = get_post_meta($post->ID,'tp_post_review_overall',true);
					$tp_post_review_overall_score = get_post_meta($post->ID,'tp_post_review_overall_score',true);
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
						print '<span>'.intval($tp_post_review_overall_score).' '.__('out of 10').'</span>';
					}elseif($tp_post_review_style == 'percent'){
						print '<span>'.intval($tp_post_review_overall_score).'%'.'</span>';
					}
				
				print '</div>';
			}
					
			print '
			<div class="info">
				<p><i class="fa fa-user"></i> '.__('BY ','ingrid'); the_author_posts_link(); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-comment"></i> '; comments_number( __('0 COMMENT','ingrid'), __('1 COMMENT','ingrid'), __('% COMMENTS','ingrid') ); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-tag"></i> '.str_replace('rel="category"','',get_the_category_list( __( ', ', 'ingrid' ) )).'</p>';
				
				// read more
				print '<p class="right"><a class="moretag" href="'. get_permalink($post->ID) . '">'.__('Read more &rarr;','ingrid').'</a></p>';
			print '
			</div>';
		}
		elseif(get_post_format() == 'gallery'){
		// gallery
			if ( has_post_thumbnail() ) {
				print '<div class="post-thumb"><a href="'.get_permalink().'">'.get_the_post_thumbnail( $post->ID, array(347,158)).'</a><div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div></div>';			
			}else{
				print '<div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div>';			
			}
			
			print '<a href="'.get_permalink().'" title="'; the_title_attribute(); print '"><h3>'.get_the_title().'</h3></a>';
			
			the_excerpt();
			
			if($show_review){
				print '<div class="post-review">'.get_post_meta($post->ID,'tp_post_review_overall',true).'&nbsp;&nbsp;&nbsp;&nbsp;';	
					$tp_post_review_style = get_post_meta($post->ID,'tp_post_review_style',true);
					$tp_post_review_overall = get_post_meta($post->ID,'tp_post_review_overall',true);
					$tp_post_review_overall_score = get_post_meta($post->ID,'tp_post_review_overall_score',true);
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
						print '<span>'.intval($tp_post_review_overall_score).' '.__('out of 10').'</span>';
					}elseif($tp_post_review_style == 'percent'){
						print '<span>'.intval($tp_post_review_overall_score).'%'.'</span>';
					}
				
				print '</div>';
			}
			
			print '
			<div class="info">
				<p><i class="fa fa-user"></i> '.__('BY ','ingrid'); the_author_posts_link(); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-comment"></i> '; comments_number( __('0 COMMENT','ingrid'), __('1 COMMENT','ingrid'), __('% COMMENTS','ingrid') ); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-tag"></i> '.str_replace('rel="category"','',get_the_category_list( __( ', ', 'ingrid' ) )).'</p>';
				
				// read more
				print '<p class="right"><a class="moretag" href="'. get_permalink($post->ID) . '">'.__('Read more &rarr;','ingrid').'</a></p>';
				
			print '
			</div>';
		}
		elseif(get_post_format() == 'quote'){
		// quote
			
			
			if ( has_post_thumbnail() ) {
				print '<div class="post-thumb"><a href="'.get_permalink().'">'.get_the_post_thumbnail( $post->ID, array(347,158)).'</a><div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div></div>';			
				
			}else{
				print '<div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div>';			
			}
			
			print '<a href="'.get_permalink().'" title="'; the_title_attribute(); print '"><h3>'.get_the_title().'</h3></a>';
			
			
			the_content();
			
			
			if($show_review){
				print '<div class="post-review">'.get_post_meta($post->ID,'tp_post_review_overall',true).'&nbsp;&nbsp;&nbsp;&nbsp;';	
					$tp_post_review_style = get_post_meta($post->ID,'tp_post_review_style',true);
					$tp_post_review_overall = get_post_meta($post->ID,'tp_post_review_overall',true);
					$tp_post_review_overall_score = get_post_meta($post->ID,'tp_post_review_overall_score',true);
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
						print '<span>'.intval($tp_post_review_overall_score).' '.__('out of 10').'</span>';
					}elseif($tp_post_review_style == 'percent'){
						print '<span>'.intval($tp_post_review_overall_score).'%'.'</span>';
					}
				
				print '</div>';
			}
					
			print '
			<div class="info">
				<p><i class="fa fa-user"></i> '.__('BY ','ingrid'); the_author_posts_link(); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-comment"></i> '; comments_number( __('0 COMMENT','ingrid'), __('1 COMMENT','ingrid'), __('% COMMENTS','ingrid') ); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-tag"></i> '.str_replace('rel="category"','',get_the_category_list( __( ', ', 'ingrid' ) )).'</p>';
				
				// read more
				print '<p class="right"><a class="moretag" href="'. get_permalink($post->ID) . '">'.__('Read more &rarr;','ingrid').'</a></p>';
							
			print '
			</div>';
		}
		elseif(get_post_format() == 'audio'){
		// audio

			print '<div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div>';			
		
			print '<a href="'.get_permalink().'" title="'; the_title_attribute(); print '"><h3>'.get_the_title().'</h3></a>';
						
				if(strstr(get_post_meta($post->ID,'tp_postf_audio',true), '.mp3')){
					print '
					<div id="audioplayer_'.$post->ID.'" class="flash-audio">'.__('Couldn\'t load the Audio Player!','ingrid').'</div>
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
					print get_post_meta($post->ID,'tp_postf_audio',true);
				}
			
			
			
			if(has_excerpt()){
				the_excerpt();
			}
			
			if($show_review){
				print '<div class="post-review">'.get_post_meta($post->ID,'tp_post_review_overall',true).'&nbsp;&nbsp;&nbsp;&nbsp;';	
					$tp_post_review_style = get_post_meta($post->ID,'tp_post_review_style',true);
					$tp_post_review_overall = get_post_meta($post->ID,'tp_post_review_overall',true);
					$tp_post_review_overall_score = get_post_meta($post->ID,'tp_post_review_overall_score',true);
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
						print '<span>'.intval($tp_post_review_overall_score).' '.__('out of 10').'</span>';
					}elseif($tp_post_review_style == 'percent'){
						print '<span>'.intval($tp_post_review_overall_score).'%'.'</span>';
					}
				
				print '</div>';
			}
				
			print '
			<div class="info">
				<p><i class="fa fa-user"></i> '.__('BY ','ingrid'); the_author_posts_link(); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-comment"></i> '; comments_number( __('0 COMMENT','ingrid'), __('1 COMMENT','ingrid'), __('% COMMENTS','ingrid') ); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-tag"></i> '.str_replace('rel="category"','',get_the_category_list( __( ', ', 'ingrid' ) )).'</p>';
				
				// read more
				print '<p class="right"><a class="moretag" href="'. get_permalink($post->ID) . '">'.__('Read more &rarr;','ingrid').'</a></p>';
							
			print '
			</div>';	
		}
		elseif(get_post_format() == 'video'){
		// video
			if ( has_post_thumbnail() ) {
				print '
				<div class="post-thumb">
					<a href="'.get_permalink().'">'.get_the_post_thumbnail( $post->ID, array(347,158)).'</a><div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div>
					<a href="'.get_permalink().'" class="video"><img src="'.get_bloginfo('template_url').'/images/blog-video.png" alt="blog info" /></a>
				</div>';			
				
				print '<a href="'.get_permalink().'" title="'; the_title_attribute(); print '"><h3>'.get_the_title().'</h3></a>';
			}else{
				print '<div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div>';			
				
				print '<a href="'.get_permalink().'" title="'; the_title_attribute(); print '"><h3>'.get_the_title().'</h3></a>';
			
				print get_post_meta($post->ID,'tp_postf_video',true);
				
			}
			
			if(has_excerpt()){
				the_excerpt();
			}
			
			if($show_review){
				print '<div class="post-review">'.get_post_meta($post->ID,'tp_post_review_overall',true).'&nbsp;&nbsp;&nbsp;&nbsp;';	
					$tp_post_review_style = get_post_meta($post->ID,'tp_post_review_style',true);
					$tp_post_review_overall = get_post_meta($post->ID,'tp_post_review_overall',true);
					$tp_post_review_overall_score = get_post_meta($post->ID,'tp_post_review_overall_score',true);
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
						print '<span>'.intval($tp_post_review_overall_score).' '.__('out of 10').'</span>';
					}elseif($tp_post_review_style == 'percent'){
						print '<span>'.intval($tp_post_review_overall_score).'%'.'</span>';
					}
				
				print '</div>';
			}
				
			print '
			<div class="info">
				<p><i class="fa fa-user"></i> '.__('BY ','ingrid'); the_author_posts_link(); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-comment"></i> '; comments_number( __('0 COMMENT','ingrid'), __('1 COMMENT','ingrid'), __('% COMMENTS','ingrid') ); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-tag"></i> '.str_replace('rel="category"','',get_the_category_list( __( ', ', 'ingrid' ) )).'</p>';
				
				// read more
				print '<p class="right"><a class="moretag" href="'. get_permalink($post->ID) . '">'.__('Read more &rarr;','ingrid').'</a></p>';
							
			print '
			</div>';	
		}
		else{
		// default single post or aside
			
			if ( has_post_thumbnail() ) {
				print '<div class="post-thumb"><a href="'.get_permalink().'">'.get_the_post_thumbnail( $post->ID, array(347,158)).'</a><div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div></div>';			
			}else{
				print '<div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div>';			
			}
			
			print '<a href="'.get_permalink().'" title="'; the_title_attribute(); print '"><h3>'.get_the_title().'</h3></a>';
			
			the_excerpt();
			
			if($show_review){
				print '<div class="post-review">'.get_post_meta($post->ID,'tp_post_review_overall',true).'&nbsp;&nbsp;&nbsp;&nbsp;';	
					$tp_post_review_style = get_post_meta($post->ID,'tp_post_review_style',true);
					$tp_post_review_overall = get_post_meta($post->ID,'tp_post_review_overall',true);
					$tp_post_review_overall_score = get_post_meta($post->ID,'tp_post_review_overall_score',true);
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
						print '<span>'.intval($tp_post_review_overall_score).' '.__('out of 10').'</span>';
					}elseif($tp_post_review_style == 'percent'){
						print '<span>'.intval($tp_post_review_overall_score).'%'.'</span>';
					}
				
				print '</div>';
			}
			
			print '
			<div class="info">
				<p><i class="fa fa-user"></i> '.__('BY ','ingrid'); the_author_posts_link(); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-comment"></i> '; comments_number( __('0 COMMENT','ingrid'), __('1 COMMENT','ingrid'), __('% COMMENTS','ingrid') ); print '</p>
				<p class="sep">&nbsp;</p>
				<p><i class="fa fa-tag"></i> '.str_replace('rel="category"','',get_the_category_list( __( ', ', 'ingrid' ) )).'</p>';
				
				// read more
				print '<p class="right"><a class="moretag" href="'. get_permalink($post->ID) . '">'.__('Read more &rarr;','ingrid').'</a></p>';
							
			print '
			</div>';
			
		}
	}
	
	
?>

</article>