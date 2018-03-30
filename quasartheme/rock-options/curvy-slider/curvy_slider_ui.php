<?php
function curvy_slider_do_ui(){
	global $curvy_slider_references, $current_slider_id, $sliderDBName;
	$curvy_slider_references = (json_decode(get_option('curvy_slider_references'),true));

	$current_slider_id = isset($_REQUEST['editSliderID']) ? intval($_REQUEST['editSliderID']) : false;
	$add_new_slider_id = isset($_REQUEST['addSliderID']) ? intval($_REQUEST['addSliderID']) : false;
	$delete_slider_id = isset($_REQUEST['deleteSliderID']) ? intval($_REQUEST['deleteSliderID']) : false;
	$duplicate_slider_id = isset($_REQUEST['duplicateSliderID']) ? intval($_REQUEST['duplicateSliderID']) : false;
	
	$total_sliders = 0;
	
	if($current_slider_id !==false || $add_new_slider_id !== false || $duplicate_slider_id !== false):
		
		if($add_new_slider_id !== false || $duplicate_slider_id !== false){
			//New Slider Object
			$newSliderObj = array();
			
			if(!empty($curvy_slider_references)){
				//There are older sliders exists in the database
				if($duplicate_slider_id === false){
					$last = end($curvy_slider_references);
					$newSliderObj['id'] = intval($last['id'])+1;
					$newSliderObj['name'] = 'Curvy Slider '.$newSliderObj['id'];
					$newSliderObj['shortcode'] = '[curvyslider id="'.$newSliderObj['id'].'"]';
					$newSliderObj['created'] = date('m/d/Y');
					$newSliderObj['modified'] = date('m/d/Y');
					
					$curvy_slider_references[] = $newSliderObj;
					update_option('curvy_slider_references',json_encode($curvy_slider_references));
					
					?>
                    <script type="text/javascript">
					//For refreshing the current location after new slider
					var newAddress = window.location.toString().replace("addSliderID="+<?php echo $add_new_slider_id; ?>,
																		"editSliderID="+<?php echo $newSliderObj['id']; ?>);
					window.history.pushState('Object', 'Curvy Slider', newAddress);
					</script>
                    <?php
				
				}elseif($duplicate_slider_id !== false){
					$last = end($curvy_slider_references);
					$newSliderObj['id'] = intval($last['id'])+1;
					$newSliderObj['name'] = $curvy_slider_references[$duplicate_slider_id]['name'].' Copy';
					$newSliderObj['shortcode'] = '[curvyslider id="'.$newSliderObj['id'].'"]';
					$newSliderObj['created'] = date('m/d/Y');
					$newSliderObj['modified'] = date('m/d/Y');
					
					$curvy_slider_references[] = $newSliderObj;
					update_option('curvy_slider_references',json_encode($curvy_slider_references));
					
					$duplicate_data = json_decode(get_option('curvy_slider_'.$duplicate_slider_id));
					$duplicate_data->animationName = $duplicate_data->animationName.' Copy';
					$duplicate_data->id = $newSliderObj['id'];
					$duplicate_data->sliderDBName = 'curvy_slider_'.$newSliderObj['id'];
					update_option($duplicate_data->sliderDBName, json_encode($duplicate_data));
					
					$sliderDBName = $duplicate_data->sliderDBName;
					$current_slider_id = $newSliderObj['id'];
					
					?>
                    <script type="text/javascript">
					//For refreshing the current location after duplicate
					var newAddress = window.location.toString().replace("duplicateSliderID="+<?php echo $duplicate_slider_id; ?>,
																		"editSliderID="+<?php echo $newSliderObj['id']; ?>);
					window.history.pushState('Object', 'Curvy Slider', newAddress);
					</script>
                    <?php
				}
			}else{
				$curvy_slider_references = array();
				$newSliderObj['id'] = 0;
				$newSliderObj['name'] = 'Curvy Slider '.$newSliderObj['id'];
				$newSliderObj['shortcode'] = '[curvyslider id="'.$newSliderObj['id'].'"]';
				$newSliderObj['created'] = date('m/d/Y');
				$newSliderObj['modified'] = date('m/d/Y');
				
				$curvy_slider_references[] = $newSliderObj;
				update_option('curvy_slider_references', json_encode($curvy_slider_references));
			}
			
			//This is the main holder for the slider
			if($duplicate_slider_id === false){
				$sliderDBName = 'curvy_slider_'.$newSliderObj['id'];
				$sliderObject = new stdClass;
				$sliderObject->animationName = 'Curvy Slider '.$newSliderObj['id'];
				$sliderObject->sliderID = $newSliderObj['id'];
				$sliderObject->id = $newSliderObj['id'];
				$sliderObject->scenes = array();
				update_option($sliderDBName,json_encode($sliderObject));
				
				$current_slider_id = $add_new_slider_id;
			}
		}
		if($duplicate_slider_id === false){
			$sliderDBName = 'curvy_slider_'.$current_slider_id;
		}
		//This is the main Slider Function
		curvy_slider_edit_slider_ui();
		
	else:
		//Check if we are here to delete a slider
		if($delete_slider_id !== false){

			foreach($curvy_slider_references as $ref){
				if($ref['id'] == $delete_slider_id){

					unset($curvy_slider_references[$delete_slider_id]);	
					update_option('curvy_slider_references', json_encode($curvy_slider_references));
					delete_option('curvy_slider_'.$delete_slider_id);
					break;
				}
			}
			$curvy_slider_references = (json_decode(get_option('curvy_slider_references'),true));
			
			?>
            <script type="text/javascript">
			//For refreshing the current location after delete
			var newAddress = window.location.toString().substr(0,window.location.toString().lastIndexOf("curvy_slider") + 12);
			window.history.pushState('Object', 'Curvy Slider', newAddress);
			</script>
			<?php
		}

		
		?>
	<h2><img src="<?php echo CURVY_URI.'images/curvy-logo.png'; ?>"  /></h2>
    <br />
    <div id="curvy-slider-list" class="postbox">
    	<h3 class="list-header">
        	<div class="row">
                <div class="large-1 columns">#</div>
                <div class="large-3 columns">Name</div>
                <div class="large-3 columns">Shortcode</div>
                <div class="large-3 columns">Actions</div>
                <div class="large-1 columns">Created</div>
                <div class="large-1 columns">Modified</div>
                
            </div>
        </h3>
        <?php 
		/*Check if there are registered sliders*/
		if(!empty($curvy_slider_references)){
			foreach($curvy_slider_references as $slider){
				echo '<div class="list-inside row">';
					echo '<div class="large-1 columns">'.$slider['id'].'</div>';
					echo '<div class="large-3 columns"><strong>'.$slider['name'].'</strong></div>';
					echo '<div class="large-3 columns">'.$slider['shortcode'].'</div>';
					echo '<div class="large-3 columns"><span class="click-to-test-edit"><a href="?page=curvy_slider&reset=true&duplicateSliderID='.$slider['id'].'">Duplicate</a></span> | <a href="?page=curvy_slider&reset=true&editSliderID='.$slider['id'].'">Edit</a></span> | <span class="click-to-test-edit delete-animation-permanently"><a href="?page=curvy_slider&reset=true&deleteSliderID='.$slider['id'].'">Delete</a></span></div>';
					echo '<div class="large-1 columns">'.$slider['created'].'</div>';
					echo '<div class="large-1 columns">'.$slider['modified'].'</div>';
				echo '</div>';
				$total_sliders = intval($slider['id']) + 1;
			}
		}else{
			echo '<div class="list-inside row">';
				echo '<div class="large-12 columns">You do not have any sliders</div>';
			echo '</div>';
		}
		
		?>
    </div>
    <a href="?page=curvy_slider&reset=true&addSliderID=<?php echo $total_sliders; ?>" class="button button-primary"><i class="fa fa-plus"></i> Add New Slider</a>
    
    <script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(document).on("click", "span.delete-animation-permanently", function(e){
			e.preventDefault();
			var delLink = jQuery(this).find("a").attr("href");
			var siteLocation = document.location.toString().substr(0,document.location.toString().lastIndexOf("?"))
			var yes = confirm("Delete this animation permanently?");
			if(yes){
				document.location = siteLocation+delLink;
			}
		});

	});
	</script>
	<?php
	endif;
	return;
}


