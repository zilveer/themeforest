<?php
//CREATE DATABASE
		//CREATE FUNCTION
		function create_db_slides () {
			global $wpdb;
			$create_query = 'CREATE TABLE `'.$wpdb->prefix.'dt-slides` (
								`ID` INT AUTO_INCREMENT ,								
								`TITLE` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
								`TITLE_SHORT` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,								
								`TEXT` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
								`LINK` TEXT NOT NULL,
								`IMG` TEXT NOT NULL,
								`PUBLISH` INT DEFAULT 1,
								`TARGET` TEXT NOT NULL,
								`VIDEO` TEXT NOT NULL,
								`ORDER` INT DEFAULT NULL,
								`SLIDE_PARENT` INT DEFAULT NULL,
								`CROP_LOCATION` TEXT NOT NULL,
								PRIMARY KEY ( `ID` )
							) ENGINE = MYISAM ;						
							';
			$create = $wpdb->get_results($create_query);
		}
		function create_db_slideshows () {
			global $wpdb;
			$create_query = 'CREATE TABLE `'.$wpdb->prefix.'dt-slideshows` (
								`ID` INT AUTO_INCREMENT ,								
								`SLIDESHOW_NAME` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
								`SLIDESHOW_TYPE` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
								PRIMARY KEY ( `ID` )
							) ENGINE = MYISAM ;
							';
			$create = $wpdb->get_results($create_query);
		}		
		
		//CHECK FUNCTION
		if ( check_db_existance($wpdb->prefix.'dt-slides') == '') create_db_slides();
		if ( check_db_existance($wpdb->prefix.'dt-slideshows') == '') create_db_slideshows();
//INSERT FUNCTIONS
	
	function insert_slide_in_db($id = 'NULL', $title='no-title',$title_short='no-title',$text='no-text',$link='no-link',$img='no-img',$publish=1,$target='url',$video='no-video',$slide_parent=0,$order='',$crop_location='') {
		global $wpdb;
		if ( $order == '' )
		{
			$maxOrderValueQuery = 'SELECT MAX(`ORDER`) FROM `'.$wpdb->prefix.'dt-slides` WHERE `SLIDE_PARENT`='.$slide_parent;
			$maxOrderValueResult = $wpdb->get_results($maxOrderValueQuery);
			$maxOrderValue = get_object_vars($maxOrderValueResult[0]);									
			$maxOrderValue = $maxOrderValue['MAX(`ORDER`)'];
			if ( $maxOrderValue != '' ) $order = $maxOrderValue + 1;
		}
		$insert_query = "INSERT INTO `".$wpdb->prefix."dt-slides` (`ID`, `TITLE`,`TITLE_SHORT`, `TEXT`, `LINK`, `IMG`, `PUBLISH`, `TARGET`, `VIDEO`, `SLIDE_PARENT`,`ORDER`,`CROP_LOCATION`) VALUES ('".$id."', '".$title."','".$title_short."', '".$text."', '".$link."', '".$img."', '".$publish."', '".$target."', '".$video."', '".$slide_parent."', '".$order."', '".$crop_location."');";
 		$insert = $wpdb->get_results($insert_query);
	}
	function insert_slideshow_in_db($id = 'NULL', $slideshow_name='',$slideshow_type='') {
		global $wpdb;
		$insert_query = "INSERT INTO `".$wpdb->prefix."dt-slideshows` (`ID`, `SLIDESHOW_NAME`,`SLIDESHOW_TYPE`) VALUES ('".$id."','".$slideshow_name."','".$slideshow_type."');";
 		$insert = $wpdb->get_results($insert_query);
	}	
//REQUIRE SLIDES 
	function slide_require ($parent = '') {
		global $wpdb;
		if ( $parent != '' ) $parentQuery = 'AND `SLIDE_PARENT` = '.$parent.' ';
		$slide_require_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-slides` WHERE PUBLISH=1 '.$parentQuery.'ORDER BY `ORDER` ASC ';
		$slide_require = $wpdb->get_results($slide_require_query);
		return $slide_require;
	}
	function slideshow_require($id = '') {
		global $wpdb;
		$slideshows = '';
		$particular_slide = '';
		if ( $id != '' && $id != 'slider-off' ) $particular_slide = ' WHERE `ID`='.$id;
		if ( check_db_existance($wpdb->prefix.'dt-slideshows') ) :
			$slideshows_require_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-slideshows`'.$particular_slide;	
			$slideshows = $wpdb->get_results($slideshows_require_query);
		endif;
		return $slideshows;
	}
//DELETE ENTRY 
	function delete_slide($id) {
		global $wpdb;			
		$delete_query = 'DELETE FROM `'.$wpdb->prefix.'dt-slides` WHERE ID="'.$id.'" LIMIT 1';	
		$wpdb->get_results($delete_query);	
	}
	function delete_slideshow($id,$ignoreID = 0) {
		if ( $ignoreID == 1 )
		{
			global $wpdb;			
			$delete_query = 'DELETE FROM `'.$wpdb->prefix.'dt-slideshows` WHERE ID="'.$id.'" LIMIT 1';	
			$wpdb->get_results($delete_query);				
		}
		else
		{
			$slideshowCount = count(slide_require($id));
			if ( $slideshowCount) echo '<div class="page-error">You cannot delete a slideshow that has slides attached.</div>';
			else
			{
				global $wpdb;			
				$delete_query = 'DELETE FROM `'.$wpdb->prefix.'dt-slideshows` WHERE ID="'.$id.'" LIMIT 1';	
				$wpdb->get_results($delete_query);				
				echo '<div class="page-success">You have succesfully deleted a slideshow.</div>';
			}
		}

	}	
//PUBLISH SLIDE
	function publish_slide($id) {
		global $wpdb;			
		$delete_query = 'UPDATE `'.$wpdb->prefix.'dt-slides` SET `PUBLISH` = 1 WHERE ID="'.$id.'"';	
		$wpdb->get_results($delete_query);	
	}	
//UNPUBLISH SLIDE
	function unpublish_slide($id) {
		global $wpdb;			
		$delete_query = 'UPDATE `'.$wpdb->prefix.'dt-slides` SET `PUBLISH` = 0 WHERE ID="'.$id.'"';	
		$wpdb->get_results($delete_query);	
	}		
