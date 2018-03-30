<?php
function mango_current_page_id(){
    global $post, $wp_query;
    $current_page_id = '';
    // Get The Page ID You Need
    //wp_reset_postdata();
    if(class_exists("woocommerce")) {
        if( is_shop() ){ ///|| is_product_category() || is_product_tag()) {
            $current_page_id  =  get_option ( 'woocommerce_shop_page_id' );
        }elseif(is_cart()) {
            $current_page_id  =  get_option ( 'woocommerce_cart_page_id' );
        }elseif(is_checkout()){
            $current_page_id  =  get_option ( 'woocommerce_checkout_page_id' );
        }elseif(is_account_page()){
            $current_page_id  =  get_option ( 'woocommerce_myaccount_page_id' );
        }elseif(is_view_order_page()){
            $current_page_id  = get_option ( 'woocommerce_view_order_page_id' );
        }
    }
    if($current_page_id=='') {
        if ( is_home () && is_front_page () ) {
            $current_page_id = '';
        } elseif ( is_home () ) {
            $current_page_id = get_option ( 'page_for_posts' );
        } elseif ( is_search () || is_category () || is_tag () || is_tax () ) {
            $current_page_id = '';
        //}elseif(class_exists("woocommerce") && (is_shop() || is_product_category() || is_cart() || is_checkout() || is_account_page() || is_view_order_page() )){
           // $current_page_id = '';
        } elseif ( !is_404 () ) {
           $current_page_id = $post->ID;
        }
    }
    return $current_page_id;
}

function mango_side_header_large(){
   global $mango_settings;
    $current_page_id = mango_current_page_id();
    $large_header = ( get_post_meta (  $current_page_id, 'mango_side_header_large', true ) ) ? get_post_meta (  $current_page_id, 'mango_side_header_large', true ) : '';
    if(!$large_header){
        $large_header = isset( $mango_settings[ 'mango_side_header_large' ] ) ? $mango_settings[ 'mango_side_header_large' ] : '';
    }
    if($large_header === 'normal'){
        $large_header = false;
    }
    if($large_header){
        return 'side-menu-large';
    }else{
        return '';
    }
}

function mango_show_footer_menu(){
    global $mango_settings;
    $current_page_id  = mango_current_page_id();
    $hide_footer_menu = ( get_post_meta (  $current_page_id, 'mango_hide_footer_menu', true ) ) ? get_post_meta (  $current_page_id, 'mango_hide_footer_menu', true ) : '';
    if($hide_footer_menu ==1){
        return true;
    }elseif( $hide_footer_menu ==2){
        return false;
    }
    if(!$hide_footer_menu) {
        $hide_footer_menu = isset( $mango_settings[ 'mango_hide_footer_menu' ] ) ? $mango_settings[ 'mango_hide_footer_menu' ] : '';
    }
    if($hide_footer_menu){
        return false;
    }else{
        return true;
    }
}

function mango_page_title_header () {
    global $mango_settings,$post;
    $current_page_id = mango_current_page_id();
    $id =  $current_page_id;
    $hide_page_title = ( get_post_meta (  $id, 'mango_hide_page_title', true ) ) ? get_post_meta (  $id, 'mango_hide_page_title', true ) : '';
     if($hide_page_title == 2 || $hide_page_title =="" ) {
        $hide_page_title = isset( $mango_settings[ 'mango_hide_page_title' ] ) ? $mango_settings[ 'mango_hide_page_title' ] : '';
    }
    $hide_page_breadcrumb = ( get_post_meta (  $id, 'mango_hide_breadcrumb', true ) ) ? get_post_meta (  $id, 'mango_hide_breadcrumb', true ) : '';
    if($hide_page_breadcrumb == 2 || $hide_page_breadcrumb =="") {
        $hide_page_breadcrumb = isset( $mango_settings[ 'mango_hide_breadcrumb' ] ) ? $mango_settings[ 'mango_hide_breadcrumb' ] : '';
    }

    $position = ( get_post_meta (  $id, 'mango_breadcrumb_title_position', true ) ) ? get_post_meta (  $id, 'mango_breadcrumb_title_position', true ) : '';
    if(!$position) {
        $position = isset( $mango_settings[ 'mango_breadcrumb_title_position' ] ) ? $mango_settings[ 'mango_breadcrumb_title_position' ] : '';
    }
    $size = ( get_post_meta (  $id, 'mango_bread_title_size', true ) ) ? get_post_meta (  $id, 'mango_bread_title_size', true ) : '';
    if(!$size) {
        $size = isset( $mango_settings[ 'mango_bread_title_size' ] ) ? $mango_settings[ 'mango_bread_title_size' ] : '';
    }

    $bg_type = ( get_post_meta (  $id, 'mango_bread_title_bg', true )  ) ? get_post_meta (  $id, 'mango_bread_title_bg', true ) : '';
    if(!$bg_type) {
        $bg_type = isset( $mango_settings[ 'mango_bread_title_bg' ] ) ? $mango_settings[ 'mango_bread_title_bg' ] : '';
    }
    $parallax = false;
    //mango_bread_title_color
    if($bg_type=='bg-img'){
        $parallax = ( get_post_meta (  $id, 'mango_use_parallax', true )  ) ? get_post_meta (  $id, 'mango_use_parallax', true ) : '';
        if(!$parallax) {
            $parallax = isset( $mango_settings[ 'mango_use_parallax' ] ) ? $mango_settings[ 'mango_use_parallax' ] : '';
        }
    }
    $use_full = false;
    $use_full = ( get_post_meta (  $id, 'mango_breadcrumb_use_full', true )  ) ? get_post_meta (  $id, 'mango_breadcrumb_use_full', true ) : '';
        if(!$use_full) {
            $use_full = isset( $mango_settings[ 'mango_breadcrumb_use_full' ] ) ? $mango_settings[ 'mango_breadcrumb_use_full' ] : '';
        }
    if($use_full =='no'){
        $use_full = '';
    }
    if(!$hide_page_title || !$hide_page_breadcrumb){ ?>
        <div class="page-header <?php echo esc_attr($position).' '.esc_attr($size).' '.( ($parallax and $bg_type=='bg-img' )?"parallax":"") ?>"
                <?php if($parallax and $bg_type=='bg-img'){ echo 'data-top="background-position:50% 0px;" data-bottom-top="background-position:50% -100%"'; } ?>>
            <div class="container">
            <?php if($use_full){?> <div class="row"><?php } ?>
            <?php if(!$hide_page_title){ ?>
                    <?php if($use_full){ ?> <div class="col-md-6"><?php } ?>
                        <h1 class="bigger">
                            <?php echo mango_page_title($current_page_id) ?>
                        </h1>
                    <?php if($use_full){ ?> </div><?php } ?>
            <?php   } ?>
            <?php if(!$hide_page_breadcrumb){ ?>
                <?php if($use_full){ ?> <div class="col-md-6"><?php } ?>
                        <?php mango_breadcrumb($current_page_id) ?>
                <?php if($use_full){ ?> </div><?php } ?>
            <?php   } ?>
            <?php if($use_full){ ?> </div><?php } ?>
            </div>
        </div>
 <?php   }
}


