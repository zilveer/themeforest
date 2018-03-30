 <?php 
	get_header();
	get_template_part(THEME_INCLUDES."top");
?>   
	<div id="primary">
        <!-- Elements -->
        <div class="sixteen columns">
            <div class="page-404">
                <h1><?php _e("404", THEME_NAME);?></h1>
                <h4><?php _e("Oops, it appears you've find an error.", THEME_NAME);?></h4>
                <p><?php _e("Page you were looking for doesn't exist.", THEME_NAME);?></p>
                <p><a href="<?php echo home_url();?>" class="button blue-btn"><?php _e("Back to home", THEME_NAME);?></a></p>
            </div>
        </div>
    </div>
</div>
<?php 
	get_footer();
?>