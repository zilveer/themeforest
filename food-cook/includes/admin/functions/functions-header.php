<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*-----------------------------------------------------------------------------------*/
/* Register WP Menus */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu', 'woothemes' ) ) );
	register_nav_menus( array( 'top-menu' => __( 'Top Menu', 'woothemes' ) ) );
}

/*-----------------------------------------------------------------------------------*/
// Adding walker nav menu for mega menu
/*-----------------------------------------------------------------------------------*/

function df_navbar_menu( $data = array() ) {
	$defaults = array(
		'menu_wraper' 		=> '<ul id="%MENU_ID%">%MENU_ITEMS%</ul>',
		'menu_items'		=> '<li class="testing %ITEM_CLASS%"><a href="%ITEM_HREF%" title="%ESC_ITEM_TITLE%">%ITEM_TITLE%</a>%SUBMENU%</li>',
		'submenu' 			=> '<div style="visibility: hidden; display: block;"><ul>%ITEM%</ul><i></i></div>',
		'parent_clicable'	=> true,
		'params'			=> array( 'act_class' => 'act' ),
		'force_fallback'	=> false,
		//'fallback_cb'		=> 'dt_page_menu',
		'fallback_cb'       => 'wp_page_menu',
		'echo'				=> true,
		'location'			=> 'primary-menu'
	);

	$options = wp_parse_args( $data, $defaults );

	$options['menu_wraper'] = str_replace(
		array(
			'%MENU_ID%',
			'%MENU_CLASS%',
			'%MENU_ITEMS%'
		),
		array(
			'%1$s',
			'%2$s',
			'%3$s'
		),
		$options['menu_wraper']
	);

	$options['menu_items'] = explode( '%SUBMENU%', $options['menu_items'] );
	$options['submenu'] = explode( '%ITEM%', $options['submenu'] );

	$options = apply_filters( 'df_navbar_menu_options', $options );

	$theme_location = $options['location'];
	$parent_clicable = apply_filters( 'df_navbar_menu-parent_clicable', $options['parent_clicable'] );

	$args = array(
		'container'				=> false,
		'menu_id'				=> 'mainmenu',
		//'fallback_cb'			=> $options['fallback_cb'],
		'theme_location'		=> $theme_location,
		'parent_clicable'		=> $parent_clicable,
		'menu_class'			=> false,
		'container_class'		=> false,
		'df_has_nav_menu'		=> has_nav_menu( $theme_location ),
		'df_item_wrap_start'	=> $options['menu_items'][0],
		'df_item_wrap_end'		=> $options['menu_items'][1],
		'df_submenu_wrap_start'	=> $options['submenu'][0],
		'df_submenu_wrap_end'	=> $options['submenu'][1],
		'items_wrap'			=> $options['menu_wraper'],
		'please_be_fat'			=> true
	);

	$args = array_merge( $args, $options['params'] );

	if ( $args['df_has_nav_menu'] ) {
		$walker_args = array(
			'theme_location' 	=> $theme_location,
			'parent_clicable' 	=> $parent_clicable
		);

		$args['walker'] = new Df_Walker_Nav_Menu( $walker_args );
	}

	return wp_nav_menu( $args );
}

/*-----------------------------------------------------------------------------------*/
/* Share Meta Images */
/*-----------------------------------------------------------------------------------*/
function woo_share_meta_head() {
	global $post;
  	if (has_post_thumbnail( get_the_ID() ) ):  
  		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
		<!-- Facebook Share Meta -->
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:image" content="<?php echo $image[0]; ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />
	    <!-- Twitter Share Meta -->
	    <meta name="twitter:url"	 content="<?php the_permalink(); ?>">
	    <meta name="twitter:title"	 content="<?php the_title(); ?>">
	    <meta name="twitter:description" content="<?php echo strip_tags(get_the_excerpt()); ?>">
	    <meta name="twitter:image"	 content="<?php echo $image[0]; ?>">
	<?php endif;
}
add_action('wp_head', 'woo_share_meta_head');

/*-----------------------------------------------------------------------------------*/
/* Optional Top Navigation (WP Menus)  */
/*-----------------------------------------------------------------------------------*/
add_action('woo_top', 'woo_devices_action', 10  );

