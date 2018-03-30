<?php
/**
 * @KingSize 2011-2014
 * Full-width Background Image Form theme-background.php
 **/
?>

<?php

		##### Slide Order BY #####	
		$slider_display = '';	
		if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_display', true ) != '' && !is_home())
			$slider_display = get_post_meta($wp_query->post->ID, 'kingsize_post_slider_display', true );
		elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_display', true ) != '' && !is_home())
			$slider_display = get_post_meta($wp_query->post->ID, 'kingsize_page_slider_display', true );
		elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_display', true ) != '' && !is_home())
			$slider_display = get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_display', true );
		elseif(is_home())
			$slider_display = $data['wm_slider_display'];
		else
			$slider_display = '';	

		if($slider_display == "Custom ID Order") {
			$slider_orderby = "menu_order ID";	
			$slider_order = "ASC";
		}

		elseif($slider_display == "Random Order") {
			$slider_orderby = "rand";	
			$slider_order = "";
		}

		elseif($slider_display == "ASC (by Date)") {
			$slider_orderby = "date";	
			$slider_order = "ASC";
		}
		else { 
			$slider_orderby = "date";
			$slider_order = "DESC";
		}


		########### Slider transition type #########  
		if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_transition_type', true ) != ''   && !is_home())
			$transition_type = get_post_meta($wp_query->post->ID, 'kingsize_post_slider_transition_type', true );
		elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_transition_type', true ) != ''   && !is_home())
			$transition_type = get_post_meta($wp_query->post->ID, 'kingsize_page_slider_transition_type', true );
		elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_transition_type', true ) != ''   && !is_home())
			$transition_type = get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_transition_type', true );
		elseif($data['wm_slider_transition_type'] != '' && is_home()) //home
			$transition_type = $data['wm_slider_transition_type'];
		

		######### slide interval ######### 
	   if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_seconds', true )!=''  && !is_home())
			$slider_seconds = get_post_meta($wp_query->post->ID, 'kingsize_post_slider_seconds', true );
	   elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_seconds', true )!=''  && !is_home())
			$slider_seconds = get_post_meta($wp_query->post->ID, 'kingsize_page_slider_seconds', true );
	   elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_seconds', true )!=''  && !is_home())
			$slider_seconds = get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_seconds', true );
	   elseif($data['wm_slider_seconds'] != '' && is_home()) //home
		   $slider_seconds = $data['wm_slider_seconds'];
	   else 
		   $slider_seconds = 5000;


		######### transition speed ######### 

	   if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_transition_seconds', true )!=''  && !is_home()) //post
			$transition_speed = get_post_meta($wp_query->post->ID, 'kingsize_post_slider_transition_seconds', true );
	   elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_transition_seconds', true )!=''  && !is_home()) //page
			$transition_speed = get_post_meta($wp_query->post->ID, 'kingsize_page_slider_transition_seconds', true );
	   elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_transition_seconds', true )!=''  && !is_home()) //portfolio
			$transition_speed = get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_transition_seconds', true );
	   elseif($data['wm_slider_transition_seconds'] != '' && is_home()) //home
		   $transition_speed = $data['wm_slider_transition_seconds'];	
	   else 
		   $transition_speed = 5000;	
		   

		######### show_title_description ######### 
		if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_contents', true ) != '' && !is_home()) //post
			$show_title_description = get_post_meta($wp_query->post->ID, 'kingsize_post_slider_contents', true );
		elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_contents', true ) != '' && !is_home()) //page
			$show_title_description = get_post_meta($wp_query->post->ID, 'kingsize_page_slider_contents', true );
		elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_contents', true ) != '' && !is_home()) //portfolio
			$show_title_description = get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_contents', true );
		elseif($data['wm_slider_contents'] != '' && is_home()) //home
			$show_title_description = $data['wm_slider_contents'];


		//Custom category
		//thanks to http://stackoverflow.com/questions/1155565/query-multiple-custom-taxonomy-terms-in-wordpress-2-8
		//http://richardsweeney.com/wordpress-3-0-custom-queries-post-types-and-taxonomies/
		//$post_cats = wp_get_object_terms(get_the_ID(), 'slider-category', array('fields' => 'ids'));

		if(get_post_meta($wp_query->post->ID, 'kingsize_post_background_slider_id', true ) != ''   && !is_home()) { //post
			if(defined('ICL_SITEPRESS_VERSION')){ $post_id = icl_object_id($wp_query->post->ID, 'post', true); } else { $post_id = $wp_query->post->ID; }

			$home_page_cat = get_post_meta($post_id, 'kingsize_post_background_slider_id', true );
			$home_page_cat_arr = explode(",",$home_page_cat);

		}

		elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_background_slider_id', true ) != ''   && !is_home()) { //page

			if(defined('ICL_SITEPRESS_VERSION')){ $post_id = icl_object_id($wp_query->post->ID, 'page', true); } else { $post_id = $wp_query->post->ID; }

			$home_page_cat = get_post_meta($post_id, 'kingsize_page_background_slider_id', true );
			$home_page_cat_arr = explode(",",$home_page_cat);

		}

		elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_background_slider_id', true ) != ''   && !is_home()) { //portfolio

			if(defined('ICL_SITEPRESS_VERSION')){ $post_id = icl_object_id($wp_query->post->ID, 'portfolio', true); } else { $post_id = $wp_query->post->ID; }

			$home_page_cat = get_post_meta($post_id, 'kingsize_portfolio_background_slider_id', true );
			$home_page_cat_arr = explode(",",$home_page_cat);

		}

		else{ //home page

			$home_page_cat = $data['wm_slider_hp_category'];
			$home_page_cat_arr = explode(",",$home_page_cat);

		}



		///Number of slider to show

		if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_show_number', true ) != ''   && !is_home())  //post
			$slide_show_number = get_post_meta($wp_query->post->ID, 'kingsize_post_slider_show_number', true );

		elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_show_number', true ) != ''   && !is_home())  //page
			$slide_show_number = get_post_meta($wp_query->post->ID, 'kingsize_page_slider_show_number', true );

		elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_show_number', true ) != ''   && !is_home())  //portfolio
			$slide_show_number = get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_show_number', true );

		elseif($data['wm_slider_show_number'] > 0 && is_home())	//home page
			$slide_show_number = $data['wm_slider_show_number'];

		else
			$slide_show_number = -1;
			

		if($home_page_cat != '') :

			$args=array(

				"tax_query" => array(

					array(

						"taxonomy" => "slider-category",

						"field" => "id",

						"terms" => $home_page_cat_arr

					)

				),

				'post_type' => array('slider'),

				'order' => $slider_order,

				'orderby' => $slider_orderby,

				'posts_per_page' => $slide_show_number,

			);		

		else :

			$args=array(

				'post_type' => array('slider'),

				'order' => $slider_order,

				'orderby' => $slider_orderby,

				'posts_per_page' => $slide_show_number,

			);		

		endif;


		$slider_img = "";

		query_posts($args);
		

		global $cnt_slider;

		$cnt_slider = 0;


		if (have_posts()) : 

			while (have_posts()) : 

				the_post();
				

				$cnt_slider++; 

				
				//Slider Button link
				$disable_learn_more_link = get_post_meta($post->ID, 'kingsize_disable_learn_more_link', true ); //slider link

				if($disable_learn_more_link == 'disable_button'){
					$slider_link = ''; //slider link
				} else {
					$slider_link = addhttp(get_post_meta($post->ID, 'kingsize_slider_link', true )); //slider link
				
					//Slider Button Text
					$slider_link_text = get_post_meta($post->ID, 'kingsize_slider_link_text', true );//slider text				

					if(empty($slider_link_text)){
						$slider_link_text = __('Learn more', true);
					} else {
						$slider_link_text = get_post_meta($post->ID, 'kingsize_slider_link_text', true );//slider text				
					}
					$slider_link_text .= ' &rarr;';
				}


				$target_link_open = get_post_meta($post->ID, 'kingsize_slider_link_open', true );//Open link in new window				
				
				$link_open = '';	
				if($target_link_open == 1){
					$link_open = "_BLANK";
				}


				//Show title and discription
				$show_title_and_discription = get_post_meta($post->ID, 'kingsize_show_title_and_discription', true );//Open link in new window		

				//getting the image for slider
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 

				//generate ALT and TITLE of image
				$post_thumb = get_post(get_post_thumbnail_id( $post->ID )); 
				
				$image_title = ''; 
				$image_title = $post_thumb->post_title;
				
				$image_alt = '';
				$image_alt = get_post_meta(get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);

				if($image_alt == "")
					$image_alt = $image_title;
					 

				//getting post content

				$post_content = $post->post_content;
				$post_content = str_replace("\r\n","<br/>",$post_content);
				$post_content = str_replace("\"","'",$post_content);

				if($show_title_description == 'Display Title & Description'){

					 if(!empty($slider_link)) {

						if(strip_tags($post->post_content) != "" && $show_title_and_discription == 'show_title_discription') { //if content
							
							$slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", description : "'.stripslashes($post_content).'", buttonHref : "'.$slider_link.'", buttonText : "'.$slider_link_text.'", buttonTarget : "'.$link_open.'", url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

						}

						elseif($show_title_and_discription == 'show_title') {

							$slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", buttonHref : "'.$slider_link.'", buttonText : "'.$slider_link_text.'", buttonTarget : "'.$link_open.'", url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

						}

						elseif(strip_tags($post->post_content) != "" &&  $show_title_and_discription == 'show_discription') {

							$slider_img .= '{image : "'.$image[0].'", title : "", description : "'.stripslashes($post_content).'", buttonHref : "'.$slider_link.'", buttonText : "'.$slider_link_text.'", buttonTarget : "'.$link_open.'", url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

						}	

						elseif($show_title_and_discription == ''){

							if(strip_tags($post->post_content) != "") {
								
								$slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", description : "'.stripslashes($post_content).'", buttonHref : "'.$slider_link.'", buttonText : "'.$slider_link_text.'", buttonTarget : "'.$link_open.'", url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

							} else {		

								$slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", description : "", buttonHref : "'.$slider_link.'", buttonText : "'.$slider_link_text.'", buttonTarget : "'.$link_open.'", url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

							}

						}

						else {							

							$slider_img .= '{image : "'.$image[0].'", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

						}

					} else {


						if(strip_tags($post->post_content) != ""  && $show_title_and_discription == 'show_title_discription') { //if content


							$slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", description : "'.stripslashes($post_content).'",  url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';


						}

						elseif($show_title_and_discription == 'show_title') {

							$slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

						}

						elseif(strip_tags($post->post_content) != "" &&  $show_title_and_discription == 'show_discription') {

							$slider_img .= '{image : "'.$image[0].'", title : "", description : "'.stripslashes($post_content).'",   url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';


						}

						elseif($show_title_and_discription == '') { //if content

							if(strip_tags($post->post_content) != "")
								$slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", description : "'.stripslashes($post_content).'",   url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';
							else
								$slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", description : "",   url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';
						}

						else {							

							$slider_img .= '{image : "'.$image[0].'", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

						}

					}

			}

			elseif($show_title_description == 'Display Title'){

				if(!empty($slider_link)){	
						
					   $slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", description : "", buttonHref : "'.$slider_link.'", buttonText : "'.$slider_link_text.'", buttonTarget : "'.$link_open.'",  url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

				} else {

					  $slider_img .= '{image : "'.$image[0].'", title : "'.htmlspecialchars(stripslashes($post->post_title)).'", url: "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

				}

			}

			elseif($show_title_description == 'Display Description'){

				if(!empty($slider_link)){

						if(strip_tags($post->post_content) != "")  //if content							
							$slider_img .= '{image : "'.$image[0].'", title : "", description : "'.stripslashes($post_content).'", buttonHref : "'.$slider_link.'", buttonText : "'.$slider_link_text.'", buttonTarget : "'.$link_open.'",  url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';
						else
							$slider_img .= '{image : "'.$image[0].'", title : "", description : "", buttonHref : "'.$slider_link.'", buttonText : "'.$slider_link_text.'", buttonTarget : "'.$link_open.'",  url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';
				}

				else{

					if(strip_tags($post->post_content) != "") //if content

					  $slider_img .= '{image : "'.$image[0].'", title : "", description : "'.stripslashes($post_content).'", buttonHref : "'.$slider_link.'", buttonText : "'.$slider_link_text.'", buttonTarget : "'.$link_open.'",  url : "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';


					else

						$slider_img .= '{image : "'.$image[0].'",  title : "", url: "", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

				}

			}

			else{

					$slider_img .= '{image : "'.$image[0].'", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

			}

			endwhile; 

	   else :

			$slider_img = '{image : "'.$data['wm_background_image'].'", alt : "'.$image_alt.'", image_title : "'.$image_title.'"},';

	   endif; 

	   wp_reset_query(); 


	   ########### Slider transition type #########
	       $transition = 1;

	   if($transition_type == 'Fade') 

	   	   $transition = 1;

	   elseif($transition_type ==  'Slide Top') 

	   	   $transition = 2;

	   elseif($transition_type  == 'Slide Right') 

	   	   $transition = 3;

	   elseif($transition_type  == 'Slide Bottom') 

	   	   $transition = 4;

	   elseif($transition_type  == 'Slide Left') 

	   	   $transition = 5;

	   elseif($transition_type  == 'Carousel Right') 

	   	   $transition = 6;

	   elseif($transition_type  == 'Carousel Left') 

	   	   $transition = 7;
	   ########### End Slider transition type #########

?>	

		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/supersized.3.2.6.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/theme/supersized.shutter.min.js"></script>
	    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.min.js"></script>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/supersized.css" type="text/css" media="screen" property="stylesheet" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/theme/supersized.shutter.css" type="text/css" media="screen" property="stylesheet" />

		

		<script type="text/javascript">

			jQuery(function($){

				$.supersized({

					// Functionality

					slide_interval          :   <?php echo $slider_seconds;?>,		// Length between transitions
					transition              :   <?php echo  $transition;?>, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	<?php echo $transition_speed;?>,		// Speed of transition
					//fit_always 				: '1',			   
					// Components							
					slide_links				:	'false',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					slides 					:  	[			// Slideshow Images
														<?php
														//echo $slider_img;
														echo substr($slider_img,0,strlen($slider_img)-1);
														?>
												]

				});

		    });

		</script>
        <!-- End scripts for background slider end here -->
