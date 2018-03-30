<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
	<?php global $smof_data; ?>
	<?php if(isset($smof_data['custom_css'])){ echo '<style>'.$smof_data["custom_css"].'</style>'; } ?>
	<?php require_once ( get_template_directory() . '/framework/includes/dynamic_css.php' ); ?>
	<?php wp_head(); ?>
</head>
<?php
global $smof_data, $post;
/* post ID */
$c_pageID = null;
if($post){
    $c_pageID = $post->ID;
}
/* body class */
$body_class = '';
$wrapper_class = '';
if(is_page_template('blank.php')):
    $body_class .= ' csbody body_blank';
    $wrapper_class = ' class="wrapper_blank"';
endif;
/* header setting */
global $header_setings;
$header_setings = cshero_generetor_header_setting();
$body_class .= ' '.$header_setings->body_class;
$bg = $data_parallax = '';
if(is_page()){
    if(get_post_meta($c_pageID, 'cs_bg_image', true)){
        $smof_data['bg_image'] = get_post_meta($c_pageID, 'cs_bg_image', true);
    }
	if(get_post_meta($c_pageID, 'cs_body_custom_class', true)){
		$body_class .= ' '.get_post_meta($c_pageID, 'cs_body_custom_class', true);
	}
	if(get_post_meta($c_pageID, 'cs_page_title', true) == 'custom' && get_post_meta($c_pageID, 'cs_page_title_bg', true)){
	    $bg = get_post_meta($c_pageID, 'cs_page_title_bg', true);
	} else {
	    $bg = $smof_data['page_title_bg'];
	}
} else {
    $bg = $smof_data['page_title_bg'];
}
if($bg){
    $data_parallax = " data-stellar-background-ratio='0.6' data-background-height='' data-background-width=''";
}
/* boxed layout */
if($smof_data['layout'] == 'Boxed'){
    $body_class .= ' boxed';
}
/* site id */
$csSite = getCSSite();
$hidden_class='';
if(isset($smof_data['enable_hidden_sidebar']) && $smof_data['enable_hidden_sidebar']){
	$hidden_class = 'meny-'.$smof_data['hidden_sidebar_position'];
}
?>

