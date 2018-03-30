<div class="link-wrapper accent-background">
    <?php $link = get_post_meta(get_the_ID(), '_stag_link_url', true); ?>
    <?php if( !is_singular() ) { ?>

        <h2 class="entry-title"><a href="<?php echo $link; ?>" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h2>
        <p><a href="<?php echo $link; ?>"><?php echo $link; ?></a></p>

    <?php } else { ?>

        <h1 class="entry-title"><a href="<?php echo $link; ?>" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h1>
        <p><a href="<?php echo $link; ?>"><?php echo $link; ?></a></p>

    <?php } ?>
</div>

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