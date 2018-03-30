<?php
/*
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php
				$postID = get_the_ID();
				$postCustom = get_post_custom();
				
				?>


				<div id="post-<?php echo $postID; ?>" <?php post_class('single'); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
						
						<?php
						$phone = isset($postCustom['_tb_phone'][0]) ? $postCustom['_tb_phone'][0] : FALSE;
						$mobile = isset($postCustom['_tb_mobile'][0]) ? $postCustom['_tb_mobile'][0] : FALSE;
						$email = isset($postCustom['_tb_email'][0]) ? $postCustom['_tb_email'][0] : FALSE;
						$twitter = isset($postCustom['_tb_twitter'][0]) ? $postCustom['_tb_twitter'][0] : FALSE;
						$facebook = isset($postCustom['_tb_facebook'][0]) ? $postCustom['_tb_facebook'][0] : FALSE;		
						$hasPostThumbnail = has_post_thumbnail();				
						?>
						
						<div class="left">

						<?php if ($hasPostThumbnail) { ?>
							<?php echo get_the_post_thumbnail($postID, 'bio_thumbnail', array('class' => 'imageBorder alignleft')); ?>
						<?php } ?>
						
						<?php
						
						$contactInfos = array();
						
						if ($email) $contactInfos[] = tb_social_button($email, 'email');
						if ($twitter) $contactInfos[] = tb_social_button($twitter, 'twitter');
						if ($facebook) $contactInfos[] = tb_social_button($facebook, 'facebook');
						
						if (count($contactInfos)) {
							echo '<div style="text-align: center;">';
							echo implode('', $contactInfos);
							echo '</div>';
						}
						
						?>
						
						</div>
						
						<?php
						$priestTitle = isset($postCustom['_tb_title'][0]) ? $postCustom['_tb_title'][0] : FALSE;
						$priestChurch = isset($postCustom['_tb_church'][0]) ? $postCustom['_tb_church'][0] : FALSE;
						
						if ($priestTitle || $priestChurch) {
							echo '<h3>';
							if ($priestTitle) echo $priestTitle;
							if ($priestTitle && $priestChurch) echo __(' at ', 'grace');
							if ($priestChurch) echo '<a href="' . get_permalink($priestChurch) . '">' . get_the_title($priestChurch) . '</a>';
							echo '</h3>';
						}
						
						?>
						
						<?php the_content(); ?>
						
						<?php
						$lifeMotto = isset($postCustom['_tb_life_motto'][0]) ? $postCustom['_tb_life_motto'][0] : FALSE;
						if ($lifeMotto) {
							echo '<div class="contentSpacer"></div>';
							
							echo "<h3>" . __('Quotes', 'grace') . "</h3>";
							
							$quotesArray = explode("\n", $lifeMotto);
							
							foreach ($quotesArray as $singleQuote) {
								if (empty($singleQuote)) continue;
								echo '<blockquote>';
								echo apply_filters('the_content', $singleQuote);
								echo '</blockquote>';
							}
						}
						?>

						<?php if ( function_exists('yoast_breadcrumb') ) {
							echo '<div class="contentSpacer"></div>';
							yoast_breadcrumb('<p id="breadcrumbs">' . __( 'You are here: ', 'grace'),'</p>');
						} ?>
					</div><!-- .entry-content -->

					<div class="entry-utility">
						<?php edit_post_link( __( 'Edit this', 'grace' ), '<span class="edit-link button right">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>