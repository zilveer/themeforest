<?php
/**
 * Your Inspiration Themes
 *
 * @package    WordPress
 * @subpackage Your Inspiration Themes
 * @author     Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


class YIT_Recent_Posts extends WP_Widget {

    function __construct() {

        $widget_ops = array(
            'classname'   => 'yit-recent-posts',
            'description' => __( 'The latest posts, with a preview thumb.', 'yit' )
        );

        $control_ops = array( 'id_base' => 'yit-recent-posts' );

        WP_Widget::__construct( 'yit-recent-posts', __( 'YIT Recent Posts', 'yit' ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );

        /* User-selected settings. */
        if ( ! isset( $instance['title'] ) )
                {
                    $instance['title'] = '';
                }

        $title          = apply_filters( 'widget_title', $instance['title'] );
        $author         = get_the_author_link();
        $items          = isset( $instance['items'] ) ? $instance['items'] : '';
        $more_text      = isset( $instance['more_text'] ) ? $instance['more_text'] : '';
        $show_thumb     = isset( $instance['show_thumb'] ) ? $instance['show_thumb'] : 'yes';
        $excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 10;
        $date           = isset( $instance['date_excerpt'] ) ? $instance['date_excerpt'] : 'no';
        $show_comments  = isset( $instance ['show_comments'] ) ? $instance['show_comments'] : 'no';
        $show_author    = isset( $instance ['show_author'] ) && ! empty( $author ) ? $instance['show_author'] : 'no';
        $show_excerpt   = isset( $instance ['show_excerpt'] ) ? $instance['show_excerpt'] : 'no';

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title;

        $args = array(
            'posts_per_page'      => $items,
            'orderby'             => 'date',
            'ignore_sticky_posts' => 1
        );

        $args['order'] = 'DESC';

        $excluded_cats = yit_get_excluded_categories( 2 );

        if ( ! empty( $excluded_cats ) ) {
            $args['cat'] = $excluded_cats;
        }

        $myposts = new WP_Query( $args );

        $html = "\n";
        $html .= '<div class="recent-post group">' . "\n";

        if ( $myposts->have_posts() ) : while ( $myposts->have_posts() ) : $myposts->the_post();


            $img = '';
            if ( has_post_thumbnail() ) {
                $img = yit_image( "size=blog_section&alt=".get_the_title(), false );
            }

            $html .= '<div class="hentry-post group clearfix">' . "\n";

            if ( $date == "yes" ) {
                $html .= '<p class="post-date">';
                $html .= '<span class="day">' . get_the_time( 'd' ) . '</span>';
                $html .= '<span class="month">' . get_the_time( 'M' ) . '</span>';
                $html .= '</p>';
            }

            if ( $show_thumb == 'yes' && $img != '' ) {
                $html .= '<div class="clearfix text with-thumb">';
                $html .= "<div class=\"thumb-img\">" . $img . "</div>\n";
            }
            else {
                $html .= '<div class="clearfix text without-thumb">';
            }

            if ( strpos( $more_text, "href='#'" ) ) {
                $post_readmore = str_replace( "href='#'", "href='" . get_permalink() . "'", str_replace( '"', "'", do_shortcode( $more_text ) ) );
            }
            else {
                $post_readmore = $more_text;
            }


            $html .= '<div class="post-content">';

            $html .= the_title( '<a href="' . get_permalink() . '" title="' . get_the_title() . '" class="title">', '</a>', false );

            if ( $show_excerpt == 'yes' ) {
                $excerpt = '' . yit_content( 'excerpt', $excerpt_length, $post_readmore ) . '';

                if ( $excerpt != '' ) {
                    $html .= $excerpt;
                }
            }

            if ( $show_author == "yes" ) {
                $html .= '<span class="author">' . __( "by", "yit" ) . ' <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author_link() . ' </a></span>';
            }


            if ( $show_comments == 'yes' ) {
                $separator = $show_author == 'yes' ? ' / ' : '';
                $html .= '<span class="num-comments">' . $separator . ' <a href="' . get_comments_link( get_the_ID() ) . '">' . get_comments_number() . ( get_comments_number() == 1 ? __( ' comment', 'yit' ) : __( ' comments', 'yit' ) ) . '</a></span>';
            }

            $html .= '</div></div>' . "\n";
            $html .= '</div>' . "\n";

        endwhile; endif;

        wp_reset_query();
        $html .= '</div>';

        echo $html;

        add_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 ); //shortcode in more links

        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['show_thumb'] = $new_instance['show_thumb'];

        $instance['items'] = $new_instance['items'];

        $instance['more_text'] = str_replace( '"', "'", $new_instance['more_text'] );

        $instance['excerpt_length'] = $new_instance['excerpt_length'];

        $instance['date_excerpt'] = $new_instance['date_excerpt'];

        $instance['show_comments'] = $new_instance['show_comments'];

        $instance['show_author'] = $new_instance['show_author'];

        $instance['show_excerpt'] = $new_instance['show_excerpt'];

        return $instance;
    }

    function form( $instance ) {
        /* Default settings of widget */
        $defaults = array(
            'title'          => __( 'YIT Recent Posts', 'yit' ),
            'items'          => 3,
            'show_thumb'     => 'no',
            'more_text'      => '|| ' . __( 'Read More', 'yit' ),
            'excerpt_length' => '10',
            'date_excerpt'   => 'no',
            'show_comments'  => 'no',
            'show_author'    => 'yes',
            'show_excerpt'   => 'no',
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Show thumbnail', 'yit' ) ?>:
                <select id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>">
                    <option value="yes" <?php selected( $instance['show_thumb'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['show_thumb'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'items' ); ?>"><?php _e( 'Items', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" value="<?php echo $instance['items']; ?>" size="3" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'date_excerpt' ); ?>"><?php _e( 'Show Post Date', 'yit' ) ?>:
                <select id="<?php echo $this->get_field_id( 'date_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'date_excerpt' ); ?>">
                    <option value="yes" <?php selected( $instance['date_excerpt'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['date_excerpt'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e( 'Show Excerpt', 'yit' ) ?>:
                <select id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>">
                    <option value="yes" <?php selected( $instance['show_excerpt'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['show_excerpt'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e( 'Excerpt Lenght', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $instance['excerpt_length']; ?>" size="3" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'more_text' ); ?>"><?php _e( 'More Text', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'more_text' ); ?>" name="<?php echo $this->get_field_name( 'more_text' ); ?>" value="<?php echo $instance['more_text']; ?>" class="widefat" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'show_comments' ); ?>"><?php _e( 'Show number of comments', 'yit' ) ?>:
                <select id="<?php echo $this->get_field_id( 'show_comments' ); ?>" name="<?php echo $this->get_field_name( 'show_comments' ); ?>">
                    <option value="yes" <?php selected( $instance['show_comments'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['show_comments'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'show_author' ); ?>"><?php _e( 'Show author', 'yit' ) ?>:
                <select id="<?php echo $this->get_field_id( 'show_author' ); ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>">
                    <option value="yes" <?php selected( $instance['show_author'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['show_author'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                </select>
            </label>
        </p>
    <?php
    }
}
