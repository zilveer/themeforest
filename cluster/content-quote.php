<div class="quote-wrapper">
    <?php
        $quote = get_post_meta(get_the_ID(), '_stag_quote_quote', true);
        $source = get_post_meta(get_the_ID(), '_stag_quote_source', true);
    ?>

    <?php if( !is_singular() ) { ?>

        <h2 class="entry-title"><?php echo $quote; ?></h2>
        <p><?php echo $source; ?></p>

    <?php } else { ?>

        <h1 class="entry-title"><?php echo $quote; ?></h1>
        <p><?php echo $source; ?></p>

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