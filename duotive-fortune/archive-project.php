<?php
	/* CATEGORY PAGES TEMPLATE */
	get_header();
?>
    <section id="content" class="clearfix page-widh-sidebar">
        <div class="page">       
        	<?php get_template_part( 'loop', 'index' ); ?>
        <!-- end of page -->
        </div>
        <?php get_sidebar(); ?>
    <!-- end of content -->
    </section>
<?php get_footer(); ?>
