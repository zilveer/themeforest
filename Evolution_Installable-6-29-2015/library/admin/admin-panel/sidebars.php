<?php

function sidebars(){
	?>
	<script>
		function remove_sidebar_link(name,num){
			answer = confirm("Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar.");
			if(answer){
				//alert('AJAX REMOVE');
				remove_sidebar(name,num);
				jQuery('#messages').html('<div class="success-message"><p>Sidebar successfully removed.</p></div>').show('normal');
			}else{
				return false;
			}
		}
		function add_sidebar_link(){
			var sidebar_name = jQuery('#add-sidebar').val();
			if(sidebar_name.length > 0)
			{
				add_sidebar(sidebar_name);
				jQuery('#add-sidebar').val('');
				jQuery('#messages').html('<div class="success-message"><p>Sidebar successfully created.</p></div>').show('normal');
			}
		}
	</script>
	
	<div id="header">
        <div id="logo-container">
			<h1><img src="<?php echo get_template_directory_uri()?>/library/admin/images/main_logo.png" alt="Evolution" /></h1>		
        </div>	
        <div id="admin-panel">
            <p>Administration Panel</p>
        </div>       
        <div class="clear"></div>
	</div>
	<div class="wrap alc_wrap" style="padding:10px">
	<div id="messages" style="display:none"></div>
		<div id="main_wrap">
			<div class="alc_opts">	
				<h3 class="tg-title" style="padding-top:0px; color:#333">Sidebar Generator</h3>
				<p>
					The sidebar name is for your use only. It will not be visible to any of your visitors. 
					A CSS class is assigned to each of your sidebar, use this styling to customize the sidebars.
				</p>
				<br />
				<div class="add_sidebar">
					<form method="POST" action="" id="sidebar-form" onsubmit="add_sidebar_link(); return false;">
						<label for="add-sidebar" style="float:none">Create a new sidebar</label>
						<input type="text" id="add-sidebar" style="height:30px"  />
						<a href="javascript:void(0);" class="alc-button medium" onclick="return add_sidebar_link()" title="Add a sidebar">Create</a>
					</form>
				</div>
				<br />
				<table class="list-table" id="sbg_table" >
					<tr>
						<th>Name</th>
						<th>CSS class</th>
						<th style="width:80px; text-align:center">Remove</th>
					</tr>
					<?php
					$sidebars = sidebar_generator::get_sidebars();
					//$sidebars = array('bob','john','mike','asdf');
					if(is_array($sidebars) && !empty($sidebars)){
						$cnt=0;
						foreach($sidebars as $sidebar){
							$alt = ($cnt%2 == 0 ? 'alternate' : '');
					?>
					<tr class="<?php echo $alt?>">
						<td><?php echo $sidebar; ?></td>
						<td><?php echo sidebar_generator::name_to_class($sidebar); ?></td>
						<td style="text-align:center"><a href="javascript:void(0);" class="alc-button red-back medium" onclick="return remove_sidebar_link('<?php echo $sidebar; ?>',<?php echo $cnt+1; ?>);" title="Delete">Delete</a></td>
					</tr>
					<?php
							$cnt++;
						}
					}else{
						?>
						<tr>
							<td colspan="3">No Sidebars defined</td>
						</tr>
						<?php
					}
					?>
				</table>
				<br /><br />
				
			</div>
		</div>
	</div>
	<?php
}
	

