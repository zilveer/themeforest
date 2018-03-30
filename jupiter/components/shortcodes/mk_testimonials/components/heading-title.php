<?php if ( !empty( $view_params['title'] ) ) {
	if( $view_params['style'] == 'avantgarde' ) { ?>
			<h3 class="title-line-style <?php echo $view_params['skin']; ?>-version"><span><?php echo $view_params['title']; ?></span></h3>
	<?php } else { 
			mk_get_view('global', 'shortcode-heading', false, ['title' => $view_params['title']]); 
		 }
}