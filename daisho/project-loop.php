<?php
$portfolio_page = get_option('flow_portfolio_page'); // empty on none
$is_default_template = false;

if ( is_page_template( 'template-portfolio.php' ) ) {
	$exclude_include = get_post_meta(get_queried_object_id(), 'page_portfolio_tax_query_operator', true); // Operator for exclude box, false = exlude, true = include
	$flow_portfolio_home_exclude = get_post_meta(get_queried_object_id(), 'page_portfolio_exclude', true); // Array of portfolio categories slugs
	$orderby = get_post_meta(get_queried_object_id(), 'page_portfolio_orderby', true);
	$order = get_post_meta(get_queried_object_id(), 'page_portfolio_order', true);
	$shuffle_button = get_post_meta(get_queried_object_id(), 'page_portfolio_shuffle', true);
	$loop_through = get_post_meta(get_queried_object_id(), 'page_portfolio_loop_through', true);
	$boundary_arrows = get_post_meta(get_queried_object_id(), 'page_portfolio_boundary_arrows', true);
	$is_default_template = false;
} else if( is_singular( 'portfolio' ) && ( $parent_page = get_post_meta( $post->ID, 'portfolio_back_button', true ) ) && ! empty( $parent_page ) && ( $parent_page != 'none' ) ) { // we assume that parent page is portfolio
	$exclude_include = get_post_meta($parent_page, 'page_portfolio_tax_query_operator', true);
	$flow_portfolio_home_exclude = get_post_meta($parent_page, 'page_portfolio_exclude', true);
	$orderby = get_post_meta($parent_page, 'page_portfolio_orderby', true);
	$order = get_post_meta($parent_page, 'page_portfolio_order', true);
	$shuffle_button = get_post_meta($parent_page, 'page_portfolio_shuffle', true);
	$loop_through = get_post_meta($parent_page, 'page_portfolio_loop_through', true);
	$boundary_arrows = get_post_meta($parent_page, 'page_portfolio_boundary_arrows', true);
	if( get_page_template_slug( $parent_page ) != 'template-portfolio.php' ){
		$is_default_template = true;
	}
} else if( is_singular( 'portfolio' ) && ! empty( $portfolio_page ) ) { // load main portfolio page if no parent page is set for this item
	$exclude_include = get_post_meta($portfolio_page, 'page_portfolio_tax_query_operator', true);
	$flow_portfolio_home_exclude = get_post_meta($portfolio_page, 'page_portfolio_exclude', true);
	$orderby = get_post_meta($portfolio_page, 'page_portfolio_orderby', true);
	$order = get_post_meta($portfolio_page, 'page_portfolio_order', true);
	$shuffle_button = get_post_meta($portfolio_page, 'page_portfolio_shuffle', true);
	$loop_through = get_post_meta($portfolio_page, 'page_portfolio_loop_through', true);
	$boundary_arrows = get_post_meta($portfolio_page, 'page_portfolio_boundary_arrows', true);
	if( get_page_template_slug( $portfolio_page ) != 'template-portfolio.php' ){
		$is_default_template = true;
	}
} else {
	$exclude_include = false;
	$flow_portfolio_home_exclude = array();
	$orderby = 'date';
	$order = 'DESC';
	$shuffle_button = false;
	$loop_through = false;
	$boundary_arrows = false;
	$is_default_template = false;
}

