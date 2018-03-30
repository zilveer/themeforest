<?php 
	$quote_style =array('none','boxed');
	$quote_float =array('none','left','right');
?>

<table class="sh_code_tbl">
	<tr>
		<td class="label_td fl_r">
			<label>Quote:</label>
		</td>
		<td>
			<input type="text" id="quote_content">
		</td>
		<td rowspan="3" style="padding-left:20px;">
			<label>Preview</label>
			<div id="quote_demo">
				<div class="cosmo-blockquote">
					<p>Pellentesque risus diam vestibulum phasellus.</p>
				</div>
			</div>
		</td>
	</tr>
	<tr>	
		<td class="label_td fl_r">
			<label>Style:</label>	
		</td>
		<td>
			<select id="quote_style" class="select_medium">
				<?php 
					foreach ($quote_style as $style) {
						echo "<option value='$style'>".$style."</option>";
					}
				?>
			</select>
		</td>
	</tr>
	<tr>	
		<td class="label_td fl_r">
			<label>Float:</label>	
		</td>
		<td>
			<select id="quote_float" class="select_medium">
				<?php 
					foreach ($quote_float as $float) {
						echo "<option value='$float'>".$float."</option>";
					}
				?>
			</select>
		</td>
	</tr>
	
</table>
<div>
	<a href="javascript:void(0);" onclick="resetQuoteSettings();" class="button">Reset</a>
	<input type="button" class="button-primary" value='Insert' id='insert_quote_btn' onclick='insertQuote()'>
</div>	