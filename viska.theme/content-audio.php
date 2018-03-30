<!-- Blog Audio -->
<div class="blog-item">

    <div class="blog-audio">
        <?php
        $audio=get_post_meta(get_the_ID(),'audio',true);
        global $is_load_sc;

        ?>
        <?php if(isset($audio['link']) && !empty($audio['link'])):?>
            <?php
            if(preg_match("/\/sets\//i",$audio['link']) || preg_match("/\/sets\//i",$audio['link']))
                $maxheight = "450px";
            else $maxheight = "166px";
            ?>
            <?php if(!$is_load_sc) echo'<script src="//connect.soundcloud.com/sdk.js"></script>';$is_load_sc=true;?>
            <div id="audio-play-<?php echo get_the_ID();?>"></div>
            <script type="text/JavaScript">
                SC.oEmbed("<?php echo $audio['link'];?>", {color: "ff0066",auto_play: <?php echo $audio['auto_play'];?>,maxheight:"<?php echo $maxheight;?>"},  document.getElementById("audio-play-<?php echo get_the_ID();?>"));
            </script>
        <?php endif;?>
    </div>
    <div class="blog-title">
        <span class="fa fa-music"></span>
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
<!-- End Blog Audio -->
