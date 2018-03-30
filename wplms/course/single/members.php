<?php
/**
 * The template for displaying Course members
 *
 * Override this template by copying it to yourtheme/course/single/members.php
 *
 * @author 		VibeThemes
 * @package 	vibe-course-module/templates
 * @version     1.8.1
 */

global $post;
$students=get_post_meta(get_the_ID(),'vibe_students',true);

$course_layout = vibe_get_customizer('course_layout');

if(empty($course_layout)){
?>
<div class="course_title">
	<h1><?php the_title(); ?></h1>
</div>
<?php
}
?>

<?php

$students_undertaking= bp_course_get_students_undertaking(); 

if(count($students_undertaking) > 0 ){
	?>
	<h4 class="total_students"><?php _e('Total number of Students in course','vibe'); ?><span><?php echo $students; ?></span></h4>
	<?php
	echo '<ul class="course_students">';
	foreach($students_undertaking as $student){

		if (function_exists('bp_get_profile_field_data')) {
		    $bp_name = bp_core_get_userlink( $student );
		    $sfield=vibe_get_option('student_field');
		    if(!isset($sfield) || $sfield =='')
		    	$sfield = 'Location';

		    $bp_location ='';
		    if(bp_is_active('xprofile'))
		    $bp_location = bp_get_profile_field_data('field='.$sfield.'&user_id='.$student);
		    
		    if ($bp_name) {
		    	echo '<li>';
		    	echo get_avatar($student);
		    	echo '<h6>'. $bp_name . '</h6>';
			    if ($bp_location) {
			    	echo '<span>'. $bp_location . '</span>';
			    }
			    echo '</li>';
		    }
		    
		}
	}
	echo '</ul>';
	echo bp_course_paginate_students_undertaking();
}else{
	echo '<div class="message">'._x('No members found in this course.','No members notification in course - members','vibe').'</div>';
}

?>