<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Loop - Archive
 *
 * This is the loop logic used on all archive screens.
 *
 * To override this loop in a particular archive type (in all categories, for example), 
 * duplicate the `archive.php` file and rename the duplicate to `category.php`.
 * In the code of `category.php`, change `get_template_part( 'loop', 'archive' );` to 
 * `get_template_part( 'loop', 'category' );` and save the file.
 *
 * Create a duplicate of this file and rename it to `loop-category.php`.
 * Make any changes to this new file and they will be reflected on all your category screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
 global $more; $more = 0;
						global $woo_options;
 
woo_loop_before();
if (have_posts()) { $count = 0;

	if (get_post_type() === 'post') {
		
		$title_before = '<h1 class="archive_header">';
		$title_after = '</h1>';
		
		woo_archive_title( $title_before, $title_after );
	}

	else if (get_post_type() === 'recipe') {

		if (function_exists('z_taxonomy_image_url')){ 

			if (z_taxonomy_image_url() != '' ) {
				
				echo  '<div class="image-cate"><img src="'.z_taxonomy_image_url().'" alt="" /></div>'; 
				
			}
		}
		
		?>
			<div class="recipe-title">
				<h1 class="title">
					<?php woo_archive_title(); ?>
				</h1>
				<?php 
					if ( term_description() != '' ) {
						echo '<div class="image-descrip">';
						echo term_description(); 
						echo "</div>";
					}

				?>
			</div>
		<?php 
	}


?>

<div class="fix"></div>

<?php
		while (have_posts()) { the_post(); $count++;
			if (get_post_type() === 'recipe') {
				switch ($woo_options['woo_arch_recipe']) {
					case 'false':
						dahz_get_template( 'content', 'content-recipe' );
					break;
					
					case 'true':
						dahz_get_template( 'content', 'content-recipelist' );
					break;
					
				}
			 
			}
			else{

				switch ($woo_options['woo_arch_post']) {
					case 'standard-post':
						dahz_get_template( 'content', 'content-post' );
					break;
					
					case 'elegant-post':
						dahz_get_template( 'content', 'content-elegant-post' );
					break;
				}	

			}

		} // End WHILE Loop

} else {
	dahz_get_template( 'content', 'content-noposts' );
} // End IF Statement

woo_loop_after();

woo_pagenav();
?>