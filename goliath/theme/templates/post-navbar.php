<?php if(plsh_navbar_active()) : ?>
<div class="post-1-navbar">
    <ul class="nav">
        <?php if(plsh_gs('show_about_author') == 'on' && is_singular('post')) : ?>
        <li><a href="#about-author"><?php _e('About author', 'goliath'); ?></a></li>
        <?php endif; ?>
    
        <?php if ( comments_open() ) : ?>
        <li><a href="#comments"><?php _e('Comments', 'goliath'); ?></a></li>
        <?php endif; ?>
        
    </ul>
</div>
<?php endif; ?>