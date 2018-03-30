<div class="blog-item">
    <?php
    $quote=get_post_meta(get_the_ID(),'quote',true);
    if(!empty($quote['text'])):?>
    <div class="blog-quote">
        <blockquote>
        <?php
        echo stripslashes($quote['text']);
        ?>
        </blockquote>
        <?php if(!empty($quote['source'])):?>
            <span><?php echo stripslashes($quote['source']) ?></span>
        <?php endif;?>
    </div>
    <?php endif;?>
    <div class="blog-title">
        <span class="fa fa-quote-right"></span>
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
<!-- End Blog Quote -->