function mango_page_title ($current_page_id) {
    global $mango_settings, $post;
	
	$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	if($term){
		$cate = $term->name." ";
	}
    if ( is_front_page () && is_home ()  ) {
		return $mango_settings[ 'mango_blog_title' ];
    } elseif($the_tax ){
		 $labels=$the_tax->labels->name;
		 echo $labels." : ";
		 echo $cate;  
	} elseif ( is_front_page () ) {
        return get_the_title ();
    } elseif ( is_category () ) {
        return __( 'Category Archives: ', 'mango' ) . '"' . single_cat_title ( '', false ) . '"';
    } elseif ( is_tag () ) {
        return __( 'Tag Archives: ', 'mango' ) . '"' . single_tag_title ( '', false ) . '"';
    } elseif ( is_year () ) {
        return __( 'Yearly Archives: ', 'mango' ) . '"' . get_the_date ( "Y" ) . '"';
    } elseif ( is_author () ) {
        return __( 'Author Archives: ', 'mango' ) . '"' . get_the_author () . '"';
    } elseif ( is_month () ) {
        return __( 'Monthly Archives: ', 'mango' ) . '"' . get_the_date ( "F, Y" ) . '"';
    } elseif ( is_day () ) {
        return __( 'Daily Archives: ', 'mango' ) . '"' . get_the_date ( "d F, Y" ) . '"';
    } elseif ( is_search () ) {
        return __( 'Search Result For: ', 'mango' ) . '"' . get_search_query () . '"';
    }  elseif ( is_post_type_archive ( 'testimonial' ) ) {
        return __( 'Testimonials', 'mango' );
    }elseif(is_post_type_archive ( 'clients' )){
        return __( 'Clients', 'mango' );
    }elseif(is_404()){
        return __("Error 404","mango");
    } elseif(is_single()){
        if(get_post_format($post->ID) == "aside"){
            //no post title for aside post
        }else {
            return get_the_title ($current_page_id);
        }
    }else{
		return get_the_title ($current_page_id);
	}
}

	// Woocommerce Vendor Start
if(class_exists('WC_Vendors') ){
function mango_wc_vendor_header(){
		
global $mango_settings, $post, $wp_query,$vendor_shop;
			$vendor_id     = WCV_Vendors::get_vendor_id( $vendor_shop ); 
			$shop_name  =  get_user_meta( $vendor_id  , 'pv_shop_name', true );
			$description  = do_shortcode( get_user_meta( $vendor_id, 'pv_shop_description', true ) );
			if($vendor_shop){
				if($mango_settings['mango_wcvendors_shop_description']){
				?>
				 <?php 
					 $product_id = get_the_ID();
					 $author = WCV_Vendors::get_vendor_from_product( $product_id );
					 $link=WCV_Vendors::get_vendor_shop_page( $author);
					 $author = WCV_Vendors::get_vendor_from_product(get_the_ID()); 
					 $user = get_userdata( $author );
					 ?>
					 
						<?php 
					

						$r = get_user_meta( $user->ID, 'picture', true );
						$r = $r['url'];
						if($r){					
						?>
						<div class="vendor-profile-bg" style="background:url('<?php echo $r?>') ;background-size:cover">
						<?php }else{ ?>
						<div class="vendor-profile-bg">
						<?php }	?>
						<div class="overlay-vendor-effect">
					<?php if($mango_settings['mango_wcvendors_shop_avatar']){ ;?>
					<div class="vendor_userimg">
				
					<div class="profile-img">
					  	<a href="<?php echo $link?>"> <?php echo get_avatar( $vendor_id, 80 ); ?></a>
					</div>
					
					</div>
					<?php } ?>
					  <h1><a href="<?php echo $link?>"><?php echo $shop_name; ?></a></h1>
					  <div class="custom_shop_description">
					  <?php echo wpautop( $description ); ?>
					  </div>
				<?php 	  
				 $author = WCV_Vendors::get_vendor_from_product(get_the_ID()); 
				 $user = get_userdata( $author );
					
				 if($mango_settings['mango_wcvendors_shop_profile']){
				  ?>
				  
					 <?php if($mango_settings['mango_wcvendors_phone']){
					   if($user->phone_number) { ?>
				      <span class="vendorcustom-mail"><i class="fa fa-phone aligmentvendor"></i> &nbsp;<?php echo  $user->phone_number; ?></span>
				      <?php } } ?>  &nbsp;&nbsp;
				    <?php if($mango_settings['mango_wcvendors_email']){
					   if($user->user_email) { ?>
				    <span class="vendorcustom-mail"><i class="fa fa-envelope aligmentvendor"></i> &nbsp;<?php echo  $user->user_email; ?></span>
				   <?php } } ?>
				   &nbsp;&nbsp;
					 <?php 
					 if($mango_settings['mango_wcvendors_url']){
					 if($user->user_url) { ?>
				    <span class="vendorcustom-mail"><i class="fa fa-globe aligmentvendor"></i> &nbsp; <?php echo $user->user_url ;?></span>
				    <?php } } 
				    ?>

					<p class="vendor-user-social">
						<?php if( $user->facebook_url ) : ?>
							<span class="user-facebook"><a rel="nofollow" href="<?php echo esc_url( $user->facebook_url ); ?>"><i class="fa fa-facebook-square"></i></a></span>
						<?php endif; ?>

						<?php if( $user->twitter_url ) : ?>
							<span class="user-twitter"><a rel="nofollow" href="<?php echo esc_url( $user->twitter_url ); ?>"><i class="fa fa-twitter-square"></i></a></span>
						<?php endif; ?>

						<?php if( $user->gplus_url ) : ?>
							<span class="user-googleplus"><a rel="nofollow" href="<?php echo esc_url( $user->gplus_url ); ?>"><i class="fa fa-google-plus-square"></i></a></span>
						<?php endif; ?>
						
						 <?php if( $user->youtube_url ) : ?>
							<span class="user-youtube"><a rel="nofollow" href="<?php echo esc_url( $user->youtube_url ); ?>"><i class="fa fa-youtube-square"></i></a></span>
						<?php endif; ?>
						
							
						 <?php if( $user->linkedin_url ) : ?>
							<span class="user-linkedin"><a rel="nofollow" href="<?php echo esc_url( $user->linkedin_url ); ?>"><i class="fa fa-linkedin-square"></i></a></span>
						<?php endif; ?>
						
						 <?php if( $user->flickr_url ) : ?>
							<span class="user-flicker"><a rel="nofollow" href="<?php echo esc_url( $user->flickr_url ); ?>"><i class="fa fa-flickr-square"></i></a></span>
						<?php endif; ?>
						 
					</p>

				 <?php }?>
			 
				 </div>
				 </div>
				<?php }
			
			
			}
			if(is_product()){
				
			global $mango_settings, $post;

		   $shop_name  =  get_user_meta( $post->post_author  , 'pv_shop_name', true );
			$Shop_description  =  get_user_meta( $post->post_author  , 'pv_shop_description', true );

		  ?>

			 <?php if($mango_settings['mango_single_wcvendors_product_description']){ ?>
			   <?php 
				  $product_id = get_the_ID();
				 $author = WCV_Vendors::get_vendor_from_product( $product_id );
				 $link=WCV_Vendors::get_vendor_shop_page( $author);
				 $author = WCV_Vendors::get_vendor_from_product(get_the_ID()); 
					 $user = get_userdata( $author );
					 ?>
					 
						<?php 
					

						$r = get_user_meta( $user->ID, 'picture', true );
						$r = $r['url'];
						if($r){					
						?>
						<div class="vendor-profile-bg" style="background:url('<?php echo $r?>') ;background-size:cover">
						<?php }else{ ?>
						<div class="vendor-profile-bg">
						<?php }	?>
						<div class="overlay-vendor-effect">
				 <?php if($mango_settings['mangowcvendors_product_avatar']){ ?>
					<div class="vendor_userimg">
						
							<div class="profile-img">
						  <a href="<?php echo $link?>"> <?php echo get_avatar( $author, 80 ); ?>	</a>
							</div>
					
					</div>
				 <?php } ?>
				
			     <h1>
				  <a href="<?php echo $link?>"><?php echo $shop_name; ?></a>
				 </h1>
				  <div class="custom_shop_description">
					<?php echo wpautop( $Shop_description ); ?>
				  </div>
				<?php 	  
				 $author = WCV_Vendors::get_vendor_from_product(get_the_ID()); 
				 $user = get_userdata( $author );

			 
				if($mango_settings['mango_wcvendors_product_profile']){
				?>
			  
				 <?php if($mango_settings['mango_wcvendors_phone']){
				   if($user->phone_number) { ?>
					<span class="vendorcustom-mail"><i class="fa fa-phone aligmentvendor"></i> &nbsp;<?php echo  $user->phone_number; ?></span>
				<?php } } ?>  
			    <?php if($mango_settings['mango_wcvendors_email']){
				   if($user->user_email) { ?>
			    <span class="vendorcustom-mail"><i class="fa fa-envelope aligmentvendor"></i> &nbsp;<?php echo  $user->user_email; ?></span>
			    <?php } } ?>
			  
				 <?php 
				 if($mango_settings['mango_wcvendors_url']){
				 if($user->user_url) { ?>
			     <span class="vendorcustom-mail"><i class="fa fa-globe  aligmentvendor"></i> &nbsp; <?php echo $user->user_url ;?></span>
			    <?php } } ?>


	      	<p class="vendor-user-social">
				<?php if( $user->facebook_url ) : ?>
					<span class="user-facebook"><a rel="nofollow" href="<?php echo esc_url( $user->facebook_url ); ?>"><i class="fa fa-facebook-square"></i></a></span>
				<?php endif; ?>

				<?php if( $user->twitter_url ) : ?>
					<span class="user-twitter"><a rel="nofollow" href="<?php echo esc_url( $user->twitter_url ); ?>"><i class="fa fa-twitter-square"></i></a></span>
				<?php endif; ?>

				<?php if( $user->gplus_url ) : ?>
					<span class="user-googleplus"><a rel="nofollow" href="<?php echo esc_url( $user->gplus_url ); ?>"><i class="fa fa-google-plus-square"></i></a></span>
				<?php endif; ?>
				
				 <?php if( $user->youtube_url ) : ?>
					<span class="user-youtube"><a rel="nofollow" href="<?php echo esc_url( $user->youtube_url ); ?>"><i class="fa fa-youtube-square"></i></a></span>
				<?php endif; ?>
				
					
				 <?php if( $user->linkedin_url ) : ?>
					<span class="user-linkedin"><a rel="nofollow" href="<?php echo esc_url( $user->linkedin_url ); ?>"><i class="fa fa-linkedin-square"></i></a></span>
				<?php endif; ?>
				
				 <?php if( $user->flickr_url ) : ?>
					<span class="user-flicker"><a rel="nofollow" href="<?php echo esc_url( $user->flickr_url ); ?>"><i class="fa fa-flickr-square"></i></a></span>
				<?php endif; ?>
				 
				</p>	 
			 
				<?php  }?>
			 
				 </div>
				 <?php } ?>
					
				<?php 
			
			}
	} 
	
	
}