<body <?php body_class($body_class.' '.$hidden_class); ?>>
    <?php if( $smof_data['page_loader'] == '1'):?>
    <div id="cs_loader" style="height:100vh;width:100vw;background-color:#FFF"></div>
    <?php endif;?>
	<div id="wrapper"<?php if( $smof_data['page_loader'] == '1'):?> class="cs_hidden"<?php endif;?>>
		<div class="header-wrapper">
    		<?php cshero_header(); ?>
		</div>
		    <?php global $pagetitle; $pagetitle = cshero_show_page_title(); ?>
			<?php if($pagetitle == '1'): ?>
			<div class="cs-content-header">
			<div id="cs-page-title-wrapper" class="cs-page-title stripe-parallax-bg<?php if(get_post_meta($c_pageID, 'cs_page_title', true) == 'custom'){ echo " page-title-style"; } ?><?php if((!is_page() && $smof_data['page_title_bg']) || get_post_meta($c_pageID, 'cs_page_title_bg', true)){ echo " cs_page_title_image"; } ?> <?php echo esc_attr(get_post_meta($c_pageID, 'cs_page_title_class', true)); ?>" <?php if(get_post_meta($c_pageID, 'cs_page_title_bg_parallax', true) == 'yes'){ echo $data_parallax; } ?>>
				<div class="container">
					<div class="row">
					    <?php
                		$title_aling = 'left';
                		$col_title = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
                		$col_breadcrumb = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
                		if(get_post_meta($c_pageID, 'cs_title_bar_align', true) && get_post_meta($c_pageID, 'cs_page_title', true) == 'custom'){
							$title_aling = get_post_meta($c_pageID, 'cs_title_bar_align', true);
						} else {
							$title_aling = $smof_data['page_title_bar_align'];
						}
						switch ($title_aling) {
						    case 'center':
						        $col_title = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
						        $col_breadcrumb = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
						      break;
						    default:
						        $col_title = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
						        $col_breadcrumb = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
						      break;
						}
                        ?>
                        <div class="<?php echo $col_title; ?>">
                        	<div class="title_bar_<?php echo esc_attr($title_aling); ?>">
                        	<?php
                        		$title_bar_tag = 'h2';
                        		if(get_post_meta($c_pageID, 'cs_title_bar_tag', true)){
									$title_bar_tag = get_post_meta($c_pageID, 'cs_title_bar_tag', true);
								}
                        	?>
                        	<!-- animate option -->
                        	<?php
                        	$page_title_animation = '0';
                        	   if(is_page()){
                        	       $page_title_animation = $smof_data['page_page_title_animation'];
                        	   } elseif (is_single()){
                        	       $page_title_animation = $smof_data['post_page_title_animation'];
                        	   } elseif (is_archive()){
                        	       $page_title_animation = $smof_data['archive_page_title_animation'];
                        	   } elseif (is_search()){
                        	       $page_title_animation = $smof_data['search_page_title_animation'];
                        	   } elseif (is_404()){
                        	       $page_title_animation = $smof_data['404_page_title_animation'];
                        	   }
                        	?>
                        	<div id="<?php if($page_title_animation == '1'){echo "title-animate";}?>">
	                            <h1 class="page-title">
	                                <?php
	                                if (is_page() && get_post_meta($c_pageID, 'cs_page_title_custom_text', true) != ""){
									    echo esc_attr(get_post_meta($c_pageID, 'cs_page_title_custom_text', true));
									} else {
										if (!is_archive()){
										    if(is_search()){
										        printf( esc_html__( 'Search Results for: %s', 'wp_nuvo' ), '<span>' . get_search_query() . '</span>' );
										    } elseif (is_404()){
										        esc_html_e( '404', 'wp_nuvo');
										    } else {
										        the_title();
										    }
										} else {
											if ( is_category() ) :
											single_cat_title();
											elseif ( is_tag() ) :
											single_tag_title();
											elseif ( is_author() ) :
											printf( esc_html__( 'Author: %s', 'wp_nuvo' ), '<span class="vcard">' . get_the_author() . '</span>' );
											elseif ( is_day() ) :
											printf( esc_html__( 'Day: %s', 'wp_nuvo' ), '<span>' . get_the_date() . '</span>' );
											elseif ( is_month() ) :
											printf( esc_html__( 'Month: %s', 'wp_nuvo' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'wp_nuvo' ) ) . '</span>' );
											elseif ( is_year() ) :
											printf( esc_html__( 'Year: %s', 'wp_nuvo' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'wp_nuvo' ) ) . '</span>' );
											elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
											_e( 'Asides', 'wp_nuvo' );
											elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
											_e( 'Galleries', 'wp_nuvo');
											elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
											_e( 'Images', 'wp_nuvo');
											elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
											_e( 'Videos', 'wp_nuvo' );
											elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
											_e( 'Quotes', 'wp_nuvo' );
											elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
											_e( 'Links', 'wp_nuvo' );
											elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
											_e( 'Statuses', 'wp_nuvo' );
											elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
											_e( 'Audios', 'wp_nuvo' );
											elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
											_e( 'Chats', 'wp_nuvo' );
											else :
												if(!class_exists("WooCommerce")){
													_e( 'Archives', 'wp_nuvo' );
												}
												else{
													woocommerce_page_title();
												}
											endif;
										}
									}
	                                ?>
	                            </h1>
	                            <?php if(is_page() && get_post_meta($c_pageID, 'cs_page_title_custom_subheader_text', true) != ""): ?>
	                            <div class="sub_header_text" style="color: <?php echo get_post_meta($c_pageID, 'cs_page_title_custom_subheader_text_color', true); ?>">
	                            	<?php echo esc_attr(get_post_meta($c_pageID, 'cs_page_title_custom_subheader_text', true)); ?>
	                            </div>
                            <?php endif; ?>
                            </div>
                            </div>
                        </div>
                        <?php
                		$breadcrumb = cshero_show_breadcrumb();
                		?>
                		<?php if ($breadcrumb == '1'): ?>
                		<div class="<?php echo $col_breadcrumb; ?>">
                    		<div id="cs-breadcrumb-wrapper" <?php if($smof_data['breadcrumb_mobile'] != '1'){ echo 'class="hidden-xs"'; } ?>>
        			        	<div class="cs-breadcrumbs <?php if(is_page() && get_post_meta($c_pageID, 'cs_breadcrumb_text_align', true)){ echo get_post_meta($c_pageID, 'cs_breadcrumb_text_align', true); } else { echo esc_attr($smof_data['breadcrumb_text_align']);} ?>">
        						<?php
        						if(is_page() && get_post_meta($c_pageID, 'cs_breadcrumb_text', true)){
        						   echo esc_attr(get_post_meta($c_pageID, 'cs_breadcrumb_text', true));
        						} else {
        						   cshero_breadcrumb();
        						}
        						?>
        			            </div>
                    		</div>
                		</div>
                		<?php endif; ?>
					</div>
				</div>
			</div>
			</div>
		<?php endif; ?>
