<?php
/*
  Template Name: Clients 
 */

global $mango_settings, $mango_layout_columns, $post;
$mango_layout_columns = mango_page_columns ();
$mango_class_name = mango_class_name ();
$clients_template = true;
get_header ();

$args = array ( 'posts_per_page' => '-1', 'post_type' => 'clients' );
$wp_query = new WP_Query( $args );
$containerClass = mango_main_container_class();

?>
    <div class="<?php echo esc_attr($containerClass); ?>">
        <div class="row">
            <div class="<?php echo esc_attr($mango_class_name); ?>">
                <div class="row clients-row">
                    <div id="portfolio-item-container" class="max-col-4 popup-gallery" data-layoutmode="fitRows"
                         style="position: relative; height: 615px;">
                        <?php if($wp_query->have_posts()){ ?>
                        <?php while ( $wp_query->have_posts () ) {
                            $wp_query->the_post ();
                            $link = get_post_meta ( $post->ID, 'mango_client_url', true ) ? get_post_meta ( $post->ID, 'mango_client_url', true ) : '';
                            ?>
                            <div class="portfolio-item portfolio-simple casual"
                                 style="position: absolute; left: 0px; top: 0px;">
                                <figure>
                                    <?php
                                    if(has_post_thumbnail()) {
                                        $path = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'portfolio-grid' );
                                        //$path = wp_get_attachment_url( get_the_ID(), "full" ) ;
                                    }else{
                                        $path[0] = mango_uri .'/images/dummy-img.jpg';
                                    } ?>
                                    <img src="<?php echo esc_url($path[0]); ?>" alt="<?php the_title(); ?>">
                                </figure>
                                <div class="portfolio-meta">
                                    <div class="portfolio-content">
                                        <h2 class="portfolio-title">
                                            <a href="<?php echo the_permalink (); ?>"><?php the_title (); ?></a></h2>
                                        <!-- End .portfolio-tags -->
                                        <a href="<?php echo esc_url($path[0]) ?>" class="portfolio-btn zoom-item"
                                           title="<?php the_title (); ?>">
                                            <i class="fa fa-search"></i>
                                        </a>
                                        <?php if ( $link ) { ?>
                                            <a href="<?php echo esc_url($link); ?>" class="portfolio-btn"><i class="fa fa-link"></i></a>

                                        <?php } ?> 
                                    </div>
                                    <!-- End .portfolio-content -->
                                </div>
                                <!-- End .portfolio-meta -->
                            </div><!-- End .portfolio-item -->
                        <?php }  }else{
                        get_template_part("content","none");
                         } ?>
						 <?php wp_reset_postdata(); ?>
                    </div>
                    <!-- End #portfolio-item-container -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .col-md-12 -->
            <?php get_sidebar () ?>
        </div>
    </div>
<?php
get_footer ();

?>