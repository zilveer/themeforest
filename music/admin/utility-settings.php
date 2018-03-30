<?php
/*
 * Netlabs Admin Framework
 */


//  SUBMIT REDIRECTS FOR SLIDE OPTIONS SAVES	
function ntl_show_utility() {
	
	$ntag = 'utility-settings';
	
	if (isset ( $_GET['action'])) {
	
	if ($_GET['action'] == 'delete'){
		ntl_delete_slide($_GET['id']);
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		wp_redirect(admin_url('admin.php?page=' . $ntag . '&'.$url_parameters));
	}	
	}
	if (isset ( $_POST["ntl-submit"])) {
	if ( $_POST["ntl-submit"] == 'Y' ) {
		ntl_save_utility();
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		wp_redirect(admin_url('admin.php?page=' . $ntag . '&'.$url_parameters));
		exit;
	} 
	}
	if (isset ( $_POST["ntl_addaslide"])) {
	if ( $_POST["ntl_addaslide"] == 'Y' ) {
		if ($_GET['tab'] == 2) {
			ntl_add_slide('bannerlinks');
		} else {
			ntl_add_slide('feedbacks');
		}
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		wp_redirect(admin_url('admin.php?page=' . $ntag . '&'.$url_parameters));
		exit;
	} 
	}
	if (isset ( $_POST["slidesave"])) {
	if ( $_POST["slidesave"] == 'Y' ) {
		ntl_save_utility();
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		$url_parameters .= '&action=edit&slide='. $_POST['postid'];
		wp_redirect(admin_url('admin.php?page=' . $ntag . '&'.$url_parameters));
	} 
	}
	if (isset ( $_POST["ntl-settings-submit"])) {
	if ($_POST["ntl-settings-submit"] == 'Y' ) {		
		ntl_save_tility();
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		wp_redirect(admin_url('admin.php?page=' .  $ntag  .   '&'.$url_parameters));
		exit;
	}
	}
}



// SAVE SCRIPTS FOR THE SLIDE OPTIONS
function ntl_save_utility() {
	global $pagenow;	
	$ntag = 'utility-settings';	
	$settings = get_option( "ntl_theme_settings" );
	
	if ( $_GET['page'] == $ntag ){ 
		if ( isset ( $_GET['tab'] ) )
	        $tab = $_GET['tab']; 
	    else
	        $tab = 1; 

	    switch ( $tab ){
	        case 1 :
			
			$postid = $_POST['postid'];
			update_post_meta($postid, 'option1', $_POST['option1']);
			update_post_meta($postid, 'option2', $_POST['option2']);
			update_post_meta($postid, 'option3', $_POST['option3']);
			
			break; 
			
	        case 2 : 
				
			$postid = $_POST['postid'];
			update_post_meta($postid, 'option1', $_POST['option1']);
			update_post_meta($postid, 'option2', $_POST['option2']);
			update_post_meta($postid, 'option3', $_POST['option3']);				
		
			break;

	    }
	}	
	
	
	$updated = update_option( "ntl_theme_settings", $settings );
}


// DRAW THE SLIDE PAGE
function ntl_draw_utility() {
	
	// GET GLOBAL AND DEFAULT INFO
	global $pagenow;
	$settings = get_option( "ntl_theme_settings" );
	$ntag = 'utility-settings';	
	
	
	// DRAW THE TITLE 
	echo '
		<div class="wrap ntl_wrap">
		<h2 class="appset">' .  get_option('blogname') . ' ' . __('Utility Settings', 'localize') . '</h2>
	';

	// UPDATE SETTINGS
	if ( isset ( $_GET['updated'] )){
	if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>' . __('Utility Updated', 'localize') . '</p></div>';
	}
					
	// DRAW THE MAIN FORM TABS
	if ( isset ( $_GET['tab'] ) ) ntl_draw_tabs($_GET['tab'], 'utility', 'utility-settings'); else ntl_draw_tabs('', 'utility', 'utility-settings');
	
	if ( $pagenow == 'admin.php' && $_GET['page'] == $ntag ){		
				
		if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; else $tab = 1; 			

		switch ( $tab ){
					
			case 1 :					
				ntl_feedback_draw();
			break; 
						
			case 2 : 
				ntl_banner_draw();
			break;			
		}		
	}		
	echo '</div>';	
}

	
	

