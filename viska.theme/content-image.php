<!-- Blog Image -->

<div class="blog-item">
    <?php
    $gallery=get_post_meta(get_the_ID(),'gallery',true);
    $img_html =false;
    if($gallery && is_array($gallery))
        $img_html .= '<a href="'.get_the_permalink().'"><img alt="'.get_the_title().'" src="'.$gallery[0].'"></a>';
    if(!$img_html){
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'awe-post-thumb',false );
        if(!empty($thumb[0]))
        {
            $img_html .= '<a href="'.get_the_permalink().'"><img alt="'.get_the_title().'" src="'.$thumb[0].'"></a>';
        }
    }
    if($img_html):?>
    <div class="blog-image">
        <?php echo $img_html;?>
    </div>
    <?php endif;?>


    <div class="blog-title">
        <span class="fa fa-photo"></span>
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
<!-- End Blog Image -->