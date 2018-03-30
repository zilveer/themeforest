<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* e.g., it puts together the home page when no home.php file exists.
*
* Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
*
* @package WordPress
* @subpackage Monarch
* @since Monarch 1.0
*/

get_header(); ?>

<section class="error-404 not-found section">

  <header id="masthead" class="site-header" role="banner">
    <div class="site-branding">
      <h1 class="site-title clearfix"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo get_bloginfo( 'description', 'display' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    </div>
  </header>

  <header class="page-header">

    <h1 class="page-title"><span><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'monarch' ); ?></span></h1>

    <div class="taxonomy-description">
      <figure class="heart-wrap">
        <figure class="heart"></figure>
      </figure>
      <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'monarch' ); ?></p>
      <?php get_search_form(); ?>
    </div>
    
  </header>

</section>

<?php get_footer(); ?>