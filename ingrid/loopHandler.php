 <?php   
define('WP_USE_THEMES', false); 
require_once('../../../wp-load.php'); 

// our loop  
		if(!empty($_GET['categories_to_display'])){ $categories_to_display = $_GET['categories_to_display']; }
		if(!empty($_GET['tp_page_pingrid_excerpt'])){ $tp_page_pingrid_excerpt = '1'; }else{ $tp_page_pingrid_excerpt = ''; }
		if(!empty($_GET['tp_page_pingrid_review'])){ $tp_page_pingrid_review = '1'; }else{ $tp_page_pingrid_review = ''; }
		if(!empty($_GET['tp_page_pingrid_date'])){ $tp_page_pingrid_date = '1'; }else{ $tp_page_pingrid_date = ''; }
		if(!empty($_GET['tp_page_pingrid_comm'])){ $tp_page_pingrid_comm = '1'; }else{ $tp_page_pingrid_comm = ''; }
		if(!empty($_GET['tp_page_pingrid_commtxt'])){ $tp_page_pingrid_commtxt = '1'; }else{ $tp_page_pingrid_commtxt = ''; }
		if(!empty($_GET['tp_page_pingrid_author'])){ $tp_page_pingrid_author = '1'; }else{ $tp_page_pingrid_author = ''; }
		if(!empty($_GET['limit'])){ $limit = intval($_GET['limit']); }else{ $limit = '9'; }
		if(!empty($_GET['offset'])){ $offset = intval($_GET['offset']); }else{ $offset = '0'; }
		
		
		
		$the_query = new WP_Query( array(				
			'post_type' => 'post',
			'category_name' => $_GET['categories_to_display'],
			'posts_per_page' => $limit,
			'offset' => $offset
		) );
		
		if($the_query->have_posts()){
		while ( $the_query->have_posts() ){
			$the_query->the_post();		
				
				
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ), 'medium');
		
		
			$xclass = '';
			if(empty($tp_page_pingrid_date)){$xclass = ' padd';}
			
			print '<div class="brick'.$xclass.' loaded">
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
					print '<a href="'.get_post_meta($post->ID,'tp_postf_link',true).'" title="'; the_title_attribute(); print '" target="_blank"><h1>'.get_the_title().'</h1></a>';
					
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
						
						$cnt = preg_replace($pattern,'width="204"',get_post_meta($post->ID,'tp_postf_video',true));
						print preg_replace($pattern2,'height=""',$cnt,true);
						
					}				
				}
				
				
					
				//excerpt	
				if(empty($tp_page_pingrid_excerpt)){
					if(has_excerpt()){						
						print '<p class="excerpt">'.get_the_excerpt().'</p>';
					}else{
						if(get_post_format() == 'quote'){							
							print get_the_content();							
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
			<div id="load_more" data-limit="'.$limit.'" data-offset="'.$offset.'" data-cats="'.$categories_to_display.'" data-excerpt="'.$tp_page_pingrid_excerpt.'" data-review="'.$tp_page_pingrid_review.'" data-date="'.$tp_page_pingrid_date.'" data-comm="'.$tp_page_pingrid_comm.'" data-commtxt="'.$tp_page_pingrid_commtxt.'" data-author="'.$tp_page_pingrid_author.'">
				<a href="#">'.__('LOAD MORE','ingrid').'
				<br /><img src="'.get_bloginfo('template_url').'/images/load_more.png" alt="load more posts" /></a>
			</div>';
			
			
		}
		
		
		
		
		  
?> 