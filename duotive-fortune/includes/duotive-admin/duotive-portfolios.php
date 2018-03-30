<?php
//CREATE CUSTOM POST TYPE
	//ADD NEW POST TYPE
	add_action('init', 'project_custom_init');
	function project_custom_init()
	{
	  $labels = array(
		'name' => 'Projects', 'post type general name',
		'singular_name' => 'Projects', 'post type singular name',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Project',
		'edit_item' => 'Edit Project',
		'new_item' => 'New Project',
		'view_item' => 'View Project',
		'search_items' => 'Search Projects',
		'not_found' => 'No projects found',
		'not_found_in_trash' => 'No projects found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Projects'
	
	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-item'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => get_template_directory_uri().'/includes/duotive-admin/ico-portfolio.png',
		'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	  );
	  register_post_type('project',$args);
	}
	//CREATE MESSAGES
	add_filter('post_updated_messages', 'project_updated_messages');
	function project_updated_messages( $messages ) {
	  global $post, $post_ID;
	
	  $messages['project'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( 'Project updated. <a href="%s">View project</a>', esc_url( get_permalink($post_ID) ) ),
		2 => 'Custom field updated.',
		3 => 'Custom field deleted.',
		4 => 'Project updated.',
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( 'Project restored to revision from %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( 'Project published. <a href="%s">View project</a>', esc_url( get_permalink($post_ID) ) ),
		7 => 'Project saved.',
		8 => sprintf( 'Project submitted. <a target="_blank" href="%s">Preview project</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( 'Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>',
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( 'Project draft updated. <a target="_blank" href="%s">Preview project</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	
	  return $messages;
	}	
	//CREATE TAXONOMIES
	
	// Initialize New Taxonomy Labels
	  $labels = array(
		'name' => 'Portfolios', 'taxonomy general name',
		'singular_name' => 'Portfolio', 'taxonomy singular name',
		'search_items' =>  'Search Types',
		'all_items' => 'All Portfolios',
		'parent_item' => 'Parent Portfolio',
		'parent_item_colon' => 'Parent Portfolio:',
		'edit_item' => 'Edit Portfolios',
		'update_item' => 'Update Portfolio',
		'add_new_item' => 'Add New Portfolio',
		'new_item_name' => 'New Portfolio Name',
	  );
	// Custom taxonomy for Project Tags
	register_taxonomy('portfolio',array('project'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'has_archive' => true,
		'rewrite' => true,
	  ));	
	  
//CREATE DATABASE
	//CREATE FUNCTION
	function create_db_portfolios () {
		global $wpdb;
		$create_query = 'CREATE TABLE `'.$wpdb->prefix.'dt-portfolio` (
							`ID` INT NOT NULL AUTO_INCREMENT ,
							`PAGE` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
							`CATEGORY` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
							`ITEMS` TEXT NOT NULL,
							PRIMARY KEY ( `ID` )
						) ENGINE = MYISAM ;
						';
		$create = $wpdb->get_results($create_query);
	}
	//CHECK FUNCTION
	global $wpdb;
	if ( check_db_existance($wpdb->prefix.'dt-portfolio') == '') create_db_portfolios();
	function insert_portfolio_in_db( $page='no-title',$category='no-text',$items='-1') {
			global $wpdb;
			if ( is_array($category)):
				$category_to_insert = '';
				$array_lenght = sizeof($category);						
				$i = 1;
				foreach($category as $cat):
					if ( $i < $array_lenght ) $category_to_insert .= $cat.', ';
					else $category_to_insert .= $cat;
					$i++;
				endforeach;
			else:
				$category_to_insert = $category;
			endif;
			$insert_query = "INSERT INTO `".$wpdb->prefix."dt-portfolio` (`ID`, `PAGE`, `CATEGORY`,`ITEMS`) VALUES ('', '".$page."', '".$category_to_insert."','".$items."');";
			$insert = $wpdb->get_results($insert_query);
	}	
	//GET PORTFOLIO PAGES FORM DB
	function portfolio_require () {
		global $wpdb;		
		$portfolio_require_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-portfolio` ORDER BY ID ASC';	
		$portfolio_require = $wpdb->get_results($portfolio_require_query);
		return $portfolio_require;
	}
	//DELETE PORTFOLIO PAGES FORM DB
	function delete_portfolio($id) {
		global $wpdb;			
		$delete_query = 'DELETE FROM `'.$wpdb->prefix.'dt-portfolio` WHERE ID="'.$id.'" LIMIT 1';	
		$wpdb->get_results($delete_query);	
	}	
	// ADD THE PORTFOLIO OPTIONS PAGE TO ADMIN
	function portfolio_admin_menu() 
	{
		add_submenu_page( 'duotive-panel', 'Duotive Portfolio Options', 'Portfolios', 'manage_options', 'duotive-portfolios', 'portfolio_page');
	}

	function portfolio_page() 
	{
	
		if ( isset($_POST['portfolio_update']) && $_POST['portfolio_update'] == 'true' ) { portfolio_update(); }
		
?>
	<?php $categories = ''; $pages = ''; ?>
	<?php if(isset($_POST['categories'])) $categories = $_POST['categories']; ?>
    <?php if(isset($_POST['pages'])) $pages = $_POST['pages']; ?>
    <?php if(isset($_POST['items'])) $items = $_POST['items']; ?>
    <?php if( $categories != '' && $pages != '' && $items != '' ) { insert_portfolio_in_db($pages,$categories,$items); } ?>   
<div id="dialog" title="Confirmation Required" style="display:none;">
  You are about to delete a portfolio. Continue?
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
            <li><a href="admin.php?page=duotive-sidebars">Sidebars</a></li> 
            <li class="active"><a href="admin.php?page=duotive-portfolios">Portfolios</a></li> 
			<li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
			<li><a href="admin.php?page=duotive-pricing-table">Pricing</a></li>
            <li><a href="admin.php?page=duotive-contact">Contact page</a></li>
            <li><a href="admin.php?page=duotive-language">Language</a></li>                       
        </ul>
    </div>
    <div id="duotive-admin-panel">
    	<h3>Portfolios</h3>
        <ul class="ui-tabs-nav">
            <li><a href="#portfolios">Current portfolios</a></li>
            <li class="plus"><a class="plus" href="#addportfolio"><span class="deco"></span>Add a new portfolio</a></li>            
        </ul>
        <div id="portfolios" class="ui-tabs-panel">
            <?php if(isset($_GET['delete']) && $_GET['delete'] != '') delete_portfolio($_GET['delete']); // IF CALLED DELETES A SLIDE BY ID ?>		        
			<?php $portfolios = portfolio_require();?>
            <?php if ( count($portfolios) > 0 ): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Category IDs</th>
                            <th>Page</th>
                            <th>Items/paage</th>                            
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 0; ?>
                        <?php foreach ( $portfolios as $portfolio): ?>
                        <tr <?php if($counter%2 == 0 ) echo ' class="alternate"'; ?>>
                            <td>
                             <?php echo $portfolio->CATEGORY; ?>
                            </td>
                            <td>
                                <?php echo $portfolio->PAGE; ?>
                            </td>
                            <td>
                                <?php echo $portfolio->ITEMS; ?>
                            </td>                            
                            <td align="center">
                                <a class="delete confirmLink" title="Delete Portfolio Item" href="?page=duotive-portfolios&delete=<?php echo $portfolio->ID; ?>#portfolios">DELETE</a> 
                            </td>
                        </tr>
                        <?php $counter++; ?>
                        <?php endforeach; ?>                    
                    </tbody>
                    <tfoot>
	                    <tr>
                            <th>Category IDs</th>
                            <th>Page</th>
                            <th>Items/page</th>                            
                            <th>Delete</th>
                        </tr>
                    </tfoot>                      
                </table>
			<?php else: ?>
            	<div class="page-error">There aren't any portfolios added yet.</div>              
			<?php endif; ?>         
        </div>
        <div id="addportfolio" class="ui-tabs-panel">
            <form method="POST" action="#addportfolio" class="transform">
                <div class="table-row clearfix">
                	<label>Select categories:</label>
					<?php 
                    $categories = get_categories(array('taxonomy' => 'portfolio'));
                    echo '<ul class="categories">';								
						foreach($categories as $category):
							echo '<li>';
								echo '<input type="checkbox" name="categories[]" value="'.$category->cat_ID.'">';
								echo $category->name; 									
							echo '</li>';										
						endforeach;
                    echo '</ul>';								
                    ?>  
                </div>
                <div class="table-row clearfix">
                	<label for="pages">Page to deploy to:</label>
                    <select name="pages">  
						<?php 
							global $wpdb;
							$page_query = "SELECT ID,post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_title != 'Auto Draft' AND post_status != 'trash' ORDER BY post_title ASC ";
							$pages = $wpdb->get_results($page_query);
							foreach ( $pages as $page ):
								echo '<option value="'.$page->ID.'" >'.get_the_title($page->ID).'</option>';					
							endforeach;
                        ?>
                    </select>                 
                </div>
                <div class="table-row clearfix">
                	<label>Number of items/page:</label>
                    <input type="text" size="3" id="items" name="items" value="" />                                      
                </div>                
                <div class="table-row table-row-last  clearfix">
                	<input type="submit" class="button" value="Add portfolio"/>
                </div>
            </form>        
        </div>
    </div>    
</div>	           
<?php
	}

add_action('admin_menu', 'portfolio_admin_menu');

?>
