<div class="item-isotope">
<article id="post-<?php the_ID(); ?>" <?php post_class('pluto-post-box'); ?>>
  <?php
  $post_thumbnail_arr = wp_get_attachment_image_src( get_post_thumbnail_id(), "post-thumbnail" );
  if($post_thumbnail_arr) {
    $css_style = "background-image: url(". $post_thumbnail_arr[0] .");";
  }else{
    $css_style = "";
  }
  ?>
  <div class="post-body" style="<?php echo $css_style; ?>">
    <?php if(has_post_thumbnail()): ?>
      <div class="image-fader"></div>
    <?php endif?>
    <div class="quote-content">
      <div class="quote-icon"><i class="os-icon-thin-042_comment_quote_reply"></i></div>
      <h2 class="post-content entry-content"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo os_quote_excerpt(25); ?></a></h2>
      <div class="quote-author">- <?php the_field('quote_author'); ?></div>
    </div>
  </div>
</article>
</div>