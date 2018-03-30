<?php
$title = __( 'Columns', 'wolf' );
$params = array(

	array(
		'id' => 'col',
		'label' => __( 'Size', 'wolf' ),
		'type' => 'select',
		'options' => array(
			'col-6' => __( 'col-6 (one half)', 'wolf' ),
			'col-4' => __( 'col-4 (one third)', 'wolf' ),
			'col-3' => __( 'col-3 (one fourth)', 'wolf' ),
			'col-11' => 'col-11',
			'col-10' => 'col-10',
			'col-9' => 'col-9',
			'col-8' => 'col-8',
			'col-7' => 'col-7',
			'col-5' => 'col-5',
			'col-2' => 'col-2',
			'col-1' => 'col-1',
		),
		'desc' => __( 'A row consists of a series of columns (col-X) that add up to 12.<br>Check the "First" checkbox below if your column is the first of the row<br>and check the "Last" checkbox if your column is the last of the row.', 'wolf' ),
	),

	array(
		'id' => 'first',
		'label' => __( 'First', 'wolf' ),
		'type' => 'checkbox',
	),

	array(
		'id' => 'last',
		'label' => __( 'Last', 'wolf' ),
		'type' => 'checkbox',
	),
);
echo wolf_generate_tinymce_popup( 'wolf_column', $params, $title, true );
