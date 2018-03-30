<?php

	cs_slider_gallery_template_redirect();

	global $cs_node,$cs_theme_option,$cs_counter_node,$cs_video_width;

	$cs_node = new stdClass();

  	get_header();
 
	$cs_layout = '';

	$post_xml = get_post_meta($post->ID, "post", true);	

	if ( $post_xml <> "" ) {

		$cs_xmlObject = new SimpleXMLElement($post_xml);

		$cs_layout = $cs_xmlObject->sidebar_layout->cs_layout;

 		$cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;

		$cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;

		if ( $cs_layout == "left") {

			$cs_layout = "content-right col-md-9";

			$custom_height = 348;

 		}

		else if ( $cs_layout == "right" ) {

			$cs_layout = "content-left col-md-9";

			$custom_height = 348;

 		}

		else {

			$cs_layout = "col-md-12";

			$custom_height = 470;

		}

 	}else{

		$cs_layout = "col-md-12";

	}

	if (have_posts()):

		while (have_posts()) : the_post();

			$image_id = get_post_thumbnail_id($post->ID);

			$post_xml = get_post_meta($post->ID, "post", true);	

			if ( $post_xml <> "" ) {

				$cs_xmlObject = new SimpleXMLElement($post_xml);

				$post_view = $cs_xmlObject->inside_post_thumb_view;

 				$post_video = $cs_xmlObject->inside_post_thumb_video;

				$post_audio = $cs_xmlObject->inside_post_thumb_audio;

				$post_slider = $cs_xmlObject->inside_post_thumb_slider;

 				$post_featured_image = $cs_xmlObject->inside_post_featured_image_as_thumbnail;
				$post_author_box = $cs_xmlObject->post_author_box;

				$width = 984;

				$height = 470;

				$image_url = cs_get_post_img_src($post->ID, $width, $height);

			}

			else {

				$cs_xmlObject = new stdClass();

				$post_view = '';

 				$post_video = '';

				$post_audio = '';

				$post_slider = '';

				$post_slider_type = '';

				$width = 0;

				$height = 0;

				$image_id = 0;

				$cs_xmlObject->post_social_sharing = '';
				$post_author_box = '';

 			}								

			?>

                <!-- Columns Start -->

                <div class="clear"></div>

                <!-- Content Section Start -->

    			<div id="main" role="main">

    			<!-- Container Start -->

					<div class="container">

        			<!-- Row Start -->

                        <div class="row">

                        <!-- Need to add code below in function file to call it on all pages -->

                        <!--Left Sidebar Starts-->

                        <?php if ($cs_layout == 'content-right col-md-9'){ ?>

                            <aside class="sidebar-left col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left) ) : ?><?php endif; ?></aside>

                        <?php } ?>

                        <!--Left Sidebar End-->

                        <!-- Blog Detail Start -->

                        <div class="<?php echo $cs_layout; ?>">

							<!-- Blog Start -->

 							<!-- Blog Post Start -->

                            <div class="newsdetail fullwidth">

                            <article>

                                <?php if(isset($post_view) and $post_view <> ''){ ?>

                                        <!-- Blog Post Thumbnail Start -->

								<?php

                                    if( $post_view == "Slider" and $post_slider <> ''){

                                        echo '<figure class="detail_figure">';
 
                                         cs_flex_slider($width, $height,$post_slider);

                                         echo '</figure>';

                                    }elseif($post_view == "Single Image" && $image_url <> ''){ 

                                    echo '<figure class="detail_figure">';

                                        echo '<a><img src="'.$image_url.'" ></a>

                                        <span class="cuting_border"></span>';

                                        echo '</figure>';

                                      }elseif($post_view == "Video" and $post_video <> '' and $post_view <> ''){
										

                                          echo '<figure class="detail_figure videoWrapper">';

                                         $url = parse_url($post_video);

                                         if($url['host'] == $_SERVER["SERVER_NAME"]){?>

                                            <video class="mejs-wmp" height="100%"   src="<?php echo $post_video ?>"  id="player1" poster="<?php if($post_featured_image == "on"){ echo $image_url; } ?>" controls preload="none"></video>

                                        <?php

                                        }else{
											?>
											<script type="text/javascript">
											 jQuery(document).ready(function($) {
												cs_iframe_videos();
											 });
											</script>
										  <?php
                                              echo wp_oembed_get($post_video,array());

                                        }

                                        echo '</figure>';

                                    }elseif($post_view == "Audio" and $post_view <> ''){

                                        echo '<figure class="detail_figure">';

                                        ?>

                                        <audio style="width:100%;" src="<?php echo $post_audio; ?>" type="audio/mp3" controls></audio>

                                        <?php

                                        echo '</figure>';

                                    }

                                    ?>

                             <?php } ?>

                                
								<div class="post-options">

                                            <ul>

                                                <li> <em class="fa fa-calendar"></em>

                                                    <time><?php echo get_the_date(); ?></time>

                                                    </li>

                                                <li>

                                                <?php 

													/* translators: used between list items, there is a space after the comma */

													$before_cat = "";

													$categories_list = get_the_term_list ( get_the_id(), 'category', $before_cat, ', ', '</li>' );

													if ( $categories_list ){

														printf( __( '%1$s', 'AidReform'),$categories_list );

													} // End if categories 

												?>

                                                <li><?php cs_like_counter($post->ID);?></li>

                                            </ul>

                                        </div>	
                                <div class="text-group fullwidth <?php if($post_author_box == 'on'){ echo 'cs-boxon'; } ?> " >
									<?php if($post_author_box == 'on'){?>
                                	<div class="side-post desc-area-box">

                                         

                                             <figure> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('PixFill_author_bio_avatar_size', 84)); ?></a> 



                                            </figure>

                                            <div class="author-social-icon">

                                                <ul>

                                                	<?php if(get_the_author_meta('twitter')){ ?>

                                                    <li><a href="http://twitter.com/<?php the_author_meta('twitter'); ?>" target="_blank"><em class="fa fa-twitter"></em></a></li>

                                                    <?php 

													} 

													if(get_the_author_meta('email')){

													?>

                                                    <li><a href="mailto:<?php the_author_meta('email'); ?>"><em class="fa fa-inbox"></em></a></li>

                                                    <?php 

													} 

													if(get_the_author_meta('url')){

													?>

                                                    <li><a href="<?php the_author_meta('url'); ?>"><em class="fa fa-external-link"></em></a></li>

                                                    <?php 

													} 

													?>

                                                </ul>

                                            </div>

                                         

                                            <div class="event-desc">

                                            <ul> 

                                           <li> <h4><?php echo get_the_author(); ?></h4>

                                            <p><?php the_author_meta('description'); ?></p></li> 

                                            <?php 

												/* translators: used between list items, there is a space after the comma */

												$before_cat = " <li><em class='fa fa-tags'></em><span>";

												$categories_list = get_the_term_list ( get_the_id(), 'post_tag', $before_cat, ', ', '</span></li>' );

												if ( $categories_list ){

													printf( __( '%1$s', 'AidReform'),$categories_list );

												} // End if categories 

											?>

                                            </ul>

                                            </div>

                                    </div>
										<?php } ?>			
                                    <div class="text-inner">

                                        
 
                                        <div class="detail_text rich_editor_text">
                                           <p>  &nbsp;&nbsp;&nbsp;<?php the_content();

													 wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'AidReform' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );

											  ?></p>

                                        </div>

                                    </div>

                                    

                                </div>

                            </article>

                            

                            

                           <div class="share-post fullwidth">

								<?php

                                if ($cs_xmlObject->post_social_sharing == "on"){

                                    cs_social_share();

                                } 

                                cs_next_prev_post(); 

                            ?>

                            </div>

                            <?php comments_template('', true); ?>

                     <!-- Blog Post End -->

                     </div>

               	</div>

		  		<?php endwhile;   endif;?>

                <!--Content Area End-->

                <!--Right Sidebar Starts-->

                <?php if ( $cs_layout  == 'content-left col-md-9'){ ?>

                	<aside class="sidebar-right col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right) ) : ?><?php endif; ?></aside>

                <?php } ?>

<!-- Columns End -->

<!--Footer-->

<?php get_footer(); ?>