// Woocommerce Vendor End




// Breadcrumb
function mango_breadcrumb ($current_page_id) {
    // Settings
    global $mango_settings, $post, $wp_query,$vendor_shop;
    if(class_exists("woocommerce") && is_woocommerce()){
        $args = array(
                'delimiter'   => '',
                'wrap_before' => '<ol class="woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
                'wrap_after'  => '</ol>',
                'before'      => '<li>',
                'after'       => '</li>',
              );
        woocommerce_breadcrumb($args);
        return ;
    }
    $home_title = __('Home',"mango");
    // Get the query & post information
    $category = get_the_category();
    // Build the breadcrums
    echo '<ol class="breadcrumb">';
    if( get_option( 'page_for_posts' ) != 0 ) {
         $blog_page_id = get_option( 'page_for_posts' );
        $p = get_post( $blog_page_id );
         $page_title = $p->post_title;
         $blog_page_url =  "<li><a href ='" . esc_url(get_permalink( $blog_page_id )) . "'>" . esc_attr($page_title) . "</a></li>";
         $blog_page_crumb = "<li>".$page_title."</li>";
    } else {
        $theblog_url_query = new WP_Query( array(
            "post_type" => "page",
            'meta_key' => '_wp_page_template',
            'meta_value' => 'index.php'
        ) );
        if( $theblog_url_query->have_posts() ) {
            $theblog_url_query->the_post();
            $blog_page_url = "<li><a href ='" . esc_url(get_the_permalink()) . "'>" . esc_attr(get_the_title()) . "</a></li>";
            $blog_page_crumb = "<li>".esc_attr(get_the_title())."</li>";
            wp_reset_postdata();
        } else {
            $blog_page_url = '';
            $blog_page_crumb = "<li>".__("Blog","mango")."</li>";
        }
    }
    // Do not display on the homepage
    if ( !is_front_page() ) {
        // Home page
        echo '<li><a href="' . esc_url(get_home_url()) . '" title="' . esc_attr($home_title) . '">' . esc_attr($home_title) . '</a></li>';
        if(is_home()){
            echo $blog_page_crumb;
        }elseif(is_tax("portfolio-category") || is_singular("portfolio")  || (is_search() && get_query_var('post_type')=='portfolio')  ){
            $portfolio_page = new WP_Query( array(
                "post_type" => "page",
                'meta_key' => '_wp_page_template',
                'meta_value' => 'templates/portfolio.php'
            ) );
            if( $portfolio_page->have_posts() ) {
                $portfolio_page->the_post();
                echo  "<li><a href ='" . esc_url(get_the_permalink()) . "'>" . __("Portfolio","mango") . "</a></li>";
                wp_reset_postdata();
            }else{
                echo  "<li>".__("Portfolio","mango")."</li>";
            }
            if(is_singular("portfolio")){
                echo "<li>".esc_attr(get_the_title())."</li>";
            }elseif(is_tax("portfolio-category")){
                echo "<li>".single_term_title ( "", false )."</li>";
            }else{
                echo '<li>'.get_search_query (). '</li>';
            }
        }elseif(is_tax("faq-category") || is_singular("faq") ){
            $faqs = new WP_Query( array(
                "post_type" => "page",
                'meta_key' => '_wp_page_template',
                'meta_value' => 'templates/faqs.php'
            ) );
            if( $faqs->have_posts() ) {
                $faqs->the_post();
                echo  "<li><a href ='" . esc_url(get_the_permalink()) . "'>" . __("FAQs","mango") . "</a></li>";
                wp_reset_postdata();
            }else{
                echo  "<li>".__("FAQs","mango")."</li>";
            }
            if(is_singular("faq")){
                echo "<li>".esc_attr(get_the_title())."</li>";
            }else{
                echo "<li>".single_term_title ( "", false )."</li>";
            }

        }elseif(is_singular("testimonial") ){
            $testimonials = new WP_Query( array(
                "post_type" => "page",
                'meta_key' => '_wp_page_template',
                'meta_value' => 'templates/testimonials.php'
            ) );
            if( $testimonials->have_posts() ) {
                $testimonials->the_post();
                echo  "<li><a href ='" . esc_url(get_the_permalink()) . "'>" . __("Testimonials","mango") . "</a></li>";
                wp_reset_postdata();
            }else{
                echo  "<li>".__("Testimonials","mango")."</li>";
            }
                echo "<li>".esc_attr(get_the_title())."</li>";
        }else if ( is_singular('post') ) {
            echo $blog_page_url;
            // Single post (Only display the first category)
            echo '<li><a href="' . esc_url(get_category_link($category[0]->term_id )) . '" title="' . esc_attr($category[0]->cat_name) . '">' . esc_attr($category[0]->cat_name) . '</a></li>';
            echo '<li>'.esc_attr($post->post_title).'</li>';
        } else if ( is_category() ) {
             echo $blog_page_url;
            // Category page
            echo '<li>' . esc_attr($category[0]->cat_name) . '</li>';

        } else if ( is_page() ) {
            // Standard page
            if( $post->post_parent ){
                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );
                // Get parents in the right order
                $anc = array_reverse($anc);
                // Parent page loop
                $parents = '';
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li><a href="'. esc_url(get_permalink($ancestor)) . '" title="' . esc_attr(get_the_title($ancestor)) . '">' . esc_attr(get_the_title($ancestor)) . '</a></li>';
                }
                // Display parent pages
                echo $parents;

                // Current page
                echo '<li>' . esc_attr(get_the_title()) . '</li>';

            } else {
                // Just display current page if not parents
                echo '<li>' . esc_attr(get_the_title()) . '</li>';
            }
        } else if ( is_tag() ) {
            // Tag page
            echo $blog_page_url;
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );

            // Display the tag name
            echo '<li>'. esc_attr($terms[0]->name) . '</li>';

        } elseif ( is_day() ) {
            // Day archive
            echo $blog_page_url;
            // Year link
            echo '<li><a href="' . esc_url(get_year_link( get_the_time('Y') )) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_attr(get_the_time('Y')).'</a></li>';
            // Month link
            echo '<li><a href="' . esc_url(get_month_link( get_the_time('Y'), get_the_time('m') )) . '" title="' . esc_attr(get_the_time('M')) . '">' .esc_attr( get_the_time('M')) .'</a></li>';
            // Day display
            echo '<li>' . esc_attr(get_the_time('jS')) . ' ' . esc_attr(get_the_time('M')).'</li>';
        } else if ( is_month() ) {
            echo $blog_page_url;
            // Month Archive
            // Year link
            echo '<li><a href="' . esc_url(get_year_link( get_the_time('Y') )) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_attr(get_the_time('Y')) . '</a></li>';
            // Month display
            echo '<li title="' . esc_attr(get_the_time('M') ). '">' . esc_attr(get_the_time('M')) . '</li>';
        } else if ( is_year() ) {
            echo $blog_page_url;
            // Display year archive
            echo '<li>' . esc_attr(get_the_time('Y')) . '</li>';
        } else if ( is_author() ) {
            echo $blog_page_url;
            // Auhor archive
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
            // Display author name
            echo '<li>'.__("Author","mango").': ' . esc_attr($userdata->display_name) . '</li>';
        }else if ( is_search() && get_query_var('post_type')=='post' ) {
            echo $blog_page_url;
            // Search results page
            echo '<li>'.__("Search results for","mango").': ' . get_search_query() . '</li>';
        } elseif ( is_404() ) {
            // 404 page
            echo '<li>' . __("Error 404","mango") . '</li>';
        }
        if ( get_query_var('paged')  ) {
            // Paginated archives
            echo '<li>'.__('Page',"mango") . ' ' . get_query_var('paged') .'</li>';
        }
    }
    echo '</ol>';
}