if ( ! function_exists( 'woo_devices_action' ) ) :
function woo_devices_action() { 
       	$detect = new Mobile_Detect();
       	$sidr_menu ='
      	<script>
            jQuery(function($){      
	      		$("#responsive-menu-button").sidr({
	      			name: "mobile-nav",
	     		 	source: "#mobile-top-nav"
		  	  	});
			});
		</script>';
	if ($detect->isMobile() || $detect->isTablet()) {
		echo $sidr_menu;
		woo_mobile_navigation();
	} else {
		woo_top_navigation();
	}	
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Top Navigation  */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_top_navigation' ) ) :
	function woo_top_navigation() {

	global $woo_options, $woocommerce;
	$df_options = get_theme_mod( 'df_options' );	
		
		if ( isset($woo_options['woo_check_topbar']) && $woo_options['woo_check_topbar'] == "true") : ?>
			<div id="top">
				<div class="col-full">
					
					<div class="fl">
						<?php if (isset($woo_options['woo_social_top']) && $woo_options['woo_social_top'] == 'true') :?>
					  	<div class="social-top">
					  		<?php if ( isset($df_options['connect_rss' ]) && $df_options['connect_rss' ] == "true" ) { ?>
							<a href="<?php if ( $woo_options['woo_feed_url'] ) { echo esc_url( $woo_options['woo_feed_url'] ); } else { echo get_bloginfo_rss('rss2_url'); } ?>" class="fa fa-rss" title=""></a>
							<?php } ?>

							<?php if ( isset($df_options['connect_linkedin' ]) && $df_options['connect_linkedin' ] != "" ) { ?>
							<a href="<?php echo esc_url( $df_options['connect_linkedin'] ); ?>" class="fa fa-linkedin" title="linkedin"></a>
							<?php } ?>

							<?php if ( isset($df_options['connect_pinterest' ]) && $df_options['connect_pinterest' ] != "" ) { ?>
							<a href="<?php echo esc_url( $df_options['connect_pinterest'] ); ?>" class="fa fa-pinterest" title="pinterest"></a>
							<?php } ?>

							<?php if ( isset($df_options['connect_twitter' ]) && $df_options['connect_twitter' ] != "" ) { ?>
							<a href="<?php echo esc_url( $df_options['connect_twitter'] ); ?>" class="fa fa-twitter" title="twitter"></a>
							<?php } ?>

							<?php if ( isset($df_options['connect_facebook' ]) && $df_options['connect_facebook' ] != "" ) { ?>
							<a href="<?php echo esc_url( $df_options['connect_facebook'] ); ?>" class="fa fa-facebook" title="facebook"></a>
							<?php } ?>

							<?php if ( isset($df_options['connect_youtube' ]) && $df_options['connect_youtube' ] != "" ) { ?>
							<a href="<?php echo esc_url( $df_options['connect_youtube'] ); ?>" class="fa fa-youtube" title="youtube"></a>
							<?php } ?>

							<?php if ( isset($df_options['connect_flickr' ]) && $df_options['connect_flickr' ] != "" ) { ?>
							<a href="<?php echo esc_url( $df_options['connect_flickr'] ); ?>" class="fa fa-flickr" title="flickr"></a>
							<?php } ?>

							<?php if ( isset($df_options['connect_googleplus' ]) && $df_options['connect_googleplus' ] != "" ) { ?>
							<a href="<?php echo esc_url( $df_options['connect_googleplus'] ); ?>" class="fa fa-google-plus" title="google plus"></a>
							<?php } ?>

							<?php if ( isset($df_options['connect_instagram' ]) && $df_options['connect_instagram' ] != "" ) { ?>
							<a href="<?php echo esc_url( $df_options['connect_instagram'] ); ?>" class="fa fa-instagram" title="instagram"></a>
							<?php } ?>
						</div>
					<?php endif; ?>

			 <?php if (isset($df_options['check_callus']) && $df_options['check_callus'] == 'true')  {   ?>
					<?php if(isset($df_options['text_callus']) && $df_options['text_callus'] != '') : ?>
							<div class="callus"><?php echo stripslashes($df_options['text_callus']); ?></div>
					<?php endif; ?>
			 <?php } ?>

			 <?php if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'top-menu' ) ) {
					 wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) ); } ?>
						<div class="clear"></div>
					</div>

					<div class="fr">
				        <?php if ( is_woocommerce_activated() && isset( $woo_options['woocommerce_header_user_link'] ) && 'true' == $woo_options['woocommerce_header_user_link'] ) {
			       				freschi_user();
			       			} ?>

						<?php if ( is_woocommerce_activated() && isset( $woo_options['woocommerce_header_cart_link'] ) && 'true' == $woo_options['woocommerce_header_cart_link'] ) {
			       				freschi_mini_cart();
			       			} ?>
		 
						<span class="fa fa-search df-ajax-search"></span>

					</div>
				</div>
			</div><!-- /#top -->
		<?php endif;  
		
	} // End woo_top_navigation()
