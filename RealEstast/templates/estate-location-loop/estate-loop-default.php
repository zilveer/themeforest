<?php
global $pgl_options;
$isShowCase = false;
$purpose =  $pgl_options->option('estate_system_type');
if($purpose=='showcase'){
    $isShowCase = true;
}
?>
<?php
if( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    ?>
    <div class="loop-description">
        <h1 class="loop-title"><?php echo $term->name?></h1>
    </div>
<?php
}
?>
<?php get_template_part( 'templates/estate-loop/estate-toolbar' ) ?>
<div class="row">
    <div class="products grid_list_product">
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
	            $status_span = '';
	            $status = get_post_meta(get_the_ID(), 'estate_status', TRUE);
	            if($status){
		            if($purpose == 'sale'){
			            $status_span = '<span class="status">'.__('Sold', PGL).'</span>';
		            }elseif($purpose == 'rent'){
			            $status_span = '<span class="status">'.__('Rented', PGL).'</span>';
		            }
	            }
	            $types = explode(',',get_the_term_list( get_the_ID(), 'estate-type', '', ',' ));
	            $typeHtml = '';
	            $tipHtml = null;
	            $typeLbl = __( 'Type', PGL );
		            $typeHtml .= <<<HTML
				<div class="col-md-12 col-sm-12">
                    <span class="line-top">
                        {$typeLbl}:
                        <span class="pull-right">
HTML;
		            if(count($types)>3){
			            for($i=0; $i<3; $i++){
				            $typeHtml .= $types[$i];
				            if($i<2) $typeHtml .= ', ';
			            }
			            $count = 0;
			            for($i=3; $i<count($types); $i++){
				            $count++;
				            $tipHtml .= $types[$i];
			            }
			            $typeHtml .= <<<HTML
	<span class="more-type"><a href="javascript:void(0)" class="type-popover" data-toggle="popover" data-placement="left" data-container="body" data-content='{$tipHtml}' data-html="true">{$count}+</a></span>
HTML;
		            }else{
			            $typeHtml .= get_the_term_list( get_the_ID(), 'estate-type', '', ', ' );
		            }
		            $typeHtml .= <<<HTML
						</span>
					</span>
				</div>
HTML;
                ?>
                <div class="col-md-12 property col-sm-12">
                    <div class="product-item">
                        <div class="row">
	                        <div class="table-row">
	                            <div class="col-md-4 col-sm-4 image-container">
	                                <div class="imagewrapper">
	                                    <a href="<?php the_permalink() ?>">
	                                        <?php PGL_Addon_Estate::get_estate_thumbnail( get_the_ID(), 'estate-respond-thumbnail', TRUE ) ?>
	                                    </a>
		                                <div class="label-hanger">
	                                        <span class="price"><?php echo PGL_Addon_Estate::format_price( get_post_meta( get_the_ID(), 'estate_price', TRUE ) ); ?></span>
			                                <?php echo $status_span;?>
		                                </div>
	                                </div>
	                            </div>
	                            <div class="col-md-8 col-sm-8 estate-data">
	                                <div class="list-right-info">
	                                    <div class="row">
	                                        <div class="col-md-6 col-sm-7">
	                                            <h3>
	                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                                            </h3>
	                                            <p class="excerpt"><?php PGL_Addon_Estate::the_excerpt(); ?></p>
	                                        </div>
	                                        <div class="col-md-6 col-sm-5">
	                                            <div class="title-info row">
	                                                <?php if(!$isShowCase):?>
	                                                <div class="col-md-12 col-sm-12">
		                                                <span>
	                                                        <?php _e( 'Purpose', PGL ) ?> <span><?php echo get_post_meta( get_the_ID(), 'estate_purpose', TRUE )=="sale"?__('Sale', PGL):__('Rent', PGL); ?></span>
		                                                </span>
	                                                </div>
	                                                <?php endif;
	                                                echo $typeHtml;
	                                                $html = PGL_Addon_Estate::display_default_fields( get_the_ID(), 12 );
	                                                $html = apply_filters( 'estate/list/fields', $html );
	                                                echo $html;
	                                                ?>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
        else {

        }
        ?>
    </div>
</div>
<?php get_template_part( 'templates/estate-loop/estate-paginations' ) ?>
<script type="text/javascript">
    jQuery(function($){
        $('.has-tooltip').tooltip();
        $(".type-popover").popover({html:true});
    });
</script>