<?php

global $bt_home_slider;
global $bt_exclude_post;

if ( $bt_home_slider ) {
	$slider_posts = wp_get_recent_posts( array( 'post_status' => 'publish', 'numberposts' => 24, 'meta_key' => BTPFX . '_slider', 'meta_value' => '1' ) );
} else {
	$cat_list = '';
	$cat_arr = get_the_category();
	if ( count( $cat_arr ) == 0 ) {
		$cat_list = 0;
	}
	foreach ( $cat_arr as $cat ) {
		$cat_list .= $cat->cat_ID . ',';
	}
	$cat_list = rtrim( $cat_list, ',' );
	$slider_posts = wp_get_recent_posts( array( 'post_status' => 'publish', 'category' => $cat_list, 'numberposts' => 12, 'exclude' => $bt_exclude_post, 'meta_key' => '_thumbnail_id' ) );
}

$count = count( $slider_posts );

if ( $count > 2 ) { 

	global $bt_featured_slider;
	
	$id_slider = ' ';
	
	if ( $bt_featured_slider ) {
		$id_slider = ' id="bt_slider_related_t" ';
	}

?>

	<div<?php echo $id_slider; ?>class="topSlide" data-count="<?php echo esc_attr( $count ); ?>">
		<div class="topSlidePort">
			<?php foreach ( $slider_posts as $post ) {
			
				$post_thumbnail_id = get_post_thumbnail_id( $post['ID'] );
				$img = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
				$img = $img[0];
				
				if ( $post_thumbnail_id == '' ) {
					$images = bt_rwmb_meta( BTPFX . '_images', 'type=image', $post['ID'] );
					if ( $images == null ) $images = array();
					foreach ( $images as $img ) {
						break;
					}
					$img = wp_get_attachment_image_src( $img['ID'], 'large' );
					$img = $img[0];
				}
				
				$categories = get_the_category( $post['ID'] );
				$categories_html = '';
				if ( $categories ) {
					foreach ( $categories as $cat ) {
						$categories_html .= '<b>' . esc_html( $cat->name ) . '</b>';
					}
				}
				
				global $date_format;
				
				$blog_author = bt_get_option( 'blog_author' );
				$blog_date = bt_get_option( 'blog_date' );
				
				$meta = '';
				
				if ( $blog_author || $blog_date ) {
					$meta .= '<span class="posted">';
					if ( $blog_date ) $meta .= esc_html( date_i18n( $date_format, strtotime( get_the_time( 'Y-m-d', $post['ID'] ) ) ) );
					if ( $blog_date && $blog_author ) $meta .= ' &mdash; ';
					if ( $blog_author ) $meta .= __( 'by', 'bt_theme' ) . ' <strong>' . esc_html( get_the_author_meta( 'display_name', $post['post_author'] ) ) . '</strong>';
					$meta .= '</span>';
				}				
				
				echo '<div class="tsItem">
					<img class="aspectKeeper" role="presentation" aria-hidden="true" alt="" src="' . esc_url( get_template_directory_uri() . '/gfx/4x4.gif' ) . '">
					<div class="tsContent" style="background-image: url(\'' . esc_url( $img ) . '\')">
						<div class="tsBlock">
							<a class="tsCell" href="' . esc_url( get_permalink( $post['ID'] ) ) . '">
								<span class="cat">' . $categories_html . '</span>
								<span class="title">' . esc_html( $post['post_title'] ) . '</span>';
								echo $meta;
							echo '</a><!-- /tsCell -->
						</div><!-- /tsBlock -->
					</div><!-- /tsContent -->
				</div><!-- /tsItem -->';
			} ?>
		</div><!-- /topSlidePort -->
	</div><!-- /topSlide -->
	
<?php }