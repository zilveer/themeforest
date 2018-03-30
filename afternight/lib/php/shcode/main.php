<div id="notify">
	<p class="cosmo-box tick" style="margin-left: 0px;"><span class="cosmo-ico"></span>Shortcode was inserted</p>
</div>
<div id="error_message">
	<p class="cosmo-box error" style="margin-left: 0px;"><span class="cosmo-ico"></span>Sorry, something went wrong.</p>
</div>
<div class="shcode-tabber" >
    <ul class="tabs" id="shmenu">    
        <li id="shtemplate" class="current"><a href="javascript:void(0)"><?php _e( 'Columns' , 'cosmotheme' ); ?></a></li>
        <li id="shbutton" ><a href="javascript:void(0)"><?php _e( 'Button' , 'cosmotheme' ); ?></a></li>
        <li id="tabs" ><a href="javascript:void(0)"> <?php _e( 'Tabs &amp; Toggles' , 'cosmotheme' ); ?></a></li>
        <li id="box" ><a href="javascript:void(0)"><?php _e( 'Info Box' , 'cosmotheme' ); ?></a></li>
        <li id="devider" ><a href="javascript:void(0)"><?php _e( 'Typography' , 'cosmotheme' ); ?></a></li>
        <li id="contact" ><a href="javascript:void(0)"><?php _e( 'Contact form' , 'cosmotheme' ); ?></a></li>
		<li id="table" ><a href="javascript:void(0)"><?php _e( 'Table' , 'cosmotheme' ); ?></a></li>  
    </ul>
    <div class="panels">    
        <div  id="shtemplate">
            <?php include 'column.php'; ?>
        </div>
        <div id="shbutton" class="panel none">
            <?php include 'button.php'; ?>
        </div>
        <div id="tabs" class="panel none">
            <?php include 'tabs.php'; ?>
        </div>
        <div id="box" class="panel none">
            <?php include 'box.php'; ?>
        </div>
        <div id="devider" class="panel none">
            <?php include 'devider.php'; ?>
        </div>
        <div id="contact" class="panel none">
            <?php include 'contact.php'; ?>
        </div>
		<div id="table" class="panel none">
            <?php include 'table.php'; ?>
        </div>
    </div>
</div>
