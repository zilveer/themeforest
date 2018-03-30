<?php

get_header();

if ( have_posts() ) {
	
	while ( have_posts() ) {
	
		the_post();
		
		$post_id = get_the_ID();
		
		$intro_text = bt_rwmb_meta( BTPFX . '_intro_text' );
		
		global $bt_featured_slider;
		$bt_featured_slider = bt_get_option( 'blog_featured_image_slider' ) && has_post_thumbnail();
		
		$featured_overlay = bt_rwmb_meta( BTPFX . '_featured_overlay' );
		
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
		
		if ( $post_format == 'image' ) {
		
			foreach ( $images as $img ) {
				$src = $img['full_url'];
				$media_html = '<div class="mediaBox"><img src="' . esc_url( $src ) . '" alt="' . esc_attr( basename( $src ) ) . '"></div>';
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
			
			$media_html = '<blockquote class="quote"><p>' . esc_html( $quote  ). '</p><p class="author">' . esc_html( $quote_author ) . '</p></blockquote>';
			
			if ( esc_html( $quote ) == '' || esc_html( $quote_author ) == '' ) {
				$media_html = '';
			}
			
		}

		global $date_format;
		
		$content_html = apply_filters( 'the_content', get_the_content( '', false ) );
		$content_html = str_replace( ']]>', ']]&gt;', $content_html );
		
		$categories = get_the_category();
		$categories_html = '';
		if ( $categories ) {
			foreach ( $categories as $cat ) {
				$categories_html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
			}
		}

		$tags = get_the_tags();
		$tags_html = '';
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$tags_html .= '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li>';
			}
			$tags_html = rtrim( $tags_html, ', ' );
			$tags_html = '<div class="tagsCloud"><ul>' . $tags_html . '</ul></div>';
		}
		
		$prev_next_html = '';
		$prev = get_adjacent_post( false, '', true );
		if ( '' != $prev ) {
			$prev_next_html .= '<div class="neighbor left"><a href="' . esc_url( get_permalink( $prev ) ) . '">' . __( 'Previous Post', 'bt_theme' ) . '<strong>' . esc_html( $prev->post_title ) . '</strong></a></div>';
		}
		$next = get_adjacent_post( false, '', false );
		if ( '' != $next ) {
			$prev_next_html .= '<div class="neighbor right"><a href="' . esc_url( get_permalink( $next ) ) . '">' . __( 'Next Post', 'bt_theme' ) . '<strong>' . esc_html( $next->post_title ) . '</strong></a></div>';
		}
		if ( '' != $prev_next_html  ) {
			$prev_next_html = '<div class="neighbors">' . $prev_next_html . '</div>';
		}

		$about_author_html = '';
		if ( bt_get_option( 'blog_author_info' ) ) {
		
			$avatar_html = get_avatar( get_the_author_meta( 'ID' ), 280 );
			$avatar_html = str_replace ( 'width=\'280\'', 'width=\'140\'', $avatar_html );
			$avatar_html = str_replace ( 'height=\'280\'', 'height =\'140\'', $avatar_html );
			$avatar_html = str_replace ( 'width="280"', 'width="140"', $avatar_html );
			$avatar_html = str_replace ( 'height="280"', 'height ="140"', $avatar_html );
			
			$about_author_html = '<div class="btAboutAuthor">';
			
			$user_url = get_the_author_meta( 'user_url' );
			if ( $user_url != '' ) {
				$author_html = '<a href="' . esc_url( $user_url ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>';
			} else {
				$author_html = esc_html( get_the_author_meta( 'display_name' ) );
			}
			
			if ( $avatar_html ) {
				$about_author_html .= '<div class="aaAvatar">' . $avatar_html . '</div>';
			}
			
			$about_author_html .= '<div class="aaTxt"><h4>' . $author_html;
			$about_author_html .= '</h4>
					<p>' . get_the_author_meta( 'description' ) . '</p>
				</div>
			</div>';
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
		
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$author_html = '<a href="' . esc_url( $author_url ) . '">' . esc_html( get_the_author() ) . '</a>';			
		
		if ( $blog_author || $blog_date || $show_comments_number ) {
			$meta .= '<p class="meta">';
			if ( $blog_date ) $meta .= esc_html( date_i18n( $date_format, strtotime( get_the_time( 'Y-m-d' ) ) ) ); 
			if ( $blog_date && $blog_author ) $meta .= ' &mdash; ';
			if ( $blog_author ) $meta .= __( 'by', 'bt_theme' ) . ' <strong>' . $author_html . '</strong>';
			if ( ( $blog_date || $blog_author ) && $show_comments_number ) $meta .= ' &mdash; ';
			if ( $show_comments_number ) $meta .= '<span class="commentCount"><a href="' . esc_url( $permalink ) . '#comments">' . $comments_number . '</a></span>';
			$meta .= '</p>';
		}
		
		if ( has_post_thumbnail() && $bt_featured_slider ) {
		
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$img = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );

			wp_enqueue_script( 'bt_anystretch_js', get_template_directory_uri() . '/js/jquery.anystretch.min.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'bt_classie_js', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'bt_single_js', get_template_directory_uri() . '/js/single.js', array( 'jquery' ), '', true );	

			echo '<div id="topBlock" class="topBlock tpost">';
				echo '<div id="imageHolder" data-stretch="' . esc_attr( $img[0] ) . '">';
					if ( $featured_overlay ) {
						echo '<div class="tbPort fade">';
					} else {
						echo '<div class="tbPort">';
					}
						echo '<div class="tbTable classic">';
							echo '<header class="tbHeader light">';
								echo '<h3>' . $categories_html . '</h3>';
								echo '<h1>' . esc_html( get_the_title() ) . '</h1>';
								echo $meta;
							echo '</header>';
						echo '</div><!-- /tbTable -->';
					echo '</div><!-- /tbPort -->';
				echo '</div><!-- /imageHolder -->';
			echo '</div><!-- /topBlock -->';
		}
		
		if ( has_post_thumbnail() && $bt_featured_slider ) {
			echo '<div id="content" class="content tpost">';
		} else {
			echo '<div id="content" class="content">';
		}
		echo '<div class="gutter">';

		$sidebar = bt_get_option( 'sidebar' );
		if ( isset( $_GET['sidebar'] ) && $_GET['sidebar'] != '' ) {
			$sidebar = $_GET['sidebar'];
		}
		if ( ( $sidebar == 'left' || $sidebar == 'right' ) && ! is_404() ) {
			if ( $sidebar == 'left' ) {
				echo '<aside class="side column ' . sanitize_html_class( $sidebar ) . '" role="complementary" data-toggler-label="' . esc_attr( __( 'Additional Content', 'bt_theme' ) ) . '">';
					dynamic_sidebar( 'primary_widget_area' );
				echo '</aside><!-- /side -->';
			}
			echo '<section class="main column narrow" role="main"><h2>main</h2>';
			$class_array = array( 'classic' );
		} else {
			echo '<section class="main column wide" role="main"><h2>main</h2>';
			$class_array = array( 'classic', 'btSingle' );
		}
		
		?><article <?php post_class( $class_array ); ?>>
			<?php
			
				echo '<header>
				<h3>' . $categories_html . '</h3>
				<h2>' . get_the_title() . '</h2>';
				echo $meta . '
			</header>
			' . $media_html . '
			<p class="loud">' . esc_html( $intro_text ) . '</p>
			<div class="articleBody">';
			if ( $post_format == 'link' && $media_html == '' ) {
				echo '<blockquote class="quote link">';
			}			
			echo $content_html;
			if ( $post_format == 'link' && $media_html == '' ) {
				echo '</blockquote>';
			}					
			echo '</div><!-- /articleBody -->';
			wp_link_pages( array( 
				'before'      => '<p class="btLinkPages">' . __( 'Pages:', 'bt_theme' ),
				'separator'   => ' ',
				'after'       => '</p>'
			));			
			echo $about_author_html . '
			<footer>
				' . $tags_html . '
				<div class="socialsRow">
					' . $share_html . '
				</div><!-- /socialsRow -->
			</footer>			
		</article>';
		
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		
		echo $prev_next_html;
		
	}
}

echo '</section><!-- /main -->';
if ( $sidebar == 'right' && ! is_404() ) {
	echo '<aside class="side column ' . sanitize_html_class( $sidebar ) . '" role="complementary" data-toggler-label="' . esc_attr( __( 'Additional Content', 'bt_theme' ) ) . '">';
		dynamic_sidebar( 'primary_widget_area' );
	echo '</aside><!-- /side -->';
}
echo '</div><!-- /gutter -->';
echo '</div><!-- /content -->';

global $bt_exclude_post;
$bt_exclude_post = $post_id;

get_template_part( 'php/slider' );

get_footer();