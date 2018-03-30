<?php
/*
    Template Name: All Categories
*/
get_header();
the_post();
get_template_part( 'includes/title' );

$offer_cats = couponxl_get_organized( 'offer_cat' );
$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );

?>

<section class="contact-page">
    <div class="container">

        <?php 
        $content = get_the_content();
        if( !empty( $content ) ):
        ?>
            <div class="white-block">
                <div class="white-block-content">
                    <div class="page-content clearfix">
                        <?php echo apply_filters( 'the_content', $content ) ?>
                    </div>
                </div>
            </div>
        <?php
        endif;
        ?>
            
        <div class="row">
            <div class="col-sm-4">
                <?php
                $counter = 0;
                $max = round( count( $offer_cats ) / 3, 0 );
                $max = max( 1, $max );                
                if( !empty( $offer_cats ) ){
                    foreach( $offer_cats as $key => $cat){
                        if( $counter == $max ){
                            echo '</div><div class="col-sm-4">';
                            $counter = 0;
                        }
                        $counter++;
                        ?>
                        <div class="panel-group" id="accordion_<?php echo $cat->slug; ?>" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="acc_<?php echo $cat->slug; ?>">
                                    <h4 class="panel-title">
                                        <a href="<?php echo esc_url( couponxl_append_query_string( couponxl_get_permalink_by_tpl( 'page-tpl_search_page' ), array( 'offer_cat' => $cat->slug ), array() ) ); ?>">
                                            <?php echo $cat->name; ?>
                                        </a>
                                        <span class="count"><?php echo $cat->count; ?></span>
                                        <?php if( !empty( $cat->children ) ): ?>
                                            <a data-toggle="collapse" data-parent="#accordion_<?php echo $cat->slug; ?>" href="#collapse_<?php echo $cat->slug; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $cat->slug; ?>">
                                               <span class="toggle"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                        <?php endif; ?>
                                        
                                    </h4>
                                </div>
                                <div id="collapse_<?php echo $cat->slug; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="acc_<?php echo $cat->slug; ?>">
                                    <div class="panel-body">
                                        <?php if( !empty( $cat->children ) ){
                                            couponxl_display_tree( $cat, 'offer_cat' );
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>