if ( empty( $orderby ) ) {
	$orderby = 'date';
}
if ( empty ( $order ) ) {
	$order = 'DESC';
}
if ( empty( $exclude_include ) ) {
	$exclude_include = false; // false = exclude, true = include
}
if ( $exclude_include ) {
	$exclude_include_sign = 'IN';
} else {
	$exclude_include_sign = 'NOT IN';
}
if ( empty( $loop_through ) ) {
	$loop_through = false; // false = Loop, true = Do not loop
}
if ( empty( $boundary_arrows ) ) {
	$boundary_arrows = false;
}
?>
<div class="tn-grid-container clearfix" <?php if ( $is_default_template ) { ?>style="display: none;"<?php } ?>>
	<section id="options" class="clearfix">
		<ul id="filters" class="option-set clearfix" data-option-key="filter">
			<li><a href="#filter" data-project-category-id="all" data-option-value="*" class="selected"><?php _e( 'All Works', 'flowthemes' ); ?></a></li>
			<?php
			$tax_terms = get_terms( 'portfolio_category', array( 'hide_empty' => true ) );
			foreach ( $tax_terms as $tax_term ) {
				if ( ( ( is_array( $flow_portfolio_home_exclude ) ) && ( ( ( $exclude_include && in_array( $tax_term->slug, $flow_portfolio_home_exclude ) ) || ( ! $exclude_include && ! in_array( $tax_term->slug, $flow_portfolio_home_exclude ) ) ) ) ) || ( ! is_array( $flow_portfolio_home_exclude ) ) ) {
					echo '<li>' . '<a href="#filter" data-project-category-id="' . $tax_term->term_id . '" data-option-value=".portfolio-category-' . $tax_term->term_id . '">' . $tax_term->name  . '</a></li>';
				}
			}
			?>
		</ul>
		<ul id="etc" class="clearfix">
			<li id="toggle-sizes">
				<a href="#toggle-sizes" class="toggle-selected">
					<svg version="1.1" class="toggle-sizes-large-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="18px" viewBox="0 0 28 18" enable-background="new 0 0 28 18" xml:space="preserve">
						<g>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M2,0h14c1.105,0,2,0.895,2,2V16c0,1.104-0.895,2-2,2H2
								c-1.105,0-2-0.895-2-2V2C0,0.895,0.895,0,2,0z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,0H26c1.105,0,2,0.895,2,2V6C28,7.104,27.105,8,26,8h-3.999
								C20.895,8,20,7.104,20,6V2C20,0.895,20.895,0,22.001,0z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,10H26c1.105,0,2,0.895,2,1.999V16c0,1.104-0.895,2-2,2
								h-3.999C20.895,18,20,17.105,20,16V12C20,10.896,20.895,10,22.001,10z"/>
						</g>
					</svg>						
				</a>
				<a href="#toggle-sizes">
					<svg version="1.1" class="toggle-sizes-small-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="18px" viewBox="0 0 28 18" enable-background="new 0 0 28 18" xml:space="preserve">
						<g>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M2.001,0h4C7.104,0,8,0.895,8,2V6c0,1.104-0.896,2-1.999,2h-4
								C0.896,8,0,7.104,0,6V2C0,0.895,0.896,0,2.001,0z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M12,0h4.001C17.105,0,18,0.895,18,2V6c0,1.104-0.895,2-1.998,2H12
								c-1.105,0-2-0.896-2-2V2C10,0.895,10.895,0,12,0z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,0h4C27.104,0,28,0.895,28,2V6c0,1.104-0.896,2-1.999,2h-4
								C20.896,8,20,7.104,20,6V2C20,0.895,20.896,0,22.001,0z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M2.001,10h4C7.104,10,8,10.895,8,12V16c0,1.104-0.896,2-1.999,2h-4
								C0.896,18,0,17.105,0,16V12C0,10.895,0.896,10,2.001,10z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M12,10h4.001C17.105,10,18,10.895,18,12V16c0,1.104-0.895,2-1.998,2
								H12c-1.105,0-2-0.895-2-2V12C10,10.895,10.895,10,12,10z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M22.001,10h4C27.104,10,28,10.895,28,12V16c0,1.104-0.896,2-1.999,2
								h-4C20.896,18,20,17.105,20,16V12C20,10.895,20.896,10,22.001,10z"/>
						</g>
					</svg>
				</a>
			</li>
			<?php if ( $shuffle_button ) { ?>
				<li id="shuffle"><a href='#shuffle'><?php _e( 'Shuffle', 'flowthemes' ); ?></a></li>
			<?php } ?>
		</ul>
	</section>
	
	<div id="container" class="variable-sizes clearfix">
		<?php
		// Set variables
		$projectsArray = array();
		
		// Projects Loop
		global $paged;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} else if ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$args = array(
			'post_type' => array( 'portfolio' ),
			'orderby' => $orderby,
			'order' => $order,
			'paged' => $paged,
			'posts_per_page' => -1,
			'ignore_sticky_posts' => 1
		);
		
		// Exclude or Include categories
		if ( isset( $flow_portfolio_home_exclude ) && is_array( $flow_portfolio_home_exclude ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => $flow_portfolio_home_exclude,
					'operator' => $exclude_include_sign
				)
			);
		}

		$wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ) {
			while ( $wp_query->have_posts() ) { $wp_query->the_post();
				
				// Thumbnail and its mouse over color
				$thumbnail_image = get_post_meta($post->ID, '300-160-image', true);
				$thumbnail_hover_color = get_post_meta($post->ID, 'thumbnail_hover_color', true);
				if($thumbnail_image or $thumbnail_hover_color){
				}else{
					$thumbnail_hover_color = '#888';
				}
				
				/*
				 * Get project categories
				 *
				 * 1. Get project categories display names (for thumbnails)
				 * 2. Get project categories slugs (for PHP/JS/CSS use)
				 */
				$project_categories = array();
				$project_categories = wp_get_object_terms($post->ID, "portfolio_category");

				$project_categories_ids_array = array();
				$project_categories_names_array = array();
				foreach($project_categories as $project_category_index => $project_category_object){
					$project_categories_ids_array[] = $project_category_object->term_id;
					$project_categories_names_array[] = $project_category_object->name;
				}
				$project_categories_ids = array();
				foreach($project_categories_ids_array as $k => $v){
					$project_categories_ids[$k] = 'portfolio-category-' . $v;
				}
				$project_categories_ids = implode(" ", $project_categories_ids);
				$project_categories_names = implode(", ", $project_categories_names_array);
					
				// Project title
				$thumb_title = get_the_title();
				
				// Project description
				$thumb_descr = '';
				if ( ! post_password_required() && ( $thumb_descr = get_post_meta( $post->ID, 'flow_post_description', true ) ) ) {
					$thumb_descr = do_shortcode( wpautop( wp_kses_post( $thumb_descr ) ) );
				}
				
				// Project slides
				$project_content = apply_filters( 'the_content', get_the_content() );
				
				// Project meta data
				$tmpdddisplay = get_post_meta($post->ID, 'thumbnail_meta', true);
				if($tmpdddisplay == 1){
					$tmpdddisplay = 'tn-display-meta';
				}else{
					$tmpdddisplay = '';
				}
				$thumb_ourrole = get_post_meta($post->ID, 'portfolio_ourrole', true);
				$thumb_date = get_post_meta($post->ID, 'portfolio_date', true);
				$thumb_client = get_post_meta($post->ID, 'portfolio_client', true);
				$thumb_agency = get_post_meta($post->ID, 'portfolio_agency', true);
				
				// Thumbnail link
				$thumb_link = get_post_meta($post->ID, 'thumbnail_link', true);
				$thumb_link_target_blank = get_post_meta($post->ID, 'thumbnail_link_newwindow', true);
				if($thumb_link_target_blank == 1){
					$thumb_link_target_blank = 'target="_blank"';
				}else{
					$thumb_link_target_blank = '';
				}
				
				// Thumbnail size
				// 0 = random, 1 = large, 2 = medium, 3 = vertical, 4 = horizontal, 5 = small
				$thumb_size = get_post_meta( $post->ID, 'thumbnail_size', true );
				$thumb_size_classes = '';
				if ( $thumb_size == 0 || empty( $thumb_size ) ) {
					$thumb_size = rand( 0, 99 );
					if ( $thumb_size < 3 ) {
						$thumb_size_classes = 'width3 height2';
					} else if ( $thumb_size < 9) {
						$thumb_size_classes = 'width2 height2';
					} else if ( $thumb_size < 16) {
						$thumb_size_classes = 'height2';
					} else if ( $thumb_size < 24) {
						$thumb_size_classes = 'width2';
					} else {
						$thumb_size_classes = '';
					}
				} else if ( $thumb_size == 1 ) {
					$thumb_size_classes = 'width3 height2';
				} else if ( $thumb_size == 2 ) {
					$thumb_size_classes = 'width2 height2';
				} else if ( $thumb_size == 3 ) {
					$thumb_size_classes = 'height2';
				} else if ( $thumb_size == 4 ) {
					$thumb_size_classes = 'width2';
				}
				?>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'element', $project_categories_ids, $tmpdddisplay, $thumb_size_classes ) ); ?> data-id="<?php if ( ! $thumb_link ) { echo esc_attr( count( $projectsArray ) ); } ?>">
					<?php if ( $thumb_link ) { ?>
						<a class="thumbnail-link" href="<?php echo esc_url( $thumb_link ); ?>" <?php echo $thumb_link_target_blank; ?>></a>
					<?php } else { ?>
						<a class="thumbnail-project-link" href="<?php echo get_permalink(); ?>"><?php echo $thumb_title; ?></a>
					<?php } ?>
					<div class="thumbnail-meta-data-wrapper">
						<div class="symbol"><?php the_title(); ?></div>
					</div>
					<div class="name"><?php echo strip_tags( $thumb_client ); ?></div>
					<div class="categories"><?php echo $project_categories_names; ?></div>
					<div style="background-color: <?php echo $thumbnail_hover_color ?>;" class="thumbnail-hover"></div>
					<?php if ( esc_url( $thumbnail_image ) ) { ?>
							<img class="project-img" src="<?php echo esc_url( $thumbnail_image ); ?>" alt="<?php echo esc_attr( $thumb_title ); ?>" />
					<?php } ?>
					<div class="project-thumbnail-background" style="background-color: <?php echo $thumbnail_hover_color ?>;"></div>
				</div>
					
				<?php if ( ! $thumb_link ) { ?>
					<?php $projectsArray[] = array( $thumb_title, $thumb_descr, $thumb_date, $thumb_client, $thumb_agency, $thumb_ourrole, $project_content, get_permalink( $post->ID ), $thumb_link, $project_categories_ids_array, $post->ID ); ?>
				<?php } ?>
			<?php } ?>
		<?php } ?>
	</div>
</div>

<?php flow_paging_nav(); ?>
<?php wp_reset_query(); ?>
<?php wp_reset_postdata(); ?>

<script>
<?php echo 'var projectsArray = ' . json_encode( $projectsArray ) . ';'; ?>
var portfolio_page_title = jQuery('title').text();
var portfolio_page_url = location.href;
var boundary_arrows = <?php echo json_encode( $boundary_arrows ); ?>;
var loop_through = <?php echo json_encode( $loop_through ); ?>;
var global_current_id = false;
var project_url = '';
<?php if ( is_singular( 'portfolio' ) ) { ?>
	var project_url = <?php echo json_encode( esc_url( get_permalink( $post->ID ) ) ); ?>;
	<?php foreach ( $projectsArray as $k => $v ) { ?>
		<?php if ( $v[10] == $post->ID ) { ?>
			var global_current_id = <?php echo json_encode( $k ); ?>;
		<?php } ?>
	<?php } ?>
<?php } ?>
</script>