<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package omni
 */

?>

<?php
if ( null === cs_get_customize_option( 'page_sidebar' ) ) {
	$page_sidebar = 'none';
} else {
	$page_sidebar = cs_get_customize_option( 'page_sidebar' );
}

$page_meta = get_post_meta( get_the_ID(), 'custom_sidebar_options', true );
if ( isset( $page_meta['custom_page_sidebar'] ) && ! ( $page_meta['custom_page_sidebar'] == '' ) && ! ( $page_meta['custom_page_sidebar'] == 'default' ) ) {
	$page_sidebar = $page_meta['custom_page_sidebar'];
}

if ( isset( $page_sidebar ) && ( $page_sidebar == 'left' ) ) {
	$sidebar_class = 'pull-right';
} else {
	$sidebar_class = '';
}

$title_position = cs_get_customize_option('page_title_style');
if(isset($page_meta['meta_page_title_style']) && !empty($page_meta['meta_page_title_style']) && !('default' === $page_meta['meta_page_title_style'])){
	if ( !('none' === $page_meta['meta_page_title_style']) ) {
		$title_position = $page_meta['meta_page_title_style'];
	} else {
		$title_position = '';
	}
}
if('title-center' === $title_position){
	$wrapper_class = 'text-center';
	$title_class = 'titel-top';
	$title_span = '<span class="titel-line"></span>';
}else{
	$wrapper_class = '';
	$title_class = '';
	$title_span = '';
}

$title_animation = cs_get_customize_option('page_title_animation');
if(isset($page_meta['meta_page_title_animation']) && !('default' === $page_meta['meta_page_title_animation'])){
	$title_animation = $page_meta['meta_page_title_animation'];
}
if(isset($title_animation) && !empty($title_animation)){
	$animation_class = 'wow '.$title_animation;
	$delay = 'data-wow-delay="0.3s"';
}else{
	$animation_class = '';
	$delay = '';
}
?>
<?php if ( isset( $page_sidebar ) && ( $page_sidebar == 'none' ) ){ ?>
<div class=" col-md-12 col-sm-12 col-xs-12">
	<?php } else { ?>
	<div class=" col-md-8 col-sm-8 col-xs-12 <?php echo esc_attr( $sidebar_class ); ?>">
		<?php } ?>


		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="blog-wrapper single-blog-wrapper">


				<?php if ( ! $page_meta['page_title_hide'] && isset( $page_meta['page_title_hide'] ) ) { ?>

					<header class="page-titel <?php echo esc_attr($animation_class.' '.$wrapper_class);?>" <?php echo $delay;?>>

						<?php omni_entry_categories( true ); ?>

						<?php the_title( '<h2 class="entry-title '.$title_class.'">'.$title_span.'', '</h2>' ); ?>

						<div class="entry-meta">
							<?php omni_posted_on(); ?>
						</div>
						<!-- .entry-meta -->

					</header><!--.text-center-->


				<?php } ?>

				<?php the_content(); ?>

				<footer class="entry-footer">
					<?php omni_entry_footer(); ?>

				</footer>
				<!-- .entry-footer -->
				<?php if ( isset($page_meta['page_share_hide']) && (! $page_meta['page_share_hide']) ) { ?>
					<div class="blog-social social-share"
					     data-directory="<?php echo esc_url( get_template_directory_uri() ); ?>"
					     data-template="share_full_post"></div>
					<!-- end blog-social -->
				<?php } ?>
			</div>
			<!--.blog-wrapper-->

		</article>
		<!-- #post-## -->

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	</div>
