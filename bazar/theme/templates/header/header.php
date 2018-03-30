<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $yit_is_header;
$yit_is_header = true;
 
do_action( 'yit_before_logo' ) ?>

<div class="group container">               
	
    <div class="row" id="logo-headersidebar-container">            
    	
        <!-- START LOGO -->
    	<div id="logo" class="group">
    	    <?php
    	    /**
    	     * @see yit_logo
    	     */
    	    do_action( 'yit_logo' ) ?> 
    	</div>
    	<!-- END LOGO -->
    	<?php do_action( 'yit_after_logo' ) ?> 
           
    </div>
</div>       
    	
<div id="nav">
    <div class="container">
    	<?php
    	/**
    	 * @see yit_main_navigation
    	 */
    	do_action( 'yit_main_navigation') ?>
    </div>
	<div class="border borderstrong borderpadding container"></div>
	<div class="border container"></div>
	<div class="border container"></div>
	<div class="border container"></div>
</div>

<?php $yit_is_header = false; ?>