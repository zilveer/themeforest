<?php get_header(); ?>
<div class="row">
    <div class="large-12 columns main-content-top">
        <div class="row">
            <div class="large-6 columns">
                <h2><?php the_title(); ?> </h2>
            </div>        
            <div class="large-6 columns">
                <?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
            </div>
        </div>
    </div>
</div>
<div class="shadow"></div>
<div class="row main-content">
    <div class="large-12 columns">
        <div class="large-12 columns center">
            <h1 class="notfound_title"><?php _e('404', 'Evolution')?></h1>
            <h2 class="notfound_subtitle"><?php _e('Oops...are you lost?', 'Evolution')?></h2>            
	</div> 
        <div class="large-12 columns center">
                    <p class="notfound_description">
                        <?php _e('The page you are looking for seems to be missing.Go back, or return to yourcompany.com to choose a new direction.Please report any broken links to our team.', 'Evolution')?>
                    </p>
	</div>
	<div class="large-12 columns center">
            <a class="button large bottom20" href="javascript: history.go(-1)"><i class="icon-undo"></i><?php _e('Return to previous page', 'Evolution')?></a>
	</div>
    </div>
</div>
<?php get_footer(); ?>
