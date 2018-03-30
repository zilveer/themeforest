<?php get_template_part('templates/page', 'head'); ?>

    <div class="container">
        <div class="titleRow">
            <h1 class="crossLine"><span><?php _e('PAGE NOT FOUND', 'ct_theme')?></span></h1>
        </div>

        <div class="row-fluid">
            <div class="span12 doCenter">
                <div class="pg404">
                    <div class="co1 pull-left">
                        <img src="<?php echo get_template_directory_uri()?>/assets/img/404-image.png" alt="404 error" class="img404">
                    </div>
                    <div class="co2 pull-right">
                        <h3><?php _e("SORRY, WE COULDN'T FIND THE PAGE YOU REQUESTED.", 'ct_theme')?></h3>
                    </div>
                    <div class="clearfix"></div>
                    <div class="search404">

                        <p><?php _e(sprintf('Please go back to our %s or use search field below:', '<a href="/">' . __('home page', 'ct_theme') . '</a>'))?></p>
						<?php get_search_form(); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
	            <!-- / pg404 -->

            </div>

        </div>
    </div>
