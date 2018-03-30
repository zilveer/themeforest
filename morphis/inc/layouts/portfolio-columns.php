				
				<?php $portfolio_item_cats = get_the_terms( $post->ID, 'Categories' ); ?>
				
				<?php $arr_portfolio_slugs = array(); ?>
				<?php if(!empty($portfolio_item_cats)): ?>
					<?php foreach( $portfolio_item_cats as $portfolio_cat ) { ?>				
						<?php $arr_portfolio_slugs[] =  urldecode( $portfolio_cat->slug ); ?>				
					<?php } ?>
				<?php endif; ?>
				<?php $portfolio_item_cats_string = implode( " ", $arr_portfolio_slugs ); ?>
				
				<?php if($portfolio_item_cats_string == ''){ $portfolio_item_cats_string =' '; } ?>
				
				<?php if ($portfolio_column_layout == '4') : $item_column = 'four columns'; ?>
				<?php elseif ($portfolio_column_layout == '3') : $item_column = 'one-third column'; ?>
				<?php elseif ($portfolio_column_layout == '2') : $item_column = 'eight columns'; ?>
				<?php endif; ?>
				
				<?php if($quicksand_item == 'with-sidebar') { ?>
					<?php $item_column = 'four columns'; ?>
				<?php } ?>
			
				
				<?php if ($portfolio_item_post_count%$portfolio_column_layout == 1) : ?>
					<?php $item_pos = 'alpha'; ?>
				<?php elseif ($portfolio_item_post_count%$portfolio_column_layout == 0) : ?>
					<?php $item_pos = 'omega'; ?>
				<?php else : ?>
					<?php $item_pos = ''; ?>
				<?php endif; ?>
				
				<li data-id="id-<?php echo $portfolio_item_post_count; ?>" data-type="<?php echo $portfolio_item_cats_string; ?>" class="portfolio-data <?php echo $item_column; ?> <?php echo $item_pos; ?>">				
					<?php $featured_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					
					<?php //Optional Link to page ?>
					<?php $optional_link_page = ''; ?>
					<?php $portfolio_link = ''; ?>
					<?php $portfolio_content_link = ''; ?>
					<?php $optional_link_page = get_post_meta($post->ID, '_cmb_optional_link_page', TRUE);  ?>
					<?php if($optional_link_page != ''): ?>
						<?php $portfolio_link = $optional_link_page; ?>						
					<?php else: ?>
						<?php $portfolio_link = '#'; ?>
						<?php $portfolio_content_link = 'portfolio-content-link' ?>
					<?php endif; ?>
					
					<div class="overlay">
						<figure>										
							<a href="#">
														
							<?php // get portfolio attachment video link if vimeo or youtube ?>
							<?php $attachment_type = get_post_meta($post->ID, '_cmb_select_attachment', TRUE)  ?>
							
							<?php if($attachment_type == 'youtube' || $attachment_type == 'vimeo') : ?>
								<?php if($attachment_type == 'vimeo'): ?>
									<a class="icon-view" href="http://vimeo.com/<?php echo getVimeoID(get_post_meta($post->ID, '_cmb_attachment_' . $attachment_type, TRUE)); ?>" rel=	"prettyPhoto" title="<?php the_title(); ?>"></a>
								<?php elseif ($attachment_type == 'youtube'): ?>
									<a class="icon-view" href="http://www.youtube.com/watch?v=<?php echo getYoutubeID(get_post_meta($post->ID, '_cmb_attachment_' . $attachment_type, TRUE)); ?>" rel=	"prettyPhoto" title="<?php the_title(); ?>"></a>
								<?php endif; ?>
							<?php else: ?>
							
								<?php $portfolio_lightbox = get_post_meta($post->ID, '_cmb_feature_uncropped_image', TRUE);  //uncropped ?>
								<?php if(!empty($portfolio_lightbox)): ?>
									<a class="icon-view" href="<?php echo $portfolio_lightbox; ?>" rel="prettyPhoto" title="<?php the_title(); ?>"></a>
								<?php else: ?>
									<a class="icon-view" href="<?php echo $featured_url; ?>" rel="prettyPhoto" title="<?php the_title(); ?>"></a>
								<?php endif; ?>
								
							<?php endif; ?>							
								
								<a class="<?php echo $portfolio_content_link; ?> icon-link" href="<?php echo $portfolio_link; ?>" title="<?php _e( 'view portfolio', 'morphis' ); ?>" data-post_id="<?php echo $post->ID; ?>"></a>
							</a>		
								<a class="<?php echo $portfolio_content_link; ?>" href="<?php echo $portfolio_link; ?>" data-post_id="<?php echo $post->ID; ?>" ><img src="<?php echo $featured_url; ?>" alt="<?php the_title(); ?>" /></a>																					
						</figure>						
						<h6><a class="<?php echo $portfolio_content_link; ?>" href="<?php echo $portfolio_link; ?>" data-post_id="<?php echo $post->ID; ?>" ><?php the_title(); ?></a></h6>
						<p class="half-bottom"><?php echo strip_tags(truncateWords(get_post_meta($post->ID, '_cmb_info_desc', TRUE), 12, "")); ?></p>
					</div>				
					
				</li>
				<?php if ($portfolio_item_post_count%$portfolio_column_layout == 0) : ?>
					<li data-id="id-<?php echo $portfolio_item_post_count; ?>" class="clearer"><div class="clear"></div></li>
				<?php endif; ?>
				
			
			
		
		