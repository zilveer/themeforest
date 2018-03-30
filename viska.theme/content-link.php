<div class="blog-item">
    <?php
    $link=get_post_meta(get_the_ID(),'link',true);
    if(!empty($link['url'])):
    ?>
    <div class="blog-link">
            <a href="<?php echo $link['url'];?>" title="<?php echo $link['title'];?>">
            <span class="fa fa-link"></span>
            <?php
                if(isset($link['anchor']) && !empty($link['anchor'])){
                    $anchor = $link['anchor'];
                }elseif(!empty($link['title'])){
                    $anchor = $link['title'];
                }else{
                    $anchor = $link['url'];
                }
            ?>
            <p><?php echo $anchor; ?></p>
            </a>

    </div>
    <?php endif;?>
    <div class="blog-title">
        <span class="fa fa-link"></span>
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
<!-- End Blog Link -->