<aside id="mk-sidebar" class="mk-builtin" <?php echo get_schema_markup('sidebar'); ?>>
    <div class="sidebar-wrapper">
    <?php  
    global $post;
    if(isset($post)){

    	mk_sidebar_generator( 'get_sidebar', $post->ID);

    }else{

    	mk_sidebar_generator( 'get_sidebar', false);

    } ?>
    </div>
</aside>