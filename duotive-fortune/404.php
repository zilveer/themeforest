<?php
	/* 404 ERROR PAGE TEMPLATE */
	get_header();
?>
    <section id="content" class="clearfix page-widh-sidebar">
    	<div class="content-header-sep"></div>
            <div class="page widget_search">                 	
                <h5><?php echo dt_NotFoundContent; ?></h5>
                <?php get_search_form(); ?>
            <!-- end of page -->
            </div>
        <?php get_sidebar(); ?>
    <!-- end of content -->
    </section>
<?php get_footer(); ?>