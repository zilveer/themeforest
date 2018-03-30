<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$custom_tab_title1 = get_post_meta(get_the_id(), 'mango_tabs_custom_heading_one', true);
$custom_tab_content1 = get_post_meta(get_the_id(), 'mango_contact_tabs_content_one', true);
$custom_tab_title2 = get_post_meta(get_the_id(), 'mango_tabs_custom_heading_two', true);
$custom_tab_content2 = get_post_meta(get_the_id(), 'mango_contact_tabs_content_two', true);

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) :
    $ver = mango_single_product_version();
    ?>
    <?php if($ver=="v_1"){ ?>
	<div class="woocommerce-tabs row">
        <div class="col-md-12">
            <div role="tabpanel" class="product-details-tab">
                <ul class="tabs nav nav-tabs" role="tablist">
                    <?php $current  = "active";
                    foreach ( $tabs as $key => $tab ) :
					if(class_exists('WC_Vendors') ){
			
						if($tab['title'] == 'Additional Information'){
							$tab['title']= "Items Details";
						}
					}
					
					?>
                        <li class="<?php echo esc_attr( $key ); ?>_tab <?php echo esc_attr($current); ?>">
                            <a href="#tab-<?php echo $key ?>" aria-controls="tab-<?php echo $key; ?>" role="tab" data-toggle="tab" ><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
                        </li>
						
                    <?php $current = "";
                    endforeach; ?>
					<?php if($custom_tab_title1 && $custom_tab_content1){ ?>
					   <li class="custom_tab1">
                            <a href="#tab-1" aria-controls="tab-<?php echo $key; ?>" role="tab" data-toggle="tab" >
							<?php echo esc_attr($custom_tab_title1)?></a>
                       </li>
					<?php }  ?>
					<?php if($custom_tab_title2 && $custom_tab_content2){ ?>
					   <li class="custom_tab2">
                            <a href="#tab-2" aria-controls="tab-<?php echo $key; ?>" role="tab" data-toggle="tab" >
							<?php echo esc_attr($custom_tab_title2);?></a>
                       </li>
					<?php }  ?>
                </ul>
                <div class="tab-content">
            <?php foreach ( $tabs as $key => $tab ) : ?>
                <div role="tabpanel" class="tab-pane panel entry-content" id="tab-<?php echo esc_attr( $key ); ?>">
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>
            <?php endforeach; ?>
			<?php  if($custom_tab_title1 && $custom_tab_content1){?>
                <div role="tabpanel" class="tab-pane panel entry-content custom-bottom" id="tab-1">
                    <?php echo $custom_tab_content1;?>
                </div>
				<?php } ?>
				<?php  if($custom_tab_title2 && $custom_tab_content2){?>
                <div role="tabpanel" class="tab-pane panel entry-content custom-bottom" id="tab-2">
                    <?php echo $custom_tab_content2;?>
                </div>
				<?php } ?>
                </div>
				
            </div>
	    </div>
    </div>
    <?php } elseif($ver=="v_2"){ //start v_2 ?>
    <div class="panel-group text-left" id="productCollapse" role="tablist" aria-multiselectable="true">
        <?php foreach ( $tabs as $key => $tab ) :
	if(class_exists('WC_Vendors') ){
			
			if($tab['title'] == 'Additional Information'){
				$tab['title']= "Items Details";
			}
		}
		?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading-<?php echo esc_attr( $key ); ?>">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" href="#collapse-<?php echo esc_attr( $key ); ?>" data-parent="#productCollapse" aria-expanded="true" aria-controls="collapseDesc">
                        <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
                        <span class="panel-icon"></span>
                    </a>
                </h4>
            </div><!-- End .panel-heading -->
            <div id="collapse-<?php echo esc_attr( $key ); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php echo esc_attr( $key ); ?>">
                <div class="panel-body">
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div><!-- End .panel-body -->
            </div><!-- End .panel-collapse -->
        </div><!-- End .panel -->
        <?php endforeach; ?>
		<?php if($custom_tab_title1 && $custom_tab_content1){ ?>
		<div class="panel panel-default">
		<?php if($custom_tab_title1 && $custom_tab_content1){ ?>
            <div class="panel-heading" role="tab" id="heading-1">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" href="#collapse-1" data-parent="#productCollapse" aria-expanded="true" aria-controls="collapseDesc">
					<?php echo esc_attr($custom_tab_title1)?>
                        <span class="panel-icon"></span>
                    </a>
                </h4>
            </div><!-- End .panel-heading -->
		<?php } ?>
		<?php  if($custom_tab_title1 && $custom_tab_content1){ ?>
            <div id="collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-1">
                <div class="panel-body">
                    <?php echo $custom_tab_content1;?>
                </div><!-- End .panel-body -->
            </div><!-- End .panel-collapse -->
		<?php } ?>
		</div><!-- End .panel -->
        <?php } ?>
		<?php if($custom_tab_title2 && $custom_tab_content2){ ?>
		<div class="panel panel-default">
		<?php if($custom_tab_title2 && $custom_tab_content2){ ?>
            <div class="panel-heading" role="tab" id="heading-2">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" href="#collapse-2" data-parent="#productCollapse" aria-expanded="true" aria-controls="collapseDesc">
					<?php echo esc_attr($custom_tab_title2)?>
                        <span class="panel-icon"></span>
                    </a>
                </h4>
            </div><!-- End .panel-heading -->
		<?php } ?>
		<?php  if($custom_tab_title2 && $custom_tab_content2){ ?>
            <div id="collapse-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-2">
                <div class="panel-body">
                    <?php echo $custom_tab_content2;?>
                </div><!-- End .panel-body -->
            </div><!-- End .panel-collapse -->
		<?php } ?>
        </div><!-- End .panel -->
		<?php } ?>
    </div><!-- End .panel-group -->

<?php } 
elseif($ver=="v_3"){ //start v_2 ?>
         <div role="tabpanel" class="vertical-tab left v-t-btm">
            <ul class="nav nav-tabs" role="tablist">
               <?php $current  = "active";
                  foreach ( $tabs as $key => $tab ) :
                  if(class_exists('WC_Vendors') ){
                  
                  if($tab['title'] == 'Additional Information'){
                  $tab['title']= "Items Details";
                  }
                  } ?>
               <li role="presentation" class="<?php echo esc_attr( $key ); ?>_tab <?php echo esc_attr($current); ?>"><a href="#tab-<?php echo $key ?>" aria-controls="tab-<?php echo $key ?>" role="tab" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
               </li>
               <?php 
                  $current = "";
                    endforeach; ?>
               <?php if($custom_tab_title1 && $custom_tab_content1){ ?>
               <li class="custom_tab1">
                  <a href="#tab-1" aria-controls="tab-<?php echo $key; ?>" role="tab" data-toggle="tab" >
                  <?php echo esc_attr($custom_tab_title1)?></a>
               </li>
               <?php }  ?>
               <?php if($custom_tab_title2 && $custom_tab_content2){ ?>
               <li class="custom_tab2">
                  <a href="#tab-2" aria-controls="tab-<?php echo $key; ?>" role="tab" data-toggle="tab" >
                  <?php echo esc_attr($custom_tab_title2);?></a>
               </li>
               <?php } ?>   
            </ul>
            <div class="tab-content nav-justified">
               <?php foreach ( $tabs as $key=>$tab ) : ?>
               <div role="tabpanel" class="tab-pane" id="tab-<?php echo esc_attr( $key ); ?>">
                  <?php call_user_func( $tab['callback'], $key, $tab ) ;?>
               </div>
               <?php endforeach; ?>
               <?php  if($custom_tab_title1 && $custom_tab_content1){?>
               <div role="tabpanel" class="tab-pane entry-content custom-bottom" id="tab-1">
                  <?php echo $custom_tab_content1;?>
               </div>
               <?php } ?>
               <?php  if($custom_tab_title2 && $custom_tab_content2){?>
               <div role="tabpanel" class="tab-pane entry-content custom-bottom" id="tab-2">
                  <?php echo $custom_tab_content2;?>
               </div>
               <?php } ?>
            </div>
         </div>
<?php } endif; ?>
