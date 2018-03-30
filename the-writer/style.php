<?php header('Content-type: text/css');
global $post, $customizer_options;
if(get_option("ocmx_ignore_colours") != "yes"):
	foreach( $customizer_options as $section ){
		foreach ( $section[ 'elements' ] as $element ) { ?>
			<?php if( '' != get_option( $element[ 'slug' ] ) ) { ?>
				<?php echo $element['selectors']; ?> {<?php echo $element['css']; ?>: <?php echo get_option( $element[ 'slug' ] ); ?> }
		<?php } // if get_option( element-slug ) != ''
		} // foreach $section[ 'elements' ]
	} // foreach $customizer_options;
endif;

// Load header background
if(get_header_image() != "") : ?>
	#title-container{background: url(<?php header_image(); ?>) no-repeat top center;}
<?php endif;

if(get_option("ocmx_custom_css") != ""): ?>
	<?php echo get_option("ocmx_custom_css"); ?>
<?php endif;