if ( !function_exists ( 'mango_validate_url' ) ) {
    function mango_validate_url () {
        global $post;
        $page_url = esc_url ( get_permalink ( $post->ID ) );
        $urlget = strpos ( $page_url, "?" );
        if ( $urlget === false ) {
            $concate = "?";
        } else {
            $concate = "&";
        }
        return $page_url . $concate;
    }
}

function mango_search_form ( $form ) {
    global $mango_settings;
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if( isset( $mango_settings[ 'mango_search_type' ] ) && $mango_settings[ 'mango_search_type' ] === 'product' && is_plugin_active( 'yith-woocommerce-ajax-search/init.php' ) && class_exists( 'WooCommerce' ) ) {
        global $con_class, $search_button_class;
        $search_button_class = " btn-custom";
        $con_class = "header-search-container sm-margin"; // header-simple-search
        $wc_get_template = function_exists( 'wc_get_template' ) ? 'wc_get_template' : 'woocommerce_get_template';
        ob_start();
        $wc_get_template( 'yith-woocommerce-ajax-search.php', array(), '', YITH_WCAS_DIR . 'templates/' );
        return ob_get_clean();
    }
    ob_start ();
    ?>
    <div class="header-search-container header-simple-search">
        <form action="<?php echo esc_url ( home_url ( '/' ) ); ?>">
            <div class="form-group">
                <input type="search" required="required" class="form-control" <?php if ($mango_settings[ 'search_field_placeholder' ]) { ?>
                       placeholder="<?php echo esc_attr($mango_settings[ 'search_field_placeholder' ]); ?>"
                       <?php } ?> value="<?php echo get_search_query () ?>" name="s" id="s"/>
                        <?php
                         $type = isset( $mango_settings[ 'mango_search_type' ] ) ? $mango_settings[ 'mango_search_type' ] : 'post';
                        if(! post_type_exists( $type )){
                                $type = 'post';
                        }  ?>
                <input type="hidden" name="post_type" value="<?php echo esc_attr($type); ?>"/>
                <?php $lang_code = explode ( '-', get_bloginfo ( "language" ) ); ?>
                <input type="hidden" name="lang" value="<?php echo esc_attr($lang_code[ 0 ]); ?>"/>
                <button class="btn" type="submit" title="<?php __("Search",'mango') ?>"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <?php
    return ob_get_clean ();
}

add_filter ( 'get_search_form', 'mango_search_form');
//limit words
function wordslimit ( $input, $maxWords, $maxChars = 500 ) {
    $input = wp_strip_all_tags ( $input );
    $input = preg_replace ( '/\[[^\]]*]/', '', $input );
    $input = preg_replace ( "~(?:\[/?)[^/\]]+/?\]~s", '', $input );
    $words = preg_replace ( '/\[[^\[\]]*\]/', '', $input );
    $words = preg_split ( '/\s+/', $input );
    $words = array_slice ( $words, 0, $maxWords );
    $words = array_reverse ( $words );
    $chars = 0;
    $truncated = array ();
    while ( count ( $words ) > 0 ) {
        $fragment = trim ( array_pop ( $words ) );
        $chars += strlen ( $fragment );
        if ( $chars > $maxChars ) break;
        $truncated[ ] = $fragment;
    }
    $result = implode ( $truncated, ' ' );
    return $result . ( $input == $result ? '' : '...' );
}

