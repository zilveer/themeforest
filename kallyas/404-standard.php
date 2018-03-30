<?php if(! defined('ABSPATH')){ return; }

wp_enqueue_style( 'page404-css', THEME_BASE_URI . '/css/pages/page404.css', array('kallyas-styles'), ZN_FW_VERSION );

get_header();

	$headerClass = zget_option( '404_header_style', 'zn_404_options', false, 'zn_def_header_style' );
	if( $headerClass != 'zn_def_header_style' ) {
		$headerClass = 'uh_'.$headerClass;
	}


	WpkPageHelper::zn_get_subheader( array( 'headerClass' => $headerClass, 'def_header_bread' => false, 'def_header_date' => false, 'def_header_title' => false ) );
?>
	<div class="error404-page">

		<section id="content" class="site-content" >
			<div class="container">

				<div id="mainbody">

					<div class="row">
						<div class="col-sm-12">

							<div class="error404-content">
								<h2 class="error404-content-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><span>404</span></h2>
								<h3 class="error404-content-msg"><?php echo __("The page cannot be found.",'zn_framework');?></h3>
							</div>

						</div>

						<div class="col-sm-12">
							<div class="search gensearch__wrapper kl-gensearch--<?php echo zget_option( 'zn_main_style', 'color_options', false, 'light' ); ?>">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div><!-- end row -->

				</div><!-- end mainbody -->

			</div><!-- end container -->
		</section><!-- end #content -->
	</div>

<?php get_footer(); ?>
</div>