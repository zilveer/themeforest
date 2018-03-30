<?php

// Get value from wordpress option
$smooththemes_sidebar = get_option('smooththemes_sidebar',true);
if(!is_array($smooththemes_sidebar)){
	$smooththemes_sidebar = array();
}
?>
<style type="text/css">
	.hide{display:none}
	.sidebar_temp{display:none}
	td.action div{min-height:30px;}
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
        jQuery('#new_sidebar').hide(); // Hide sidebar_input by default
        jQuery('.add_new_sidebar').click(function(){
            jQuery('#new_sidebar').fadeIn('slow'); // show new_sidebar input section when click
            return false;
        });
        jQuery('.cancel_sidebar').click(function(){
            jQuery('#new_sidebar').fadeOut('slow'); // Hide new_sidebar input section when button cancel is click;
            return false;
        });
        jQuery('.sidebar_row .edit_sidebar').click(function(){
            var p = jQuery(this).parents('.sidebar_row');
            var sname = p.find('.sname').text();
            var scss_class = p.find('.scss_class').text();
            var id = p.attr('id');
            id = id.split('_',2)[1];
            p.find('.s_display').hide();
            p.find('.old_action').hide().end().find('.new_action').show();
            p.find('.sinput_name').val(sname).show().attr('name','sidebar[old]['+id+'][name]');
            p.find('.sinputcss_class').val(scss_class).show().attr('name','sidebar[old]['+id+'][css_class]');;
            return false;
        });
        jQuery('.sidebar_row .cancel_now').click(function(){
            var p=jQuery(this).parents('.sidebar_row');
             p.find('.s_display').show();
             p.find('.old_action').show().end().find('.new_action').hide();
             p.find('.sinput_name, .sinputcss_class').hide().attr('name','').attr('value','');
             return false;
        });
        
        // Edit an Element
        jQuery('.sidebar_row .save_now').click(function(){
            var obj = jQuery(this);
            var p = jQuery(this).parents('.sidebar_row');
            //alert(p.html());
            var sname = p.find('.sinput_name').val();
            var scss_class = p.find('.sinputcss_class').val();
            var id = p.attr('id');
            id = id.split('_',2)[1];
            if(sname == ''){
                alert('Please enter a sidebar name');
                return false;
            }
            var data = 'id='+id+'&st_sidebar_do=edit&name='+sname+'&unique_css_class='+scss_class+'&action=st_sidebar_generator&rand='+(new Date().getTime());
            jQuery.ajax({
                type : "POST",
                url : ajaxurl,
                data : data,
                dataType : "json",
                success : function(json){
                    if(json == 1){
                        p.find('.sname').text(sname);
                        p.find('.scss_class').text(scss_class);
                        p.find('.s_display').show();
                        p.find('.old_action').show().end().find('.new_action').hide();
                        p.find('.sinput_name, .sinputcss_class').hide().attr('name','').attr('value','');
                    }
                }
            });

        });

        // Add new ELEMENT
        jQuery("#new_sidebar .save_sidebar").click(function(){
            var p = jQuery(this).parents('#new_sidebar');
            var sname = jQuery('#new_sidebar .sidebar_name').val();
            var scss_class = jQuery('#new_sidebar .sidebar_css_class').val();
            if(sname == ''){
                alert('Please enter sidebar name');
                return false;
            }
            var data = 'st_sidebar_do=add&name='+sname+'&unique_css_class='+scss_class+'&action=st_sidebar_generator&rand='+(new Date().getTime());
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: data,
                dataType: "json",
                success: function(json){
                    //alert(json);
                    if(json==1){
                        window.location='<?php echo $_SERVER['REQUEST_URI'] ?>';
                    }
                }
            });
            //alert(data);
            return false;
        });

        // Delete Element
        jQuery('.sidebar_row .submitdelete').click(function(){
            var p=jQuery(this).parents('.sidebar_row');
            var id= p.attr('id');
            id=id.split('_',2)[1];
            //alert(id);

            var data = 'id='+id+'&st_sidebar_do=delete&action=st_sidebar_generator&rand='+(new Date().getTime());
               jQuery.ajax({
                   type: "POST",
                   url: ajaxurl,
                   data: data,
                   dataType: "json",
                   success: function(json){
                     //alert(json);
                     if(json==1){
                        p.remove();
                     }
                   }
                 });
            return false;   
        });


	});
