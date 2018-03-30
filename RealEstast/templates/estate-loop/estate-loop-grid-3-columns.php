<?php
global $pgl_options;
$isShowCase = false;
$purpose =  $pgl_options->option('estate_system_type');
if($purpose=='showcase'){$isShowCase = true;}
if( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $title = $term->name;
    $description = false;
    if($term->description){
        $description = '<p class="term-description">'.$term->description.'</p>';
    }
    ?>
    <div class="loop-description">
        <h1 class="loop-title"><?php echo $title?></h1>
        <?php echo $description?>
    </div>
<?php
}
?>
<?php get_template_part('templates/estate-loop/estate-toolbar')?>
<div class="row">
	<div class="products" id="able-list">
		<?php
		if( have_posts() ) {
			while( have_posts() ) {
				the_post();
				$the_id = get_the_ID();
				$status_span = '';
				$status = get_post_meta(get_the_ID(), 'estate_status', TRUE);
				$purpose = get_post_meta(get_the_ID(), 'estate_purpose', TRUE);

				if($status){
					if($purpose == 'sale'){
						$status_span = '<span class="status">'.__('Sold', PGL).'</span>';
					}elseif($purpose == 'rent'){
						$status_span = '<span class="status">'.__('Rented', PGL).'</span>';
					}
				}
				?>
				<div class="col-md-4 col-sm-6 mix shuffle-box">
                    <div class="property">
                        <div class="product-item">
                            <div class="imagewrapper">
                                <a href="<?php the_permalink();?>"><?php PGL_Template_Tag::the_post_thumbnail(get_the_ID(), 'estate-respond-thumbnail');?></a>
                                <div class="label-hanger">
                                    <span class="price"><?php echo PGL_Addon_Estate::format_price(get_post_meta($the_id,'estate_price', TRUE))?></span>
                                    <?php echo $status_span;?>
                                </div>
                            </div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="title-info row">
                                <?php if(!$isShowCase):?>
                                <div class="col-md-12 col-sm-12">
                                    <span class="line-top"><?php _e('Purpose', PGL) ?> <span class="pull-right"><?php echo get_post_meta( get_the_ID(), 'estate_purpose', TRUE )=="sale"?__('Sale', PGL):__('Rent', PGL); ?></span></span>
                                </div>
                                <?php endif;?>
                                <?php
                                 $html =  PGL_Addon_Estate::display_default_fields(get_the_ID(), 12);
                                 $html = apply_filters( 'estate/list/fields', $html );
                                 echo $html;
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
<?php get_template_part('templates/estate-loop/estate-paginations') ?>
<script type="text/javascript">
	jQuery(function($){
        $(window).load(function(){
            var mixList = $('#able-list');
            mixList.masonry({
                columnWidth: ".mix",
                itemSelector: '.mix'
            });
            $(".has-tooltip").tooltip();
        })
	});
</script>
