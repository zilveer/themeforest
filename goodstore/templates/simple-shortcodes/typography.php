<?php

if (jaw_template_get_var('code') == 'code') { ?>
    <code><?php echo jaw_template_get_var('content'); ?></code>
<?php 
}
if (jaw_template_get_var('code') == 'pre') { ?>
    <pre><?php echo jaw_template_get_var('content'); ?></pre>
<?php 
}
if (jaw_template_get_var('code') == 'br') { ?>
    <br />
<?php 
}

