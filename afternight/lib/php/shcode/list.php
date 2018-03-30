<?php 
	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/shcode.php */
	$ol_styles = array(	'decimal', 'armenian',	'decimal-leading-zero',	'georgian','lower-alpha',	'lower-greek',	'lower-latin',	'lower-roman',	'upper-alpha',	'upper-latin',	'upper-roman');
	$ul_styles = array('bullet','arrow','star','cancel','tick');
?>

<table class="sh_code_tbl" id="tbl_list">
	<tr>
		<td class="label_td fl_r"> 
			<label for='list_type'>List Type:</label>
		</td>
		<td>
			<select id="list_type">
				<option value="ordered_list">Ordered List</option>
				<option value="unordered_list">Unordered List</option>
			</select>
		</td>
		<td class="label_td fl_r" style="padding-left: 20px;"> 
			<label>Preview </label>
		</td>
		<td width=275px>
			
			<div class="cosmo-orderedlist <?php echo $ol_styles[0] ?>" id="ordered_sample">
				<ol>
					<li>Here goes the list item</li>
				</ol>
			</div>
			
			<div class="cosmo-unorderedlist <?php echo $ul_styles[0] ?>" id="unordered_sample" style="display: none">
				<ul>
					<li>Here goes the list item</li>
				</ul>
			</div>
		</td>
	</tr>
	<tr>
		<td class="label_td fl_r">
			<label for="list_style">List Style:</label>	
		</td>
		<td>
			<select id="ordered_list" style="width:100px;"> 
				<?php 
				foreach ($ol_styles as $list_style) {
					
					echo "<option value='$list_style'>$list_style</option>";
				}	
				?>
			</select>
			
			<select id="unordered_list" style="display: none; width:100px;">
				<?php 
				foreach ($ul_styles as $list_style) {
					
					echo "<option value='$list_style'>$list_style</option>";
				}	
				?>
			</select>
		</td>
		<td colspan=2>
			&nbsp;
		</td>
	</tr>
</table>
<div>
	<a class="button" onclick="setDefault();" href="javascript:void(0);" style="margin-left:5px;">Reset</a>
	<input type="button" class="button-primary" value='Insert' id='insert_list' onclick='insertList()'>
</div>
<br/>
<span class="hint" style="margin: 10px 20px">
	<?php echo __( 'Note! After inserting the shortcode, a list will be made available for entering list items. Press "ENTER" to create a new item.', 'cosmotheme' );?>
</span>