function curvy_slider_edit_slider_ui(){
	global $current_slider_id, $sliderDBName;

	//Get fonts
	$fontsData = get_option('quasar_google_fonts');
	if(!empty($fontsData)){
		$googleFonts = json_decode(stripslashes($fontsData));
		$animFont = "";

		for($i = 0; $i<count($googleFonts); $i++){
			$animFont .= $googleFonts[$i]->font;
			if($i + 1 < count($googleFonts)) $animFont .= "|";
		}
		echo '<div id="google-fonts-holder" class="hide">'.(stripslashes($fontsData)).'</div>';

		//Enqueue fonts

	}else{
		echo '<div id="google-fonts-holder" class="hide">'.json_encode(array()).'</div>';
	}

	$saved_settings = (get_option($sliderDBName, array()));
	$saved_settings_php = json_decode($saved_settings,true);

	?>
    <script type="text/javascript">
	jQuery(document).ready(function(){
		
		jQuery(document).on("click", ".handlediv", function(){
			jQuery(this).parent().find(".inside").toggle();
		});
		
	
	});
	</script>
	<?php
	echo '<div id="curvy-data" class="hide" sliderName="'.$saved_settings_php['animationName'].'" sliderID="'.$current_slider_id.'" sliderDBName="'.$sliderDBName.'">'.$saved_settings.'</div>';
	echo '<div id="wayNameHolder" way="'.F_WAY.'" curvyWayDir="'.CURVY_DIR.'" curvyWayUri="'.CURVY_URI.'"></div>';
	
	/*Swith Scenes*/
	echo '
	<div class="wrap">
    <div id="scenes-navigation" class="large-12 columns">
    	<ul>
            <li class="add-new-scene-btn"><i class="fa fa-plus"></i> Add New Scene</li>
        </ul>
        <div class="clear"></div>
    	<!--Scenes Navigation Holder-->
		
		<div class="postbox">
			<div class="inside">
				<ul class="scene_action_buttons">
					<li><strong>Slider Name : <input autocomplete="off" type="text" id="current_slider_name" value="'.$saved_settings_php['animationName'].'" /></strong></li>
					<li><div class="button-primary" id="save-all-scenes">Save Animation <span class="save-status"></span></div></li>
					<li><a id="playBtn"><i class="fa fa-play"></i> Play Current Scene</a></li>
					<li><a class="switchScenesBack"><i class="fa fa-step-backward"></i></a></li>
					<li><a id="stopAllScenesBtn" ><i class="fa fa-stop"></i></a></li>
					<li><a class="switchScenes"><i class="fa fa-step-forward"></i></a></li>
					<li><a id="playAllScenesBtn"><i class="fa fa-play-circle"></i> Play All Scenes</a></li>
				</ul>
				<div class="clear"></div>				
			</div>
		</div>
    </div>
	</div>
	';

	echo '<div style="margin-right:15px; margin-bottom:-15px;">
			<div class="loader-container">
				<div style="text-align:center;">
					<img src="'.CURVY_URI.'images/curvy-logo-full.png" />
					<p>Loading... <i class="fa fa-refresh fa-spin"></i></p>
				</div>
			</div>
			<div class="">
				<div id="quasar-animID" class="span10">
					<div id="experiment-holder">
						<canvas id="experiment-canvas-bg"></canvas>
						<canvas id="experiment-canvas"></canvas>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		  </div>
			';
			
	echo curvy_make_animation_object_scene();
}	

