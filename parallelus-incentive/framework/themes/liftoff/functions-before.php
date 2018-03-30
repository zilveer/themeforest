<?php
/**
 * Load Before Framework's functions.php
 * -----------------------------------------------------------------------------------------------
 *
 * Called by the hook: do_action( 'functions_before' ); 
 * 
 * Child theme's load the functions.php file before the parent (framework) functions.php file. 
 * There may be times you need to load functions directly at the beginning or end of the main
 * framework functions.php file. For these situations the hooks "functions_before" and 
 * "functions_after" were created. The famework will also include the files "functions-before.php"
 * and "functions-after.php" into these hooks by default. 
 * 
 * These files are completely optional in the framework child themes. If you are not using them
 * they can safely be deleted. 
 * 
 */