<!-- breadcrumb starts here -->
<div class="breadcrumb-wrapper <?php if(dt_theme_option('general','header-top-bar') == "true") echo esc_attr('notop'); ?>">
    <div class="container">
        <h1><?php the_title(); ?></h1><?php
        #Check breadcrumb enable...
        if(dt_theme_option('general', 'disable-breadcrumb') != "on")
          new dt_theme_breadcrumb; ?>
    </div>
</div><!-- breadcrumb ends here -->