//CREATE THE HTML VERSION OF THE SLIDER
function get_slider_code ($type,$set){
	$slider = '';	
	switch($type)
	{
		case 'content-slider':
			$slides = slide_require($set);
			if ( count($slides) == 0 ):
				echo '<div class="dt-message dt-message-error dt-message-centered">There aren\'t any slides added yet.</div>';
			else: 
				$dt_SliderContentHeight = get_option('dt_SliderContentHeight','423');
				$slider = '<div id="content-slider" style="height:'.$dt_SliderContentHeight.'px;">';
					$i = 0;
					$slider .= '<ul class="content-slider-elements" style="height:'.$dt_SliderContentHeight.'px;">';
						foreach ( $slides as $slide ):
							$slider .= '<li class="slide-wrapper"  style="height:'.$dt_SliderContentHeight.'px;">';
									$slider .= '<div class="content" style="height:'.($dt_SliderContentHeight-63).'px;">';
										$slider .= '<h2>'.__($slide->TITLE).'</h2>';
										$textNotStrippedLenght = 0;
										$textStrippedLenght = 0;
										$textNotStrippedLenght = strlen($slide->TEXT);
										$textStrippedLenght = strlen(strip_tags($slide->TEXT));
										if ( $textStrippedLenght == $textNotStrippedLenght ) $slider .= '<p>'.__($slide->TEXT).'</p>';
										else $slider .= __($slide->TEXT);										
										$slider .= '<a class="more-link" href="'.$slide->LINK.'"><span><span>'.dt_ReadMore.'</span></span></a>';
									$slider .= '</div>';						
									$slider .= '<div class="image-wrapper"  style="height:'.$dt_SliderContentHeight.'px;">';
										$slider .= '<img src="'.resizeimagenoecho($slide->IMG,640,$dt_SliderContentHeight,$slide->CROP_LOCATION).'" alt="'.__($slide->TITLE).'" />';						
									$slider .= '</div>';										
							$slider .= '</li>';
							$i++;
						endforeach;
					$slider .= '</ul>';											
				$slider .= '</div>';				
				echo $slider;
			endif;	
		break;
 		case 'complex-slider':
			$slides = slide_require($set);
			if ( count($slides) == 0 ):
				echo '<div class="dt-message dt-message-error dt-message-centered">There aren\'t any slides added yet.</div>';
			else: 
				$dt_SliderComplexHeight = get_option('dt_SliderComplexHeight','378');
				$dt_SliderComplexDescription = get_option('dt_SliderComplexDescription','true');
				$dt_SliderComplexGallery = get_option('dt_SliderComplexGallery','true');	
				$dt_SliderComplexIcon = get_option('dt_SliderComplexIcon','true');				
				$slider = '<div class="dt_complexslider">';
					$slider .= '<div class="slider-images" style="height:'.$dt_SliderComplexHeight.'px">';
						$slider .= '<ul style="height:'.$dt_SliderComplexHeight.'px">';
						foreach ( $slides as $slide ):
							$slider .= '<li>';
							if ( $slide->TARGET == 'url' ):
								$slider .= '<a href="'.$slide->LINK.'" title="'.__($slide->TITLE).'">';
									if ( $dt_SliderComplexIcon == 'true' ):
									$slider .= '<span class="icon link"></span>';
									endif;
									$slider .= '<img src="'.resizeimagenoecho($slide->IMG,960,$dt_SliderComplexHeight,$slide->CROP_LOCATION).'" alt="'.__($slide->TITLE).'" />';
								$slider .= '</a>';						
							endif;
							if ( $slide->TARGET == 'video' ):
								$slider .= '<a href="'.$slide->VIDEO.'" title="'.__($slide->TITLE).'" rel="modal-window[complex-slider]">';
									if ( $dt_SliderComplexIcon == 'true' ):
									$slider .= '<span class="icon play"></span>';
									endif;
									$slider .= '<img src="'.resizeimagenoecho($slide->IMG,960,$dt_SliderComplexHeight,$slide->CROP_LOCATION).'" alt="'.__($slide->TITLE).'" />';
								$slider .= '</a>';						
							endif;	
							if ( $slide->TARGET == 'image' ):
								$slider .= '<a href="'.$slide->IMG.'" title="'.__($slide->TITLE).'" rel="modal-window[complex-slider]">';
									if ( $dt_SliderComplexIcon == 'true' ):
									$slider .= '<span class="icon zoom"></span>';
									endif;
									$slider .= '<img src="'.resizeimagenoecho($slide->IMG,960,$dt_SliderComplexHeight,$slide->CROP_LOCATION).'" alt="'.__($slide->TITLE).'" />';
								$slider .= '</a>';						
							endif;												
							$slider .= '</li>';					
						endforeach;
						$slider .= '</ul>';	
					$slider .= '</div>';
					if ( $dt_SliderComplexDescription == 'true' ||  $dt_SliderComplexGallery == 'true' ): 
						$slider .= '<div class="slider-content">';
							if ( $dt_SliderComplexDescription == 'true' ): 
								$slider .= '<div class="slider-descriptions">';
									$slider .= '<ul>';
									foreach ( $slides as $slide ):
										$slider .= '<li>';
											$slider .= '<h6>'.__($slide->TITLE).'</h6>';
											$slider .= '<p>'.__($slide->TEXT).'</p>';								
										$slider .= '</li>';					
									endforeach;
									$slider .= '</ul>';	
								$slider .= '</div>';
							endif;
							if ( $dt_SliderComplexGallery == 'true' ):
							$slider .= '<div class="slider-gallery">';
								$slider .= '<ul>';
								foreach ( $slides as $slide ):
									$slider .= '<li>';
										$slider .= '<a title="'.__($slide->TITLE).'" href="javascript: void(0)">';
											$slider .= '<span class="border"></span>';
											$slider .= '<img width="91" height="49" alt="'.__($slide->TITLE).'" src="'.resizeimagenoecho($slide->IMG,91,49,$slide->CROP_LOCATION).'">';
										$slider .= '</a>';
									$slider .= '</li>';					
								endforeach;
								$slider .= '</ul>';	
							$slider .= '</div>';
							endif;
						$slider .= '</div>';	
					endif;												
				$slider .= '</div>';				
				echo $slider;
			endif;	
		break;
 		case 'presentation-slider':
			$slides = slide_require($set);
			if ( count($slides) == 0 ):
				echo '<div class="dt-message dt-message-error dt-message-centered">There aren\'t any slides added yet.</div>';
			else: 
				$dt_SliderPresentationHeight = get_option('dt_SliderPresentationHeight','300');
				$dt_SliderPresentationIcon = get_option('dt_SliderPresentationIcon','true');
				$dt_SliderPresentationDescription = get_option('dt_SliderPresentationDescription','true');
				$slider = '<div class="dt_presentationslider">';
					$slider .= '<div class="slider-images">';
						$slider .= '<ul style="height:'.$dt_SliderPresentationHeight.'px;">';	
						foreach ( $slides as $slide ):
							$slider .= '<li>';
							if ( $slide->TARGET == 'url' ):
								$slider .= '<a title="'.__($slide->TITLE_SHORT).'" href="'.$slide->LINK.'">';							
									if ( $dt_SliderPresentationIcon == 'true' ):
									$slider .= '<span class="icon link"></span>';								
									endif;
							endif;	
							if ( $slide->TARGET == 'video' ):
								$slider .= '<a title="'.__($slide->TITLE_SHORT).'" href="'.$slide->VIDEO.'" rel="modal-window[presentation-slider]">';							
									if ( $dt_SliderPresentationIcon == 'true' ):
									$slider .= '<span class="icon play"></span>';								
									endif;
							endif;	
							if ( $slide->TARGET == 'image' ):
								$slider .= '<a title="'.__($slide->TITLE_SHORT).'" href="'.$slide->IMG.'" rel="modal-window[presentation-slider]">';							
									if ( $dt_SliderPresentationIcon == 'true' ):
									$slider .= '<span class="icon zoom"></span>';								
									endif;
							endif;																															
									$slider .= '<img width="960" height="'.$dt_SliderPresentationHeight.'" alt="'.__($slide->TITLE).'" src="'.resizeimagenoecho($slide->IMG,960,$dt_SliderPresentationHeight,$slide->CROP_LOCATION).'">';								
								$slider .= '</a>';
							$slider .= '</li>';							
						endforeach;
						$slider .= '</ul>';
					$slider .= '</div>';	
					if ( $dt_SliderPresentationDescription == 'true' ):
						$slider .= '<div class="slider-descriptions">';
							$slider .= '<ul>';						
								foreach ( $slides as $slide ):
									$slider .= '<li>';
										$slider .= '<h6>'.__($slide->TITLE).'</h6>';
										$slider .= '<p>'.__($slide->TEXT).'</p>';																		
									$slider .= '</li>';										
								endforeach;
							$slider .= '</ul>';
						$slider .= '</div>';
					endif;								
				$slider .= '</div>';
				echo $slider;
			endif;
		break;					
 		case 'fullwidth-slider':
			$slides = slide_require($set);
			if ( count($slides) == 0 ):
				echo '<div class="dt-message dt-message-error dt-message-centered">There aren\'t any slides added yet.</div>';
			else:
				$dt_SliderFullWidthHeight = get_option('dt_SliderFullWidthHeight','500');
				$dt_SliderFullWidthGallery = get_option('dt_SliderFullWidthGallery','true');
				$dt_SliderFullWidthDescription = get_option('dt_SliderFullWidthDescription','true');
				$dt_SliderFullWidthIcon = get_option('dt_SliderFullWidthIcon','true');
				$slider = '<div class="dt_fullwidthslider" style="height:'.$dt_SliderFullWidthHeight.'px;">';
					$slider .= '<div class="slider-images">';
						$slider .= '<ul>';
						foreach ( $slides as $slide ):
							$slider .= '<li>';
								if ( $slide->TARGET == 'url' ):
									$slider .= '<a title="'.__($slide->TITLE).'" href="'.$slide->LINK.'">';
										if ( $dt_SliderFullWidthIcon == 'true' ):
											if ( $dt_SliderFullWidthDescription == 'true' ):
												$slider .= '<span class="icon content"></span>';
												$slider .= '<span class="icon link"></span>';
											else:
												$slider .= '<span class="icon icon-centered link"></span>';											
											endif;
										endif;
										$slider .= '<img width="1920" height="'.$dt_SliderFullWidthHeight.'" alt="'.__($slide->TITLE).'" src="'.resizeimagenoecho($slide->IMG,1920,$dt_SliderFullWidthHeight,$slide->CROP_LOCATION).'">';
									$slider .= '</a>';
								endif;
								if ( $slide->TARGET == 'video' ):
									$slider .= '<a title="'.__($slide->TITLE).'" href="'.$slide->VIDEO.'" rel="modal-window[fullwidth-slider]">';
										if ( $dt_SliderFullWidthIcon == 'true' ):
											if ( $dt_SliderFullWidthDescription == 'true' ):
												$slider .= '<span class="icon content"></span>';
												$slider .= '<span class="icon play"></span>';
											else:
												$slider .= '<span class="icon icon-centered play"></span>';
											endif;
										endif;
										$slider .= '<img width="1920" height="'.$dt_SliderFullWidthHeight.'" alt="'.__($slide->TITLE).'" src="'.resizeimagenoecho($slide->IMG,1920,$dt_SliderFullWidthHeight,$slide->CROP_LOCATION).'">';
									$slider .= '</a>';
								endif;
								if ( $slide->TARGET == 'image' ):
									$slider .= '<a title="'.__($slide->TITLE).'" href="'.$slide->IMG.'" rel="modal-window[fullwidth-slider]">';
										if ( $dt_SliderFullWidthIcon == 'true' ):
											if ( $dt_SliderFullWidthDescription == 'true' ):
												$slider .= '<span class="icon content"></span>';
												$slider .= '<span class="icon play"></span>';
											else:
												$slider .= '<span class="icon icon-centered play"></span>';											
											endif;
										endif;
										$slider .= '<img width="1920" height="'.$dt_SliderFullWidthHeight.'" alt="'.__($slide->TITLE).'" src="'.resizeimagenoecho($slide->IMG,1920,$dt_SliderFullWidthHeight,$slide->CROP_LOCATION).'">';
									$slider .= '</a>';
								endif;																
							$slider .= '</li>';					
						endforeach;
						$slider .= '</ul>';						
					$slider .= '</div>';
					if ( $dt_SliderFullWidthDescription == 'true'):
					$slider .= '<div class="slider-descriptions">';
						$slider .= '<ul>';
						foreach ( $slides as $slide ):
							$slider .= '<li>';
								$slider .= '<h6>'.__($slide->TITLE).'</h6>';	
								$slider .= '<p>'.__($slide->TEXT).'</p>';	
								$slider .= '<p><a href="#">'.dt_ReadMore.'</a></p>';							
							$slider .= '</li>';					
						endforeach;
						$slider .= '</ul>';						
					$slider .= '</div>';
					endif;
					if ( $dt_SliderFullWidthGallery == 'true'): 
						$slider .= '<div class="slider-gallery">';
							$slider .= '<div class="gallery-wrapper">';
								$slider .= '<ul>';
								foreach ( $slides as $slide ):
									$slider .= '<li>';
										$slider .= '<a href="javascript: void(0)" title="'.__($slide->TITLE).'">';
											$slider .= '<span class="border"></span>';
											$slider .= '<img width="100" height="50" alt="'.__($slide->TITLE).'" src="'.resizeimagenoecho($slide->IMG,100,50,$slide->CROP_LOCATION).'">';
										$slider .= '</a>';
									$slider .= '</li>';					
								endforeach;
								$slider .= '</ul>';						
							$slider .= '</div>';
						$slider .= '</div>';					
					endif;
				$slider .= '</div>';
				echo $slider;
			endif;
		break;
 		case 'fullscreen-slider':
			$slides = slide_require($set);
			if ( count($slides) == 0 ):
				echo '<div class="dt-message dt-message-error dt-message-centered">There aren\'t any slides added yet.</div>';
			else:
				$dt_SliderFullScreenGallery = get_option('dt_SliderFullScreenGallery','true');	
				$dt_SliderFullScreenDescription = get_option('dt_SliderFullScreenDescription','true');		
				$slider = '<div class="dt_fullscreenslider">';
					$slider .= '<div class="slider-images">';
						foreach ( $slides as $slide ):
							$slider .= '<img src="'.$slide->IMG.'" />';
						endforeach;
					$slider .= '</div>';
					if ( $dt_SliderFullScreenGallery == 'true' ):
						$slider .= '<div class="slider-gallery">';
							$slider .= '<ul>';
								foreach ( $slides as $slide ):
									$slider .= '<li><a href="javascript: void(0);"><span class="border"></span><img src="'.resizeimagenoecho($slide->IMG,58,36,$slide->CROP_LOCATION).'" alt="'.__($slide->IMG).'" width="58" height="36" /></a></li>';
								endforeach;
							$slider .= '</ul>';						
						$slider .= '</div>';
					endif;
					if ( $dt_SliderFullScreenDescription == 'true' ):
						$slider .= '<div class="slider-descriptions">';
							$slider .= '<ul>';
								foreach ( $slides as $slide ):
									$slider .= '<li>';
										$slider .= '<h3>'.__($slide->TITLE).'</h3>';
										$slider .= '<p>'.__($slide->TEXT).'</p>';
										if ( $slide->TARGET == 'url' ):
											$slider .= '<p><a class="more-link" href="'.$slide->LINK.'"><span class="left"></span><span class="mid">'.dt_ReadMore.'</span><span class="right"></span></a></p>';
										endif;
										if ( $slide->TARGET == 'video' ):
											$slider .= '<p><a class="more-link" href="'.$slide->VIDEO.'" rel="modal-window[fullscreen-slider]"><span class="left"></span><span class="mid">'.dt_PlayVideo.'</span><span class="right"></span></a></p>';
										endif;
										if ( $slide->TARGET == 'image' ):
											$slider .= '<p><a class="more-link" href="'.$slide->IMG.'" rel="modal-window[fullscreen-slider]"><span class="left"></span><span class="mid">'.dt_ViewImage.'</span><span class="right"></span></a></p>';
										endif;
									$slider .= '</li>';
								endforeach;
							$slider .= '</ul>';						
						$slider .= '</div>';
					endif;									
				$slider .= '</div>';
				echo $slider;
			endif;
		break;			
		case 'gallery-slider':
			$slides = slide_require($set);
			if ( count($slides) == 0 ):
				echo '<div class="dt-message dt-message-error dt-message-centered">There aren\'t any slides added yet.</div>';
			else: 
				$dt_SliderGalleryHeight = get_option('dt_SliderGalleryHeight','480');
				$dt_SliderGalleryLayout = get_option('dt_SliderGalleryLayout','single-image');
				$dt_SliderGalleryHeightUnit = floor($dt_SliderGalleryHeight/3);
				$dt_SliderGalleryDescription = get_option('dt_SliderGalleryDescription','480');
				$slider_count = count($slides);
				$output = '<div class="dt_galleryslider">';
					$output .= '<div class="slider-images" style="height:'.($dt_SliderGalleryHeightUnit*3).'px;">';
						$output .= '<ul class="mainparent">';
							if ( $dt_SliderGalleryLayout == 'single-image' ):
								$dt_SliderGalleryLayoutRows = get_option('dt_SliderGalleryLayoutRows','1');
								$dt_SliderGalleryHeight = $dt_SliderGalleryHeight/$dt_SliderGalleryLayoutRows;
								for ( $current_slide = 0; $current_slide < $slider_count; $current_slide = $current_slide + $dt_SliderGalleryLayoutRows):
								$output .= '<li class="mainlevel">';
									$output .= '<ul>'; 
										$i = 0;
										for ( $i = 0; $i < $dt_SliderGalleryLayoutRows; $i++ ):
											$output .= '<li>';
												$image = '<img width="320" height="'.($dt_SliderGalleryHeight).'" alt="'.__($slides[$current_slide + $i]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide + $i]->IMG,320,$dt_SliderGalleryHeight,$slides[$current_slide + $i]->CROP_LOCATION).'">';
												if ( $dt_SliderGalleryDescription == true ):										
												$output .= '<div class="description">';
													$output .= '<h6>'.__($slides[$current_slide + $i]->TITLE).'</h6>';
													$output .= '<p>'.__($slides[$current_slide + $i]->TEXT).'</p>';
												endif;											
												if ( $slides[$current_slide + $i]->TARGET == 'url' ):
													if ( $dt_SliderGalleryDescription == true ):											
													$output .= '<p><a href="'.$slides[$current_slide + $i]->LINK.'">'.dt_ReadMore.'</a></p>';
													$output .= '<span class="icon link"></span>';
												$output .= '</div>';
													endif;
												$output .= '<a href="javascript:void(0);">'.$image.'</a>';
												endif;
												if ( $slides[$current_slide + $i]->TARGET == 'image' ):
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + $i]->IMG.'">'.dt_ViewImage.'</a></p>';
													$output .= '<span class="icon zoom"></span>';
												$output .= '</div>';
													endif;
												$output .= '<a href="javascript:void(0);">'.$image.'</a>';
												endif;	
												if ( $slides[$current_slide + $i]->TARGET == 'video' ):
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + $i]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
													$output .= '<span class="icon play"></span>';
												$output .= '</div>';
													endif;
												$output .= '<a href="javascript:void(0);">'.$image.'</a>';
												endif;																				
											$output .= '</li>';
										endfor;
									$output .= '</ul>';	
								$output .= '</li>';										
								endfor;
							else:
								for ( $current_slide = 0; $current_slide < $slider_count; $current_slide = $current_slide + 9):
								if ( $slides[$current_slide]->IMG != '' || $slides[$current_slide + 1]->IMG != '' || $slides[$current_slide + 2]->IMG != ''):
									$output .= '<li class="mainlevel">';
										$output .= '<ul>';
											if ( $slides[$current_slide]->IMG != '' ): 
												$output .= '<li>';
													$image = '<img width="320" height="'.($dt_SliderGalleryHeightUnit*2).'" alt="'.__($slides[$current_slide]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide]->IMG,320,$dt_SliderGalleryHeightUnit*2,$slides[$current_slide]->CROP_LOCATION).'">';
													if ( $dt_SliderGalleryDescription == true ):										
													$output .= '<div class="description">';
														$output .= '<h6>'.__($slides[$current_slide]->TITLE).'</h6>';
														$output .= '<p>'.__($slides[$current_slide]->TEXT).'</p>';
													endif;											
													if ( $slides[$current_slide]->TARGET == 'url' ):
														if ( $dt_SliderGalleryDescription == true ):											
														$output .= '<p><a href="'.$slides[$current_slide]->LINK.'">'.dt_ReadMore.'</a></p>';
														$output .= '<span class="icon link"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;
													if ( $slides[$current_slide]->TARGET == 'image' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide]->IMG.'">'.dt_ViewImage.'</a></p>';
														$output .= '<span class="icon zoom"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;	
													if ( $slides[$current_slide]->TARGET == 'video' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
														$output .= '<span class="icon play"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;																				
												$output .= '</li>';
											endif;
											if ( $slides[$current_slide + 1]->IMG != '' ):
												$output .= '<li>';
													$image = '<img width="160" height="'.($dt_SliderGalleryHeightUnit).'" alt="'.__($slides[$current_slide + 1]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide + 1]->IMG,160,$dt_SliderGalleryHeightUnit,$slides[$current_slide + 1]->CROP_LOCATION).'">';
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<div class="description">';
														$output .= '<h6>'.__($slides[$current_slide + 1]->TITLE).'</h6>';
														$output .= '<p>'.__($slides[$current_slide + 1]->TEXT).'</p>';
													endif;											
													if ( $slides[$current_slide + 1]->TARGET == 'url' ):											
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a href="'.$slides[$current_slide + 1]->LINK.'">'.dt_ReadMore.'</a></p>';
														$output .= '<span class="icon link"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;
													if ( $slides[$current_slide + 1]->TARGET == 'image' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 1]->IMG.'">'.dt_ViewImage.'</a></p>';
														$output .= '<span class="icon zoom"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;	
													if ( $slides[$current_slide + 1]->TARGET == 'video' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 1]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
														$output .= '<span class="icon play"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;																				
												$output .= '</li>';
											endif;
											if ( $slides[$current_slide + 2]->IMG != '' ):
											$output .= '<li>';
												$image = '<img width="160" height="'.($dt_SliderGalleryHeightUnit).'" alt="'.__($slides[$current_slide + 2]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide + 2]->IMG,160,$dt_SliderGalleryHeightUnit,$slides[$current_slide + 2]->CROP_LOCATION).'">';
												if ( $dt_SliderGalleryDescription == true ):											
												$output .= '<div class="description">';
													$output .= '<h6>'.__($slides[$current_slide + 2]->TITLE).'</h6>';
													$output .= '<p>'.__($slides[$current_slide + 2]->TEXT).'</p>';
												endif;	
												if ( $slides[$current_slide + 2]->TARGET == 'url' ):											
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<p><a href="'.$slides[$current_slide + 2]->LINK.'">'.dt_ReadMore.'</a></p>';
													$output .= '<span class="icon link"></span>';
												$output .= '</div>';
													endif;
												$output .= '<a href="javascript:void(0);">'.$image.'</a>';
												endif;
												if ( $slides[$current_slide + 2]->TARGET == 'image' ):
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 2]->IMG.'">'.dt_ViewImage.'</a></p>';
													$output .= '<span class="icon zoom"></span>';
												$output .= '</div>';
													endif;
												$output .= '<a href="javascript:void(0);">'.$image.'</a>';
												endif;	
												if ( $slides[$current_slide + 2]->TARGET == 'video' ):
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 2]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
													$output .= '<span class="icon play"></span>';
												$output .= '</div>';
													endif;
												$output .= '<a href="javascript:void(0);">'.$image.'</a>';
												endif;																				
											$output .= '</li>';
											endif;
										$output .= '</ul>';	
									$output .= '</li>';
								endif;	
								if ( $slides[$current_slide + 3]->IMG != '' || $slides[$current_slide + 4]->IMG != '' || $slides[$current_slide + 5]->IMG != '' || $slides[$current_slide + 6]->IMG != ''):										
									$output .= '<li class="mainlevel">';														
										$output .= '<ul>';
											if ( $slides[$current_slide + 3]->IMG != '' ):
												$output .= '<li>';
													$image = '<img width="160" height="'.($dt_SliderGalleryHeightUnit).'" alt="'.__($slides[$current_slide + 3]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide + 3]->IMG,160,$dt_SliderGalleryHeightUnit,$slides[$current_slide + 3]->CROP_LOCATION).'">';
													if ( $dt_SliderGalleryDescription == true ):											
													$output .= '<div class="description">';
														$output .= '<h6>'.__($slides[$current_slide + 3]->TITLE).'</h6>';
														$output .= '<p>'.__($slides[$current_slide + 3]->TEXT).'</p>';
													endif;											
													if ( $slides[$current_slide + 3]->TARGET == 'url' ):
														if ( $dt_SliderGalleryDescription == true ):											
														$output .= '<p><a href="'.$slides[$current_slide + 3]->LINK.'">'.dt_ReadMore.'</a></p>';
														$output .= '<span class="icon link"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;
													if ( $slides[$current_slide + 3]->TARGET == 'image' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 3]->IMG.'">'.dt_ViewImage.'</a></p>';
														$output .= '<span class="icon zoom"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;	
													if ( $slides[$current_slide + 3]->TARGET == 'video' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 3]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
														$output .= '<span class="icon play"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;																				
												$output .= '</li>';
											endif;
											if ( $slides[$current_slide + 4]->IMG != '' ):
												$output .= '<li>';
													$image = '<img width="160" height="'.($dt_SliderGalleryHeightUnit).'" alt="'.__($slides[$current_slide + 4]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide + 4]->IMG,160,$dt_SliderGalleryHeightUnit,$slides[$current_slide + 4]->CROP_LOCATION).'">';
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<div class="description">';
														$output .= '<h6>'.__($slides[$current_slide + 4]->TITLE).'</h6>';
														$output .= '<p>'.__($slides[$current_slide + 4]->TEXT).'</p>';
													endif;											
													if ( $slides[$current_slide + 4]->TARGET == 'url' ):
														if ( $dt_SliderGalleryDescription == true ):											
														$output .= '<p><a href="'.$slides[$current_slide + 4]->LINK.'">'.dt_ReadMore.'</a></p>';
														$output .= '<span class="icon link"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;
													if ( $slides[$current_slide + 4]->TARGET == 'image' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 4]->IMG.'">'.dt_ViewImage.'</a></p>';
														$output .= '<span class="icon zoom"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;	
													if ( $slides[$current_slide + 4]->TARGET == 'video' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 4]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
														$output .= '<span class="icon play"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;																				
												$output .= '</li>';
											endif;
											if ( $slides[$current_slide + 5]->IMG != '' ):		
												$output .= '<li>';
													$image = '<img width="320" height="'.($dt_SliderGalleryHeightUnit).'" alt="'.__($slides[$current_slide + 5]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide + 5]->IMG,320,$dt_SliderGalleryHeightUnit,$slides[$current_slide + 5]->CROP_LOCATION).'">';
													if ( $dt_SliderGalleryDescription == true ):											
													$output .= '<div class="description">';
														$output .= '<h6>'.__($slides[$current_slide + 5]->TITLE).'</h6>';
														$output .= '<p>'.__($slides[$current_slide + 5]->TEXT).'</p>';
													endif;	
													if ( $slides[$current_slide + 5]->TARGET == 'url' ):											
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a href="'.$slides[$current_slide + 5]->LINK.'">'.dt_ReadMore.'</a></p>';
														$output .= '<span class="icon link"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;
													if ( $slides[$current_slide + 5]->TARGET == 'image' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 5]->IMG.'">'.dt_ViewImage.'</a></p>';
														$output .= '<span class="icon zoom"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;	
													if ( $slides[$current_slide + 5]->TARGET == 'video' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 5]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
														$output .= '<span class="icon play"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;																				
												$output .= '</li>';
											endif;
											if ( $slides[$current_slide + 6]->IMG != '' ):
												$output .= '<li>';
													$image = '<img width="320" height="'.($dt_SliderGalleryHeightUnit).'" alt="'.__($slides[$current_slide + 6]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide + 6]->IMG,320,$dt_SliderGalleryHeightUnit,$slides[$current_slide + 6]->CROP_LOCATION).'">';
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<div class="description">';
														$output .= '<h6>'.__($slides[$current_slide + 6]->TITLE).'</h6>';
														$output .= '<p>'.__($slides[$current_slide + 6]->TEXT).'</p>';
													endif;											
													if ( $slides[$current_slide + 6]->TARGET == 'url' ):
														if ( $dt_SliderGalleryDescription == true ):											
														$output .= '<p><a href="'.$slides[$current_slide + 6]->LINK.'">'.dt_ReadMore.'</a></p>';
														$output .= '<span class="icon link"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;
													if ( $slides[$current_slide + 6]->TARGET == 'image' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 6]->IMG.'">'.dt_ViewImage.'</a></p>';
														$output .= '<span class="icon zoom"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;	
													if ( $slides[$current_slide + 6]->TARGET == 'video' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 6]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
														$output .= '<span class="icon play"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;																				
												$output .= '</li>';
											endif;																																																				
										$output .= '</ul>';	
									$output .= '</li>';
								endif;
								if ( $slides[$current_slide + 7]->IMG != '' || $slides[$current_slide + 8]->IMG != '' ):
									$output .= '<li class="mainlevel">';														
										$output .= '<ul>';
											if ( $slides[$current_slide + 7]->IMG != '' ):
												$output .= '<li>';
													$image = '<img width="320" height="'.($dt_SliderGalleryHeightUnit).'" alt="'.__($slides[$current_slide + 7]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide + 7]->IMG,320,$dt_SliderGalleryHeightUnit,$slides[$current_slide + 7]->CROP_LOCATION).'">';
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<div class="description">';
														$output .= '<h6>'.__($slides[$current_slide + 7]->TITLE).'</h6>';
														$output .= '<p>'.__($slides[$current_slide + 7]->TEXT).'</p>';
													endif;											
													if ( $slides[$current_slide + 7]->TARGET == 'url' ):											
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a href="'.$slides[$current_slide + 7]->LINK.'">'.dt_ReadMore.'</a></p>';
														$output .= '<span class="icon link"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;
													if ( $slides[$current_slide + 7]->TARGET == 'image' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 7]->IMG.'">'.dt_ViewImage.'</a></p>';
														$output .= '<span class="icon zoom"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;	
													if ( $slides[$current_slide + 7]->TARGET == 'video' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 7]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
														$output .= '<span class="icon play"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;																				
												$output .= '</li>';
											endif;
											if ( $slides[$current_slide + 8]->IMG != '' ):		
												$output .= '<li>';
													$image = '<img width="320" height="'.($dt_SliderGalleryHeightUnit*2).'" alt="'.__($slides[$current_slide + 8]->TITLE).'" src="'.resizeimagenoecho($slides[$current_slide + 8]->IMG,320,$dt_SliderGalleryHeightUnit*2,$slides[$current_slide + 8]->CROP_LOCATION).'">';
													if ( $dt_SliderGalleryDescription == true ):
													$output .= '<div class="description">';
														$output .= '<h6>'.__($slides[$current_slide + 8]->TITLE).'</h6>';
														$output .= '<p>'.__($slides[$current_slide + 8]->TEXT).'</p>';
													endif;	
													if ( $slides[$current_slide + 8]->TARGET == 'url' ):											
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a href="'.$slides[$current_slide + 8]->LINK.'">'.dt_ReadMore.'</a></p>';
														$output .= '<span class="icon link"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;
													if ( $slides[$current_slide + 8]->TARGET == 'image' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 8]->IMG.'">'.dt_ViewImage.'</a></p>';
														$output .= '<span class="icon zoom"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;	
													if ( $slides[$current_slide + 8]->TARGET == 'video' ):
														if ( $dt_SliderGalleryDescription == true ):
														$output .= '<p><a rel="modal-window[gallery]" href="'.$slides[$current_slide + 8]->VIDEO.'">'.dt_PlayVideo.'</a></p>';
														$output .= '<span class="icon play"></span>';
													$output .= '</div>';
														endif;
													$output .= '<a href="javascript:void(0);">'.$image.'</a>';
													endif;																				
												$output .= '</li>';
											endif;																																																													
										$output .= '</ul>';	
									$output .= '</li>';	
								endif;																	
								endfor;
							endif;								
						$output .= '</ul>';
					$output .= '</div>';
				$output .= '</div>';
				echo $output;							
			endif;	
		break;										
	}	
}
function themeoptions_admin_menu() 
{
	// ADD THE SLIDER OPTIONS PAGE TO ADMIN SIEBAR
	add_submenu_page( 'duotive-panel', 'Duotive Slider Options', 'Slideshow', 'manage_options', 'duotive-slider', 'themeoptions_page');
}