function ntl_feedback_draw() {
	
	$output = '';
	$ntag = 'utility-settings';
	
	$output .= '	
		<div class="menuouter" style="margin: 20px;"><div id="menu-management-liquid">
		<div id="menu-management">
		<div class="nav-tabs-nav">
		<div class="nav-tabs-arrow nav-tabs-arrow-left" style="display: none;"><a>&laquo;</a>
		</div><div class="nav-tabs-wrapper"><div class="nav-tabs" >	
	';
	
	$args=array(
		'post_type'=>'feedbacks',
		'showposts'=> 10000,
	);	
		
		
	$counter = 0;		
	$a_id = '';
	
	$my_query = new WP_Query($args);
	if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
	
		$b_id = get_the_ID();
		if ((isset ( $_GET['action'] )) && (isset ( $_GET['slide'] )) && ($_GET['action'] == 'edit') && ($_GET['slide'] == 0))	{ $nactive = '';}	else {$nactive = 'nav-tab-active';}	
		if (!isset ( $_GET['action'] )) { $nactive = 'nav-tab-active';} else {$nactive = '';}	
		if ($counter == 0 && !isset ( $_GET['action'] ) ){
			$output .= '<span class="nav-tab nav-tab-active">' . get_the_title()  .   '</span>';
		} 
		if ($counter >= 1 && !isset ( $_GET['action'] ) ){
			$adm_url = admin_url('admin.php?page=' .  $ntag  . '&tab=2&action=edit&amp;slide=' . $b_id);
			$output .= '<a class="nav-tab" href="' . $adm_url  . '">' . get_the_title()  .   '</a>';	
		} 
		if 	((isset ( $_GET['action'] )) && (isset ( $_GET['slide'] )) && ($_GET['action'] == 'edit') && ($_GET['slide'] == $b_id))	{
			$output .= '<span class="nav-tab nav-tab-active">' . get_the_title()  .   '</span>';	
		}
		if 	((isset ( $_GET['action'] )) && (isset ( $_GET['slide'] )) && ($_GET['action'] == 'edit') && ($_GET['slide'] != $b_id))	{
			$adm_url = admin_url('admin.php?page=' .  $ntag  . '&tab=2&action=edit&amp;slide=' . $b_id);
			$output .= '<a class="nav-tab" href="' . $adm_url  . '">' . get_the_title()  .   '</a>';	
		}		
		if (!isset ( $_GET['action'] )) {
			if ($counter == 0){
				$a_id = get_the_ID();
			}
		}
		
		if (isset ( $_GET['action'] )) {
			if ($_GET['slide'] == $a_id){
				$a_id = get_the_ID();
			}
		}				
			
		$counter++;
		
	endwhile;
	else : endif;
	wp_reset_query();
	
	// DRAW THE ADD SLIDESHOW TAB	
	if ($counter >= 1) {
		$adm_url = admin_url('admin.php?page=' .  $ntag  . '&tab=1&action=edit&amp;slide=0');
		if ((isset ( $_GET['action'] )) && (isset ( $_GET['slide'] )) && ($_GET['action'] == 'edit') && ($_GET['slide'] == 0))	{
			$output .= '
				<span class="nav-tab menu-add-new nav-tab-active">
				<abbr title="' . __('Add feedback item', 'localize') . '">+</abbr>				
				</span>
			';
		} else {
			$output .= '
			<a class="nav-tab" href="' . $adm_url   . '">
			<abbr title="' . __('Add feedback item', 'localize') . '">+</abbr>				
			 </a>
			';
		}			
		
	} else {			
		$output .= '
			<span class="nav-tab menu-add-new nav-tab-active">
			<abbr title="' . __('Add feedback item', 'localize') . '">+</abbr>				
			</span>
		';
	}
	
	
	// DRAW THE REMAINING ELEMENTS FOR THE SLIDESHOW TAB AND CLOSE IT
	$output .= '
		</div></div><div class="nav-tabs-arrow nav-tabs-arrow-right" style="display: none;">
		<a>&raquo;</a></div></div>		
		<div class="menu-edit"><div id="nav-menu-header">
		<div id="submit-post"><div class="major_publishing-actions">
	';
	
	
	// IF THERE IS NO SLIDE, OR A SLIDE ARE BEING ADDED					
	if ( (isset ( $_GET['action'] )) && (isset ( $_GET['slide'] )) && ($_GET['action'] == 'edit') && ($_GET['slide'] == 0) || ($counter == 0) ){
		
		$nurl = 'admin.php?page=' . $ntag . '&tab=1';
											
		$output .= '
			<form enctype="multipart/form-data" method="post" action="' . admin_url( $nurl ) . '">
			<label for="menu-name" class="menu-name-label howto open-label" style="margin-top: 20px;">
				<span>' . __('Feedback title', 'localize') . '</span>
				<input type="text" value="" title="' . __('Enter feedback title here', 'localize') . '" class="menu-name regular-text menu-item-textbox" id="menu-name" name="slide-name">
			</label>
		  	<div class="publishing-action">
				<input type="hidden" value="Y" name="ntl_addaslide">
				<input type="submit" value="' . __('Create feedback Item', 'localize') . '" class="button-primary menu-save" id="save_menu_header" name="add_slide" style="margin: 20px 0;">								
		  	</div>
		  	</form>
			<br class="clear">
		  	</div></div></div>
		  	<div id="post-body">
		  		<div id="post-body-content">
		  			<div class="post-body-plain">
		  				<p>' . __('To create a feedback item, give it a name above and click Create feedback Item.', 'localize') . '</p>
					</div>						
				</div><br class="clear" />
			</div>		  
		';
						
	  } else {
	  	
		// ADD THE LINK TO DELETE THE CURRENT SLIDE AND DRAW THE MAIN BODY
	  	if (isset ( $_GET['action'])) {
	  		$del_id = $_GET['slide'];
		} else {
			$del_id = $a_id;
		}
		$nurl = 'admin.php?page=' . $ntag . '&tab=1';
		$output .= '
			<div class="delete-action">
				<a href="' . admin_url( $nurl ) . '&amp;action=delete&amp;id=' . $del_id  . '" class="submitdelete deletion menu-delete">' . __('Delete this feedback', 'localize') . '</a>
			<br class="clear"></div>
			<br class="clear">
		  			</div>
		  		</div>
		  	</div>
		  	<div id="post-body">
		  		<div id="post-body-content">
		  			<div class="post-body-plain">
		';
		 
		// DRAW THE BODY OF THE SLIDESHOW TO ADD
		$output .=  ntl_get_feedbackbody($del_id, 'slidertype1');
		 
		 $output .= '</div></div><br class="clear" /></div>';
	  }


	// CLOSE A LOT OF THINGS
	$output .= '</form></div></div></div></div><div>';
	
	echo $output;
		
}	


	

