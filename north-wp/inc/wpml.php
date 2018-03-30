<?php

/* Custom Language Switcher */
function thb_language_switcher () {
	if ( function_exists('icl_get_languages')) {
	?>
		<div class="select-wrapper">
			<select id="thb_language_selector">
			<?php
				$languages = icl_get_languages('skip_missing=0');
				if(1 < count($languages)){
					foreach($languages as $l){
						
						$selected = $l['active'] ? ' selected' : '';
						echo '<option value="'.$l['url'].'"'.$selected.'>'.$l['native_name'].'</option>';
					}
				} else {
					echo '<option value="">'.__('Add Languages', 'north').'</option>';	
				}
			?>
			</select>
		</div>
	<?php 
	}
}
add_action( 'thb_language_switcher', 'thb_language_switcher',3 );