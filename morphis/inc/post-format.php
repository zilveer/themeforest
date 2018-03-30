<?php 
	$format = get_post_format();
	if ( false === $format )
	$format = 'standard';
 ?>
		
		<?php  if( has_post_thumbnail( $post->ID )) { // If post has featured image ?>
				
				<div class="four columns alpha">
					<div class="overlay">
						<figure>
							<?php $img_id = get_post_thumbnail_id($post->ID); ?>
							<?php $featured_url = wp_get_attachment_url( $img_id ); ?>							
							<?php $alt_text = get_post_meta( $img_id, '_wp_attachment_image_alt', true ); ?>			
							<?php $thumb_get = get_post($img_id); ?>
							<?php $thumb_title = $thumb_get->post_title; ?>
							<?php $portfolio_lightbox = get_post_meta($post->ID, '_cmb_feature_uncropped_image', TRUE);  //uncropped ?>
							
							<a href="<?php the_permalink(); ?>" class="overlay-mask"></a>			
							
							<?php if(!empty($portfolio_lightbox)): ?>
								<a class="icon-view" href="<?php echo $portfolio_lightbox; ?>" rel="prettyPhoto" title="<?php echo $thumb_title; ?>"></a>	
							<?php else: ?>
								<a class="icon-view" href="<?php echo $featured_url; ?>" rel="prettyPhoto" title="<?php echo $thumb_title; ?>"></a>	
							<?php endif; ?>
							
							<a class="icon-link" href="<?php the_permalink(); ?>" title="<?php _e( 'view portfolio', 'morphis' ); ?>"></a>
							<img src="<?php echo $featured_url; ?>" alt="<?php echo $alt_text; ?>" title="<?php echo $thumb_title; ?>" />					
							
						</figure>
					</div>
				</div>
				<aside class="four columns omega">
					<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
					<time><?php echo esc_attr( get_the_date() ); ?></time>
					<p><?php the_excerpt(); ?></p>	
				</aside>
			
		<?php } elseif ( $format == 'audio' ) { ?>
		
				<div class="four columns alpha">
					<div class="half-bottom">
						<?php jPlayer_audio($post->ID, TRUE); ?>
					</div>
				</div>
				<aside class="four columns omega">
					<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
					<time><?php echo esc_attr( get_the_date() ); ?></time>
					<p><?php the_excerpt(); ?></p>	
				</aside>
				
		<?php } elseif ( $format == 'image' ) { ?>
		
				<div class="four columns alpha">
					<?php $image_pf = get_post_meta($post->ID,'_cmb_image_pf_upload',TRUE); ?>	
					<?php $portfolio_lightbox = get_post_meta($post->ID, '_cmb_feature_uncropped_image', TRUE);  //uncropped ?>
					
					<?php if(!empty($portfolio_lightbox)): ?>
						<?php if ( $image_pf != '' ) { ?>
							<?php printf( '<div class="overlay squared remove-bottom"><figure><div class="overlay-mask"><a class="icon-view" href="%1$s" rel="prettyPhoto" title=""></a><a class="icon-link" href="'. get_permalink() .'"></a></div><img src="%1$s" alt="' . get_the_title() . '" /></figure></div>', $portfolio_lightbox ); ?>					
						<?php } ?>
					<?php else: ?>
						<?php if ( $image_pf != '' ) { ?>
							<?php printf( '<div class="overlay squared remove-bottom"><figure><div class="overlay-mask"><a class="icon-view" href="%1$s" rel="prettyPhoto" title=""></a><a class="icon-link" href="'. get_permalink() .'"></a></div><img src="%1$s" alt="' . get_the_title() . '" /></figure></div>', $image_pf ); ?>					
						<?php } ?>
					<?php endif; ?>
					
					
				</div>
				<aside class="four columns omega">
					<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
					<time><?php echo esc_attr( get_the_date() ); ?></time>
					<p><?php the_excerpt(); ?></p>	
				</aside>
		
		<?php } elseif ( $format == 'video' ) { ?>
		
				<div class="four columns alpha">
					<?php $codeEmbed = get_post_meta($post->ID, '_cmb_video_pf_embedded', true); ?>
					<?php if( !empty($codeEmbed) ) { ?>
					<?php echo "<div class='video-figure'>"; ?>
					<?php echo stripslashes(htmlspecialchars_decode($codeEmbed)); ?>
					<?php echo "</div>"; ?>
					<?php } else { ?>
						<div class="half-bottom">
					<?php jPlayer_video($post->ID, TRUE); ?>
						</div>
					<?php } ?>
				</div>		
				<aside class="four columns omega">
					<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
					<time><?php echo esc_attr( get_the_date() ); ?></time>
					<p><?php the_excerpt(); ?></p>	
				</aside>
		
		<?php } elseif ( $format == 'gallery' ) { ?>
				<div class="four columns alpha">					
					<?php gallery_carouFredSel($post->ID, get_the_content()); ?>										
				</div>
				<aside class="four columns omega">
					<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
					<time><?php echo esc_attr( get_the_date() ); ?></time>
					<p><?php the_excerpt(); ?></p>	
				</aside>
				
		<?php } elseif ( $format == 'status' ) { ?>
		
				<div class="four columns alpha">
					<div class="entry-content status">					
						<?php the_excerpt(); ?>
					</div>
				</div>		
				<aside class="four columns omega">
					<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
					<time><?php echo esc_attr( get_the_date() ); ?></time>
					<p><?php the_excerpt(); ?></p>	
				</aside>	
				
		<?php } elseif ( $format == 'chat' ) { ?>
		
				<div class="four columns alpha">
					<?php $htmlLine = ''; ?>
					<?php $postformat_chat = get_post_meta($post->ID,'_cmb_chat_pf_text',TRUE); ?>
					<?php $chatHolder = trim($postformat_chat); ?>
					<?php $textAr = explode("\n", $chatHolder); ?>
					<?php echo '<div class="chat-post-format"><p>'; ?>
					<?php foreach ($textAr as $line) { ?>				  
					<?php    $line = preg_replace('/:/', ':</strong>', $line, 1); ?>				
					<?php    $htmlLine .= '<strong>' . $line . '<br />'; ?>
					<?php } ?>
					<?php echo truncateWords($htmlLine, 22, "..."); ?>
					<?php echo '</p></div>'; ?>
				</div>
				<aside class="four columns omega">
					<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
					<time><?php echo esc_attr( get_the_date() ); ?></time>
					<p><?php the_excerpt(); ?></p>	
				</aside>
				
		<?php } elseif ( $format == 'link' ) { ?>
				
				<?php $postformat_link = get_post_meta($post->ID,'_cmb_link_pf_url',TRUE); ?>
				
				<div class="home-meta">
					<h6 class="entry-title"><a href="<?php echo $postformat_link; ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" target="_blank"><?php the_title(); ?> &rarr;</a></h6>												
				
					<time><?php echo esc_attr( get_the_date() ); ?></time>
				</div>
				
				<p><?php the_excerpt(); ?></p>	
			
				
		<?php } elseif ( $format == 'aside' ) { ?>
				
					<time><?php echo esc_attr( get_the_date() ); ?></time>
					<p><?php the_excerpt(); ?></p>	
				
		<?php } elseif ( $format == 'quote' ) { ?>
		
				<div class="four columns alpha">
					<div class="quote-pf-home half-bottom">
						<?php $postformat_quote = get_post_meta($post->ID,'_cmb_quote_pf_text',TRUE); ?>
						<h6>&#147;<?php echo truncateWords($postformat_quote, 20, " ... "); ?>&#148;</h6>
					</div>
				</div>				
				<aside class="four columns omega">
					<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
					<time><?php echo esc_attr( get_the_date() ); ?></time>
					<p><?php the_excerpt(); ?></p>	
				</aside>
		<?php } else { ?>
					
				<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
				<time><?php echo esc_attr( get_the_date() ); ?></time>
				<p><?php the_excerpt(); ?></p>				

		<?php } ?>