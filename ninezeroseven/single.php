<?php
/************************************************************************
* Single File
*************************************************************************/

/* Load Header */
get_header();

global $wbc907_data;

$wbc907_page_template = ( isset( $wbc907_data['opts-blog-layout'] ) ) ? esc_html( $wbc907_data['opts-blog-layout'] ) : 'default';
?>

		<!-- BEGIN MAIN -->

	    <div class="main-content-area clearfix">

	    	<?php get_template_part( 'assets/php/post-templates/single-template' , $wbc907_page_template ); ?>

	    <!-- END Main -->
		</div>


<?php
/* Load Footer */
get_footer();
?>
