<!-- BEGIN .entry-content -->
<div class="entry-content">
    <?php 
        the_content( __('Read more...', 'zilla') ); 
        wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
    ?>
<!-- END .entry-content -->
</div>