function curvy_make_animation_object_scene(){
	echo '';
	?>
    
    <div id="scenes-holder">
    	<!--Scenes Holder-->
    </div>
    <br/>
    
    <div style="margin-right: 14px; background: #F4FAFD; padding: 7px 0 14px; border-radius: 3px; border: 1px solid #B0F8F2;">
    <div class="row">
        <div class="" style="">
            <div class="large-4 columns">
                <ul id="add-animation-element-id" class="rockthems-pb-elements-list add-animation-element">
                    <li element="singleText selected"><i class="fa fa-text-width"></i><br>Text</li>
                    <li element="singleBoxedText"><i class="fa fa-pencil-square"></i><br>Boxed Text</li>
                    <li element="image"><i class="fa fa-picture-o"></i><br>Image</li>
                </ul>
                <div class="clear"></div>    
            </div>
            <div class="large-2 columns">
            	<br/>
                <div class="button button-primary add-element-btn">Add Element</div>
            </div>
            <div class="large-5 columns">
                <h3>Add New Element</h3>
                <p>Choose your element type by clicking on the icons at the left. After you choose an element type, click to "Add Element" button to add this element on the scene.</p>
            </div>
            <div class="large-1 columns">
            </div>
        </div>
    </div>
    </div>
	<?php
		
}

function rock_builder_menu(){
	$elements = '<h5>Choose Element</h5>
<select id="add-element-element">
  <option element="textfield">Text Field</option>
  <option element="image">Image</option>
</select>
	';	
	
	$layouts = '
<h5>Choose Columns</h5>
<select id="add-element-columns">
  <option col="1">One Column</option>
  <option col="2">Two Column</option>
  <option col="3">Three Column</option>
  <option col="4">Four Column</option>
  <option col="5">Five Column</option>
  <option col="6">Six Column</option>
  <option col="7">Seven Column</option>
  <option col="8">Eight Column</option>
  <option col="9">Nine Column</option>
  <option col="10">Ten Column</option>
  <option col="11">Elevent Column</option>
  <option col="12">Twelve Column</option>
</select>
	';
	
	$buttons = '
	<div id="add-element-btn" class="btn btn-primary"><i class="fa fa-plus-circle icon-white"></i> Add Element</div>
	';
	
	return $elements.'<br/>'.$layouts.'<br/>'.$buttons.'</br>';
}


?>