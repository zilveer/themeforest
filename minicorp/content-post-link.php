<div class="grid12 blog-post">
    <?php if ( !is_single() ) : ?>
        <div class="lined-section-only"><span></span></div>

        <a href="<?php the_permalink(); ?>">
            <h3 class="color1"><?php the_title(); ?></h3>
        </a>
    <?php else : ?>
        <div class="space"></div>
    <?php endif; ?>

    <div class="blog-post-details">
        <span class="icon-calendar"><?php _e( 'on' , 'ishyoboy' ); ?> <?php the_time( get_option( 'date_format' ) ); ?></span>
        <?php
        /* <span class="icon-pencil-1">by <?php the_author(); ?></span> */
        ?>
        <?php if ( has_category() ) : ?>
            <span class="icon-folder"><?php the_category(', '); ?></span>
        <?php endif; ?>
        <?php if ( has_tag() ) : ?>
            <span class="icon-tags"><?php _e( 'and' , 'ishyoboy' ); ?> <?php the_tags(null, ', '); ?></span>
        <?php endif; ?>
        <span class="icon-chat-1"><?php _e( 'with' , 'ishyoboy' ); ?> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( __('0 comments', 'ishyoboy'), __('1 comment', 'ishyoboy'), __('% comments', 'ishyoboy') ); ?></a></span>
    </div>

    <a href="<?php echo esc_attr( ishyoboy_get_post_format_url() ); ?>" target="_blank" class="ish-button-big color3 pt-link">
        <?php the_content(); ?>
    </a>

    <?php if ( ( !is_archive() || !is_search() ) && is_single() ) : ?>
    <?php ishyoboy_show_addthis(); ?>
        <?php ishyoboy_blogpost_prev_next(); ?>
    <?php endif; ?>

    <?php if ( ( !is_archive() || !is_search() ) && is_single() ) : ?>
    <?php comments_template('', true); ?>
    <?php endif; ?>

</div>