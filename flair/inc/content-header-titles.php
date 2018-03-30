<div id="content">
	
	<?php if( $logo ) : ?>
	<div class="wow bounceInDown animated text-center intro-logo" data-wow-duration="<?php echo $logo_anim_duration; ?>s" data-wow-delay="<?php echo $logo_anim_delay; ?>s">
		<img src="<?php echo $logo; ?>" alt="logo" />
	</div>
	<?php endif; ?>
							
	<?php if( $top_small_text ) : ?>
		<div class="byline wow slideInLeft pad45" data-wow-delay="<?php echo $top_small_text_anim_delay; ?>s">
			<?php echo htmlspecialchars_decode($top_small_text); ?>
		</div>
	<?php endif; ?>
	
	<?php if( is_array($lines) ) : ?>
		<h1 class="text-rotator-fade wow bounceInDown" data-wow-duration="<?php echo $large_text_anim_duration; ?>s" data-wow-delay="<?php echo $large_text_anim_delay; ?>s">
			<span class="rotate">
				<?php  
					foreach( $lines as $line ){
						$large_text_output .= $line . '*';
					}
					echo rtrim($large_text_output, '*');
				?>
			</span>
		</h1>
	<?php endif; ?>
	
	<?php if( $bottom_small_text ) : ?>
		<div class="name wow bounceInDown" data-wow-duration="<?php echo $small_text_anim_duration; ?>s" data-wow-delay="<?php echo $small_text_anim_delay; ?>s">
			<?php echo htmlspecialchars_decode($bottom_small_text); ?>
		</div>
	<?php endif; ?>
	
	<div class="text-center pad30">
		<a href="#about" class="scroll" id="down-link">
		<i class="fa fa-caret-down fa-3x wow rotateIn" data-wow-duration="<?php echo $caret_anim_duration; ?>s" data-wow-delay="<?php echo $caret_anim_delay; ?>s"></i></a>
	</div>
	
</div>	