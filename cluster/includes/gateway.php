<?php

if(file_exists('../../../../wp-load.php')) {
  include '../../../../wp-load.php';
} else {
  include '../../../../../wp-load.php';
}

$postid = $_POST['id'];

query_posts(array(
  'p' => $postid,
  'post_type' => "portfolio"
));

if(have_posts()): while(have_posts()): the_post(); ?>

<article <?php post_class(); ?>>

  <?php if(has_post_thumbnail()){
  echo '<div class="post-thumb left-side"><a href="'.get_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(), 'full').'</a></div>';
  } ?>

  <div class="right-side">
    <div class="gateway-close"><a href="#"><i class="icon-close"></i></a></div>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>

    <div class="entry-content">
        <?php the_excerpt(); ?>
    </div>
  </div>

</article>

<?php
endwhile;
endif;
wp_reset_query();
?>
