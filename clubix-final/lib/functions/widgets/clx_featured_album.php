<?php

/**
 * Next Event Widget
 */
class Clx_Featured_Album_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'clx_featured_album_widget', // Base ID
            __('Clubix Featured Album', LANGUAGE_ZONE), // Name
            array( 'description' => __( 'Adds a widget with an featured album info.', LANGUAGE_ZONE ), )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $album_id = isset( $instance['clx_feat_album'] ) ? $instance['clx_feat_album'] : '';

        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        // Create a query loop and display only the first event from the ids array
        $query = new WP_Query(array('post_type'=>AlbumPostType::get_instance()->postType, 'p'=>$album_id));

        if ( $query->have_posts() ) : ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="widget album-widget">

                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                            <?php
                            ?>

                            <figure class="clearfix">

                                <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                    <figcaption>
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog_image_1'); ?></a>
                                    </figcaption>
                                <?php endif; ?>
                                                    
                                <div class="row">
            					
            						<?php
            						$prefix=Haze_Meta_Boxes::get_instance()->prefix;
            						$colspan = 6;
            						?>
            						
            						<?php if( rwmb_meta( "{$prefix}album_field_1_name", array(), get_the_id() ) != '' ) : ?>
            	                        <div class="col-sm-5">
            	                            <?php clx_download_button(get_the_ID()); ?>
            	                        </div>
            	                        
            	                        <?php $colspan = 3; ?>
                                    <?php endif; ?>
            
                                    <div class="col-sm-<?php echo ( 3 == $colspan ? $colspan + 1 : $colspan ); ?>">
                                        <p>
                                            <?php
                                            $release_date = rwmb_meta("{$prefix}album_release_date");
                                            if($release_date != '') :
                                                ?>
                                                <?php _e('Release date', LANGUAGE_ZONE) ?>
                                                <span>
                                                    <?php echo $release_date; ?>
                                                </span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="col-sm-<?php echo $colspan; ?>">
                                        <p>
                                            <?php clx_album_genres(1); ?>
                                        </p>
                                    </div>
                                
                                </div>
                            </figure>

                        <?php endwhile; ?>

            </div></div></div>

        <?php else : ?>

            <?php
            /* Get the none-content template (error) */
            _e('You don\'t have any albums.', LANGUAGE_ZONE);
            ?>

        <?php endif;
        wp_reset_postdata();
        // End The Loop

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     * @param array $instance
     * @return string|void
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'Featured Album', LANGUAGE_ZONE );
        }
        $album_id = isset( $instance['clx_feat_album'] ) ? $instance['clx_feat_album'] : '';

        $albums = get_posts(array('post_type' => AlbumPostType::get_instance()->postType, 'posts_per_page' => 999 ));
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'clx_feat_album' ); ?>"><?php _e( 'Album:' ); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'clx_feat_album' ); ?>" id="<?php echo $this->get_field_id( 'clx_feat_album' ); ?>">

                <?php
                foreach($albums as $album) :
                    ?>

                    <option value="<?= $album->ID; ?>" <?= selected( $album_id, $album->ID, false ); ?>><?= esc_html($album->post_title); ?></option>

                <?php
                endforeach;
                ?>

            </select>
        </p>
    <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['clx_feat_album'] = (int) $new_instance['clx_feat_album'];

        return $instance;
    }

}