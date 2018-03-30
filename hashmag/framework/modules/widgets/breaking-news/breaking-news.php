<?php

/**
 * Widget that adds breaking news shortcode
 *
 * Class Breaking_News
 */
class HashmagMikadoBreakingNews extends HashmagMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkdf_breaking_news', // Base ID
            'Mikado Breaking News' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'textfield',
                'title' => 'Number of Posts',
                'name' => 'number_of_posts',
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Order By',
                'name' => 'order_by',
                'options' => array(
                    'Title' => 'title',
                    'Date' => 'date',
                    'Author' => 'author',
                    'Random' => 'rand'
                ),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Order',
                'name' => 'order',
                'options' => array(
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ),
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Category Slug',
                'name' => 'category_slug',
                'description' => 'Leave empty for all or use comma for list'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Author ID',
                'name' => 'author_id',
                'description' => 'Leave empty for all or use comma for list'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Tag Slug',
                'name' => 'tag_slug',
                'description' => 'Leave empty for all or use comma for list'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Include Posts',
                'name' => 'post_in',
                'description' => 'Enter the IDs of the posts you want to display'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Exclude Posts',
                'name' => 'post_not_in',
                'description' => 'Enter the IDs of the posts you want to exclude'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Slideshow Speed',
                'name' => 'slideshowspeed',
                'description' => 'Set the speed of the slideshow cycling, in milliseconds. Default value is 4000.'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Slide Animation Speed',
                'name' => 'animationspeed',
                'description' => 'Set the speed of animations, in milliseconds. Default value is 400.'
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        $queryArray = array();

        if(!empty($instance['number_of_posts']) && $instance['number_of_posts'] !== '') {
            $queryArray['posts_per_page'] = $instance['number_of_posts'];
        }
        
        if(!empty($instance['order_by']) && $instance['order_by'] !== '') {    
            $queryArray['orderby'] = $instance['order_by'];
        }
        
        if(!empty($instance['order']) && $instance['order'] !== '') {   
            $queryArray['order'] = $instance['order'];
        }   

        if(!empty($instance['category_slug']) && $instance['category_slug'] !== '') {
            $queryArray['category_name'] = $instance['category_slug'];
        }

        if(!empty($instance['author_id']) && $instance['author_id'] !== '') {           
            $queryArray['author'] = $instance['author_id'];
        }

        if(!empty($instance['tag_slug']) && $instance['tag_slug'] !== '') {
            $queryArray['tag'] = str_replace(' ', '-', $instance['tag_slug']);
        }

        if(!empty($instance['post_in']) && $instance['post_in'] !== '') {
            $queryArray['post__in'] = explode(",", $instance['post_in']);
        }   

        if(!empty($instance['post_not_in']) && $instance['post_not_in'] !== '') {
            $queryArray['post__not_in'] = $instance['post_not_in'];
        }

        $queryArray['post_status'] = 'publish'; //to ensure that ajax call will not return 'private' posts

        $queryResult = new \WP_Query($queryArray);

        $data = array();

        if(!empty($instance['slideshowspeed']) && $instance['slideshowspeed'] !== '') {
            $data['slideshowspeed'] = $instance['slideshowspeed'];
        }

        if(!empty($instance['animationspeed']) && $instance['animationspeed'] !== '') {
            $data['animationspeed'] = $instance['animationspeed'];
        }

        ?>
        <div class="mkdf-bn-holder" <?php echo hashmag_mikado_get_inline_attrs($data); ?>>
            <?php if($queryResult->have_posts()): ?>
                <div class="mkdf-bn-title"><?php esc_html_e('Trending News', 'hashmag'); ?><span class="mkdf-bn-icon ion-arrow-right-b"></span></div>
                <ul class="mkdf-bn-slide">
                    <?php while ($queryResult->have_posts()) : $queryResult->the_post(); ?>
                        <li class="mkdf-bn-text">
                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(get_the_title()); ?></a>    
                        </li>
                    <?php endwhile; ?> 
                </ul>
            <?php else: ?> 

                <div class="mkdf-bn-messsage">
                    <p><?php esc_html_e('No posts were found.', 'hashmag'); ?></p>
                </div>

            <?php endif;
            wp_reset_postdata();
            ?>
        </div>
    <?php
    }
}