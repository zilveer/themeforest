<?php
global $woocommerce,$product,$post;
?>
<div class="modal fade woocommerce product-quickview">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    		<div class="modal-body">
    			<div class="product-quickview-content">
					<div class="row">
						<div class="col-sm-6">
							<div class="single-product-images">
								<?php
									if ( has_post_thumbnail() ) {
								
										$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
										$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
											'title' => $image_title
											) );
										
										$attachment_ids = $product->get_gallery_attachment_ids();
										$image_full = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
								
										?>
										<?php $shop_single = wc_get_image_size( 'shop_single' );?>
										<div class="single-product-images-slider" data-item_template = "<?php echo esc_attr('<li class="caroufredsel-item"><a href="__image_full__" data-rel="magnific-popup-verticalfit" title="__image_title__">__image__</a></li>'); ?>">
											<div class="caroufredsel product-images-slider" data-height="variable" data-visible="1" data-responsive="1" data-infinite="1">
												<div class="caroufredsel-wrap">
													<ul class="caroufredsel-items">
														<li class="caroufredsel-item">
															<a title="<?php echo esc_attr($image_title)?>">
																<?php echo ($image)?>
															</a>
														</li>
														<?php if ( $attachment_ids ) {?>
															<?php  $loop=1; ?>
															<?php foreach ( $attachment_ids as $attachment_id ) {?>
															<?php 
															$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
															$image_title = esc_attr( get_the_title( $attachment_id ) );
															$image_full = wp_get_attachment_image_src($attachment_id,'full');
															?>
															<li class="caroufredsel-item">
																<div class="thumb">
																	<a title="<?php echo esc_attr($image_title)?>">
																		<?php echo ($image)?>
																	</a>
																</div>
															</li>
															<?php
																$loop ++; 
																}
															 ?>
														<?php } ?>
													</ul>
													<a href="#" class="caroufredsel-prev"></a>
													<a href="#" class="caroufredsel-next"></a>
												</div>
											</div>
										</div>
										<?php
									} else {
										echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
								
									}
								?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="summary entry-summary">
							<?php
								woocommerce_template_single_title();
								woocommerce_template_single_rating();
								woocommerce_template_single_price();
								woocommerce_template_single_excerpt();
								woocommerce_template_single_add_to_cart();
								woocommerce_template_single_meta();
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
