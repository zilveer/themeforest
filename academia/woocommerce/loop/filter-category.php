<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 12/17/15
 * Time: 3:16 PM
 */
$taxonomy = array(
    'product_cat',
);
$g5plus_options = G5Plus_Global::get_options();
$is_display_count = true;
if(isset($g5plus_options['filter_archive_product_start_date']) && $g5plus_options['filter_archive_product_start_date']=='1'){
    $is_display_count = false;
}

$args = array(
    'orderby'    => 'title',
    'order'      => 'ASC',
    'pad_counts' => true,
    'hide_empty' => true,
);
$terms = get_terms($taxonomy, $args);
$current_term = get_queried_object();
$archive_link = get_post_type_archive_link('product');
$view_type = '';
if(isset($_REQUEST['view'])){
    $view_type = $_REQUEST['view'];
    $archive_link.= '?view='.$view_type;
}else{
    $view_type = G5Plus_Global::get_option('show_archive_product_view_style','');
}
?>
<div class="filter-category-wrap">
    <span class="w-cat">
        <label>
            <select>
                <option value="<?php echo esc_url($archive_link); ?>"><?php esc_html_e('All courses', 'g5plus-academia'); ?></option>
                <?php foreach($terms as $term):
                    $selected = '0';
                    if(!empty($current_term->slug) and $term->slug == $current_term->slug){
                        $selected = '1';
                    } else {
                        $selected = '0';
                    }
                    ?>
                    <option value="<?php echo esc_url(get_term_link($term)); ?>" <?php if($selected == '1'){ ?>selected<?php } ?>>
                        <?php if($is_display_count) {
                                echo wp_kses_post($term->name . ' ( ' . $term->count . ' ) ');
                            }else{
                                echo wp_kses_post($term->name);
                            }
                        ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
    </span>
    <div class="view-switcher">
        <?php esc_html_e('VIEW BY','g5plus-academia') ?>
        <a data-rel="grid" class="<?php if($view_type=='' || $view_type=='view-grid' ){ echo 'active';} ?>" data-unrel="list"  href="javascript:;"><i class="fa fa-th"></i></a>
        <a data-rel="list" class="<?php if($view_type=='view-list'){ echo 'active';} ?>" data-unrel="grid"  href="javascript:;"><i class="fa fa-th-list"></i></a>
    </div>
</div>
