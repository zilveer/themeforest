<?php
    get_header();
?>
<section id="main">
    
    <?php echo get_my_search_form(); ?>

	<div class="main-container">
    <?php
        function do_nothing( $sender ){}
        $layout = new LBSidebarResizer( 'front_page' );
        $layout -> render_frontend( 'do_nothing' );
    ?>
	</div>
</section>
<?php get_footer(); ?>