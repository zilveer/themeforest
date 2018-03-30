<?php $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="post">
    <?php if($link_video) { ?>
      <iframe height="170" src="<?php echo esc_url( $link_video ); ?>"></iframe>
    <?php } ?>
    <div class="post_info clearfix">
      <div class="post-left">
        <ul>
          <li><i class="icon-calendar-empty"></i><?php esc_html_e('On','learn'); ?> <span><?php the_time( get_option( 'date_format' ) ); ?></span></li>
          <li><i class="icon-user"></i><?php esc_html_e('By','learn'); ?> <?php the_author_posts_link(); ?></li>
          <?php if(has_tag()) { ?><li><i class="icon-tags"></i><?php esc_html_e('Tags','learn'); ?> <?php the_tags(' '); ?></li><?php } ?>
        </ul>
      </div>
      <div class="post-right"><i class="icon-comment"></i><?php comments_number( '0 '.esc_html__("comment","learn"), '1 '.esc_html__("comment","learn"), '% '.esc_html__("comments","learn") ); ?></div>
    </div>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p><?php echo learn_excerpt(); ?></p>
    <a href="<?php the_permalink(); ?>" class="button_medium"><?php esc_html_e('Read more','learn'); ?></a>
  </div>
</div><!-- end post -->