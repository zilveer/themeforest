<?php

  $embed = get_post_meta(get_the_ID(), '_stag_video_embed', true);

  if( !empty( $embed ) ) {

    echo "<div class='the-video-player'>".stripslashes(htmlspecialchars_decode($embed))."</div>";

  } else {

    stag_video_player(get_the_ID());

  }

?>

<?php if( !is_singular() ) { ?>

    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>

<?php } else { ?>

    <h1 class="entry-title"><?php the_title(); ?></h1>

<?php } ?>

<?php if(is_singular()) get_template_part('content', 'meta'); ?>

<!-- BEGIN .entry-content -->
<div class="entry-content">
    <?php
        the_content( __('Continue Reading', 'stag') );
        wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'stag').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
    ?>
<!-- END .entry-content -->
</div>

<?php if(!is_singular()) get_template_part('content', 'meta'); ?>