<div class="event_nav">
    <img src="<?php bloginfo('stylesheet_directory') ?>/images/colorbox/loading.gif" id="event_menu_loader">
    <ul class="event_nav_bg">
        <li>
            <?php if($j > 3): ?>
                <a class="prev" href="#"><?php _e('more events', $bSettings->getPrefix()); ?></a>
            <?php endif ;?>
        </li>
        <li>
            <?php if($page_event != 0): ?>
                <a class="next" href="#"><?php _e('more events', $bSettings->getPrefix()); ?></a>
            <?php endif ;?>
        </li>
    
    </ul>
    <script type="text/javascript">
                <?php $url = get_stylesheet_directory_uri().'/templates/ajax/paginate_menu.ajax.php'; ?>
                jQuery(function($){

                    
                    $first_element = $('.upcoming_menu');


                    $height = $first_element.height();
                    $height = $height + 22;
                    $first_element.css('top', '-'+$height+'px');  
                    $first_element.css('position', 'absolute');  
                    
                    $(".event_nav_bg a").on("click", function() {

                        var get = "";
                        
                        if($(this).hasClass('prev')) 
                        {
                            // get prev page
                            get = 'prev';
                            page = <?php echo $page_event + 1 ?>;
                        }else {
                            // get next page
                            get = 'next';
                            page = <?php echo $page_event - 1 ?>;
                        }
                        
                        $('#loadingDiv')
                            .hide()  // hide it initially
                            .ajaxStart(function() {
                                $(this).show();
                                alert("hI");
                            })
                            .ajaxStop(function() {
                                $(this).hide();
                            })
                        ;


                        $.ajax({
                            type: "GET",
                            url: "<?php echo $url ?>",
                            data: "page="+page+"&get="+get,
                            beforeSend: function( xhr ) {
                                $('#event_menu_loader').show();
                            }
                        }).done(function( msg ) { 
                            
                            $("#inline_nav").html(msg);
                            $('#event_menu_loader').fadeOut();
                        });
                        return false;
                    });

                });
            </script>

</div>