<!-- Blog Video -->
<div class="blog-item">
    <?php
    $videos=get_post_meta(get_the_ID(),'videos',true);
    $video_html = '';
    $video=false;
    if($videos && is_array($videos))
        $video = (array)json_decode($videos[0]);
    if($video):
    ?>
    <div class="blog-video">
        <?php

        if($video['type']=='youtube')
            $video_html .='<iframe src="//www.youtube.com/embed/'.$video['id'].'" frameborder="0" allowfullscreen></iframe>';
        if($video['type']=='vimeo')
            $video_html .='<iframe src="//player.vimeo.com/video/'.$video['id'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        echo $video_html;
        ?>
    </div>
    <?php endif;?>
    <div class="blog-title">
        <span class="fa fa-file-video-o"></span>
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
<!-- End Blog Video -->
