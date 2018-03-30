<?php

add_filter('admin_notices', '_display_rate_notification');

function _display_rate_notification() {
    // bfi_update_option('rate-notify', 27);
    if (!bfi_get_option('rate-notify')) {
        bfi_update_option('rate-notify', 1);
    } else if (bfi_get_option('rate-notify') < 50) {
        bfi_update_option('rate-notify', bfi_get_option('rate-notify') + 1);
    }
    if (isset($_GET['rated'])) {
        bfi_update_option('rate-notify', 99);
        
        BFIAdminNotificationController::addNotification('
        <style>
        .rate-box:hover {
            background: #B3E6FF !important;
        }
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
        cursor: pointer;
        background: #cef;
        margin-top: 20px;
        color: #555;
        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
        line-height: 21px;
        font-size: 13px;"><img class="animated bounceIn" src="http://gravatar.com/avatar/b5d60b4470879529eb13d9f7ff5302da?size=80" style="float: left; margin-right: 30px; border-radius: 100px; margin-left: 10px;"/><div style="overflow: hidden""><div style="font-weight: bold; margin-top: 31px;
        text-transform: uppercase; margin-bottom: 10px;">Thank you for helping out!</div></div></div>', 'custom');
        
    }
    if (bfi_get_option('rate-notify') < 30 || bfi_get_option('rate-notify') > 40) {
        return;
    }
    $redirectUrl = $_SERVER['REQUEST_URI'] 
                 . (stripos($_SERVER['REQUEST_URI'], '?') === false ?
                    "?" : "&")
                 . "rated=1";
    BFIAdminNotificationController::addNotification('
    <script>
    jQuery(document).ready(function($){
        $(".rate-box").click(function(e) {
            e.preventDefault();
            window.open("http://themeforest.net/downloads", "_blank");
            window.location = "' . $redirectUrl . '";
            return false;
        })
    });
    </script>
    <style>
    .rate-box:hover {
        background: #B3E6FF !important;
    }
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
    cursor: pointer;
    background: #cef;
    margin-top: 20px;
    color: #555;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    line-height: 21px;
    font-size: 13px;"><img class="animated bounceIn" src="http://gravatar.com/avatar/b5d60b4470879529eb13d9f7ff5302da?size=80" style="float: left; margin-right: 30px; border-radius: 100px; margin-left: 10px;"/><div style="overflow: hidden""><div style="font-weight: bold;
    text-transform: uppercase; margin-bottom: 10px;">Help me, help you!</div>Hey there, I hope you\'re enjoying the theme.<br>
    I would really appreciate it if you can <br><strong style="text-transform: uppercase; color: #EC30B0">rate '.BFI_THEMENAME.' 5 stars in ThemeForest :)</strong><br>
    Rating my theme would really help me out a lot!<br>
    This would allow me bring you more updates, more features,<br>
    new themes and give you customer support.<br>
    <small style="color: #999"><em>This message will go away in a while if ignored</em></small>
    <div style="font-style: italic;
    margin-top: 10px">Click this box and I\'ll open up your downloads page</div></div></div>', 'custom');
}
?>