<?php
//======================================================================
// TEAM 
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
?>


<?php
//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$partName = 'preload-container';
$section_template_class = 'team';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>


<?php
//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Team
//-----------------------------------------------------
if ($show == 1) {


	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_team','themo_cpt_group');

	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

		// Animation
		$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
		$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );

		switch ($loop->post_count) {
			case 1:
				$bootstrap_tier = 'col-sm-12';
				break;
			case 2:
				$bootstrap_tier = 'col-sm-6';
				break;
			default:
				$bootstrap_tier = 'col-md-4 col-sm-6';
				break;
		}

		$i = 1;
		echo '<div class="row">';

		while ($loop->have_posts()) {
			$loop->the_post();
			$metadata = get_post_meta($post->ID);

			$a_href = false;
			$a_target = false;
			$a_href_close = false;
			if (isset($metadata['__show_link']) && is_array($metadata['__show_link'])  && !empty($metadata['__show_link']) && $metadata['__show_link'][0] == 1) {
				if (isset($metadata['__link'])  && is_array($metadata['__link']) && !empty($metadata['__link']) && $metadata['__link'][0] > "") {
					if (isset($metadata['__link_target'])  && is_array($metadata['__link_target']) && !empty($metadata['__link_target']) && $metadata['__link_target'][0] > "") {
						$a_target = " target='".$metadata['__link_target'][0]."'";
					}

					$a_href = "<a href='".$metadata['__link'][0]."' $a_target>";
					$a_href_close = "</a>";
				}
			}


			echo '<div class="team-member ' . $bootstrap_tier . '">';
			echo '<div class="team-member-wrap">';


			if ( has_post_thumbnail() ) {
				$img_class = 'team-member-image team-member-image-'.$i.themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .team-member-image-'.$i);

				$img_attr = array('class'	=> $img_class.' img-responsive');
				echo wp_kses_post($a_href) . get_the_post_thumbnail($post->ID,'themo_team',$img_attr) . wp_kses_post($a_href_close);
			}

			if (get_the_title() > '') {
				echo '<h4 class="team-member-title-', $i, themo_return_entrance_animation_class($themo_enable_animate, $themo_animation_style, '#' . $key . ' .team-member-title-' . $i), '">', get_the_title(), '</h4>';
			}

			if (isset($metadata['_job_title'][0]) && $metadata['_job_title'][0] > '') {
				echo '<h5 class="team-member-job-title-', $i, themo_return_entrance_animation_class($themo_enable_animate, $themo_animation_style, '#' . $key . ' .team-member-job-title-' . $i), '">', $metadata['_job_title'][0], '</h5>';
			}

			if($post->post_content != "") {
				echo '<div class="team-member-bio-', $i, themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .team-member-bio-'.$i),'">', themo_content($post->post_content) , '</div>';
			}

			if (isset($metadata['_social_link']) && is_array($metadata['_social_link']) && !empty($metadata['_social_link'])) {
				$social_link_array = maybe_unserialize($metadata['_social_link'][0]);
			}

			if (isset($metadata['_social_icon']) && is_array($metadata['_social_icon']) && !empty($metadata['_social_icon'])) {

				$social_media_output = '';
				$target = "";
				if (isset($metadata['__social_link_target']) && is_array($metadata['__social_link_target']) && !empty($metadata['__social_link_target'])) {
					if(isset($metadata['__social_link_target'][0]) && $metadata['__social_link_target'][0] == 1){
						$target = "target='_blank'";
					}
				}
				foreach ($metadata['_social_icon'] as $social_key => $social_val) {
					$social_media_icon = $social_val;
					$social_media_link = '';
					if (isset($social_link_array[$social_key])){
						// For each index in array, print icon, check for link inside social_link array
						$social_media_link = $social_link_array[$social_key];
					}
					$social_media_output .= "<a ".$target." href='".$social_media_link."'><i class='soc-icon social ".$social_media_icon."'></i></a>";

				}
				if($social_media_output > ""){
					echo '<div class="team-member-social team-member-social-'. $i. themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .team-member-social-'.$i).'">'.$social_media_output.'</div>';
				}


			}

			echo '</div><!-- /team-member-wrap-->';
			echo '</div><!-- /team-member-->';

			$i++;
		} // end inner loop
		echo '</div><!-- /.row -->';
	} else {
		// no posts found
	}
	// Restore original Post Data
	wp_reset_postdata();
}

//-----------------------------------------------------
// Team
//-----------------------------------------------------
if ($show == 'on'){ 
	$team_blocks = get_post_meta($post->ID, $key, array() );
	
	// Animation
	$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
	$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );
	
	if (!empty( $team_blocks ) ) { ?>
	<div class="row">
		<?php
		$i = 0;
		foreach( $team_blocks as $team ) {                    
			foreach($team as $value => $element){ ?>
				<div class="team-member col-md-4 col-sm-6">
					<?php if (isset($element[$key.'_photo']) && $element[$key.'_photo'] > "") { ?>
						<?php $img_src = themo_return_metabox_image($element[$key."_photo"], null, "themo_team", true, $alt); ?>
                        <div class="team-member-image team-member-image-<?php echo $i; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .team-member-image-'.$i); ?>"><img class="img-responsive" src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($alt);?>"></div>
					<?php } ?>
					<h4 class="team-member-title-<?php echo $i; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .team-member-title-'.$i); ?>"><?php echo $element['title'] ?></h4>
					<h5 class="team-member-job-title-<?php echo $i; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .team-member-job-title-'.$i); ?>"><?php echo $element[$key.'_job_title'] ?></h5>
					<div class="team-member-bio-<?php echo $i; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .team-member-bio-'.$i); ?>"><?php echo themo_content($element[$key.'_bio']); ?></div>
                    
					<?php $show_social = false; $show_media_links = '';?>
                    <?php for ($i = 1; $i <= 4; $i++) { ?>
                        <?php if (isset($element[$key.'_social_'.$i.'_name']) && isset($element[$key.'_social_'.$i.'_icon']) && isset($element[$key.'_social_'.$i.'_link']) ){ ?>
                        <?php $show_social = true; ?>
                        <?php 
						$show_media_links .= "<a target='_blank' href='".$element[$key.'_social_'.$i.'_link']."'><i class='soc-icon social ".$element[$key.'_social_'.$i.'_icon']."'></i></a>";
						?>
                        <?php } ?>
                    <?php }?>
                    <?php if($show_social){ ?>
                     <div class="team-member-social team-member-social-<?php echo $i; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .team-member-social-'.$i); ?>">
                     	<?php echo wp_kses_post($show_media_links); ?>
                     </div>
                    <?php }?>
				</div> 
				<?php 
			$i++;
			} // end inner loop
		} // end outer loop ?>
	</div><!-- /.row -->
	<?php } // end inner if / then ?>
<?php } // end outer if / then

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
?>


