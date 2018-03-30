<?php

if ( ! is_page_template( 'page-modules.php' ) ):

?>
<div class="posts-box posts-box-not-found mas-item">

	<?php
	if ( isset( $barcelona_mod_header ) ) {
		echo $barcelona_mod_header;
	}
	?>

	<div class="nf-wrapper">
		<span class="nf-title"><?php esc_html_e( 'Nothing Found', 'barcelona' ); ?></span>
		<span class="nf-desc">
		<?php
			if ( is_search() ) {
				esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'barcelona' );
			} else {
				esc_html_e( 'Sorry, It seems there is no posts to show.', 'barcelona' );
			}
		?>
		</span>
	</div>

</div>
<?php

endif;