<?php
/**
* Template Name: Wiki
*/

$wiki_create = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('wiki_create') : '';
$woffice_role_allowed = woffice_role_allowed($wiki_create, 'wiki');

if (function_exists( 'woffice_wiki_extension_on' )){

	if ($woffice_role_allowed):
	
		$hasError = woffice_frontend_proccess('wiki');
		
	endif;

}


get_header(); 
?>

	<?php // Start the Loop.

    // We check for excluded categories
    $wiki_excluded_categories = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('wiki_excluded_categories') : '';
    /*If it's not a child only*/
    $wiki_excluded_categories_ready = (!empty($wiki_excluded_categories)) ? $wiki_excluded_categories : array();
    $enable_wiki_accordion = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('enable_wiki_accordion') : '';
    $enable_wiki_accordion = ( $enable_wiki_accordion == 'yep') ? true : false;
    $sortbylike_option = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('wiki_sortbylike') : '';
    $wiki_sortbylike = ($sortbylike_option == 'yep' && isset($_GET['sortby']) && $_GET['sortby']=='like') ? true : false ;

	while ( have_posts() ) : the_post(); ?>

		<div id="left-content">

			<?php  //GET THEME HEADER CONTENT

			woffice_title(get_the_title()); ?> 	

			<!-- START THE CONTENT CONTAINER -->
			<div id="content-container">

				<!-- START CONTENT -->
				<div id="content">
					<?php if (woffice_is_user_allowed()) { ?>
						<?php 
						// CUSTOM CLASSES ADDED BY THE THEME
						$post_classes = array('box','content');
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
							<div id="wiki-page-content" class="intern-padding">
								<?php 
								// THE PAGE CONTENT
								the_content();
								//DISABLED IN THIS THEME
								wp_link_pages(array('echo'  => 0));
								//EDIT LINK
								edit_post_link( __( 'Edit', 'woffice' ), '<span class="edit-link">', '</span>' );

								woffice_wiki_sort_by_like();
								
								if (function_exists( 'woffice_wiki_extension_on' )){
									// SEARCH FOR WIKI CATEGORIES
									$wiki_categories_args = apply_filters('woffice_wiki_get_primary_categories_args', array(
										'type'                     => 'wiki',
										'orderby'                  => 'name',
										'order'                    => 'ASC',
										'number'				   => '0',
										'taxonomy'                 => 'wiki-category',
									));
									$categories = get_categories($wiki_categories_args);
                                    // DISPLAY EACH CATEGORY
									$html_begin_row = '<!-- div.row --><div class="row">';
									$html_end_row = '</div><!-- div.row -->';
									$h = 0;

									//For each wiki category
									foreach($categories as $category) {
										//if it is a parent category and it is not excluded
										if($category->parent == 0 && !in_array($category->term_id, $wiki_excluded_categories_ready)) {

											//Get all wiki subcategories and subarticles of the current category
											$subcategories = woffice_display_wiki_subcategories( $category->term_id, $enable_wiki_accordion, $wiki_sortbylike );

											$html = '';
											$sub_html = '';
											$n_elements = $subcategories['summed_elements'];
											// GET ALL THE OTHER ONES
											$args       = array(
												'post_type'   => 'wiki',
												'showposts'   => - 1,
												'orderby'     => 'post_title',
												'order'       => 'ASC',
												'post_status' => array( 'publish', 'draft' ),
												'tax_query'   => array(
													array(
														'taxonomy'         => 'wiki-category',
														'field'            => 'term_id',
														'terms'            => array( $category->term_id ),
														'include_children' => false
													),
												),
											);
											$wiki_query = new WP_Query( $args );
											$wiki_array = array();

											//Get all articles of the current category
											while ( $wiki_query->have_posts() ) : $wiki_query->the_post();

												/*WE DISPLAY IT*/
												if ( woffice_is_user_allowed_wiki() ) {
													$n_elements++;
													$likes               = woffice_get_wiki_likes( get_the_id() );
													$likes_display       = ( ! empty( $likes ) ) ? $likes : '';
													$featured_wiki       = ( function_exists( 'fw_get_db_post_option' ) ) ? fw_get_db_post_option( get_the_ID(), 'featured_wiki' ) : '';
													$featured_wiki_class = ( $featured_wiki ) ? 'featured' : '';
													if ( $wiki_sortbylike ) {
														$like = get_string_between( $likes_display, '</i> ', '</span>' );
														array_push( $wiki_array, array(
																'string' => '<li class="is-' . get_post_status() . '"><a href="' . get_the_permalink() . '" rel="bookmark" class="' . $featured_wiki_class . '">' . get_the_title() . $likes_display . '</a></li>',
																'likes'  => ( ! empty( $like ) ) ? (int) $like : 0
															)
														);
													} else {
														$sub_html .= '<li class="is-' . get_post_status() . '"><a href="' . get_the_permalink() . '" rel="bookmark" class="' . $featured_wiki_class . '">' . get_the_title() . $likes_display . '</a></li>';
													}

												}

											endwhile;

											//If there is at least 1 article available for the current user, then render the category column
											if($n_elements > 0) {
												if ( $h > 0 && ! is_float( $h / 2 ) ) {
													echo $html_end_row;
												}
												if ( ! is_float( $h / 2 ) ) {
													print $html_begin_row;
												}
												echo '<div class="col-md-6 wiki-category-container">';
													// THE TITLE
													echo '<div class="heading"><h2><a href="' . get_term_link( $category->slug, 'wiki-category' ) . '">';
														echo apply_filters('woffice_wiki_category_title','<i class="fa fa-folder"></i> ' . esc_html( $category->name ) . ' (<span class="wiki-category-count">' . $n_elements . '</span>)', $category->name, $n_elements);
													echo '</a></h2></div>';
													// THE LIST
		                                            $accordion = ( $enable_wiki_accordion ) ? 'collapsed-wiki' : '';
													echo '<ul class="list-styled list-wiki wiki-category-container ' . $accordion . '">';

														// IF THERE IS CHILD CATEGORIES, WE DISPLAY THEM FIRST

														echo $subcategories['html'];

														echo $sub_html;

		                                                if ( $wiki_sortbylike ) {
		                                                    usort( $wiki_array, 'woffice_sort_objects_by_likes' );
		                                                    foreach ( $wiki_array as $wiki ) {
			                                                    echo $wiki['string'];
		                                                    }
		                                                }
														wp_reset_postdata();
													echo '</ul>';
												echo '</div>';
												$h ++;
											}
										}
		    						}
		    						if ($h > 0) echo $html_end_row;
									?>
									<hr>
									<div class="center" id="wiki-bottom">
										<?php // CHECK IF USER CAN CREATE WIKI PAGE
										if ($woffice_role_allowed):
										
											echo'<a href="javascript:void(0)" class="btn btn-default" id="show-wiki-create"><i class="fa fa-plus-square"></i> '. __("New Wiki Article", "woffice") .'</a>';
											
										endif; ?>
										<a href="<?php echo get_post_type_archive_link( 'wiki' ); ?>" class="btn btn-default">
											<i class="fa fa-folder-open-o"></i> <?php _e("All Articles", "woffice"); ?>
										</a>
									</div>
								<?php } ?>
							</div>
							
							<?php 
							if (function_exists( 'woffice_wiki_extension_on' )){
								// CHECK IF USER CAN CREATE WIKI PAGE
								if ($woffice_role_allowed):  ?>
									
									<?php woffice_frontend_render('wiki',$hasError); ?>
									
								<?php endif; 
							} ?>
						</article>

<!--						<script>-->
<!--							$ = jQuery.noConflict();-->
<!--							$(window).load(function(){-->
<!--								$('.wiki-category-container').each(function(){-->
<!--									$(this).find('.wiki-category-count').html($(this).find('li').length)-->
<!--									console.log($(this).find('li').length);-->
<!--								});-->
<!--							})-->
<!---->
<!---->
<!--						</script>-->
					<?php
					} else { 
						get_template_part( 'content', 'private' );
					}
					?>
				</div>
					
			</div><!-- END #content-container -->
		
			<?php woffice_scroll_top(); ?>

		</div><!-- END #left-content -->

	<?php // END THE LOOP 
	endwhile; ?>

<?php 
get_footer();



