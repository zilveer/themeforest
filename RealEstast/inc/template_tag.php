<?php

class PGL_Template_Tag {
	static $size = NULL;

	static function init() {
	}

	/**
	 * @param string $size
	 * @param string $attr
	 */
	static function the_post_thumbnail( $the_id = NULL, $size = 'post-thumbnail', $attr = '', $echo = TRUE ) {
		/**
		 * @var PGL_Options $pgl_options;
		 */
		global $pgl_options;
		if ( ! $the_id )
			$the_id = get_the_ID();
		if ( ! PGL_Utilities::startsWith( $size, _PREFIX_ ) ) {
			$size = PGL_Image::_size( $size );
		}
		if ( ! has_post_thumbnail( $the_id ) && $pgl_options->option( 'use_default_image' ) ) {
			$text = $pgl_options->option( 'default_image_text' );
			$size = PGL_Image::size( $size );
			if ( ! $size['height'] )
				$size['height'] = 256;
			$html = sprintf( '<img data-src="holder.js/%sx%s/auto/#CCCCCC:#959595/text:%s" />', $size['width'], $size['height'], $text );
			if ( $echo )
				echo $html;
			else
				return $html;
		}
		else {
			if ( $echo )
				the_post_thumbnail( $size, $attr );
			else
				return get_the_post_thumbnail( $the_id, $size, $attr );
		}
	}

	static function slider() {
		global $pgl_options;
		$slider_items = $pgl_options->option( 'slider_images' );
		if ( empty( $slider_items ) )
			return;
		$item_count = count( $slider_items['url'] );
		if ( $item_count ) {
			wp_enqueue_script( 'jquery-flexslider', PGL_URI_JS . 'flexslider/jquery.flexslider-min.js', array( 'jquery' ) );
			wp_enqueue_script( 'flexslider-custom-header', PGL_URI_JS . 'flexslider/flexslider.estate.header.js', array( 'jquery', 'jquery-flexslider' ), '1.1' );
			wp_enqueue_style( 'jquery-flexslider', PGL_URI_CSS . 'flexslider/flexslider.css' );
			wp_enqueue_style( 'jquery-flexslider', PGL_URI_CSS . 'flexslider/flexslider.header.css' );
			?>
			<div id="slider-home" class="slider-home">
                <section class="fl-slider">
                    <div id="main-slider" class="flexslider">
                        <ul class="slides">
                            <?php
                            for ( $i = 0; $i < $item_count; $i ++ ) {
	                            $image = wp_get_attachment_image_src( $slider_items['id'][$i],'full');
                                ?>
                                <li>
                                    <div class="flex-caption">
                                        <div class="title">
                                            <span><?php if($link = $slider_items['link'][$i]):?><a href="<?php echo $link ?>"><?php endif;?><?php echo $slider_items['title'][$i]; ?><?php if($slider_items['link'][$i]):?></a><?php endif;?></span>
                                        </div>
                                    </div>
                                    <img src="<?php echo $image[0]?>"/>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <ul class="flex-direction-nav">
                            <li class="flex-nav-btn btn-left">
                                <a href="#" class="flex-prev" title="<?php _e('Previous')?>"><span class="left-arr control-arr"></span></a>
                            </li>
                            <li class="flex-nav-btn btn-right">
                                <a href="#" class="flex-next" title="<?php _e('Next')?>"><span class="right-arr control-arr"></span></a>
                            </li>
                        </ul>
                    </div>
                </section>
			</div>
		<?php
		}
	}

	static function comment_form( $args = array(), $post_id = NULL ) {
		global $id;
		if ( NULL === $post_id )
			$post_id = $id;
		else
			$id = $post_id;
		$commenter     = wp_get_current_commenter();
		$user          = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		$req           = get_option( 'require_name_email' );
		$aria_req      = ( $req ? " aria-required='true'" : '' );
		$fields        = array(
			'author' => '<div class="form-group comment-form-author col-md-6 col-sm-6"><input id="author" class="form-control" name="author" type="text" placeholder="' . __( 'Name', PGL ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
			'email'  => '<div class="form-group comment-form-email col-md-6 col-sm-6"><input id="email" class="form-control" name="email" placeholder="' . __( 'Email', PGL ) . ( $req ? ' *' : '' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
			'url'    => '<div class="form-group comment-form-url"><input id="url" class="form-control" placeholder="' . __( 'Website', PGL ) . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
		);

		$required_text = sprintf( ' ' . __( 'Required fields are marked %s', PGL ), '<span class="required">*</span>' );
		$defaults      = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<div class="form-group comment-form-comment"><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" placeholder="' . _x( 'Comment', 'noun', PGL ) . '" aria-required="true"></textarea></div>',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', PGL ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <pre class="prettyprint">' . allowed_tags() . '</pre>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave a Reply', PGL ),
			'title_reply_to'       => __( 'Leave a Reply to %s', PGL ),
			'cancel_reply_link'    => __( 'Cancel reply', PGL ),
			'label_submit'         => __( 'Post Comment', PGL ),
		);

		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
		include( locate_template( 'templates/single/comment-form.php' ) );
	}

	static function comment_display( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
				<p><?php _e( 'Pingback:', PGL ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', PGL ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default :
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<div class="img-author-cm">
						<?php
						$avatar_size = 50;
						echo get_avatar( $comment, $avatar_size );
						?>
					</div>
					<div class="infocoment">
						<a class="name-cm" href="<?php echo esc_url( get_comment_author_link() ) ?>"><?php echo get_comment_author() ?></a>

						<div class="date-cm">
							<time datetime="<?php echo get_comment_time( 'c' ); ?>"><?php echo get_comment_date() . ' ' . __( 'at', PGL ) . ' ' . get_comment_time(); ?></time>
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', PGL ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div>
						<div class="content-cm">
							<?php comment_text() ?>
						</div>
					</div>
				<?php
				break;
		endswitch;
	}
}

?>