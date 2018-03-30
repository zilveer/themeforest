<?php

$comments_link = SimpleUtils::getCommentsLink(get_the_ID(), $bSettings);

?>

<div class="blog_row blog_row_no_thumb">
    <div class="content">
        <h1><?php the_title() ?></h1>
        <ul class="post_info">
            <li class="date"><?php the_time('M jS, Y H:i')?></li>
            <li class="commens"><?php echo $comments_link ?></li>
            <li class="author"><?php _e('Posted by', $bSettings->getPrefix()) ?> <?php the_author(); ?></li>
        </ul>
        

        <p style="padding-top: 15px;"><?php echo get_the_excerpt() ?></p>
        <a href="<?php echo get_permalink () ?>"onclick='$.parent.colorbox({href:"<?php echo get_permalink () ?>"}); return false;' class="readmore"><?php echo __('read more', $bSettings->getPrefix()) ?></a>
    </div>
</div>	