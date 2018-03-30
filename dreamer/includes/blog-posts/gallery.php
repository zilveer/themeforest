<?php global $smof_data; ?>

<?php if(!is_singular()) : ?>
<div class="blog-format format-posts single-post <?php if (is_sticky()) { echo 'sticky'; } ?> ">
	<h3 class="news-blog-title format-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <div class="twelve columns news-item mobile-two">
        <div class="orbit-gallery">
        <?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
        if ( $images ) {
        foreach ( $images as $attachment_id => $attachment ) {
            echo wp_get_attachment_image( $attachment_id, 'format-large' );
        }
        } ?>
        </div>
        <section style="height: auto; background-color: transparent;" class="news-details">
            <div class="one columns dateFormat">
                <span class="day"><?php the_time('d'); ?></span>
                <span class="month"><?php the_time('M'); ?></span>
            </div>
            <div class="eleven columns">
                <div class="tag-section">
                    <p><?php the_tags(); ?></p>
                    <span>Categories: </span> <?php wp_list_categories('orderby=name&number=5&title_li='); ?>
                </div>
                <p class="news-content"><?php $trimcontent = get_the_content(); $shortcontent = wp_trim_words( $trimcontent, $num_words = 55, $more = '...' ); echo $shortcontent;  ?></p>
                <a class="blog-format-reveal" href="<?php the_permalink(); ?>">Read More</a>
            </div>
        </section>
    </div>
</div>

<?php else :?>

<div class="blog-format format-posts">
	<div <?php post_class(); ?>>
    <h3 class="news-blog-title format-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <div class="twelve columns news-item paragraph-section item-news mobile-two">
        <div class="orbit-gallery">
            <?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
            if ( $images ) {
            foreach ( $images as $attachment_id => $attachment ) {
                echo wp_get_attachment_image( $attachment_id, 'format-large' );
            }
            } ?>
        </div>
        <section style="height: auto; background-color: transparent;" class="news-details">
            <div class="one columns dateFormat">
                <span class="day"><?php the_time('d'); ?></span>
                <span class="month"><?php the_time('M'); ?></span>
            </div>
            <div class="eleven columns">
                <div class="tag-section">
                    <p><?php the_tags(); ?></p>
                    <span>Categories: </span> <?php wp_list_categories('orderby=name&number=5&title_li='); ?>
                </div>
                <div class="twelve columns padding-left">
                    <p class="news-content"><?php the_content(); ?></p>
                </div>
            </div>
        </section>
    </div>
    <div class="single-project-share-buttons single-buttons-share">
        <div class="twelve columns">
            <div class="facebook-share-button">
                <div class="facebook-share-button-over">Like It Now</div>
                <div class="facebook-share-button-inner">
                    <iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
                </div>
            </div>
            <div class="twitter-tweet-button">
                <div class="twitter-tweet-button-over">Tweet It</div>
                <div class="twitter-tweet-button-inner">
                	<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-via="<?php global $smof_data; $dreamer_twitter_user_one = $smof_data['twitter_user_one']; echo $dreamer_twitter_user_one ?>" data-related="<?php global $smof_data; $dreamer_twitter_user_one = $smof_data['twitter_user_one']; echo $dreamer_twitter_user_one ?>">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
            </div>
            <div class="linkedin-share-button">
                <div class="linkedin-share-button-over">Share It</div>
                <div class="linkedin-share-button-inner">
                    <script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php the_permalink(); ?>" data-counter="right"></script>
                </div>
            </div>
        </div>
    </div>
	<?php if (comments_open()){ ?>
    <?php disqus_embed('dreameravathemes'); ?>
    <?php } ?>
    </div>
</div>
<?php endif; ?>