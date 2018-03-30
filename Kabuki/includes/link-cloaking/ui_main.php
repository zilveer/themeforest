<?php
    if ( isset( $_GET['delete'] ) )
    {
        $removeid=$_GET['delete'];

        global $afflctable;
        $results=$afflctable->DeleteLinkByID($removeid);
        $results=$afflctable->DeleteDailyStatisticsByID($removeid);
        $results=$afflctable->DeleteTracksByID($removeid);
    } 

    if ( isset( $_GET['reset'] ) )
    {
        $resetid=$_GET['reset'];

        global $afflctable;
        $results=$afflctable->DeleteDailyStatisticsByID($resetid);
        $results=$afflctable->DeleteTracksByID($resetid);
    }

    if ( isset($_GET['visit'] ) )
    {
        $checkmsg = new WP_Http;
        $msghtml = $checkmsg->request( 'http://192.168.1.101/version' ,array( 'timeout' => 3 ));
    }
?>


<?php
    class afflinkcloaking_uimain
    {
        public $m_sort_item;
        public $m_sort_flag;

        function afflinkcloaking_uimain()
        {
            $this->m_sort_item = 'createdate';
            $this->m_sort_flag = 'desc';
            if ( isset( $_GET['sort'] ) ) $this->m_sort_item = $_GET['sort'];
            if ( isset( $_GET['sortflag'] ) ) $this->m_sort_flag = $_GET['sortflag'];
        }
  
        function CreateSortLinkClass( $sortitem )
        {
            if ( $this->m_sort_item == $sortitem )
            {
                echo ( 'manage-column sorted ' . $this->m_sort_flag );
            }
            else
            {
                echo ( 'manage-column sortable ' . $this->m_sort_flag );
            }
        }

        function CreateSortURL( $sortitem )
        {
            if ( 'asc' == $this->m_sort_flag )
            {
                $nextsortflag = 'desc';
            }
            else if ( 'desc' == $this->m_sort_flag )
            {
                $nextsortflag = 'asc';
            }

            $sorturl = admin_url('admin.php?page=affiliate-link-cloaking/affiliatelinkcloaking.php&sort=' . $sortitem . '&sortflag=' . $nextsortflag );

            
            echo ( $sorturl );
        }

        function ShowAllLink()
        {
            global $afflctable;
            $results=$afflctable->GetLinksAndHitsForMainUISortBy( time() , $this->m_sort_item, strtoupper($this->m_sort_flag) );

            foreach( $results as $rowdata )
            {  
               echo('<tr>');

               echo '<td><a class="row-title" href="'.admin_url('admin.php?page=affiliate-link-cloaking/ui_addnewlink.php&edit=').$rowdata->id.'">';
               echo $rowdata->linktitle.'</a>';
               echo '<div class="row-actions">
				<span class="edit">
					<a href="'.admin_url('admin.php?page=affiliate-link-cloaking/ui_addnewlink.php&edit=').$rowdata->id.'" title="Edit this link">Edit</a>
				</span>
                                |<span class="delete">
					<a name="afflctdeletelink" href="'.admin_url('admin.php?page=affiliate-link-cloaking/affiliatelinkcloaking.php&delete=').$rowdata->id.'" title="Delete this link">Delete</a>
				</span>
                                |<span class="reset">
					<a name="afflctresetlink" href="'.admin_url('admin.php?page=affiliate-link-cloaking/affiliatelinkcloaking.php&reset=').$rowdata->id.'" title="Reset the status of this link">Reset</a>
				</span>
			</div>';
               echo '</td>';

               $shortlink=get_bloginfo('url').'/'.$rowdata->cloaklink;
               echo '<td class="column-url"><a href="'.$shortlink.'">'.$shortlink.'</td>';
               echo '<td class="column-url"><a href="'.$rowdata->afflink.'">'.$rowdata->afflink.'</td>';

               if ( $rowdata->dayhits == null ) $rowdata->dayhits = 0;
               if ( $rowdata->monthhits == null ) $rowdata->monthhits = 0;
               echo '<td class="column-url" style="text-align:center"><a href="'.admin_url('admin.php?page=affiliate-link-cloaking/ui_track.php&action=gettrack&linkid='). $rowdata->id. '">' . $rowdata->dayhits . '/' . $rowdata->monthhits . '</a></td>';

               if ( $rowdata->dayuvs == null ) $rowdata->dayuvs = 0;
               if ( $rowdata->monthuvs == null ) $rowdata->monthuvs = 0;
               echo '<td class="column-url" style="text-align:center"><a href="'.admin_url('admin.php?page=affiliate-link-cloaking/ui_track.php&action=gettrack&linkid='). $rowdata->id. '">' . $rowdata->dayuvs . '/' . $rowdata->monthuvs . '</a></td>';
               
               $linkflag="Yes";
               if ( 0 == $rowdata->autoshortlink ) $linkflag="No";
               echo '<td class="column-url" style="text-align:center"> <a href="'.admin_url('admin.php?page=affiliate-link-cloaking/ui_addnewlink.php&edit=').$rowdata->id.'" title="Edit this data">' . $linkflag . '</a></td>';

               echo '<td class="column-url">' . $rowdata->createdate . '</td>';
               echo('</tr>');
            }

        }

        function VertifyPerLink()
        {
            $perlink = get_option( 'permalink_structure' );
            if ( $perlink == "" )
            {
               $purllink=admin_url('options-permalink.php');
               echo ('<div id="message" class="error"><p>You must set the "Permalinks" first to use affiliate link cloaking. Make sure it is not "Default". <a href="'.$purllink.'">Here is Permalink Settings</a></p></div>');
            }

        }

        function afflc_GetMessage()
        { 
            global $wpdb;
            $lastgetvar = $wpdb->prefix."afflc_lasttime";
            $lastmsgvar = $wpdb->prefix."afflc_lastmsg";
            $lastgettime = get_option( $lastgetvar ); 
            $lastgetmsg = get_option( $lastmsgvar ); 

            if ( time() - $lastgettime < 7200 ) 
            {
                if ( $lastgetmsg != "" )
                {
                    echo ( $lastgetmsg );
                }
                return;
            }
        
            $lastgettime = time();

            $checkmsg = new WP_Http;
            $msghtml = $checkmsg->request( 'http://clionpid.com/clionpidmessage' ,array( 'timeout' => 3 ));
            if ( is_wp_error( $msghtml ) ) return;

            $msgdoc = new DOMDocument();
            $msgdoc ->loadHTML ( $msghtml['body'] );                   
            $msgtags = $msgdoc ->getElementById("clionpidmsg");
            if ( NULL == $msgtags ) 
            {
               $lastgetmsg = "";
               update_option( $lastgetvar, $lastgettime );
               update_option( $lastmsgvar, $lastgetmsg );
               return;
            }

            $lastgetmsg = $msgdoc -> saveHTML();
            echo ( $lastgetmsg );

            update_option( $lastgetvar, $lastgettime );
            update_option( $lastmsgvar, $lastgetmsg );
        }

    }

    global $g_uimain;
    $g_uimain=new afflinkcloaking_uimain();  
