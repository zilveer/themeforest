<?php
global $post, $wp_query, $jaw_data;
$terms = get_the_category();




?>
<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-4', 'content-middle','format-standart')); ?>   >
    <div class="box ">
        <div class="image">
            <?php

            switch(jwOpt::get_option('std_post_image_clickable', '0')){
                case '1':  echo '<a href="' . get_permalink() . '"  title="' . jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60)) . '">';
                    break;
                case '2':  echo '<a href="' . jwUtils::get_thumbnail_link() . '"  rel="prettyPhoto[posts-'.jaw_template_get_counter('pagination').']" title="' . jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60)) . '">';
                    break;      
            }

            jwUtils::the_post_thumbnail('post-size-middle');
            
            if (jwOpt::get_option('std_post_image_clickable', '0') != '0') {
                echo '</a>';
            }
            ?>
        </div>
        <div class="content-box">
            <header>
                <h2><a href="<?php the_permalink(); ?>" class="post_name"><?php echo jwUtils::crop_length(get_the_title(), jaw_template_get_var('letter_excerpt_title', 60)); ?></a></h2>
            </header>    
            <p> 
                <?php
                echo jwUtils::crop_length(jwRender::get_the_excerpt(), jaw_template_get_var('letter_excerpt', 300));
                ?>
            </p>
            <div class="blog-meta-info">
                <?php if (jaw_template_get_var('blog_metadate', '1') == '1') { ?>
                    <div class="date">
                        <span>
                            <?php echo get_the_time(jwOpt::get_option('element_blog_dateformat', 'M j, Y')); ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if (jaw_template_get_var('blog_ratings', '1') == '1') { ?>
                <div class="rating">
                    <?php echo jwRender::metaRating(); ?>  <!-- RATING -->
                    <div class="clear"></div>
                </div>
                <?php } ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</article>

