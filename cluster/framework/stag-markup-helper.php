<?php
/**
 * Schema.org markup based on the context value.
 *
 * @since 2.0.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !function_exists( 'stag_markup_helper' ) ) :
/**
 * Markup helper.
 *
 * @param  array $args An array containing how to output the markup data.
 * @return string $markup Output markup string.
 */
function stag_markup_helper( $args ) {
	if ( !empty( $args ) ) {
		$args = array_merge( array( 'context' => '', 'echo' => true, 'post_type' => '' ), $args );
	}

	$args = apply_filters( 'stag_markup_helper_args', $args );

	if( empty($args['context']) ) return;

	// markup string - stores markup output
	$markup     = '';
	$attributes = array();

	//try to fetch the right markup
	switch( $args['context'] ) {
		case 'body':
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/WebPage';
			break;

		case 'header':
			$attributes['role']      = 'banner';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/WPHeader';
			break;

		case 'title':
			$attributes['itemprop'] = 'headline';
			break;

		case 'description':
			$attributes['itemprop'] = 'description';
			break;

		case 'nav':
			$attributes['role']      = 'navigation';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/SiteNavigationElement';
			break;

		case 'content':
			$attributes['role']     = 'main';
			$attributes['itemprop'] = 'mainContentOfPage';

			if ( is_singular('post') || is_archive() || is_home() ) {
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/Blog';
			}

			if ( is_archive() && $args['post_type'] == 'products' ) {
				$attributes['itemtype']  = 'http://schema.org/SomeProducts';
			}

			if ( is_search() ) {
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/SearchResultsPage';
			}
			break;

		case 'entry':
			global $post;
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/CreativeWork';

			if ( $post && 'post' === $post->post_type ) {
				$attributes['itemtype']  = 'http://schema.org/BlogPosting';

					//If main query,
				if ( is_main_query() ) {
					$attributes['itemprop']  = 'blogPost';
				}
			}
			break;

		case 'phone':
			$attributes['itemprop']  = 'telephone';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/LocalBusiness';
			break;

		case 'image':
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/ImageObject';
			break;

		case 'image_url':
			$attributes['itemprop']  = 'contentURL';
			break;

		case 'name':
			$attributes['itemprop'] = 'name';
			break;

		case 'email':
			$attributes['itemprop'] = 'email';
			break;

		case 'job':
			$attributes['itemprop'] = 'jobTitle';
			break;

		case 'url':
			$attributes['itemprop'] = 'url';
			break;

		case 'affiliation':
			$attributes['itemprop']  = 'affiliation';
			break;

		case 'author':
			$attributes['itemprop']  = 'author';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/Person';
			break;

		case 'person':
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/Person';
			break;

		case 'single_image':
			$attributes['itemprop'] = 'image';
			break;

		case 'author_link':
			$attributes['itemprop'] = 'url';
			break;

		case 'author_name':
			$attributes['itemprop'] = 'name';
			break;

		case 'entry_time':
			$attributes['itemprop'] = 'datePublished';
			$attributes['datetime'] = get_the_time('c');
			break;

		case 'entry_title':
			$attributes['itemprop'] = 'headline';
			break;

		case 'entry_content':
			$attributes['itemprop'] = 'text';
			break;

		case 'comment':
			$attributes['itemprop']  = 'comment';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/UserComments';
			break;

		case 'comment_author':
			$attributes['itemprop']  = 'creator';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/Person';
			break;

		case 'comment_author_link':
			$attributes['itemprop']  = 'creator';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/Person';
			$attributes['rel']       = 'external nofollow';
			break;

		case 'comment_time':
			$attributes['itemprop']  = 'commentTime';
			$attributes['itemscope'] = 'itemscope';
			$attributes['datetime']  = get_the_time('c');
			break;

		case 'comment_text':
			$attributes['itemprop']  = 'commentText';
			break;

		case 'author_box':
			$attributes['itemprop']  = 'author';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/Person';
			break;

		case 'table':
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/Table';
			break;

		case 'video':
			$attributes['itemprop'] = 'video';
			$attributes['itemtype'] = 'http://schema.org/VideoObject';
			break;

		case 'audio':
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/AudioObject';
			break;

		case 'blog':
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/Blog';
			break;

		case 'sidebar':
			$attributes['role']      = 'complementary';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/WPSideBar';
			break;

		case 'footer':
			$attributes['role']      = 'contentinfo';
			$attributes['itemscope'] = 'itemscope';
			$attributes['itemtype']  = 'http://schema.org/WPFooter';
			break;
	}

	$attributes = apply_filters( 'stag_markup_helper_attributes', $attributes, $args );

	//we failed to fetch the attributes - let's stop
	if( empty($attributes) ) return;

	foreach ($attributes as $key => $value) {
		$markup .= ' ' . $key . '="' . $value . '"';
	}

	$markup = apply_filters( 'stag_markup_helper_output', $markup, $args );

	if ( $args['echo'] ) {
		echo $markup;
	} else {
		return $markup;
	}
}
endif;
