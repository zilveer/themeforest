<?php if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
    <figure class="post-thumb">

        <?php if( !is_singular() ) { ?>

            <a title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>

        <?php } else {

            the_post_thumbnail('full');

        } ?>

    </figure>
<?php } ?>

<?php if( is_singular() ) { ?>

    <h1 class="entry-title"><?php the_title(); ?></h1>

<?php } ?>

<?php if(is_singular()) {
    get_template_part('content', 'meta'); ?>

<!-- BEGIN .entry-content -->
<div class="entry-content">
    <?php
        the_content( __('Continue Reading', 'stag') );
        wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'stag').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
    ?>
<!-- END .entry-content -->
</div>

<?php } ?>

<?php if(!is_singular()) get_template_part('content', 'meta'); ?>