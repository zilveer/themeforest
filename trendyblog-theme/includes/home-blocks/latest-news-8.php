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
   <div class="layout_post_3">
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
                <div class="col<?php if($columnID == "column4") { ?> col_12_of_12<?php } else if($columnID == "column6") { ?> col_12_of_12<?php } else { ?> col_6_of_12<?php } ?>">
                    <div class="item_thumb">
                        <div class="thumb_hover">
                            <a href="<?php the_permalink();?>">
                                <?php echo df_image_html($my_query->post->ID,555,555);?>
                            </a>
                        </div>
                        <div class="inner_content">
                            <?php 
                                if(count(get_the_category($my_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $my_query->post->ID)==true) {
                            ?>
                                <div class="thumb_meta">
                                    <span class="category" style="background-color: <?php echo esc_attr__($titleColor);?>">
                                        <a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>" style="background-color: <?php echo esc_attr__($titleColor);?>">
                                             <?php echo esc_html__(get_cat_name($categories[$id]->term_id));?>
                                        </a>
                                    </span>
                                </div>
                            <?php } ?>

                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        </div>
                    </div>
                </div>

                <?php 
                if($columnID=="column6") {
                    $a = 1;
                } else {
                    $a = 2;
                }
                if($counter%$a==0 && $counter!=$my_query->post_count) { ?>
                </div>
                <div class="row">
                <?php } ?>
        <?php $counter++; ?>
            <?php endwhile; endif; ?>
        </div>
    </div>
