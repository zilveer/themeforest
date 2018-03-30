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
	<div class="products" id="able-list">
		<?php
		if( have_posts() ) {
			while( have_posts() ) {
				the_post();
				$the_id = get_the_ID();
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
				<div class="col-md-4 col-sm-6 property mix">
					<div class="product-item">
						<div class="imagewrapper">
							<a href="<?php the_permalink();?>"><?php PGL_Template_Tag::the_post_thumbnail(get_the_ID(), 'estate-respond-thumbnail');?></a>
							<div class="label-hanger">
								<span class="price"><?php echo PGL_Addon_Estate::format_price(get_post_meta($the_id,'estate_price', TRUE))?></span>
								<?php echo $status_span;?>
							</div>
						</div>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="title-info">
							<div class="col-md-12 col-sm-12">
								<span>
								<?php _e('Purpose', PGL) ?> <span><?php echo get_post_meta( get_the_ID(), 'estate_purpose', TRUE )=="sale"?__('Sale', PGL):__('Rent', PGL); ?></span>
								</span>
							</div>
							<?php
							 $html =  PGL_Addon_Estate::display_default_fields(get_the_ID(), 12);
							 $html = apply_filters( 'estate/list/fields', $html );
							echo $typeHtml;
							 echo $html;
							 ?>
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
	jQuery(window).load(function($){
		var mixList = $('#able-list');
        mixList.masonry({
            columnWidth: ".mix",
            itemSelector: '.mix'
        });
        $('.has-tooltip').tooltip();
        $(".type-popover").popover({html:true})
	});
</script>
