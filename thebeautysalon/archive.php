<?php
/** General Archive Page
  *
  * This file immediately loads blueprint.php which is the
  * gateway to the Elderberry Blueprint Class. This file is
  * required so WordPress can add the template into the list
  * of templates for the admin.
  *
  * This is a fallback page for those special archives which
  * are not defined. It shows a list of posts belonging to a
  * special set, depending on the URL visited.
  *
  * @package The Beauty Salon
  *
  */


get_header();

include( 'blueprint.php' );

get_footer();

?>
