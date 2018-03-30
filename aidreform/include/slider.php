<?php

	function cs_slider_register() {

		//adding columns start

		add_filter('manage_cs_slider_posts_columns', 'slider_columns_add');

			function slider_columns_add($columns) {

				$columns['author'] = 'Author';

				return $columns;

		}

		add_action('manage_cs_slider_posts_custom_column', 'slider_columns');

			function slider_columns($name) {

				global $post;

				switch ($name) {

					case 'author':

						echo get_the_author();

						break;

				}

			}

		//adding columns end

		$labels = array(

			'name' =>__('Sliders','AidReform'),

			'add_new_item' =>__('Add New Slider','AidReform'),

			'edit_item' =>__('Edit Slider','AidReform'),

			'new_item' =>__('New Slider Item','AidReform'),

			'add_new' =>__('Add New Slider','AidReform'),

			'view_item' =>__('View Slider Item','AidReform'),

			'search_items' =>__('Search Slider','AidReform'),

			'not_found' =>__('Nothing found','AidReform'),

			'not_found_in_trash' =>__('Nothing found in Trash','AidReform'),

			'parent_item_colon' => ''

		);

		$args = array(

			'labels' => $labels,

			'public' => true,

			'publicly_queryable' => true,

			'show_ui' => true,

			'query_var' => true,

			'menu_icon' => get_template_directory_uri() . '/images/admin/slider-icon.png',

			'rewrite' => true,

			'capability_type' => 'post',

			'hierarchical' => false,

			'menu_position' => null,

			'supports' => array('title')

		); 

        register_post_type( 'cs_slider' , $args );

	}

	add_action('init', 'cs_slider_register');



		// adding Slider meta info start

			add_action( 'add_meta_boxes', 'cs_meta_slider_add' );

			function cs_meta_slider_add()

			{  

				add_meta_box( 'cs_meta_slider', __('Slider Options','AidReform'), 'cs_meta_slider', 'cs_slider', 'normal', 'high' );  

			}

			function cs_meta_slider( $post ) {

				?>

					<div class="page-wrap" style="overflow:hidden;">

					<div class="option-sec">

                            <div class="opt-conts-in">

                                <div class="to-social-network">

                                    <div class="gal-active">

                                        <div class="clear"></div>

                                        <div class="dragareamain">

                                        <div class="placehoder"><?php _e('Slider is Empty. Please Select Media','AidReform'); ?> <img src="<?php echo get_template_directory_uri()?>/images/admin/bg-arrowdown.png" alt="" /></div>

										<ul id="gal-sortable">

											<?php 

												$cs_counter_slides = 0;

												global $cs_node, $cs_counter;

                                                $cs_meta_slider_options = get_post_meta($post->ID, "cs_meta_slider_options", true);

                                                if ( $cs_meta_slider_options <> "" ) {

                                                    $cs_xmlObject = new SimpleXMLElement($cs_meta_slider_options);

                                                        foreach ( $cs_xmlObject->children() as $cs_node ){

                                                            $cs_counter_slides++;

                                                            $cs_counter = $post->ID.$cs_counter_slides;

                                                           	cs_slider_clone();

                                                        }

                                                }

                                            ?>

                                        </ul>

                                        </div>

                                    </div>

                                    <div class="to-social-list">

                                        <div class="soc-head">

                                            <h5><?php _e('Select Media','AidReform'); ?></h5>

                                            <div class="right">

                                                <input type="button" class="button reload" value="Reload" onclick="refresh_media()" />

                                                <input id="cs_log" name="cs_logo" type="button" class="uploadfile button" value="Upload Media" />

                                            </div>

                                            <div class="clear"></div>

                                        </div>

                                        <div class="clear"></div>

                                        <script type="text/javascript">

											function show_next(page_id, total_pages){

												var dataString = 'action=media_pagination&page_id='+page_id+'&total_pages='+total_pages;

												jQuery("#pagination").html("<img src='<?php echo get_template_directory_uri()?>/images/admin/ajax_loading.gif' />");

												jQuery.ajax({

													type:'POST', 

													url: "<?php echo admin_url('admin-ajax.php')?>",

													data: dataString,

													success: function(response) {

														jQuery("#pagination").html(response);

													}

												});

												

											}

											function refresh_media(){

												var dataString = 'action=media_pagination';

												jQuery("#pagination").html("<img src='<?php echo get_template_directory_uri()?>/images/admin/ajax_loading.gif' />");

												jQuery.ajax({

													type:'POST', 

													url: "<?php echo admin_url('admin-ajax.php')?>",

													data: dataString,

													success: function(response) {

														jQuery("#pagination").html(response);

													}

												});

												

											}

										</script>

                    <script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/jquery.scrollTo-min.js"></script>

					<script>

                        jQuery(document).ready(function($) {

                                $("#gal-sortable").sortable({

									cancel:'li div.poped-up',

									});

                                $(this).append("#gal-sortable").clone() ;

                            });

                            var counter = 0;

							var count_items = <?php echo $cs_counter_slides?>;

							if ( count_items > 0 ) {

								jQuery(".dragareamain") .addClass("noborder");	

							}

                            function clone(path){

								counter = counter + 1;

								var dataString = 'path='+path+'&counter='+counter+'&action=slider_clone';

								jQuery("#gal-sortable").append("<li id='loading'><img src='<?php echo get_template_directory_uri()?>/images/admin/ajax_loading.gif' /></li>");

								jQuery.ajax({

									type:'POST', 

									url: "<?php echo admin_url('admin-ajax.php')?>",

									data: dataString,

									success: function(response) {

										jQuery("#loading").remove();

										jQuery("#gal-sortable").append(response);

										count_items = jQuery("#gal-sortable li") .length;

											if ( count_items > 0 ) {

												jQuery(".dragareamain") .addClass("noborder");	

											}

									}

								});

								

							}

                            function del_this(id){

                                jQuery("#"+id).remove();

								count_items = jQuery("#gal-sortable li") .length;

									if ( count_items == 0 ) {

										jQuery(".dragareamain") .removeClass("noborder");	

									}

                            }

                    </script>

					<script type="text/javascript">

                      var contheight;

                          function slidedit(id){

                      var $ = jQuery;

                      $(".to-social-list,.gal-active h4.left,#gal-sortable li,#gal-sortable .thumb-secs") .not("#"+id) .fadeOut(200);

                      $.scrollTo( '.page-wrap', 400, {easing:'swing'} );

                            $('.poped-up').animate({

                      

                             top: 0,

                            }, 300, function() {

                      $("#edit_" + id+" li")  .show(); 

                            $("#edit_" + id)   .slideDown(300); 

                            });

                           };

                           function slideclose(id){

                      var $ = jQuery;

                      $("#edit_" + id) .slideUp(300);

                      $(".to-social-list,.gal-active h4.left,#gal-sortable li,#gal-sortable .thumb-secs")  .fadeIn(300);

                    

                          };

                    

                    </script>                    

										<div id="pagination"><?php media_pagination();?></div>

                                        <input type="hidden" name="slider_meta_form" value="1" />

                                        <div class="clear"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="clear"></div>

                    </div>

                <?php

			}

			// adding Slider meta info end

			// saving Slider meta start

			if ( isset($_POST['slider_meta_form']) and $_POST['slider_meta_form'] == 1 ) {

				add_action( 'save_post', 'cs_meta_slider_options' );

				function cs_meta_slider_options( $post_id )

				{

					$cs_counter = 0;

					$sxe = new SimpleXMLElement("<slider_options></slider_options>");

						if ( isset($_POST['path']) ) {

							foreach ( $_POST['path'] as $count ) {

								$slider = $sxe->addChild('slider');

									$slider->addChild('path', $_POST['path'][$cs_counter] );

									$slider->addChild('title', htmlspecialchars($_POST['cs_slider_title'][$cs_counter]) );

									$slider->addChild('description', htmlspecialchars($_POST['cs_slider_description'][$cs_counter]) );

									$slider->addChild('link', htmlspecialchars($_POST['cs_slider_link'][$cs_counter]) );

									$slider->addChild('link_target', $_POST['cs_slider_link_target'][$cs_counter] );

									//$slider->addChild('box_align', $_POST['cs_slider_box_align'][$cs_counter] );

									$cs_counter++;

							}

						}

					update_post_meta( $post_id, 'cs_meta_slider_options', $sxe->asXML() );

				}

			}

			// saving Slider meta end

?>