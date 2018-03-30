                    <?php 
                        global $prk_astro_options; 
                    ?>
                </div>
                </div>
        </div>
        <div class="clearfix"></div>
        <?php 
            if (isset($prk_astro_options['ganalytics_text'])) {echo "<script>".$prk_astro_options['ganalytics_text']."</script>";} ?>
        <?php wp_footer(); ?>
    </body>
</html>