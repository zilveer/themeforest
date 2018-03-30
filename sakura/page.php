<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<?php
global $portfolio;
$cat=$portfolio->get_cat();
if ($cat) include dirname(__FILE__).'/portfolio.php';
else {
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

            <?php echo sakura_posted_on_date2(false); ?>

				<div id="post-<?php the_ID(); ?>" class="article">
					<?php if ( is_front_page() ) { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } else { ?>
						<h1 class="entry-title _cf"><?php the_title(); ?></h1>
					<?php } ?>

               <!--
               <div class="entry_meta">
                  <?php sakura_meta(); ?><br style="clear: both;" />
               </div>
               -->

					<div class="entry-content">
					   <?php sakura_post_before(); ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sakura' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'sakura' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->

            <?php if (isset($is_contacts) && $is_contacts) { ?>

  </div> 
  <div class="article_b"></div>
  <div class="article_footer"> 
    <div class="article_footer_s feedback"> 

               <div class="header">Feedback</div>
               <form method="post" action="<?php echo htmlspecialchars("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]); ?>" name="order_form" id="order_form" class="uniform"> 
               <script>document.write('<'+'in'+'pu'+'t na'+'me="se'+'nd_'+'f" ty'+'pe="hi'+'dden'+'" id="se'+'nd_f" v'+'alu'+'e="'+''+Base64.decode('<?php echo base64_encode("send_f"); ?>')+'" /'+'>');</script> 
               <input type="hidden" name="send_contacts" value="1" />
               <div class="i_h"><div class="l"><input type="text" name="f_name" placeholder="Your name" id="name" class="validate[required]" title="Your name"></div></div> 
               <div class="i_h"><div class="r"><input type="text" name="f_email" placeholder="E-mail" id="f_email" class="validate[required,custom[email]]" title="E-mail"></div></div>
               <div class="t_h"><textarea placeholder="Message" cols="40" rows="8"  name="f_comment" id="comment" class="validate[required]"></textarea></div>
               <a href="#" class="cont_butt go_submit"></a>                 
               <a href="#" class="do_clear">Clear</a> 
               </form> 
               
    </div> 
  </div> 
  <div class="article_footer_b"></div> 

            <?php } else { ?>

				</div><!-- #post-## -->

            <?php } ?>


				<?php
               //global $wp_query;
               comments_template( '', true );
				?>


<?php endwhile; ?>

<?php }
get_footer(); ?>
