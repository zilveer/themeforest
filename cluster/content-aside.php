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