</script>


<!-- // The HTML output -->
<div class="wrap">
    <div class="icon32" id="icon-options-general"><br></div>
    <h2>SmoothThemes Sidebar Generator</h2>
    <br />
    <div class="ks_action_bt" style="margin-bottom:10px;">
    	<a href="#" class="add_new_sidebar button-secondary">Add New Sidebar</a>
    </div>

    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    	<table cellspacing="0" class="wp-list-table widefat fixed posts" style="width:80%">
    		<thead>
    			<tr>
 					<th style="" class="manage-column" id="title" scope="col">Sidebar Name</th>
                    <th style="" class="manage-column" id="author" scope="col">Unique Sidebar Class</th>
                    <th>ShorCode</th>
                    <th class="manage-column" rowspan="" headers="" scope="col">Action</th>
                    
    			</tr>
    		</thead>
            <tfoot>
                <tr>
                    <th style="" class="manage-column" id="title" scope="col">Sidebar Name</th>
                    <th style="" class="manage-column" id="author" scope="col">Unique Sidebar Class</th>
                    <th>ShorCode</th>
                    <th class="manage-column" rowspan="" headers="" scope="col">Action</th>
                </tr>
            </tfoot>
            <tbody id="the-list">
                <?php foreach ($smooththemes_sidebar as $st_sidebar => $sidebar) { ?>
                    <tr valign="top" class="sidebar_row alternate author-self status-draft format-default iedit" id="sidebar_<?php echo $st_sidebar; ?>">
                        <td class="sidebar_name page-title column-sidebar_name">
                            <strong class="s_display sname"><?php echo $sidebar['title']; ?></strong>
                            <input type="text" class="sinput_name hide" name="" value="" placeholder="">
                        </td>
                        <td class="css_class column-css_class">
                            <span class="s_display scss_class"><?php echo $sidebar['unique_css_class'] ?></span>
                            <input type="text" class="sinputcss_class hide" name="" value="" placeholder="">
                        </td>
                        <td>
                            <code><?php echo "[st-sidebar  name=\"".htmlspecialchars($sidebar['title'])."\"]"; ?></code>
                        </td>
                        <td class="action column-action">
                            <div class="old_action">
                                <span class="edit"><a href="#" class="edit_sidebar" title="Edit">Edit</a></span>
                                <span class="trash"><a class="submitdelete" href="#" title="Delete">Delete</a></span>
                            </div> <!-- / old_action -->
                            <div id="" class="new_action hide">
                                <a href="#" title="Save" class="save_now button-primary">Save</a>
                                <a href="#" title="Cancel" class="cancel_now button-secondary">Cancel</a>
                            </div><!-- / -->
                        </td>
                    </tr>       
                <?php } // end foreach?>
                <tr valign="top" id="new_sidebar" class="alternate author-self status-draft format-default iedit">
                    <td class="post-title page-title column-name">
                        <input type="text" name="" value="" placeholder="" class="sidebar_name">
                    </td>
                    <td class="author column-code">
                        <input type="text" class="sidebar_css_class" name="" value="" placeholder="">
                    </td>
                    <td class="action column-action">
                        <a href="#" class="save_sidebar button-primary" title="">Save</a>
                        <a href="#" class="cancel_sidebar button-primary" title="">Cancel</a>
                    </td>
                </tr>
            </tbody>
    	</table>
    </form>
    <div id="" class="ks_action_bt" style="margin-top: 10px">
        <a href="#" class="add_new_sidebar button-secondary" title="">Add New Sidebar</a>
    </div><!-- / -->
    <br />
    <span class="description">You can create additional sidebars to use.To display your new sidebar then you will need to select it in the "Custom Sidebar" dropdown when editing a post or page.</span>
</div><!--/ end WRAP -->
