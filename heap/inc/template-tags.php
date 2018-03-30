<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Heap
 * @since Heap 1.0
 */

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Heap 1.0
 */
function heap_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so heap_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so heap_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in heap_categorized_blog
 *
 * @since Heap 1.0
 */
function heap_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'heap_category_transient_flusher' );
add_action( 'save_post', 'heap_category_transient_flusher' );

function heap_the_archive_title() {

	$object = get_queried_object();

	if ( is_home() ) {
		//do nothing - no title is needed
	} elseif ( is_search() ) { ?>
		<div class="heading headin--main">
			<span class="archive__side-title beta"><?php _e('Search Results for: ', 'heap' ) ?></span>
			<h2 class="hN"><?php echo get_search_query(); ?></h2>
		</div>
		<hr class="separator" />
		<?php
	} elseif ( is_tag() ) { ?>
		<div class="heading headin--main">
			<h2 class="hN"><?php echo single_tag_title( '', false ); ?></h2>
			<span class="archive__side-title beta"><?php _e('Tag', 'heap' ) ?></span>
		</div>
		<hr class="separator" />
	<?php } elseif (!empty($object) && isset($object->term_id)) { ?>
		<div class="heading headin--main">
			<h2 class="hN"><?php echo $object->name; ?></h2>
			<span class="archive__side-title beta"><?php _e('Category', 'heap' ) ?></span>
		</div>
		<hr class="separator" />
	<?php } elseif ( is_day() ) {?>
		<div class="heading headin--main">
			<span class="archive__side-title beta"><?php _e('Daily Archives: ', 'heap' ) ?></span>
			<h2 class="hN"><?php echo get_the_date(); ?></h2>
		</div>
		<hr class="separator" />
	<?php } elseif ( is_month() ) { ?>
		<div class="heading headin--main">
			<span class="archive__side-title beta"><?php _e('Monthly Archives: ', 'heap' ) ?></span>
			<h2 class="hN"><?php echo get_the_date( _x( 'F Y', 'monthly archives date format', 'heap' ) ) ; ?></h2>
		</div>
		<hr class="separator" />
	<?php } elseif ( is_year() ) { ?>
		<div class="heading headin--main">
			<span class="archive__side-title beta"><?php _e('Yearly Archives: ', 'heap' ) ?></span>
			<h2 class="hN"><?php echo get_the_date( _x( 'Y', 'yearly archives date format', 'heap' ) ) ; ?></h2>
		</div>
		<hr class="separator" />
	<?php } else { ?>
		<div class="heading headin--main">
			<span class="archive__side-title beta"><?php _e('Archives', 'heap' ) ?></span>
		</div>
		<hr class="separator" />
	<?php }
}

function heap_breadcrumb() {
	global $post;

	// separator between normal elements - parent > child
	$separator = '<span class="separator"></span>';
	// separator between cats not hierarchical
	$cat_separator = '<span class="cat-separator"></span>';

	if (!is_front_page()) {
	?>
	<div class="breadcrumbs" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<a href="<?php echo home_url() ?>" itemprop="url" class="home">
			<span itemprop="title"><?php _e("Home", 'heap') ?></span>
		</a>
	<?php
	echo $separator;

	if (!is_home()) {
		if (is_single()) {
			$taxonomy = 'category';

			// get the term IDs assigned to post.
			$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

			if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {

				$term_ids = implode( ',' , $post_terms );
				$terms = wp_list_categories(
					array(
						'title_li' => false,
						'style'=>'list',
						'show_option_none'=> false,
						'echo'=>false,
						'taxonomy'=>$taxonomy,
						'include'=>$term_ids,
						'walker'=> new Heap_Walker_Category_Breadcrumbs,
					)
				);
				$terms = rtrim( trim( $terms ), $cat_separator );

				// display post categories
				echo  $terms;
				//one for the road
				echo $separator;
			}

		} elseif (is_page()) {
			if($post->post_parent){
				$anc = get_post_ancestors( $post->ID );
				if (!empty($anc)) {
					$temp_separator = '';
					foreach ( $anc as $ancestor ):
						echo $temp_separator; ?>
						<div itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="<?php echo get_permalink($ancestor); ?>" itemprop="url" title="<?php echo get_the_title($ancestor) ?>">
							<span itemprop="title"><?php echo get_the_title($ancestor); ?></span>
							</a>
						</div>
					<?php
						$temp_separator = $separator;
					endforeach;

					//one for the road
					echo $separator;
				}
			}
		} elseif (is_category()) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$link_before = '<div itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
				$link_attr = ' itemprop="url"';
				$link_after = '</div>';
				$cats = get_category_parents($this_cat->parent, true, $separator);
				//remove current category
				$cats = preg_replace("#^(.+)$separator$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				//wrap link text in spans
				$cats = preg_replace('#<a([^>]+)>([^<]*)<\/a>#', '<a$1><span itemprop="title">$2</span></a>', $cats);
				echo $cats;

				//one for the road
				echo $separator;
			}

		}
	} else {
		//do nothing
	}
	//close it
	echo '</div>';

	}

}

