<table class="form-table afflc-metabox-class" id="afflc-metabox0">
    <tbody>
        <tr>
            <th scope="row" id="cloaklinklabel">Short Link(*)</th>
            <td><?php echo home_url(); ?>/<input id="cloaklinkinput0" name="cloaklinkinput0" type="text" style="width:30%" value="" ></td>
        </tr>
        <tr>
            <th scope="row" id="Afflinklabel">Affiliate Link(*)</th>
            <td><input id="afflinkinput0" name="afflinkinput0" type="text" style="width:60%" value="" ></td>
        </tr>
        <tr>
            <th scope="row" id="autoshortlinklabel">Auto Replace Affiliate Link to Short Link</th>
            <td><input name="autoshortlink0" id="autoshortlink0" value="yes" type="checkbox" checked="checked" ></td>
        </tr>
        <tr>
            <th scope="row" id="titlelabel">Title</th>
            <td><input id="titleinput0" name="titleinput0" type="text" style="width:60%" value="" ></td>
        </tr>
    </tbody>
</table> 
<hr/>

<div id="afflcmetaboxflag"></div>

<?php wp_enqueue_script( 'jquery' ); ?>
<script type="text/javascript">
    function afflc_addmorelink()
    {
        var addnum = jQuery(".afflc-metabox-class").size();
        if (addnum>0) jQuery("#afflc_removelink_button").css("visibility","visible");
       
        var clonetable=jQuery("#afflc-metabox0").clone();
        clonetable.attr("id","afflc-metabox"+addnum );
        
        clonetable.find('#cloaklinkinput0').attr("value","" );
        clonetable.find('#afflinkinput0').attr("value","" );
        clonetable.find('#autoshortlink0').attr("checked","checked" );
        clonetable.find('#titleinput0').attr("value","" );

        clonetable.find('#cloaklinkinput0').attr("name","cloaklinkinput"+addnum );
        clonetable.find('#afflinkinput0').attr("name","afflinkinput"+addnum );
        clonetable.find('#autoshortlink0').attr("name","autoshortlink"+addnum );
        clonetable.find('#titleinput0').attr("name","titleinput"+addnum );
 
        clonetable.find('#cloaklinkinput0').attr("id","cloaklinkinput"+addnum );
        clonetable.find('#afflinkinput0').attr("id","afflinkinput"+addnum );
        clonetable.find('#autoshortlink0').attr("id","autoshortlink"+addnum );
        clonetable.find('#titleinput0').attr("id","titleinput"+addnum );

        
        jQuery("#afflcmetaboxflag").before( clonetable );
        jQuery("#afflc-metabox"+addnum).after('<hr/ id="afflcmetaboxhr' + addnum + '">');
        
        jQuery("#afflcaddlinknums").attr("value",addnum+1);
        return false;
    }
    function afflc_removelink()
    {
        var removenum = jQuery(".afflc-metabox-class").size() - 1;
        if ( removenum < 2 ) jQuery("#afflc_removelink_button").css("visibility","hidden");
        jQuery("#afflc-metabox" + removenum ).remove();
        jQuery("#afflcmetaboxhr" + removenum ).remove();

        jQuery("#afflcaddlinknums").attr("value",removenum );
        return false;
    }
</script>
<a href="#" class="button" onclick="return afflc_addmorelink();">Add More Link</a>
<a href="#" class="button" id="afflc_removelink_button" onclick="return afflc_removelink();" style="visibility:hidden" >Remove Link</a>

<?php
    class afflinkcloaking_metabox
    {
        function ShowAllLink()
        {
            global $afflctable;
            $results=$afflctable->GetAllLinks();

            foreach( $results as $rowdata )
            {  
               echo('<tr>');

               echo '<td><a class="row-title" href="'.admin_url('admin.php?page=affiliate-link-cloaking/ui_addnewlink.php&edit=').$rowdata->id.'">';
               echo $rowdata->linktitle.'</a>';
               echo '</td>';

               $shortlink=home_url().'/'.$rowdata->cloaklink;
               echo '<td class="column-url"><a href="'.$shortlink.'">'.$shortlink.'</td>';
               echo '<td class="column-url"><a href="'.$rowdata->afflink.'">'.$rowdata->afflink.'</td>';

               echo('</tr>');
            }

        }

        function VertifyPerLink()
        {
            $perlink = get_option( 'permalink_structure' );
            if ( $perlink == "" )
            {
               $purllink=admin_url('options-permalink.php');
               echo ('<div id="message" style="background-color:#FFEBE8; border-style:solid; border-width:1px; border-color:#CC0000;padding-left:10px;padding-right:10px;margin-top:5px"><p>You must set the "Permalinks" first to use affiliate link cloaking. Make sure it is not "Default". <a href="'.$purllink.'">Here is Permalink Settings</a></p></div>');
            }

        }

        function afflc_GetMessage()
        { 
            global $wpdb;
 
            $lastmsgvar = $wpdb->prefix."afflc_lastmsg";
            $lastgetmsg = get_option( $lastmsgvar ); 

            if ( $lastgetmsg != "" ) echo ( $lastgetmsg );
        }
               
    }

    global $g_afflc_metabox;
    $g_afflc_metabox=new afflinkcloaking_metabox();  
?>
<p></p>
<?php global $g_afflc_metabox; $g_afflc_metabox->VertifyPerLink(); ?>
<table class="widefat" cellspacing="0" id="affviewalltable">
    <thead>
        <tr>
            <th scope="col" id="headlinktitle">Link Title</th>
	    <th scope="col" id="headcloakinglink">Short Link</th>
	    <th scope="col" id="headafflink">Affiliate Link</th>        
	</tr>
    <thead>
    
    <tfoot>
        <tr>
	    <th scope="col" id="footlinkname">Link Title</th>
	    <th scope="col" id="footcloakinglink">Short Link</th>
	    <th scope="col" id="footafflink">Affiliate Link</th>
        </tr>
    </tfoot>
    
    <tbody>
        <?php global $g_afflc_metabox; $g_afflc_metabox->ShowAllLink(); ?>
    </tbody>
</table>
<input id="afflcaddlinknums" name="afflcaddlinknums" type="text" style="visibility:hidden" value="1" >
