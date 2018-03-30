<?php
//======================================================================
// Pricing Plans
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
$section_template_class = 'pricing-section';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );


//-----------------------------------------------------
// Pricing Plans
//-----------------------------------------------------
if ($show == 1) {

	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_pricing_plans','themo_cpt_group');

	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

		// Animation
		$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
		$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );
		$service_plan_footnote_show = get_post_meta($post->ID, $key.'_footnote_show', true );
		$service_plan_footnote = get_post_meta($post->ID, $key.'_footnote', true );

		$row_class = "";
		$i = 0;


		switch ($loop->post_count) {
			case 1:
				$bootstrap_tier = 'col-sm-6 col-sm-offset-3';
				$service_plan_count = 'one';
				break;
			case 2:
				$bootstrap_tier = 'col-sm-6';
				$service_plan_count = 'two';
				break;
			case 3:
				$bootstrap_tier = 'col-md-4 col-sm-6';
				$service_plan_count = 'three';
				break;
			case 4:
				$bootstrap_tier = 'col-md-3 col-sm-6';
				$service_plan_count = 'four';
				break;
			case 5:
				$bootstrap_tier = 'col-md-2 col-sm-6';
				$service_plan_count = 'five';
				$row_class = $service_plan_count.'-columns';
				break;
			default:
				$bootstrap_tier = 'col-md-2 col-sm-6';
				$service_plan_count = 'five';
				$row_class = $service_plan_count.'-columns';
				break;
		}

		echo '<div class="pricing-table ', $service_plan_count, '-col">';
		echo '<div class="', $row_class, ' row">';

		while ($loop->have_posts()) {
			$loop->the_post();
			$metadata = get_post_meta($post->ID);

			if (++$i == 6) break;

			if ($metadata['_featured'][0] == 1){
				$highlight_class = 'highlight ';
			}else{
				$highlight_class = '';
			}
			$price = false;
			$price_per = false;
			if(isset($metadata['_price'][0])){
				$price = $metadata['_price'][0];
			}
			if(isset($metadata['_price_per'][0])){
				$price_per = $metadata['_price_per'][0];
			}
			echo '<div class="pricing-column ', $highlight_class, $bootstrap_tier,'">';
				echo '<div class="pricing-cost">', $price,'<span>', $price_per, '</span></div>';
				echo '<div class="pricing-title">', get_the_title(),'</div>';
				echo '<div class="pricing-features">';
					echo themo_nl2li($metadata['_details'][0],0,1);
					$animation_class = themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .btn');
					themo_do_shortocde_button($post->ID, '_', false, $animation_class);
                    themo_do_shortocde_button($post->ID, '_', false, $animation_class,2);
				echo '</div>';
			echo '</div> <!-- /.pricing-column -->';

		} // end inner loop

		echo '</div> <!-- /.row -->';
		if ($service_plan_footnote_show == 1 && $service_plan_footnote > ""){
			echo '<p class="pricing-footer">', $service_plan_footnote, '</p>';
		}
		echo '</div> <!-- /.pricing-table -->';

	} else {
		// no posts found
	}
	// Restore original Post Data
	wp_reset_postdata();
}
//-----------------------------------------------------
// Pricing Plans
//-----------------------------------------------------
if ($show == 'on'){ 
	$service_plan = get_post_meta($post->ID, $key, array() );
	
	// Animation
	$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
	$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );
		
		if (!empty( $service_plan ) ) { 
			$service_plan_footnote_show = get_post_meta($post->ID, $key.'_footnote_show', true );
			$service_plan_footnote = get_post_meta($post->ID, $key.'_footnote', true );
			
			$service_plan_count = themo_getArrCount($service_plan, 1);	
			$row_class = "";
	
			switch ($service_plan_count) {
				case 1:
					$bootstrap_tier = 'col-sm-6 col-sm-offset-3';
					$service_plan_count = 'one';
					break;
				case 2:
					$bootstrap_tier = 'col-sm-6';
					$service_plan_count = 'two';
					break;
				case 3:
					$bootstrap_tier = 'col-md-4 col-sm-6';
					$service_plan_count = 'three';
					break;
				case 4:
					$bootstrap_tier = 'col-md-3 col-sm-6';
					$service_plan_count = 'four';
					break;
				case 5:
					$bootstrap_tier = 'col-md-2 col-sm-6';
					$service_plan_count = 'five';
					$row_class = $service_plan_count.'-columns';
					break;		
				default:
					$bootstrap_tier = 'col-md-2 col-sm-6';
					$service_plan_count = 'five';
					$row_class = $service_plan_count.'-columns';
				break;
			} ?>	

        <div class="pricing-table <?php echo sanitize_text_field($service_plan_count); ?>-col">
            <div class="<?php echo sanitize_text_field($row_class); ?> row">
            <?php
            $i = 0;
            foreach( $service_plan as $col ) {                    
                foreach($col as $value => $element){
                    if (++$i == 6) break;
                    if ($element[$key.'_featured'] == 'on'){
                        $highlight_class = 'highlight';
                    }else{
                        $highlight_class = '';
                    }
                ?>
                <div class="pricing-column <?php echo sanitize_text_field($highlight_class); ?> <?php echo sanitize_text_field($bootstrap_tier); ?>">
                    <div class="pricing-cost"><?php echo sanitize_text_field($element[$key.'_price']); ?><span><?php echo sanitize_text_field($element[$key.'_price_per']); ?></span></div>
                    <div class="pricing-title"><?php echo sanitize_text_field($element['title']); ?></div>
                    <div class="pricing-features">
                        <?php echo themo_nl2li(sanitize_text_field($element[$key.'_details'],0,1)); ?>
                        <?php
						$animation_class = themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .btn');
						themo_do_shortocde_button($element, $key, false, $animation_class);
                        themo_do_shortocde_button($element, $key, false, $animation_class,2);
						?>
                    </div>
                </div> <!-- /.pricing-column -->
                <?php
                }
            }
            ?>
            </div> <!-- /.row -->      
            <?php if ($service_plan_footnote_show == 'on' && $service_plan_footnote > ""){ ?>
                <p class="pricing-footer"><?php echo sanitize_text_field($service_plan_footnote); ?></p>
            <?php } ?>
        </div> <!-- /.pricing-table --> 
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

