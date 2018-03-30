<?php
/**
 * The template for displaying 404 pages (Not Found).
 */
 
get_header();

?>

<?php risen_breadcrumbs(); ?>
	
<div id="content">

	<div id="content-inner">
		
		<article>

			<header>
				<h1 class="page-title"><?php _e( 'Not Found', 'risen' ); ?></h1>		
			</header>

			<div class="post-content"> <!-- confines heading font to this content -->
		
				<p>
					<?php _e( 'The page or file you tried to access was not found.', 'risen' ); ?>	
				</p>
				
				<?php
				// Show a help message if user is admin
				if ( current_user_can( 'manage_options' ) ) :
				?>
				
				<p>
					<h2><?php _e( 'Help for Admin', 'risen' ); ?></h2>
				</p>
				
				<p>
					<?php _e( 'You are seeing this message because you are logged in as an admin user.', 'risen' ); ?>
				</p>
				
				<p>
					<?php printf( __( 'If this <i>should</i> be a valid URL, try re-saving your <a href="%s" target="_blank">Permalinks</a>. Make sure "Default" is not used and save even if making no changes.', 'risen' ), admin_url( 'options-permalink.php' ) ); ?>
				</p>
		
				<?php endif; ?>
		
			</div>	

		</article>			
		
	</div>

</div>
		
<?php get_footer(); ?>