/**
 * Echo author page link
 * @return bool|string
 */
function heap_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s">%3$s</a>',
		esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
		esc_attr( sprintf( __( 'Posts by %s', 'heap' ), get_the_author() ) ),
		get_the_author()
	);

	/**
	 * Filter the link to the author page of the author of the current post.
	 *
	 * @since 2.9.0
	 *
	 * @param string $link HTML link.
	 */
	echo apply_filters( 'the_author_posts_link', $link );
}

function heap_please_select_a_menu(){
	echo '
	<ul class="nav  nav--main sub-menu" >
		<li><a href="'. admin_url('nav-menus.php?action=locations') .'">'.__('Please select a menu in this location', 'heap' ) .'</a></li>
	</ul>';
}

add_action('the_password_form', 'heap_callback_the_password_form');

function heap_callback_the_password_form($form){
	global $post;
	$post = get_post( $post );
	$postID = $post->ID;
	$label = 'pwbox-' . ( empty($postID) ? rand() : $postID );
	$form = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<p>' . __("This post is password protected. To view it please enter your password below:", 'heap') . '</p>
		<div class="row">
			<div class="column  span-12  hand-span-10">
				<input name="post_password" id="' . $label . '" type="password" size="20" placeholder="'. __("Password", 'heap') . '"/>
			</div>
			<div class="column  span-12  hand-span-2">
				<input type="submit" name="Access" value="' . esc_attr__("Access", 'heap') . '" class="btn post-password-submit"/>
			</div>
		</div>
	</form>';

	// on form submit put a wrong passwordp msg.
	if ( get_permalink() != wp_get_referer() ) {
		return $form;
	}

	// No cookie, the user has not sent anything until now.
	if ( ! isset ( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) ){
		return $form;
	}

	require_once ABSPATH . 'wp-includes/class-phpass.php';
	$hasher = new PasswordHash( 8, true );

	$hash = wp_unslash( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] );
	if ( 0 !== strpos( $hash, '$P$B' ) )
		return $form;

	if ( !$hasher->CheckPassword( $post->post_password, $hash ) ){

		// We have a cookie, but it does not match the password.
		$msg = '<span class="wrong-password-message">'.__( 'Sorry, your password did not match', 'heap' ).'</span>';
		$form = $msg . $form;
	}

	return $form;
}

/**
 * Add title and caption back to images
 */
function heap_add_title_caption_to_attachment( $markup, $id ){
	$att = get_post( $id );
	$title = '';
	$caption = '';
	if (!empty($att->post_title)) {
		$title = $att->post_title;
	}
	if (!empty($att->post_excerpt)) {
		$caption = $att->post_excerpt;
	}
	return str_replace('<a ', '<a data-title="'.$title.'" data-alt="'.$caption.'" ', $markup);
}
add_filter('wp_get_attachment_link', 'heap_add_title_caption_to_attachment', 10, 5);