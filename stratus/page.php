<?php global $post;  ?>
<?php include( locate_template( 'templates/page-layout.php' ) ); ?>

<div class="inner-container">
	<?php include( locate_template( 'templates/meta-slider-flex.php' ) ); ?>
    <?php include( locate_template( 'templates/meta-slider_master.php' ) ); ?>
	<?php include( locate_template( 'templates/page-header.php' ) ); // Page Header Template ?>
    
	<?php echo wp_kses_post($outer_container_open) . wp_kses_post($outer_row_open); // Outer Tag Open ?>
    <?php 
    /* OPEN MAIN CLASS */
    echo wp_kses_post($main_class_open); // support for sidebar ?>
    
    <?php
    /* META BOX CONTENT */
    $custom_field_keys = get_post_custom($post->ID); // GET META DATA
    $meta_key_array = themo_sort_meta_array($custom_field_keys); // Filter an Sort ASC
    $page_template = basename( get_page_template() ); // Get Template Name

    foreach ( $meta_key_array as $key => $value ) { // Loop through custom array
        themo_print_template_part($key,$page_template,wp_kses_post($inner_container_open),wp_kses_post($inner_container_close),$page_layout); // Custom Function that Prints template parts
    } ?>
    
    <?php // check if sidebar and remove container, else leave it. ?>
    <!-- Comment form for pages -->
	<?php echo wp_kses_post($inner_container_open); ?>
        <div class="row">
			<div class="col-md-12">
	        <?php comments_template('/templates/comments.php'); ?>
            </div>
        </div>
    <?php echo wp_kses_post($inner_container_close); ?>
    <!-- End Comment form for pages -->
    
    <?php 
    /* CLOSE MAIN CLASS */
    echo wp_kses_post($main_class_close); ?>
    
    <?php
    /* SIDEBAR */
    include themo_sidebar_path(); ?>              
    
    <?php 
    echo wp_kses_post($outer_container_close) . wp_kses_post($outer_row_close); // Outer Tag Close ?>
</div><!-- /.inner-container -->