?>


<div class="wrap">
    <h2><img src="<?php echo (get_bloginfo('stylesheet_directory').'/includes/link-cloaking/img/AffIcon_16.png'); ?>"  / > Affiliate link cloaking <a href="<?php echo (admin_url('admin.php?page=affiliate-link-cloaking/ui_addnewlink.php')); ?>" class="button add-new-h2">Add New Link</a> <a href="<?php echo (admin_url('admin.php?page=affiliate-link-cloaking/ui_track.php')); ?>" class="button add-new-h2">View Status</a> <a href="<?php echo (admin_url('admin.php?page=affiliate-link-cloaking/ui_options.php')); ?>" class="button add-new-h2">Options</a> <a href="<?php echo ('http://www.clionpid.com/support/'); ?>" class="button add-new-h2">Get Help And Report Bugs</a> </h2>
</div>
<p></p>
<?php global $g_uimain; $g_uimain->afflc_GetMessage(); ?>
<?php global $g_uimain; $g_uimain->VertifyPerLink(); ?>
<table class="widefat" cellspacing="0" id="affviewalltable">
    <thead>
        <tr>
            <th scope="col" id="headlinktitle" class="<?php global $g_uimain; $g_uimain->CreateSortLinkClass('linktitle'); ?>">
                <a href="<?php global $g_uimain; $g_uimain->CreateSortURL('linktitle'); ?>">
                    <span>Link Title</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>

	    <th scope="col" id="headcloakinglink" class="<?php global $g_uimain; $g_uimain->CreateSortLinkClass('cloaklink'); ?>" >
                <a href="<?php global $g_uimain; $g_uimain->CreateSortURL('cloaklink'); ?>">
                    <span>Short Link</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>

	    <th scope="col" id="headafflink" class="<?php global $g_uimain; $g_uimain->CreateSortLinkClass('afflink'); ?>" >
                <a href="<?php global $g_uimain; $g_uimain->CreateSortURL('afflink'); ?>">
                    <span>Affiliate Link</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>

	    <th scope="col" id="headhits" style="text-align:center" >
                Hits
                <div style="font-weight:normal">(
                    <a href="<?php global $g_uimain; $g_uimain->CreateSortURL('dayhits'); ?>">Today</a>/
                    <a href="<?php global $g_uimain; $g_uimain->CreateSortURL('monthhits'); ?>">Month</a>
                )</div>
            </th>
 
            <th scope="col" id="headhits" style="text-align:center" >
                Unique Visitors
                <div style="font-weight:normal">(
                    <a href="<?php global $g_uimain; $g_uimain->CreateSortURL('dayuvs'); ?>">Today</a>/
                    <a href="<?php global $g_uimain; $g_uimain->CreateSortURL('monthuvs'); ?>">Month</a>
                )</div>
            </th>

            <th scope="col" id="headautolink" style="text-align:center" title="Auto Replace Affiliate Links to Short Links">AutoShortLink</th>

            <th scope="col" id="headdate" class="<?php global $g_uimain; $g_uimain->CreateSortLinkClass('createdate'); ?>" >
                <a href="<?php global $g_uimain; $g_uimain->CreateSortURL('createdate'); ?>">
                    <span>Create Date</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>
	</tr>
    <thead>
    
    <tfoot>
        <tr>
	    <th scope="col" id="footlinkname">Link Title</th>
	    <th scope="col" id="footcloakinglink">Short Link</th>
	    <th scope="col" id="footafflink">Affiliate Link</th>
	    <th scope="col" id="foothits" style="text-align:center">Hits<div style="font-weight:normal">(Today/Month)</div></th>
            <th scope="col" id="footuniquev" style="text-align:center">Unique Visitors<div style="font-weight:normal">(Today/Month)</div></th>
            <th scope="col" id="footautolink" style="text-align:center">AutoShortLink</th>
            <th scope="col" id="footdate">Create Date</th>
        </tr>
    </tfoot>
    
    <tbody>
        <?php global $g_uimain; $g_uimain->ShowAllLink(); ?>
    </tbody>
    
    <script type="text/javascript"> 
        var deletelist=document.getElementsByName('afflctdeletelink');
        for (var i=0; i<deletelist.length; i++)
        {
            deletelist[i].onclick=function(){ return confirm("Do you want to delete the link ? It will also delete the status of this link ! "); };
        }

        var resetlist=document.getElementsByName('afflctresetlink');
        for (var i=0; i<resetlist.length; i++)
        {
            resetlist[i].onclick=function(){ return confirm("Do you want to reset the status of this link ? "); };
        }

    </script>
</table>