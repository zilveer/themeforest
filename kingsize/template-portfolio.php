<?php
/*
Template Name: Portfolio Page
*/
?>
<?php
define('TERM_TAXONOMY', $wpdb->prefix . 'term_taxonomy');
define('POSTS', $wpdb->prefix . 'posts');
define('TERM_RELATIONSHIPS', $wpdb->prefix . 'term_relationships');
global $postParentPageID,$data,$portfolio_page;
$tpl_body_id = 'prettyphoto';
get_header(); 
update_option('current_page_template','body_portfolio body_prettyphoto body_gallery_2col_pp');

$portfolio_page = 'portfolio';

global $wp_query,$no_of_page_columns;

$template_name = get_post_meta( $post->ID, '_wp_page_template', true );
$no_of_page_columns = get_post_meta( $post->ID, 'kingsize_page_columns', true );

if(empty($no_of_page_columns))
	$no_of_page_columns = "2columns";


#### Getting the portfolio selected category from meta data ####
$kingsize_page_porfolio_category = get_post_meta( $post->ID, 'kingsize_page_porfolio_category', true );
$kingsize_page_porfolio_category_arr = explode(",",$kingsize_page_porfolio_category);

//$kingsize_page_porfolio_category_arr = array("0"=>12);

#### Getting the portfolio selected ORDERBY from meta data ####
if(get_post_meta( $post->ID, 'kingsize_page_porfolio_orderby', true ) == "custom_id") {
	$porfolio_orderby = "menu_order ID";	
	$porfolio_order = "ASC";
}
elseif(get_post_meta( $post->ID, 'kingsize_page_porfolio_orderby', true ) == "rand") {
	$porfolio_orderby = "rand";	
	$porfolio_order = "";
}
elseif(get_post_meta( $post->ID, 'kingsize_page_porfolio_orderby', true ) == "asc_order") {
	$porfolio_orderby = "date";	
	$porfolio_order = "ASC";
}
else { 
	$porfolio_orderby = "date";
	$porfolio_order = "DESC";
}


#### PAGING GO HERE  #### 
if($data['wm_portfolio_num_items'])
	$_portfolio_num_items = $data['wm_portfolio_num_items'];
else
	$_portfolio_num_items = 10;