endif;

/*-----------------------------------------------------------------------------------*/
/* Mobile Navigation  */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_mobile_navigation' ) ) :
	function woo_mobile_navigation() { 

		global $woocommerce, $woo_options;
		
		if ( isset($woo_options['woo_check_topbar']) && $woo_options['woo_check_topbar'] == "true") : ?>
		
			<div id="top">
				<div class="col-full">
					<div class="fr">
						<span class="fa fa-search df-ajax-search"></span>
					</div>
				</div>
			</div><!-- /#top -->
			<div id="mobile-header">
				<div class="col-full">
					<ul>
			            <?php if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'top-menu' ) ) : ?>

							<li class="col-1">
								<a id="responsive-menu-button"  href="#mobile-nav"><i class="fa fa-th-large"></i></a>
							</li>
				            <div id="mobile-top-nav">
								<?php  wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) );  ?>			
							</div>

			           	<?php endif; ?>
				
						<?php if ( is_woocommerce_activated() && isset( $woo_options['woocommerce_header_user_link'] ) && 'true' == $woo_options['woocommerce_header_user_link'] ) {

							freschi_user_mobile();

				       	} 

				       	if ( is_woocommerce_activated() && isset( $woo_options['woocommerce_header_cart_link'] ) && 'true' == $woo_options['woocommerce_header_cart_link'] ) {?>
				       		
				       		<li class="col-3"><a class="fa fa-shopping-cart" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'woothemes' ); ?>"></a><sup class="mobile-cart-count"><?php echo WC()->cart->cart_contents_count; ?></sup></li> 

				       	<?php } ?>
						
					</ul>
				</div>
			</div>
		<?php endif; 
	}
endif;

/*-----------------------------------------------------------------------------------*/
/* Navigation */
/*-----------------------------------------------------------------------------------*/
add_action( 'woo_header_after','woo_nav', 10 );							

if ( ! function_exists( 'woo_nav' ) ) {
function woo_nav() { 
	global $woo_options;
	woo_nav_before();
?>
<div id="navigation" >
	<div class="col-full">
	<?php woo_nav_inside(); ?>
	<?php
	if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
        df_navbar_menu( array(
            'menu_wraper'       => '<ul id="main-nav" class="nav">%MENU_ITEMS%' . "\n" . '</ul>',
            'menu_items'        =>  "\n" . '<li class="%ITEM_CLASS%"><a href="%ITEM_HREF%"%ESC_ITEM_TITLE%>%ICON%<span>%ITEM_TITLE%%SPAN_DESCRIPTION%</span></a>%SUBMENU%</li> ',
            'submenu'           => '<ul class="sub-nav">%ITEM%</ul>',
            'params'            => array( 'act_class' => 'act', 'please_be_mega_menu' => true ),
        ) ); 
	} else {
	?>
	<ul id="main-nav" class="nav">
		<?php 
		if ( get_option( 'woo_custom_nav_menu' ) == 'true' ) {
			if ( function_exists( 'woo_custom_navigation_output' ) ) { woo_custom_navigation_output( 'name=Woo Menu 1' ); }
		} else { ?>
			
			<?php if ( is_page() ) { $highlight = 'page_item'; } else { $highlight = 'page_item current_page_item'; } ?>
			<!-- <li class="<?php // echo esc_attr( $highlight ); ?>"><a href="<?php // echo esc_url( home_url( '/' ) ); ?>"><?php // _e( 'Home', 'woothemes' ); ?></a></li> -->
			<?php wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' ); ?>
		<?php } ?>
	</ul><!-- /#nav -->
	<?php } ?>
	</div>	
</div><!-- /#navigation -->
<?php
	woo_nav_after();
} // End woo_nav()
}

