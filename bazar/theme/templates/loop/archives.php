<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$cat_not_in = $cat_in = array();  
$cats = yit_get_option( 'yit-cats-exclude[1]', '' ); 
if ( ! empty( $cats ) ) {
    $cats = array_map( 'trim', explode( ',', $cats ) );
    foreach ( $cats as $cat ) {
        if ( $cat < 0 )
            $cat_not_in[] = $cat;
        else
            $cat_in[] = $cat;
    }
}

?>
<div class="archive-list">
	<?php 
	    $args = array( 'posts_per_page' => 30 ); 
	    if ( isset( $cat_not_in ) && !empty( $cat_not_in )  ) $args['category__not_in'] = $cat_not_in;
	    if ( isset( $cat_in ) && !empty( $cat_in ) )     $args['category__in']     = $cat_in;
		$lastposts = new WP_Query( $args ); 
		
		if ( $lastposts->have_posts() ) :
	?>
	<h3 class="no-cufon"><?php printf( __( 'Last %d posts', 'yit' ), 30 ) ?>:</h3>    
	<ul class="archive-posts group">
		<?php while( $lastposts->have_posts() ) : $lastposts->the_post(); ?>
		
		<li>
			<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
				<span class="comments_number"><?php comments_number( '0', '1', '%' ) ?></span>
				<span class="archdate"><?php echo get_the_date( 'j.n.y' ) ?></span>
				<?php the_title() ?>
			</a>
		</li>
		
		<?php endwhile; ?>	
	</ul>
	<?php endif; ?>
	
	<h3 class="no-cufon"><?php _e( 'Archives by Month', 'yit' ) ?>:</h3>
	<ul class="archive-monthly group">
		<?php wp_get_archives('type=monthly'); ?>
	</ul>
	
	<h3 class="no-cufon"><?php _e( 'Archives by Subject', 'yit' ) ?>:</h3>
	<ul class="archive-categories group">
		 <?php wp_list_categories( 'title_li=&exclude=' . implode( ',', $cat_not_in ) . '&include=' . implode( ',', $cat_in ) ); ?>
	</ul>
</div>