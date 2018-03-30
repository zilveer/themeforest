<?php if(!defined('ABSPATH')) { return; }
/*
 * Build and display the element
 */
	$options = (isset($GLOBALS['options']['accordion']) ? $GLOBALS['options']['accordion'] : null);
	if(empty($options)){
		return;
	}

	$elm_classes=array();
    $elm_classes[] = $uid = $this->data['uid'];
    $elm_classes[] = zn_get_element_classes($options);

    $attributes = zn_get_element_attributes($options);

    $color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
    $elm_classes[] = 'acc-sch--'.$color_scheme;
    $elm_classes[] = 'element-scheme--'.$color_scheme;


	$accTitle = '';
	$accStyle = 'default-style';
	if(isset($options['acc_title']) && !empty($options['acc_title'])){
		$accTitle = $options['acc_title'];
	}
	if(isset($options['acc_style'])){
		$accStyle = $options['acc_style'];
	}
	$elm_classes[] = 'zn-acc--'.$accStyle;
?>

<div class="zn_accordion_element <?php echo implode(' ', $elm_classes); ?>" <?php echo $attributes; ?>>
	<?php
		if(! empty($accTitle)){
			echo '<h3 class="acc-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $accTitle . '</h3>';
		}

		$acc_id = 1;
		$i = 0;
		$uniq   = zn_uid();
		$acc_js_el_id = "accordion_{$uniq}_{$acc_id}";

		echo '<div id="'.$acc_js_el_id.'" class="acc--'.$accStyle.' '.( $accStyle == 'style3' ? 'text-custom-parent':'' ).' panel-group">';

		if ( isset ( $options['accordion_single'] ) && is_array( $options['accordion_single'] ) ) {
			foreach ( $options['accordion_single'] as $acc )
			{
				$colapsed = ((isset($acc['acc_colapsed']) && $acc['acc_colapsed'] == 'yes') ? 'in' : '');
				$sTitle = (isset($acc['acc_single_title']) ? $acc['acc_single_title'] : '');
				$titleActive = ($colapsed ? '' : 'collapsed');

				// Functionality
				$acc_behaviour = '';
				if( isset($options['acc_behaviour']) && $options['acc_behaviour'] == 'acc' ){
					$acc_behaviour = ' data-parent="#'.$acc_js_el_id.'" ';
				}

				echo '<div class="panel acc-group">';

						echo '<div class="acc-panel-title">';
							echo '<a data-toggle="collapse" '.$acc_behaviour.' href="#acc' . $uniq . '' . $acc_id . '" class="acc-tgg-button '.( $accStyle != 'style3' ? 'text-custom':'' ). ' '. $titleActive .'  text-custom-child-hov">';
								echo $sTitle . '<span class="acc-icon"></span>';
							echo '</a>';
						echo '</div>';


					echo '<div id="acc' . $uniq . '' . $acc_id . '" class="acc-panel-collapse collapse ' . $colapsed .'">';
						echo '<div class="acc-content row zn_columns_container zn_content" data-droplevel="1">';

	                        // Convert the old content to PB elements
	                        if( empty( $this->data['content'][$i] ) && ! empty( $acc['acc_single_desc'] ) ){
	                            $textbox = ZNPB()->add_module_to_layout( 'TH_TextBox', array( 'stb_content' => $acc['acc_single_desc'] ) );
	                            $column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array( $textbox ), 'col-sm-12' );
	                            $this->data['content'][$i] = array ( $column );
	                        }


                            if ( empty( $this->data['content'][$i] ) ) {
                                $column = ZNPB()->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
                                $this->data['content'][$i] = array ( $column );
                            }

                            if ( !empty( $this->data['content'][$i] ) ) {
                                ZNPB()->zn_render_content( $this->data['content'][$i] );
                            }

						echo '</div>'; // acc-content
					echo '</div>'; // end .acc-panel-collapse

				echo '</div>'; // end .acc-group
				$acc_id ++;
				$i++;
			}
		}
		echo '</div>'; //.panel-group
	?>
</div>
<!-- end // .zn_accordion_element  -->

