<?php
/************************************************************************
* Main Index File
*************************************************************************/

/* Load Header */
get_header();

global $wbc907_data;

$wbc907_page_template = ( isset( $wbc907_data['opts-default-layout'] ) ) ? esc_html( $wbc907_data['opts-default-layout'] ) : 'default';
?>

		<!-- BEGIN MAIN -->

	    <div class="main-content-area clearfix">

	    	<div class="container">

					<div class="row">

						<?php get_template_part( 'assets/php/misc/index-template' , $wbc907_page_template ); ?>

					</div><!-- ./row -->

				</div><!-- ./container -->

	    <!-- END Main -->
		</div>


<?php
/* Load Footer */
get_footer();
?>
