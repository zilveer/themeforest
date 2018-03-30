<?php
$path = pathinfo(__FILE__) ['dirname'];
include ($path . '/config.php');

$id = Mk_Static_Files::shortcode_id();

Mk_Static_Files::addCSS('#mk-process-'.$id.' ul li:hover .mk-process-icon {background-color:'.$hover_color.';}', $id);
?>

<div id="mk-process-<?php echo $id; ?>" class="mk-process-steps process-steps-<?php echo $step; ?> <?php echo $el_class; ?>">
	
	<?php mk_get_view('global', 'shortcode-heading', false, ['title' => $title]); ?>
	
	<ul>
		<?php 
		for ( $i=1; $i <= $step; $i++ ) {

			if ( !empty( ${'icon_'.$i} ) ) {
			    ${'icon_'.$i} = (strpos(${'icon_'.$i}, 'mk-') !== FALSE) ? ${'icon_'.$i} : ( 'mk-'.${'icon_'.$i}.'' );        
			
			?>

			<li class="<?php echo get_viewport_animation_class($animation); ?>">

				<?php if(!empty( ${'url_'.$i} )) { ?>
					<a href="<?php echo ${'url_'.$i}; ?>">
				<?php } ?>
						<span class="mk-process-icon"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, ${'icon_'.$i}); ?></span>
				<?php if(!empty( ${'url_'.$i} )) { ?>
					</a>
				<?php } ?>


				<div class="mk-process-detail">

					<?php if(!empty( ${'url_'.$i} )) { ?>
						<a href="<?php echo ${'url_'.$i}; ?>">
					<?php } ?>
							<h3><?php echo ${'title_'.$i}; ?></h3>
					<?php if(!empty( ${'url_'.$i} )) { ?>
						</a>
					<?php } ?>

					<div class="clearboth"></div>

					<?php if(${'desc_'.$i} != '') { ?>
							<p><?php echo ${'desc_'.$i}; ?></p>
					<?php } ?>
				</div>

			</li>
		<?php 
			} 
		} ?>

		<div class="clearboth"></div>
	</ul>
</div>



