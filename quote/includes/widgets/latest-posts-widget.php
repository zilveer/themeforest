<?php 
class DistinctiveThemes_Recent_Posts_Widget extends WP_Widget {
    function DistinctiveThemes_Recent_Posts_Widget() { 
        parent::WP_Widget(false, $name = 'DistinctiveThemes Recent Posts Widget'); 
    }

    function form($instance) {  
        $title = isset( $instance['title'] ) ? esc_attr($instance['title'])  : '';
        $dis_posts = isset( $instance['dis_posts'] ) ? esc_attr($instance['dis_posts'])  : ''; ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'quote' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('dis_posts'); ?>"><?php _e('Number of Posts Displayed (Required):', 'quote' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('dis_posts'); ?>" name="<?php echo $this->get_field_name('dis_posts'); ?>" type="text" value="<?php echo $dis_posts; ?>" /></label></p>
        <?php } 

    function widget($args, $instance) { 
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $dis_posts = $instance['dis_posts']; ?>
        <?php echo $before_widget; ?>
        <?php if ( $title )
        echo $before_title . $title . $after_title; ?>

        <div class="dt-recent-posts">
            <?php global $post;
            $args = array( 'numberposts' => $dis_posts);
            $myposts = get_posts( $args );
            foreach( $myposts as $post ) : setup_postdata($post); ?>
            <div class="dt-recent-post clearfix">
                <div class="pull-left dt-recent-img">
                    <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" class="recentthumbs"><?php if ( has_post_thumbnail() ) {
                    $thumb = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_url( $thumb,'full' );
                    $image = aq_resize( $img_url, 80, 80, true ); ?> 
                    <img src="<?php if($image) { echo $image; } else { ?>http://placehold.it/80x80<?php } ?>" alt="<?php the_title(); ?>">
                    <?php } else { ?>
                    <img src="http://placehold.it/80x80" /><?php } ?></a>
                 </div>
                 <div class="recentex eightcol last">
                    <h3 class="portfolio-widget-title"><a href="<?php $link = the_permalink(); echo esc_url($link); ?>"><?php $title = the_title(); echo esc_attr($title); ?></a></h3>
                    <span class="clearme"><i class="fa fa-user meta-icon"></i>By <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( __( '%s', 'quote' ), get_the_author() ); ?></a></span><br/>
                    <span class="clearme"><i class="fa fa-clock-o meta-icon"></i><?php the_time(get_option('date_format')); ?></span>
                </div>  
                <div style="clear:both;"></div>
            </div>        
        <?php endforeach; wp_reset_postdata() ?>
        </div>
        <?php echo $after_widget; ?>

<?php }} ?>
<?php add_action('widgets_init', create_function('', 'return register_widget("DistinctiveThemes_Recent_Posts_Widget");')); ?>