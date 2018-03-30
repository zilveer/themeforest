<div class="to_demo_wrap">
	<a href="" class="to_demo_pin iconadmin-pin" title="<?php esc_attr_e('Pin/Unpin demo-block by the right side of the window', 'morning-records'); ?>"></a>
	<div class="to_demo_body_wrap">
		<div class="to_demo_body">
			<h1 class="to_demo_header">Header with <span class="to_demo_header_link">inner link</span> and it <span class="to_demo_header_hover">hovered state</span></h1>
			<p class="to_demo_info">Posted <span class="to_demo_info_link">12 May, 2015</span> by <span class="to_demo_info_hover">Author name hovered</span>.</p>
			<p class="to_demo_text">This is default post content. Colors of each text element are set based on the color you choose below.</p>
			<p class="to_demo_text"><span class="to_demo_text_link">link example</span> and <span class="to_demo_text_hover">hovered link</span></p>

			<?php 
			$colors = morning_records_storage_get('custom_colors');
			if (is_array($colors) && count($colors) > 0) {
				foreach ($colors as $slug=>$scheme) { 
					?>
					<h3 class="to_demo_header">Accent colors</h3>
					<?php if (isset($scheme['accent1'])) { ?>
						<div class="to_demo_columns3"><p class="to_demo_text"><span class="to_demo_accent1">accent1 example</span> and <span class="to_demo_accent1_hover">hovered accent1</span></p></div>
					<?php } ?>
					<?php if (isset($scheme['accent2'])) { ?>
						<div class="to_demo_columns3"><p class="to_demo_text"><span class="to_demo_accent2">accent2 example</span> and <span class="to_demo_accent2_hover">hovered accent2</span></p></div>
					<?php } ?>
					<?php if (isset($scheme['accent3'])) { ?>
						<div class="to_demo_columns3"><p class="to_demo_text"><span class="to_demo_accent3">accent3 example</span> and <span class="to_demo_accent3_hover">hovered accent3</span></p></div>
					<?php } ?>
		
					<h3 class="to_demo_header">Inverse colors (on accented backgrounds)</h3>
					<?php if (isset($scheme['accent1'])) { ?>
						<div class="to_demo_columns3 to_demo_accent1_bg to_demo_inverse_block">
							<h4 class="to_demo_accent1_hover_bg to_demo_inverse_dark">Accented block header</h4>
							<div>
								<p class="to_demo_inverse_light">Posted <span class="to_demo_inverse_link">12 May, 2015</span> by <span class="to_demo_inverse_hover">Author name hovered</span>.</p>
								<p class="to_demo_inverse_text">This is a inversed colors example for the normal text</p>
								<p class="to_demo_inverse_text"><span class="to_demo_inverse_link">link example</span> and <span class="to_demo_inverse_hover">hovered link</span></p>
							</div>
						</div>
					<?php } ?>
					<?php if (isset($scheme['accent2'])) { ?>
						<div class="to_demo_columns3 to_demo_accent2_bg to_demo_inverse_block">
							<h4 class="to_demo_accent2_hover_bg to_demo_inverse_dark">Accented block header</h4>
							<div>
								<p class="to_demo_inverse_light">Posted <span class="to_demo_inverse_link">12 May, 2015</span> by <span class="to_demo_inverse_hover">Author name hovered</span>.</p>
								<p class="to_demo_inverse_text">This is a inversed colors example for the normal text</p>
								<p class="to_demo_inverse_text"><span class="to_demo_inverse_link">link example</span> and <span class="to_demo_inverse_hover">hovered link</span></p>
							</div>
						</div>
					<?php } ?>
					<?php if (isset($scheme['accent3'])) { ?>
						<div class="to_demo_columns3 to_demo_accent3_bg to_demo_inverse_block">
							<h4 class="to_demo_accent3_hover_bg to_demo_inverse_dark">Accented block header</h4>
							<div>
								<p class="to_demo_inverse_light">Posted <span class="to_demo_inverse_link">12 May, 2015</span> by <span class="to_demo_inverse_hover">Author name hovered</span>.</p>
								<p class="to_demo_inverse_text">This is a inversed colors example for the normal text</p>
								<p class="to_demo_inverse_text"><span class="to_demo_inverse_link">link example</span> and <span class="to_demo_inverse_hover">hovered link</span></p>
							</div>
						</div>
					<?php } ?>
					<?php 
					break;
				}
			}
			?>
	
			<h3 class="to_demo_header">Alternative colors used to decorate highlight blocks and form fields</h3>
			<div class="to_demo_columns2">
				<div class="to_demo_alter_block">
					<h4 class="to_demo_alter_header">Highlight block header</h4>
					<p class="to_demo_alter_text">This is a plain text in the highlight block. This is a plain text in the highlight block.</p>
					<p class="to_demo_alter_text"><span class="to_demo_alter_link">link example</span> and <span class="to_demo_alter_hover">hovered link</span></p>
				</div>
			</div>
			<div class="to_demo_columns2">
				<div class="to_demo_form_fields">
					<h4 class="to_demo_header">Form field</h4>
					<input type="text" class="to_demo_field" value="Input field example">
					<h4 class="to_demo_header">Form field focused</h4>
					<input type="text" class="to_demo_field_focused" value="Focused field example">
				</div>
			</div>
		</div>
	</div>
</div>
