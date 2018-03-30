<table width=100% class="sh_code_tbl">
	<tr>
		<td width=50%>
			<table width=100%>
				<tr>
					<td class="label_td fl_r"><label>Default 'Open' title:</label></td>
					<td>
						<input type="text" id="open_title">
						<span class="hint">The text of the title when the toggle is closed.</span>
					</td>
				</tr>
				<tr>
					<td class="label_td fl_r"><label>Default 'Close' title:</label></td>
					<td>
						<input type="text" id="close_title">
						<span class="hint">The text of the title when the toggle is opened.</span>
					</td>
				</tr>
				<tr>
					<td class="label_td fl_r"><label for="hidden_content">Hidden content by default:</label></td>
					<td>
						<input type="checkbox" id="hidden_content" checked="checked" >
					</td>
				</tr>
				<tr>
					<td class="label_td fl_r"><label for="toggle_content">Content:</label></td>
					<td >
						<textarea rows="8" id="toggle_content" style="width:100%"></textarea>
					</td>
				</tr>
			</table>
		</td>
		<td width=50% class="label_td l_padding" valign=top>
			<label>Preview</label>
			<div class="cosmo-toggle" style="pading-top:0px; margin-top:0px;">
				<div id="open_close_title">
					<h2 ><a class="show" id="show_content">Show content</a><a class="hide" id="hide_content" style="display:none">Hide content</a></h2>
				</div>
				<div class="cosmo-toggle-container" style="display: none;margin-top:0px !important;" id="toggle_demo_content">
					Toggled content.
				</div>
			</div>	
			
		</td >
	</tr>
</table>
<div class="l_padding">
	<input type="button" class="button-primary" value='Insert' id='insert_toggle_btn' onclick='insertToggle()'>
</div>	