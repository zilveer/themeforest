<?php while(have_posts()) : the_post(); ?>
    <!-- Blog Gallery -->
    <div class="blog-item">
    <?php 
        $format = get_post_format();
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'awe-post-thumb',false );
        switch ($format) {
            case 'gallery':
                $gallery = get_post_meta($post->ID,'gallery',true);
                if($gallery && is_array($gallery)):
                ?>
                <div class="blog-list-img">
                    <div id="owl-blog-list">
                        <?php 
                            foreach ($gallery as $value) {
                            echo '<div class="item">';
                            echo '<img src="'.$value.'" alt="gallery post">';
                            echo '</div>';
                            }
                        ?>
                    </div>
                </div>
                <?php endif;?>
                <div class="blog-title">
                    <span class="fa fa-photo"></span>
                <?php
                break;
            case 'image':
                ?>
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
                    <div class="blog-list-img">
                        <?php echo $img_html;?>
                    </div>
                <?php endif;?>
                <div class="blog-title">
                    <span class="fa fa-picture-o"></span>
                <?php
                break;
            case 'video':
                ?>
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
                <?php
                break;
            case 'audio': ?>
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
                <?php
                break;
            case 'link': ?>
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
                <?php
                break;
            case 'quote': ?>
                <?php
                $quote = get_post_meta(get_the_ID(),'quote',true);
                if(!empty($quote['text'])):
                ?>
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
                <?php
                break;
            default: ?>
                <?php if(!empty($thumb[0])):?>
                <div class="blog-list-img">
                    <img src="<?php echo $thumb[0] ?>" alt="<?php the_title(); ?>">
                </div>
                <?php endif;?>
                <div class="blog-title">
                    <span class="fa fa-link"></span>
                <?php
                break;
        }
    ?>
        
            <h1 title="<?php the_title(); ?>"><?php the_title(); ?></h1>
        <?php if(display_meta_box()) : ?>
            <ul>
                <li>
                    <?php echo get_the_date(); ?>
                </li>
                <li>
                    <?php $author = get_the_author(); _e('by',LANGUAGE); echo ' <a href="'.get_author_posts_url($post->post_author).'">'.$author.'</a>';
                    ?>
                </li>
                <li>
                    <?php comments_number( __('No comment',LANGUAGE), __('1 comment',LANGUAGE), __('% comments',LANGUAGE) ); ?>
                </li>
            </ul>
        <?php endif; ?>
        </div>
        <div class="blog-descript">
            <?php do_action('awe_post_content'); ?>

            <?php edit_post_link( __( 'Edit', LANGUAGE ), '<span class="edit-link">', '</span>' ); ?>
        </div>
    </div>
    <!-- End Blog Gallery -->

    <!-- Blog Comment -->
        <?php display_comment_box();?>
        <?php paginate_comments_links() ?>
<!-- End Blog Left -->
<?php endwhile; wp_reset_query(); ?>