<?php

 
?>  
    <div class="wrap">  
        <div id="icon-users" class="icon32"><br></div>
        <h2>Sidebar Manager</h2>  
        <form action="options.php" method="post">  
            <?php wp_nonce_field('update-options') ?>  
            <?php
			
			$themename = "sp";
			// Retrieve theme options  
			$opts = sidebarmanager_get_options();  
		  
			// A bit of jQuery to handle interactions (add / remove sidebars)  
			$output = "<script type='text/javascript'>";  
			$output .= ' 
						var $ = jQuery; 
						$(document).ready(function(){ 
							$(".sidebar_management").on("click", ".delete", function(){ 
								$(this).parents(".menu-item").fadeOut(300, function() { $(this).remove(); }); 
							}); 
		 
							$("#add_sidebar").click(function(){ 
								var new_item = $("<li style=\'display:none\' class=\'menu-item\'><dt class=\'menu-item-bar\'><dt class=\'menu-item-handle\'><h3>"+$("#new_sidebar_name").val()+"</h3><span class=\'item-controls\'><a href=\'#\' class=\'delete delete-sidebar\'>Delete</a></span><input type=\'hidden\' name=\'sidebarmanager_options[custom_sidebar][]\' value=\'"+$("#new_sidebar_name").val()+"\' /></dt></dt></li>").hide();
								$(".sidebar_management ul").append(new_item); 
								new_item.show("slow");
								$("#new_sidebar_name").val("");  
							})  
		  
						})  
			';  
		  
			$output .= "</script>";  
		  	if($_GET['settings-updated']){
		  	$output .= '<br><div id="message" class="updated below-h2" style="width:396px;"><p>Sidebars have been saved. <a href="widgets.php" data-bitly-type="bitly_hover_card">View widgets</a></p></div>';
			};
			$output .= "<div class='sidebar_management'>";
			
			$output .= "<ul class='menu ui-sortable'>";  
		  
			// Display every custom sidebar  
			if(isset($opts['custom_sidebar']))  
			{  
				$i = 0;  
				foreach($opts['custom_sidebar'] as $sidebar)  
				{  
					$output .= "<li class='menu-item'><dt class='menu-item-bar'><dt class='menu-item-handle'><h3>".$sidebar."</h3><span class='item-controls '><a href='#' class='delete delete-sidebar'>Delete</a></span><input type='hidden' name='sidebarmanager_options[custom_sidebar][]' value='".$sidebar."' /></dt></dt></li>";  
					$i++;  
				}  
			}  
		  
			$output .= "</ul>";  
			$onfocus = 'onfocus=\'if (this.value == \'Sidebar name\') {this.value = \'\';}\' onblur=\'if (this.value == \'\') {this.value = \'Sidebar name\';}\'';
			$output .= '<p><input type="text" value="Sidebar name" onfocus="if (this.value == \'Sidebar name\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Sidebar name\';}" id="new_sidebar_name" /> <input class="button-secondary" type="button" id="add_sidebar" value="Add new sidebar" /></p>';  
		  
			$output .= "</div>";  
		  
			echo $output;  
			
			?> 
            <p><input type="submit" name="Submit" class="button-primary" value="Save Sidebars" /></p>  
            <input type="hidden" name="action" value="update" />  
            <input type="hidden" name="page_options" value="sidebarmanager_options" />  
        </form>  
    </div>  
<?php  
  

