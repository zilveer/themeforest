<?php

// GET POST THUMB
if ( has_post_thumbnail() ) { $thumb_data = lsvr_get_image_data( get_post_thumbnail_id() ); }

?>

<?php if ( is_single() ) : ?>

    <article <?php post_class(); ?>>

        <?php if ( isset ( $thumb_data ) ) : ?>
		<!-- ARTICLE IMAGE : begin -->
		<div class="article-image">
			<a href="<?php echo $thumb_data[ 'full' ]; ?>"><img src="<?php echo $thumb_data[ 'large' ]; ?>" data-hires="<?php echo $thumb_data[ 'hd' ]; ?>" alt="<?php echo $thumb_data[ 'alt' ]; ?>"></a>
		</div>
		<!-- ARTICLE IMAGE : begin -->
        <?php endif; ?>

		<!-- ARTICLE CONTENT : begin -->
		<div class="article-content various-content">
			<?php remove_filter( 'the_content', 'sharing_display', 19 ); // show sharing in article footer tag instead ?>
			<?php remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>
		<!-- ARTICLE CONTENT : end -->

		<!-- ARTICLE FOOTER : begin -->
		<footer class="article-footer">
			<ul class="article-info">

				<!-- DATE : begin -->
				<li class="date"><?php the_date(); ?></li>
				<!-- DATE : end -->

				<?php if( has_category() ) : ?>
				<!-- CATEGORIES : begin -->
				<li class="categories">
				<?php $post_categories = wp_get_post_categories( get_the_ID() ); ?>
				<?php foreach ( $post_categories as $cat_id ) : ?>
					<?php $cat = get_category( $cat_id ); ?>
					<a href="<?php echo get_category_link( $cat_id ); ?>"><?php echo $cat->name; ?></a><?php if ( $cat_id !== end( $post_categories ) ) { echo ', '; } ?>
				<?php endforeach; ?>
				</li>
				<!-- CATEGORIES : end -->
                <?php endif; ?>

				<?php if( has_tag() ) : ?>
				<!-- TAGS : begin -->
				<li class="tags">
					<?php $article_tags = wp_get_post_tags( get_the_ID() ); ?>
					<?php foreach ( $article_tags as $tag ) : ?>
						<a href="<?php echo get_tag_link( $tag->term_id ); ?>"><?php echo $tag->name; ?></a><?php if ( $tag !== end( $article_tags ) ) { echo ', '; } ?>
					<?php endforeach; ?>
				</li>
				<!-- TAGS : end -->
				<?php endif; ?>

			</ul>
			<?php if ( function_exists( 'sharing_display' ) ) { // social sharing
				echo sharing_display(); } ?>
		</footer>
		<!-- ARTICLE FOOTER : end -->

    </article>

	<!-- ARTICLE NAVIGATION : begin -->
	<ul class="article-navigation">

		<?php $prev_post = get_adjacent_post( false, '', true ); ?>
		<?php if ( !empty( $prev_post ) ): ?>
			<!-- PREV ARTICLE : begin -->
			<li class="prev">
				<h5 class="m-secondary-font"><?php _e( 'Previous Post', 'beautyspot' ); ?></h5>
				<a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title; ?></a>
			</li>
			<!-- PREV ARTICLE : end -->
		<?php endif; ?>

		<?php $next_post = get_adjacent_post( false, '', false ); ?>
		<?php if ( !empty( $next_post ) ): ?>
			<!-- NEXT ARTICLE : begin -->
			<li class="next">
				<h5 class="m-secondary-font"><?php _e( 'Next Post', 'beautyspot' ); ?></h5>
				<a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a>
			</li>
			<!-- NEXT ARTICLE : end -->
		<?php endif; ?>

	</ul>
	<!-- ARTICLE NAVIGATION : end -->

	<?php if ( lsvr_get_field( 'blog_detail_enable_author_bio', false, true ) ) : ?>
	<!-- ARTICLE AUTHOR : begin -->
	<div class="article-author">
		<h2 class="m-secondary-font heading-2 m-small"><?php _e( 'About Author', 'beautyspot' ); ?></h2>
		<div class="author-inner">
			<h4 class="author-name"><?php echo get_the_author(); ?></h4>
			<div class="author-description various-content">
				<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
			</div>
		</div>
	</div>
	<!-- ARTICLE AUTHOR : end -->
	<?php endif; ?>

    <?php if ( comments_open() ) : ?>
    <!-- ARTICLE COMMENTS : begin -->
    <div class="article-comments" id="comments">
      <?php comments_template(); ?>
    </div>
    <!-- ARTICLE COMMENTS : end -->
    <?php endif; ?>

