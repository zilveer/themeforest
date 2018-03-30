<?php 
	/*for simple shortcodes that have no parameters like [hr],[devider] - set as value the shortcode itself,
	 * But for shortcodes that have parameters -  set as value 'type_'+name of the shortcode,  then add a hidden div like was done for
	 * 'type_list' nad 'type_quote'
	 * 
	 * */
	$divider_types =array('Horizntal Rule'=>'[hr]','Divider'=>'[divider]','Highlight' =>'[highlight][/highlight]','Dropcap' => '[dropcap][/dropcap]','Quote'=>'type_quote','Lists'=>'type_list');
?>

<table class="sh_code_tbl">
	<tr>
		<td class="label_td fl_r">
			<label>Select Type:</label>
		</td>
		<td>
			<select id="typography_type">
				<?php 
					foreach ($divider_types as $divider) {
						echo "<option value='$divider'>".array_search($divider,$divider_types)."</option>";
					}
				?>
			</select>
		</td>
	</tr>
</table>
<div id="default_insert_btn_area">
	<input type="button" class="button-primary" value='Insert' id='insert_devider_btn' onclick='insertSimple()'>
</div>
<div id="type_quote" class="typography_more_settings" style="display: none;">
	<?php 
		include 'quote.php';
	?>
</div>
<div id="type_list" class="typography_more_settings" style="display: none;">
	<?php 
		include 'list.php';
	?>
</div>