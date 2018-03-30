<?php
/**
 * The template for the displaying the post categories.
 *
 * @package Pile
 * @since   Pile 2.0
 */

//no need to show a category list if the user hasn't added any categories of it's own
if ( pile_categorized_blog() ) :
	$categories = get_categories();
	if ( ! is_wp_error( $categories ) ) : ?>

		<ul class="meta meta--post">
			<?php foreach ($categories as $category):
				if ($category->category_parent == 0): ?>
				<li>
					<a href="<?php echo esc_url( get_category_link($category->term_id) ) ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts in %s', 'pile' ), $category->name ) ) ?>">
						<?php echo $category->cat_name; ?>
					</a>
				</li>
			<?php endif;
			endforeach; ?>
		</ul>
		
	<?php endif;
endif;