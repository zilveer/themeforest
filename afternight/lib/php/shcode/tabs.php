<?php 
	$type_range =array('Simple Tabber'=>'default','Vertical Tabber' =>'vertical','Toggle'=>'toggle','Accordion' => 'accordion');
?>
<div>
	<label class="tabs_label" for="tabs_style">Style:</label>
	<select id="tabs_style">
		<?php 
			foreach ($type_range as $_type) {
				echo "<option value='$_type'>".array_search($_type,$type_range)."</option>";
			}
		?>
	</select>
</div>
<div class="cosmo-hr" style="margin-bottom: 0px;">&nbsp;</div>
<div id='tabs_settings' class='tab_togle_settings'> 
	<table  id='tabs_tbl' class="sh_code_tbl">
		<tr>
			<td >
				<div>
					<label class="tabs_label" for="nr_tabs">Tabs:</label>
					<select id="nr_tabs">
						<option value=''> Select number of Tabs </option>
						<?php 
							for($i=2;$i<=10;$i++){
								echo "<option value=$i>$i Tabs</option>";
							}
						?>
						
					</select>
				</div>
			</td>
			<td style="padding-left:20px;">
				<div>
					<label class="tabs_label" for="tabber_title">Title:</label>
					<input type="text" id="tabber_title">
				</div>
				
			</td>
		</tr>
		<tr>
			<td colspan=2 id="tabs_title_">
				
			</td>
		</tr>
	</table>
	<div>
		<input type="button" onclick="insertTabs()" id="insert_tabs_btn" value="Insert" class="button-primary">
	</div>	
</div>
<!-- EOF tabs -->
<div id='toggle_setings' style="display:none" class='tab_togle_settings'>
	<?php include 'toggle.php'; ?>
</div>
<!--  EOF Toggle -->

<div id='accordion_settings' style="display: none" class='tab_togle_settings'>
	<table  id='accordion_tbl' class="sh_code_tbl">
		<tr>
			<td >
				<div>
					<label class="tabs_label" for="nr_tabs_accordion">Tabs:</label>
					<select id="nr_tabs_accordion">
						<option value=''> Select number of Tabs </option>
						<?php 
							for($i=2;$i<=15;$i++){
								echo "<option value=$i>$i Tabs</option>";
							}
						?>
						
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan=2 id="tabs_title_accordion">
				
			</td>
		</tr>
	</table>
	<div>
		<input type="button" onclick="insertTabsAccordion()" id="insert_tabs_acc_btn" value="Insert" class="button-primary">
	</div>	
</div>