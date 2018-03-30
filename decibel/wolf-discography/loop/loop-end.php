<?php
/**
 * Release Loop End
 *
 * @author WolfThemes
 * @package WolfDiscography/Templates
 * @since 1.0.2
 */
?>

	<?php if ( 'sidebar' == wolf_get_theme_option( 'release_type' ) ) : ?>
		</div><!--#primary-->
		<?php get_sidebar( 'discography' ); ?>
		<div class="clear"></div>
	<?php endif;?>
	</div><!--#releases-content .releases-->
</div><!--#release-container-->


