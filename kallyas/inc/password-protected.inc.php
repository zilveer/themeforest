<?php if(! defined('ABSPATH')){ return; }
/**
 * Displays the layout for the password protected post/page/whatever
 */
?>
<div class="container">
<?php
    echo get_the_title();
    echo get_the_content(); /*<-- This will display the password form, not the actual post content */
?>
</div>
