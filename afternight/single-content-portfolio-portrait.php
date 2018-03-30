<?php
	$post_id = $post -> ID;
                    
    $s = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
    
    $zoom = false; 
    
    if( options::logic( 'blog_post' , 'enb_featured' ) ){
        if ( has_post_thumbnail( $post -> ID ) && get_post_format( $post -> ID ) != 'video' ) {
            $src        = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
            $src_       = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
            $caption    = image::caption( $post -> ID );
            $zoom       = true;
        }
    }

    $post_format = get_post_format( $post -> ID );
    if(!strlen($post_format)){ $post_format = 'standard';}

    
    if(!options::logic( 'blog_post' , 'meta' ) || !meta::logic( $post , 'settings' , 'meta' )){
        $no_meta_class = ' no-meta ';
    }else{
        $no_meta_class = ' ';
    }
?>

<div class="row">
        <div class="twelve columns">
            <article class="post portfolio-single portrait <?php echo $no_meta_class; ?>">
            	<div class="row bottom-separator">

            		<div class="seven columns">
                        <header class="featimg">
                        	<?php get_template_part('featured_image'); ?>
                            <?php
                
				                if( get_post_format( $post -> ID ) == 'link' ){
				                    echo post::get_attached_file( $post -> ID );
				                }
				                
				            ?>
                        </header>
                    </div>
                    <div class="five columns">
                        <div class="row">
                            <div class="twelve columns">
                                <h2 class="portfolio-title full"><?php the_title(); ?></h2>
                            </div>
                            <div class="twelve columns"> 
                            <?php if(meta::logic( $post , 'settings' , 'meta' ) && options::logic( 'blog_post' , 'meta' )){ ?>                           
                                <ul class="full-entry-meta">
					                <li>
					                    <div class="meta_name"><?php _e('Date','cosmotheme'); ?></div>
					                    <div class="meta_value"><?php echo post::get_post_date($post -> ID); ?>  </div>
					                    
					                </li>                                	
                                    <?php
					            		$client = post::get_client($post->ID); 

					            		if(strlen($client)){
					            	?>
					            		<li>
						                    <div class="meta_name"><?php _e('Client','cosmotheme'); ?></div>
						                    <div class="meta_value"><?php echo $client; ?></div>
						                </li>
					            	<?php		
					            		}
					            	?>	
					                
					                <?php
					                	$portfolio_categs = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = 'portfolio-category', $margin_elem_start = '<li>', $margin_elem_end = '</li>', $delimiter = ',&nbsp;');

					                	
					                	if(strlen(trim($portfolio_categs))){
					                ?>
					                	<li class="category">
						                    <div class="meta_name">
						                        <?php _e('Category','cosmotheme'); ?>
						                    </div>
						                    <div class="meta_value">
							                    <ul>
							                        <?php echo $portfolio_categs; ?>
							                    </ul>
						                    </div>
						                </li>
					                <?php		
					                	}
					                ?>
					                
					                <?php
					                    $services = post::get_services($post->ID); 

					                    if(strlen($services)){
					                ?>
					                    <li>
					                        <div class="meta_name"><?php _e('Services','cosmotheme'); ?></div>
					                        <div class="meta_value"><?php echo $services; ?></div>
					                    </li>
					                <?php       
					                    }
					                ?>

					                <?php
					                	$portfolio_tags = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = 'portfolio-tag', $margin_elem_start = '<li>', $margin_elem_end = '</li>', $delimiter = ',&nbsp;');

					                	if(strlen(trim($portfolio_tags))){
					                ?>
					                	<li class="tags">
						                    <div class="meta_name">
						                        <?php _e('Tags','cosmotheme'); ?>
						                    </div>
						                    <div class="meta_value">
							                    <ul>
							                        <?php echo $portfolio_tags; ?>
							                    </ul>
						                    </div>
						                </li>
					                <?php	
					                	}
					                ?>

					                <?php
					            		$source = post::get_source($post->ID); 

					            		if(strlen($source)){
					            	?>
					            		<li>
						                    <div class="meta_name"><?php _e('URL','cosmotheme'); ?></div>
						                    <div class="meta_value"><?php echo link_souce($source); ?></div>
						                </li>
					            	<?php		
					            		}

					            		/*custom post meta*/
                    					post::render_custom_meta($post -> ID);
					            	?>

					                <?php if( options::logic( 'likes' , 'enb_likes' ) && meta::logic( $post , 'settings' , 'love' ) ){ ?>
										<li class="meta-likes-container">
						                    <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = true);  ?>
						                </li>
					                <?php } ?>					                
                                </ul>
                                <?php } ?>
                                <?php
                    
			                    if( ( isset( $meta[ 'enb_navigation'] ) && $meta[ 'enb_navigation'] == 'yes' ) ||
			                        ( !isset( $meta[ 'enb_navigation'] ) && options::logic( 'blog_post', 'enb-next-prev' ) )
			                    ){
			                    	$portfolio_first_categ = post::get_post_categories($post->ID, $only_first_cat = true, $taxonomy = 'portfolio-category', $margin_elem_start = '', $margin_elem_end = '', $delimiter = '', $a_class = 'list');
			                    ?>	
                                <ul class="single-controls">
                                    <?php
		                                $ppost = get_previous_post();
		                                $npost = get_next_post();
		                                if( !empty( $ppost ) ){
		                                    echo '<li><a class="prev" href="' . get_permalink( $ppost -> ID ) . '" title="'.$ppost -> post_title.'"></a></li>';
		                                }
		                                if(strlen($portfolio_first_categ)){
		                                    echo '<li>'.$portfolio_first_categ.'</li>';
		                                }
		                                    
		                                if( !empty( $npost ) ){
		                                    echo '<li><a class="next" href="' . get_permalink( $npost -> ID ) . '" title="'.$npost -> post_title.'"></a></li>';
		                                }
		                            ?>
                                </ul>
                                <?php } ?>
                                <div class="clear"></div>
                            </div>
                            <div class="twelve columns">
                            	<div class="excerpt">
						            <?php if($post ->post_excerpt != ''){ ?>
						            <p class="subtext">
						                <?php echo ($post ->post_excerpt); ?>
						            </p>
						            <?php } ?>
	                                <?php 

						                //-------------------------
						                if( get_post_format( $post -> ID ) == 'video' ){

						                    $video_format = meta::get_meta( $post -> ID , 'format' );
						                ?>
						                <div class="embedded_videos">    
						                    <?php    
						                    if(isset($video_format['video_ids']) && !empty($video_format['video_ids'])){
						                        foreach($video_format["video_ids"] as $videoid)
						                        {
						                            if( isset( $video_format[ 'video_urls' ][ $videoid ] ) ){
						                                $video_url = $video_format[ 'video_urls' ][ $videoid ];
						                                if( post::get_youtube_video_id($video_url) != "0" ){
						                                    echo post::get_embeded_video( post::get_youtube_video_id( $video_url ), "youtube" );
						                                }else if( post::get_vimeo_video_id( $video_url ) != "0" ){
						                                    echo post::get_embeded_video( post::get_vimeo_video_id( $video_url ) , "vimeo" );
						                                }
						                            }
						                            else echo post::get_local_video( urlencode(wp_get_attachment_url($videoid)));
						                        }
						                    }    
						                ?>
						                </div>
						                <?php                                     
						                }

						                if( get_post_format( $post -> ID ) == 'audio' ){
						                    echo do_shortcode( post::get_audio_file( $post -> ID ) );
						                }
						                the_content();
						                
						            ?>
	                            </div>
	                            <?php 
					                if (options::get_value( 'blog_post' , 'post_sharing' ) == 'yes' && meta::logic( $post , 'settings' , 'sharing' )) {
					                    /*Add here social sharing*/ 
					                    get_template_part('social-sharing'); 

					                }
					            ?>
                            </div>
                        </div>
                    </div>
            	</div>

            	<?php
				    if(is_singular()){

				        /*related posts*/
				        get_template_part('related-posts');
				        
				        /*comments*/
				        if( comments_open() ){
				    ?>
				        <div class="row">
				            <div class="cosmo-comments twelve columns">            
				    <?php        
				            if( options::logic( 'general' , 'fb_comments' ) ){
				                ?>
			                    	<h3 id="reply-title">
			                            <span>
			                            <?php 
			                                $comments_label = sprintf(__('Leave a comment','cosmotheme'));
			                                echo $comments_label;
			                            ?>
			                            </span>
			                        </h3>    
				                    
				                    <fb:comments href="<?php the_permalink(); ?>" num_posts="5" width="430" height="120" reverse="true"></fb:comments>
				                    
				                <?php
				            }else{
				                comments_template( '', true );
				            }
				    ?>   
				            </div>     
				        </div>         
				    <?php    
				        }
				    }
				    
				?>
        	</article>
        	
    </div>
</div>