<?php
/** Search Page
  *
  * This file immediately loads blueprint.php which is the
  * gateway to the Elderberry Blueprint Class. This file is
  * required so WordPress can add the template into the list
  * of templates for the admin.
  *
  * The search page shows posts which contain the keywords
  * specified by the user.
  *
  * @package The Beauty Salon
  *
  */



get_header();

include( 'blueprint.php' );

get_footer();

?>