/*-----------------------------------------------------------------------------------*/
/* Ajax search header */
/*-----------------------------------------------------------------------------------*/

add_action('wp_head','df_ajax_custom_head');
function df_ajax_custom_head()
{
    echo '<script type="text/javascript">var ajaxurl = \''.admin_url('admin-ajax.php').'\';</script>';
}

add_action('wp_ajax_ajax_search', 'ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');
 
function ajax_search(){

global $post;

$s = $_POST['s'];

    $args = array(
        's' => $s,
        'showposts' => -1,
        'post_status' => 'publish',
        'suppress_filters' => 0,
    );
 

    $query = new WP_Query($args);
    if($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post(); ?>

        <?php 
            $post_type = get_post_type( $post->ID );
        ?>
             <div id="result-<?php echo $post->ID; ?>" class="ajax-search-result animated fadeIn">
                <?php  
                 if ( has_post_thumbnail()){ ?>
                    <div class='df-search-image'>
                        <a class="image_thum_post" href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>" >
                           <?php  the_post_thumbnail('dahz-small-thumb'); ?>    
                        </a>
                    </div>
                <?php } else {  

                $url_src = esc_url(get_template_directory_uri() . '/includes/assets/images/search.jpg');
                echo "<div class='df-search-image'>";
                echo '<a href="' . esc_url(get_permalink(get_the_ID())) . '" rel="bookmark" title="">';
                echo '<img src="' . $url_src . '" class="" alt="">';
                echo "</a>";
                echo "</div>";


                 } ?>
                <div class="df-search-content">
                   <h3><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>  
                    <div class="post-meta">	
						<span class="small" itemprop="datePublished"><?php _e( 'on ', 'woothemes' ); ?></span> 
						<?php echo do_shortcode( '[post_date after=" |"]' ); ?>	
						<span class="small"><?php _e( 'By', 'woothemes' ); ?> </span> 
						<?php echo do_shortcode( '[post_author_posts_link after=" | "]' ).do_shortcode( '[post_comments]' ); ?>
					</div>           
                </div>            
            </div>
            <div class="clear"></div>

    <?php endwhile;
    else : 
    ?>

    <div id="result-not-found animated fadeIn">
        <h1> <?php _e('Nothing Found','dahztheme'); ?> </h1>
        <p><?php _e('Sorry, but nothing matched your search terms. Please try again some different keyword','dahztheme'); ?></p>
    </div>

    <?php
    endif;
    die();
}

/* ----------------------------------------------------------------------------------- */
/* Ajax search frontend                                                                */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_ajax_search_front')):
    function df_ajax_search_front() {
        ?>
	  <div class="universe-search">
	    <div class="universe-search-close ent-text"></div>
	    <div class="search-container-close"></div>
	    <div class="df_container-fluid fluid-max col-full">
	      <div class="universe-search-form">
	          <?php if (is_rtl()) : ?>
	          <input type="text" id="searchfrm" name="search" class="universe-search-input" placeholder="<?php esc_attr_e('Type and press enter to search', 'woothemes'); ?>" value="" autocomplete="off" spellcheck="false" dir="rtl">
	          <?php else : ?>
	          <input type="text" id="searchfrm" name="search" class="universe-search-input" placeholder="<?php esc_attr_e('Type and press enter to search', 'woothemes'); ?>" value="" autocomplete="off" spellcheck="false" dir="ltr">
	          <?php endif; ?>
	      </div><!-- end universe search form -->
	      <div class="universe-search-results">
	          <div class="search-results-scroller">
	              <div class="nano-content">
	              </div>
	          </div>
	      </div>
	    </div><!-- end df-container-fluid -->
	  </div><!-- end universe search -->
        <?php 
    }
 
endif;

