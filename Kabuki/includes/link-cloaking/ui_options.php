<?php
    class afflinkcloaking_uioption
    {
        public $m_saveflag;

        public $m_nofollow;
        public $m_metabox;

        function afflinkcloaking_uioption()
        {
            global $afflctable;

            if ( isset( $_GET['save'] ) )
            {
                $this->m_saveflag= true; 

                $this->m_nofollow="No";
                $this->m_metabox="No";
                if ( isset($_POST['nofollow_option']) ) $this->m_nofollow=$_POST['nofollow_option'];
                if ( isset($_POST['metabox_option']) ) $this->m_metabox=$_POST['metabox_option'];

                $afflc_options=$afflctable->afflinkcloaking_option_set( $this->m_nofollow, $this->m_metabox );
            }
            else
            {
                $this->m_saveflag= false;
 
                $afflc_options=$afflctable->afflinkcloaking_option_get();

                $this->m_nofollow= $afflc_options['nofollow'];  
                $this->m_metabox = $afflc_options['metabox']; 
            }
            
        }
        
        function AffCreateFormAction()
        {
            $posturl=admin_url('admin.php?page=affiliate-link-cloaking/ui_options.php&amp;save=true'); 
            echo ($posturl);
        }
       
        function ShowUpdateMsgbox()
        {
            if ( $this->m_saveflag ) echo ('<div class="updated"><p>Options updated successfully.</p></div>');
        }

        function ShowNofollowOption()
        {
            if ( "yes" == $this->m_nofollow ) echo ( 'checked="checked"' );
        }
        
        function ShowMetaboxOption()
        {
            if ( "yes" == $this->m_metabox ) echo ( 'checked="checked"' );
        }

    }

    global $g_uioption;
    $g_uioption=new afflinkcloaking_uioption();
?>

<div class="wrap">
    <h2><img src="<?php echo (get_bloginfo('stylesheet_directory').'/includes/link-cloaking/img/AffIcon_16.png'); ?>"  / > Affiliate link cloaking : Options <a href="<?php echo (admin_url('admin.php?page=affiliate-link-cloaking/affiliatelinkcloaking.php')); ?>" class="button add-new-h2">View All Links</a></h2>
</div>
<?php global $g_uioption; $g_uioption->ShowUpdateMsgbox(); ?>
<p></p>
<form action="<?php global $g_uioption; $g_uioption->AffCreateFormAction(); ?>" method="post">
    <table class="form-table">
        <tbody>
             <tr>
                 <td><input name="metabox_option" id="metabox_option" value="yes" type="checkbox" <?php global $g_uioption; $g_uioption->ShowMetaboxOption(); ?> > &nbsp;&nbsp; Show control panel in post/page edit page. </td>
             </tr>
        </tbody>
    </table>
    
    <p></p>
    <p><input name="Update Options" class="button-primary" value="Update Options" type="submit"></p>
    
</form>