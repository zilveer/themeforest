<?php
    if ( isset( $_POST['addnewlink'] ) )
    {
        $addcloak = $_POST['cloaklinkinput'];
        $addaff = $_POST['afflinkinput'];
        $addtitle = $_POST['titleinput'];
        $addautoshortlink = 0;
        if ( $_POST['autoshortlink'] == 'yes' ) $addautoshortlink = 1;
        if ( $addtitle == '' ) $addtitle=$addcloak;
                
        global $afflctable;
        $results=$afflctable->AddLink($addcloak, $addaff, $addautoshortlink, $addtitle);
        
        wp_redirect(admin_url('admin.php?page=affiliate-link-cloaking/affiliatelinkcloaking.php'),301);
        exit;
    } 

    if ( isset( $_POST['updatelink'] ) )
    {
        $afflc_editid=$_GET['updateid'];
        
        $addcloak=$_POST['cloaklinkinput'];
        $addaff=$_POST['afflinkinput'];
        $addtitle=$_POST['titleinput'];
        $addautoshortlink = 0;
        if ( $_POST['autoshortlink'] == 'yes' ) $addautoshortlink = 1;

        global $afflctable;
        $results=$afflctable->UpdateLinkByID($afflc_editid, $addcloak, $addaff, $addautoshortlink, $addtitle);

        wp_redirect(admin_url('admin.php?page=affiliate-link-cloaking/affiliatelinkcloaking.php'),301);
        exit;
    } 

    class afflinkcloaking_uiaddnew
    {
        public $m_editflag;
        public $m_editlink;

        function afflinkcloaking_uiaddnew()
        {
            $this->m_editflag = false; 

            if ( isset( $_GET['edit'] ) )
            {
                $afflc_editid = $_GET['edit'];
                global $afflctable;
                $this->m_editlink = $afflctable->GetLinkByID($afflc_editid);  
                
                $this->m_editflag = true;  
            } 
            
        }
        
        function AffCreateFormAction()
        {
            $adurl=admin_url('admin.php?page=affiliate-link-cloaking/ui_addnewlink.php'); 
            $posturl=$adurl.'&amp;noheader=true';
        
            if ( isset( $_GET['edit'] ) )
            {
                $posturl=$posturl.'&amp;updateid='.$_GET['edit'];
            }
            echo ($posturl);
        }

        function ShowAffLink()
        {
            if ( !$this->m_editflag ) return;
            echo ( $this->m_editlink->afflink );
        }
        
        function ShowShortLink()
        {
            if ( !$this->m_editflag ) return;
            echo ( $this->m_editlink->cloaklink );
        }

        function ShowLinkTitle()
        {
            if ( !$this->m_editflag ) return;
            echo ( $this->m_editlink->linktitle );
        }

        function ShowAutoShortLink()
        {
            if ( !$this->m_editflag ) echo ( 'checked="checked"' );
            if ( 1 == $this->m_editlink->autoshortlink ) echo ( 'checked="checked"' );
        }

        function ShowSubmitButtonText()
        {
            if ( !$this->m_editflag )
            {
                echo ( 'Add Link' );
            }
            else
            {
                echo ( 'Update Link' );
            }
        }

    }

    global $g_uiaddnew;
    $g_uiaddnew=new afflinkcloaking_uiaddnew();
?>


<div class="wrap">
    <h2><img src="<?php echo (get_stylesheet_directory_uri().'/includes/link-cloaking/img/AffIcon_16.png'); ?>"  / > Affiliate link cloaking : <?php global $g_uiaddnew; $g_uiaddnew->ShowSubmitButtonText(); ?> <a href="<?php echo (admin_url('admin.php?page=affiliate-link-cloaking/affiliatelinkcloaking.php')); ?>" class="button add-new-h2">View All Links</a></h2>
</div>
<p></p>
<form action="<?php global $g_uiaddnew; $g_uiaddnew->AffCreateFormAction(); ?>" method="post">
    <table class="form-table">
        <tbody>
             <tr>
                 <th scope="row" id="cloaklinklabel">Short Link(*)</th>
                 <td><?php echo home_url(); ?>/<input id="cloaklinkinput" name="cloaklinkinput" type="text" style="width:30%" value="<?php global $g_uiaddnew; $g_uiaddnew->ShowShortLink();  ?>" ></td>
             </tr>
             <tr>
                 <th scope="row" id="Afflinklabel">Affiliate Link(*)</th>
                 <td><input id="afflinkinput" name="afflinkinput" type="text" style="width:60%" value="<?php global $g_uiaddnew; $g_uiaddnew->ShowAffLink(); ?>" ></td>
             </tr>
             <tr>
                 <th scope="row" id="autoshortlinklabel">Auto Replace Affiliate Link to Short Link</th>
                 <td><input name="autoshortlink" id="autoshortlink" value="yes" type="checkbox" <?php global $g_uiaddnew; $g_uiaddnew->ShowAutoShortLink(); ?> ></td>
             </tr>
             <tr>
                 <th scope="row" id="titlelabel">Title</th>
                 <td><input id="titleinput" name="titleinput" type="text" style="width:60%" value="<?php global $g_uiaddnew; $g_uiaddnew->ShowLinkTitle(); ?>" ></td>
             </tr>
        </tbody>
    </table>
    
    <p><input name="<?php if(isset($_GET['edit'])) echo('updatelink'); else echo('addnewlink'); ?>" class="button-primary" value="<?php global $g_uiaddnew; $g_uiaddnew->ShowSubmitButtonText(); ?>" type="submit"></p>
    
</form>