//pagination function
function mango_pagination ($pages = '', $range = 3) {
    global $paged, $post, $mango_settings, $wp_query;
    $current_page_id =  mango_current_page_id();
    $showitems = ( $range * 2 ) + 1;
    if ( $pages == '' ) {
        $pages = $wp_query->max_num_pages;
        if ( !$pages ) {
            $pages = 1;
        }
    }
       echo '<nav class="pagination-container">';
            echo '<span class="pagination-info">';
	$paged    = max( 1, $wp_query->get( 'paged' ) );
	$per_page = $wp_query->get( 'posts_per_page' );
	$total    = $wp_query->found_posts;
	$first    = ( $per_page * $paged ) - $per_page + 1;
	$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
	if ( 1 == $total ) {
        _e( 'Showing the single result', 'mango' );
    } elseif ( $total <= $per_page || -1 == $per_page ) {
        printf( __( 'Showing all %d results', 'mango' ), $total );
    } else {
        printf( _x( 'Showing %1$d-%2$d of %3$d', '%1$d = first, %2$d = last, %3$d = total', 'mango' ), $first, $last, $total );
    }
            echo "</span>";
        if ( 1 != $pages ) {
            echo '<ul class="pagination">';
            if ( $paged > 1 + $range ) echo "<li><a href='" . esc_url(get_pagenum_link ( 1 )) . "' aria-label='First'><span aria-hidden='true'><i class='fa fa-angle-double-left'></i></span></a></li>";
            if ( $paged > 1 ) echo "<li><a href='" . esc_url(get_pagenum_link ( $paged - 1 ) ). "' aria-label='Previous'><span aria-hidden='true'><i class='fa fa-angle-left'></i></span></a></li>";
            for ( $i = 1; $i <= $pages; $i ++ ) {
                if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
                    echo "<li".( ( $paged == $i ) ? " class='active'" : "" ) ."><a href='" . get_pagenum_link ( $i ) . "'>" . $i . "</a></li>";
                }
            }
            if ( $paged < $pages ) echo "<li><a href='" .esc_url( get_pagenum_link ( $paged + 1 )) . "' aria-label='Next'><span aria-hidden='true'><i class='fa fa-angle-right'></i></span></a></li>";
            if ( $paged < $pages-$range ) echo "<li><a href='" . esc_url(get_pagenum_link ( $pages )) . "' aria-label='Last'><span aria-hidden='true'><i class='fa fa-angle-double-right'></i></span></a></li>";
        echo "</ul>";
        }
        echo "</nav>";
}
//overrite mango columns, left sidebar and right sidebar for taxonomies
function mango_taxonomy_page_layout_settings($key){
    global $mango_settings;
    if(is_tax(array('product_cat','product_tag','portfolio-category','faq-category')) || is_category() || is_tag()){
        $tax_id = get_queried_object_id();
        $tax_data =  get_option( 'tax_meta_'.$tax_id);
        if($tax_data){
            if(isset($tax_data[$key])){
                if($key=='mango_taxonomy_layout' && $tax_data[$key]=='default'){
                    return '';
                }
                return $tax_data[$key];
            }
        }else{
            return "";
        }
    }
}

//get columns
function mango_page_columns(){
    global $mango_settings, $post;
    $mango_layout_columns = '';
    $mango_layout_columns = mango_taxonomy_page_layout_settings("mango_taxonomy_layout");
    $current_page_id =  mango_current_page_id();
    if(!$mango_layout_columns) {
        $mango_layout_columns = get_post_meta ( $current_page_id, 'mango_page_layout', true ) ? get_post_meta ( $current_page_id, 'mango_page_layout', true ) : '';
    }
    if(!$mango_layout_columns) {

        if(is_page_template("templates/portfolio.php") || is_tax('portfolio-category') || (is_search() && get_query_var("post_type")=='portfolio') ){
            $mango_layout_columns = ( isset( $mango_settings[ 'mango_portfolio_layout' ] ) ) ? $mango_settings[ 'mango_portfolio_layout' ] : '';
        }elseif(is_singular("portfolio")){
            $mango_layout_columns = ( isset( $mango_settings[ 'mango_portfolio_single_layout' ] ) ) ? $mango_settings[ 'mango_portfolio_single_layout' ] : '';
}elseif ( ( is_front_page() && is_home() ) || (is_page_template("index.php")) || is_post_type_archive ( 'post' ) || is_search() ) {
			
            $mango_layout_columns = ( isset( $mango_settings[ 'mango_blog_layout' ] ) ) ? $mango_settings[ 'mango_blog_layout' ] : '';
			
        } elseif ( is_single() ){
            $mango_layout_columns = ( isset( $mango_settings[ 'mango_post_layout' ] ) ) ? $mango_settings[ 'mango_post_layout' ] : '';
        }
        if(class_exists("woocommerce")){
            if(is_shop() || is_product_category() || is_product_tag() || (is_search() && get_query_var("post_type")=='product')){
                $mango_layout_columns = ( isset( $mango_settings[ 'mango_shop_layout' ] ) ) ? $mango_settings[ 'mango_shop_layout' ] : '';
            }elseif(is_product()){
                $mango_layout_columns = ( isset( $mango_settings[ 'mango_product_layout' ] ) ) ? $mango_settings[ 'mango_product_layout' ] : '';
            }
        }

    }
    if(!$mango_layout_columns){
        $mango_layout_columns =  ( isset( $mango_settings[ 'mango_page_layout' ] ) ) ? $mango_settings[ 'mango_page_layout' ] : 'left';
    }
    return apply_filters("mango_filter_page_columns",$mango_layout_columns);
}

function mango_left_sidebar(){
    global $mango_settings, $post,$current_page;
    $mango_left_sidebar = '';
    $mango_left_sidebar = mango_taxonomy_page_layout_settings("mango_taxonomy_left_sidebar");
    //echo $current_page_id =  mango_current_page_id();
	 $current_page_id = $current_page;
    if ( !$mango_left_sidebar ) {
        $mango_left_sidebar = get_post_meta ( $current_page_id, 'mango_page_sidebar_left', true ) ? get_post_meta ( $current_page_id, 'mango_page_sidebar_left', true ) : '';
	}
	if(!$mango_left_sidebar) {
		if(class_exists("woocommerce")){
			if(is_shop() || is_product_category() || is_product_tag()){
				$mango_left_sidebar = ( isset( $mango_settings[ 'mango_shop_sidebar_left' ] ) ) ? $mango_settings[ 'mango_shop_sidebar_left' ] : '';
			}elseif(is_product()){
				$mango_left_sidebar = ( isset( $mango_settings[ 'mango_product_sidebar_left' ] ) ) ? $mango_settings[ 'mango_product_sidebar_left' ] : '';
			}
		}
	   if ( ( is_front_page() || is_home() ) || (is_page_template("index.php")) || is_post_type_archive ( 'post' ) || is_search() ) {
			$mango_left_sidebar = ( isset( $mango_settings[ 'mango_blog_sidebar_left' ] ) ) ? $mango_settings[ 'mango_blog_sidebar_left' ] : '';
		} 
		if ( is_singular("post") ) {
			$mango_left_sidebar = ( isset( $mango_settings[ 'mango_post_sidebar_left' ] ) ) ? $mango_settings[ 'mango_post_sidebar_left' ] : '';
		}elseif(is_page_template("templates/portfolio.php") || is_tax("portfolio-category")  || is_post_type_archive('portfolio')){
			$mango_left_sidebar = ( isset( $mango_settings[ 'mango_portfolio_sidebar_left' ] ) ) ? $mango_settings[ 'mango_portfolio_sidebar_left' ] : '';
		}elseif(is_singular("portfolio")){
			$mango_left_sidebar = ( isset( $mango_settings[ 'mango_portfolio_single_sidebar_left' ] ) ) ? $mango_settings[ 'mango_portfolio_single_sidebar_left' ] : '';
		}
	}
	if(!$mango_left_sidebar){
		$mango_left_sidebar =  ( isset( $mango_settings[ 'mango_page_sidebar_left' ] ) ) ? $mango_settings[ 'mango_page_sidebar_left' ] : '';
	}
	
    return $mango_left_sidebar;
}
function mango_right_sidebar(){
    global $mango_settings, $post,$current_page;

    $mango_right_sidebar = '';
    $mango_right_sidebar  = mango_taxonomy_page_layout_settings("mango_taxonomy_right_sidebar");
    //$current_page_id =  mango_current_page_id();
	 $current_page_id = $current_page;
    if (!$mango_right_sidebar ) {
        
		$mango_right_sidebar = get_post_meta ($current_page_id, 'mango_page_sidebar_right', true ) ? get_post_meta ( $current_page_id, 'mango_page_sidebar_right', true ) : '';
	}
	if(! $mango_right_sidebar){
            if(class_exists("woocommerce")){
                if(is_shop() || is_product_category() || is_product_tag()){
                    $mango_right_sidebar = ( isset( $mango_settings[ 'mango_shop_sidebar_right' ] ) ) ? $mango_settings[ 'mango_shop_sidebar_right' ] : '';
                }elseif(is_product()){
                    $mango_right_sidebar = ( isset( $mango_settings[ 'mango_product_sidebar_right' ] ) ) ? $mango_settings[ 'mango_product_sidebar_right' ] : '';
                }
            }
            if ( is_front_page () || is_home () || (is_page_template("index.php")) || is_post_type_archive ( 'post' ) ) {
                $mango_right_sidebar = ( isset( $mango_settings[ 'mango_blog_sidebar_right' ] ) ) ? $mango_settings[ 'mango_blog_sidebar_right' ] : '';
            }elseif ( is_singular ("post") ) {
                $mango_right_sidebar = ( isset( $mango_settings[ 'mango_post_sidebar_right' ] ) ) ? $mango_settings[ 'mango_post_sidebar_right' ] : '';
            }elseif(is_page_template("templates/portfolio.php") || is_tax("portfolio-category")  || is_post_type_archive('portfolio')){
                $mango_right_sidebar = ( isset( $mango_settings[ 'mango_portfolio_sidebar_right' ] ) ) ? $mango_settings[ 'mango_portfolio_sidebar_right' ] : '';
            }elseif(is_singular("portfolio")){
                $mango_right_sidebar = (isset( $mango_settings[ 'mango_portfolio_single_sidebar_right' ] ) ) ? $mango_settings[ 'mango_portfolio_single_sidebar_right' ] : '';
			}
    }
	if(!$mango_right_sidebar){
		$mango_right_sidebar =  ( isset( $mango_settings[ 'mango_page_sidebar_right' ] ) ) ? $mango_settings[ 'mango_page_sidebar_right' ] : '';
	
	}
	  return $mango_right_sidebar;
}


