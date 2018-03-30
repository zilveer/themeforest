<style type="text/css">
    #<?php print $containerId; ?> {
        display: block;
        min-width: 670px;
    }
    #<?php print $ids['opt-to-zone']; ?>, #<?php print $ids['tax-to-zone']; ?> {
        display: none;
    }
    .<?php print $containerId; ?> .option-inner {
        padding: 5px 10px !important;
    }
</style>

<?php

$noZoneId = '_none';

$data = array(
    'zones' => array(
        $noZoneId => array(
            'name'  => __('No Zone', 'tfuse'),
            'items' => array()
        )
    )
);

foreach($zones as $id=>$name){
    if(trim($id)){
        $data['zones'][$id] = array(
            'name'  => $name,
            'items' => array(),
        );
    }
}

$opttax_items = array();

if( sizeof($optToZones) ){ // arrange options
    foreach($optToZones as $option){
        $option_prefix = 'opt';

        if(preg_match('/^opttozone_zone_/', $option['id'])){ // zone
            $option_id  = preg_replace('/^(opttozone_zone_)/','', $option['id']);

            if(trim($option['value'])){
                $option_zone = $option['value'];
            } else {
                $option_zone = $noZoneId;
            }

            $opttax_items[$option_prefix.'_'.$option_id] = array(
                'name'  => $option['name'],
                'zone'  => $option_zone
            );
        } elseif(preg_match('/^opttozone_priority_/', $option['id'])){ // priority
            $option_id  = preg_replace('/^(opttozone_priority_)/','', $option['id']);

            $opttax_items[$option_prefix.'_'.$option_id]['priority'] = intval($option['value']);
        } else {
            echo '<div>Invalid zone option id: '.esc_attr($option['id']).'</div>';
            continue;
        }
    }
}

if( sizeof($taxToZones) ){ // arrange taxonomies
    foreach($taxToZones as $option){
        $option_prefix = 'tax';

        if(preg_match('/^taxtozone_zone_/', $option['id'])){ // zone
            $option_id  = preg_replace('/^(taxtozone_zone_)/','', $option['id']);

            if(trim($option['value'])){
                $option_zone = $option['value'];
            } else {
                $option_zone = $noZoneId;
            }

            $opttax_items[$option_prefix.'_'.$option_id] = array(
                'name'  => $option['name'],
                'zone'  => $option_zone
            );
        } elseif(preg_match('/^taxtozone_priority_/', $option['id'])){ // priority
            $option_id  = preg_replace('/^(taxtozone_priority_)/','', $option['id']);

            $opttax_items[$option_prefix.'_'.$option_id]['priority'] = intval($option['value']);
        } else {
            echo '<div>Invalid zone option id: '.esc_attr($option['id']).'</div>';
            continue;
        }
    }
}

function _sort_by_priority__opttax_items($a, $b){
    return (intval($a['priority']) > intval($b['priority']));
}
uasort($opttax_items, '_sort_by_priority__opttax_items' );

if(sizeof($opttax_items)){
    foreach($opttax_items as $id=>$item){
        $data['zones'][ $item['zone'] ]['items'][$id] = $item;
    }
}

$noZoneArray = $data['zones'][$noZoneId];
unset($data['zones'][$noZoneId]);

$firstZoneId = '';
?>

<div class="tf_seek_sortable_lists_container">
    <div class="tf_seek_sortable_list_left">

        <ul class="ui-sortable-seek-zones">
            <?php foreach($data['zones'] as $zone_id=>$zone): ?>
                <?php if(!$firstZoneId) $firstZoneId = $zone_id; ?>

                <li class="tf_seek_sortable_list_container">
                    <div class="tf_seek_sortable_label"><?php print($zone['name']); ?></div>
                    <ul id="tf_seek_sortable_zone__<?php print $zone_id; ?>" class="tf_seek_sortable_list inside">
                        <?php if(sizeof($zone['items'])): $counter = 0; ?>
                            <?php foreach($zone['items'] as $item_id=>$item): ?>
                                <li class="tf_seek_sortable_item" id="<?php print($item_id); ?>">
                                    <h3><span><?php print(++$counter); ?>.</span> <?php print( esc_attr($item['name']) ); ?></h3>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
    <div class="tf_seek_sortable_list_right">

        <ul class="ui-sortable-seek-zones">
            <?php $zone_id = $noZoneId; $zone = $noZoneArray; ?>
            <?php if(!$firstZoneId) $firstZoneId = $zone_id; ?>

            <?php $data['zones'][$noZoneId] = $noZoneArray; ?>

            <li class="tf_seek_sortable_list_container">
                <div class="tf_seek_bw">
                    <ul id="tf_seek_sortable_zone__<?php print $zone_id; ?>" class="tf_seek_sortable_list inside">
                        <?php if(sizeof($zone['items'])): ?>
                        <?php foreach($zone['items'] as $item_id=>$item): ?>
                            <li class="tf_seek_sortable_item" id="<?php print($item_id); ?>">
                                <h3><span></span> <?php print( esc_attr($item['name']) ); ?></h3>
                            </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
        </ul>

        <div class="desc"><div><?php _e('Drag features in this box if you don\'t want them to appear on the website', 'tfuse'); ?></div></div>
    </div>
    <div style="clear:both;"></div>
</div>

<script type="text/javascript">
    jQuery(function($) {

        //$('ul.ui-sortable-seek-zones').sortable({ placeholder: 'tfes-placeholder' });

        <?php

        function ___get_selector_without($zones, $without){
            $output = '';
            foreach($zones as $key=>$val){
                if($key==$without) continue;

                $output .= ($output ? ', ' : '').'#tf_seek_sortable_zone__'.$val;
            }

            return $output;
        }

        $otherZones = array_keys($data['zones']);
        if(sizeof($otherZones)){

            foreach($otherZones as $key=>$val){
                ?>
                $( "#tf_seek_sortable_zone__<?php print $val; ?>" ).sortable({
                    distance: 30,
                    update: function(event, ui){
                        $( "#tf_seek_sortable_zone__<?php print $val; ?> li").each(function(){
                            var attrId  = String( $(this).attr('id') );
                            var isTax   = Boolean( attrId.match(/^tax_/) );
                            var item_id = attrId.replace(/^(opt|tax)_/, '');
                            var priority= $(this).index();
                            var prefix  = (isTax ? 'taxtozone_' : 'opttozone_');
                            var zone    = String( $(this).parent().attr('id') ).replace(/^tf_seek_sortable_zone__/, '');
                            if(zone == '<?php print $noZoneId; ?>') zone = '';

                            $('select#'+prefix+'zone_'+item_id).val(zone);
                            $('select#'+prefix+'priority_'+item_id).val(priority);

                            $('h3 span', $(this)).text( <?php if( $val != $noZoneId ): ?>(priority+1)+'.'<?php else: ?>''<?php endif; ?> );
                        });
                    }
                });
                <?php
            }

            if(sizeof($otherZones)>1){
                foreach($otherZones as $key=>$val){
                    ?>
                    $( "#tf_seek_sortable_zone__<?php print $val; ?>" ).sortable('option', 'connectWith', '<?php print ___get_selector_without($otherZones, $key); ?>');
                    <?php
                }
            }
        }
        ?>

        $('.tf_seek_sortable_lists_container .tf_seek_sortable_list_container .tf_seek_sortable_list .tf_seek_sortable_item')
            .bind('mousedown', function(){
                $(this).closest('ul')
                    .css('overflow', 'visible');
            })
            .bind('mouseup', function(){
                $(this).closest('ul')
                    .css('overflow', '');
            });
    });
</script>