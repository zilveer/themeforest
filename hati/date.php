<?php

  if ( is_year() ) get_template_part( 'taxonomy' );
  else get_template_part( 'template', 'journal' ); 

?>