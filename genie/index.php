<?php

get_header();

echo '<div class="content">';
echo '<div class="gutter">';

$sidebar = bt_get_option( 'sidebar', true );
if ( isset( $_GET['sidebar'] ) && $_GET['sidebar'] != '' ) {
	$sidebar = $_GET['sidebar'];
}
if ( ( $sidebar == 'left' || $sidebar == 'right' ) && ! is_404() && ! is_search() ) {
	echo '<aside class="side column ' . sanitize_html_class( $sidebar ) . '" role="complementary" data-toggler-label="' . esc_attr( __( 'Additional Content', 'bt_theme' ) ) . '">';
		dynamic_sidebar( 'primary_widget_area' );
	echo '</aside><!-- /side -->';
	echo '<section class="main column narrow" role="main"><h2>main</h2>';
	$class_array = array( 'classic', 'excerpt' );
} else {
	echo '<section class="main column wide" role="main"><h2>main</h2>';
	$class_array = array( 'classic', 'excerpt', 'btSingle' );
}

if ( have_posts() ) {
	
	while ( have_posts() ) {
	
		the_post();
		
		$intro_text = bt_rwmb_meta( BTPFX . '_intro_text' );
		
		$images = bt_rwmb_meta( BTPFX . '_images', 'type=image' );
		if ( $images == null ) $images = array();
		$video = bt_rwmb_meta( BTPFX . '_video' );
		$audio = bt_rwmb_meta( BTPFX . '_audio' );
		
		$link_title = bt_rwmb_meta( BTPFX . '_link_title' );
		$link_url = bt_rwmb_meta( BTPFX . '_link_url' );
		$quote = bt_rwmb_meta( BTPFX . '_quote' );
		$quote_author = bt_rwmb_meta( BTPFX . '_quote_author' );
		
		$permalink = get_permalink();
		
		$post_format = get_post_format();
	
		$media_html = '';
		
		if ( has_post_thumbnail() ) {
				
			$media_html = '<div class="mediaBox image">';
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$img = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
			$media_html .= '<a href="' . esc_url( $permalink ) . '"><img src="' . esc_url( $img[0] ) . '" alt="' . esc_attr( basename( $img[0] ) ) . '"></a>';
			$media_html .= '</div>';
			
		}

		if ( $post_format == 'image' && ! has_post_thumbnail() ) {
		
			foreach ( $images as $img ) {
				$img = wp_get_attachment_image_src( $img['ID'], 'large' );
				$media_html = '<div class="mediaBox image"><a href="' . esc_url( $permalink ) . '"><img src="' . esc_url( $img[0] ) . '" alt="' . esc_attr( basename( $img[0] ) ) . '"></a></div>';
				break;
			}
			
		} else if ( $post_format == 'gallery' ) {
		
			if ( count( $images ) > 0 ) {
				$images_ids = array();
				foreach ( $images as $img ) {
					$images_ids[] = $img['ID'];
				}			
				if ( bt_rwmb_meta( BTPFX . '_grid_gallery' ) ) {
					$media_html = do_shortcode( '[bt_grid_gallery ids="' . join( ',', $images_ids ) . '"]' );
				} else {
					$media_html = do_shortcode( '[gallery ids="' . join( ',', $images_ids ) . '"]' );
				}
			}
			
		} else if ( $post_format == 'video' ) {
			
			$media_html = '<div class="mediaBox"><div class="videoBox"><img class="aspectKeeper" src="' . esc_url( get_template_directory_uri() . '/gfx/16x9.gif' ) . '" alt="" role="presentation" aria-hidden="true"><div class="videoPort">';

			if ( strpos( $video, 'vimeo.com/' ) > 0 ) {
				$video_id = substr( $video, strpos( $video, 'vimeo.com/' ) + 10 );
				$media_html .= '<ifra' . 'me src="' . esc_url( 'http://player.vimeo.com/video/' . $video_id ) . '" allowfullscreen></ifra' . 'me>';
			} else {
				$yt_id_pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i';
				$youtube_id = ( preg_replace( $yt_id_pattern, '$1', $video ) );
				if ( strlen( $youtube_id ) == 11 ) {
					$media_html .= '<ifra' . 'me width="560" height="315" src="' . esc_url( 'http://www.youtube.com/embed/' . $youtube_id ) . '" allowfullscreen></ifra' . 'me>';
				} else {	
					$media_html .= do_shortcode( $video );
				}
			}
			
			$media_html .= '</div></div></div>';
			
			if ( $video == '' ) {
				$media_html = '';
			}
			
		} else if ( $post_format == 'audio' ) {
			
			if ( strpos( $audio, '</ifra' . 'me>' ) > 0 ) {
				$media_html = '<div class="soundCloudBox">' . wp_kses( $audio, array( 'iframe' => array( 'height' => array(), 'src' =>array() ) ) ) . '</div>';
			} else {
				$media_html = '<div class="mediaBox">' . do_shortcode( $audio ) . '</div>';
			}
			
			if ( $audio == '' ) {
				$media_html = '';
			}
			
		} else if ( $post_format == 'link' ) {
			
			$media_html = '<blockquote class="quote link"><p>' . esc_html( $link_title ) . '</p><p class="author"><a href="' . esc_url( $link_url ) . '">' . esc_url( $link_url ) . '</a></p></blockquote>';
			
			if ( esc_html( $link_title ) == '' || esc_url( $link_url ) == '' ) {
				$media_html = '';
			}
			
		} else if ( $post_format == 'quote' ) {
			
			$media_html = '<blockquote class="quote"><p>' . esc_html( $quote ) . '</p><p class="author">' . esc_html( $quote_author ) . '</p></blockquote>';
			
			if ( esc_html( $quote ) == '' || esc_html( $quote_author ) == '' ) {
				$media_html = '';
			}
			
		}

		global $date_format;
		
		$content = apply_filters( 'the_content', get_the_content( '', false ) );
		$content = str_replace( ']]>', ']]&gt;', $content );
		
		$categories = get_the_category();
		$categories_html = '';
		if ( $categories ) {
			foreach ( $categories as $cat ) {
				$categories_html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
			}
		}

		$blog_share_facebook = bt_get_option( 'blog_share_facebook' );
		$blog_share_twitter = bt_get_option( 'blog_share_twitter' );
		$blog_share_google_plus = bt_get_option( 'blog_share_google_plus' );
		$blog_share_linkedin = bt_get_option( 'blog_share_linkedin' );
		$blog_share_vk = bt_get_option( 'blog_share_vk' );

		get_template_part( 'php/share' );

		$share_html = '';
		if ( $blog_share_facebook || $blog_share_twitter || $blog_share_google_plus || $blog_share_linkedin || $blog_share_vk ) {
			
			if ( $blog_share_facebook ) {
				$share_html .= '<a href="' . esc_url( bt_get_share_link( 'facebook', $permalink ) ) . '" class="ico" title="Facebook"><span data-icon="&#xf09a;"></span></a>';
			}
			if ( $blog_share_twitter ) {
				$share_html .= '<a href="' . esc_url( bt_get_share_link( 'twitter', $permalink ) ) . '" class="ico" title="Twitter"><span data-icon="&#xf099;"></span></a>';
			}
			if ( $blog_share_linkedin ) {
				$share_html .= '<a href="' . esc_url( bt_get_share_link( 'linkedin', $permalink ) ) . '" class="ico" title="LinkedIn"><span data-icon="&#xf0e1;"></span></a>';
			}
			if ( $blog_share_google_plus ) {
				$share_html .= '<a href="' . esc_url( bt_get_share_link( 'google_plus', $permalink ) ) . '" class="ico" title="Google Plus"><span data-icon="&#xf0d5;"></span></a>';
			}
			if ( $blog_share_vk ) {
				$share_html .= '<a href="' . esc_url( bt_get_share_link( 'vk', $permalink ) ) . '" class="ico" title="VK"><span data-icon="&#xf189;"></span></a>';
			}
		}

		?>
		<article <?php post_class( $class_array ); ?>>
			<?php
			
			$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
			$author_html = '<a href="' . esc_url( $author_url ) . '">' . esc_html( get_the_author() ) . '</a>';
			
			echo '<header>
			<h3>' . $categories_html . '</h3>
			<h2><a href="' . esc_url( $permalink ) . '">' . get_the_title() . '</a></h2>';
			
			$blog_author = bt_get_option( 'blog_author' );
			$blog_date = bt_get_option( 'blog_date' );
			$blog_number_comments = bt_get_option( 'blog_number_comments' );
			$comments_open = comments_open();
			$comments_number = get_comments_number();
			$show_comments_number = true;
			if ( ! $blog_number_comments || ( ! $comments_open && $comments_number == 0 ) ) {
				$show_comments_number = false;
			}
			
			$meta = '';
			
			if ( $blog_author || $blog_date || $show_comments_number ) {
				$meta .= '<p class="meta">';
				if ( $blog_date ) $meta .= esc_html( date_i18n( $date_format, strtotime( get_the_time( 'Y-m-d' ) ) ) ); 
				if ( $blog_date && $blog_author ) $meta .= ' &mdash; ';
				if ( $blog_author ) $meta .= __( 'by', 'bt_theme' ) . ' <strong>' . $author_html . '</strong>';
				if ( ( $blog_date || $blog_author ) && $show_comments_number ) $meta .= ' &mdash; ';
				if ( $show_comments_number ) $meta .= '<span class="commentCount"><a href="' . esc_url( $permalink ) . '#comments">' . $comments_number . '</a></span>';
				$meta .= '</p>';
			}
			
			echo $meta;
			
			echo '</header>';
			
			echo $media_html;
			
			if ( esc_html( $intro_text ) != '' ) {
				echo '<p class="loud">' . esc_html( $intro_text ) . '</p>';
			}
			echo '<div class="articleBody">';
			if ( $post_format == 'link' && $media_html == '' ) {
				echo '<blockquote class="quote link">';
			}
			echo get_post()->post_excerpt != '' ? '<p>' . esc_html( get_the_excerpt() ) . '</p>' : $content;
			if ( $post_format == 'link' && $media_html == '' ) {
				echo '</blockquote>';
			}			
			echo '</div><!-- /articleBody -->
			<footer>
				<p class="continue"><a href="' . esc_url( $permalink ) . '" class="ico"><span class="more"></span><strong>' . __( 'CONTINUE READING', 'bt_theme' ) . '</strong></a></p>
				<div class="socialsRow">
					' . $share_html . '
				</div><!-- /socialsRow -->
			</footer>			
		</article>';
		
	}
	
	bt_pagination();
} else {
	if ( is_search() ) { ?>
		<article class="classic single noBorder">
			<header>
				<h3 class="errorCode">No Results</h3>
				<h2><?php _e( 'we are sorry', 'bt_theme' ); ?><br><?php _e( 'no search results have been found', 'bt_theme' ); ?></h2>
			</header>
			<div class="articleBody txt-center">
				<a href="/" class="btn chubby"><?php _e( 'Back to homepage', 'bt_theme' ); ?></a>
			</div><!-- /articleBody -->
		</article><!-- /classic -->
	<?php }
}

echo '</section><!-- /main -->';
echo '</div><!-- /gutter -->';
echo '</div><!-- /content -->';

get_footer();