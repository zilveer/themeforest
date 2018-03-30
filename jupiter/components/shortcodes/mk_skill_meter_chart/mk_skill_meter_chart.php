<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );
$id = uniqid();
$meter = '';
?>

<div class="mk-skill-chart<?php echo get_viewport_animation_class($animation).$el_class; ?>">
	
		<?php 				
		$f = 0;
		for ( $i = 1; $i <= 7; $i++ ) {
			if ( !empty( ${'name_'.$i} ) && ${'percent_'.$i} != 0 ) {
				$f++; 
				$meter .= '<div class="mk-meter-arch" data-color="'. ${'color_'.$i} .'" data-name="'. ${'name_'.$i} .'" data-percent="'. ${'percent_'.$i} .'" ></div>';
			 }
		}

		$data_atts[] = 'data-dimension="'.(( $f * 56 ) + 190).'"';
		$data_atts[] = 'data-circle-color="'.$center_color.'"';
		$data_atts[] = 'data-default-text-color="'.$default_text_color.'"';
		$data_atts[] = 'data-default-text="'.$default_text.'"';
		?>

		<div class="mk-skill-diagram" id="mk_skill_diagram_<?php echo $id; ?>" <?php echo implode(' ', $data_atts); ?>>
			<?php echo $meter; ?>
		</div>
</div>

