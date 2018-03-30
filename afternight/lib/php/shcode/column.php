<table width=100% class="sh_code_tbl">
	<tr>
		<td width=10% class="label_td fl_r">
			<label>Columns:</label>
		</td>
		<td width=90%>
			<select id='nbr_col' name='nbr_col'>
				<option value=''>Select number of columns</option>
				<option value='2'>2 columns</option>
				<option value='3'>3 columns</option>
				<option value='4'>4 columns</option>
				<option value='5'>5 columns</option>
			</select>
		</td>
	</tr>
	<tr>
		<td></td>
		<td id='col_samples'>
			
		</td>
	</tr>
	<tr>
		<td>
		
		</td>
		<td>
			<div id="demo_box" style="display:none">
				<div id='col_show'></div>
				<div class="btn_remove">
					<input type="button" class="button" value='<- Remove' id='remove_btn' onclick='removeLastCols()'>
				</div>	
				<div class="btn_add">
					<input type="button" class="button-primary" value='Insert' id='insert_btn' onclick='insertCols()'>
				</div>
			</div>
		</td>
	</tr>
</table>
