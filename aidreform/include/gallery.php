<?php

	// Gallery start

		//adding columns start

		add_filter('manage_cs_gallery_posts_columns', 'gallery_columns_add');

			function gallery_columns_add($columns) {

				$columns['author'] = 'Author';

				return $columns;

		}

		add_action('manage_cs_gallery_posts_custom_column', 'gallery_columns');

			function gallery_columns($name) {

				global $post;

				switch ($name) {

					case 'author':

						echo get_the_author();

						break;

				}

			}

		//adding columns end

	function cs_gallery_register() {  

		$labels = array(

			'name' =>__('Galleries','AidReform'),

			'add_new_item' =>__('Add New Gallery','AidReform'),

			'edit_item' =>__('Edit Gallery','AidReform'),

			'new_item' =>__('New Gallery Item','AidReform'),

			'add_new' =>__('Add New Gallery','AidReform'),

			'view_item' =>__('View Gallery Item','AidReform'),

			'search_items' =>__('Search Gallery','AidReform'),

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

			'menu_icon' => get_template_directory_uri() . '/images/admin/gallery-icon.png',

			'rewrite' => true,

			'capability_type' => 'post',

			'hierarchical' => false,

			'menu_position' => null,

			'supports' => array('title')

		); 

        register_post_type( 'cs_gallery' , $args );

	}

	add_action('init', 'cs_gallery_register');



		// adding Gallery meta info start

			add_action( 'add_meta_boxes', 'cs_meta_gallery_add' );

			function cs_meta_gallery_add()

			{  

				add_meta_box( 'cs_meta_gallery', __('Gallery Options','AidReform'), 'cs_meta_gallery', 'cs_gallery', 'normal', 'high' );  

			}

			function cs_meta_gallery( $post ) {

				?>

					<div class="page-wrap" style="overflow:hidden;">

					<div class="option-sec">

                            <div class="opt-conts-in">

                                <div class="to-social-network">

                                    <div class="gal-active">

                                        <div class="clear"></div>

                                        <div class="dragareamain">

                                        <div class="placehoder"><?php _e('Gallery is Empty. Please Select Media','AidReform')?> <img src="<?php echo get_template_directory_uri()?>/images/admin/bg-arrowdown.png" alt="" /></div>

										<ul id="gal-sortable">

											<?php 

												global $cs_node, $cs_counter;

												$cs_counter_gal = 0;

                                                $cs_meta_gallery_options = get_post_meta($post->ID, "cs_meta_gallery_options", true);

                                                if ( $cs_meta_gallery_options <> "" ) {

                                                    $cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);

                                                        foreach ( $cs_xmlObject->children() as $cs_node ){

                                                            $cs_counter_gal++;

                                                            $cs_counter = $post->ID.$cs_counter_gal;

															cs_gallery_clone();

                                                        }

                                                }

                                            ?>

                                        </ul>

                                        </div>

                                    </div>

                                    <div class="to-social-list">

                                        <div class="soc-head">

                                            <h5><?php _e('Select Media','AidReform')?></h5>

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

							var count_items = <?php echo $cs_counter_gal?>;

							if ( count_items > 0 ) {

								jQuery(".dragareamain") .addClass("noborder");	

							}

							function clone(path){

								counter = counter + 1;

								var dataString = 'path='+path+'&counter='+counter+'&action=gallery_clone';

								

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

      function galedit(id){

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

       function galclose(id){

  var $ = jQuery;

  $("#edit_" + id) .slideUp(300);

  $(".to-social-list,.gal-active h4.left,#gal-sortable li,#gal-sortable .thumb-secs")  .fadeIn(300);

  };



</script>                    

										<div id="pagination"><?php media_pagination();?></div>

	                                    <input type="hidden" name="gallery_meta_form" value="1" />

                                        <div class="clear"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="clear"></div>

                    </div>

                <?php

			}

			// adding Gallery meta info end

			// saving Gallery meta start

			if ( isset($_POST['gallery_meta_form']) and $_POST['gallery_meta_form'] == 1 ) {

				add_action( 'save_post', 'cs_meta_gallery_options' );

				function cs_meta_gallery_options( $post_id )

				{

					$cs_counter = 0;

					$sxe = new SimpleXMLElement("<gallery_options></gallery_options>");

						if ( isset($_POST['path']) ) {

							foreach ( $_POST['path'] as $count ) {

								$gallery = $sxe->addChild('gallery');

									$gallery->addChild('path', $_POST['path'][$cs_counter] );

									$gallery->addChild('title', htmlspecialchars($_POST['title'][$cs_counter]) );

									$gallery->addChild('use_image_as', $_POST['use_image_as'][$cs_counter] );

									$gallery->addChild('video_code', htmlspecialchars($_POST['video_code'][$cs_counter]) );

									$gallery->addChild('link_url', htmlspecialchars($_POST['link_url'][$cs_counter]) );

									$cs_counter++;

							}

						}

					update_post_meta( $post_id, 'cs_meta_gallery_options', $sxe->asXML() );

				}

			}

			// saving Gallery meta end

	// Gallery end

?>