function themeoptions_page() 
{
	// IF UPDATE TO SLIDESHOW OPTIONS, CALL THE UPDATE FUNCTION
	if ( isset($_POST['update_themeoptions']) && $_POST['update_themeoptions'] == 'true' ) { themeoptions_update(); }
	if ( isset($_POST['update_contentoptions']) && $_POST['update_contentoptions'] == 'true' ) { update_contentoptions(); }
	if ( isset($_POST['update_presentationoptions']) && $_POST['update_presentationoptions'] == 'true' ) { update_presentationoptions(); }			
	if ( isset($_POST['update_complexoptions']) && $_POST['update_complexoptions'] == 'true' ) { update_complexoptions(); }
	if ( isset($_POST['update_galleryoptions']) && $_POST['update_galleryoptions'] == 'true' ) { update_galleryoptions(); }				
	if ( isset($_POST['update_fullwidthoptions']) && $_POST['update_fullwidthoptions'] == 'true' ) { update_fullwidthoptions(); }
	if ( isset($_POST['update_fullscreenoptions']) && $_POST['update_fullscreenoptions'] == 'true' ) { update_fullscreenoptions(); }				
	//MOVE UP/DOWN OR DELETE A SLIDER
	if(isset($_GET['delete']) && $_GET['delete'] != '') delete_slide($_GET['delete']);
	if(isset($_GET['publish']) && $_GET['publish'] != '') publish_slide($_GET['publish']);	
	if(isset($_GET['unpublish']) && $_GET['unpublish'] != '') unpublish_slide($_GET['unpublish']);		
	
	//ADD NEW CALLS
	if (isset($_POST['title']) && isset($_POST['img']) && isset($_POST['slide_parent']) )
	{
		if ($_POST['title'] != '' && $_POST['img'] != '' )
		{
			
			insert_slide_in_db(NULL,$_POST['title'],$_POST['title_short'],$_POST['text'],$_POST['link'],trim($_POST['img']),trim($_POST['publish']),trim($_POST['target']),trim($_POST['video']),$_POST['slide_parent'],'',$_POST['crop_location'],'',$_POST['edit_crop_location']);
		}
	}
	if (isset($_POST['slideshow_name']) && isset($_POST['slideshow_type']) )
	{
		if ($_POST['slideshow_name'] != '' && $_POST['slideshow_type'] != '' )
		{
			insert_slideshow_in_db(NULL,$_POST['slideshow_name'],$_POST['slideshow_type']);
		}
	}
	//EDIT A SLIDE
	if (isset($_POST['edit_id']) && isset($_POST['edit_title']) && isset($_POST['edit_img']) )
	{
		if ($_POST['edit_id'] != '' && $_POST['edit_title'] !='' && $_POST['edit_img'] != '' )
		{
			delete_slide($_POST['edit_id']);
			insert_slide_in_db($_POST['edit_id'],$_POST['edit_title'],$_POST['edit_title_short'],$_POST['edit_text'],$_POST['edit_link'],trim($_POST['edit_img']),trim($_POST['edit_publish']),trim($_POST['edit_target']),trim($_POST['edit_video']),$_POST['edit_slide_parent'],$_POST['edit_order'],$_POST['edit_crop_location']);
			
		}
	}
	//EDIT A SLIDESHOW
	if (isset($_POST['edit_slideshow_id']) && isset($_POST['edit_slideshow_name']) && isset($_POST['edit_slideshow_type']) )
	{
		if ($_POST['edit_slideshow_id'] != '' && $_POST['edit_slideshow_name'] !='' && $_POST['edit_slideshow_type'] != '' )
		{
			delete_slideshow($_POST['edit_slideshow_id'],1);
			insert_slideshow_in_db($_POST['edit_slideshow_id'],$_POST['edit_slideshow_name'],$_POST['edit_slideshow_type']);
			
		}
	}	

?>   
<div id="dialog" title="Confirmation Required" style="display:none;">
  You are about to delete an item. Continue?
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
            <li class="active"><a href="admin.php?page=duotive-slider">Slideshow</a></li>
            <li><a href="admin.php?page=duotive-sidebars">Sidebars</a></li>
			<li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li>
			<li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
			<li><a href="admin.php?page=duotive-pricing-table">Pricing</a></li>
            <li><a href="admin.php?page=duotive-contact">Contact page</a></li>
            <li><a href="admin.php?page=duotive-language">Language</a></li>                                                                                                
        </ul>
    </div>
    <div id="duotive-admin-panel">                                    
    	<h3>Slideshow</h3>
        <?php if ( isset($_GET['tab']) ) $currentPageTab = $_GET['tab']; else $currentPageTab = 'slider-settings'; ?>
        <ul class="ui-tabs-nav">
            <li<?php if ( $currentPageTab == 'slider-settings') echo ' class="ui-state-active"'; ?>><a href="admin.php?page=duotive-slider&tab=slider-settings">Slideshow settings</a></li>
            <li<?php if ( $currentPageTab == 'slideshows') echo ' class="ui-state-active"'; ?>><a href="admin.php?page=duotive-slider&tab=slideshows">Current slideshows</a></li>
            <li class="plus<?php if ( $currentPageTab == 'addslideshow') echo ' ui-state-active'; ?>"><a class="plus" href="admin.php?page=duotive-slider&tab=addslideshow"><span class="deco"></span>Add a new slideshow</a></li>            
   	        <li<?php if ( $currentPageTab == 'slides') echo ' class="ui-state-active"'; ?>><a href="admin.php?page=duotive-slider&tab=slides">Current slides</a></li>
            <li class="plus<?php if ( $currentPageTab == 'addslide') echo ' ui-state-active'; ?>"><a class="plus" href="admin.php?page=duotive-slider&tab=addslide"><span class="deco"></span>Add a new slide</a></li>
        </ul>
        <?php if ( $currentPageTab == 'slider-settings' ): ?>
            <div id="slider-settings" class="ui-tabs-panel">
                <form method="POST" action="" class="transform">
                <div class="slideshow-settings-row">
                    <div class="row-header">General<span class="front-page-row-icon">Settings</span></div>
                    <div class="row-content">
                        <input type="hidden" name="update_themeoptions" value="true" />
                        <div class="table-row clearfix">
                            <label for="dt_Slider">General slideshow</label>
                            <select name="dt_Slider">
                                <?php $dt_Slider = get_option('dt_Slider','slider-off'); ?>
                                <option value="slider-off" <?php if ( $dt_Slider == 'slider-off' ) echo 'selected="selected"'; ?>>Use on page / off</option>
                                <?php $slideshows = slideshow_require(); ?>
                                <?php foreach($slideshows as $slideshow): ?>
                                    <option value="<?php echo $slideshow->ID; ?>" <?php if ( $dt_Slider == $slideshow->ID ) echo 'selected="selected"'; ?>><?php echo $slideshow->SLIDESHOW_NAME; ?></option>
                                <?php endforeach; ?>                        
                            </select>
                        </div>
                        <div class="table-row table-row-last clearfix">
                            <input type="submit" name="search" value="Save settings" class="button" />
                        </div>  
                    </div>               
                </div>
                <div class="slideshow-settings-row">
                    <div class="row-header">Duotive Gallery slideshow<span class="front-page-row-icon">Settings</span></div>
                    <div class="row-content">
                        <input type="hidden" name="update_galleryoptions" value="true" />
                        <script type="text/javascript">
                        jQuery(document).ready(function() {
                            jQuery( "#dt_SliderGalleryHeightSlider" ).slider({
                                range: 'min',
                                value:jQuery( "#dt_SliderGalleryHeight" ).val(),
                                min: 400,
                                max: 800,
                                step: 10,
                                slide: function( event, ui ) {
                                    jQuery( "#dt_SliderGalleryHeight" ).val( ui.value );
                                }
                            });
                            jQuery( "#dt_SliderGalleryDurationSlider" ).slider({
                                range: 'min',
                                value:jQuery( "#dt_SliderGalleryDuration" ).val(),
                                min: 500,
                                max: 1500,
                                step: 10,
                                slide: function( event, ui ) {
                                    jQuery( "#dt_SliderGalleryDuration" ).val( ui.value );
                                }
                            });
                            jQuery( "#dt_SliderGalleryIntervalSlider" ).slider({
                                range: 'min',
                                value:jQuery( "#dt_SliderGalleryInterval" ).val(),
                                min: 3000,
                                max: 15000,
                                step: 100,
                                slide: function( event, ui ) {
                                    jQuery( "#dt_SliderGalleryInterval" ).val( ui.value );
                                }
                            });
                        });
                        </script>                         
                        <div class="table-row clearfix">                    
                            <?php $dt_SliderGalleryHeight = get_option('dt_SliderGalleryHeight','480'); ?>
                            <label for="dt_SliderGalleryHeight">Height:</label>
                            <input type="text" size="8" id="dt_SliderGalleryHeight" name="dt_SliderGalleryHeight" value="<?php echo get_option('dt_SliderGalleryHeight','480'); ?>" />
                            <div id="dt_SliderGalleryHeightSlider"></div>
                        </div>                 
                        <div class="table-row clearfix">     
                            <label for="dt_SliderGalleryLayout">Slider layout:</label>
                            <select name="dt_SliderGalleryLayout">
                              <?php $dt_SliderGalleryLayout = get_option('dt_SliderGalleryLayout','true'); ?>
                              <option value="single-image" <?php if ($dt_SliderGalleryLayout=='single-image') { echo 'selected'; } ?> >single image</option>                                                                     
                              <option value="gallery-layout" <?php if ($dt_SliderGalleryLayout=='gallery-layout') { echo 'selected'; } ?> >gallery</option> 
                            </select>
                            <img class="hint-icon" title="Enable auto-advance to the next slide." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                        </div>
                        <div class="table-row clearfix">                    
                            <?php $dt_SliderGalleryLayoutRows = get_option('dt_SliderGalleryLayoutRows','1'); ?>
                            <label for="dt_SliderGalleryLayoutRows">Number of rows:</label>
                            <input type="text" size="8" id="dt_SliderGalleryLayoutRows" name="dt_SliderGalleryLayoutRows" value="<?php echo get_option('dt_SliderGalleryLayoutRows','1'); ?>" />
                        </div>                                         
                        <div class="table-row clearfix">     
                            <label for="dt_SliderGalleryAutoAdvance">Auto-play:</label>
                            <select name="dt_SliderGalleryAutoAdvance">
                              <?php $dt_SliderGalleryAutoAdvance = get_option('dt_SliderGalleryAutoAdvance','true'); ?>
                              <option value="false" <?php if ($dt_SliderGalleryAutoAdvance=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderGalleryAutoAdvance=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>
                            <img class="hint-icon" title="Enable auto-advance to the next slide." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                        </div>
                        <div class="table-row  clearfix">                    
                            <?php $dt_SliderGalleryDuration = get_option('dt_SliderGalleryDuration','600'); ?>
                            <label for="dt_SliderGalleryDuration">Duration:</label>
                            <input type="text" size="8" id="dt_SliderGalleryDuration" name="dt_SliderGalleryDuration" value="<?php echo get_option('dt_SliderGalleryDuration','600'); ?>" />
                            <div id="dt_SliderGalleryDurationSlider"></div>
                            <img class="hint-icon" title="This value represents the transition effect duration. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>
                        <div class="table-row  clearfix">                    
                            <?php $dt_SliderGalleryInterval = get_option('dt_SliderGalleryInverval','5000'); ?>
                            <label for="dt_SliderGalleryInterval">Interval:</label>
                            <input type="text" size="8" id="dt_SliderGalleryInterval" name="dt_SliderGalleryInterval" value="<?php echo get_option('dt_SliderGalleryInterval','5000'); ?>" />
                            <div id="dt_SliderGalleryIntervalSlider"></div>
                            <img class="hint-icon" title="This value represents the delay time until auto-advancing to the next slide. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>
                        <div class="table-row clearfix">     
                            <label for="dt_SliderGalleryPauseOnHover">Pause on hover:</label>
                            <select name="dt_SliderGalleryPauseOnHover">
                              <?php $dt_SliderGalleryPauseOnHover = get_option('dt_SliderGalleryPauseOnHover','true'); ?>
                              <option value="false" <?php if ($dt_SliderGalleryPauseOnHover=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderGalleryPauseOnHover=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>
                            <img class="hint-icon" title="Disable auto-advance to the next slide when hovering over the image." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                        </div>      
                        <div class="table-row clearfix">     
                            <label for="dt_SliderGalleryArrows">Show arrows:</label>
                            <select name="dt_SliderGalleryArrows">
                              <?php $dt_SliderGalleryArrows = get_option('dt_SliderGalleryArrows','true'); ?>
                              <option value="false" <?php if ($dt_SliderGalleryArrows=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderGalleryArrows=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>
                        <div class="table-row clearfix">     
                            <label for="dt_SliderGalleryArrowsAutohide">Autohide arrows:</label>
                            <select name="dt_SliderGalleryArrowsAutohide">
                              <?php $dt_SliderGalleryArrowsAutohide = get_option('dt_SliderGalleryArrowsAutohide','true'); ?>
                              <option value="false" <?php if ($dt_SliderGalleryArrowsAutohide=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderGalleryArrowsAutohide=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>
                        <div class="table-row clearfix">     
                            <label for="dt_SliderGalleryKeybordControls">Keybord controls:</label>
                            <select name="dt_SliderGalleryKeybordControls">
                              <?php $dt_SliderGalleryKeybordControls = get_option('dt_SliderGalleryKeybordControls','true'); ?>
                              <option value="false" <?php if ($dt_SliderGalleryKeybordControls=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderFullWidthKeybordControls=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>                        
                        
                        <div class="table-row clearfix">     
                            <label for="dt_SliderGalleryTimer">Show timer:</label>
                            <select name="dt_SliderGalleryTimer">
                              <?php $dt_SliderGalleryTimer = get_option('dt_SliderGalleryTimer','true'); ?>
                              <option value="false" <?php if ($dt_SliderGalleryTimer=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderGalleryTimer=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div> 
                        <div class="table-row clearfix">     
                            <label for="dt_SliderGalleryScroll">Show scroll:</label>
                            <select name="dt_SliderGalleryScroll">
                              <?php $dt_SliderGalleryScroll = get_option('dt_SliderGalleryScroll','true'); ?>
                              <option value="false" <?php if ($dt_SliderGalleryScroll=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderGalleryScroll=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>
                        <div class="table-row clearfix">     
                            <label for="dt_SliderGalleryDescription">Show description:</label>
                            <select name="dt_SliderGalleryDescription">
                              <?php $dt_SliderGalleryDescription = get_option('dt_SliderGalleryDescription','true'); ?>
                              <option value="false" <?php if ($dt_SliderGalleryDescription=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderGalleryDescription=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>                                                            
                        <div class="table-row table-row-last clearfix">
                            <input type="submit" name="search" value="Save changes" class="button" />
                            <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                        </div>                        						                
                    </div>
                </div>
                <div class="slideshow-settings-row">
                    <div class="row-header">Duotive Presentation slideshow<span class="front-page-row-icon">Settings</span></div>
                    <div class="row-content">
                        <input type="hidden" name="update_presentationoptions" value="true" />
                        <script type="text/javascript">
                        jQuery(document).ready(function() {
                            jQuery( "#dt_SliderPresentationHeightSlider" ).slider({
                                range: 'min',
                                value:jQuery( "#dt_SliderPresentationHeight" ).val(),
                                min: 300,
                                max: 800,
                                step: 10,
                                slide: function( event, ui ) {
                                    jQuery( "#dt_SliderPresentationHeight" ).val( ui.value );
                                }
                            });	
                            jQuery( "#dt_SliderPresentationDurationSlider" ).slider({
                                range: 'min',
                                value:jQuery( "#dt_SliderPresentationDuration" ).val(),
                                min: 500,
                                max: 1500,
                                step: 10,
                                slide: function( event, ui ) {
                                    jQuery( "#dt_SliderPresentationDuration" ).val( ui.value );
                                }
                            });
                            jQuery( "#dt_SliderPresentationIntervalSlider" ).slider({
                                range: 'min',
                                value:jQuery( "#dt_SliderPresentationInterval" ).val(),
                                min: 3000,
                                max: 15000,
                                step: 100,
                                slide: function( event, ui ) {
                                    jQuery( "#dt_SliderPresentationInterval" ).val( ui.value );
                                }
                            });														
                        });
                        </script>                         
                        <div class="table-row  clearfix">                    
                            <?php $dt_SliderPresentationHeight = get_option('dt_SliderPresentationHeight','300'); ?>
                            <label for="dt_SliderPresentationHeight">Height:</label>
                            <input type="text" size="8" id="dt_SliderPresentationHeight" name="dt_SliderPresentationHeight" value="<?php echo get_option('dt_SliderPresentationHeight','300'); ?>" />
                            <div id="dt_SliderPresentationHeightSlider"></div>
                        </div>
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationAutoAdvance">Auto-play:</label>
                            <select name="dt_SliderPresentationAutoAdvance">
                              <?php $dt_SliderPresentationAutoAdvance = get_option('dt_SliderPresentationAutoAdvance','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationAutoAdvance=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationAutoAdvance=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>
                            <img class="hint-icon" title="Enable auto-advance to the next slide." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                        </div>
                        <div class="table-row  clearfix">                    
                            <?php $dt_SliderPresentationDuration = get_option('dt_SliderPresentationDuration','600'); ?>
                            <label for="dt_SliderPresentationDuration">Duration:</label>
                            <input type="text" size="8" id="dt_SliderPresentationDuration" name="dt_SliderPresentationDuration" value="<?php echo get_option('dt_SliderPresentationDuration','600'); ?>" />
                            <div id="dt_SliderPresentationDurationSlider"></div>
                            <img class="hint-icon" title="This value represents the transition effect duration. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>
                        <div class="table-row  clearfix">                    
                            <?php $dt_SliderPresentationInterval = get_option('dt_SliderPresentationInverval','5000'); ?>
                            <label for="dt_SliderPresentationInterval">Interval:</label>
                            <input type="text" size="8" id="dt_SliderPresentationInterval" name="dt_SliderPresentationInterval" value="<?php echo get_option('dt_SliderPresentationInterval','5000'); ?>" />
                            <div id="dt_SliderPresentationIntervalSlider"></div>
                            <img class="hint-icon" title="This value represents the delay time until auto-advancing to the next slide. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationPauseOnHover">Pause on hover:</label>
                            <select name="dt_SliderPresentationPauseOnHover">
                              <?php $dt_SliderPresentationPauseOnHover = get_option('dt_SliderPresentationPauseOnHover','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationPauseOnHover=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationPauseOnHover=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>
                            <img class="hint-icon" title="Disable auto-advance to the next slide when hovering over the image." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                        </div>      
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationArrows">Show arrows:</label>
                            <select name="dt_SliderPresentationArrows">
                              <?php $dt_SliderPresentationArrows = get_option('dt_SliderPresentationArrows','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationArrows=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationArrows=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div> 
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationTimer">Show timer:</label>
                            <select name="dt_SliderPresentationTimer">
                              <?php $dt_SliderPresentationTimer = get_option('dt_SliderPresentationTimer','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationTimer=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationTimer=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationIcon">Show icon:</label>
                            <select name="dt_SliderPresentationIcon">
                              <?php $dt_SliderPresentationIcon = get_option('dt_SliderPresentationIcon','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationIcon=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationIcon=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div> 
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationGallery">Show gallery:</label>
                            <select name="dt_SliderPresentationGallery">
                              <?php $dt_SliderPresentationGallery = get_option('dt_SliderPresentationGallery','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationGallery=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationGallery=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationGalleryNumber">Show gallery number:</label>
                            <select name="dt_SliderPresentationGalleryNumber">
                              <?php $dt_SliderPresentationGalleryNumber = get_option('dt_SliderPresentationGalleryNumber','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationGalleryNumber=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationGalleryNumber=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div> 
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationGalleryTitle">Show gallery title:</label>
                            <select name="dt_SliderPresentationGalleryTitle">
                              <?php $dt_SliderPresentationGalleryTitle = get_option('dt_SliderPresentationGalleryTitle','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationGalleryTitle=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationGalleryTitle=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div> 
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationScroll">Show scroll:</label>
                            <select name="dt_SliderPresentationScroll">
                              <?php $dt_SliderPresentationScroll = get_option('dt_SliderPresentationScroll','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationScroll=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationScroll=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>                                                                                                    
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationKeybordControl">Keybord control:</label>
                            <select name="dt_SliderPresentationKeybordControl">
                              <?php $dt_SliderPresentationKeybordControl = get_option('dt_SliderPresentationKeybordControl','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationKeybordControl=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationKeybordControl=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationDescription">Show description:</label>
                            <select name="dt_SliderPresentationDescription">
                              <?php $dt_SliderPresentationDescription = get_option('dt_SliderPresentationDescription','true'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationDescription=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationDescription=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>     
                        <div class="table-row clearfix">     
                            <label for="dt_SliderPresentationDescriptionAutoHide">Auto-hide description:</label>
                            <select name="dt_SliderPresentationDescriptionAutoHide">
                              <?php $dt_SliderPresentationDescriptionAutoHide = get_option('dt_SliderPresentationDescriptionAutoHide','false'); ?>
                              <option value="false" <?php if ($dt_SliderPresentationDescriptionAutoHide=='false') { echo 'selected'; } ?> >No</option>                                                                     
                              <option value="true" <?php if ($dt_SliderPresentationDescriptionAutoHide=='true') { echo 'selected'; } ?> >Yes</option> 
                            </select>                    
                        </div>                                                                                                                                              
                        <div class="table-row table-row-last clearfix">
                            <input type="submit" name="search" value="Save changes" class="button" />
                            <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                        </div>                    
                    </div>
                </div>                         
                <div class="slideshow-settings-row">
                    <div class="row-header">Duotive Complex slideshow<span class="front-page-row-icon">Settings</span></div>
                    <div class="row-content">
                        <input type="hidden" name="update_complexoptions" value="true" />
                        <script type="text/javascript">
                        jQuery(document).ready(function() {
                            jQuery( "#dt_SliderComplexHeightSlider" ).slider({
                                range: 'min',
                                value:jQuery( "#dt_SliderComplexHeight" ).val(),
                                min: 300,
                                max: 600,
                                step: 10,
                                slide: function( event, ui ) {
                                    jQuery( "#dt_SliderComplexHeight" ).val( ui.value );
                                }
                            });	
							jQuery( "#dt_SliderComplexDurationSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderComplexDuration" ).val(),
								min: 500,
								max: 1500,
								step: 10,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderComplexDuration" ).val( ui.value );
								}
							});
							jQuery( "#dt_SliderComplexIntervalSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderComplexInterval" ).val(),
								min: 3000,
								max: 15000,
								step: 100,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderComplexInterval" ).val( ui.value );
								}
							});														
						});
						</script>                         
						<div class="table-row  clearfix">                    
							<?php $dt_SliderComplexHeight = get_option('dt_SliderComplexHeight','378'); ?>
							<label for="dt_SliderComplexHeight">Height:</label>
							<input type="text" size="8" id="dt_SliderComplexHeight" name="dt_SliderComplexHeight" value="<?php echo get_option('dt_SliderComplexHeight','378'); ?>" />
							<div id="dt_SliderComplexHeightSlider"></div>
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderComplexAutoAdvance">Auto-play:</label>
							<select name="dt_SliderComplexAutoAdvance">
							  <?php $dt_SliderComplexAutoAdvance = get_option('dt_SliderComplexAutoAdvance','true'); ?>
							  <option value="false" <?php if ($dt_SliderComplexAutoAdvance=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderComplexAutoAdvance=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>
							<img class="hint-icon" title="Enable auto-advance to the next slide." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
						</div>
						<div class="table-row  clearfix">                    
							<?php $dt_SliderComplexDuration = get_option('dt_SliderComplexDuration','600'); ?>
							<label for="dt_SliderComplexDuration">Duration:</label>
							<input type="text" size="8" id="dt_SliderComplexDuration" name="dt_SliderComplexDuration" value="<?php echo get_option('dt_SliderComplexDuration','600'); ?>" />
							<div id="dt_SliderComplexDurationSlider"></div>
							<img class="hint-icon" title="This value represents the transition effect duration. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
						</div>
						<div class="table-row  clearfix">                    
							<?php $dt_SliderComplexInterval = get_option('dt_SliderComplexInverval','5000'); ?>
							<label for="dt_SliderComplexInterval">Interval:</label>
							<input type="text" size="8" id="dt_SliderComplexInterval" name="dt_SliderComplexInterval" value="<?php echo get_option('dt_SliderComplexInterval','5000'); ?>" />
							<div id="dt_SliderComplexIntervalSlider"></div>
							<img class="hint-icon" title="This value represents the delay time until auto-advancing to the next slide. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderComplexPauseOnHover">Pause on hover:</label>
							<select name="dt_SliderComplexPauseOnHover">
							  <?php $dt_SliderComplexPauseOnHover = get_option('dt_SliderComplexPauseOnHover','true'); ?>
							  <option value="false" <?php if ($dt_SliderComplexPauseOnHover=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderComplexPauseOnHover=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>
							<img class="hint-icon" title="Disable auto-advance to the next slide when hovering over the image." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
						</div>      
						<div class="table-row clearfix">     
							<label for="dt_SliderComplexArrows">Show arrows:</label>
							<select name="dt_SliderComplexArrows">
							  <?php $dt_SliderComplexArrows = get_option('dt_SliderComplexArrows','true'); ?>
							  <option value="false" <?php if ($dt_SliderComplexArrows=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderComplexArrows=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div> 
						<div class="table-row clearfix">     
							<label for="dt_SliderComplexTimer">Show timer:</label>
							<select name="dt_SliderComplexTimer">
							  <?php $dt_SliderComplexTimer = get_option('dt_SliderComplexTimer','true'); ?>
							  <option value="false" <?php if ($dt_SliderComplexTimer=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderComplexTimer=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderComplexDescription">Show description:</label>
							<select name="dt_SliderComplexDescription">
							  <?php $dt_SliderComplexDescription = get_option('dt_SliderComplexDescription','true'); ?>
							  <option value="false" <?php if ($dt_SliderComplexDescription=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderComplexDescription=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>  
						<div class="table-row clearfix">     
							<label for="dt_SliderComplexGallery">Show gallery:</label>
							<select name="dt_SliderComplexGallery">
							  <?php $dt_SliderComplexGallery = get_option('dt_SliderComplexGallery','true'); ?>
							  <option value="false" <?php if ($dt_SliderComplexGallery=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderComplexGallery=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div> 
						<div class="table-row clearfix">     
							<label for="dt_SliderComplexIcon">Show icon:</label>
							<select name="dt_SliderComplexIcon">
							  <?php $dt_SliderComplexIcon = get_option('dt_SliderComplexIcon','true'); ?>
							  <option value="false" <?php if ($dt_SliderComplexIcon=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderComplexIcon=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>                                                                                                                                                                                                     
						<div class="table-row table-row-last clearfix">
							<input type="submit" name="search" value="Save changes" class="button" />
							<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
						</div>                      
					</div>
				</div>
				<div class="slideshow-settings-row">
					<div class="row-header">Duotive Full Screen slideshow<span class="front-page-row-icon">Settings</span></div>
					<div class="row-content">
						<input type="hidden" name="update_fullscreenoptions" value="true" />
						<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery( "#dt_SliderFullScreenHeightSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderFullScreenHeight" ).val(),
								min: 0,
								max: 500,
								step: 10,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderFullScreenHeight" ).val( ui.value );
								}
							});
							jQuery( "#dt_SliderFullScreenDurationSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderFullScreenDuration" ).val(),
								min: 500,
								max: 1500,
								step: 10,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderFullScreenDuration" ).val( ui.value );
								}
							});
							jQuery( "#dt_SliderFullScreenIntervalSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderFullScreenInterval" ).val(),
								min: 3000,
								max: 15000,
								step: 100,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderFullScreenInterval" ).val( ui.value );
								}
							});
						});
						</script>                         
						<div class="table-row clearfix">                    
							<?php $dt_SliderFullScreenHeight = get_option('dt_SliderFullScreenHeight','240'); ?>
							<label for="dt_SliderFullScreenHeight">Height:</label>
							<input type="text" size="8" id="dt_SliderFullScreenHeight" name="dt_SliderFullScreenHeight" value="<?php echo get_option('dt_SliderFullScreenHeight','240'); ?>" />
							<div id="dt_SliderFullScreenHeightSlider"></div>
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderFullScreenAutoAdvance">Auto-play:</label>
							<select name="dt_SliderFullScreenAutoAdvance">
							  <?php $dt_SliderFullScreenAutoAdvance = get_option('dt_SliderFullScreenAutoAdvance','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullScreenAutoAdvance=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullScreenAutoAdvance=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>
							<img class="hint-icon" title="Enable auto-advance to the next slide." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
						</div>
						<div class="table-row  clearfix">                    
							<?php $dt_SliderFullScreenDuration = get_option('dt_SliderFullScreenDuration','600'); ?>
							<label for="dt_SliderFullScreenDuration">Duration:</label>
							<input type="text" size="8" id="dt_SliderFullScreenDuration" name="dt_SliderFullScreenDuration" value="<?php echo get_option('dt_SliderFullScreenDuration','600'); ?>" />
							<div id="dt_SliderFullScreenDurationSlider"></div>
							<img class="hint-icon" title="This value represents the transition effect duration. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
						</div>
						<div class="table-row  clearfix">                    
							<?php $dt_SliderFullScreenInterval = get_option('dt_SliderFullScreenInverval','5000'); ?>
							<label for="dt_SliderFullScreenInterval">Interval:</label>
							<input type="text" size="8" id="dt_SliderFullScreenInterval" name="dt_SliderFullScreenInterval" value="<?php echo get_option('dt_SliderFullScreenInterval','5000'); ?>" />
							<div id="dt_SliderFullScreenIntervalSlider"></div>
							<img class="hint-icon" title="This value represents the delay time until auto-advancing to the next slide. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
						</div>    
						<div class="table-row clearfix">     
							<label for="dt_SliderFullScreenArrows">Show arrows:</label>
							<select name="dt_SliderFullScreenArrows">
							  <?php $dt_SliderFullScreenArrows = get_option('dt_SliderFullScreenArrows','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullScreenArrows=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullScreenArrows=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderFullScreenGallery">Show gallery:</label>
							<select name="dt_SliderFullScreenGallery">
							  <?php $dt_SliderFullScreenGallery = get_option('dt_SliderFullScreenGallery','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullScreenGallery=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullScreenGallery=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div> 
						<div class="table-row clearfix">     
							<label for="dt_SliderFullScreenDescription">Show description:</label>
							<select name="dt_SliderFullScreenDescription">
							  <?php $dt_SliderFullScreenDescription = get_option('dt_SliderFullScreenDescription','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullScreenDescription=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullScreenDescription=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>                                            
						<div class="table-row clearfix">     
							<label for="dt_SliderFullScreenKeybordControls">Keybord controls:</label>
							<select name="dt_SliderFullScreenKeybordControls">
							  <?php $dt_SliderFullScreenKeybordControls = get_option('dt_SliderFullScreenKeybordControls','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullScreenKeybordControls=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullScreenKeybordControls=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderFullScreenBgPosition">Background position:</label>
							<select name="dt_SliderFullScreenBgPosition">
							  <?php $dt_SliderFullScreenBgPosition = get_option('dt_SliderFullScreenBgPosition','left top'); ?>
							  <option value="left top" <?php if ($dt_SliderFullScreenBgPosition=='left top') { echo 'selected'; } ?> >left top</option>                                                                     
							  <option value="left center" <?php if ($dt_SliderFullScreenBgPosition=='left center') { echo 'selected'; } ?> >left center</option>                                                                     
							  <option value="left bottom" <?php if ($dt_SliderFullScreenBgPosition=='left bottom') { echo 'selected'; } ?> >left bottom</option>
							  <option value="center top" <?php if ($dt_SliderFullScreenBgPosition=='center top') { echo 'selected'; } ?> >center top</option>                                                                     
							  <option value="center center" <?php if ($dt_SliderFullScreenBgPosition=='center center') { echo 'selected'; } ?> >center center</option>                                                                     
							  <option value="center bottom" <?php if ($dt_SliderFullScreenBgPosition=='center bottom') { echo 'selected'; } ?> >center bottom</option>
							  <option value="right top" <?php if ($dt_SliderFullScreenBgPosition=='right top') { echo 'selected'; } ?> >right top</option>                                                                     
							  <option value="right center" <?php if ($dt_SliderFullScreenBgPosition=='right center') { echo 'selected'; } ?> >right center</option>                                                                     
							  <option value="right bottom" <?php if ($dt_SliderFullScreenBgPosition=='right bottom') { echo 'selected'; } ?> >right bottom</option>                                                                                                                                                                             
							</select>                    
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderFullScreenBgRepeat">Background repeat:</label>
							<select name="dt_SliderFullScreenBgRepeat">
							  <?php $dt_SliderFullScreenBgRepeat = get_option('dt_SliderFullScreenBgRepeat','no-repeat'); ?>
							  <option value="no-repeat" <?php if ($dt_SliderFullScreenBgPosition=='no-repeat') { echo 'selected'; } ?> >no-repeat</option>
							  <option value="repeat-x" <?php if ($dt_SliderFullScreenBgPosition=='repeat-x') { echo 'selected'; } ?> >repeat-x</option>                                                                                               
							  <option value="repeat-y" <?php if ($dt_SliderFullScreenBgPosition=='repeat-y') { echo 'selected'; } ?> >repeat-y</option>                                                                                               
							  <option value="repeat" <?php if ($dt_SliderFullScreenBgPosition=='repeat') { echo 'selected'; } ?> >repeat</option>                                                                                                                                                   
							</select>                    
						</div>                                            
						<div class="table-row table-row-last clearfix">
							<input type="submit" name="search" value="Save changes" class="button" />
							<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
						</div>                    
					</div>                    
				</div>                        
				<div class="slideshow-settings-row">
					<div class="row-header">Duotive Full Width slideshow<span class="front-page-row-icon">Settings</span></div>
					<div class="row-content">
						<input type="hidden" name="update_fullwidthoptions" value="true" />
						<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery( "#dt_SliderFullWidthHeightSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderFullWidthHeight" ).val(),
								min: 400,
								max: 800,
								step: 10,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderFullWidthHeight" ).val( ui.value );
								}
							});
							jQuery( "#dt_SliderFullWidthDurationSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderFullWidthDuration" ).val(),
								min: 500,
								max: 1500,
								step: 10,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderFullWidthDuration" ).val( ui.value );
								}
							});
							jQuery( "#dt_SliderFullWidthIntervalSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderFullWidthInterval" ).val(),
								min: 3000,
								max: 15000,
								step: 100,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderFullWidthInterval" ).val( ui.value );
								}
							});
							jQuery( "#dt_SliderFullWidthDescBoxWidthSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderFullWidthDescBoxWidth" ).val(),
								min: 400,
								max: 960,
								step: 10,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderFullWidthDescBoxWidth" ).val( ui.value );
								}
							});	
							jQuery( "#dt_SliderFullWidthDescBoxHeightSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderFullWidthDescBoxHeight" ).val(),
								min: 120,
								max: 900,
								step: 10,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderFullWidthDescBoxHeight" ).val( ui.value );
								}
							});	  													
						});
						</script>                         
						<div class="table-row clearfix">                    
							<?php $dt_SliderFullWidthHeight = get_option('dt_SliderFullWidthHeight','500'); ?>
							<label for="dt_SliderFullWidthHeight">Height:</label>
							<input type="text" size="8" id="dt_SliderFullWidthHeight" name="dt_SliderFullWidthHeight" value="<?php echo get_option('dt_SliderFullWidthHeight','500'); ?>" />
							<div id="dt_SliderFullWidthHeightSlider"></div>
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthAutoAdvance">Auto-play:</label>
							<select name="dt_SliderFullWidthAutoAdvance">
							  <?php $dt_SliderFullWidthAutoAdvance = get_option('dt_SliderFullWidthAutoAdvance','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthAutoAdvance=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthAutoAdvance=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>
							<img class="hint-icon" title="Enable auto-advance to the next slide." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
						</div>
						<div class="table-row  clearfix">                    
							<?php $dt_SliderFullWidthDuration = get_option('dt_SliderFullWidthDuration','600'); ?>
							<label for="dt_SliderFullWidthDuration">Duration:</label>
							<input type="text" size="8" id="dt_SliderFullWidthDuration" name="dt_SliderFullWidthDuration" value="<?php echo get_option('dt_SliderFullWidthDuration','600'); ?>" />
							<div id="dt_SliderFullWidthDurationSlider"></div>
							<img class="hint-icon" title="This value represents the transition effect duration. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
						</div>
						<div class="table-row  clearfix">                    
							<?php $dt_SliderFullWidthInterval = get_option('dt_SliderFullWidthInverval','5000'); ?>
							<label for="dt_SliderFullWidthInterval">Interval:</label>
							<input type="text" size="8" id="dt_SliderFullWidthInterval" name="dt_SliderFullWidthInterval" value="<?php echo get_option('dt_SliderFullWidthInterval','5000'); ?>" />
							<div id="dt_SliderFullWidthIntervalSlider"></div>
							<img class="hint-icon" title="This value represents the delay time until auto-advancing to the next slide. Measured in milliseconds (e.g. 1000 = 1s)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthPauseOnHover">Pause on hover:</label>
							<select name="dt_SliderFullWidthPauseOnHover">
							  <?php $dt_SliderFullWidthPauseOnHover = get_option('dt_SliderFullWidthPauseOnHover','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthPauseOnHover=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthPauseOnHover=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>
							<img class="hint-icon" title="Disable auto-advance to the next slide when hovering over the image." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
						</div>      
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthArrows">Show arrows:</label>
							<select name="dt_SliderFullWidthArrows">
							  <?php $dt_SliderFullWidthArrows = get_option('dt_SliderFullWidthArrows','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthArrows=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthArrows=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthArrowsAutohide">Autohide arrows:</label>
							<select name="dt_SliderFullWidthArrowsAutohide">
							  <?php $dt_SliderFullWidthArrowsAutohide = get_option('dt_SliderFullWidthArrowsAutohide','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthArrowsAutohide=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthArrowsAutohide=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>                    
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthKeybordControls">Keybord controls:</label>
							<select name="dt_SliderFullWidthKeybordControls">
							  <?php $dt_SliderFullWidthKeybordControls = get_option('dt_SliderFullWidthKeybordControls','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthKeybordControls=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthKeybordControls=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>    
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthGallery">Show gallery:</label>
							<select name="dt_SliderFullWidthGallery">
							  <?php $dt_SliderFullWidthGallery = get_option('dt_SliderFullWidthGallery','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthGallery=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthGallery=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>  
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthGalleryAutohide">Autohide gallery:</label>
							<select name="dt_SliderFullWidthGalleryAutohide">
							  <?php $dt_SliderFullWidthGalleryAutohide = get_option('dt_SliderFullWidthGalleryAutohide','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthGalleryAutohide=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthGalleryAutohide=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>    
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthTitle">Show title:</label>
							<select name="dt_SliderFullWidthTitle">
							  <?php $dt_SliderFullWidthTitle = get_option('dt_SliderFullWidthTitle','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthTitle=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthTitle=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>   
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthTitleAlign">Title align:</label>
							<select name="dt_SliderFullWidthTitleAlign">
							  <?php $dt_SliderFullWidthTitleAlign = get_option('dt_SliderFullWidthTitleAlign','true'); ?>
							  <option value="left" <?php if ($dt_SliderFullWidthTitleAlign=='left') { echo 'selected'; } ?> >Left</option>                                                                     
							  <option value="center" <?php if ($dt_SliderFullWidthTitleAlign=='center') { echo 'selected'; } ?> >Center</option>
							  <option value="right" <?php if ($dt_SliderFullWidthTitleAlign=='right') { echo 'selected'; } ?> >Right</option>                           
							</select>                    
						</div>   
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthDescription">Show description:</label>
							<select name="dt_SliderFullWidthDescription">
							  <?php $dt_SliderFullWidthDescription = get_option('dt_SliderFullWidthDescription','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthDescription=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthDescription=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>
						<div class="table-row clearfix">                    
							<?php $dt_SliderFullWidthDescBoxWidth = get_option('dt_SliderFullWidthDescBoxWidth','480'); ?>
							<label for="dt_SliderFullWidthDescBoxWidth">Description box width:</label>
							<input type="text" size="8" id="dt_SliderFullWidthDescBoxWidth" name="dt_SliderFullWidthDescBoxWidth" value="<?php echo get_option('dt_SliderFullWidthDescBoxWidth','480'); ?>" />
							<div id="dt_SliderFullWidthDescBoxWidthSlider"></div>
						</div>
						<div class="table-row clearfix">                    
							<?php $dt_SliderFullWidthDescBoxHeight = get_option('dt_SliderFullWidthDescBoxHeight','220'); ?>
							<label for="dt_SliderFullWidthDescBoxHeight">Description box height:</label>
							<input type="text" size="8" id="dt_SliderFullWidthDescBoxHeight" name="dt_SliderFullWidthDescBoxHeight" value="<?php echo get_option('dt_SliderFullWidthDescBoxHeight','220'); ?>" />
							<div id="dt_SliderFullWidthDescBoxHeightSlider"></div>
						</div>  
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthTimer">Show timer:</label>
							<select name="dt_SliderFullWidthTimer">
							  <?php $dt_SliderFullWidthTimer = get_option('dt_SliderFullWidthTimer','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthTimer=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthTimer=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>  
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthIcon">Show icon:</label>
							<select name="dt_SliderFullWidthIcon">
							  <?php $dt_SliderFullWidthIcon = get_option('dt_SliderFullWidthIcon','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthIcon=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthIcon=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>   
						<div class="table-row clearfix">     
							<label for="dt_SliderFullWidthHelpBox">Show help:</label>
							<select name="dt_SliderFullWidthHelpBox">
							  <?php $dt_SliderFullWidthHelpBox = get_option('dt_SliderFullWidthHelpBox','true'); ?>
							  <option value="false" <?php if ($dt_SliderFullWidthHelpBox=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderFullWidthHelpBox=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>                    
						</div>
						<div class="table-row clearfix">            
							<label for="dt_SliderFullWidthHelpBoxContent">Help box content:</label>
							<textarea rows="3" cols="50" name="dt_SliderFullWidthHelpBoxContent"><?php echo get_option('dt_SliderFullWidthHelpBoxContent','Press the left and right keys on your keyboard to browse through the images.'); ?></textarea>              
						</div>                                                                                                                                                                                                                         
						<div class="table-row table-row-last clearfix">
							<input type="submit" name="search" value="Save changes" class="button" />
							<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
						</div>                    
					</div>                    
				</div>            
				<div class="slideshow-settings-row">
					<div class="row-header">Content slideshow<span class="front-page-row-icon">Settings</span></div>
					<div class="row-content">
						<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery( "#dt_SliderContentHeightSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderContentHeight" ).val(),
								min: 140,
								max: 750,
								step: 10,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderContentHeight" ).val( ui.value );
								}
							});					
							jQuery( "#dt_SliderContentSpeedSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderContentSpeed" ).val(),
								min: 400,
								max: 2000,
								step: 100,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderContentSpeed" ).val( ui.value );
								}
							});
							jQuery( "#dt_SliderContentSpeed" ).val(jQuery( "#dt_SliderContentSpeedSlider" ).slider( "value" ) );
							
							jQuery( "#dt_SliderContentPauseSlider" ).slider({
								range: 'min',
								value:jQuery( "#dt_SliderContentPause" ).val(),
								min: 1000,
								max: 12000,
								step: 500,
								slide: function( event, ui ) {
									jQuery( "#dt_SliderContentPause" ).val( ui.value );
								}
							});
							jQuery( "#dt_SliderContentPause" ).val(jQuery( "#dt_SliderContentPauseSlider" ).slider( "value" ) );					
						});
						</script>            
						<input type="hidden" name="update_contentoptions" value="true" />
						<div class="table-row clearfix">       
							<?php $dt_SliderContentHeight = get_option('dt_SliderContentHeight','423'); ?>
							<label for="dt_SliderContentHeight">Height:</label>
							<input type="text" size="8" id="dt_SliderContentHeight" name="dt_SliderContentHeight" value="<?php echo get_option('dt_SliderContentHeight','423'); ?>" />
							<div id="dt_SliderContentHeightSlider"></div>
						</div>
						<div class="table-row clearfix">     
							<label for="dt_SliderContentAutoplay">Auto-play:</label>
							<select name="dt_SliderContentAutoplay">
							  <?php $dt_SliderContentAutoplay = get_option('dt_SliderContentAutoplay'); ?>
							  <option value="false" <?php if ($dt_SliderContentAutoplay=='false') { echo 'selected'; } ?> >No</option>                                                                     
							  <option value="true" <?php if ($dt_SliderContentAutoplay=='true') { echo 'selected'; } ?> >Yes</option> 
							</select>
							<img class="hint-icon" title="Enable auto-advance to the next slide." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
						</div>                                                        
						<div class="table-row clearfix">       
							<?php $dt_SliderContentSpeed = get_option('dt_SliderContentSpeed','500'); ?>
							<label for="dt_SliderContentSpeed">Duration:</label>
							<input type="text" size="8" id="dt_SliderContentSpeed" name="dt_SliderContentSpeed" value="<?php echo get_option('dt_SliderContentSpeed','500'); ?>" />
							<div id="dt_SliderContentSpeedSlider"></div>
							<img class="hint-icon" title="The time that the transition defined above will take to get from a slide to another." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                                                                                             
						</div>                     
						<div class="table-row clearfix">       
							<?php $dt_SliderContentPause = get_option('dt_SliderContentPause','3000'); ?>
							<label for="dt_SliderContentPause">Interval:</label>
							<input type="text" size="8" name="dt_SliderContentPause" id="dt_SliderContentPause" value="<?php echo get_option('dt_SliderContentPause','3000'); ?>" />
							<div id="dt_SliderContentPauseSlider"></div>
							<img class="hint-icon" title="The time that the transition defined above will take to get from a slide to another." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                                                                     
						</div>                                            
						<div class="table-row table-row-last clearfix">
							<input type="submit" name="search" value="Save changes" class="button" />
							<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
						</div>
					</div>
				</div>                   	                                            
				</form>                  
			</div>
        <?php endif; ?>
        <?php if ( $currentPageTab == 'addslideshow' ): ?>           
            <div id="addslideshow" class="ui-tabs-panel">
                <form method="POST" action="" class="transform">
                    <div class="table-row clearfix">            
                        <label for="slideshow_name">Slideshow name:</label>
                        <input name="slideshow_name" type="text" value="" size="50"/>                            
                    </div>
                    <div class="table-row clearfix">            
                        <label for="slideshow_type">Slideshow type:</label>
                        <select name="slideshow_type">
                            <option value="gallery-slider">Gallery Slider</option>     
                            <option value="fullscreen-slider">Fullscreen Slider</option>                                        
                            <option value="fullwidth-slider">Fullwidth Slider</option>                        
                            <option value="complex-slider">Complex Slider</option>
                            <option value="presentation-slider">Presentation Slider</option>                                                
                            <option value="content-slider">Content Slider</option>                                           
                        </select>
                    </div>                                            
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Add slideshow" class="button" />
                    </div>                        							                        
                </form>
            </div>  
        <?php endif; ?>
        <?php if ( $currentPageTab == 'addslide' ): ?>             
            <div id="addslide" class="ui-tabs-panel">
                <form method="POST" action="#addslide" class="transform">
                    <div class="table-row clearfix">
                        <?php $slideshows = slideshow_require(); ?>
                        <?php if ( count($slideshows) > 0 ): ?>
                            <label for="slide_parent">Parent:</label>
                            <select name="slide_parent">
                                <?php foreach($slideshows as $slideshow): ?>
                                <option value="<?php echo $slideshow->ID; ?>"><?php echo $slideshow->SLIDESHOW_NAME; ?></option>   
                                <?php endforeach; ?>                  
                            </select>
                        <?php else: ?>
                            <div class="page-error">There aren't any slideshows added yet.</div>
                        <?php endif; ?>
                    </div>
                    <div class="table-row clearfix">
                        <label for="title">Slide title:</label>
                        <input class="fullwidth" name="title" type="text" onfocus="if(this.value=='add title') this.value='';" onblur="if(this.value=='') this.value='add title';" value="add title" size="50"/>
                    </div>
                    <div class="table-row clearfix">
                        <label for="title_short">Slide presentation short title:</label>
                        <input class="fullwidth" name="title_short" type="text" onfocus="if(this.value=='add title') this.value='';" onblur="if(this.value=='') this.value='add title';" value="add title" size="50"/>
                        <img class="hint-icon" title="This short title will be used in the Presentation Slider's scrolling gallery, if it has been chosen." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                
                    <div class="table-row clearfix">
                        <label for="text">Slide description:</label>
                        <textarea class="fullwidth" rows="9" cols="50" name="text" onfocus="if(this.value=='add description') this.value='';" onblur="if(this.value=='') this.value='add description';" >add description</textarea>                            
                    </div>
                    <div class="table-row clearfix">
                        <label for="img">Slide image:</label>
                        <input id="slide_image" class="fullwidth" name="img" type="text" onfocus="if(this.value=='add image') this.value='';" onblur="if(this.value=='') this.value='add image';" value="add image" size="50"/>
                        <span class="upload_or">OR</span>
                        <input id="slide_image_button" type="button" value="Upload image" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="crop_location">Crop location:</label>
                        <select name="crop_location">
                            <option value="c">Crop on the center</option>
                            <option value="t">Crop on the top</option>
                            <option value="tr">Crop on the top right</option>
                            <option value="tl">Crop on the top left</option>
                            <option value="b">Crop on the bottom</option>
                            <option value="br">Crop on the bottom right</option>
                            <option value="bl">Crop on the bottom left</option>
                            <option value="l">Crop on the left</option>
                            <option value="r">Crop on the right</option>
                        </select>                    
                    </div>                 
                    <div class="table-row clearfix">
                        <label for="target">Target type:</label>
                        <div class="radio-in-line"><input type="radio" checked name="target" value="url">URL</div>
                        <div class="radio-in-line"><input type="radio" name="target" value="video">Video</div>
                        <div class="radio-in-line"><input type="radio" name="target" value="image">Image</div>                    
                        <img style="margin-top:2px;" class="hint-icon" title="Select which type of resource will be opened when this slide is clicked." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                                     
                    <div class="table-row clearfix">
                        <label for="link">Slide URL:</label>
                        <input class="fullwidth" name="link" type="text" onfocus="if(this.value=='#') this.value='';" onblur="if(this.value=='') this.value='#';" value="#" size="50"/>                            
                        <img class="hint-icon" title="Where to navigate if the slide is clicked. Fill this only if you selected the target type to URL." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>             
                    <div class="table-row clearfix">
                        <label for="video">Slide video URL:</label>
                        <input class="fullwidth" name="video" type="text" onfocus="if(this.value=='add video url') this.value='';" onblur="if(this.value=='') this.value='add video url';" value="#" size="50"/>                            
                        <img class="hint-icon" title="If you selected the target to be Video, here is where you should insert the video's link." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                
                    <div class="table-row clearfix">
                        <label for="publish">Published:</label>
                        <div class="radio-in-line"><input type="radio" checked name="publish" value="1">Yes</div>
                        <div class="radio-in-line"><input type="radio" name="publish" value="0">No</div>
                        <img class="hint-icon" title="If this is set to Yes your newly added slide will be added immediatly to your current published slides. You can change this at any time from the Current slides tab by clicking on the status icon." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                              
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Add slide" class="button" />
                    </div>                        							                        
                </form>
            </div>
        <?php endif; ?>
        <?php if ( $currentPageTab == 'slides' ): ?>
        	<?php if (!isset($_GET['action'])): ?>                   
                <div id="slides" class="ui-tabs-panel">
                    <?php $slideshows = slideshow_require(); ?>
                    <?php foreach($slideshows as $slideshow): ?>
                        <?php
                            global $wpdb;
                            $slides = '';
                            if ( check_db_existance($wpdb->prefix.'dt-slides') ) :
                                $slide_require_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-slides` WHERE `SLIDE_PARENT` = '.$slideshow->ID.' ORDER BY `ORDER` ASC';	
                                $slides = $wpdb->get_results($slide_require_query);
                            endif;
                        ?>   
                        <?php if ( $slides!= '' && count($slides) ): ?>
                        <script type="text/javascript">
                            jQuery(document).ready(function() {				
                                var fixHelper = function(e, ui) {
                                    ui.children().each(function() {
                                        jQuery(this).width(jQuery(this).width());
                                    });
                                    return ui;
                                };
                        
                                jQuery("#sort-<?php echo $slideshow->ID; ?> tbody").sortable({ helper: fixHelper, handle: '.slide-move', axis: 'y'}).disableSelection();
                                jQuery( "#sort-<?php echo $slideshow->ID; ?> tbody" ).bind( "sortstop", function(event, ui) {
                                    var order = '';			
                                    var slideshow = '';											  	
                                    jQuery("#sort-<?php echo $slideshow->ID; ?> tbody tr").each(function(index) {		
                                        order += jQuery(this).attr('id') + ',' ;												  
                                    });
                                    order = 'order=' + order;
                                    slideshow = <?php echo $slideshow->ID; ?>;
                                    query = order + '&slideshow=' + slideshow
                                    jQuery.get("<?php echo get_template_directory_uri(); ?>/includes/duotive-admin/duotive-slider-order.php", query, function(theResponse){
                                        jQuery("#theResponse-<?php echo $slideshow->ID; ?>").css('display','block');
                                        jQuery("#theResponse-<?php echo $slideshow->ID; ?>").html(theResponse);
                                        jQuery("#theResponse-<?php echo $slideshow->ID; ?>").delay(6000).fadeOut("slow");
                                    });
                                    jQuery("#sort-<?php echo $slideshow->ID; ?> tr").removeClass('alternate');
                                    jQuery("#sort-<?php echo $slideshow->ID; ?> tr:even").addClass('alternate');			
                                });
                            });
                        </script>
                        <div id="theResponse-<?php echo $slideshow->ID; ?>"></div>
                        <div class="table-sort-wrapper">
                        <h4><?php echo $slideshow->SLIDESHOW_NAME; ?></h4>               
                        <table id="sort-<?php echo $slideshow->ID; ?>" class="table-sort">
                            <thead>
                                <tr>
                                    <th class="narrow-column">No.</th>
                                    <th class="narrow-column">Image</th>
                                    <th>Title</th>
                                    <th>URL</th>
                                    <th class="narrow-column">Edit</th>
                                    <th class="narrow-column">Ordering</th>
                                    <th class="narrow-column">Status</th>
                                    <th class="narrow-column">Delete</th>
                                </tr>                
                            </thead>
                          <?php $class = ''; $count = count($slides); ?>
                          <?php $timthumb = get_template_directory_uri().'/includes/timthumb.php'; ?>
                          <tbody>
                        <?php $i = 1; foreach ( $slides as $slide ): ?>
                            <tr class="<?php echo $class; ?>" id="<?php echo $slide->ID; ?>">
                                <td valign="center" align="center"><?php echo $i; ?></td>
                                <td valign="center"><img src="<?php echo $timthumb; ?>?src=<?php echo $slide->IMG; ?>&w=60&h=60&zc=1&q=100" /> </td>                  
                                <td valign="center"><?php echo $slide->TITLE; ?> </td>
                                <td valign="center"><?php echo $slide->LINK; ?> </td>
                                <td valign="center" align="center">
                                    <a class="edit" href="admin.php?page=duotive-slider&tab=slides&action=edit&target=<?php echo $slide->ID; ?>">EDIT</a>                  
                                </td>
                                <td valign="center" align="center">
                                    <a class="slide-move" href="#">Move</a>
                                </td> 
                                <td valign="center" align="center">                 
                                    <?php if ( $slide->PUBLISH == 0 ) : ?> 
                                    <a class="publish" title="Publish Slide" href="admin.php?page=duotive-slider&tab=slides&publish=<?php echo $slide->ID; ?>">PUBLISH</a> 
                                    <?php else: ?>
                                    <a class="unpublish" title="Unpublish Slide" href="admin.php?page=duotive-slider&tab=slides&unpublish=<?php echo $slide->ID; ?>">UNPUBLISH</a>                                             
                                    <?php endif; ?>                  
                                </td>
                                <td valign="center" align="center">        
                                    <a class="delete confirmLink" title="Delete Slide" href="admin.php?page=duotive-slider&tab=slides&delete=<?php echo $slide->ID; ?>">DELETE</a>
                                </td>
                            </tr>
                        <?php if ( $class == '' ) $class = 'alternate'; else $class = ''; ?>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>                            
                                <th>Title</th>
                                <th>URL</th>
                                <th>Edit</th>
                                <th>Ordering</th> 
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>                
                        </tfoot>     
                      </table>
                      </div>          
                        <?php else: ?>
                            <div class="table-sort-wrapper">
                                <h4><?php echo $slideshow->SLIDESHOW_NAME; ?></h4>
                                <div class="page-error">There aren't any slides added yet.</div>              
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && is_numeric($_GET['target'])): ?>
					<?php
                        global $wpdb;
                        $slides = '';
                        if ( check_db_existance($wpdb->prefix.'dt-slides') ) :
                            $slide_require_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-slides` WHERE ID='.$_GET['target'];	
                            $slides = $wpdb->get_results($slide_require_query);
                        endif;
                    ?>             
					<?php foreach ( $slides as $slide ): ?>
                        <div class="edit-slide-wrapper">
                            <div class="title">Edit slide: <em>"<?php echo $slide->TITLE;?>"</em></div>
                            <div class="edit-slide">
                                <form method="POST" action="admin.php?page=duotive-slider&tab=slides" class="transform">
                                    <input type="hidden" name="edit_id" value="<?php echo $slide->ID;?>" />
                                    <input type="hidden" name="edit_order" value="<?php echo $slide->ORDER;?>" />
                                    <div class="table-row clearfix edit_slide_parent">
                                        <label for="edit_slide_parent">Parent:</label>
                                        <?php $slideshows = slideshow_require(); ?>
                                        <select name="edit_slide_parent">
                                        <?php foreach($slideshows as $slideshow): ?>
                                            <option value="<?php echo $slideshow->ID; ?>" <?php if($slide->SLIDE_PARENT == $slideshow->ID ) echo 'selected="selected" ';?>><?php echo $slideshow->SLIDESHOW_NAME; ?></option>   
                                        <?php endforeach; ?> 
                                        </select>
                                    </div>                            
                                    <div class="table-row clearfix">                  
                                        <label for="edit_title">Slide title:</label>
                                        <input class="inputbox" name="edit_title" type="text" value="<?php echo $slide->TITLE;?>" size="50"/>
                                    </div>
                                    <div class="table-row clearfix">                  
                                        <label for="edit_title_short">Slide presentation short title:</label>
                                        <input class="inputbox" name="edit_title_short" type="text" value="<?php echo $slide->TITLE_SHORT;?>" size="50"/>
                                    </div>                                
                                    <div class="table-row clearfix">
                                        <label for="edit_text">Slide description:</label>
                                        <textarea rows="9" cols="50"  name="edit_text" ><?php echo $slide->TEXT;?></textarea>
                                    </div>
                                    <div class="table-row clearfix">
                                        <label for="edit_img">Slide image:</label>
                                        <input class="inputbox" name="edit_img" type="text" value="<?php echo $slide->IMG;?>" size="50"/>
                                    </div>
                                    <div class="table-row clearfix">
                                        <label for="crop_location">Crop location:</label>
                                        <select name="edit_crop_location">
                                            <option <?php if ( $slide->CROP_LOCATION == 'c' ) echo 'selected="selected"';?> value="c">Crop on the center</option>
                                            <option <?php if ( $slide->CROP_LOCATION == 't' ) echo 'selected="selected"';?>value="t">Crop on the top</option>
                                            <option <?php if ( $slide->CROP_LOCATION == 'tr' ) echo 'selected="selected"';?>value="tr">Crop on the top right</option>
                                            <option <?php if ( $slide->CROP_LOCATION == 'tl' ) echo 'selected="selected"';?>value="tl">Crop on the top left</option>
                                            <option <?php if ( $slide->CROP_LOCATION == 'b' ) echo 'selected="selected"';?>value="b">Crop on the bottom</option>
                                            <option <?php if ( $slide->CROP_LOCATION == 'br' ) echo 'selected="selected"';?>value="br">Crop on the bottom right</option>
                                            <option <?php if ( $slide->CROP_LOCATION == 'bl' ) echo 'selected="selected"';?>value="bl">Crop on the bottom left</option>
                                            <option <?php if ( $slide->CROP_LOCATION == 'l' ) echo 'selected="selected"';?>value="l">Crop on the left</option>
                                            <option <?php if ( $slide->CROP_LOCATION == 'r' ) echo 'selected="selected"';?>value="r">Crop on the right</option>
                                        </select>                    
                                    </div>                              
                                    <div class="table-row clearfix">
                                        <label for="edit_target">Target type:</label>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->TARGET == 'url' ) echo 'checked="checked"';?>  name="edit_target" value="url">URL</div>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->TARGET == 'video' ) echo 'checked="checked"';?>  name="edit_target" value="video">Video</div>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->TARGET == 'image' ) echo 'checked="checked"';?>  name="edit_target" value="image">Image</div>                                        
                                    </div>                                                                       
                                    <div class="table-row clearfix">
                                        <label for="edit_link">Slide URL:</label>
                                        <input class="inputbox" name="edit_link" type="text" value="<?php echo $slide->LINK;?>" size="50"/>
                                    </div>
                                    <div class="table-row clearfix">
                                        <label for="edit_video">Slide video URL:</label>
                                        <input class="inputbox" name="edit_video" type="text" value="<?php echo $slide->VIDEO;?>" size="50"/>
                                    </div>                                     
                                    <div class="table-row clearfix">
                                        <label for="edit_publish">Published:</label>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->PUBLISH == 1 ) echo 'checked="checked"';?>  name="edit_publish" value="1">Yes</div>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->PUBLISH == 0 ) echo 'checked="checked"';?>  name="edit_publish" value="0">No</div>
                                    </div>                                                                                                
                                    <div class="table-row clearfix">
                                        <input type="submit" class="button" value="Update slide"/>
                                        <input type="button" class="button cancel-edit-button" value="Cancel"/>
                                    </div>
                                </form>
                            </div>
                        </div>       
                    <?php endforeach; ?>
                <?php endif; ?>                
        <?php endif; ?>
        <?php if ( $currentPageTab == 'slideshows' ): ?>              
            <div id="slideshows" class="ui-tabs-panel">
                    <?php if(isset($_GET['delete_slideshow']) && $_GET['delete_slideshow'] != '') delete_slideshow($_GET['delete_slideshow']); ?>
                    <?php $slideshows = slideshow_require(); ?>   
                    <?php if ( $slideshows!= '' && count($slideshows) ): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Slideshow Name</th>
                                    <th>Slideshow Type</th>
                                    <th>Edit</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php $j = 0; ?>
                                <?php foreach($slideshows as $slideshow): ?>
                                    <tr<?php if ( $j%2==0) echo ' class="alternate"'; ?>>
                                        <td><?php echo $slideshow->SLIDESHOW_NAME; ?></td>
                                        <td><?php echo ucfirst(str_replace('-',' ',$slideshow->SLIDESHOW_TYPE)); ?></td>
                                        <td align="center">
                                            <a class="edit edit-slideshow-caller" title="Edit Slide" data-id="editSlideshow<?php echo $slideshow->ID; ?>" href="#editSlideshow<?php echo $slideshow->ID; ?>">EDIT</a>
                                            <a style="margin-left:14px;" class="delete confirmLink" title="Delete Slideshow" href="admin.php?page=duotive-slider&tab=slideshows&delete_slideshow=<?php echo $slideshow->ID; ?>#slideshows">DELETE</a>
                                        </td>
                                    </tr>
                                    <?php $j++;?>
                                <?php endforeach; ?>
                            </tbody>                        
                            <tfoot>
                                <tr>
                                    <th>Slideshow Name</th>
                                    <th>Slideshow Type</th>
                                    <th>Edit</th>                                
                                </tr>
                            </tfoot>                        
                        </table>
                    <?php else: ?>
                        <div class="page-error">There aren't any slideshows added yet.</div> 
                    <?php endif; ?>
                    <?php if ( $slideshows!= '' && count($slideshows) ): ?>
                        <?php foreach($slideshows as $slideshow ): ?>
                        <div class="edit-slide-wrapper edit-slideshow-wrapper" id="editSlideshow<?php echo $slideshow->ID; ?>">
                            <div class="title">Edit slide: <em>"<?php echo $slideshow->SLIDESHOW_NAME; ?>"</em></div>
                            <div class="edit-slide">
                                <form class="transform" action="#slideshows" method="POST">
                                    <input type="hidden" name="edit_slideshow_id" value="<?php echo $slideshow->ID; ?>" />                            
                                    <input type="hidden" name="edit_slideshow_name" value="<?php echo $slideshow->SLIDESHOW_NAME; ?>" />
                                    <div class="table-row clearfix"> 
                                        <select name="edit_slideshow_type">
                                            <option <?php if ( $slideshow->SLIDESHOW_TYPE == 'gallery-slider' ) echo 'selected="selected"'; ?> value="gallery-slider">Gallery Slider</option>                    
                                            <option <?php if ( $slideshow->SLIDESHOW_TYPE == 'fullscreen-slider' ) echo 'selected="selected"'; ?> value="fullscreen-slider">Fullscreen Slider</option>                                                                
                                            <option <?php if ( $slideshow->SLIDESHOW_TYPE == 'fullwidth-slider' ) echo 'selected="selected"'; ?> value="fullwidth-slider">Fullwidth Slider</option>                        
                                            <option <?php if ( $slideshow->SLIDESHOW_TYPE == 'complex-slider' ) echo 'selected="selected"'; ?> value="complex-slider">Complex Slider</option>                        
                                            <option <?php if ( $slideshow->SLIDESHOW_TYPE == 'presentation-slider' ) echo 'selected="selected"'; ?> value="presentation-slider">Presentation Slider</option>                                                                
                                            <option <?php if ( $slideshow->SLIDESHOW_TYPE == 'content-slider' ) echo 'selected="selected"'; ?> value="content-slider">Content Slider</option>                                           
                                        </select>                              
                                    </div>
                                    <div class="table-row clearfix table-row-alternative">
                                        <input type="submit" value="Update slideshow" class="button">
                                    </div>                                                      
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </div>
		<?php endif; ?>            
	</div>                             