<?php else : ?>

    <article <?php post_class(); ?>>

        <?php if ( isset ( $thumb_data ) ) : ?>
		<!-- ARTICLE IMAGE : begin -->
		<div class="article-image">
			<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_data[ 'large' ]; ?>" data-hires="<?php echo $thumb_data[ 'hd' ]; ?>" alt="<?php echo $thumb_data[ 'alt' ]; ?>"></a>
		</div>
		<!-- ARTICLE IMAGE : begin -->
        <?php endif; ?>

		<!-- ARTICLE HEADER : begin -->
		<header class="article-header">
			<span class="article-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
			<h2 class="article-title m-secondary-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<!-- ARTICLE HEADER : end -->

		<?php if ( strlen( get_the_excerpt() ) > 0 ) : ?>
		<!-- ARTICLE CONTENT : begin -->
		<div class="article-content various-content">
			<?php remove_filter( 'the_content', 'sharing_display', 19 ); // show sharing in article footer tag instead ?>
			<?php remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>
			<?php if( $post->post_excerpt ) : ?>
				<?php the_excerpt(); ?>
			<?php else: ?>
				<?php the_content( '[&#8230;]' ); ?>
			<?php endif; ?>
		</div>
		<!-- ARTICLE CONTENT : end -->
		<?php endif; ?>

		<!-- ARTICLE FOOTER : begin -->
		<footer class="article-footer">
			<ul class="article-info">

				<?php if ( lsvr_get_field( 'blog_list_enable_author', false, true ) ) : ?>
				<!-- AUTHOR : begin -->
				<li class="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author(); ?></a></li>
				<!-- AUTHOR : end -->
				<?php endif; ?>

				<?php if( has_category() ) : ?>
				<!-- CATEGORIES : begin -->
				<li class="categories">
				<?php $post_categories = wp_get_post_categories( get_the_ID() ); ?>
				<?php foreach ( $post_categories as $cat_id ) : ?>
					<?php $cat = get_category( $cat_id ); ?>
					<a href="<?php echo get_category_link( $cat_id ); ?>"><?php echo $cat->name; ?></a><?php if ( $cat_id !== end( $post_categories ) ) { echo ', '; } ?>
				<?php endforeach; ?>
				</li>
				<!-- CATEGORIES : end -->
                <?php endif; ?>

				<?php if( comments_open() ) : ?>
				<!-- COMMENTS : begin -->
				<li class="comments"><a href="<?php the_permalink(); ?>#comments"><?php _e( 'Comments', 'beautyspot' ); ?><?php $comment_count = get_comment_count( get_the_ID() ); echo $comment_count['approved'] > 0 ? ' (' . $comment_count['approved'] . ')' : ' (0)'; ?></a></li>
				<!-- COMMENTS : end -->
                <?php endif; ?>

			</ul>
			<?php if ( function_exists( 'sharing_display' ) ) { // social sharing
				echo sharing_display(); } ?>
			<p class="article-more"><a href="<?php the_permalink(); ?>" class="c-button"><?php _e( 'Read More', 'beautyspot' ); ?></a></p>
		</footer>
		<!-- ARTICLE FOOTER : end -->

    </article>

<?php endif; ?>