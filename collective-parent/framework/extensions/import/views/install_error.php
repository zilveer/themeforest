<div class="install">
<p>
<?php
if ( is_wp_error(  $import_file ) )
{
    echo '<span>';
    _e( 'Failed to import XML file', 'wordpress-importer' );
    echo '</span><br />' . $import_file->get_error_message();
    echo '<br />';
}
?>
</p>
</div>