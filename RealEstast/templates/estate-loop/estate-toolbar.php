<?php
$_curUrl = get_pagenum_link( max( 1, get_query_var('paged') ), false );
$_sortUrl['name'] = add_query_arg('sort','name',$_curUrl);
$_sortUrl['price'] = add_query_arg('sort','price',$_curUrl);
$_curSort = isset($_GET['sort'])?$_GET['sort']:'';
$_curDir = isset($_GET['dir'])?$_GET['dir']:'desc';
$_sortUrl['desc'] = add_query_arg(array('sort'=>$_curSort, 'dir'=>'desc'),$_curUrl);
$_sortUrl['asc'] = add_query_arg(array('sort'=>$_curSort, 'dir'=>'asc'),$_curUrl);
?>
<div class="toolbar">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-6 pull-left">
            <div class="input-group">
                <span class="input-group-addon"><?php _e('Sort by', PGL) ?></span>
                <select class="estate-sort form-control" onchange="(this.options[this.selectedIndex].value!='')?window.location.href=this.options[this.selectedIndex].value:false">
                    <option value="">-<?php _e('Select', PGL)?>-</option>
                    <option value="<?php echo $_sortUrl['name']?>"<?php if($_curSort == 'name') echo ' selected'?>><?php _e('Name', PGL)?></option>
                    <option value="<?php echo $_sortUrl['price']?>"<?php if($_curSort == 'price') echo ' selected'?>><?php _e('Price', PGL)?></option>
                </select>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6 pull-right">
            <div class="input-group pull-right">
                <a class="btn btn-default btn-sm<?php echo ($_curDir=='asc' || $_curSort == '')? ' disabled' : '' ?>" href="<?php echo ($_curDir!='asc')?$_sortUrl['asc']:'' ?>"><i class="fa fa-angle-up"></i></a>
                <a class="btn btn-default btn-sm<?php echo ($_curDir=='desc' || $_curSort == '')? ' disabled' : '' ?>" href="<?php echo ($_curDir=='asc')?$_sortUrl['desc']:'' ?>"><i class="fa fa-angle-down"></i></a>
            </div>
        </div>
    </div>
</div>