    <!-- Portfolio Item -->
            <li <?php post_class('clickable'); ?> id="post-<?php the_ID(); ?>" >
                <a class="grid-item-image">
                    <div class="dynamic-portfolio-holder">
                        <?php
                        $type  = get_post_meta($post->ID, 'pp_pf_type', true);
                        $videothumbtype = ot_get_option('pp_portfolio_videothumb');
                        if($type == 'video' && $videothumbtype == 'video') {
                            $videoembed = get_post_meta($post->ID, 'pp_pfvideo_embed', true);
                            if($videoembed) {
                                echo '<div class="video">'.$videoembed.'</div>';
                            } else {
                                global $wp_embed;
                                $videolink = get_post_meta($post->ID, 'pp_pfvideo_link', true);
                                $post_embed = $wp_embed->run_shortcode('[embed  width="300" height="200"]'.$videolink.'[/embed]') ;
                                echo '<div class="video">'.$post_embed.'</div>';
                            }
                        } else {
                            $thumbbig = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                            if(ot_get_option('portfolio_thumb') == 'lightbox'){
                                the_post_thumbnail("blog-size");
                            } else {
                                the_post_thumbnail("blog-size");
                            }
                        } ?>
                        <div class="hover-cover"></div>
                        <div class="hover-icon"></div>
                        <div class="hover-desc">
                            <h5><?php the_title(); ?></h5>
                            <?php $terms = get_the_terms( $post->ID, 'filters' );
                            if ( $terms && ! is_wp_error( $terms ) ) : echo '<span>';
                            $filters = array();
                            $i = 0;
                            foreach ( $terms as $term ) {
                                $filters[] = $term->name;
                                if ($i++ > 2) break;
                            }
                            $outputfilters = join( ", ", $filters ); echo $outputfilters;
                            echo '</span>';
                            endif; ?>
                        </div>
                    </div>
                </a>
                <div class="og-expander">
                <?php $type  = get_post_meta($post->ID, 'pp_pf_type', true); 
                 if($type == 'video') {
                 $videoembed = get_post_meta($post->ID, 'pp_pfvideo_embed', true);
                            if($videoembed) {
                                echo '<div class="video gridslider">'.$videoembed.'</div>';
                            } else {
                                global $wp_embed;
                                $videolink = get_post_meta($post->ID, 'pp_pfvideo_link', true);
                                $post_embed = $wp_embed->run_shortcode('[embed  width="300" height="200"]'.$videolink.'[/embed]') ;
                                echo '<div class="video gridslider">'.$post_embed.'</div>';
                            }
                 } else { ?>
                    <div class="flexslider gridslider">
                        <ul class="slides">
                            <?php
                            $ids = get_post_meta($post->ID, 'pp_gallery_slider', TRUE);
                            $args = array(
                                'post_type' => 'attachment',
                                'post_status' => 'inherit',
                                'post_mime_type' => 'image',
                                'post__in' => explode( ",", $ids),
                                'posts_per_page' => '-1',
                                'orderby' => 'post__in'
                                );
                            $images_array = get_posts( $args );
                            if ( $images_array ) {
                                $slides = count($images_array);
                                foreach( $images_array as $images ) : setup_postdata($images); ?>
                                <!-- 960 Container -->
                                <?php
                                $attachment = wp_get_attachment_image_src($images->ID, 'full');
                                $thumb = wp_get_attachment_image_src($images->ID, 'portfolio-half');
                                ?>
                                <li>
                                    <a href="<?php echo $attachment[0] ?>" class="<?php if($slides > 1){ echo 'mfp-gallery';  } else { echo 'mfp-gallery'; } ?>"  title="<?php echo $images->post_title; ?>" >
                                        <img src="<?php echo $thumb[0] ?>" alt="<?php echo $images->post_title; ?>" />
                                    </a>
                                </li>
                                <?php endforeach;wp_reset_postdata();
                            } //eof if type

                            ?>
                          </ul>
                      </div>
                <?php } ?>
                      <span class="og-close"></span>
                      <div class="og-details">
                        <h3><?php the_title(); ?></h3>
                        <?php the_content(); ?>
                      </div>
                    </div>
                </li>
                <!-- eof Portfolio Item -->