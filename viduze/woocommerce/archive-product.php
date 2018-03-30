<?php 
	/*
	 * This file is used to generate WordPress standard archive/category pages.
	  * @author     CrunchPress
      * @package 	WooCommerce/Templates
      * @version     2.0.0
 */	

get_header(); ?>
<?php
	    global $paged, $sidebar, $left_sidebar, $right_sidebar;
		$sidebar = get_option ( THEME_NAME_S . '_products_page_sidebar', 'no-sidebar' );
        $sidebar = str_replace('product-', '', $sidebar) ; 
	    $bcontainer_class = '';
	    $sidebar_class = '';
        if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
					$sidebar_class = "sidebar-included " . $sidebar;
					$container_class = "span8";
				} else if ($sidebar == "both-sidebar") {
					$sidebar_class = "both-sidebar-included";
					 $bcontainer_class ="span8";
					 $container_class = "span8";
				} else {
					$container_class = "span12";	
					$sidebar_class = "no-sidebar";
				}
		
		$left_sidebar = "Shop Left Sidebar";
		$right_sidebar = "Shop Right Sidebar";
		
	?>
            
		
  <?php
							
			echo '<section id="content-holder" class="container-fluid">';
     		 echo '<div class="row-fluid '.$sidebar_class.'">';
	   			 echo '<section class="container">';
			    	echo "<div class='".$bcontainer_class." cp-page-float-left'>";
		     			echo "<div class='".$container_class. " row-fluid page-item'>";
                          ?>
                           
                           <header class="header-style">
                                <h2 class="h-style">
                                    <?php if ( is_search() ) : printf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
                                          if ( get_query_var( 'paged' ) ) printf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
                                        ?>
                                    <?php elseif ( is_tax() ) : 
                                          echo single_term_title( "", false ); 
                                          else :
                                          $shop_page = get_post( woocommerce_get_page_id( 'shop' ) );
                                          echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
                                          endif; 
                                     ?>
                                     </h2>
                           </header>
                           
                                
                                <?php do_action( 'woocommerce_archive_description' ); ?>
                        
                                <?php if ( is_tax() ) : ?>
                                    <?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
                                <?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
                                    <?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
                                <?php endif; ?>

                    		<?php 
						// start fetching database
						global $post, $wp_query;
							
						$port_size ="element1-4" ;
					
							
						$num_fetch = get_option(THEME_NAME_S.'_products_page_item');
						$item_size = get_option(THEME_NAME_S.'_products_page_thumb_size', '230x180');	
						$item_size_arr= explode('x',$item_size); $item_size_new_h=$item_size_arr[1]; $item_size_new_w=$item_size_arr[0];	
						$paged = (get_query_var('page')) ? get_query_var('page') : 1;  ?>
						
						<div class="widget-bg products">
                        <ul id="myTab" class="nav nav-tabs">
                        <li class="product-sorting"><?php do_action('woocommerce_before_shop_loop'); ?></li>
                        <li class=""><a href="#list"><i class="fa fa-list"></i></a></li>
                        <li class="active"><a href="#grid"><i class="fa fa-th-large"></i></a></li>
                        <li><p>View</p></li>
                        </ul>
                         
                        <div class="tab-content">
                        <div id="grid" class="tab-pane active">
                            <div class="product-list grid-style">
                            <ul>
                            
                            <?php 	if( $sidebar == "product-no-sidebar"){
                                    /*woocommerce_catalog_ordering();*/
                                    }
                                            
                                        // get the category for filter
                                        $item_categories = get_the_terms( $post->ID, 'product_cat' );
                                        $category_slug = " ";
                                        if( !empty($item_categories) ){
                                            foreach( $item_categories as $item_category ){
                                                $category_slug = $category_slug . $item_category->slug . ' ';
                                            }
                                        }
                                        
                                        $counter_product = 0;
                                        while( have_posts() ){
                                        the_post();	
                                         $thumbnail_types = "Image";
                                             
                                                            if( $thumbnail_types == "Image" ){
                                                                $image_type = "Lightbox to Current Thumbnail";
                                                                $image_type = empty($image_type)? "Link to Current Post": $image_type; 
                                                                $thumbnail_id = get_post_thumbnail_id();
                                                                $thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
                                                                $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
                                                                $image_type ="Lightbox to Picture";
                                                                if($image_type == "Lightbox to Picture" ){
                                                                    $hover_thumb = "hover-link";
                                                                    $permalink = get_permalink();	
                                                                    
                                                                }		
                                                            }
                                        ?>
                                    <!--LIST ITEM START-->
                                    <li>
                                        <div class="product-listing" style="width:<?php echo $item_size_new_w?>px;">
                                                <?php  woocommerce_show_product_loop_sale_flash();
                                                            echo '<div class="thumb">';
                                                            $item_size_arr= explode('x',$item_size); $item_size_new_h=$item_size_arr[1]; $item_size_new_w=$item_size_arr[0];
                                                            if (! empty($thumbnail)) {
                                                                         echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                                                                         echo '<img style="width:'.$item_size_new_w.'px; height:'.$item_size_new_h.'px; " src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
                                                                         echo '</a>';
                                                                        }else {
                                                                         echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                                                                                $item_size_arr= explode('x',$item_size); $item_size_new_h=$item_size_arr[1]; $item_size_new_w=$item_size_arr[0];
                                                                                  echo '<img style="width:'.$item_size_new_w.'px; height:'.$item_size_new_h.'px; " width="'. $item_size_new_w .'px"  height="'. $item_size_new_h .'px" " src="' .CP_PATH_URL.'/images/no-image.jpg" alt="no image"/>';
                                                                         echo '</a>'; 
                                                             } 
                                                             ?>
                                            </div>
                                            <div class="text">
                                                <p><?php echo '<a href="' . get_permalink() . '">' .get_the_title(). '</a>'; ?></p>
                                                <i class="fa fa-comments"></i>  <?php comments_popup_link( __('0','cp_front_end'), __('1','cp_front_end'), __('%','cp_front_end'), '',__('Comments are off','cp_front_end') );?>
                                                <i class="fa fa-eye"></i>  <?php if(function_exists('the_views')) { the_views(); } ?>
                                                <div class="cart">
                                                        <?php echo '<span class="price">'.do_action( 'woocommerce_after_shop_loop_item_title' ).'</span>'; ?>
                                                      <div class="cartbtn">  <?php do_action( 'woocommerce_after_shop_loop_item' ); ?><i class="fa fa-shopping-cart"></i></div>
                                                </div>
                                            </div>
                                        
                                    </li>
                                    <?php } ?>
                                    <!--LIST ITEM END-->
                                  
                                </ul>
                            </div>
                             <?php 
                            $product_nav = get_option(THEME_NAME_S.'_products_navi','Yes');
                                        if ('Yes' == $product_nav ){
                                               echo '<div class="pagination">';
                                                pagination();
                                               echo '</div>';
                                        }
                           ?>
                        </div>
                        <div id="list" class="tab-pane">
                            <div class="product-list list-style">
                                <ul>
                                    <!--LIST ITEM START-->
                                    <?php    while( have_posts() ){
                                        the_post(); ?>
                                    <li>
                                        <div class="product-listing">
                                         <div class="product-image-wrapper" style="width:<?php echo $item_size_new_w?>px;">
                                                <?php  woocommerce_show_product_loop_sale_flash();
												echo '<div class="thumb">';
												$item_size_arr= explode('x',$item_size); $item_size_new_h=$item_size_arr[1]; $item_size_new_w=$item_size_arr[0];
												if (! empty($thumbnail)) {
															 echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
															 echo '<img style="width:'.$item_size_new_w.'px; height:'.$item_size_new_h.'px; " src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
															 echo '</a>';
															}else {
															 echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
																	$item_size_arr= explode('x',$item_size); $item_size_new_h=$item_size_arr[1]; $item_size_new_w=$item_size_arr[0];
																	  echo '<img style="width:'.$item_size_new_w.'px; height:'.$item_size_new_h.'px; " width="'. $item_size_new_w .'px"  height="'. $item_size_new_h .'px" " src="' .CP_PATH_URL.'/images/no-image.jpg" alt="no image"/>';
															 echo '</a>'; 
												 } 
												 ?>
                                            </div>
                                            <div class="text">
                                                <p><?php echo '<a href="' . get_permalink() . '">' .get_the_title(). '</a>'; ?></p>
                                                <i class="fa fa-comments"></i>  <?php comments_popup_link( __('0','cp_front_end'), __('1','cp_front_end'), __('%','cp_front_end'), '',__('Comments are off','cp_front_end') );?>
                                                <i class="fa fa-eye"></i>  <?php if(function_exists('the_views')) { the_views(); } ?>
                                                <div class="cart">
                                                        <?php echo '<span class="price">'.do_action( 'woocommerce_after_shop_loop_item_title' ).'</span>'; ?>
                                                      <div class="cartbtn">  <?php do_action( 'woocommerce_after_shop_loop_item' ); ?><i class="fa fa-shopping-cart"></i></div>
                                                </div>
                                            </div>
                                           </div> 
                                        <!--Product Detail start-->
                                        <div class="product-list-detail">
                                            <h2><?php echo '<a href="' . get_permalink() . '">' .get_the_title(). '</a>'; ?></h2>
                                            <?php the_content() ?>
                                        </div>
                                        <!--Product Detail start-->
                                    </li>
                                    <!--LIST ITEM END-->
                                    <?php } ?>
                                </ul>
                            </div>
                           <?php 
                            $product_nav = get_option(THEME_NAME_S.'_products_navi','Yes');
                                        if ('Yes' == $product_nav ){
                                               echo '<div class="pagination">';
                                                pagination();
                                               echo '</div>';
                                        }
                           ?>
                                  </div>
                                </div>
                             </div> 
					     
							<?php	
							echo "</div>"; // end of cp-page-item
		            	    get_sidebar ( 'left' );
							echo "</div>"; // cp-page-float-left
		                	get_sidebar ( 'right' );
							?>
    		 </div>
          </section>
       </section>

<?php get_footer(); ?>