add_filter( 'oembed_dataparse','mango_oembed_filter',10,1);
function mango_oembed_filter( $return ){
    $add_class = str_replace( 'allowfullscreen', 'class="embed-responsive-item" allowfullscreen', $return );
    return $add_class;
}
function mango_class_name(){
    global $mango_layout_columns;
    $class = "col-md-";
        if ( $mango_layout_columns == 'left' ) {
            $class .=  '9 col-md-push-3';
        } elseif ( $mango_layout_columns == 'no' ) {
            $class .= '12';
        } elseif ( $mango_layout_columns == 'right' ) {
            $class .= '9';
        } else {
            $class .= '6 col-md-push-3';
        }
    return $class;
}
function mango_get_logo_url($area = '') {
    global $mango_settings, $post;

    $id =  mango_current_page_id();
    $img = get_post_meta ( $id, 'mango_' . $area . 'logo', true );

    if ( !$img ) {
        $img_path = $mango_settings[ $area.'logo' ][ 'url' ];
    } else {
        $image = wp_get_attachment_image_src ( $img, 'full' );
        $img_path = $image[ 0 ];
    }
    return $img_path;
}
function mango_portfolio_settings(){
    global $mango_settings, $post;
    //$portfolio_settings = array();
    $current_page_id =  mango_current_page_id();
    $portfolio_style = $portfolio_page_style =  $portfolio_cols = $portfolio_full_width  = '';
    if($current_page_id !=''){
      $portfolio_style =  get_post_meta ( $current_page_id, 'mango_portfolio_style', true ) ? get_post_meta ( $current_page_id, 'mango_portfolio_style', true ) : '';
      $portfolio_page_style = get_post_meta ( $current_page_id, 'mango_portfolio_page_style', true ) ? get_post_meta ( $current_page_id, 'mango_portfolio_page_style', true ) : '';
      $portfolio_cols = get_post_meta ( $current_page_id, 'mango_portfolio_columns', true ) ? get_post_meta ( $current_page_id, 'mango_portfolio_columns', true ) : '';
      $portfolio_full_width = get_post_meta ( $current_page_id, 'mango_portfolio_full_width', true ) ? get_post_meta ( $current_page_id, 'mango_portfolio_full_width', true ) : '';
    }
    if(!$portfolio_style){
        $portfolio_style = ( isset( $mango_settings[ 'mango_portfolio_style' ] ) ) ? $mango_settings[ 'mango_portfolio_style' ] : '';
    }
    if(!$portfolio_page_style){
        $portfolio_page_style = ( isset( $mango_settings[ 'mango_portfolio_page_style' ] ) ) ? $mango_settings[ 'mango_portfolio_page_style' ] : '';
    }
    if(!$portfolio_cols){
        $portfolio_cols = ( isset( $mango_settings[ 'mango_portfolio_columns' ] ) ) ? $mango_settings[ 'mango_portfolio_columns' ] : '';
    }
    if(!$portfolio_full_width){
        $portfolio_full_width = ( isset( $mango_settings[ 'mango_portfolio_full_width' ] ) ) ? $mango_settings[ 'mango_portfolio_full_width' ] : '';
    }
     $mango_settings['style'] = $portfolio_style;
     $mango_settings['page_style'] = $portfolio_page_style;
     $mango_settings['cols'] =   $portfolio_cols;
    $mango_settings['full-width'] =   $portfolio_full_width;
    return $mango_settings;
}
function mango_portfolio_img_src($id = '',$size=''){
    global $post, $mango_settings, $portfolio_settings;
    if($id==''){
        $id = mango_current_page_id();
    }
    if($size=='') {
        if ($portfolio_settings['page_style'] == 'grid') {
            $size = "portfolio-grid";
        } else {
            $size = 'full';
        }
    }
    if(has_post_thumbnail(get_the_ID())){
        $path = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
        $ret["anchor"] = $path[0];

        $path2 = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
        $ret["img"] = $path2[0];
    }else{
        $app_gallery = get_post_meta($id, 'mango_portfolio_option_image', false);
        if(!empty($app_gallery)){
            $img_src = wp_get_attachment_image_src( $app_gallery[0], $size ) ;
            $ret["img"] = $img_src[0];
            $img_src2 = wp_get_attachment_image_src( $app_gallery[0], "full" ) ;
            $ret["anchor"] = $img_src2[0];
        }else{
            $ret['img'] = mango_uri .'/images/dummy-img.jpg';
            $ret["anchor"] = mango_uri .'/images/dummy-img.jpg';
        }
    }
    $video = get_post_meta ( $id, 'mango_portfolio_video_embed', true ) ? get_post_meta ( $id, 'mango_portfolio_video_embed', true ) : '';
    if($video){
        $ret["anchor"] = $video;
        $ret['class'] = "mfp-iframe";
    }else{
        $ret['class'] = '';
    }

    return $ret;
}
function mango_comment( $comment, $args, $depth ) { ?>
    <?php $add_below = ''; ?>
   <li  <?php comment_class( 'media' ); ?>  id="comment-<?php comment_ID() ?>" >
    <div class="media-left">
        <?php echo get_avatar( $comment, 54 ); ?>
      <!--  <img class="media-object" src="images/blog/christopher.jpg" alt="christopher"> -->
    </div>
    <div class="media-body">
    <h4 class="media-heading"><?php echo get_comment_author_link() ?><span class="comment-date">(<?php printf( __('Posted %1$s, %2$s', 'mango' ), get_comment_date(), get_comment_time() ) ?>)</span></h4>
        <span>
                <?php edit_comment_link( __( ' - Edit', 'mango' ), '  ', '' ) ?>
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( ' - Reply', 'mango' ), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ) ?>
        </span>
        <?php if( $comment->comment_approved == '0' ) : ?>
            <p><em><?php echo __( 'Your comment is awaiting moderation.', 'mango' ) ?></em></p>
            <br/>
        <?php endif; ?>
        <?php comment_text() ?>
    </div>
