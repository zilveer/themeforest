<?php
	/*
	*
	*	Swift Framework Overrides
	*	------------------------------------------------
	*	Atelier specific functionality
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*/

	/* POST DETAIL FILTERS
	================================================== */
	function sf_atelier_related_articles_display_type() {
		return 'standard';
	}
	add_filter('sf_related_articles_display_type', 'sf_atelier_related_articles_display_type');

	function sf_atelier_related_articles_excerpt_length() {
		return 0;
	}
	add_filter('sf_related_articles_excerpt_length', 'sf_atelier_related_articles_excerpt_length');

	function sf_atelier_post_comments_wrap_class() {
		return 'comments-wrap clearfix';
	}
	add_filter( 'sf_post_comments_wrap_class', 'sf_atelier_post_comments_wrap_class' );

	function sf_atelier_post_comments_class() {
		return '';
	}
	add_filter( 'sf_post_comments_class', 'sf_atelier_post_comments_class' );

	function sf_atelier_related_posts_count() {
		return 4;
	}
	add_filter('sf_related_posts_count', 'sf_atelier_related_posts_count');

					
	/* POST ACTION ORDER
	================================================== */
	remove_action( 'sf_post_content_end', 'sf_post_share', 30 );

	remove_action( 'sf_post_after_article', 'sf_post_related_articles', 10 );
	add_action( 'sf_post_after_article', 'sf_post_related_articles', 30 );

	remove_action( 'sf_post_after_article', 'sf_post_comments', 20 );
	add_action( 'sf_post_content_end', 'sf_post_comments', 50 );
	
?>
