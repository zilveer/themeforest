<?php
/*
 * Single post template
 *
*/

get_header();
the_post();

wp_enqueue_script('bx-slider');

global $numpages;

$thumbnail_id = get_post_thumbnail_id($post->ID);
$thumbnail_url = wp_get_attachment_url($thumbnail_id);
$comments_count = wp_count_comments(get_the_ID());

?>

<div id="main-content" class="edd-product-page">
	<div class="container inner">
		<div class="col-sm-8 blogs">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

<!-- 				<div class="post-meta">
					<span class="post-date base_clr_bg sticky-post-date">
						<?php $date = date_parse(get_the_date()); ?>
						<span class="day"><?php echo $date["day"]; ?></span>
						<span class="month"><?php echo strftime("%b", mktime(0, 0, 0, $date["month"])); ?></span>
						<span class="year"><?php echo $date["year"]; ?></span>
					</span>
					<span class="post-author"><i class="fa fa-user"></i> <?php echo get_the_author(); ?></span>
					<span class="post-cat"><i class="fa fa-folder-o"></i><?php echo get_the_category_list(", "); ?></span>
				</div> -->

				<div class="entry-content">
					<?php if ($thumbnail_url) : ?>
						<!--<div class="post-thumbnail">
							<?php //the_post_thumbnail(); ?>
						</div>-->
						<div class="edd-product-pic-slider">
							<?php if( function_exists('startuply_get_post_thumbnails') ) { startuply_get_post_thumbnails(); } ?>
						</div>
					<?php endif; ?>

					<div class="entry-header">
						<h2 class="entry-title"><?php the_title(); ?> </h2>
					</div><!-- .entry-header -->

					<?php the_content(); ?>

				</div>

				<?php
				if ($numpages > 1): ?>
					<div class="posts-links-box">
						<?php wp_link_pages(array(
								'before' => '<div class="page-link">' . '',
								'after' => '</div>',
								'link_before' => '<div class="page-link-num base_clr_brd">' . '',
								'link_after' => '</div>'
							));
						?>
					</div><!--end post links-->
				<?php endif; ?>

				<div class="tags-box">
					<?php

						$tag_list = get_the_tag_list( '', __( ' ', 'vivaco' ) );
						if ( $tag_list ) { echo '<i class="icon icon-shopping-08"></i> <span class="tags-links">' . $tag_list . '</span>'; }

						$temp_post = get_next_post();
						$next_post_title = !empty( $temp_post ) ? $temp_post->post_title : '';

						$temp_post = get_previous_post();
						$prev_post_title = !empty( $temp_post ) ? $temp_post->post_title : '';

						if (strlen($next_post_title) > MAX_NAV_TITLE_LENGTH){
							$next_post_title = substr($next_post_title,0, MAX_NAV_TITLE_LENGTH)."...";
						};

						if (strlen($prev_post_title) > MAX_NAV_TITLE_LENGTH){
							$prev_post_title = substr($prev_post_title,0, MAX_NAV_TITLE_LENGTH)."...";
						};

					?>
				</div><!--end tags-->

				<?php if ($comments_count->approved > 0){ ?>
					<h4 class="comments-count"><?php printf(__('This entry has %s replies','vivaco'), '<span class="comments-count base_clr_txt">' . $comments_count->approved . '</span>');?></h4>
					<?php comments_template(); ?>
					<!--end comments-->
				<?php } ?>

			</article>

		</div><!-- end col-sm-8 -->

		<!-- side bar section -->
		<div id="sidebar" class="sidebar col-sm-4">
			<div id="sidebar-content">
				<div id="masonry-sidebar" class="sidebar-inner-content">

					<aside id="share-2" class="widget widget_product-info">
						<div class="widgetBody clearfix">
							<div class="product-price">
								<?php
									global $edd_options;
									$button_text = (empty($edd_options['add_to_cart_text']) ? 'Add to cart' : $edd_options[ 'add_to_cart_text' ]);
									if(edd_has_variable_prices(get_the_ID())) {

										// if the download has variable prices, show the first one as a starting price
										//echo 'from: '; edd_price(get_the_ID());
										echo edd_get_purchase_link( array(
											'download_id' => get_the_ID(),
											'class' => 'btn btn-sm btn-solid base_clr_bg item-link-buy',
											'text' => '<span class="icon icon-shopping-18"></span>'.$button_text,
											/*'price' => (bool)false )*/
											));
									} else {

										//edd_price(get_the_ID());
										echo edd_get_purchase_link( array(
											'download_id' => get_the_ID(),
											'class' => 'btn btn-sm btn-solid base_clr_bg item-link-buy',
											'text' => '<span class="price-title"><span class="icon icon-shopping-18"></span>'.$button_text.'</span>'.'<span class="price-value">'.edd_currency_filter(edd_get_download_price(get_the_ID())).'</span>',
											'price' => (bool)false
											));

									}

									//echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) );
								?>
							</div><!--end .product-price-->
						</div>
					</aside>

					<!--
					<aside id="share-2" class="widget widget_share">
						<div class="widgetBody clearfix">
							<header class="widgetHeader">
								<h3>Share With Freinds</h3>
							</header>

							<div class="share-box">
								<p class="title">
									<a href="javascript:;" class="share facebook img-circle" onClick="FacebookShare()"><i class="fa fa-facebook"></i></a>
									<a href="javascript:;" class="share twitter img-circle" onClick="TwitterShare()"><i class="fa fa-twitter"></i></a>
									<a href="javascript:;" class="share google img-circle" onClick="GoogleShare()"><i class="fa fa-google-plus"></i></a>
									<a href="javascript:;" class="share linkedin img-circle" onClick="LinkedinShare()"><i class="fa fa-linkedin"></i></a>
									<a href="javascript:;" class="share pinterest img-circle" onClick="PinterestShare()"><i class="fa fa-pinterest"></i></a>
								</p>
							</div>
						</div>
					</aside>

					<aside id="categories-2" class="widget widget_categories">
						<div class="widgetBody clearfix">
							<header class="widgetHeader">
								<h3>Categories</h3>
							</header>

							<ul>
								<?php echo get_the_term_list( $post->ID, 'download_category', '<li class="cat-item">', '</li><li  class="cat-item">', '</li>' ); ?>
							</ul>

						</div>
					</aside>

					<aside id="categories-2" class="widget widget_tags">
						<div class="widgetBody clearfix">
							<header class="widgetHeader">
								<h3>Tags</h3>
							</header>

							<ul>
								<?php echo get_the_term_list( $post->ID, 'download_tag', '<li class="tag-item">', '</li><li  class="tag-item">', '</li>' ); ?>
							</ul>

						</div>
					</aside>
					-->
				</div>
			</div>
		</div>
		<!-- side bar section -->


	</div><!--end container-inner-->

</div><!--end main-content-->

<?php get_footer(); ?>
