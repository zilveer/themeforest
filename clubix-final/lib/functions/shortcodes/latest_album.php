<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Latest_Album_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_latest_album', array( &$this, 'shortcode' ) );
    }

    public function shortcode( $atts ) {
        $output = $album_id = '';

        extract( shortcode_atts( array(
            'album_id'          => '',
        ), $atts ) );

        // Construct the query
        $args = array(
            'post_type'         => AlbumPostType::get_instance()->postType,
            'post_status'       => 'publish',
            'p'                 => $album_id
        );

        $query = new WP_Query($args);

        if ( $query->have_posts() ) :

            while ( $query->have_posts() ) : $query->the_post();

                remove_filter('zen_get_content_more', 'zen_return_empty_string', 15);

                $prefix = Haze_Meta_Boxes::get_instance()->prefix; ?>

                <div class="ablums-posts-right">

                <article class="clearfix">
                    <div class="left clearfix">

                        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                            <figure class="clearfix">
                                <figcaption>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('blog_image_1'); ?>
                                    </a>
                                </figcaption>
                                <?php clx_tags(); ?>
                            </figure>
                        <?php endif; ?>

                        <div class="content">
                            <h4>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <div class="rating">
                                <?php $rating = rwmb_meta("{$prefix}album_rating"); ?>
                                <div class="full" style="width: <?= $rating; ?>%;">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="empty">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                            </div>
                            <p>
                                <?php zen_the_excerpt(); ?>
                            </p>
                            <?= zen_get_content_more(); ?>
                        </div>
                    </div>
                    <div class="right clearfix">

                        <div class="minimal-player">

                            <!-- Here comes the player -->
                            <?php
                            $ids = rwmb_meta("{$prefix}album_songs", array('type' => 'checkbox_list'));
                            ?>
                            <?php echo clx_simple_song_player($ids); ?>

                        </div>

                    </div>
                </article>
                </div>

            <?php endwhile; ?>

        <?php else : ?>

            <?php
            /* Get the none-content template (error) */
            get_template_part( 'content', 'none' );
            ?>

        <?php endif; ?>
        <?php
        wp_reset_postdata();
        // End The Loop

        return;
    }

}

Clubix_Latest_Album_Shortcode::get_instance();