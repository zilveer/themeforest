<?php

add_filter('admin_notices', '_display_mailinglist_notification');

function _display_mailinglist_notification() {
    if (!bfi_get_option('mailinglist-notify')) {
        bfi_update_option('mailinglist-notify', 1);
    } else if (bfi_get_option('mailinglist-notify') < 30) {
        bfi_update_option('mailinglist-notify', bfi_get_option('mailinglist-notify') + 1);
    }
    if (isset($_GET['joined'])) {
        bfi_update_option('mailinglist-notify', 99);
        
        BFIAdminNotificationController::addNotification('
        <style>
        .animated{-webkit-animation-fill-mode:both;-moz-animation-fill-mode:both;-ms-animation-fill-mode:both;-o-animation-fill-mode:both;animation-fill-mode:both;-webkit-animation-duration:1s;-moz-animation-duration:1s;-ms-animation-duration:1s;-o-animation-duration:1s;animation-duration:1s;}
        @-webkit-keyframes bounceIn {
        	0% {
        		opacity: 0;
        		-webkit-transform: scale(.3);
        	}

        	50% {
        		opacity: 1;
        		-webkit-transform: scale(1.05);
        	}

        	70% {
        		-webkit-transform: scale(.9);
        	}

        	100% {
        		-webkit-transform: scale(1);
        	}
        }

        @-moz-keyframes bounceIn {
        	0% {
        		opacity: 0;
        		-moz-transform: scale(.3);
        	}

        	50% {
        		opacity: 1;
        		-moz-transform: scale(1.05);
        	}

        	70% {
        		-moz-transform: scale(.9);
        	}

        	100% {
        		-moz-transform: scale(1);
        	}
        }

        @-o-keyframes bounceIn {
        	0% {
        		opacity: 0;
        		-o-transform: scale(.3);
        	}

        	50% {
        		opacity: 1;
        		-o-transform: scale(1.05);
        	}

        	70% {
        		-o-transform: scale(.9);
        	}

        	100% {
        		-o-transform: scale(1);
        	}
        }

        @keyframes bounceIn {
        	0% {
        		opacity: 0;
        		transform: scale(.3);
        	}

        	50% {
        		opacity: 1;
        		transform: scale(1.05);
        	}

        	70% {
        		transform: scale(.9);
        	}

        	100% {
        		transform: scale(1);
        	}
        }

        .bounceIn {
        	-webkit-animation-name: bounceIn;
        	-moz-animation-name: bounceIn;
        	-o-animation-name: bounceIn;
        	animation-name: bounceIn;
        }
        </style>
        <div class="rate-box" style="
        min-height: 80px;
        border-radius: 4px;
        padding: 20px;
        background: #cef;
        margin-top: 20px;
        color: #555;
        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
        line-height: 21px;
        font-size: 13px;"><img class="animated bounceIn" src="http://gravatar.com/avatar/b5d60b4470879529eb13d9f7ff5302da?size=80" style="float: left; margin-right: 30px; border-radius: 100px; margin-left: 10px;"/><div style="overflow: hidden""><div style="font-weight: bold; margin-top: 31px;
        text-transform: uppercase; margin-bottom: 10px;">Thank you for joining!</div></div></div>', 'custom');
        
    }
    if (bfi_get_option('mailinglist-notify') < 20 || bfi_get_option('mailinglist-notify') > 25) {
        return;
    }
    $redirectUrl = $_SERVER['REQUEST_URI'] 
                 . (stripos($_SERVER['REQUEST_URI'], '?') === false ?
                    "?" : "&")
                 . "joined=1";
    BFIAdminNotificationController::addNotification('
    <script>
    jQuery(document).ready(function($){
    });
    </script>
    <style>
    .animated{-webkit-animation-fill-mode:both;-moz-animation-fill-mode:both;-ms-animation-fill-mode:both;-o-animation-fill-mode:both;animation-fill-mode:both;-webkit-animation-duration:1s;-moz-animation-duration:1s;-ms-animation-duration:1s;-o-animation-duration:1s;animation-duration:1s;}
    @-webkit-keyframes bounceIn {
    	0% {
    		opacity: 0;
    		-webkit-transform: scale(.3);
    	}
	
    	50% {
    		opacity: 1;
    		-webkit-transform: scale(1.05);
    	}
	
    	70% {
    		-webkit-transform: scale(.9);
    	}
	
    	100% {
    		-webkit-transform: scale(1);
    	}
    }

    @-moz-keyframes bounceIn {
    	0% {
    		opacity: 0;
    		-moz-transform: scale(.3);
    	}
	
    	50% {
    		opacity: 1;
    		-moz-transform: scale(1.05);
    	}
	
    	70% {
    		-moz-transform: scale(.9);
    	}
	
    	100% {
    		-moz-transform: scale(1);
    	}
    }

    @-o-keyframes bounceIn {
    	0% {
    		opacity: 0;
    		-o-transform: scale(.3);
    	}
	
    	50% {
    		opacity: 1;
    		-o-transform: scale(1.05);
    	}
	
    	70% {
    		-o-transform: scale(.9);
    	}
	
    	100% {
    		-o-transform: scale(1);
    	}
    }

    @keyframes bounceIn {
    	0% {
    		opacity: 0;
    		transform: scale(.3);
    	}
	
    	50% {
    		opacity: 1;
    		transform: scale(1.05);
    	}
	
    	70% {
    		transform: scale(.9);
    	}
	
    	100% {
    		transform: scale(1);
    	}
    }

    .bounceIn {
    	-webkit-animation-name: bounceIn;
    	-moz-animation-name: bounceIn;
    	-o-animation-name: bounceIn;
    	animation-name: bounceIn;
    }
    </style>
    <div class="rate-box" style="border-radius: 4px;
    padding: 20px;
    background: #cef;
    margin-top: 20px;
    color: #555;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    line-height: 21px;
    font-size: 13px;"><img class="animated bounceIn" src="http://gravatar.com/avatar/b5d60b4470879529eb13d9f7ff5302da?size=80" style="float: left; margin-right: 30px; border-radius: 100px; margin-left: 10px;"/><div style="overflow: hidden""><div style="font-weight: bold;
    text-transform: uppercase; margin-bottom: 10px;">Join my mailing list</div>Hey there, I hope you\'re enjoying the theme.<br>
    Get notified of design freebies, new themes,<br>
    and whatever interesting I\'m doing!<br>
    <small style="color: #999"><em>This message will go away in a while if ignored</em></small>
    
    
    
    <style type="text/css">
    	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
    	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
    	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
    </style>
    <form action="http://gambit.us4.list-manage2.com/subscribe/post?u=199b017cfcaed5eee9c0ae225&amp;id=99c5107b66" method="post" id="mc-embedded-subscribe-mailing-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" style="margin-top: 15px;" novalidate>
    <div id="mc_embed_signup">
    	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" style="margin-left: 0 !important" required>
    	<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe-mailing" style="margin-top: 15px;" class="button"></div>
            </div>
    </form>

    <!--End mc_embed_signup-->
    <script>
    jQuery(document).ready(function($){
        $("#mc-embedded-subscribe-mailing").click(function(e) {
            e.preventDefault();
            setTimeout(function() {
                $("#mc-embedded-subscribe-mailing-form").submit();
            }, 100);
            setTimeout(function() {
                window.location = "' . $redirectUrl . '";
            }, 200);
            return false;
        });


    });
    </script>
    
    
    </div></div>
', 'custom');
}
?>