if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} elseif (get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

#### creating arguments #######
if($kingsize_page_porfolio_category != '') :
	$args_portfolio=array(
		"tax_query" => array(
			array(
				"taxonomy" => "portfolio-category",
				"field" => "id",
				"terms" => $kingsize_page_porfolio_category_arr
			)
		),
		'post_type' => array('portfolio'),
		'order' => $porfolio_order,
		'orderby' => $porfolio_orderby,
		'posts_per_page' => $_portfolio_num_items,
		'paged' => $paged,
	);		
else :
	$args_portfolio=array(
		'post_type' => array('portfolio'),
		'order' => $porfolio_order,
		'orderby' => $porfolio_orderby,
		'posts_per_page' => $_portfolio_num_items,
		'paged' => $paged,
	);		
endif;

$postParentPageID = $post->ID; //Page POSTID

//sidebar enabled OR not checking
$sidebarEnabled = false;
if ( $data['wm_page_sidebar_enabled'] == "1"  && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "" )
	$sidebarEnabled = true;
elseif ( ($data['wm_page_sidebar_enabled'] == "0" || $data['wm_page_sidebar_enabled'] == "")  && get_post_meta($postParentPageID, 'page_sidebar_hide', true ) == "" ) 
	$sidebarEnabled = true;
?>			
	
			 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					 
					<!--Page title start-->
					<?php if ( $data['wm_show_page_post_headers'] == "" || $data['wm_show_page_post_headers'] == "0" ) { ?>
						<div class="row header">
							<div class="<?php if ( $sidebarEnabled == true ) {?>eight<?php } else { ?>twelve<?php } ?> columns">
								<h2 class="title-page"><?php the_title(); ?></h2>
							</div>
						</div>
					<?php } else { ?>
						<div class="row header">
							<div class="<?php if ( $sidebarEnabled == true ) {?>eight<?php } else { ?>twelve<?php } ?> columns">
								<h2 class="title-page"></h2>
							</div>
						</div>
					<?php } ?>					
					<!-- Ends Page title --> 
					
					<!-- Begin Breadcrumbs -->
					<div class="row">
						<div class="twelve columns">
							<?php if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs" class="yoast-bc">','</p>');
							} ?>
						</div>
					</div>
					<!-- End Breadcrumbs -->

					<?php if($content = $post->post_content) {  the_content(); } else { the_content();  } ?>
			 
      				<?php	
					$checkPasswd = false;
					if (!empty($post->post_password)) { // if there's a password
					if(!post_password_required($post->ID)) {
						$checkPasswd = true;
					 }
					 else
						 $checkPasswd = false;
					}
					else{
						$checkPasswd = true;
					}


					if($checkPasswd == true) :



					  ########### FIXING # OF COLUMN AND IMAGE URL ###########
						if($no_of_page_columns=="2columns"){
							$div_layout = "six mobile-two columns mobile-fullwidth";
						}
						elseif($no_of_page_columns=="3columns"){
							$div_layout = "four columns mobile-four mobile-fullwidth";
						}
						elseif($no_of_page_columns=="4columns"){
							$div_layout = "three columns mobile-one mobile-fullwidth";
						}
						elseif($no_of_page_columns=="grid"){
							$div_layout = "six_col columns mobile-one mobile-fullwidth";
						}
					?>	
					
      					<!-- Gallery with PrettyPhoto plugin -->
      					<div class="row assorted">

							 <?php 
								$count = 1;
								$temp = $wp_query;
							    $wp_query= null;

								$wp_query = new WP_Query();
								$wp_query->query($args_portfolio);	

								//echo $GLOBALS['wp_query']->request;

							if ($wp_query->max_num_pages > 0) : 								

								while ($wp_query->have_posts()) : $wp_query->the_post();

									$the_post = get_post( $post->ID, ARRAY_A );

									//if CUSTOM LINK has been set from write up panel for the permalink
									if(get_post_meta( $post->ID, 'portfolios_read_more_link', true ) != '') :
										$permalink = get_post_meta( $post->ID, 'portfolios_read_more_link', true );
									else :
										ob_start();
										the_permalink();
										$permalink = ob_get_contents();
										ob_end_clean();
									endif;
								?>

							<div class="<?php echo $div_layout;?>">	
								<div class="row">
									<div class="twelve columns">

										<h3 class="post_title"><?php if ( $data['wm_show_portfolio_title'] == "0" || $data['wm_show_portfolio_title'] == "") {?><a href="<?php echo $permalink; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><?php } else { ?><!-- No Titles --><?php } ?></h3>
								          
									<!-- Portfolio post-thumb gallery -->
										<div class="portfolio_thumb"><?php kingsize_thumb_box($post->ID); ?></div>
									<!-- END Portfolio post-thumb gallery -->

									 <!--BEGIN excerpt content -->
	                                    <p><?php echo substr($post->post_excerpt,0,240); ?></p>
									 <!--END excerpt content -->

									<?php
									//checking read more text has been set from the write up panel
									if(get_post_meta( $post->ID, 'portfolios_read_more_disable', true ) != 1) :

										if(get_post_meta( $post->ID, 'portfolios_read_more_text', true ) != '') :
											echo '<a href="'.$permalink.'" class="more-link">'.get_post_meta( $post->ID, 'portfolios_read_more_text', true ).'</a>';
										else :
											echo '<a href="'.$permalink.'" class="more-link">'.__("Read More", "kslang").'</a>';
										endif;
									
									endif;
									?>

                                 </div> <!-- END twelve columns -->
								</div> <!-- END row -->
							   </div>
							<?php $count++; endwhile; ?>										
							<?php 
							else : 
								echo '<div class="four columns mobile-four mobile-fullwidth"><div class="row"><div class="twelve columns"><p>No portfolio yet.</p></div></div></div>';
							endif; 
						?>	
						
					  </div><!-- End row assorted -->
				<!-- End Gallery with PrettyPhoto plugin -->

					    <!-- Pagination -->
						<?php if (  $wp_query->max_num_pages > 1 ) : $paged = intval(get_query_var('paged')); ?>
						<div id="pagination-container">							
							<div id="pagination">	
							
								<div class="older"><?php next_posts_link( __('&larr; Older entries', 'kslang') ); ?></div>
				
								<?php if($paged > 1) :?>
								<div class="newer"><?php previous_posts_link( __('Newer entries &rarr;', 'kslang') ); ?></div>
								<?php endif; ?>

							</div><!-- #nav-below -->		
						</div>				
						<?php endif; ?>
						<!-- End Pagination -->
					<?php 
					wp_reset_postdata();
					$wp_query = null; $wp_query = $temp; 
					?>
						
				<?php endif; //password protected check ?> 
				<?php endwhile; ?>
				<?php endif;?>
				<!-- Gallery ends here -->	

<?php get_footer(); ?>