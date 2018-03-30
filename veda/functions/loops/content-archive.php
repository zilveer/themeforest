<?php
	$page_layout = veda_option('pageoptions','post-archives-page-layout');
	$page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";
    $container_class = '';
	
	$show_sidebar = true;
	if( $page_layout == "content-full-width" ){
		$show_sidebar = false;
	}

	$post_layout = veda_option('pageoptions','post-archives-post-layout');
	$post_layout = isset( $post_layout ) ? $post_layout : 'one-column';
	switch($post_layout):
		default:
		case 'one-column':
			$post_class = $show_sidebar ? "column dt-sc-one-column with-sidebar blog-fullwidth" : "column dt-sc-one-column blog-fullwidth";
			$columns = 1;
		break;
		
		case 'one-half-column':
			$post_class = $show_sidebar ? "column dt-sc-one-half with-sidebar" : "column dt-sc-one-half";
			$columns = 2;
			$container_class = "apply-isotope";
		break;
		
		case 'one-third-column':
			$post_class = $show_sidebar ? "column dt-sc-one-third with-sidebar" : "column dt-sc-one-third";
			$columns = 3;
			$container_class = "apply-isotope";
		break;
	endswitch;



	$allow_excerpt = veda_option('pageoptions','post-archives-enable-excerpt');
	$excerpt = veda_option('pageoptions','post-archives-excerpt');
	
	$allow_read_more = veda_option('pageoptions','post-archives-enable-readmore');
	$read_more = veda_option('pageoptions','post-archives-readmore');

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
	$show_tag_meta = isset( $show_tag_meta ) ? "" : "hidden";

	$post_style = veda_option('pageoptions','post-style');
	$post_style = isset( $post_style ) ? $post_style : "";

	if( have_posts() ) :
		$i = 1;
		echo "<div class='tpl-blog-holder ".esc_attr( $container_class )."'>";
		
		while( have_posts() ):
			the_post();
			
			$temp_class = "";
			
			if($i == 1) $temp_class = $post_class." first"; else $temp_class = $post_class;
			if($i == $columns) $i = 1; else $i = $i + 1;
			
			$format = get_post_format(  get_the_id() );
			$format_link = 	get_post_format_link( $format );
			$link = get_permalink( get_the_id() );
			$link = rawurlencode( $link );
			
			$post_meta = get_post_meta(get_the_id() ,'_dt_post_settings',TRUE);
			$post_meta = is_array($post_meta) ? $post_meta : array();
			
			$custom_class = "";?>
				<div class="<?php echo esc_attr($temp_class);?>">
                	<article id="post-<?php the_ID();?>" <?php post_class('blog-entry '.$post_style);?>>
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
                        
                        <!-- Content -->
                        <?php if( $post_style == "entry-date-left"): ?>
                        		
                                <div class="entry-details">
                                
                                    <div class="entry-date">
                                    
                                        <!-- date -->
                                        <div class="<?php echo esc_attr($show_date_meta);?>">
                                            <?php echo get_the_date('d');?>
                                             <span><?php echo get_the_date('M');?></span>
                                        </div><!-- date -->
                                        
                                        <!-- comment -->
                                        <div class="comments <?php echo esc_attr($show_comment_meta);?>"><?php
											comments_popup_link( 
												wp_kses( __('<i class="pe-icon pe-chat"> </i> 0','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ),
												wp_kses( __('<i class="pe-icon pe-chat"> </i> 1','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ),
                                                wp_kses( __('<i class="pe-icon pe-chat"> </i> %','veda') , array( 'i' => array('class' => array(), 'id' => array()) ) ), 
                                                '',
                                                wp_kses( __('<i class="pe-icon pe-chat"> </i>','veda') , array( 'i' => array('class' => array(), 'id' => array())) ) );?>
                                        </div><!-- comment -->                                         
                                     </div><!-- .entry-date -->


                                	<div class="entry-title">
                                    	<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('Permalink to %s','veda'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
                                    </div>
                                    
                                   <?php if( isset($allow_excerpt) && isset($excerpt) ):?>
                                    		<div class="entry-body"><?php echo veda_excerpt($excerpt);?></div>
                                   <?php endif;?>

                                   <!-- Author & Category & Tag -->
                                   <div class="entry-meta-data">
                                   
                                   		<p class="author <?php echo esc_attr( $show_author_meta );?>">
                                        	<i class="pe-icon pe-user"> </i>
                                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
                                            	title="<?php esc_attr_e('View all posts by ', 'veda'); echo get_the_author();?>"><?php echo get_the_author();?></a>
                                        </p>
                                                                           
								   		<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");
										# Check category exists
										if(count(get_the_category())):?>
	                                        <p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p><?php
										endif;?>	
                                        
                                   </div><!-- Category & Tag -->
                                   
                                   <!-- Read More Button -->
                                   <?php if( isset($allow_read_more) && isset($read_more) ):
											$read_more = stripcslashes($read_more);
											$sc = str_replace("]",' link="url:'.$link.'"]',$read_more);
											$sc = do_shortcode($sc);
											echo !empty( $sc ) ? $sc : '';											
										endif;?><!-- Read More Button -->
                                   
                                </div><!-- .entry-details -->
                                
                        <?php elseif( $post_style == "entry-date-author-left"):?>
                        
                        		<div class="entry-date-author">
                                
                                	<div class="entry-date <?php echo esc_attr($show_date_meta);?>">
                                    	<?php echo get_the_date('d');?>
                                        <span><?php echo get_the_date('M');?></span>
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
                                    
                                    <?php if( isset($allow_excerpt) && isset($excerpt) ):?>
                                    		<div class="entry-body"><?php echo veda_excerpt($excerpt);?></div>
                                   <?php endif;?>
                                   
                                   <!-- Category & Tag -->
                                   <div class="entry-meta-data">
								   		<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");
										# Check category exists
										if(count(get_the_category())):?>
	                                        <p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p><?php
										endif;?>	
                                   </div><!-- Category & Tag -->
                                   
                                   <!-- Read More Button -->
                                   <?php if( isset($allow_read_more) && isset($read_more) ):
											$read_more = stripcslashes($read_more);
											$sc = str_replace("]",' link="url:'.$link.'"]',$read_more);
											$sc = do_shortcode($sc);
											echo !empty( $sc ) ? $sc : '';											
										endif;?><!-- Read More Button -->
                                </div>
                                
                        <?php else: # Default Post Style ?>
                        		<div class="entry-details">
                                	<!-- Meta -->
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
                                            
                                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" 
                                            	title="<?php esc_attr_e('View all posts by ', 'veda'); echo get_the_author();?>"><?php echo get_the_author();?></a>
                                        </div>
                                    
                                    </div><!-- Meta -->
                                    
                                    <div class="entry-title">
                                    	<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('Permalink to %s','veda'), the_title_attribute('echo=0'));?>"><?php the_title(); ?></a></h4>
                                    </div>
                                    
                                    <?php if( isset($allow_excerpt) && isset($excerpt) ):?>
                                    		<div class="entry-body"><?php echo veda_excerpt($excerpt);?></div>
                                    <?php endif;?>
                                    
                                    <!-- Category & Tag -->
                                    <div class="entry-meta-data">
                                    	<?php the_tags("<p class='tags {$show_tag_meta}'> <i class='pe-icon pe-ticket'> </i>",', ',"</p>");
										# Check category exists
										if(count(get_the_category())):?>
	                                        <p class="<?php echo esc_attr( $show_category_meta );?> category"><i class="pe-icon pe-network"> </i> <?php the_category(', '); ?></p><?php
										endif;?>	
                                    </div><!-- Category & Tag -->
                                    
                                    <!-- Read More Button -->
                                    <?php if( isset($allow_read_more) && isset($read_more) ):
											$read_more = stripcslashes($read_more);
											$sc = str_replace("]",' link="url:'.$link.'"]',$read_more);
											$sc = do_shortcode($sc);
											echo !empty( $sc ) ? $sc : '';											
										  endif;?><!-- Read More Button -->
                            	</div><!-- .entry-details -->
                        <?php endif;?>
                        <!-- Content -->                        
                    </article>
				</div><?php
		endwhile;
		
		echo '</div>';?>
        
        	<!-- **Pagination** -->
            <div class="pagination blog-pagination"><?php echo veda_pagination();?></div><!-- **Pagination** -->
            <!-- Blog Template Ends --><?php
		
	else:?>
    	<h2><?php esc_html_e('Nothing Found.', 'veda'); ?></h2>
        <p><?php esc_html_e('Apologies, but no results were found for the requested archive.', 'veda'); ?></p><?php
	endif;?>