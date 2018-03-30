<?php
add_action( 'widgets_init', 'tie_search_widget' );
function tie_search_widget() {
	register_widget( 'tie_search' );
}
class tie_search extends WP_Widget {
	function tie_search() {
		$widget_ops 	= array( 'classname' => 'search'  );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'search-widget' );
		parent::__construct( 'search-widget', THEME_NAME .' - '.__( 'Search' , 'tie') , $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) { global $is_IE; ?>
		<div class="search-block-large widget">
			<form method="get" action="<?php echo home_url(); ?>/">
				<button class="search-button" type="submit" value="<?php if( !$is_IE ) _eti( 'Search' , 'tie' ) ?>"><i class="fa fa-search"></i></button>	
				<input type="text" id="s" name="s" value="<?php _eti( 'Search' ) ?>" onfocus="if (this.value == '<?php _eti( 'Search' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _eti( 'Search' ) ?>';}"  />
			</form>
		</div><!-- .search-block /-->		
<?php
	}
}
?>