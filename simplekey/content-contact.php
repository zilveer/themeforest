<?php global $VAN;?>

<?php if(!isset($VAN['hide_contact']) || $VAN['hide_contact']==1):?>
<!--Contact Area-->
    <section id="contact" class="page-area<?php if(!isset($VAN['contact_background_color']) || $VAN['contact_background_color']=='' || $VAN['contact_background_color']=='#313131' || $VAN['enable_custom']==0):?> blockbg1<?php endif;?>">
       <div class="wrapper">
           <header class="title">
              <h2><strong><?php if(isset($VAN['contact_title']) && $VAN['contact_title']<>''){echo $VAN['contact_title'];}else{echo 'Contact us';}?></strong></h2>
              <?php if(isset($VAN['contact_sub_title']) && $VAN['contact_sub_title']<>''):?><p><?php echo $VAN['contact_sub_title'];?></p><?php endif;?>
           </header>
           
           <?php get_template_part('content','contactform');?>
           
           <div class="contactinfo">
           <?php if(isset($VAN['contact_custom']) && $VAN['contact_custom']<>''):?>
               <?php echo stripslashes($VAN['contact_custom']);?>
          <?php else:?>
             <?php if(isset($VAN['contact_intro_title']) && $VAN['contact_intro_title']<>''):?>
               <h2><?php echo $VAN['contact_intro_title'];?></h2>
             <?php endif;?>
             <?php if(isset($VAN['contact_content']) && $VAN['contact_content']<>''):?><p><?php echo convert_smilies(stripslashes($VAN['contact_content']));?></p><?php endif;?>
             <div class="contactway">
                <?php if(isset($VAN['name']) && $VAN['name']<>''):?><?php _e('Name:','SimpleKey');?> <?php echo $VAN['name'];?><br/><?php endif;?>
                <?php if(isset($VAN['phone']) && $VAN['phone']<>''):?><?php _e('Phone:','SimpleKey');?> <?php echo $VAN['phone'];?><br/><?php endif;?>
                <?php if(isset($VAN['fax']) && $VAN['fax']<>''):?><?php _e('Fax:','SimpleKey');?> <?php echo $VAN['fax'];?><br/><?php endif;?>
                <?php if(isset($VAN['skype']) && $VAN['skype']<>''):?><?php _e('Skype:','SimpleKey');?> <?php echo $VAN['skype'];?><br/><?php endif;?>
                <?php if(isset($VAN['address']) && $VAN['address']<>''):?><?php _e('Address:','SimpleKey');?> <?php echo $VAN['address'];?><?php endif;?>
             </div>
             
             <?php if(isset($VAN['subscribe_form']) && $VAN['subscribe_form']<>''):?>
             <div class="subscribe">
                <?php if(isset($VAN['subscribe_intro_title']) && $VAN['subscribe_intro_title']<>''):?>
                <h2><?php echo $VAN['subscribe_intro_title'];?></h2>
                <?php endif;?>
                <p>
                  <?php echo stripslashes($VAN['subscribe_form']);?>
                </p>
              </div>
              <?php endif;?>
             
              <?php echo van_social();?>
           <?php endif;?>
           </div>
       </div>
    </section>
<?php endif;?>
