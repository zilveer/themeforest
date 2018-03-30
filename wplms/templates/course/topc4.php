<?php
$header_style = vibe_get_customizer('header_style');
if($header_style == 'transparent'){
	echo '<section id="title"></section>';
}
?>
<section id="content">
	<div id="buddypress">
		<div class="<?php echo vibe_get_container(); ?>">
			<div class="row">
				<div class="col-md-9">
					<div id="item-header" role="complementary">
						<?php locate_template( array( 'course/single/course-header3.php' ), true ); ?>
					</div><!-- #item-header -->
					<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
						<ul>
							<?php bp_get_options_nav(); ?>
							<?php

							if(function_exists('bp_course_nav_menu'))
								bp_course_nav_menu();
							
							
							?>
							<?php do_action( 'bp_course_options_nav' ); ?>
						</ul>
						<?php do_action( 'bp_before_course_home_content' ); ?>
					</div>
