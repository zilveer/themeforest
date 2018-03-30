<?php

  header('HTTP/1.1 404 Not Found');
  header('Status: 404 Not Found');

  get_template_part( 'template', 'archives' );

?>