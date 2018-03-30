<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */
 
 global $wp_query;
 //var_dump($wp_query);
 if ( $wp_query->query_vars["post_type"] == "dt_portfolio" )
 {
    get_template_part("portfolio");
    return;
 }
 
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>

 <div class="article_box col_l archive-header">
   <div class="article_t"></div>
   <div class="article search_title">

     <h1 class="page-title search_title">
     
<?php
if (isset($_GET["tumblog"])) $t = $_GET["tumblog"]; else $t = "";
if (preg_match('/\/tumblog\/([^\/]+)\//', $_SERVER["REQUEST_URI"], $m)) $t = $m[1];
?>
     
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', LANGUAGE_ZONE ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', LANGUAGE_ZONE ), get_the_date('F Y') ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', LANGUAGE_ZONE ), get_the_date('Y') ); ?>
<?php elseif ( is_category() ) : ?>
    <?php echo __('Category: ', LANGUAGE_ZONE).single_cat_title( '', false ); ?>
<?php elseif ($t) :

$f = array(
      "articles" => "Articles",
      "links" => "Links",
      "video" => "Videos",
      "images" => "Images",
      "audio" => "Audios",
      "quotes" => "Quotes",
      );

echo "Blog Archives: ";

if (isset($f[$t])) echo $f[$t]; else echo ucfirst($t);

else:
?>

				<?php echo __( 'Blog Archives', LANGUAGE_ZONE ); ?>
<?php endif; ?>
     </h1>

   </div>
   <div class="article_b"></div>
 </div>

<?php
   get_template_part( 'loop' , 'blog' );
?>
<?php get_footer(); ?>