</li>
<?php }
function mango_posts_before( $query ) {
    global $mango_settings;
    if ( $query->is_tax('faq-category') || $query->is_tax('portfolio-category') ) {
        set_query_var ( 'posts_per_page', - 1 );
    }
    if(is_search() && get_query_var("post_type")=='portfolio'){
        set_query_var('posts_per_page', -1);
        if(isset($_GET['portfolio_cat_filter']) &&  $_GET['portfolio_cat_filter'] !='0'){
            $taxquery = array(
                array(
                    'taxonomy' => 'portfolio-category',
                    'field' => 'id',
                    'terms' => array( $_GET['portfolio_cat_filter'] ),
                )
            );
            $query->set( 'tax_query', $taxquery );
        }
    }
    if(is_search() && get_query_var("post_type")=='product'){
        if(isset($_GET['product_cat_filter']) &&  $_GET['product_cat_filter'] !='0'){
            $taxquery = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => array( $_GET['product_cat_filter'] ),
                )
            );
            $query->set( 'tax_query', $taxquery );
        }
    }
    if(is_search() && get_query_var("post_type")=='post'){
        if(isset($_GET['post_cat_filter']) &&  $_GET['post_cat_filter'] !='0'){
            $query->set( 'cat',$_GET['post_cat_filter'] );
        }
        if(isset($_GET['post_tag_filter']) &&  $_GET['post_tag_filter'] !='0'){
            $query->set( 'tag',$_GET['post_tag_filter'] );
        }
    }
}
add_action( 'pre_get_posts', 'mango_posts_before' );
function mango_search_template_chooser($template) {
    global $wp_query, $mango_settings;
    $post_type = get_query_var('post_type');
    if( $wp_query->is_search && $post_type == 'portfolio' ) {
        return locate_template('search-portfolio.php');
    }
    if( $wp_query->is_search && $post_type == 'product' ) {
        return locate_template('woocommerce/search-product.php');
    }
    return $template;
}
add_filter('template_include', 'mango_search_template_chooser');
function mango_wrapper_class(){
    global $mango_settings, $post;
    $id = mango_current_page_id();
    $wrapper =  get_post_meta ( $id, 'mango_theme_wrapper', true ) ? get_post_meta ( $id, 'mango_theme_wrapper', true ) : '';
  if(!$wrapper){
      $wrapper = ( isset( $mango_settings[ 'mango_theme_wrapper' ] ) ) ? $mango_settings[ 'mango_theme_wrapper' ] : 'wide';
  }
    return $wrapper;
}
function mango_get_header_box($header){
    global $mango_settings;
    $boxes = $mango_settings['mango_header_'.$header.'_boxes'];
    if($boxes > 0){
        for($i= 1; $i<=$boxes; $i++){
            $title = $mango_settings['mango_header_box_title_'.$i];
            $subtitle = $mango_settings['mango_header_box_subtitle_'.$i];
            $icon = $mango_settings['mango_header_box_icon_'.$i];
            $bordered = $mango_settings['mango_header_box_icon_bordered_'.$i];
            if($header==8 || $header==11 || $header==13){ ?>
                <div class="header-box clearfix">
                    <div class="header-box-icon<?php echo ($header==11)?" round":"" ?><?php echo ($bordered)?" border":''; ?>">
                        <i class="<?php echo esc_attr($icon) ?>"></i>
                    </div>
                    <div class="header-box-content">
                        <?php if($title){?><h6><?php echo esc_attr($title) ?></h6><?php } ?>
                        <p><?php echo esc_attr($subtitle) ?></p>
                    </div>
                </div>
            <?php }elseif($header ==16){ ?>
                 <div class="nav-text pull-right hidden-sm hidden-xs">
                        <i class="<?php echo esc_attr($icon) ?>"></i><span><?php echo esc_attr($title) ?></span> <?php echo esc_attr($subtitle) ?>
                    </div>
            <?php }
        }
    }
}
function mango_load_wrapper(){
    global $mango_settings;
    $headers = array(12,18,19,20,21);
    $current_header =  mango_current_header();
    if(in_array($current_header, $headers)){
        return false;
    }else{
        return true;
    }
}
function mango_load_footer(){
    global $mango_settings;
    $headers = array(12,16,18,19,20,21);
    $current_header = mango_current_header();
    $show_footer = true;
    if($show_footer) {
        if ( in_array ( $current_header, $headers ) ) {
            return false;
        } else {
            return true;
        }
    }else{
        return false;
    }
}
function mango_phone_info(){
    global $mango_settings;
    if($mango_settings['show-phoneinfo']){ ?>
        <span class="nav-text hidden-sm hidden-xs">
            <i class="fa fa-phone"></i>
            <span class="header-text">
                <?php echo htmlspecialchars_decode(esc_textarea($mango_settings['phone_text'])) ?>
            </span>
            <span><?php echo esc_attr($mango_settings['phone_number']) ?></span>
        </span>
 <?php }
}
function mango_current_header(){

	global $post, $mango_settings;
	
	
    $id = mango_current_page_id();
    $header = get_post_meta ( $id, 'mango_page_header', true ) ? get_post_meta ( $id, 'mango_page_header', true ) : $mango_settings["mango_site_header"];
    if(!$header){
        $header = isset($mango_settings["mango_site_header"])?$mango_settings["mango_site_header"]:"1";
    }
    return $header;
	
}
function mango_current_footer(){
   
    global $post, $mango_settings,$current_page;
    
	
	$id = mango_current_page_id();
    $footer = get_post_meta ( $id, 'mango_footer_type', true ) ? get_post_meta ( $id, 'mango_footer_type', true ) : $mango_settings["mango_footer_type"];
    if(!$footer){
        $footer = isset($mango_settings["mango_footer_type"])?$mango_settings["mango_footer_type"]:"1";
    }
	
    return $footer;
 

}
function mango_body_class($classes){
    global $mango_settings;
    $current_header = mango_current_header();
    if(!is_page_template("templates/coming_soon.php")) {
        if ( $current_header == 16 ) {
            $classes[ ] = "fixed-bottom-menu";
        }
    }else{
        $classes[ ] = "fheight";
    }
    return $classes;
}
add_filter('body_class','mango_body_class');
function mango_add_social_share() {
    global $post, $mango_settings;
    $current_page_id  = mango_current_page_id();
    $show = true;
    $show = ( get_post_meta (  $current_page_id, 'mango_page_social_share', true ) ) ? get_post_meta (  $current_page_id, 'mango_page_social_share', true ) : true;
    if($show==='hide'){
        return ;
    }
    if($show===true) {
        if ( isset($mango_settings[ 'mango_social_share' ]) && is_array ( $mango_settings[ 'mango_social_share' ] ) && in_array ( $post->post_type, $mango_settings[ 'mango_social_share' ] )  ) {
            return;
        }
    }
    if ( function_exists ( "wpfai_social" ) && get_option ( 'wpfai' ) != '' && $show) {
            if ( $post->post_type == 'portfolio' ) { ?><li><?php } ?>
            <div class="share-box">
                <span
                    class="share-label"><?php echo htmlspecialchars_decode ( esc_textarea ( $mango_settings[ 'mango_social_share_label' ] ) ); ?></span>

                <div class="social-icons">
                    <?php $content = wpfai_social ();
                    echo str_replace ( "wpfai-link", "social-icon", $content );
                    ?>
                </div>
            </div>
            <?php if ( $post->post_type == 'portfolio' ) { ?></li><?php } ?>
        <?php
    }
}
function change_subscribe_button_text() {
    // return your preferred button text
    return __("sign in",'mango');
}
add_filter('s2_subscribe_button', 'change_subscribe_button_text');
function my_s2_form($form) {
    $form = str_replace('Your email:', __('Email Address','mango'), $form);
    return $form;
}
add_filter('s2_form', 'my_s2_form');
function mango_popup(){
    global $post;
    $page_id = mango_current_page_id();
    $enable = 'off';
    $enable = ( get_post_meta (  $page_id, 'mango_popup_e_d', true ) ) ? get_post_meta (  $page_id, 'mango_popup_e_d', true ) : '';

    if($enable=='on'){
        $title =  ( get_post_meta (  $page_id, 'mango_popup_title', true ) ) ? get_post_meta (  $page_id, 'mango_popup_title', true ) : '';
        $desc  = ( get_post_meta (  $page_id, 'mango_popup_desc', true ) ) ? get_post_meta (  $page_id, 'mango_popup_desc', true ) : '';
        ?>
        <div class="mango_newsletter_popup newsletter-popup mfp-hide" id="newsletter-popup-form">
            <div class="newsletter-popup-content">
				<h2><?php echo  esc_attr($title)?></h2>
                <?php echo do_shortcode(wpautop($desc)); ?>
			</div>    
		</div>
   <?php  }
}
add_action('wp_footer', 'mango_popup');
    // LayerSlider set as Theme to disable notification
