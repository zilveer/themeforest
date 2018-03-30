<?php $post_meta = get_post_meta($post->ID,'_dt_post_settings',TRUE);
	$post_meta = is_array($post_meta) ? $post_meta  : array();
	
	$format = get_post_format(  $post->ID );

	$post_style = veda_option('pageoptions','post-style');
	$post_style = isset( $post_style ) ? $post_style : "";
	$post_classes = array('blog-entry','single' , $post_style );

	$show_post_format = veda_option('pageoptions','post-format-meta'); 
	$show_post_format = isset( $show_post_format )? "" : "hidden";
	
	$show_author_meta = veda_option('pageoptions','post-author-meta');
	$show_author_meta = isset( $show_author_meta ) ? "" : "hidden";
	
	$show_date_meta = veda_option('pageoptions','post-date-meta');
	$show_date_meta = isset( $show_date_meta ) ? "" : "hidden";	

	$show_comment_meta = veda_option('pageoptions','post-comment-meta');
	$show_comment_meta = isset( $show_comment_meta ) ? "" : "hidden";

	$show_category_meta = veda_option('pageoptions','post-category-meta');
	$show_category_meta = isset( $show_category_meta ) ? "" : "hidden";
	
	$show_tag_meta = veda_option('pageoptions','post-tag-meta');
	$show_tag_meta = isset( $show_tag_meta ) ? "" : "hidden";?>

