<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 
?>
    <?php if($title) { ?>
        <div class="panel_title">
            <div>
                <h4>
                    <?php if($link) { ?>
                        <a href="<?php echo esc_url($link);?>">
                    <?php } ?>
                        <?php echo esc_html__($title);?>
                    <?php if($link) { ?>
                        </a>
                    <?php } ?>
                </h4>
            </div>
        </div>
    <?php } ?>
    <div class="list_posts_1">
        <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <?php 
                $DF_builder->set_double($my_query->post->ID);

                //categories
                $categories = get_the_category($my_query->post->ID);
                $catCount = count($categories);
                //select a random category id
                $id = rand(0,$catCount-1);
                if(isset($categories[$id]->term_id)) {
                    $titleColor = df_title_color($categories[$id]->term_id, "category", false); 
                } else {
                    $titleColor = df_get_option(THEME_NAME."_pageColorScheme");
                }
            ?>
            <!-- Post item -->
            <div class="item clearfix">
                <div class="item_content">
                    <h4>
                        <?php 
                            if(count(get_the_category($my_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $my_query->post->ID)==true) {
                        ?>
                            <a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>">
                                <span class="format" style="background-color: <?php echo esc_attr__($titleColor);?>">
                                    <?php echo esc_html__(get_cat_name($categories[$id]->term_id));?>
                                </span>
                            </a>
                        <?php } ?>
                        <a href="<?php the_permalink();?>">
                            <?php the_title();?>
                        </a>
                    </h4>
                    <?php 
                        add_filter('excerpt_length', 'df_new_excerpt_length_10');
                        the_excerpt();
                        remove_filter('excerpt_length', 'df_new_excerpt_length_10');
                    ?>
                    <div class="item_meta clearfix">
                        <?php if(df_option_compare('postDate','postDate',$my_query->post->ID)==true) { ?>
                            <span class="meta_date">
                                <a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>">
                                    <?php the_time(get_option('date_format'));?>
                                </a>
                            </span>
                        <?php } ?>
                        <?php if(df_option_compare("postComments","postComments", $my_query->post->ID)==true && comments_open()) { ?>
                            <span class="meta_comments">
                                <a href="<?php the_permalink();?>#comment">
                                    <?php comments_number('0','1','%'); ?>
                                </a>
                            </span>
                        <?php } ?>
                        <?php if(df_option_compare('showLikes','showLikes',$my_query->post->ID)==true) { ?>
                            <span class="meta_likes">
                                <a href="<?php the_permalink();?>"><?php echo intval(get_post_meta( $my_query->post->ID, "_".THEME_NAME."_total_votes", true ));?></a>
                            </span>
                        <?php } ?>
                    </div>
                </div>
            </div><!-- End Post item -->
        <?php endwhile; endif; ?>
    </div>