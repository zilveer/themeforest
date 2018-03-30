
<?php 

  $nopad = false;
  if (a_media_content_is_empty()) {
    if ( $pid = get_post_thumbnail_id() )
      echo do_shortcode("[gallery slider=0 ids={$pid}]");
    else
      $nopad = true;
  } else a_the_media_content();

?>

<div class="main wrap group post<?php if (is_sticky()) echo ' sticky' ?><?php if ($nopad && is_single()) echo ' nopad' ?>">

  <div class="headings">
    <h1>
    <?php if ( !is_single() ) : ?>
      <a href="<?php the_permalink() ?>" class="permalink"><?php the_title() ?></a>
    <?php else : ?>
      <?php the_title() ?>
    <?php endif; ?>
    </h1>
    <h4>
    <?php _e('Written By', A_DOMAIN) ?>
    <?php the_author_posts_link() ?>,
    <?php printf(__( '%s ago', A_DOMAIN ), human_time_diff (get_the_time('U'), current_time('timestamp'))) ?>
    </h4>
  </div>
  <!-- /headings-->
  
  <div class="clear"></div>
  
  <div class="one-fourth mobile-centred">
    <h3><?php _e('More entries in', A_DOMAIN) ?></h3>
    <ol class="list">
    <?php
      if ( $terms = get_the_terms(get_the_ID(), 'category') ) foreach ($terms as $term) {
        if ( $link = get_term_link( $term ) )
          echo "<li><a href='{$link}'>{$term->name}</a></li>";
      }
    ?>
    </ol>
  </div>
  <!-- /left column-->
  <div class="one-half content">
    <?php the_content( $btn = __('Continue Reading &hellip;', A_DOMAIN) ) ?>
  </div>
  <!-- /content column-->
  <div class="one-fourth last mobile-centred">
    
    <?php if ( get_adjacent_post() && is_single() ) : ?>
      
    <h3><?php _e('Next Entry', A_DOMAIN) ?></h3>
    <p class="list"><?php previous_post_link('%link', '%title') ?></p>
    
    <?php else : ?>
      
    <h3><?php _e('Discussion', A_DOMAIN) ?></h3>
    <?php comments_popup_link(
      __( 'No comments so far', A_DOMAIN ),
      __( 'One comment', A_DOMAIN ),
      __( '% comments', A_DOMAIN )) ?>

    <?php endif; ?>
    
  </div>
  <!-- /right column-->

</div>

<?php comments_template() ?>
