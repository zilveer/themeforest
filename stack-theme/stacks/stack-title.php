<?php
	$post_id = get_queried_object_id();
	$title = '';
	$sub_title = '';

	// Show or Hide title
	$show_title = get_post_meta( $post_id, '_general_show_main_title', true );
	if( $show_title == 'off' ) return;
	if( $post_id > 0 ) {
		$custom_title = get_post_meta( $post_id, '_general_custom_main_title', true );
		$custom_sub_title = get_post_meta( $post_id, '_general_custom_sub_title', true );
		
		$title = ( $custom_title ) ? $custom_title : get_the_title( $post_id );
		$sub_title = ( $custom_sub_title ) ? $custom_sub_title : '';
	}

	// 404 page
	if( is_404() ) {
		$title = __('<em>404</em> page not found', 'theme_front');
		$sub_title = __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. isn&rsquo;t it?', 'theme_front' );
	}

	// Search page
	if( is_search() ) {
		$title = __('<em>Search</em> ', 'theme_front') . $_REQUEST['s'];

		if( $wp_query->found_posts > 0 ) {
			$sub_title = $wp_query->found_posts . __(  ' results matched search query', 'theme_front' );
		} else {
			$sub_title = __( 'no results matched search query', 'theme_front' );
		}
	}

	// Archive
	if( is_archive() ) {
		if ( is_category() ) {
			$title = sprintf( __( '<em>Category</em> %s', 'theme_front' ), single_cat_title( '', false ) );
			$sub_title = category_description();
		} elseif (is_tag() ) {
			$title = sprintf( __( '<em>Tag</em> %s', 'theme_front' ), single_tag_title( '', false ) );
			$sub_title = tag_description();
		} elseif ( is_day() ) {
			$title = sprintf( __( '<em>Daily</em> %s', 'theme_front' ), get_the_time( 'F jS, Y' ) );
		} elseif ( is_month() ) {
			$title = sprintf( __( '<em>Monthly</em> %s', 'theme_front' ), get_the_time( 'F, Y' ) );
		} elseif ( is_year() ) {
			$title = sprintf( __( '<em>Yearly</em> %s', 'theme_front' ), get_the_time( 'Y' ) );
		} elseif ( is_author() ) {
			if( get_query_var( 'author_name' ) ) {
				$curauth = get_user_by( 'slug', get_query_var('author_name') );
			} else {
				$curauth = get_userdata( get_query_var( 'author' ) );
			}
			$author_name = get_the_author_meta('display_name', $curauth->ID);
			$author_desc = get_the_author_meta('description', $curauth->ID);
			$title = sprintf( __( '<em>Author</em> %s', 'theme_front' ), $author_name );
			$sub_title = '';
		}
	}


?>
<div class="stack stack-section-title">
<div class="container">
		
		<?php if( is_page() || is_home() || is_singular('portfolio') ): ?>
			<h1 id="page-title"><?php echo $title; ?></h1>
		<?php else: ?>
			<h1 id="post-title"><?php echo $title; ?></h1>
		<?php endif; ?>

		<?php if( is_singular('portfolio') || is_singular('event') ): ?>
			<div id="page-sub-title"><?php echo $sub_title; ?></div>
		<?php elseif( is_single() ): ?>
			<div id="page-sub-title" class="post-meta">
				<?php if( theme_options('blog', 'meta_date') == 'on' ): ?>
					<span class="meta-item"><span><?php echo get_the_date(); ?></span></span>
				<?php endif; ?>
				<?php if( theme_options('blog', 'meta_author') == 'on' ): ?>
					<span class="meta-item">
						<span><?php the_author_posts_link(); ?></span>
					</span>
				<?php endif; ?>
				<?php if( theme_options('blog', 'meta_category') == 'on' && get_the_category_list() != '' ): ?>
					<span class="meta-item">
						<span><?php echo get_the_category_list(', '); ?></span>
					</span>
				<?php endif; ?>
				<?php if( theme_options('blog', 'meta_comment') == 'on' && comments_open() ): ?>
					<span class="meta-item">
						<span><?php comments_popup_link(__('No Comments','theme_front'), __('1 Comment','theme_front'), __('% Comments','theme_front'), '', ''); ?></span>
					</span>
				<?php endif; ?>
			</div>
		<?php elseif( $sub_title ): ?>
			<div id="page-sub-title"><?php echo $sub_title; ?></div>
		<?php endif; ?>

		<?php if( theme_options('appearance', 'enable_breadcrumb') == 'on' && !is_front_page() && !is_home() ): ?>
			<?php if( is_singular('portfolio') ): ?>
				<?php 
					if( theme_options('portfolio', 'archive') ): 
					$portfolios_page_id = get_wpml_object_id( theme_options('portfolio', 'archive'), 'page' );
				?><div id="page-breadcrumb"><a href="<?php echo get_permalink( $portfolios_page_id ); ?>"><i class="icon icon-th"></i> <?php echo get_the_title( $portfolios_page_id ); ?></a></div>
				<?php endif; ?>
			
			<?php elseif( is_singular('event') ): ?>
				<?php 
					if( theme_options('event', 'archive') ): 
					$event_page_id = get_wpml_object_id( theme_options('event', 'archive'), 'page' );
				?><div id="page-breadcrumb"><a href="<?php echo get_permalink( $event_page_id ); ?>"><i class="icon icon-th"></i> <?php echo get_the_title( $event_page_id ); ?></a></div>
				<?php endif; ?>
			
			<?php elseif( is_single() ): ?>
				<?php 
					if( get_option('page_for_posts') ):
					$posts_page_id = get_wpml_object_id( get_option('page_for_posts'), 'page' );
				?><div id="page-breadcrumb"><a href="<?php echo get_permalink( $posts_page_id ); ?>"><i class="icon icon-th"></i> <?php echo get_the_title( $posts_page_id ); ?></a></div>
				<?php endif; ?>

			<?php elseif( !is_front_page() ): ?>
				<div id="page-breadcrumb"><?php breadcrumbs_plus(array('separator' => '<i class="icon icon-angle-right"></i>', 'home' => __( 'Home', 'theme_front' ))); ?></div>
			<?php endif; ?>
		<?php endif; ?>

</div>
</div>