function ntl_banner_draw() {
	
	$output = '';
	$ntag = 'utility-settings';
	
	$output .= '	
		<div class="menuouter" style="margin: 20px;"><div id="menu-management-liquid">
		<div id="menu-management">
		<div class="nav-tabs-nav">
		<div class="nav-tabs-arrow nav-tabs-arrow-left" style="display: none;"><a>&laquo;</a>
		</div><div class="nav-tabs-wrapper"><div class="nav-tabs" >	
	';
	
	$args=array(
		'post_type'=>'bannerlinks',
		'showposts'=> 10000,
	);		
		
	$counter = 0;		
	$a_id = '';
	
	$my_query = new WP_Query($args);
	if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
	
		$b_id = get_the_ID();
		if ((isset ( $_GET['action'] )) && (isset ( $_GET['slide'] )) && ($_GET['action'] == 'edit') && ($_GET['slide'] == 0))	{ $nactive = '';}	else {$nactive = 'nav-tab-active';}	
		if (!isset ( $_GET['action'] )) { $nactive = 'nav-tab-active';} else {$nactive = '';}	
		if ($counter == 0 && !isset ( $_GET['action'] ) ){
			$output .= '<span class="nav-tab nav-tab-active">' . get_the_title()  .   '</span>';
		} 
		if ($counter >= 1 && !isset ( $_GET['action'] ) ){
			$adm_url = admin_url('admin.php?page=' .  $ntag  . '&tab=2&action=edit&amp;slide=' . $b_id);
			$output .= '<a class="nav-tab" href="' . $adm_url  . '">' . get_the_title()  .   '</a>';	
		} 
		if 	((isset ( $_GET['action'] )) && (isset ( $_GET['slide'] )) && ($_GET['action'] == 'edit') && ($_GET['slide'] == $b_id))	{
			$output .= '<span class="nav-tab nav-tab-active">' . get_the_title()  .   '</span>';	
		}
		if 	((isset ( $_GET['action'] )) && (isset ( $_GET['slide'] )) && ($_GET['action'] == 'edit') && ($_GET['slide'] != $b_id))	{
			$adm_url = admin_url('admin.php?page=' .  $ntag  . '&tab=2&action=edit&amp;slide=' . $b_id);
			$output .= '<a class="nav-tab" href="' . $adm_url  . '">' . get_the_title()  .   '</a>';	
		}		
		if (!isset ( $_GET['action'] )) {
			if ($counter == 0){
				$a_id = get_the_ID();
			}
		}
		
		if (isset ( $_GET['action'] )) {
			if ($_GET['slide'] == $a_id){
				$a_id = get_the_ID();
			}
		}				
			
		$counter++;
		
	endwhile;
	else : endif;
	wp_reset_query();
	
	
	// DRAW THE ADD SLIDESHOW TAB	
	if ($counter >= 1) {
		$adm_url = admin_url('admin.php?page=' .  $ntag  . '&tab=2&action=edit&amp;slide=0');
		if (isset ( $_GET['action'] ) && isset ( $_GET['slide'] ) && ($_GET['action'] == 'edit') && ($_GET['slide'] == 0))	{
			$output .= '
				<span class="nav-tab menu-add-new nav-tab-active">
				<abbr title="' . __('Add bannerlink item', 'localize') . '">+</abbr>				
				</span>
			';
		} else {
			$output .= '
			<a class="nav-tab" href="' . $adm_url   . '">
			<abbr title="' . __('Add bannerlink item', 'localize') . '">+</abbr>				
			 </a>
			';
		}			
		
	} else {			
		$output .= '
			<span class="nav-tab menu-add-new nav-tab-active">
			<abbr title="' . __('Add bannerlink item', 'localize') . '">+</abbr>				
			</span>
		';
	}
	
	
	// DRAW THE REMAINING ELEMENTS FOR THE SLIDESHOW TAB AND CLOSE IT
	$output .= '
		</div></div><div class="nav-tabs-arrow nav-tabs-arrow-right" style="display: none;">
		<a>&raquo;</a></div></div>		
		<div class="menu-edit"><div id="nav-menu-header">
		<div id="submit-post"><div class="major_publishing-actions">
	';
	
	
	// IF THERE IS NO SLIDE, OR A SLIDE ARE BEING ADDED					
	if (isset ( $_GET['action'] ) && isset ( $_GET['slide'] ) && ($_GET['action'] == 'edit') && ($_GET['slide'] == 0) || ($counter == 0) ){
		
		$nurl = 'admin.php?page=' . $ntag . '&tab=2';
											
		$output .= '
			<form enctype="multipart/form-data" method="post" action="' . admin_url( $nurl ) . '">
			<label for="menu-name" class="menu-name-label howto open-label" style="margin-top: 20px;">
				<span>' . __('Bannerlink title', 'localize') . '</span>
				<input type="text" value="" title="' . __('Enter bannerlink title here', 'localize') . '" class="menu-name regular-text menu-item-textbox" id="menu-name" name="slide-name">
			</label>
		  	<div class="publishing-action">
				<input type="hidden" value="Y" name="ntl_addaslide">
				<input type="submit" value="' . __('Create bannerlink Item', 'localize') . '" class="button-primary menu-save" id="save_menu_header" name="add_slide" style="margin: 20px 0;">								
		  	</div>
		  	</form>
			<br class="clear">
		  	</div></div></div>
		  	<div id="post-body">
		  		<div id="post-body-content">
		  			<div class="post-body-plain">
		  				<p>' . __('To create a bannerlink item, give it a name above and click Create bannerlink Item.', 'localize') . '</p>
					</div>						
				</div><br class="clear" />
			</div>		  
		';
						
	  } else {
	  	
		// ADD THE LINK TO DELETE THE CURRENT SLIDE AND DRAW THE MAIN BODY
	  	if (isset ( $_GET['action'] )) {
	  		$del_id = $_GET['slide'];
		} else {
			$del_id = $a_id;
		}
		$nurl = 'admin.php?page=' . $ntag . '&tab=2';
		$output .= '
			<div class="delete-action">
				<a href="' . admin_url( $nurl ) . '&amp;action=delete&amp;id=' . $del_id  . '" class="submitdelete deletion menu-delete">' . __('Delete this bannerlink', 'localize') . '</a>
			<br class="clear"></div>
			<br class="clear">
		  			</div>
		  		</div>
		  	</div>
		  	<div id="post-body">
		  		<div id="post-body-content">
		  			<div class="post-body-plain">
		';
		 
		// DRAW THE BODY OF THE SLIDESHOW TO ADD
		$output .=  ntl_get_bannerlinkbody($del_id, 'slidertype1');
		 
		 $output .= '</div>></div><br class="clear" /></div>';
	  }


	// CLOSE A LOT OF THINGS
	$output .= '</form></div></div></div></div<div>';
	
	echo $output;
		
}	



?>