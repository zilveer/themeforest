<?php

if ( ! function_exists( 'pt_infinite_blog' ) ) :

/**
 * Adding infinite blog posts.
 */

if (class_exists('Woocommerce')) {
	if (!is_singular() && !is_woocommerce()) {
		add_filter('wp_footer', 'pt_infinite_blog');
	}
} else {
	if (!is_singular()) {
		add_filter('wp_footer', 'pt_infinite_blog');
	}
}

function pt_infinite_blog() {
	global $wp_query; ?>

	<script type="text/javascript">
		jQuery(document).ready(function($){
			$(window).load(function(){

				var page = 2;
				var total = <?php echo $wp_query->max_num_pages; ?>;
				var loading = false;
				var inf_var = '';

				$('.pt-get-more-posts').on('click', function(){
					if ($(this).attr('data-cat')) {
						inf_var = '&cat_id='+($(this).attr('data-cat'));
					}
					if ($(this).attr('data-tag')) {
						inf_var = '&tag_id='+($(this).attr('data-tag'));
					}
					if ($(this).attr('data-author')) {
						inf_var = '&author_id='+($(this).attr('data-author'));
					}
					if ( !loading ) {
						if (page <= total) {
							loading = true;
							loadPosts(page,inf_var);
						}
						page++;
					}
				});

				// Ajax loading Function
				function loadPosts(pageNumber, queryVar){
					$.ajax({
						url: "<?php echo esc_url( site_url() ); ?>/wp-admin/admin-ajax.php",
						type:'POST',
						data: "action=get_more&page_no=" + pageNumber + queryVar,
			            beforeSend : function(){
			            	if( total>=page ){
			                	$('.pt-get-more-posts').hide();
			                    $(".site-content").append(
			                    	'<div id="temp_load"><i class="fa fa-refresh fa-spin"></i>&nbsp;Loading... \
			                        </div>');
			            	};
			            },
						success: function(html){
							$("#temp_load").remove();
							$(".site-content").append(html);    // This will be the div where our content will be loaded*/
							if( total>(page-1) ){ $('.pt-get-more-posts').show(); }
							loading = false;
						},
					});
					return false;
				};

			});
		});
	</script>

<?php
}

endif;

/* Loop Function to dynamicaly added posts */

add_action('wp_ajax_get_more', 'pt_infinite_loop');
add_action('wp_ajax_nopriv_get_more', 'pt_infinite_loop');
function pt_infinite_loop() {
	global $wp_query;

    $paged           = $_POST['page_no'];
    $posts_per_page  = get_option('posts_per_page');

    $args = array(
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'paged' => $paged,
			'posts_per_page' => $posts_per_page,
		);

    if (isset($_POST['cat_id'])) {
    	$args['cat'] = $_POST['cat_id'];
    }
    if (isset($_POST['tag_id'])) {
    	$args['tag_id'] = $_POST['tag_id'];
    }
    if (isset($_POST['author_id'])) {
    	$args['author'] = $_POST['author_id'];
    }

	$the_query = new WP_Query( $args ); ?>

	<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	<?php die(); ?>
<?php }