<article id="post-<?php the_ID();?>" <?php post_class($post_classes);?>>
	<?php if( array_key_exists('show-featured-image', $post_meta) ):?>
			<!-- Featured Image -->
			<?php if( $format == "image" || empty($format) ) :
					if( has_post_thumbnail() ) :?>
						<div class="entry-thumb">
							<a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','veda'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
							<div class="entry-format <?php echo esc_attr($show_post_format);?>">
								<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
							</div>
						</div><?php
					else:
							$custom_class = "has-no-post-thumbnail";
					endif;
                   elseif( $format === "gallery" ) :
                   		if( array_key_exists("items", $post_meta) ) :
                   			echo '<div class="entry-thumb">';
                   			echo '	<ul class="entry-gallery-post-slider">';
                   						foreach ( $post_meta['items'] as $item ) {
                   							echo "<li><img src='". esc_url($item)."' alt=''/></li>";
                                        }
                            echo '	</ul>';
                            echo '	<div class="entry-format '.esc_attr($show_post_format).'">';
                            echo '		<a class="ico-format" href="'.esc_url(get_post_format_link( $format )).'"></a>';
                            echo '	</div>';
                            echo '</div>';
                        elseif( has_post_thumbnail() ):?>
                        	<div class="entry-thumb">
                        		<a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','veda'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
                        		<div class="entry-format <?php echo esc_attr($show_post_format);?>">
                        			<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                        		</div>
                        	</div><?php
                        else:
                        		$custom_class = "has-no-post-thumbnail";
                        endif;
                   elseif( $format === "video" ) :
                   		if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ) :
                   			echo '<div class="entry-thumb">';
                   			echo'	<div class="dt-video-wrap">';
                   						if( array_key_exists('oembed-url', $post_meta) ) :
                   							echo wp_oembed_get($post_meta['oembed-url']);
                   						elseif( array_key_exists('self-hosted-url', $post_meta) ) :
                   							echo wp_video_shortcode( array('src' => $post_meta['self-hosted-url']) );
                                        endif;
                            echo '	</div>';
                            echo '	<div class="entry-format '.esc_attr($show_post_format).'">';
                            echo '		<a class="ico-format" href="'.esc_url(get_post_format_link( $format )).'"></a>';
                            echo '	</div>';
                            echo '</div>';
                        elseif( has_post_thumbnail() ):?>
                        	<div class="entry-thumb">
                        		<a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','veda'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
                        		<div class="entry-format <?php echo esc_attr($show_post_format);?>">
                        			<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                                </div>
                            </div><?php
                        else:
                        		$custom_class = "has-no-post-thumbnail";
                        endif;
                   elseif( $format === "audio" ) :
                   		if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ) :
                   			echo '<div class="entry-thumb">';
                   				if( array_key_exists('oembed-url', $post_meta) ) :
                   					echo wp_oembed_get($post_meta['oembed-url']);
                   				elseif( array_key_exists('self-hosted-url', $post_meta) ) :
                   					$custom_class = "self-hosted-audio";
	                   				echo wp_audio_shortcode( array('src' => $post_meta['self-hosted-url']) );
	                   			endif;
	                   		echo '	<div class="entry-format '.esc_attr($show_post_format).'">';
	                   		echo '		<a class="ico-format" href="'.esc_url(get_post_format_link( $format )).'"></a>';
	                   		echo '	</div>';
	                   		echo '</div>';
	                   	elseif( has_post_thumbnail() ):?>
	                   		<div class="entry-thumb">
	                   			<a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','veda'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
	                   			<div class="entry-format <?php echo esc_attr($show_post_format);?>">
	                   				<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
	                   			</div>
	                   		</div><?php
	                   	else:
	                   		$custom_class = "has-no-post-thumbnail";
                        endif;
                   else:
                   		if( has_post_thumbnail() ) :?>
                   			<div class="entry-thumb">
                   				<a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('Permalink to %s','veda'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail("full");?></a>
                   				<div class="entry-format <?php echo esc_attr($show_post_format);?>">
                   					<a class="ico-format" href="<?php echo esc_url(get_post_format_link( $format ));?>"></a>
                   				</div>
                   			</div><?php
                   		else:
                   			$custom_class = "has-no-post-thumbnail";
                   		endif;
                   	endif;?>
			<!-- Featured Image -->
	<?php endif;?>

	<!-- Content -->
	<?php if( $post_style == "entry-date-left"):?>
			<!-- .entry-details -->
			<div class="entry-details">

				<!-- .entry-date -->
				<div class="entry-date">
					
					<div class="<?php echo esc_attr($show_date_meta);?>">
						<?php echo get_the_date('d');?> <span><?php echo get_the_date('M');?></span>
					</div>

					<div class="comments <?php echo esc_attr($show_comment_meta);?>"><?php
						comments_popup_link( 
							wp_kses( __('<i class="pe-icon pe-chat"> </i> 0','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ),
							wp_kses( __('<i class="pe-icon pe-chat"> </i> 1','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ),
							wp_kses( __('<i class="pe-icon pe-chat"> </i> %','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ), 
							'',
							wp_kses( __('<i class="pe-icon pe-chat"> </i>','veda') , array( 'i' => array('class' => array(), 'id' => array())) ) ); ?>
					</div>
				</div><!-- .entry-date -->

				<div class="entry-title">
					<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('Permalink to %s','veda'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
				</div>
                
                <div class="entry-body">
                	<?php the_content();?>
                    <?php wp_link_pages( array( 'before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 'next_or_number'=>'number',
						'pagelink' => '%', 'echo' => 1 ) );?>
                </div>

				<!-- Author & Category & Tag -->
				<div class="entry-meta-data">
					<p class="author <?php echo esc_attr( $show_author_meta );?>">
						<i class="pe-icon pe-user"> </i>
						<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
							title="<?php esc_attr_e('View all posts by ', 'veda'); echo get_the_author();?>"><?php echo get_the_author();?></a>
					</p>

					<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");?>

					<p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
				</div><!-- Category & Tag -->

				<?php edit_post_link( esc_html__( ' Edit ','veda' ) ); ?>
			</div><!-- .entry-details -->
	<?php elseif( $post_style == "entry-date-author-left"):?>
			<div class="entry-date-author">
				<div class="entry-date <?php echo esc_attr($show_date_meta);?>">
					<?php echo get_the_date('d');?> <span><?php echo get_the_date('M');?></span>
				</div>

				<div class="entry-author <?php echo esc_attr( $show_author_meta );?>">
					<?php echo get_avatar(get_the_author_meta('ID'), 72 );?>
					<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
						title="<?php esc_attr_e('View all posts by ', 'veda'); echo get_the_author();?>"><span><?php echo get_the_author();?></span></a>
				</div>

				<div class="comments <?php echo esc_attr($show_comment_meta);?>"><?php
					comments_popup_link(
						wp_kses( __('<i class="pe-icon pe-chat"> </i> 0','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ),
						wp_kses( __('<i class="pe-icon pe-chat"> </i> 1','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ),
						wp_kses( __('<i class="pe-icon pe-chat"> </i> %','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ), 
						'',
						wp_kses( __('<i class="pe-icon pe-chat"> </i>','veda') , array( 'i' => array('class' => array(), 'id' => array())) ) );?>
												
				</div>
			</div>
			<div class="entry-details">
				<div class="entry-title">
					<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('Permalink to %s','veda'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
				</div>

				<div class="entry-body">
					<?php the_content();?>
					<?php wp_link_pages( array( 'before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 'next_or_number'=>'number',
							'pagelink' => '%', 'echo' => 1 ) );?>
                </div>

				<!-- Category & Tag -->
				<div class="entry-meta-data">
					<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");?>
					<p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
				</div><!-- Category & Tag -->

				<?php edit_post_link( esc_html__( ' Edit ','veda' ) ); ?>
			</div>	
	<?php else: # Default Post Style ?>
			<!-- .entry-details -->
			<div class="entry-details">

				<!-- .entry-meta -->
				<div class="entry-meta">
					<div class="date <?php echo esc_attr($show_date_meta);?>"><?php esc_html_e('Posted on','veda'); echo get_the_date(' d M Y');?></div>
					<div class="comments <?php echo esc_attr($show_comment_meta);?>"> / <?php
						comments_popup_link(
							wp_kses( __('<i class="pe-icon pe-chat"> </i> 0','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ),
							wp_kses( __('<i class="pe-icon pe-chat"> </i> 1','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ),
							wp_kses( __('<i class="pe-icon pe-chat"> </i> %','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ), 
							'',
							wp_kses( __('<i class="pe-icon pe-chat"> </i>','veda') , array( 'i' => array('class' => array(), 'id' => array())) ) );?>
					</div>
					<div class="author <?php echo esc_attr( $show_author_meta );?>">
						/ <i class="pe-icon pe-user"> </i>
						<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php esc_attr_e('View all posts by ', 'veda'); echo get_the_author();?>">
							<?php echo get_the_author();?></a>
                    </div>					
				</div><!-- .entry-meta -->

				<div class="entry-title">
					<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('Permalink to %s','veda'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
				</div>

				<div class="entry-body">
					<?php the_content();?>
                    <?php wp_link_pages( array( 'before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 'next_or_number'=>'number',
                                'pagelink' => '%', 'echo' => 1 ) );?>
                </div>

				<!-- Category & Tag -->
				<div class="entry-meta-data">
					<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");?>
					<p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p>
				</div><!-- Category & Tag -->

				<?php edit_post_link( esc_html__( ' Edit ','veda' ) ); ?>
			</div><!-- .entry-details -->
	<?php endif;?>
	<!-- Content -->
</article>

<?php # Post Author Information Box
	$post_author_box = veda_option('pageoptions','single-post-authorbox');
	if( isset($post_author_box) ):?>
		<div class="dt-sc-hr"></div>
		<div class="dt-sc-clear"></div>
		<section class="author-info">
        	<h2><?php esc_html_e('About Author','veda');?></h2>
			<div class="thumb">
				<?php echo get_avatar(get_the_author_meta('ID'), 450 );?>
			</div>
			<div class="desc-wrapper">
				<h3><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></h3>
				<div class="desc"><?php the_author_meta('description'); ?></div>
			</div>	
		</section>
<?php endif;

	# Related Posts
	$related_post = veda_option('pageoptions','single-post-related');
	if( isset($related_post) && $aCategories = wp_get_post_categories( get_the_ID() ) ):

			$page_layout  = array_key_exists( "layout", $post_meta ) ? $post_meta['layout'] : "content-full-width";
			if( $page_layout == "content-full-width" ){
				$post_class = "column dt-sc-one-third";
			}else{
				$post_class = "column dt-sc-one-third with-sidebar";
			}

			$sc = "[dt_sc_blog_related_post post_class='".$post_class."' post_style='".$post_style."' id='".get_the_ID()."' /]";
			echo do_shortcode($sc);
	endif;

	#Post Comments
	$post_comment = veda_option('pageoptions','single-post-comments');
	if( isset($post_comment) ):?>
		<div class="dt-sc-hr"></div>
		<div class="dt-sc-clear"></div>
		<!-- ** Comment Entries ** -->
		<section class="commententries">
			<?php  comments_template('', true); ?>
		</section>
<?php endif;?>		