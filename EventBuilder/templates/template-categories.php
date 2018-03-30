<?php
/**
 * Template name: Categories
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

							<div class="row" style="margin-bottom: 50px;">

      							<div id="events-cat-block">

									<?php

							            $categories = get_categories( array( 'taxonomy' => 'event_cat', 'hide_empty' => false, 'parent' => 0 ) );

							            foreach ($categories as $category) {

							                $tag = $category->term_id;

							                $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
							                $category_icon_code = isset( $tag_extra_fields[$tag]['category_icon_code'] ) ? $tag_extra_fields[$tag]['category_icon_code'] : '';
							                $category_icon = stripslashes($category_icon_code);

							                $tag_link = get_term_link( $category );
							        ?>

							        <div class="col-sm-4 cat-block-isotope">

							            <div class="category-shortcode-block">

							                <?php if(!empty($category_icon)) { echo $category_icon; } ?>

							                <h3 <?php if(empty($category_icon)) { ?>style="margin-top: 30px;"<?php } ?>><?php echo esc_attr($category->cat_name); ?></h3>

							                <?php

							                  	$categories_child = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => $tag) );

							                  	$option = "";

							                  	$currentPos = 0;

							                  	if(!empty($categories_child)) { 

							                  	?>

							                <ul class="sub-cat-block">

							                <?php }

							                foreach ($categories_child as $category_child) {

							                    $currentPos++;

							                    $subCatId = $category_child->cat_ID;
							                    $subCatLink = get_term_link( $category_child );

							                    $option .= '<li><span class="cat-title"><a href="'.$subCatLink.'">';
							                    $option .= $category_child->cat_name;
							                    $option .= '</a></span><span class="cat-count">';
							                    $option .= $category_child->count;
							                    $option .= '</span></li>';

							               	}

							                echo $option;

							                if(!empty($categories_child)) {

							                ?>

							                </ul>

							                <?php } ?>

							                <?php $catCount = $category->count; if(empty($categories_child) OR $catCount != 0){ ?>

							                <ul class="sub-cat-block" <?php if($currentPos > 0) { ?>style="border-top: none; padding-top: 0px;"<?php } ?>>

							                <?php

							                  	$optionOne = '';
							                  	$optionOne .= '<li><span class="cat-title"><a href="'.$tag_link.'">';
							                  	$optionOne .= $category->cat_name;
							                  	$optionOne .= '</a></span><span class="cat-count">';
							                  	$optionOne .= $category->count;
							                  	$optionOne .= '</span></li>';

							                  	echo $optionOne;

							                ?>

							                </ul>

							                <?php } ?>

							            </div>

							        </div>

							        <?php

							            }

							        ?>

							    </div>

							</div>

					    </div>

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>