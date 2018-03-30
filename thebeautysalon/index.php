<?php
/** Index Page
  *
  * This file immediately loads blueprint.php which is the
  * gateway to the Elderberry Blueprint Class. This file is
  * required so WordPress can add the template into the list
  * of templates for the admin.
  *
  * The index page - by default - shows the latest posts from
  * you website. It is also a fallback file for many other
  * pages, which are not specified separately.
  *
  * @package The Beauty Salon
  *
  */


get_header();

include( 'blueprint.php' );

get_footer();

?>