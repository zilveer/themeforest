<?php
if(!class_exists('MET_Blog_List_One')) {
    class MET_Blog_List_One extends AQ_Block {

        function __construct() {
            $block_options = array(
                'name' => 'Blog List Horizontal',
                'size' => 'span12',
            );

            parent::__construct('MET_Blog_List_One', $block_options);
        }

        function form($instance) {

            $defaults = array(
                'item_limit' 			=> '6',
                'excerpt_limit'			=> '10',
                'excerpt_more'			=> '…',
                'widget_title'			=> 'Latest Posts',
                'read_more_text'		=> 'read more',
                'categories'			=> '',
                'ex_categories'			=> ''
            );
            $instance = wp_parse_args($instance, $defaults);
            extract($instance);

            $bool_options = array('false' => 'FALSE' , 'true' => 'TRUE');

            ?>

            <p class="description">
                <label for="<?php echo $this->get_field_id('widget_title') ?>">
                    Title<br/>
                    <?php echo aq_field_input('widget_title', $block_id, $widget_title) ?>
                </label>
            </p>

            <p class="description">
                <label for="<?php echo $this->get_field_id('item_limit') ?>">
                    Item Limit (required)<br/>
                    <?php echo aq_field_input('item_limit', $block_id, $item_limit) ?>
                </label>
            </p>

            <p class="description">
                <label for="<?php echo $this->get_field_id('excerpt_limit') ?>">
                    Excerpt Word Limit<br/>
                    <?php echo aq_field_input('excerpt_limit', $block_id, $excerpt_limit) ?>
                </label>
            </p>

            <p class="description">
                <label for="<?php echo $this->get_field_id('excerpt_more') ?>">
                    Excerpt More Text<br/>
                    <?php echo aq_field_input('excerpt_more', $block_id, $excerpt_more) ?>
                </label>
            </p>

            <p class="description">
                <label for="<?php echo $this->get_field_id('read_more_text') ?>">
                    Read More Text<br/>
                    <?php echo aq_field_input('read_more_text', $block_id, $read_more_text) ?>
                </label>
            </p>

            <p class="description">
                <label for="<?php echo $this->get_field_id('categories') ?>">
                    Category IDs (Ex: 1,2,3)<br/>
                    <?php echo aq_field_input('categories', $block_id, $categories) ?>
                </label>
            </p>

            <p class="description">
                <label for="<?php echo $this->get_field_id('ex_categories') ?>">
                    Exclude Category IDs (Ex: 1,2,3)<br/>
                    <?php echo aq_field_input('ex_categories', $block_id, $ex_categories) ?>
                </label>
            </p>

        <?php

        }

        function block($instance) {
            extract($instance);
            if(empty($item_limit)){
                $item_limit = 6;
            }

            $widgetID = uniqid('met_blog_list_');

            $query_filter = array();
            $query_filter['posts_per_page'] = $item_limit;

            if(!empty($categories)){
                $query_filter['category__and'] = array($categories);
            }

            if(!empty($ex_categories)){
                $category_IDs = explode(',',$ex_categories);
                $ex_category_list = '';
                foreach($category_IDs as $category_ID){
                    $ex_category_list .= '-'.$category_ID.',';
                }
                $ex_category_list = substr($ex_category_list,0,-1);

                $query_filter['cat'] = $ex_category_list;
            }
            ?>

            <div class="row-fluid">
                <?php query_posts($query_filter); ?>
                <?php $i = 0; ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php
                    $post_date = get_the_date('d-F');
                    $post_date = explode('-',$post_date);
                    $post_day = $post_date[0];
                    $post_month = $post_date[1];
                    ?>
                    <div class="span2">
                        <div class="met_dated_blog_posts">
                            <span class="met_date"><?php echo $post_day ?></span>
                            <span class="met_month"><?php echo $post_month ?></span>
                            <article>
                                <h3><?php the_title() ?></h3>
                                <p><?php echo wp_trim_words( get_the_excerpt(),  $excerpt_limit, $excerpt_more ); ?></p>
                                <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="met_read_more met_color"><?php echo $read_more_text ?></a>
                            </article>
                        </div>
                    </div>
                    <?php $i++; if($i % 6 == 0): ?>
                        <div style="width: 100%; height: 1px; float: left;"></div>
                    <?php endif; ?>
                <?php endwhile; endif; ?>
            </div>

            <?php
            wp_reset_query();
        }

    }
}