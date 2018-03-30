<?php

// get font list
include_once(THEME_ADMIN.'/google_fonts/google_fonts.php');

class Font_Control extends WP_Customize_Control {
	public function render_content() {
	?>
		<span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>
		<div class="sleek-font-control-field">



			<!-- Whole Font setting in string -->
			<input name="font-control" type="hidden" value="<?php echo $this->value(); ?>" <?php $this->link(); ?>>

			<?php
				$value = explode( '|', $this->value() );

				$active_font_styles = array();

				if ( !isset($value[2]) ) {$value[2] = 16; }
				if ( !isset($value[3]) ) {$value[3] = 1; }
			?>



			<!-- Font Family -->
			<?php $google_fonts =  sleek_get_google_fonts(); ?>
			<select name="font-family" class="family">
				<?php foreach ( $google_fonts as $font ) {

					// get font styles
					$styles = '';
					$i = 1;

					$active_font = $value[0] == $font->family ? true : false;

					foreach($font->variants as $variant){

						// get styles string for family data
						if($i > 1){
							$styles .= ',';
						}
						$i++;
						$styles .= $variant;

						// get styles of active family as array for default font-style field
						if($active_font){
							$active_font_styles[] = $variant;
						}
					}

					// print full font family option
					echo '<option class="font-control-option font-control-option--family" value="'.$font->family.'"'.selected($value[0], $font->family).' data-styles="'.$styles.'">'.$font->family.'</option>';
					}
				?>
			</select>



			<!-- Font Style -->
			<select name="font-style" class="style">
				<?php
					foreach($active_font_styles as $style){
						$selected = $value[1] == $style ? 'selected' : '';
						echo '<option value="'.$style.'" '.$selected.'>'.$style.'</option>';
					}
				?>
			</select>



			<!-- Font Size -->
			<input type="text" class="size" name="font-size" placeholder="Font Size" value="<?php echo $value[2]; ?>"/>

			<!-- Line Height -->
			<input type="text" class="line" name="line-height" placeholder="Line Height" value="<?php echo $value[3]; ?>"/> px/em





		</div>
	<?php
	}
}
?>