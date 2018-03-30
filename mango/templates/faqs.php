<?php
/**
 * Template Name: FAQ's
 * The main faqs template
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage mango
 * @since Mango 1.0
 */

global $mango_settings,$args,$mango_layout_columns, $post;
$faqs_template = true;
$mango_layout_columns = mango_page_columns();
$mango_class_name = mango_class_name ();$mango_main_container = mango_main_container_class();
get_header();
$args = array( 'posts_per_page' => '-1', 'post_type' => 'faq' );
$wp_query = new WP_Query( $args );
?>
    <div class="<?php echo esc_attr($mango_main_container); ?> main">
                <div class="row">
                    <div class="<?php echo esc_attr($mango_class_name); ?>">
                    <?php if($wp_query->have_posts()){
                               $cols = 2;
                                $total_posts = $wp_query->post_count;
                                if($total_posts==1){
                                    $col_posts = 1;
                                    $cols = 1;
                                }else {
                                     $col_posts = ceil ( $total_posts / 2 );
                                }
                                $i = 0; ?> 
                        <div class="row">
                            <div class="<?php echo ($cols==2)?"col-md-6":"col-md-12"; ?>">
                                <div class="panel-group" role="tablist" aria-multiselectable="true">
                        <?php while($wp_query->have_posts()){
                                    $wp_query->the_post();
                                    if($cols==2 && $col_posts==$i){ ?>
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                          <div class="panel-group" role="tablist" aria-multiselectable="true">
                                  <?php } $i++; ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?php the_ID(); ?>">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" href="#collapse<?php the_ID() ?>" aria-expanded="true" aria-controls="collapse<?php the_ID() ?>">
                                            <?php the_title(); ?>
                                            <?php
                                            $label_text = get_post_meta ( get_the_ID(), 'mango_label_text', true ) ? get_post_meta ( $post->ID, 'mango_label_text', true ) : '';
                                            $label_type = get_post_meta ( get_the_ID(), 'mango_label_type', true ) ? get_post_meta ( $post->ID, 'mango_label_type', true ) : '';
                                           if($label_text && $label_type){ ?>
                                               <span class="label label-<?php echo esc_attr($label_type) ?>"><?php echo esc_attr($label_text); ?></span>
                                           <?php } ?>
                                            <span class="panel-icon"></span>
                                        </a>
                                    </h4>
                                </div><!-- End .panel-heading -->
                                <div id="collapse<?php the_ID() ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php the_ID() ?>">
                                    <div class="panel-body">
                                        <?php the_content(); ?>
                                    </div><!-- End .panel-body -->
                                </div><!-- End .panel-collapse -->
                            </div><!-- End .panel -->
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php }else{ 
                            get_template_part("content","none");
                          } ?>
                    <?php wp_reset_postdata(); ?> 
                    </div><!-- End .col-md-* -->

                    <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
                <?php  get_sidebar() ?>
                </div><!-- End .row -->
            </div><!-- End .container -->

        <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->

    </section><!-- End #content -->
<?php get_footer() ?>