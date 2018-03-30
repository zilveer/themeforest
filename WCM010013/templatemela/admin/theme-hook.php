<?php
//============================================general settings ===================================================================
$options1 = array(array());

$options1[] = array("id" => "templatemela_header",
					"label" => "templatemela header",
					"type" => "textarea",
					"description" => "Executed the .header DIV tag.");
$options1[] = array("id" => "templatemela_header_before",
					"label" => "templatemela header before",
					"type" => "textarea",
					"description" => "Executed before the .header DIV tag.");	
$options1[] = array("id" => "templatemela_header_inside",
					"label" => "templatemela header inside",
					"type" => "textarea",
					"description" => "Executed inside the .header DIV tag.");
$options1[] = array("id" => "templatemela_header_after",
					"label" => "templatemela header after",
					"type" => "textarea",
					"description" => "Executed after the .header DIV tag.");
$options1[] = array("id" => "templatemela_main_before",
					"label" => "templatemela main before",
					"type" => "textarea",
					"description" => "Executed at before #main ID tag.");										
$options1[] = array("id" => "templatemela_content_before",
					"label" => "templatemela content before",
					"type" => "textarea",
					"description" => "Executed at before content DIV tag.");	
$options1[] = array("id" => "templatemela_content_after",
					"label" => "templatemela content after",
					"type" => "textarea",
					"description" => "Executed at after content DIV tag.");																															
$options1[] = array("id" => "templatemela_left_before",
					"label" => "templatemela left before",
					"type" => "textarea",
					"description" => "Executed before the #secondary ID tag.");
$options1[] = array("id" => "templatemela_left_after",
					"label" => "templatemela left after",
					"type" => "textarea",
					"description" => "Executed after the #secondary ID tag.");					
$options1[] = array("id" => "templatemela_right_before",
					"label" => "templatemela right before",
					"type" => "textarea",
					"description" => "Executed before the #primary ID tag.");	
$options1[] = array("id" => "templatemela_right_after",
					"label" => "templatemela right after",
					"type" => "textarea",
					"description" => "Executed after the #primary ID tag.");									
$options1[] = array("id" => "templatemela_footer_before",
					"label" => "templatemela footer before",
					"type" => "textarea",
					"description" => "Executed before the .footer-container DIV tag.");	
$options1[] = array("id" => "templatemela_footer_inside",
					"label" => "templatemela footer inside",
					"type" => "textarea",
					"description" => "Executed inside the .footer-container DIV tag.");
$options1[] = array("id" => "templatemela_footer_after",
					"label" => "templatemela footer after",
					"type" => "textarea",
					"description" => "Executed after the .footer-container DIV tag.");
$options1[] = array("id" => "templatemela_custom_css",
                    "label" => "templatemela custom css",
                    "type" => "textarea",
                    "description" => "custom css");  					
?>
<!-- =============== Call Font Script ================== -->

<div class="main-block">
  <div class="icon-templatemela"><img src="<?php echo get_option( 'siteurl' ).'/wp-content/themes/'.get_option( 'template' ).'/templatemela/logo.png'; ?>" /></div>
  <h2 class="title-themeset">TemplateMela - Theme Settings</h2>
	<?php     
	if(!isset( $result )) {$result=''; }
	if ($result=='success') 
		echo '<div class="updated settings-error" id="setting-error-settings_updated"><p><strong>Settings saved.</strong></p></div>';
	?>
  <!-- ====================================================== Start General Setting ================================================================ -->
  <div id="General">
    <form enctype="multipart/form-data" method="post" id="settingForm1" name="settingForm1">
      <input type="hidden" name="action" value="save_options1"  />
		<?php
	if(!isset( $_REQUEST['action'] )) {$_REQUEST['action']=''; }
	if(!isset( $_REQUEST['reset1'] )) {$_REQUEST['reset1']=''; }

	
		if ( 'save_options1' == $_REQUEST['action'] ) {
			foreach ($options1 as $value) {
				if(!isset( $value['id'] )) {$value['id']=''; }
				if(isset( $value['id'] ) && isset($_REQUEST[ $value['id'] ] )){
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
				}
			} 
		else if( 'reset1' == $_REQUEST['reset1'] ) {
			foreach ($options1 as $value) {
				delete_option( $value['id'] ); 
			}
		} ?>
      <div class="form-table">
      <div class="main_tital">
        <h1>
          <?php _e('Hook Manager','templatemela');?>
        </h1>
      </div>
      <?php
       $i= 0;
     foreach ($options1 as $value) { 

	if(!isset( $value['type'] )) {$value['type']=''; }

	 switch ( $value['type'] ) {
	 
	 case 'textarea':?>
      <?php 
		if( $i % 2 != 0) { ?>
      <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <textarea id="<?php echo $value['id']; ?>"
class="large-text1" cols="40" rows="5" name="<?php echo $value['id']; ?>"><?php echo stripslashes(get_option( $value['id'] )); ?>
</textarea>
            <div class="hook_description"><?php echo $value['description']; ?></div>
          </div>
        </div>
        <!--odd-even-->
        <?php
			
		break;
		
		     }
	   $i++;
      }?>
      </div>
      <!--from-table-->
      <div class="submit">
        <input type="submit" value="Save Changes" class="button-primary" name="Submit" >
      </div>
    </form>
    <!--mainform-->
    <!-- reset Button -->
    <div class="reset-option">
      <form enctype="multipart/form-data" method="post" id="settingForm5" name="settingFormx"  >
        <p class="submit">
          <input type="hidden" name="reset1" value="reset1" />
          <input type="submit" value="Set Default" class="button-primary" name="reset"/>
        </p>
      </form>
    </div>
    <!-- End Reset Button -->
  </div>
  <!--general-setting-->
  <div style="clear:both"></div>
</div>
<!--main-block-->
<div id="ajax-response"></div>
