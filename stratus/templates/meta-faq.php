<?php
//======================================================================
// FAQs
//======================================================================

//-----------------------------------------------------
// GET BACKGROUND
//-----------------------------------------------------
$partName = 'background';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER
//-----------------------------------------------------
$partName = 'border';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$partName = 'preload-container';
$section_template_class = 'faq';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// FAQ | Show FAQs
//-----------------------------------------------------

if ($show == 1) {

    $metadata = get_post_meta($post->ID);

    $themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
    $themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );

    // return custom post type args for WP Query
    $args = themo_return_cpt_args($post->ID,$key,'themo_faq','themo_cpt_group');


    // WP Query
    $loop = new WP_Query($args);

    // Open The Loop
    if ($loop->have_posts()) {

        echo '<div class="row"><dl class="mobile-faq col-xs-12">';

        $i = 0;
        while ($loop->have_posts()) {
            $loop->the_post();
            $metadata = get_post_meta($post->ID);

            if (get_the_title() > '') {
                echo '<dt class="faq-dt-', $i, themo_return_entrance_animation_class($themo_enable_animate, $themo_animation_style, '#' . $key . ' .faq-dt-' . $i), '">', get_the_title(), '</dt>';
            }

            if($post->post_content != "") {
                echo '<dd class="faq-dd-', $i, themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .faq-dd-'.$i),'">', themo_content($post->post_content) , '</dd>';
            } // Subtitle
            $i++;
        }
        echo '</dl> <!-- /.mobile-faq --></div> <!-- /.row -->';

    } else {
        // no posts found
    }
    // Restore original Post Data
    wp_reset_postdata();
}

if ($show == 'on'){ 
	$themo_faqs = get_post_meta($post->ID, $key, array());
	// Animation
	$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
	$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );

	if (!empty( $themo_faqs ) ) {
?>
		<div class="row">
            <dl class="mobile-faq col-xs-12">
            <?php
            $i = 0;
                foreach( $themo_faqs as $row ) {                    
                    foreach($row as $value => $element){ 
						if ($element['title'] > ''){ ?>
                            <dt class="faq-dt-<?php echo $i; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .faq-dt-'.$i); ?>"><?php echo $element['title']; ?></dt>
                        <?php }
                        if ($element['answer'] > ''){ ?>
                            
                            <dd class="faq-dd-<?php echo $i; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .faq-dd-'.$i); ?>"><?php echo themo_content($element['answer']); ?></dd>
                        <?php } ?>
                                    
                     <?php
                    $i++;
                    } // end inner loop
                } // end outer loop ?>
            </dl> <!-- /.mobile-faq --> 
		</div> <!-- /.row -->  
	<?php } // end inner if / then ?>
<?php } // end outer if / then  ?>

<?php
//-----------------------------------------------------
// Preloader, Section, Container Close
//-----------------------------------------------------
$partName = 'preload-container-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER CLOSE
//-----------------------------------------------------
$partName = 'border-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );


