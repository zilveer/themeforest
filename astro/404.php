<?php 
  get_header(); 
?>
<div id="centered_block" class="prk_inner_block columns centered main_no_sections">
  <div id="main_block" class="row">
      <div id="content">
        	<div id="main" class="main_no_sections prk_theme_page error_404">
          	<div class="single_page_title">
                  <h1 class="header_font bd_headings_text_shadow zero_color huge">
                    404
                </h1>
                <h2 class="header_font active_text_shadow not_zero_color">
                    <?php 
                          echo $prk_translations['404_title_text'];
                     ?>
                </h2>
       		</div>
          	<div class="columns row twelve centered prk_centered_div">
              <div class="simple_line header_divider three columns centered"></div>
              <h6 class="big four_desc">
  				      <?php 
                    echo $prk_translations['404_body_text'];
                ?>
              </h6>
           	</div>
        	</div>
      </div>
  </div>
</div>
<?php get_footer(); ?>