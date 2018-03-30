<?php
/** Date Archive Page
  *
  * This file immediately loads blueprint.php which is the
  * gateway to the Elderberry Blueprint Class. This file is
  * required so WordPress can add the template into the list
  * of templates for the admin.
  *
  * The date archives show posts belonging to a specific period
  * in time. Daily archives, monthly archives and yearly archives
  * can be shown.
  *
  * @package The Beauty Salon
  *
  */


get_header();

include( 'blueprint.php' );

get_footer();

?>