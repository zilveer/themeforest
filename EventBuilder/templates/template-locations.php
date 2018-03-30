<?php
/**
 * Template name: Locations
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

get_header(); ?>

		<?php if(!is_front_page()) { ?>

			<div id="page-title">

				<div class="content page-title-container">

					<div class="container box">

						<div class="row">

							<div class="col-sm-12">

								<?php themesdojo_breadcrumb(); ?>

								<h1 data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="page-title"><?php the_title(); ?></h1>

							</div>

						</div>

					</div>

				</div>

				<div class="page-title-bg">

					<?php if(has_post_thumbnail()) { ?>

						<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' ); ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($image_src[0]); ?>" alt="" />

					<?php } elseif(!empty($redux_default_img_bg)) { ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($redux_default_img_bg); ?>" alt="" />

					<?php } else { ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo get_template_directory_uri(); ?>/images/title-bg.jpg" alt="" />

					<?php } ?>

				</div>

			</div>

		<?php } ?>

		<div id="main-wrapper" class="content grey-bg">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-12">

						<div class="row">

							<?php

						        $currentID = 0;

						        $categories = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => 0) );

						        foreach ($categories as $category) {

						          	$currentID++;

						          	get_template_part( 'inc/BFI_Thumb' );
						          	$params = array( "width" => 900, "height" => 700, "crop" => true );

						          	if($currentID == 2) { 
						            	$widthID = "8"; 
						          	} elseif($currentID == 6) {
						            	$widthID = "8"; 
						          	} elseif($currentID == 12) {
						            	$widthID = "8"; 
						          	} else {
						            	$widthID = "4"; 
						          	}

						          	$tag = $category->cat_ID;
						          	$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
						          	$your_image_url = isset( $tag_extra_fields[$tag]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$tag]['your_image_url'] ) : '';
						          	$tag_link = get_term_link( $category );

						         	$option = '<div class="col-sm-'. $widthID .' '.$currentID.'"><div class="loc-block-cover"><a href="'.$tag_link.'"><span class="loc-block-cover-title">';
						         	$option .= $category->cat_name;
						          	$option .= '</span><span class="loc-block-cover-subtitle">(';
						          	$option .= $category->count;
						          	$option .= ')</span><span class="loc-block-cover-image" style="background: url('.bfi_thumb( "$your_image_url", $params ).') no-repeat center center;"></span></a></div></div>';

						          	$catID = $category->term_id;

						          	$categories_child = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => $catID) );

						          	foreach ($categories_child as $category_child) {

							            $currentID++;

							            if($currentID == 2) { 
							              	$widthID = "8"; 
							            } elseif($currentID == 6) {
							              	$widthID = "8"; 
							            } else {
							              	$widthID = "4"; 
							            }

							            $tag = $category_child->cat_ID;
							            $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
							            $your_image_url = isset( $tag_extra_fields[$tag]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$tag]['your_image_url'] ) : '';
							            $tag_link = get_term_link( $category_child );

							            $option .= '<div class="col-sm-'. $widthID .' '.$currentID.'"><div class="loc-block-cover"><a href="'.$tag_link.'"><span class="loc-block-cover-title">';
							            $option .= $category_child->cat_name;
							            $option .= '</span><span class="loc-block-cover-subtitle">(';
							            $option .= $category_child->count;
							            $option .= ')</span><span class="loc-block-cover-image" style="background: url('.bfi_thumb( "$your_image_url", $params ).') no-repeat center center;"></span></a></div></div>';

						          	}

						          	echo $option;

						        }

						    ?>

					    </div>

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>