<?php



function ql_export_page () {
	global $ql_options;

	global $QLC;

	$domain = isset ( $_GET [ 'domain' ] ) ? $_GET [ 'domain' ] : null;
	$domain_url = null === $domain ? "" : "&domain=" . urlencode ( $domain );
	$order_by = isset ( $_GET [ 'order_by' ] ) ? $_GET [ 'order_by' ] : $ql_options [ "default_order_by" ];
	$order_by_url = null === $order_by ? "" : "&order_by=" . urlencode ( $order_by );

	$ql_export_data = "";
	$ql_all = $QLC -> get_from_db ( $domain, $order_by );
	if ( $ql_all ) {
		// work-around for PHP 5.2 not handling the "new" property correctly
		$newfield = "new";
		foreach ( $ql_all as $row ) {
			$ql_export_data .= "{$row->old}||{$row->$newfield}||{$row->domain}\n";
		}
	}
	


?>	
	<div class="wrapper">
	<h2><?php _e ( "Quick Localisation", "QL" ); ?> - <?php _e ( "Export", "QL" ); ?></h2>
	<p><?php _e ( "Filter by domain:", "QL" ); ?> 
	<?php 
	$list_of_saved_domains = $QLC -> get_list_of_saved_domains ();
	$filter_line = "";
	$all_count = 0;
	foreach ( $list_of_saved_domains as $row ) {
		$filter_line .= " | ";
		$filter_line .= $domain === $row->domain ? ( $row->domain ? $row->domain : "empty" ) : '<a href="admin.php?page=ql-export&domain=' . urlencode ( $row->domain )  . $order_by_url . '">' . ( $row->domain ? $row->domain : "empty" ) . '</a>';
		$filter_line .= " (" . $row->count . ")";
		$all_count += $row->count;
	}

	$filter_line = ( null === $domain ? __ ( "All", "QL" ) : '<a href="admin.php?page=ql-export' . $order_by_url . '">' . __ ( "All", "QL" ) . '</a>' ) . " (" . $all_count . ")" . $filter_line;
	echo $filter_line;
	?>
	<br />
	<?php _e ( "Sort by:", "QL" );
	echo " " . ( "id" == $order_by || ! $order_by ? __ ( 'Addition time', "QL" ) : '<a href="admin.php?page=ql-export' . $domain_url . '&order_by=id">' . __ ( 'Addition time', "QL" ) . '</a>' );
	echo " | " . ( "old" == $order_by ? __ ( 'Old', "QL" ) : '<a href="admin.php?page=ql-export' . $domain_url . '&order_by=old">' . __ ( 'Old', "QL" ) . '</a>' );
	echo " | " . ( "new" == $order_by ? __ ( 'New', "QL" ) : '<a href="admin.php?page=ql-export' . $domain_url . '&order_by=new">' . __ ( 'New', "QL" ) . '</a>' );
	?>
	</p>
	<p><textarea name="ql_export_data" rows="20" cols="100"><?php echo esc_textarea ( $ql_export_data ); ?></textarea></p>
	<p><?php echo sprintf ( __ ( "Exported %d row(s).", "QL" ), count ( $ql_all ) ); ?></p>
	<p><?php _e ( "Simply copy-paste data for your back up!", "QL" ); ?></p>
	<p><?php _e ( "Format:", "QL" ); ?></p>
	<p><b><?php _e ( "Old", "QL" ); ?> || <?php _e ( "New", "QL" ); ?> || <?php _e ( "Domain", "QL" ); ?></b></p>

	</div>

<?php
}



?>