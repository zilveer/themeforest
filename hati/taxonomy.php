<?php

  # if true, is_tax & is_year viewed as folio (else: as journal entries)

  if ( Acorn::get('portfolio-styling') ) 
    get_template_part( 'template', 'dynafolio' );
  else {
    global $is_item_query; $is_item_query = true;
    get_template_part( 'template', 'journal' );
  }

?>