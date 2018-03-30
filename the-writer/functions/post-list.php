<?php // Featued post image
$args  = array( 'postid' => $post->ID, 'width' => 800, 'height' => 533, 'wrap' => 'div', 'wrap_class' => 'post-image fitvid', 'exclude_video' => true, 'resizer' => '850auto' );

$date = get_option( "ocmx_meta_date" );
$author_link = get_option( "ocmx_meta_author" );

if( isset( $_GET['infinity'] ) && $_GET['infinity'] == 'scrolling' ) {
	$background_css = the_writer_post_background_css( $post->ID );

	if( '' != $background_css ){
		$tile_inline_style = 'style="' . $background_css . '"';
	}

	$title_css = the_writer_post_title_css( $post->ID );

	if( '' != $title_css ){
		$header_inline_style = 'style="' . $title_css . '"';
	}
}  ?>
<li id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>

	<div class="book-cover <?php if( '' != get_post_meta( $post->ID , "header_image", true) ) echo 'has-cover-background'; ?> <?php if( 'yes' == get_post_meta( $post->ID , "post_text_shadow", true) ) echo 'has-text-shadow'; ?> " data-href="<?php echo the_permalink(); ?>" <?php if( isset( $tile_inline_style ) ) echo $tile_inline_style; ?>>

		<?php if( $author_link != "false" ) { ;?>
			<h5 class="post-author" <?php if( isset( $header_inline_style ) ) echo $header_inline_style; ?>>
				<?php _e("written by", "ocmx"); ?> <?php the_author_posts_link(); ?>
			</h5>
		<?php } //Hide the author unless enabled in Theme Options ?>

		<div class="content">

			<h2 class="post-title typography-title"><a href="<?php the_permalink(); ?>" <?php if( isset( $header_inline_style ) ) echo $header_inline_style; ?>><?php the_title(); ?></a></h2>

			<?php if( 'no' != get_option( 'ocmx_show_excerpts' ) && has_excerpt()  ) { ?>
				<div class="excerpt" <?php if( isset( $header_inline_style ) ) echo $header_inline_style; ?>><?php the_excerpt(); ?></div>
			<?php } elseif( 'no' != get_option( 'ocmx_show_excerpts' ) && strstr($post->post_content,'<!--more-->') ) { ?>
				<div class="excerpt" <?php if( isset( $header_inline_style ) ) echo $header_inline_style; ?>><?php the_content(''); ?></div>
			<?php } // Only show the excerpt if we have one to show?>

		</div>

		<?php if( $date != "false" ) { ?>
			<h6 class="list-meta" <?php if( isset( $header_inline_style ) ) echo $header_inline_style; ?>>
				<?php echo the_time( get_option( 'date_format' ) ); ?>
			</h6>
		<?php } // Hide the date unless enabled in Theme Options ?>

	</div>
</li>