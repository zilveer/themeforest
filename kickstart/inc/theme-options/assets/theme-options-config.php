<?php
function filter_radio_images( $array, $field_id ) {
  
  if ( $field_id == 'theme_layout' ) {
    $array = array(
      array(
        'value'   => 'boxed',
        'label'   => __( 'Boxed', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/layout/boxed.png'
      ),
	  array(
        'value'   => 'boxed-attached',
        'label'   => __( 'Boxed attached', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/layout/boxed-attached.png'
      ),
	  array(
        'value'   => 'full-width',
        'label'   => __( 'Full width', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/layout/full-width.png'
      )
    );
  }  

 if ( $field_id == 'background_pattern' ) {
    $array = array(
      array(
        'value'   => 'pattern_0',
        'label'   => __( 'Pattern', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_0.png'
      ),      
	  array(
        'value'   => 'pattern_1',
        'label'   => __( 'Pattern 1', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_1.png'
      ),
	  array(
        'value'   => 'pattern_2',
        'label'   => __( 'Pattern 2', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_2.png'
      ),
	  array(
        'value'   => 'pattern_3',
        'label'   => __( 'Pattern 3', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_3.png'
      ),
	  array(
        'value'   => 'pattern_4',
        'label'   => __( 'Pattern 4', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_4.png'
      ),
	  array(
        'value'   => 'pattern_5',
        'label'   => __( 'Pattern 5', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_5.png'
      ),
	  array(
        'value'   => 'pattern_6',
        'label'   => __( 'Pattern 6', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_6.png'
      ),
	  array(
        'value'   => 'pattern_7',
        'label'   => __( 'Pattern 7', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_7.png'
      ),
	  array(
        'value'   => 'pattern_8',
        'label'   => __( 'Pattern 8', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_8.png'
      ),
	  array(
        'value'   => 'pattern_9',
        'label'   => __( 'Pattern 9', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_9.png'
      ),
	  array(
        'value'   => 'pattern_10',
        'label'   => __( 'Pattern 10', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_10.png'
      ),
	  array(
        'value'   => 'pattern_11',
        'label'   => __( 'Pattern 11', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_11.png'
      ),
	  array(
        'value'   => 'pattern_12',
        'label'   => __( 'Pattern 12', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_12.png'
      ),
	  array(
        'value'   => 'pattern_13',
        'label'   => __( 'Pattern 13', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_13.png'
      ),
	  array(
        'value'   => 'pattern_14',
        'label'   => __( 'Pattern 14', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_14.png'
      ),
	  array(
        'value'   => 'pattern_15',
        'label'   => __( 'Pattern 15', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_15.png'
      ),
	  array(
        'value'   => 'pattern_16',
        'label'   => __( 'Pattern 16', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_16.png'
      ),
	  array(
        'value'   => 'pattern_17',
        'label'   => __( 'Pattern 17', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_17.png'
      ),
	  array(
        'value'   => 'pattern_18',
        'label'   => __( 'Pattern 18', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_18.png'
      ),	  
	  array(
        'value'   => 'pattern_19',
        'label'   => __( 'Pattern 19', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_19.png'
      ),
	  array(
        'value'   => 'pattern_20',
        'label'   => __( 'Pattern 20', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_20.png'
      ),
	  array(
        'value'   => 'pattern_21',
        'label'   => __( 'Pattern 21', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_21.png'
      ),	  
	  array(
        'value'   => 'pattern_22',
        'label'   => __( 'Pattern 22', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_22.png'
      ),
	  array(
        'value'   => 'pattern_23',
        'label'   => __( 'Pattern 23', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_23.png'
      ),
	  array(
        'value'   => 'pattern_24',
        'label'   => __( 'Pattern 24', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_24.png'
      ),
	  array(
        'value'   => 'pattern_25',
        'label'   => __( 'Pattern 25', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_25.png'
      ),
	  array(
        'value'   => 'pattern_26',
        'label'   => __( 'Pattern 26', 'option-tree' ),
        'src'     => OT_URL . '/assets/images/pattern/pattern_26.png'
      )
	  
    );
  }  
  
  return $array;
  
}
add_filter( 'ot_radio_images', 'filter_radio_images', 10, 2 );
?>