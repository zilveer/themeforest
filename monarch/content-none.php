<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */
?>

<section class="error-404 no-results not-found">

   <header class="page-header">

      <div class="timeline-badge"><i class="ion-pin"></i></div>
      
      <div class="page-header-content">

         <h1 class="page-title"><span><?php esc_html_e( 'Nothing Found', 'monarch' ); ?></span></h1>

         <div class="taxonomy-description">
            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
               <p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'monarch' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
            <?php elseif ( is_search() ) : ?>
               <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'monarch' ); ?></p>
               <?php get_search_form(); ?>
            <?php else : ?>
               <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'monarch' ); ?></p>
               <?php get_search_form(); ?>
            <?php endif; ?>
         </div>
         
      </div>

   </header>
   <!-- .page-header -->

</section>

<!-- .no-results -->
<div class="timeline"></div>