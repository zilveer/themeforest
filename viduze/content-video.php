<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php 
    echo '<div class="widget-bg"><ul class="videos">';
	while( have_posts() ){ the_post();
 ?>
 
<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>              
    <figure>
      <div class="thumb"> <a href="<?php echo get_permalink(); ?>">
            <?php    
											$post_id = get_the_ID();
			                       			$item_size = "234x183";
					                       	print_image_thumbnail( $post_id, $item_size );
					?>
                            </a>
                         <?php /*?><div class="play"> <a rel="prettyPhoto" href="http://vimeo.com/7874398&width=700"><img src="<?php echo get_template_directory_uri(); ?>/images/play.png" alt=""></a> </div><?php */?>
                      </div>
                      <figcaption>
                         <h5><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></h5>
                         <p> <?php echo  mb_substr( get_the_excerpt(), 0, '40' ) ;	?>... </p>
                            <ul class="views">
                              <li><?php echo get_the_date(); ?></li>
                              <li><i class="fa fa-comments"></i>
                                <?php comments_popup_link( __('0','cp_front_end'), __('1','cp_front_end'), __('%','cp_front_end'), '',__('Comments are off','cp_front_end') );?>
                              </li>
                              <li><i class="fa fa-eye"></i>
                                <?php if(function_exists('the_views')) { the_views(); } ?>
                              </li>
                            </ul>
                      </figcaption>
                    </figure>
                  </li>
                  <?php  }
                  echo '</ul></div>';
                  ?>
<!-- #post-## --> 
