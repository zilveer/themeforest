<?php
/**
 * add options
 */
add_action('portfolio_metabox_general_after', 'cshero_portfolio_metabox_general');
function cshero_portfolio_metabox_general(){
    cs_options(array(
        'id' => 'portfolio_layout',
        'label' => __('Layout',THEMENAME),
        'type' => 'select',
        'options' => array(
            ''=> 'Default',
            'vertical-floating-sidebar' => 'Vertical Floating Sidebar',
            'vertical-wide' => 'Vertical Wide', 
            'big-slider' => 'Big slider',
            'small-slider' => 'Small Slider',
            'gallery'=>'Gallery',
            'video'=>'Video'
        ),
        'default' =>''
    ));
    cs_options(array(
        'id' => 'portfolio_gallery_layout',
        'label' => __('Gallery Layout',THEMENAME),
        'type' => 'select',
        'options' => array(
            ''=> 'Default',
            'carousel' => 'Carousel',
            'grid' => 'Grid'
        ),
        'default' =>''
    ));
    cs_options(array(
        'id' => 'portfolio_about_project',
        'label' => __('About Project',THEMENAME),
        'type' => 'textarea',
    ));
    cs_options(array(
        'id' => 'portfolio_project_date',
        'label' => __('Project Date',THEMENAME),
        'type' => 'date',
        'format' => 'M d Y'
    ));
    cs_options(array(
        'id' => 'portfolio_project_client',
        'label' => __('Project Client',THEMENAME),
        'type' => 'textarea',
    ));
    if(function_exists('get_categories_assoc')){
        $testimonial_options = get_categories_assoc('testimonial_category');
        cs_options(array(
            'id' => 'testimonial_category',
            'label' => __('Testimonial',THEMENAME),
            'type' => 'multiple',
            'options' => $testimonial_options
        ));       
        $portfolio_options = get_categories_assoc('portfolio_category');
        cs_options(array(
            'id' => 'portfolio_category',
            'label' => __('Similar Projects',THEMENAME),
            'type' => 'multiple',
            'options' => $portfolio_options
        ));
    }
}
/**
 * create Tab
 */
add_action('portfolio_metabox_tab_title_after', 'cshero_portfolio_metabox_tab_title');
function cshero_portfolio_metabox_tab_title() {
    ?>
    <li class='cs-tab'><a href="#tabs-gallery"><i class="dashicons dashicons-images-alt2"></i> <?php echo _e('GALLERY', THEMENAME);?></a></li>
    <?php
}
add_action('portfolio_metabox_tab_content_after', 'cshero_portfolio_metabox_tab_content');
function cshero_portfolio_metabox_tab_content() {
    ?>
    <div class='cs-tabs-panel clearfix'>
 		<div id="tabs-gallery">
 		<?php
 		cs_options(array(
            'label' => 'Intro Gallery',
            'description' => 'Select an image file for your Intro gallery.',
            'id' => 'portfolio_intro',
            'type' => 'images',
            'field' => 'single'
        ));
 		cs_options(array(
     		'id' => 'portfolio_gallery',
     		'type' => 'editor',
 		));
 		?>
 		</div>
	</div>
    <?php
}