</div>
<?php
}

function themeoptions_update()
{
	if ( isset($_POST['dt_Slider']) ) update_option('dt_Slider',$_POST['dt_Slider']);	
}
function update_contentoptions() 
{
	if ( isset($_POST['dt_SliderContentHeight'] ) ) update_option('dt_SliderContentHeight',$_POST['dt_SliderContentHeight']);		
	if ( isset($_POST['dt_SliderContentAutoplay'] ) ) update_option('dt_SliderContentAutoplay',$_POST['dt_SliderContentAutoplay']);	
	if ( isset($_POST['dt_SliderContentSpeed']) ) update_option('dt_SliderContentSpeed',$_POST['dt_SliderContentSpeed']);
	if ( isset($_POST['dt_SliderContentPause']) ) update_option('dt_SliderContentPause',$_POST['dt_SliderContentPause']);	
}
function update_galleryoptions() 
{
	if ( isset($_POST['dt_SliderGalleryHeight'] ) ) update_option('dt_SliderGalleryHeight',$_POST['dt_SliderGalleryHeight']);
	if ( isset($_POST['dt_SliderGalleryLayout'] ) ) update_option('dt_SliderGalleryLayout',$_POST['dt_SliderGalleryLayout']);	
	if ( isset($_POST['dt_SliderGalleryLayoutRows'] ) ) update_option('dt_SliderGalleryLayoutRows',$_POST['dt_SliderGalleryLayoutRows']);		
	if ( isset($_POST['dt_SliderGalleryAutoAdvance'] ) ) update_option('dt_SliderGalleryAutoAdvance',$_POST['dt_SliderGalleryAutoAdvance']);			
	if ( isset($_POST['dt_SliderGalleryDuration'] ) ) update_option('dt_SliderGalleryDuration',$_POST['dt_SliderGalleryDuration']);				
	if ( isset($_POST['dt_SliderGalleryInterval'] ) ) update_option('dt_SliderGalleryInterval',$_POST['dt_SliderGalleryInterval']);	
	if ( isset($_POST['dt_SliderGalleryPauseOnHover'] ) ) update_option('dt_SliderGalleryPauseOnHover',$_POST['dt_SliderGalleryPauseOnHover']);						
	if ( isset($_POST['dt_SliderGalleryArrows'] ) ) update_option('dt_SliderGalleryArrows',$_POST['dt_SliderGalleryArrows']);	
	if ( isset($_POST['dt_SliderGalleryKeybordControls'] ) ) update_option('dt_SliderGalleryKeybordControls',$_POST['dt_SliderGalleryKeybordControls']);		
	if ( isset($_POST['dt_SliderGalleryArrowsAutohide'] ) ) update_option('dt_SliderGalleryArrowsAutohide',$_POST['dt_SliderGalleryArrowsAutohide']);		
	if ( isset($_POST['dt_SliderGalleryTimer'] ) ) update_option('dt_SliderGalleryTimer',$_POST['dt_SliderGalleryTimer']);	
	if ( isset($_POST['dt_SliderGalleryScroll'] ) ) update_option('dt_SliderGalleryScroll',$_POST['dt_SliderGalleryScroll']);	
	if ( isset($_POST['dt_SliderGalleryDescription'] ) ) update_option('dt_SliderGalleryDescription',$_POST['dt_SliderGalleryDescription']);				

} 
function update_presentationoptions() 
{
	if ( isset($_POST['dt_SliderPresentationHeight'] ) ) update_option('dt_SliderPresentationHeight',$_POST['dt_SliderPresentationHeight']);		
	if ( isset($_POST['dt_SliderPresentationAutoAdvance'] ) ) update_option('dt_SliderPresentationAutoAdvance',$_POST['dt_SliderPresentationAutoAdvance']);			
	if ( isset($_POST['dt_SliderPresentationDuration'] ) ) update_option('dt_SliderPresentationDuration',$_POST['dt_SliderPresentationDuration']);				
	if ( isset($_POST['dt_SliderPresentationInterval'] ) ) update_option('dt_SliderPresentationInterval',$_POST['dt_SliderPresentationInterval']);
	if ( isset($_POST['dt_SliderPresentationPauseOnHover'] ) ) update_option('dt_SliderPresentationPauseOnHover',$_POST['dt_SliderPresentationPauseOnHover']);						
	if ( isset($_POST['dt_SliderPresentationArrows'] ) ) update_option('dt_SliderPresentationArrows',$_POST['dt_SliderPresentationArrows']);							
	if ( isset($_POST['dt_SliderPresentationTimer'] ) ) update_option('dt_SliderPresentationTimer',$_POST['dt_SliderPresentationTimer']);	            							
	if ( isset($_POST['dt_SliderPresentationIcon'] ) ) update_option('dt_SliderPresentationIcon',$_POST['dt_SliderPresentationIcon']);	            								
	if ( isset($_POST['dt_SliderPresentationGallery'] ) ) update_option('dt_SliderPresentationGallery',$_POST['dt_SliderPresentationGallery']);	       
	if ( isset($_POST['dt_SliderPresentationGalleryNumber'] ) ) update_option('dt_SliderPresentationGalleryNumber',$_POST['dt_SliderPresentationGalleryNumber']);	            								
	if ( isset($_POST['dt_SliderPresentationGalleryTitle'] ) ) update_option('dt_SliderPresentationGalleryTitle',$_POST['dt_SliderPresentationGalleryTitle']);	            								
	if ( isset($_POST['dt_SliderPresentationScroll'] ) ) update_option('dt_SliderPresentationScroll',$_POST['dt_SliderPresentationScroll']);	            								
	if ( isset($_POST['dt_SliderPresentationKeybordControl'] ) ) update_option('dt_SliderPresentationKeybordControl',$_POST['dt_SliderPresentationKeybordControl']);	            								
	if ( isset($_POST['dt_SliderPresentationDescription'] ) ) update_option('dt_SliderPresentationDescription',$_POST['dt_SliderPresentationDescription']);	            													     									
	if ( isset($_POST['dt_SliderPresentationDescriptionAutoHide'] ) ) update_option('dt_SliderPresentationDescriptionAutoHide',$_POST['dt_SliderPresentationDescriptionAutoHide']);	            													     										
	
}  
function update_complexoptions() 
{
	if ( isset($_POST['dt_SliderComplexHeight'] ) ) update_option('dt_SliderComplexHeight',$_POST['dt_SliderComplexHeight']);		
	if ( isset($_POST['dt_SliderComplexAutoAdvance'] ) ) update_option('dt_SliderComplexAutoAdvance',$_POST['dt_SliderComplexAutoAdvance']);			
	if ( isset($_POST['dt_SliderComplexDuration'] ) ) update_option('dt_SliderComplexDuration',$_POST['dt_SliderComplexDuration']);				
	if ( isset($_POST['dt_SliderComplexInterval'] ) ) update_option('dt_SliderComplexInterval',$_POST['dt_SliderComplexInterval']);
	if ( isset($_POST['dt_SliderComplexPauseOnHover'] ) ) update_option('dt_SliderComplexPauseOnHover',$_POST['dt_SliderComplexPauseOnHover']);						
	if ( isset($_POST['dt_SliderComplexArrows'] ) ) update_option('dt_SliderComplexArrows',$_POST['dt_SliderComplexArrows']);							
	if ( isset($_POST['dt_SliderComplexTimer'] ) ) update_option('dt_SliderComplexTimer',$_POST['dt_SliderComplexTimer']);								
	if ( isset($_POST['dt_SliderComplexDescription'] ) ) update_option('dt_SliderComplexDescription',$_POST['dt_SliderComplexDescription']);								
	if ( isset($_POST['dt_SliderComplexGallery'] ) ) update_option('dt_SliderComplexGallery',$_POST['dt_SliderComplexGallery']);								
	if ( isset($_POST['dt_SliderComplexIcon'] ) ) update_option('dt_SliderComplexIcon',$_POST['dt_SliderComplexIcon']);											
}
function update_fullwidthoptions() 
{
	if ( isset($_POST['dt_SliderFullWidthHeight'] ) ) update_option('dt_SliderFullWidthHeight',$_POST['dt_SliderFullWidthHeight']);
	if ( isset($_POST['dt_SliderFullWidthAutoAdvance'] ) ) update_option('dt_SliderFullWidthAutoAdvance',$_POST['dt_SliderFullWidthAutoAdvance']);			
	if ( isset($_POST['dt_SliderFullWidthDuration'] ) ) update_option('dt_SliderFullWidthDuration',$_POST['dt_SliderFullWidthDuration']);				
	if ( isset($_POST['dt_SliderFullWidthInterval'] ) ) update_option('dt_SliderFullWidthInterval',$_POST['dt_SliderFullWidthInterval']);	
	if ( isset($_POST['dt_SliderFullWidthPauseOnHover'] ) ) update_option('dt_SliderFullWidthPauseOnHover',$_POST['dt_SliderFullWidthPauseOnHover']);						
	if ( isset($_POST['dt_SliderFullWidthArrows'] ) ) update_option('dt_SliderFullWidthArrows',$_POST['dt_SliderFullWidthArrows']);	
	if ( isset($_POST['dt_SliderFullWidthArrowsAutohide'] ) ) update_option('dt_SliderFullWidthArrowsAutohide',$_POST['dt_SliderFullWidthArrowsAutohide']);		
	if ( isset($_POST['dt_SliderFullWidthKeybordControls'] ) ) update_option('dt_SliderFullWidthKeybordControls',$_POST['dt_SliderFullWidthKeybordControls']);
	if ( isset($_POST['dt_SliderFullWidthGallery'] ) ) update_option('dt_SliderFullWidthGallery',$_POST['dt_SliderFullWidthGallery']);
	if ( isset($_POST['dt_SliderFullWidthGalleryAutohide'] ) ) update_option('dt_SliderFullWidthGalleryAutohide',$_POST['dt_SliderFullWidthGalleryAutohide']);					
	if ( isset($_POST['dt_SliderFullWidthTitle'] ) ) update_option('dt_SliderFullWidthTitle',$_POST['dt_SliderFullWidthTitle']);	
	if ( isset($_POST['dt_SliderFullWidthTitleAlign'] ) ) update_option('dt_SliderFullWidthTitleAlign',$_POST['dt_SliderFullWidthTitleAlign']);	
	if ( isset($_POST['dt_SliderFullWidthDescription'] ) ) update_option('dt_SliderFullWidthDescription',$_POST['dt_SliderFullWidthDescription']);
	if ( isset($_POST['dt_SliderFullWidthDescBoxWidth'] ) ) update_option('dt_SliderFullWidthDescBoxWidth',$_POST['dt_SliderFullWidthDescBoxWidth']);	
	if ( isset($_POST['dt_SliderFullWidthDescBoxHeight'] ) ) update_option('dt_SliderFullWidthDescBoxHeight',$_POST['dt_SliderFullWidthDescBoxHeight']);	
	if ( isset($_POST['dt_SliderFullWidthTimer'] ) ) update_option('dt_SliderFullWidthTimer',$_POST['dt_SliderFullWidthTimer']);		
	if ( isset($_POST['dt_SliderFullWidthIcon'] ) ) update_option('dt_SliderFullWidthIcon',$_POST['dt_SliderFullWidthIcon']);			
	if ( isset($_POST['dt_SliderFullWidthHelpBox'] ) ) update_option('dt_SliderFullWidthHelpBox',$_POST['dt_SliderFullWidthHelpBox']);				
	if ( isset($_POST['dt_SliderFullWidthHelpBoxContent'] ) ) update_option('dt_SliderFullWidthHelpBoxContent',stripslashes($_POST['dt_SliderFullWidthHelpBoxContent']));	
}
function update_fullscreenoptions() 
{
	if ( isset($_POST['dt_SliderFullScreenHeight'] ) ) update_option('dt_SliderFullScreenHeight',$_POST['dt_SliderFullScreenHeight']);
	if ( isset($_POST['dt_SliderFullScreenAutoAdvance'] ) ) update_option('dt_SliderFullScreenAutoAdvance',$_POST['dt_SliderFullScreenAutoAdvance']);			
	if ( isset($_POST['dt_SliderFullScreenDuration'] ) ) update_option('dt_SliderFullScreenDuration',$_POST['dt_SliderFullScreenDuration']);				
	if ( isset($_POST['dt_SliderFullScreenInterval'] ) ) update_option('dt_SliderFullScreenInterval',$_POST['dt_SliderFullScreenInterval']);	
	if ( isset($_POST['dt_SliderFullScreenArrows'] ) ) update_option('dt_SliderFullScreenArrows',$_POST['dt_SliderFullScreenArrows']);	
	if ( isset($_POST['dt_SliderFullScreenGallery'] ) ) update_option('dt_SliderFullScreenGallery',$_POST['dt_SliderFullScreenGallery']);		
	if ( isset($_POST['dt_SliderFullScreenDescription'] ) ) update_option('dt_SliderFullScreenDescription',$_POST['dt_SliderFullScreenDescription']);			
	if ( isset($_POST['dt_SliderFullScreenKeybordControls'] ) ) update_option('dt_SliderFullScreenKeybordControls',$_POST['dt_SliderFullScreenKeybordControls']);
	if ( isset($_POST['dt_SliderFullScreenBgPosition'] ) ) update_option('dt_SliderFullScreenBgPosition',$_POST['dt_SliderFullScreenBgPosition']);
	if ( isset($_POST['dt_SliderFullScreenBgRepeat'] ) ) update_option('dt_SliderFullScreenBgRepeat',$_POST['dt_SliderFullScreenBgRepeat']);		
}
add_action('admin_menu', 'themeoptions_admin_menu');

?>