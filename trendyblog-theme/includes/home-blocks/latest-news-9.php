<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 
    $counter = 1;

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
    <div class="layout_post_4">
        <div class="row">
        <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <?php

                $categories = wp_get_post_categories($my_query->post->ID); 
                $ratingsAverage = df_avarage_rating( $my_query->post->ID); 
                $image = get_post_thumb($my_query->post->ID,1140,592);
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
                <div class="col col_12_of_12">
                    <div class="item_content">

                        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    </div>
                    <div class="item_thumb">
                        <?php if(df_option_compare("showTumbIcon","showTumbIcon", get_the_ID())==true) { ?>
                            <div class="thumb_icon">
                                <a href="<?php the_permalink();?>" style="background-color: <?php echo esc_attr($titleColor);?>">
                                    <?php df_image_icons(get_the_ID());?>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="thumb_hover">
                            <a href="<?php the_permalink();?>">
                                <?php echo df_image_html(get_the_ID(),1140,684);?>
                            </a>
                        </div>
                    </div>
                    <?php 
                        add_filter('excerpt_length', 'df_new_excerpt_length_60');
                        the_excerpt();
                        remove_filter('excerpt_length', 'df_new_excerpt_length_60');
                    ?>
                </div>
        <?php $counter++; ?>
            <?php endwhile; endif; ?>
        </div>
    </div>
