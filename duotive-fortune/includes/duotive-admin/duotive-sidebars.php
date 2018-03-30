<?php
//CREATE DATABASE
	//CREATE FUNCTION
	function create_db3 () {
		global $wpdb;
		$create_query = 'CREATE TABLE `'.$wpdb->prefix.'dt-sidebars` (
							`ID` INT NOT NULL AUTO_INCREMENT ,
							`NAME` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
							`DESCRIPTION` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
							PRIMARY KEY ( `ID` )
						) ENGINE = MYISAM ;
						';
		$create = $wpdb->get_results($create_query);
	}
	//CHECK FUNCTION
	global $wpdb;
	if ( check_db_existance($wpdb->prefix.'dt-sidebars') == '') create_db3();
	//INSERT FUNCTION
	function check_sidebar_existance($name) {
		global $wpdb;		
		$sidebar_existance_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-sidebars` WHERE NAME="'.$name.'"';	
		$sidebar_existance = $wpdb->get_results($sidebar_existance_query);
		if ( isset( $sidebar_existance[0]->NAME ) ) return 1;
		else return 0;		
	}
	function insert_sidebar_in_db( $name='no-title',$description='no-text') {
			if ( check_sidebar_existance($name) == 0 )
			{
				global $wpdb;
				$name = preg_replace("/[^a-zA-Z0-9\s]/", "", $name);
				$description = preg_replace("/[^a-zA-Z0-9\s]/", "", $description);				
				$insert_query = "INSERT INTO `".$wpdb->prefix."dt-sidebars` (`ID`, `NAME`, `DESCRIPTION`) VALUES ('NULL', '".$name."', '".$description."');";
				$insert = $wpdb->get_results($insert_query);
			}
	}	
	//DELETE SIDEBAR FORM DB
	function delete_sidebar($id) {
		global $wpdb;			
		$delete_query = 'DELETE FROM `'.$wpdb->prefix.'dt-sidebars` WHERE ID="'.$id.'" LIMIT 1';	
		$wpdb->get_results($delete_query);	
	}	
	//GET PORTFOLIO PAGES FORM DB
	function sidebars_require () {
		global $wpdb;		
		$portfolio_require_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-sidebars` ORDER BY ID ASC';	
		$portfolio_require = $wpdb->get_results($portfolio_require_query);
		return $portfolio_require;
	}	
function sidebars_admin_menu() 
{
	// ADD THE FPM OPTIONS PAGE TO ADMIN SIDEBAR
	add_submenu_page( 'duotive-panel', 'Duotive Sidebars', 'Sidebars', 'manage_options', 'duotive-sidebars', 'sidebars_page');
}

function sidebars_page() 
{
	// THE ACTUAL OPTIONS PAGE
?>	
    <?php if(isset($_POST['name']) && $_POST['name'] != '') : ?>
		<?php if(isset($_POST['name']) && $_POST['name'] != '') $name =  $_POST['name'];  ?>
        <?php if(isset($_POST['description'])) $desc = $_POST['description']; else $desc = 'Sidebar created by duotive sidebar generator.'; if ( $desc == '' ) $desc = 'Sidebar created by duotive sidebar generator.';  ?> 
        <?php if(isset($_POST['name'])) insert_sidebar_in_db($name,$desc); ?>
        <?php if(isset($_GET['delete'])) delete_sidebar($_GET['delete']); // IF CALLED DELETES A SIDEBAR ?>    
    <?php endif; ?>
    <?php if(isset($_GET['delete'])) delete_sidebar($_GET['delete']); // IF CALLED DELETES A SIDEBAR ?>        
<div id="dialog" title="Confirmation Required" style="display:none;">
  You are about to delete a sidebar. Continue?
</div>      
<div class="wrap">
	<?php $warnings = dt_AdminWarnings(); ?>
    <?php if ($warnings != '' ): ?>
        <div class="page-error page-error-extra-margin">
            <?php echo $warnings; ?>
        </div>
    <?php endif; ?>
    <div id="duotive-logo"><span class="color">Duotive</span> Admin Panel <sup>v2</sup></div>
    <div id="duotive-main-menu">
        <ul>
            <li><a href="admin.php?page=duotive-panel">General settings</a></li>
            <li><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
            <li><a href="admin.php?page=duotive-slider">Slideshow</a></li>
            <li class="active"><a href="admin.php?page=duotive-sidebars">Sidebars</a></li>
			<li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li> 
			<li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
			<li><a href="admin.php?page=duotive-pricing-table">Pricing</a></li>
            <li><a href="admin.php?page=duotive-contact">Contact page</a></li>
            <li><a href="admin.php?page=duotive-language">Language</a></li>                                                                                  
        </ul>
    </div>
    <div id="duotive-admin-panel">
    <h3>Sidebars</h3>
    <ul class="ui-tabs-nav">
        <li><a href="#sidebars">Current sidebars</a></li> 
        <li class="plus"><a class="plus" href="#addsidebar"><span class="deco"></span>Add a new sidebar</a></li>         
	</ul>                   
        <div id="sidebars" class="ui-tabs-panel">
			<?php $sidebars = sidebars_require();?>
            <?php if ( count($sidebars) > 0 ): ?>
                <table cellpadding="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th align="center">Delete</th>                                        
                        </tr>
                    </thead>
                    <tbody>  
                        <?php $i = 0; ?>
                        <?php foreach ( $sidebars as $sidebar): ?>
                            <tr <?php if ( $i%2 == 0 ) echo ' class = "alternate"'; ?>>
                                <td align="center">
                                    <?php echo $sidebar->NAME; ?>
                                </td>
                                <td align="center">
                                    <?php echo $sidebar->DESCRIPTION; ?>
                                </td>
                                <td align="center">
                                    <a class="delete confirmLink" title="Delete Sidebar" href="?page=duotive-sidebars&delete=<?php echo $sidebar->ID; ?>">DELETE</a> 
                                </td>
                            </tr>
                        <?php $i++; ?>  
                        <?php endforeach; ?>                                                                     
                    </tbody>            
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Delete</th>                                        
                        </tr>
                    </tfoot>     
                </table> 
			<?php else: ?>
                <div class="page-error">There aren't any custom sidebars added yet.</div>                            
            <?php endif; ?>               
        </div>
        <div id="addsidebar" class="ui-tabs-panel">
            <form action="" method="post" class="transform">
                <div class="table-row clearfix">
                    <label for="name">Sidebar name:</label>
                    <input size="50" name="name" type="text"  />
                </div>
                <div class="table-row clearfix">
                    <label for="description">Sidebar description:</label>
                    <textarea class="fullwidth" name="description" cols="50" rows="4"></textarea>
                </div>
                <div class="table-row table-row-last clearfix">
                    <input type="submit" value="Add sidebar" class="button" />	
                </div>	          
            </form>
        </div>        
    </ul>
    </div>
</div>
<?php
}

function sidebars_update()
{
}
add_action('admin_menu', 'sidebars_admin_menu');
function custom_sidebars_initialization() { 

} ?>
<?php add_action( 'widgets_init', 'custom_sidebars_initialization' );?>