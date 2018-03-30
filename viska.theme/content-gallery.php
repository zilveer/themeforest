<!-- Blog Gallery -->

<!-- End Blog Gallery -->
<div class="blog-item">
    <?php
    $gallery=get_post_meta(get_the_ID(),'gallery',true);
    $img_html ='';
    if($gallery && is_array($gallery)):
    ?>
    <div class="blog-list-img">
        <div id="owl-blog-list">
        <?php
                foreach ($gallery as $value) {
                    $img_html .= '<div class="item"><img alt="'.get_the_title().'" src="'.$value.'"></div>';
                    //echo $value;
                }
                
            echo $img_html;
        ?>
        </div>
    </div>
    <?php endif;?>
    <div class="blog-title">
        <span class="fa fa-picture-o"></span>
        <h2 title="<?php the_title(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php if(display_meta_box()) : ?>
        <ul>
            <li>
                <?php echo get_the_date(); ?>
            </li>
            <li>
            <?php $author = get_the_author();
            __('by',LANGUAGE); echo ' '.$author;
            ?>
            </li>
            <li>
                <?php comments_number( _e('No comment',LANGUAGE), __('1 comment',LANGUAGE), __('% comments',LANGUAGE) ); ?>
            </li>
        </ul>
    <?php endif; ?>
    </div>
    <div class="blog-descript">
        <?php do_action('awe_post_content'); ?>
    </div>
</div>
