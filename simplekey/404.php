<?php 
global $VAN;
get_header();
?>
<div id="container">
    <section id="content" class="page-area">
       <div class="wrapper">
           <header class="title">
              <h1><?php esc_html_e('404 Error','SimpleKey');?></h1>
              <p><?php esc_html_e('Is this somewhat embarrassing?','SimpleKey');?></p>
           </header>
           
           <div class="line"></div>
           <div class="entry">
             <div class="error404_info"><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps the page not exsit or it was removed by administrator.<br/>Please try the following:','SimpleKey');?></div>
             <div class="column one_half">
               <a href="<?php echo home_url();?>" class="van_small_btn" style="float:right;margin:auto;background:#55ac4a;color:#fff;"><?php esc_html_e('Return to the Homepage','SimpleKey');?></a>     
             </div>
             <div class="column one_half last">
                <a href="mailto:<?php echo $VAN['email'];?>" class="van_small_btn" style="float:none;margin:auto;background:#F90;color:#fff;"><?php esc_html_e('Report to webmaster','SimpleKey');?></a>   
             </div>
           </div>
       </div>
    </section>
</div>
<?php get_footer();?>