add_action('layerslider_ready', 'mango_set_layerslider_as_theme');
    function mango_set_layerslider_as_theme() {
        // Disable auto-updates
        $GLOBALS['lsAutoUpdateBox'] = false;
    }
// RevSlider set as Theme to disable notification
if(function_exists( 'set_revslider_as_theme' )){
    add_action( 'init', 'mango_set_revslider_as_theme' );
    function mango_set_revslider_as_theme() {
        set_revslider_as_theme();
    }
}
add_action( 'vc_before_init', 'mango_set_vc_as_theme' );
function mango_set_vc_as_theme() {
    vc_set_as_theme();
}
//get layer sliders list
/*@todo: remove layer slider
 * function mango_get_layer_sliders(){
    $sliders_array = array();
    if (function_exists("layerslider")){
    $sliders = LS_Sliders::find ( array("data"=>false,'columns'=>'id,name','limit'=>9999999));
        if(!$sliders || !is_array($sliders)){
            return array();
        }
        foreach($sliders as $slider){
            $sliders_array[$slider['id']] = $slider['name'];
        }
    }
    return $sliders_array;
} */
//get revolution sliders list
function mango_get_rev_sliders(){
    $rev_sliders = array ();
    if ( class_exists ( "RevSlider" ) ) {
        $revSlider = new RevSlider();
        $sliders = $revSlider->getArrSliders ();
        if ( $sliders ) {
            foreach ( $sliders as $slider ) {
                /** @var $slider RevSlider */
                $rev_sliders[ $slider->getAlias() ] = $slider->getTitle();
            }
        }
    }
    return $rev_sliders;
}
function mango_main_container_class(){
    global $mango_settings;
    $current_page_id  = mango_current_page_id();
    $container =  get_post_meta ( $current_page_id, 'mango_container_size', true ) ? get_post_meta ( $current_page_id, 'mango_container_size', true ) : '';
    if($container==''){
        $container = $mango_settings['mango_container_size']?$mango_settings['mango_container_size']:"no";
    }
    if($container=='no'){
        return "container ";
    }else{
        return "container-fluid ";
    }
}
function mango_page_banner(){
    global $mango_settings;
    $current_page_id = mango_current_page_id();
    ob_start ();
	
	$banner_type = ( get_post_meta($current_page_id, 'mango_banner_type', true) ) ? get_post_meta($current_page_id, 'mango_banner_type', true) : '';
	
    if(!empty($banner_type)){
	$banner_type = ( get_post_meta($current_page_id, 'mango_banner_type', true) ) ? get_post_meta($current_page_id, 'mango_banner_type', true) : '';
	}else{
		$current_header = mango_current_header();
	if($current_header=='9' ||$current_header=='17'){
		$banner_type='cus_option';
		$mango_settings['header_background_nine17'];
		}
	}
    if($banner_type){
        echo "<div class='mango_banner'>";
        if( $banner_type=='video' ){
            $video_embed = get_post_meta($current_page_id, 'mango_banner_video_embed', true);
            if( $video_embed ) {
               // entry-media
                echo '<div class="embed-responsive embed-responsive-16by9">';
                echo wp_oembed_get ( $video_embed );
                echo '</div>';
            }
        }elseif( $banner_type=='image' ){
            $app_gallery = get_post_meta($current_page_id, 'mango_banner_image', true);
            if( $app_gallery ) {
                $img_src = wp_get_attachment_image_src( $app_gallery, 'full' ) ;
                echo '<img src="'. esc_url($img_src[0]).'" class="img-responsive" alt="">';
            }
        }elseif($banner_type=='rev_slider'){
            if(shortcode_exists('rev_slider') || function_exists('rev_slider')){
                $rev_slider = get_post_meta($current_page_id, 'mango_banner_rev_slider', true);
                if($rev_slider){
                    echo do_shortcode('[rev_slider "'. $rev_slider .'"]');
                }
            }
        }elseif($banner_type='cus_option'){
			if(isset($mango_settings['header_background_nine17']['url'])){
				$mango_image=$mango_settings['header_background_nine17']['url'];
				if($mango_image){
				 echo '<img src="'. esc_url($mango_image).'" class="img-responsive" alt="">';	
				}
			}
		}
		
        echo "</div>";
    }
    echo ob_get_clean();
    //wrap the banner in a div with class mango_banner
}
function mango_taxonomy_banner(){
    if(is_tax(array('product_cat','product_tag','portfolio-category','faq-category')) || is_category() || is_tag()) {
        $tax_id = get_queried_object_id ();
        $tax_data = get_option ( 'tax_meta_' . $tax_id );
        ob_start ();
        $tax_data =  get_option( 'tax_meta_'.$tax_id);
        $banner_type =(isset($tax_data['mango_taxonomy_banner_type']) && $tax_data['mango_taxonomy_banner_type'])?$tax_data['mango_taxonomy_banner_type']:'';
        if($banner_type){
            echo "<div class='mango_banner'>";
            if( $banner_type == 'video' ){
                $video_embed = (isset($tax_data['mango_taxonomy_banner_video']) && $tax_data['mango_taxonomy_banner_video'])?$tax_data['mango_taxonomy_banner_video']:'';
                if( $video_embed ) {
//                    entry-media
                    echo '<div class="embed-responsive embed-responsive-16by9">';
                    echo wp_oembed_get ( $video_embed );
                    echo '</div>';
                }
            }elseif( $banner_type=='image' ){
                $app_gallery = (isset($tax_data['mango_taxonomy_banner_image']) && $tax_data['mango_taxonomy_banner_image'])?$tax_data['mango_taxonomy_banner_image']:'';
                if( $app_gallery ) {
                    $img_src = wp_get_attachment_image_src( $app_gallery['id'], 'full' ) ;
                    echo '<img src="'. esc_url($img_src[0]).'" class="img-responsive" alt="">';

                }
            }elseif($banner_type=='rev_slider'){
                if(shortcode_exists('rev_slider') || function_exists('rev_slider')){
                    $rev_slider = (isset($tax_data['mango_taxonomy_banner_rev_slider']) && $tax_data['mango_taxonomy_banner_rev_slider'])?$tax_data['mango_taxonomy_banner_rev_slider']:'';
                    if($rev_slider && RevSlider::isAliasExists($rev_slider)){
                        echo do_shortcode('[rev_slider "'. $rev_slider .'"]');
                    }
                }
            }elseif($banner_type=='custom_banner'){
                $custom_banner = (isset($tax_data['mango_taxonomy_banner_custom']) && $tax_data['mango_taxonomy_banner_custom'])?$tax_data['mango_taxonomy_banner_custom']:'';
                if($custom_banner){
                    echo do_shortcode( $custom_banner );
                }
            }
            echo "</div>";
        }
        echo ob_get_clean();
        //wrap the banner in a div with class mango_banner
    }
}
?>