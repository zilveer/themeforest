<?php
## widget_tabs
add_action( 'widgets_init', 'tie_widget_tabs_box' );
function tie_widget_tabs_box(){
	register_widget( 'tie_widget_tabs' );
}
class tie_widget_tabs extends WP_Widget {
	function tie_widget_tabs() {
		$widget_ops = array( 'description' => 'Most Popular, Recent, Comments, Tags'  );
		parent::__construct( 'widget_tabs', THEME_NAME .' - '.__( 'Tabs' , 'tie') , $widget_ops );
	}
	function widget( $args, $instance ) {

		if( !empty( $instance['posts_order'] ) )
			$posts_order = $instance['posts_order'];
		
		if( empty($instance['posts_number']) || $instance['posts_number'] == ' ' || !is_numeric($instance['posts_number']))	$posts_number = 5;
		else $posts_number = $instance['posts_number'];
	?>
	<div class="widget" id="tabbed-widget">
		<div class="widget-container">
			<div class="widget-top">
				<ul class="tabs posts-taps">
				<?php
					$tabs_order = 'r,p,c,t';
					if( !empty( $instance['tabs_order'] ) ){
						$tabs_order = $instance['tabs_order'];
					}
					$tabs_order_array = explode( ',' , $tabs_order );
					foreach ( $tabs_order_array as $tab ){
			
						if( $tab == 'p' )
							echo '<li class="tabs"><a href="#tab1">'. __ti( 'Popular' ) .'</a></li>';	
							
						if( $tab == 'r' )
							echo '<li class="tabs"><a href="#tab2">'. __ti( 'Recent' ) .'</a></li>';	
							
						if( $tab == 'c' )
							echo '<li class="tabs"><a href="#tab3">'. __ti( 'Comments' ) .'</a></li>';	
							
						if( $tab == 't' )
							echo '<li class="tabs"><a href="#tab4">'. __ti( 'Tags' ) .'</a></li>';
					}
				?>
				</ul>
			</div>
			
			<?php
		foreach ( $tabs_order_array as $tab ){
			
			if( $tab == 'p' ) : ?>
			<div id="tab1" class="tabs-wrap">
				<ul>
					<?php 
						if( !empty($posts_order) && $posts_order == 'viewed' ) tie_most_viewed( $posts_number  );
						else tie_popular_posts( $posts_number  );
					?>	
				</ul>
			</div>
			<?php endif;
			
			if( $tab == 'r' ) : ?>
			<div id="tab2" class="tabs-wrap">
				<ul>
					<?php tie_last_posts( $posts_number )?>	
				</ul>
			</div>
			<?php endif; 
			
			if( $tab == 'c' ) : ?>
			<div id="tab3" class="tabs-wrap">
				<ul>
					<?php tie_most_commented( $posts_number );?>
				</ul>
			</div>
			<?php endif;
			
			if( $tab == 't' ) : ?>
			<div id="tab4" class="tabs-wrap tagcloud">
				<?php wp_tag_cloud( $args = array('largest' => 8,'number' => 25,'orderby'=> 'count', 'order' => 'DESC' )); ?>
			</div>
			<?php
			endif;
		}
			?>

		</div>
	</div><!-- .widget /-->
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance 					= $old_instance;
		$instance['posts_number'] 	= strip_tags( $new_instance['posts_number'] );
		$instance['posts_order'] 	= strip_tags( $new_instance['posts_order'] );
		$instance['tabs_order'] 	= strip_tags( $new_instance['tabs_order'] );
		return $instance;
	}

	function form( $instance ) {
		$tie_random_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

		$id = explode("-", $this->get_field_id("widget_id"));
		$widget_id =  $id[1]. "-"  .$tie_random_id;

		$defaults = array( 'posts_order' => 'popular', 'posts_number' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {

					jQuery( "#<?php echo $widget_id ?>-order" ).sortable({
						placeholder: "ui-state-highlight",
						stop: function(event, ui) {
							var data = "";

							jQuery( "#<?php echo $widget_id ?>-order li" ).each(function(i, el){
								var p = jQuery( this ).data( 'tab' );
								data += p+",";
							});

							jQuery("#<?php echo $widget_id ?>-tabs-order").val(data.slice(0, -1));
						}
					});
					
			});
		</script>
		
		<div id="<?php echo $widget_id ?>-tabs">
			<p>
				<label for="<?php echo $this->get_field_id( 'tabs_order' ); ?>"><?php _e( 'Order of tabs:' , 'tie') ?></label>
				<?php if( $id[2] == '__i__' ) echo '<p style="background-color: #fefbed;padding: 5px;color: #9F6000;border: 1px solid #f1e7bc;" class"tie_message_hint">'. __( "click Save button to be able to change the order of tabs ." , "tie").'</p>'?>
				
				<input id="<?php echo $widget_id ?>-tabs-order" name="<?php echo $this->get_field_name( 'tabs_order' ); ?>" value="<?php if( !empty($instance['tabs_order']) ) echo $instance['tabs_order']; ?>" type="hidden" />

				<ul id="<?php echo $widget_id ?>-order" class="tab_sortable" <?php if( $id[2] == '__i__' ) echo 'style="opacity:.5;"'?>>
				<?php
					$tabs_order = 'r,p,c,t';
					if( !empty( $instance['tabs_order'] ) ){
						$tabs_order = $instance['tabs_order'];
					}
					$tabs_order_array = explode( ',' , $tabs_order );
					foreach ( $tabs_order_array as $tab ){
			
						if( $tab == 'p' )
							echo '<li data-tab="p"> '. __ti( "Popular" ) .' </li>';	
							
						if( $tab == 'r' )
							echo '<li data-tab="r"> '. __ti( "Recent" ) .' </li>';	
							
						if( $tab == 'c' )
							echo '<li data-tab="c"> '. __ti( "Comments" ) .' </li>';	
							
						if( $tab == 't' )
							echo '<li data-tab="t"> '. __ti( "Tags" ) .' </li>';
					}
				?>
				</ul>
			</p>	
		</div>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_number' ); ?>"><?php _e( 'Number of items to show :' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" value="<?php if( !empty($instance['posts_number']) ) echo $instance['posts_number']; ?>" size="3" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_order' ); ?>"><?php _e( 'Popular order :' , 'tie') ?></label>
			<select id="<?php echo $this->get_field_id( 'posts_order' ); ?>" name="<?php echo $this->get_field_name( 'posts_order' ); ?>" >
				<option value="popular" <?php if( $instance['posts_order'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Most Commented' , 'tie') ?></option>
				<option value="viewed" <?php if( $instance['posts_order'] == 'viewed' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Most Viewed' , 'tie') ?></option>
			</select>
		</p>

	<?php
	}
}
?>
