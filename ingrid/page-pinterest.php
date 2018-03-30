<?php
/*
Template Name: Page - Pinterest Style
*/


get_header(); 


// show page content 
	if (have_posts()){
		print '
		<section id="page" class="wrapper">

			<section id="full-width-content">
			';
				

					while ( have_posts() ) : the_post();
						the_content();
						
					endwhile;
				
			
			print '
			</section>';
			
		print '
		</section><!-- #page .wrapper -->
		';
	
	}
	
	
// show the grid	


	print '
	<section class="grid pinterest">
	';

		$categories_to_display = implode(',',get_post_meta(get_the_ID(), 'ub_blog_cats', true));
		$tp_page_pingrid_excerpt = get_post_meta(get_the_ID(),'tp_page_pingrid_excerpt',true);
		$tp_page_pingrid_review = get_post_meta(get_the_ID(),'tp_page_pingrid_review',true);
		$tp_page_pingrid_date = get_post_meta(get_the_ID(),'tp_page_pingrid_date',true);
		$tp_page_pingrid_comm = get_post_meta(get_the_ID(),'tp_page_pingrid_comm',true);
		$tp_page_pingrid_commtxt = get_post_meta(get_the_ID(),'tp_page_pingrid_commtxt',true);
		$tp_page_pingrid_author = get_post_meta(get_the_ID(),'tp_page_pingrid_author',true);
		$limit = get_post_meta(get_the_ID(),'tp_page_pingrid_limit',true);		
		if(empty($limit)){ $limit = '9'; }			
		
		
		$the_query = new WP_Query( array(				
			'post_type' => 'post',
			'category_name' => $categories_to_display,
			'posts_per_page' => $limit
		) );
				
		while ( $the_query->have_posts() ){
			$the_query->the_post();		
				
				
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ), 'medium');
		
		
			$xclass = '';
			if(empty($tp_page_pingrid_date)){$xclass = ' padd';}
			
			print '<div class="brick'.$xclass.'">
				<div class="brick-inner">';
			
			
				//thumb
				if(!empty($thumbnail[0])){
					if(get_post_format() == 'video'){
						print '<a href="'.get_permalink().'" class="featuredi">
							<img src="'.$thumbnail[0].'" class="thumb" alt="post thumbnail" />
							<img src="'.get_bloginfo('template_url').'/images/blog-video.png" class="video" alt="video post">
						</a>';
					}else{
						print '<a href="'.get_permalink().'"><img src="'.$thumbnail[0].'" class="thumb" alt="post thumbnail" /></a>
						';
					}
				}
			
				//title
				if(get_post_format() == 'link'){
					if($GLOBALS['nu_wp_version'] == '1'){		
						print '<a href="'.get_the_post_format_url().'" target="_blank"><h1>'.get_the_title().'</h1></a>';
					}else{
						print '<a href="'.get_post_meta($post->ID,'tp_postf_link',true).'" title="'; the_title_attribute(); print '" target="_blank"><h1>'.get_the_title().'</h1></a>';
					}
				}else{
					print '<a href="'.get_permalink().'"><h1>'.get_the_title().'</h1></a>';
				}
				
				//info
				if(empty($tp_page_pingrid_comm) || empty($tp_page_pingrid_author)){					
					print '<p class="info-comment">- '; 
					
					if(empty($tp_page_pingrid_comm)){
						comments_number( __('0 COMMENT','ingrid'), __('1 COMMENT','ingrid'), __('% COMMENTS','ingrid') ); 
					}	
					
					if(empty($tp_page_pingrid_author)){
						if(empty($tp_page_pingrid_comm)){
							print ' | ';
						}
						
						print __('BY ','ingrid') . get_the_author();
					}
					
					print ' -</p>';
				}	
					
				//audio - video	
				if(get_post_format() == 'audio'){							
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
											
				}	
				elseif(get_post_format() == 'video'){
					if (!has_post_thumbnail() ) {
						$pattern = '/(width)="[0-9]*"/i';
						$pattern2 = '/(height)="[0-9]*"/i';
						if($GLOBALS['nu_wp_version'] == '1'){		
							$cnt = preg_replace($pattern,'width="204"',get_the_post_format_media('video'));												
							$cnt = preg_replace($pattern2,'height="120"',$cnt);				
							print str_replace('?feature=oembed','?feature=oembed&showinfo=0&controls=2',$cnt);
						}else{
							$cnt = preg_replace($pattern,'width="204"',get_post_meta($post->ID,'tp_postf_video',true));
							print preg_replace($pattern2,'height=""',$cnt,true);
						}
					}				
				}
				
				
					
				//excerpt	
				if(empty($tp_page_pingrid_excerpt)){
					if(has_excerpt()){						
						print '<p class="excerpt">'.get_the_excerpt().'</p>';
					}else{
						if(get_post_format() == 'quote'){
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
									print '<p class="q"><a href="'.$format_meta['url'].'" target="_blank"><em>- '.$format_meta['quote_source'].'</em></a></p>';
								}
								elseif(!empty($format_meta['quote_source'])){
									print '<p class="q"><em>- '.$format_meta['quote_source'].'</em></p>';
								}
							}else{
								print get_the_content();
							}
						}						
					}
					
				}
						
						
				//review
				if(empty($tp_page_pingrid_review)){
					$tp_post_review_style = get_post_meta($post->ID,'tp_post_review_style',true);
					$tp_post_review_overall = get_post_meta($post->ID,'tp_post_review_overall',true);
					$tp_post_review_overall_score = get_post_meta($post->ID,'tp_post_review_overall_score',true);
					
					if($tp_post_review_overall_score != 'Score' && !empty($tp_post_review_overall_score)){
					
						print '<div class="post-review">';				
							
							
							if($tp_post_review_style == 'stars'){
								print '<span class="stars">';
								if($tp_post_review_overall_score > 0 && $tp_post_review_overall_score <= 5){																						
									for($i = '1'; $i <= 5; $i++){
										if($tp_post_review_overall_score >= $i){
											print '<img src="'.get_bloginfo('template_url').'/images/review-star.png" alt="review star" />';
										}else{
											print '<img src="'.get_bloginfo('template_url').'/images/review-star-off.png" alt="review star" />';
										}
									}
								}
								print '</span>';
							}elseif($tp_post_review_style == 'score'){
								print '<span class="score">'.intval($tp_post_review_overall_score).' '.__('out of 10').'</span>';
							}elseif($tp_post_review_style == 'percent'){
								print '<span class="score">'.intval($tp_post_review_overall_score).'%'.'</span>';
							}				
							
							
							if(!empty($tp_post_review_overall)){
								print '<p>'.$tp_post_review_overall.'</p>';
							}
							
						print '</div>';
					}
				}
						
			print '
				</div><!-- end of .brick-inner -->';
			
			
			if(empty($tp_page_pingrid_date)){					
				print '<div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div>';			
			}			
			
			
			
			if(!empty($tp_page_pingrid_commtxt)){
				$args = array(
					'number' => '1',
					'order' => 'DESC',
					'status' => 'approve',
					'post_id' => $post->ID
				);
				$da_comment = get_comments( $args );
				if(!empty($da_comment)){
					print '<div class="comment">';
					if(!validate_gravatar(get_comment_author_email($da_comment[0]->comment_ID))){
						//replace to theme avatar
						print '<img class="avatar avatar-28 photo" width="28" height="28" src="'.get_bloginfo('template_url').'/images/avatar.jpg" alt="comment author avatar">';
						
					}else{
						//default
						print get_avatar($post->ID,'28');
					}
					print '<strong>'.get_comment_author($da_comment[0]->comment_ID).'</strong><br />'.strip_tags($da_comment[0]->comment_content).'</div>';
				}
			}
			
			
			print '</div>';
		}
		
		
		//load more		
		print '
		<div id="load_more" data-limit="'.$limit.'" data-offset="0" data-cats="'.$categories_to_display.'" data-excerpt="'.$tp_page_pingrid_excerpt.'" data-review="'.$tp_page_pingrid_review.'" data-date="'.$tp_page_pingrid_date.'" data-comm="'.$tp_page_pingrid_comm.'" data-commtxt="'.$tp_page_pingrid_commtxt.'" data-author="'.$tp_page_pingrid_author.'">
			<a href="#">'.__('LOAD MORE','ingrid').'
			<br /><img src="'.get_bloginfo('template_url').'/images/load_more.png" alt="load more posts" /></a>
		</div>';
		
	print '
	</section>
	';	
	
get_footer(); 

?>