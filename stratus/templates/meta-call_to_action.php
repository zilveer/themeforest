<?php
//======================================================================
// Call to Action Template
//======================================================================
?>

<?php
//-----------------------------------------------------
// GET BACKGROUND
//-----------------------------------------------------
$partName = 'background';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

<?php
//-----------------------------------------------------
// GET BORDERS
//-----------------------------------------------------
$partName = 'border';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

<?php
//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$partName = 'preload-container';
$section_template_class = 'simple-cta';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

<?php
//-----------------------------------------------------
// Call to Action
//-----------------------------------------------------
$call_to_action_text = "";
$call_to_action_text = get_post_meta($post->ID, $key.'_text', true );

// Animation
$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );
?>
	<div class="row">
		<?php
        if($call_to_action_text > ""){
            echo "<div class='themo-action-text ".themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .themo-action-text')." '><span>".$call_to_action_text."</span></div>";
        }
		themo_do_shortocde_button($post->ID, $key);
        themo_do_shortocde_button($post->ID, $key,false,false,2);
        ?>
	</div><!-- /.row -->


<?php
//-----------------------------------------------------
// Preloader, Section, Container Close
//-----------------------------------------------------
$partName = 'preload-container-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

<?php
//-----------------------------------------------------
// GET BORDER CLOSE
//-----------------------------------------------------
$partName = 'border-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

