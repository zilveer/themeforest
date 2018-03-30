<?php get_template_part('templates/page', 'head'); ?>

</div>
<article id="_404" class="parallax darkText" style="background-image: url('<?php echo get_template_directory_uri()?>/assets/img/404.jpg')">
    <div class="container">
        <div class="row-fluid">
            <div class="span5 offset3">
                <h1>
                    <span class="message-1"><?php _e('oops!', 'ct_theme'); ?></span>
                    404
                    <span class="message-2"><?php _e('page not found', 'ct_theme'); ?></span>
                </h1>
                <p class="message-3">
                    <?php _e("Sorry, the page you're looking for doesn't exist.", 'ct_theme'); ?><br>
                    <?php _e('Go back to', 'ct_theme'); ?> <a href="/"><?php _e('home page', 'ct_theme'); ?></a>
                </p>
            </div>
        </div>
    </div>
</article>
<div class="container">