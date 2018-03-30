<?php
	
	// Require config
	require_once('config.php');
	
	$icon_list = '<li><i class="ss-cursor"></i><span class="icon-name">ss-cursor</span></li><li><i class="ss-crosshair"></i><span class="icon-name">ss-crosshair</span></li><li><i class="ss-search"></i><span class="icon-name">ss-search</span></li><li><i class="ss-zoomin"></i><span class="icon-name">ss-zoomin</span></li><li><i class="ss-zoomout"></i><span class="icon-name">ss-zoomout</span></li><li><i class="ss-view"></i><span class="icon-name">ss-view</span></li><li><i class="ss-attach"></i><span class="icon-name">ss-attach</span></li><li><i class="ss-link"></i><span class="icon-name">ss-link</span></li><li><i class="ss-unlink"></i><span class="icon-name">ss-unlink</span></li><li><i class="ss-move"></i><span class="icon-name">ss-move</span></li><li><i class="ss-write"></i><span class="icon-name">ss-write</span></li><li><i class="ss-writingdisabled"></i><span class="icon-name">ss-writingdisabled</span></li><li><i class="ss-erase"></i><span class="icon-name">ss-erase</span></li><li><i class="ss-compose"></i><span class="icon-name">ss-compose</span></li><li><i class="ss-lock"></i><span class="icon-name">ss-lock</span></li><li><i class="ss-unlock"></i><span class="icon-name">ss-unlock</span></li><li><i class="ss-key"></i><span class="icon-name">ss-key</span></li><li><i class="ss-backspace"></i><span class="icon-name">ss-backspace</span></li><li><i class="ss-ban"></i><span class="icon-name">ss-ban</span></li><li><i class="ss-smoking"></i><span class="icon-name">ss-smoking</span></li><li><i class="ss-nosmoking"></i><span class="icon-name">ss-nosmoking</span></li><li><i class="ss-trash"></i><span class="icon-name">ss-trash</span></li><li><i class="ss-target"></i><span class="icon-name">ss-target</span></li><li><i class="ss-tag"></i><span class="icon-name">ss-tag</span></li><li><i class="ss-bookmark"></i><span class="icon-name">ss-bookmark</span></li><li><i class="ss-flag"></i><span class="icon-name">ss-flag</span></li><li><i class="ss-like"></i><span class="icon-name">ss-like</span></li><li><i class="ss-dislike"></i><span class="icon-name">ss-dislike</span></li><li><i class="ss-heart"></i><span class="icon-name">ss-heart</span></li><li><i class="ss-star"></i><span class="icon-name">ss-star</span></li><li><i class="ss-sample"></i><span class="icon-name">ss-sample</span></li><li><i class="ss-crop"></i><span class="icon-name">ss-crop</span></li><li><i class="ss-layers"></i><span class="icon-name">ss-layers</span></li><li><i class="ss-layergroup"></i><span class="icon-name">ss-layergroup</span></li><li><i class="ss-pen"></i><span class="icon-name">ss-pen</span></li><li><i class="ss-bezier"></i><span class="icon-name">ss-bezier</span></li><li><i class="ss-pixels"></i><span class="icon-name">ss-pixels</span></li><li><i class="ss-phone"></i><span class="icon-name">ss-phone</span></li><li><i class="ss-phonedisabled"></i><span class="icon-name">ss-phonedisabled</span></li><li><i class="ss-touchtonephone"></i><span class="icon-name">ss-touchtonephone</span></li><li><i class="ss-mail"></i><span class="icon-name">ss-mail</span></li><li><i class="ss-inbox"></i><span class="icon-name">ss-inbox</span></li><li><i class="ss-outbox"></i><span class="icon-name">ss-outbox</span></li><li><i class="ss-chat"></i><span class="icon-name">ss-chat</span></li><li><i class="ss-user"></i><span class="icon-name">ss-user</span></li><li><i class="ss-users"></i><span class="icon-name">ss-users</span></li><li><i class="ss-usergroup"></i><span class="icon-name">ss-usergroup</span></li><li><i class="ss-businessuser"></i><span class="icon-name">ss-businessuser</span></li><li><i class="ss-man"></i><span class="icon-name">ss-man</span></li><li><i class="ss-male"></i><span class="icon-name">ss-male</span></li><li><i class="ss-woman"></i><span class="icon-name">ss-woman</span></li><li><i class="ss-female"></i><span class="icon-name">ss-female</span></li><li><i class="ss-raisedhand"></i><span class="icon-name">ss-raisedhand</span></li><li><i class="ss-hand"></i><span class="icon-name">ss-hand</span></li><li><i class="ss-pointup"></i><span class="icon-name">ss-pointup</span></li><li><i class="ss-pointupright"></i><span class="icon-name">ss-pointupright</span></li><li><i class="ss-pointright"></i><span class="icon-name">ss-pointright</span></li><li><i class="ss-pointdownright"></i><span class="icon-name">ss-pointdownright</span></li><li><i class="ss-pointdown"></i><span class="icon-name">ss-pointdown</span></li><li><i class="ss-pointdownleft"></i><span class="icon-name">ss-pointdownleft</span></li><li><i class="ss-pointleft"></i><span class="icon-name">ss-pointleft</span></li><li><i class="ss-pointupleft"></i><span class="icon-name">ss-pointupleft</span></li><li><i class="ss-cart"></i><span class="icon-name">ss-cart</span></li><li><i class="ss-creditcard"></i><span class="icon-name">ss-creditcard</span></li><li><i class="ss-calculator"></i><span class="icon-name">ss-calculator</span></li><li><i class="ss-barchart"></i><span class="icon-name">ss-barchart</span></li><li><i class="ss-piechart"></i><span class="icon-name">ss-piechart</span></li><li><i class="ss-box"></i><span class="icon-name">ss-box</span></li><li><i class="ss-home"></i><span class="icon-name">ss-home</span></li><li><i class="ss-globe"></i><span class="icon-name">ss-globe</span></li><li><i class="ss-navigate"></i><span class="icon-name">ss-navigate</span></li><li><i class="ss-compass"></i><span class="icon-name">ss-compass</span></li><li><i class="ss-signpost"></i><span class="icon-name">ss-signpost</span></li><li><i class="ss-location"></i><span class="icon-name">ss-location</span></li><li><i class="ss-floppydisk"></i><span class="icon-name">ss-floppydisk</span></li><li><i class="ss-database"></i><span class="icon-name">ss-database</span></li><li><i class="ss-hdd"></i><span class="icon-name">ss-hdd</span></li><li><i class="ss-microchip"></i><span class="icon-name">ss-microchip</span></li><li><i class="ss-music"></i><span class="icon-name">ss-music</span></li><li><i class="ss-headphones"></i><span class="icon-name">ss-headphones</span></li><li><i class="ss-discdrive"></i><span class="icon-name">ss-discdrive</span></li><li><i class="ss-volume"></i><span class="icon-name">ss-volume</span></li><li><i class="ss-lowvolume"></i><span class="icon-name">ss-lowvolume</span></li><li><i class="ss-mediumvolume"></i><span class="icon-name">ss-mediumvolume</span></li><li><i class="ss-highvolume"></i><span class="icon-name">ss-highvolume</span></li><li><i class="ss-airplay"></i><span class="icon-name">ss-airplay</span></li><li><i class="ss-camera"></i><span class="icon-name">ss-camera</span></li><li><i class="ss-picture"></i><span class="icon-name">ss-picture</span></li><li><i class="ss-video"></i><span class="icon-name">ss-video</span></li><li><i class="ss-webcam"></i><span class="icon-name">ss-webcam</span></li><li><i class="ss-film"></i><span class="icon-name">ss-film</span></li><li><i class="ss-playvideo"></i><span class="icon-name">ss-playvideo</span></li><li><i class="ss-videogame"></i><span class="icon-name">ss-videogame</span></li><li><i class="ss-play"></i><span class="icon-name">ss-play</span></li><li><i class="ss-pause"></i><span class="icon-name">ss-pause</span></li><li><i class="ss-stop"></i><span class="icon-name">ss-stop</span></li><li><i class="ss-record"></i><span class="icon-name">ss-record</span></li><li><i class="ss-rewind"></i><span class="icon-name">ss-rewind</span></li><li><i class="ss-fastforward"></i><span class="icon-name">ss-fastforward</span></li><li><i class="ss-skipback"></i><span class="icon-name">ss-skipback</span></li><li><i class="ss-skipforward"></i><span class="icon-name">ss-skipforward</span></li><li><i class="ss-eject"></i><span class="icon-name">ss-eject</span></li><li><i class="ss-repeat"></i><span class="icon-name">ss-repeat</span></li><li><i class="ss-replay"></i><span class="icon-name">ss-replay</span></li><li><i class="ss-shuffle"></i><span class="icon-name">ss-shuffle</span></li><li><i class="ss-index"></i><span class="icon-name">ss-index</span></li><li><i class="ss-storagebox"></i><span class="icon-name">ss-storagebox</span></li><li><i class="ss-book"></i><span class="icon-name">ss-book</span></li><li><i class="ss-notebook"></i><span class="icon-name">ss-notebook</span></li><li><i class="ss-newspaper"></i><span class="icon-name">ss-newspaper</span></li><li><i class="ss-gridlines"></i><span class="icon-name">ss-gridlines</span></li><li><i class="ss-rows"></i><span class="icon-name">ss-rows</span></li><li><i class="ss-columns"></i><span class="icon-name">ss-columns</span></li><li><i class="ss-thumbnails"></i><span class="icon-name">ss-thumbnails</span></li><li><i class="ss-mouse"></i><span class="icon-name">ss-mouse</span></li><li><i class="ss-usb"></i><span class="icon-name">ss-usb</span></li><li><i class="ss-desktop"></i><span class="icon-name">ss-desktop</span></li><li><i class="ss-laptop"></i><span class="icon-name">ss-laptop</span></li><li><i class="ss-tablet"></i><span class="icon-name">ss-tablet</span></li><li><i class="ss-smartphone"></i><span class="icon-name">ss-smartphone</span></li><li><i class="ss-cell"></i><span class="icon-name">ss-cell</span></li><li><i class="ss-battery"></i><span class="icon-name">ss-battery</span></li><li><i class="ss-highbattery"></i><span class="icon-name">ss-highbattery</span></li><li><i class="ss-mediumbattery"></i><span class="icon-name">ss-mediumbattery</span></li><li><i class="ss-lowbattery"></i><span class="icon-name">ss-lowbattery</span></li><li><i class="ss-chargingbattery"></i><span class="icon-name">ss-chargingbattery</span></li><li><i class="ss-lightbulb"></i><span class="icon-name">ss-lightbulb</span></li><li><i class="ss-washer"></i><span class="icon-name">ss-washer</span></li><li><i class="ss-downloadcloud"></i><span class="icon-name">ss-downloadcloud</span></li><li><i class="ss-download"></i><span class="icon-name">ss-download</span></li><li><i class="ss-downloadbox"></i><span class="icon-name">ss-downloadbox</span></li><li><i class="ss-uploadcloud"></i><span class="icon-name">ss-uploadcloud</span></li><li><i class="ss-upload"></i><span class="icon-name">ss-upload</span></li><li><i class="ss-uploadbox"></i><span class="icon-name">ss-uploadbox</span></li><li><i class="ss-fork"></i><span class="icon-name">ss-fork</span></li><li><i class="ss-merge"></i><span class="icon-name">ss-merge</span></li><li><i class="ss-refresh"></i><span class="icon-name">ss-refresh</span></li><li><i class="ss-sync"></i><span class="icon-name">ss-sync</span></li><li><i class="ss-loading"></i><span class="icon-name">ss-loading</span></li><li><i class="ss-file"></i><span class="icon-name">ss-file</span></li><li><i class="ss-files"></i><span class="icon-name">ss-files</span></li><li><i class="ss-addfile"></i><span class="icon-name">ss-addfile</span></li><li><i class="ss-removefile"></i><span class="icon-name">ss-removefile</span></li><li><i class="ss-checkfile"></i><span class="icon-name">ss-checkfile</span></li><li><i class="ss-deletefile"></i><span class="icon-name">ss-deletefile</span></li><li><i class="ss-exe"></i><span class="icon-name">ss-exe</span></li><li><i class="ss-zip"></i><span class="icon-name">ss-zip</span></li><li><i class="ss-doc"></i><span class="icon-name">ss-doc</span></li><li><i class="ss-pdf"></i><span class="icon-name">ss-pdf</span></li><li><i class="ss-jpg"></i><span class="icon-name">ss-jpg</span></li><li><i class="ss-png"></i><span class="icon-name">ss-png</span></li><li><i class="ss-mp3"></i><span class="icon-name">ss-mp3</span></li><li><i class="ss-rar"></i><span class="icon-name">ss-rar</span></li><li><i class="ss-gif"></i><span class="icon-name">ss-gif</span></li><li><i class="ss-folder"></i><span class="icon-name">ss-folder</span></li><li><i class="ss-openfolder"></i><span class="icon-name">ss-openfolder</span></li><li><i class="ss-downloadfolder"></i><span class="icon-name">ss-downloadfolder</span></li><li><i class="ss-uploadfolder"></i><span class="icon-name">ss-uploadfolder</span></li><li><i class="ss-quote"></i><span class="icon-name">ss-quote</span></li><li><i class="ss-unquote"></i><span class="icon-name">ss-unquote</span></li><li><i class="ss-print"></i><span class="icon-name">ss-print</span></li><li><i class="ss-copier"></i><span class="icon-name">ss-copier</span></li><li><i class="ss-fax"></i><span class="icon-name">ss-fax</span></li><li><i class="ss-scanner"></i><span class="icon-name">ss-scanner</span></li><li><i class="ss-printregistration"></i><span class="icon-name">ss-printregistration</span></li><li><i class="ss-shredder"></i><span class="icon-name">ss-shredder</span></li><li><i class="ss-expand"></i><span class="icon-name">ss-expand</span></li><li><i class="ss-contract"></i><span class="icon-name">ss-contract</span></li><li><i class="ss-help"></i><span class="icon-name">ss-help</span></li><li><i class="ss-info"></i><span class="icon-name">ss-info</span></li><li><i class="ss-alert"></i><span class="icon-name">ss-alert</span></li><li><i class="ss-caution"></i><span class="icon-name">ss-caution</span></li><li><i class="ss-logout"></i><span class="icon-name">ss-logout</span></li><li><i class="ss-login"></i><span class="icon-name">ss-login</span></li><li><i class="ss-scaleup"></i><span class="icon-name">ss-scaleup</span></li><li><i class="ss-scaledown"></i><span class="icon-name">ss-scaledown</span></li><li><i class="ss-plus"></i><span class="icon-name">ss-plus</span></li><li><i class="ss-hyphen"></i><span class="icon-name">ss-hyphen</span></li><li><i class="ss-check"></i><span class="icon-name">ss-check</span></li><li><i class="ss-delete"></i><span class="icon-name">ss-delete</span></li><li><i class="ss-notifications"></i><span class="icon-name">ss-notifications</span></li><li><i class="ss-notificationsdisabled"></i><span class="icon-name">ss-notificationsdisabled</span></li><li><i class="ss-clock"></i><span class="icon-name">ss-clock</span></li><li><i class="ss-stopwatch"></i><span class="icon-name">ss-stopwatch</span></li><li><i class="ss-alarmclock"></i><span class="icon-name">ss-alarmclock</span></li><li><i class="ss-egg"></i><span class="icon-name">ss-egg</span></li><li><i class="ss-eggs"></i><span class="icon-name">ss-eggs</span></li><li><i class="ss-cheese"></i><span class="icon-name">ss-cheese</span></li><li><i class="ss-chickenleg"></i><span class="icon-name">ss-chickenleg</span></li><li><i class="ss-pizzapie"></i><span class="icon-name">ss-pizzapie</span></li><li><i class="ss-pizza"></i><span class="icon-name">ss-pizza</span></li><li><i class="ss-cheesepizza"></i><span class="icon-name">ss-cheesepizza</span></li><li><i class="ss-frenchfries"></i><span class="icon-name">ss-frenchfries</span></li><li><i class="ss-apple"></i><span class="icon-name">ss-apple</span></li><li><i class="ss-carrot"></i><span class="icon-name">ss-carrot</span></li><li><i class="ss-broccoli"></i><span class="icon-name">ss-broccoli</span></li><li><i class="ss-cucumber"></i><span class="icon-name">ss-cucumber</span></li><li><i class="ss-orange"></i><span class="icon-name">ss-orange</span></li><li><i class="ss-lemon"></i><span class="icon-name">ss-lemon</span></li><li><i class="ss-onion"></i><span class="icon-name">ss-onion</span></li><li><i class="ss-bellpepper"></i><span class="icon-name">ss-bellpepper</span></li><li><i class="ss-peas"></i><span class="icon-name">ss-peas</span></li><li><i class="ss-grapes"></i><span class="icon-name">ss-grapes</span></li><li><i class="ss-strawberry"></i><span class="icon-name">ss-strawberry</span></li><li><i class="ss-bread"></i><span class="icon-name">ss-bread</span></li><li><i class="ss-mug"></i><span class="icon-name">ss-mug</span></li><li><i class="ss-mugs"></i><span class="icon-name">ss-mugs</span></li><li><i class="ss-espresso"></i><span class="icon-name">ss-espresso</span></li><li><i class="ss-macchiato"></i><span class="icon-name">ss-macchiato</span></li><li><i class="ss-cappucino"></i><span class="icon-name">ss-cappucino</span></li><li><i class="ss-latte"></i><span class="icon-name">ss-latte</span></li><li><i class="ss-icedcoffee"></i><span class="icon-name">ss-icedcoffee</span></li><li><i class="ss-coffeebean"></i><span class="icon-name">ss-coffeebean</span></li><li><i class="ss-coffeemilk"></i><span class="icon-name">ss-coffeemilk</span></li><li><i class="ss-coffeefoam"></i><span class="icon-name">ss-coffeefoam</span></li><li><i class="ss-coffeesugar"></i><span class="icon-name">ss-coffeesugar</span></li><li><i class="ss-sugarpackets"></i><span class="icon-name">ss-sugarpackets</span></li><li><i class="ss-capsule"></i><span class="icon-name">ss-capsule</span></li><li><i class="ss-capsulerecycling"></i><span class="icon-name">ss-capsulerecycling</span></li><li><i class="ss-insertcapsule"></i><span class="icon-name">ss-insertcapsule</span></li><li><i class="ss-tea"></i><span class="icon-name">ss-tea</span></li><li><i class="ss-teabag"></i><span class="icon-name">ss-teabag</span></li><li><i class="ss-jug"></i><span class="icon-name">ss-jug</span></li><li><i class="ss-pitcher"></i><span class="icon-name">ss-pitcher</span></li><li><i class="ss-kettle"></i><span class="icon-name">ss-kettle</span></li><li><i class="ss-wineglass"></i><span class="icon-name">ss-wineglass</span></li><li><i class="ss-sugar"></i><span class="icon-name">ss-sugar</span></li><li><i class="ss-oven"></i><span class="icon-name">ss-oven</span></li><li><i class="ss-stove"></i><span class="icon-name">ss-stove</span></li><li><i class="ss-vent"></i><span class="icon-name">ss-vent</span></li><li><i class="ss-exhaust"></i><span class="icon-name">ss-exhaust</span></li><li><i class="ss-steam"></i><span class="icon-name">ss-steam</span></li><li><i class="ss-dishwasher"></i><span class="icon-name">ss-dishwasher</span></li><li><i class="ss-toaster"></i><span class="icon-name">ss-toaster</span></li><li><i class="ss-microwave"></i><span class="icon-name">ss-microwave</span></li><li><i class="ss-electrickettle"></i><span class="icon-name">ss-electrickettle</span></li><li><i class="ss-refrigerator"></i><span class="icon-name">ss-refrigerator</span></li><li><i class="ss-freezer"></i><span class="icon-name">ss-freezer</span></li><li><i class="ss-utensils"></i><span class="icon-name">ss-utensils</span></li><li><i class="ss-cookingutensils"></i><span class="icon-name">ss-cookingutensils</span></li><li><i class="ss-whisk"></i><span class="icon-name">ss-whisk</span></li><li><i class="ss-pizzacutter"></i><span class="icon-name">ss-pizzacutter</span></li><li><i class="ss-measuringcup"></i><span class="icon-name">ss-measuringcup</span></li><li><i class="ss-colander"></i><span class="icon-name">ss-colander</span></li><li><i class="ss-eggtimer"></i><span class="icon-name">ss-eggtimer</span></li><li><i class="ss-platter"></i><span class="icon-name">ss-platter</span></li><li><i class="ss-plates"></i><span class="icon-name">ss-plates</span></li><li><i class="ss-steamplate"></i><span class="icon-name">ss-steamplate</span></li><li><i class="ss-cups"></i><span class="icon-name">ss-cups</span></li><li><i class="ss-steamglass"></i><span class="icon-name">ss-steamglass</span></li><li><i class="ss-pot"></i><span class="icon-name">ss-pot</span></li><li><i class="ss-steampot"></i><span class="icon-name">ss-steampot</span></li><li><i class="ss-chef"></i><span class="icon-name">ss-chef</span></li><li><i class="ss-weathervane"></i><span class="icon-name">ss-weathervane</span></li><li><i class="ss-thermometer"></i><span class="icon-name">ss-thermometer</span></li><li><i class="ss-thermometerup"></i><span class="icon-name">ss-thermometerup</span></li><li><i class="ss-thermometerdown"></i><span class="icon-name">ss-thermometerdown</span></li><li><i class="ss-droplet"></i><span class="icon-name">ss-droplet</span></li><li><i class="ss-sunrise"></i><span class="icon-name">ss-sunrise</span></li><li><i class="ss-sunset"></i><span class="icon-name">ss-sunset</span></li><li><i class="ss-sun"></i><span class="icon-name">ss-sun</span></li><li><i class="ss-cloud"></i><span class="icon-name">ss-cloud</span></li><li><i class="ss-clouds"></i><span class="icon-name">ss-clouds</span></li><li><i class="ss-partlycloudy"></i><span class="icon-name">ss-partlycloudy</span></li><li><i class="ss-rain"></i><span class="icon-name">ss-rain</span></li><li><i class="ss-rainheavy"></i><span class="icon-name">ss-rainheavy</span></li><li><i class="ss-lightning"></i><span class="icon-name">ss-lightning</span></li><li><i class="ss-thunderstorm"></i><span class="icon-name">ss-thunderstorm</span></li><li><i class="ss-umbrella"></i><span class="icon-name">ss-umbrella</span></li><li><i class="ss-rainumbrella"></i><span class="icon-name">ss-rainumbrella</span></li><li><i class="ss-rainbow"></i><span class="icon-name">ss-rainbow</span></li><li><i class="ss-rainbowclouds"></i><span class="icon-name">ss-rainbowclouds</span></li><li><i class="ss-fog"></i><span class="icon-name">ss-fog</span></li><li><i class="ss-wind"></i><span class="icon-name">ss-wind</span></li><li><i class="ss-tornado"></i><span class="icon-name">ss-tornado</span></li><li><i class="ss-snowflake"></i><span class="icon-name">ss-snowflake</span></li><li><i class="ss-snowcrystal"></i><span class="icon-name">ss-snowcrystal</span></li><li><i class="ss-lightsnow"></i><span class="icon-name">ss-lightsnow</span></li><li><i class="ss-snow"></i><span class="icon-name">ss-snow</span></li><li><i class="ss-heavysnow"></i><span class="icon-name">ss-heavysnow</span></li><li><i class="ss-hail"></i><span class="icon-name">ss-hail</span></li><li><i class="ss-crescentmoon"></i><span class="icon-name">ss-crescentmoon</span></li><li><i class="ss-waxingcrescentmoon"></i><span class="icon-name">ss-waxingcrescentmoon</span></li><li><i class="ss-firstquartermoon"></i><span class="icon-name">ss-firstquartermoon</span></li><li><i class="ss-waxinggibbousmoon"></i><span class="icon-name">ss-waxinggibbousmoon</span></li><li><i class="ss-waninggibbousmoon"></i><span class="icon-name">ss-waninggibbousmoon</span></li><li><i class="ss-lastquartermoon"></i><span class="icon-name">ss-lastquartermoon</span></li><li><i class="ss-waningcrescentmoon"></i><span class="icon-name">ss-waningcrescentmoon</span></li><li><i class="ss-fan"></i><span class="icon-name">ss-fan</span></li><li><i class="ss-bike"></i><span class="icon-name">ss-bike</span></li><li><i class="ss-wheelchair"></i><span class="icon-name">ss-wheelchair</span></li><li><i class="ss-briefcase"></i><span class="icon-name">ss-briefcase</span></li><li><i class="ss-hanger"></i><span class="icon-name">ss-hanger</span></li><li><i class="ss-comb"></i><span class="icon-name">ss-comb</span></li><li><i class="ss-medicalcross"></i><span class="icon-name">ss-medicalcross</span></li><li><i class="ss-up"></i><span class="icon-name">ss-up</span></li><li><i class="ss-upright"></i><span class="icon-name">ss-upright</span></li><li><i class="ss-right"></i><span class="icon-name">ss-right</span></li><li><i class="ss-downright"></i><span class="icon-name">ss-downright</span></li><li><i class="ss-down"></i><span class="icon-name">ss-down</span></li><li><i class="ss-downleft"></i><span class="icon-name">ss-downleft</span></li><li><i class="ss-left"></i><span class="icon-name">ss-left</span></li><li><i class="ss-upleft"></i><span class="icon-name">ss-upleft</span></li><li><i class="ss-navigateup"></i><span class="icon-name">ss-navigateup</span></li><li><i class="ss-navigateright"></i><span class="icon-name">ss-navigateright</span></li><li><i class="ss-navigatedown"></i><span class="icon-name">ss-navigatedown</span></li><li><i class="ss-navigateleft"></i><span class="icon-name">ss-navigateleft</span></li><li><i class="ss-retweet"></i><span class="icon-name">ss-retweet</span></li><li><i class="ss-share"></i><span class="icon-name">ss-share</span></li>';
	$icon_list .= '<li><i class="fa-adjust"></i><span class="icon-name">fa-adjust</span></li><li><i class="fa-adn"></i><span class="icon-name">fa-adn</span></li><li><i class="fa-align-center"></i><span class="icon-name">fa-align-center</span></li><li><i class="fa-align-justify"></i><span class="icon-name">fa-align-justify</span></li><li><i class="fa-align-left"></i><span class="icon-name">fa-align-left</span></li><li><i class="fa-align-right"></i><span class="icon-name">fa-align-right</span></li><li><i class="fa-ambulance"></i><span class="icon-name">fa-ambulance</span></li><li><i class="fa-anchor"></i><span class="icon-name">fa-anchor</span></li><li><i class="fa-android"></i><span class="icon-name">fa-android</span></li><li><i class="fa-angellist"></i><span class="icon-name">fa-angellist</span></li><li><i class="fa-angle-double-down"></i><span class="icon-name">fa-angle-double-down</span></li><li><i class="fa-angle-double-left"></i><span class="icon-name">fa-angle-double-left</span></li><li><i class="fa-angle-double-right"></i><span class="icon-name">fa-angle-double-right</span></li><li><i class="fa-angle-double-up"></i><span class="icon-name">fa-angle-double-up</span></li><li><i class="fa-angle-down"></i><span class="icon-name">fa-angle-down</span></li><li><i class="fa-angle-left"></i><span class="icon-name">fa-angle-left</span></li><li><i class="fa-angle-right"></i><span class="icon-name">fa-angle-right</span></li><li><i class="fa-angle-up"></i><span class="icon-name">fa-angle-up</span></li><li><i class="fa-apple"></i><span class="icon-name">fa-apple</span></li><li><i class="fa-archive"></i><span class="icon-name">fa-archive</span></li><li><i class="fa-area-chart"></i><span class="icon-name">fa-area-chart</span></li><li><i class="fa-arrow-circle-down"></i><span class="icon-name">fa-arrow-circle-down</span></li><li><i class="fa-arrow-circle-left"></i><span class="icon-name">fa-arrow-circle-left</span></li><li><i class="fa-arrow-circle-o-down"></i><span class="icon-name">fa-arrow-circle-o-down</span></li><li><i class="fa-arrow-circle-o-left"></i><span class="icon-name">fa-arrow-circle-o-left</span></li><li><i class="fa-arrow-circle-o-right"></i><span class="icon-name">fa-arrow-circle-o-right</span></li><li><i class="fa-arrow-circle-o-up"></i><span class="icon-name">fa-arrow-circle-o-up</span></li><li><i class="fa-arrow-circle-right"></i><span class="icon-name">fa-arrow-circle-right</span></li><li><i class="fa-arrow-circle-up"></i><span class="icon-name">fa-arrow-circle-up</span></li><li><i class="fa-arrow-down"></i><span class="icon-name">fa-arrow-down</span></li><li><i class="fa-arrow-left"></i><span class="icon-name">fa-arrow-left</span></li><li><i class="fa-arrow-right"></i><span class="icon-name">fa-arrow-right</span></li><li><i class="fa-arrow-up"></i><span class="icon-name">fa-arrow-up</span></li><li><i class="fa-arrows"></i><span class="icon-name">fa-arrows</span></li><li><i class="fa-arrows-alt"></i><span class="icon-name">fa-arrows-alt</span></li><li><i class="fa-arrows-h"></i><span class="icon-name">fa-arrows-h</span></li><li><i class="fa-arrows-v"></i><span class="icon-name">fa-arrows-v</span></li><li><i class="fa-asterisk"></i><span class="icon-name">fa-asterisk</span></li><li><i class="fa-at"></i><span class="icon-name">fa-at</span></li><li><i class="fa-automobile"></i><span class="icon-name">fa-automobile</span></li><li><i class="fa-backward"></i><span class="icon-name">fa-backward</span></li><li><i class="fa-ban"></i><span class="icon-name">fa-ban</span></li><li><i class="fa-bank"></i><span class="icon-name">fa-bank</span></li><li><i class="fa-bar-chart"></i><span class="icon-name">fa-bar-chart</span></li><li><i class="fa-bar-chart-o"></i><span class="icon-name">fa-bar-chart-o</span></li><li><i class="fa-barcode"></i><span class="icon-name">fa-barcode</span></li><li><i class="fa-bars"></i><span class="icon-name">fa-bars</span></li><li><i class="fa-bed"></i><span class="icon-name">fa-bed</span></li><li><i class="fa-beer"></i><span class="icon-name">fa-beer</span></li><li><i class="fa-behance"></i><span class="icon-name">fa-behance</span></li><li><i class="fa-behance-square"></i><span class="icon-name">fa-behance-square</span></li><li><i class="fa-bell"></i><span class="icon-name">fa-bell</span></li><li><i class="fa-bell-o"></i><span class="icon-name">fa-bell-o</span></li><li><i class="fa-bell-slash"></i><span class="icon-name">fa-bell-slash</span></li><li><i class="fa-bell-slash-o"></i><span class="icon-name">fa-bell-slash-o</span></li><li><i class="fa-bicycle"></i><span class="icon-name">fa-bicycle</span></li><li><i class="fa-binoculars"></i><span class="icon-name">fa-binoculars</span></li><li><i class="fa-birthday-cake"></i><span class="icon-name">fa-birthday-cake</span></li><li><i class="fa-bitbucket"></i><span class="icon-name">fa-bitbucket</span></li><li><i class="fa-bitbucket-square"></i><span class="icon-name">fa-bitbucket-square</span></li><li><i class="fa-bitcoin"></i><span class="icon-name">fa-bitcoin</span></li><li><i class="fa-bold"></i><span class="icon-name">fa-bold</span></li><li><i class="fa-bolt"></i><span class="icon-name">fa-bolt</span></li><li><i class="fa-bomb"></i><span class="icon-name">fa-bomb</span></li><li><i class="fa-book"></i><span class="icon-name">fa-book</span></li><li><i class="fa-bookmark"></i><span class="icon-name">fa-bookmark</span></li><li><i class="fa-bookmark-o"></i><span class="icon-name">fa-bookmark-o</span></li><li><i class="fa-briefcase"></i><span class="icon-name">fa-briefcase</span></li><li><i class="fa-btc"></i><span class="icon-name">fa-btc</span></li><li><i class="fa-bug"></i><span class="icon-name">fa-bug</span></li><li><i class="fa-building"></i><span class="icon-name">fa-building</span></li><li><i class="fa-building-o"></i><span class="icon-name">fa-building-o</span></li><li><i class="fa-bullhorn"></i><span class="icon-name">fa-bullhorn</span></li><li><i class="fa-bullseye"></i><span class="icon-name">fa-bullseye</span></li><li><i class="fa-bus"></i><span class="icon-name">fa-bus</span></li><li><i class="fa-buysellads"></i><span class="icon-name">fa-buysellads</span></li><li><i class="fa-cab"></i><span class="icon-name">fa-cab</span></li><li><i class="fa-calculator"></i><span class="icon-name">fa-calculator</span></li><li><i class="fa-calendar"></i><span class="icon-name">fa-calendar</span></li><li><i class="fa-calendar-o"></i><span class="icon-name">fa-calendar-o</span></li><li><i class="fa-camera"></i><span class="icon-name">fa-camera</span></li><li><i class="fa-camera-retro"></i><span class="icon-name">fa-camera-retro</span></li><li><i class="fa-car"></i><span class="icon-name">fa-car</span></li><li><i class="fa-caret-down"></i><span class="icon-name">fa-caret-down</span></li><li><i class="fa-caret-left"></i><span class="icon-name">fa-caret-left</span></li><li><i class="fa-caret-right"></i><span class="icon-name">fa-caret-right</span></li><li><i class="fa-caret-square-o-down"></i><span class="icon-name">fa-caret-square-o-down</span></li><li><i class="fa-caret-square-o-left"></i><span class="icon-name">fa-caret-square-o-left</span></li><li><i class="fa-caret-square-o-right"></i><span class="icon-name">fa-caret-square-o-right</span></li><li><i class="fa-caret-square-o-up"></i><span class="icon-name">fa-caret-square-o-up</span></li><li><i class="fa-caret-up"></i><span class="icon-name">fa-caret-up</span></li><li><i class="fa-cart-arrow-down"></i><span class="icon-name">fa-cart-arrow-down</span></li><li><i class="fa-cart-plus"></i><span class="icon-name">fa-cart-plus</span></li><li><i class="fa-cc"></i><span class="icon-name">fa-cc</span></li><li><i class="fa-cc-amex"></i><span class="icon-name">fa-cc-amex</span></li><li><i class="fa-cc-discover"></i><span class="icon-name">fa-cc-discover</span></li><li><i class="fa-cc-mastercard"></i><span class="icon-name">fa-cc-mastercard</span></li><li><i class="fa-cc-paypal"></i><span class="icon-name">fa-cc-paypal</span></li><li><i class="fa-cc-stripe"></i><span class="icon-name">fa-cc-stripe</span></li><li><i class="fa-cc-visa"></i><span class="icon-name">fa-cc-visa</span></li><li><i class="fa-certificate"></i><span class="icon-name">fa-certificate</span></li><li><i class="fa-chain"></i><span class="icon-name">fa-chain</span></li><li><i class="fa-chain-broken"></i><span class="icon-name">fa-chain-broken</span></li><li><i class="fa-check"></i><span class="icon-name">fa-check</span></li><li><i class="fa-check-circle"></i><span class="icon-name">fa-check-circle</span></li><li><i class="fa-check-circle-o"></i><span class="icon-name">fa-check-circle-o</span></li><li><i class="fa-check-square"></i><span class="icon-name">fa-check-square</span></li><li><i class="fa-check-square-o"></i><span class="icon-name">fa-check-square-o</span></li><li><i class="fa-chevron-circle-down"></i><span class="icon-name">fa-chevron-circle-down</span></li><li><i class="fa-chevron-circle-left"></i><span class="icon-name">fa-chevron-circle-left</span></li><li><i class="fa-chevron-circle-right"></i><span class="icon-name">fa-chevron-circle-right</span></li><li><i class="fa-chevron-circle-up"></i><span class="icon-name">fa-chevron-circle-up</span></li><li><i class="fa-chevron-down"></i><span class="icon-name">fa-chevron-down</span></li><li><i class="fa-chevron-left"></i><span class="icon-name">fa-chevron-left</span></li><li><i class="fa-chevron-right"></i><span class="icon-name">fa-chevron-right</span></li><li><i class="fa-chevron-up"></i><span class="icon-name">fa-chevron-up</span></li><li><i class="fa-child"></i><span class="icon-name">fa-child</span></li><li><i class="fa-circle"></i><span class="icon-name">fa-circle</span></li><li><i class="fa-circle-o"></i><span class="icon-name">fa-circle-o</span></li><li><i class="fa-circle-o-notch"></i><span class="icon-name">fa-circle-o-notch</span></li><li><i class="fa-circle-thin"></i><span class="icon-name">fa-circle-thin</span></li><li><i class="fa-clipboard"></i><span class="icon-name">fa-clipboard</span></li><li><i class="fa-clock-o"></i><span class="icon-name">fa-clock-o</span></li><li><i class="fa-close"></i><span class="icon-name">fa-close</span></li><li><i class="fa-cloud"></i><span class="icon-name">fa-cloud</span></li><li><i class="fa-cloud-download"></i><span class="icon-name">fa-cloud-download</span></li><li><i class="fa-cloud-upload"></i><span class="icon-name">fa-cloud-upload</span></li><li><i class="fa-cny"></i><span class="icon-name">fa-cny</span></li><li><i class="fa-code"></i><span class="icon-name">fa-code</span></li><li><i class="fa-code-fork"></i><span class="icon-name">fa-code-fork</span></li><li><i class="fa-codepen"></i><span class="icon-name">fa-codepen</span></li><li><i class="fa-coffee"></i><span class="icon-name">fa-coffee</span></li><li><i class="fa-cog"></i><span class="icon-name">fa-cog</span></li><li><i class="fa-cogs"></i><span class="icon-name">fa-cogs</span></li><li><i class="fa-columns"></i><span class="icon-name">fa-columns</span></li><li><i class="fa-comment"></i><span class="icon-name">fa-comment</span></li><li><i class="fa-comment-o"></i><span class="icon-name">fa-comment-o</span></li><li><i class="fa-comments"></i><span class="icon-name">fa-comments</span></li><li><i class="fa-comments-o"></i><span class="icon-name">fa-comments-o</span></li><li><i class="fa-compass"></i><span class="icon-name">fa-compass</span></li><li><i class="fa-compress"></i><span class="icon-name">fa-compress</span></li><li><i class="fa-connectdevelop"></i><span class="icon-name">fa-connectdevelop</span></li><li><i class="fa-copy"></i><span class="icon-name">fa-copy</span></li><li><i class="fa-copyright"></i><span class="icon-name">fa-copyright</span></li><li><i class="fa-credit-card"></i><span class="icon-name">fa-credit-card</span></li><li><i class="fa-crop"></i><span class="icon-name">fa-crop</span></li><li><i class="fa-crosshairs"></i><span class="icon-name">fa-crosshairs</span></li><li><i class="fa-css3"></i><span class="icon-name">fa-css3</span></li><li><i class="fa-cube"></i><span class="icon-name">fa-cube</span></li><li><i class="fa-cubes"></i><span class="icon-name">fa-cubes</span></li><li><i class="fa-cut"></i><span class="icon-name">fa-cut</span></li><li><i class="fa-cutlery"></i><span class="icon-name">fa-cutlery</span></li><li><i class="fa-dashboard"></i><span class="icon-name">fa-dashboard</span></li><li><i class="fa-dashcube"></i><span class="icon-name">fa-dashcube</span></li><li><i class="fa-database"></i><span class="icon-name">fa-database</span></li><li><i class="fa-dedent"></i><span class="icon-name">fa-dedent</span></li><li><i class="fa-delicious"></i><span class="icon-name">fa-delicious</span></li><li><i class="fa-desktop"></i><span class="icon-name">fa-desktop</span></li><li><i class="fa-deviantart"></i><span class="icon-name">fa-deviantart</span></li><li><i class="fa-diamond"></i><span class="icon-name">fa-diamond</span></li><li><i class="fa-digg"></i><span class="icon-name">fa-digg</span></li><li><i class="fa-dollar"></i><span class="icon-name">fa-dollar</span></li><li><i class="fa-dot-circle-o"></i><span class="icon-name">fa-dot-circle-o</span></li><li><i class="fa-download"></i><span class="icon-name">fa-download</span></li><li><i class="fa-dribbble"></i><span class="icon-name">fa-dribbble</span></li><li><i class="fa-dropbox"></i><span class="icon-name">fa-dropbox</span></li><li><i class="fa-drupal"></i><span class="icon-name">fa-drupal</span></li><li><i class="fa-edit"></i><span class="icon-name">fa-edit</span></li><li><i class="fa-eject"></i><span class="icon-name">fa-eject</span></li><li><i class="fa-ellipsis-h"></i><span class="icon-name">fa-ellipsis-h</span></li><li><i class="fa-ellipsis-v"></i><span class="icon-name">fa-ellipsis-v</span></li><li><i class="fa-empire"></i><span class="icon-name">fa-empire</span></li><li><i class="fa-envelope"></i><span class="icon-name">fa-envelope</span></li><li><i class="fa-envelope-o"></i><span class="icon-name">fa-envelope-o</span></li><li><i class="fa-envelope-square"></i><span class="icon-name">fa-envelope-square</span></li><li><i class="fa-eraser"></i><span class="icon-name">fa-eraser</span></li><li><i class="fa-eur"></i><span class="icon-name">fa-eur</span></li><li><i class="fa-euro"></i><span class="icon-name">fa-euro</span></li><li><i class="fa-exchange"></i><span class="icon-name">fa-exchange</span></li><li><i class="fa-exclamation"></i><span class="icon-name">fa-exclamation</span></li><li><i class="fa-exclamation-circle"></i><span class="icon-name">fa-exclamation-circle</span></li><li><i class="fa-exclamation-triangle"></i><span class="icon-name">fa-exclamation-triangle</span></li><li><i class="fa-expand"></i><span class="icon-name">fa-expand</span></li><li><i class="fa-external-link"></i><span class="icon-name">fa-external-link</span></li><li><i class="fa-external-link-square"></i><span class="icon-name">fa-external-link-square</span></li><li><i class="fa-eye"></i><span class="icon-name">fa-eye</span></li><li><i class="fa-eye-slash"></i><span class="icon-name">fa-eye-slash</span></li><li><i class="fa-eyedropper"></i><span class="icon-name">fa-eyedropper</span></li><li><i class="fa-facebook"></i><span class="icon-name">fa-facebook</span></li><li><i class="fa-facebook-f"></i><span class="icon-name">fa-facebook-f</span></li><li><i class="fa-facebook-official"></i><span class="icon-name">fa-facebook-official</span></li><li><i class="fa-facebook-square"></i><span class="icon-name">fa-facebook-square</span></li><li><i class="fa-fast-backward"></i><span class="icon-name">fa-fast-backward</span></li><li><i class="fa-fast-forward"></i><span class="icon-name">fa-fast-forward</span></li><li><i class="fa-fax"></i><span class="icon-name">fa-fax</span></li><li><i class="fa-female"></i><span class="icon-name">fa-female</span></li><li><i class="fa-fighter-jet"></i><span class="icon-name">fa-fighter-jet</span></li><li><i class="fa-file"></i><span class="icon-name">fa-file</span></li><li><i class="fa-file-archive-o"></i><span class="icon-name">fa-file-archive-o</span></li><li><i class="fa-file-audio-o"></i><span class="icon-name">fa-file-audio-o</span></li><li><i class="fa-file-code-o"></i><span class="icon-name">fa-file-code-o</span></li><li><i class="fa-file-excel-o"></i><span class="icon-name">fa-file-excel-o</span></li><li><i class="fa-file-image-o"></i><span class="icon-name">fa-file-image-o</span></li><li><i class="fa-file-movie-o"></i><span class="icon-name">fa-file-movie-o</span></li><li><i class="fa-file-o"></i><span class="icon-name">fa-file-o</span></li><li><i class="fa-file-pdf-o"></i><span class="icon-name">fa-file-pdf-o</span></li><li><i class="fa-file-photo-o"></i><span class="icon-name">fa-file-photo-o</span></li><li><i class="fa-file-picture-o"></i><span class="icon-name">fa-file-picture-o</span></li><li><i class="fa-file-powerpoint-o"></i><span class="icon-name">fa-file-powerpoint-o</span></li><li><i class="fa-file-sound-o"></i><span class="icon-name">fa-file-sound-o</span></li><li><i class="fa-file-text"></i><span class="icon-name">fa-file-text</span></li><li><i class="fa-file-text-o"></i><span class="icon-name">fa-file-text-o</span></li><li><i class="fa-file-video-o"></i><span class="icon-name">fa-file-video-o</span></li><li><i class="fa-file-word-o"></i><span class="icon-name">fa-file-word-o</span></li><li><i class="fa-file-zip-o"></i><span class="icon-name">fa-file-zip-o</span></li><li><i class="fa-files-o"></i><span class="icon-name">fa-files-o</span></li><li><i class="fa-film"></i><span class="icon-name">fa-film</span></li><li><i class="fa-filter"></i><span class="icon-name">fa-filter</span></li><li><i class="fa-fire"></i><span class="icon-name">fa-fire</span></li><li><i class="fa-fire-extinguisher"></i><span class="icon-name">fa-fire-extinguisher</span></li><li><i class="fa-flag"></i><span class="icon-name">fa-flag</span></li><li><i class="fa-flag-checkered"></i><span class="icon-name">fa-flag-checkered</span></li><li><i class="fa-flag-o"></i><span class="icon-name">fa-flag-o</span></li><li><i class="fa-flash"></i><span class="icon-name">fa-flash</span></li><li><i class="fa-flask"></i><span class="icon-name">fa-flask</span></li><li><i class="fa-flickr"></i><span class="icon-name">fa-flickr</span></li><li><i class="fa-floppy-o"></i><span class="icon-name">fa-floppy-o</span></li><li><i class="fa-folder"></i><span class="icon-name">fa-folder</span></li><li><i class="fa-folder-o"></i><span class="icon-name">fa-folder-o</span></li><li><i class="fa-folder-open"></i><span class="icon-name">fa-folder-open</span></li><li><i class="fa-folder-open-o"></i><span class="icon-name">fa-folder-open-o</span></li><li><i class="fa-font"></i><span class="icon-name">fa-font</span></li><li><i class="fa-forumbee"></i><span class="icon-name">fa-forumbee</span></li><li><i class="fa-forward"></i><span class="icon-name">fa-forward</span></li><li><i class="fa-foursquare"></i><span class="icon-name">fa-foursquare</span></li><li><i class="fa-frown-o"></i><span class="icon-name">fa-frown-o</span></li><li><i class="fa-futbol-o"></i><span class="icon-name">fa-futbol-o</span></li><li><i class="fa-gamepad"></i><span class="icon-name">fa-gamepad</span></li><li><i class="fa-gavel"></i><span class="icon-name">fa-gavel</span></li><li><i class="fa-gbp"></i><span class="icon-name">fa-gbp</span></li><li><i class="fa-ge"></i><span class="icon-name">fa-ge</span></li><li><i class="fa-gear"></i><span class="icon-name">fa-gear</span></li><li><i class="fa-gears"></i><span class="icon-name">fa-gears</span></li><li><i class="fa-genderless"></i><span class="icon-name">fa-genderless</span></li><li><i class="fa-gift"></i><span class="icon-name">fa-gift</span></li><li><i class="fa-git"></i><span class="icon-name">fa-git</span></li><li><i class="fa-git-square"></i><span class="icon-name">fa-git-square</span></li><li><i class="fa-github"></i><span class="icon-name">fa-github</span></li><li><i class="fa-github-alt"></i><span class="icon-name">fa-github-alt</span></li><li><i class="fa-github-square"></i><span class="icon-name">fa-github-square</span></li><li><i class="fa-gittip"></i><span class="icon-name">fa-gittip</span></li><li><i class="fa-glass"></i><span class="icon-name">fa-glass</span></li><li><i class="fa-globe"></i><span class="icon-name">fa-globe</span></li><li><i class="fa-google"></i><span class="icon-name">fa-google</span></li><li><i class="fa-google-plus"></i><span class="icon-name">fa-google-plus</span></li><li><i class="fa-google-plus-square"></i><span class="icon-name">fa-google-plus-square</span></li><li><i class="fa-google-wallet"></i><span class="icon-name">fa-google-wallet</span></li><li><i class="fa-graduation-cap"></i><span class="icon-name">fa-graduation-cap</span></li><li><i class="fa-gratipay"></i><span class="icon-name">fa-gratipay</span></li><li><i class="fa-group"></i><span class="icon-name">fa-group</span></li><li><i class="fa-h-square"></i><span class="icon-name">fa-h-square</span></li><li><i class="fa-hacker-news"></i><span class="icon-name">fa-hacker-news</span></li><li><i class="fa-hand-o-down"></i><span class="icon-name">fa-hand-o-down</span></li><li><i class="fa-hand-o-left"></i><span class="icon-name">fa-hand-o-left</span></li><li><i class="fa-hand-o-right"></i><span class="icon-name">fa-hand-o-right</span></li><li><i class="fa-hand-o-up"></i><span class="icon-name">fa-hand-o-up</span></li><li><i class="fa-hdd-o"></i><span class="icon-name">fa-hdd-o</span></li><li><i class="fa-header"></i><span class="icon-name">fa-header</span></li><li><i class="fa-headphones"></i><span class="icon-name">fa-headphones</span></li><li><i class="fa-heart"></i><span class="icon-name">fa-heart</span></li><li><i class="fa-heart-o"></i><span class="icon-name">fa-heart-o</span></li><li><i class="fa-heartbeat"></i><span class="icon-name">fa-heartbeat</span></li><li><i class="fa-history"></i><span class="icon-name">fa-history</span></li><li><i class="fa-home"></i><span class="icon-name">fa-home</span></li><li><i class="fa-hospital-o"></i><span class="icon-name">fa-hospital-o</span></li><li><i class="fa-hotel"></i><span class="icon-name">fa-hotel</span></li><li><i class="fa-html5"></i><span class="icon-name">fa-html5</span></li><li><i class="fa-ils"></i><span class="icon-name">fa-ils</span></li><li><i class="fa-image"></i><span class="icon-name">fa-image</span></li><li><i class="fa-inbox"></i><span class="icon-name">fa-inbox</span></li><li><i class="fa-indent"></i><span class="icon-name">fa-indent</span></li><li><i class="fa-info"></i><span class="icon-name">fa-info</span></li><li><i class="fa-info-circle"></i><span class="icon-name">fa-info-circle</span></li><li><i class="fa-inr"></i><span class="icon-name">fa-inr</span></li><li><i class="fa-instagram"></i><span class="icon-name">fa-instagram</span></li><li><i class="fa-institution"></i><span class="icon-name">fa-institution</span></li><li><i class="fa-ioxhost"></i><span class="icon-name">fa-ioxhost</span></li><li><i class="fa-italic"></i><span class="icon-name">fa-italic</span></li><li><i class="fa-joomla"></i><span class="icon-name">fa-joomla</span></li><li><i class="fa-jpy"></i><span class="icon-name">fa-jpy</span></li><li><i class="fa-jsfiddle"></i><span class="icon-name">fa-jsfiddle</span></li><li><i class="fa-key"></i><span class="icon-name">fa-key</span></li><li><i class="fa-keyboard-o"></i><span class="icon-name">fa-keyboard-o</span></li><li><i class="fa-krw"></i><span class="icon-name">fa-krw</span></li><li><i class="fa-language"></i><span class="icon-name">fa-language</span></li><li><i class="fa-laptop"></i><span class="icon-name">fa-laptop</span></li><li><i class="fa-lastfm"></i><span class="icon-name">fa-lastfm</span></li><li><i class="fa-lastfm-square"></i><span class="icon-name">fa-lastfm-square</span></li><li><i class="fa-leaf"></i><span class="icon-name">fa-leaf</span></li><li><i class="fa-leanpub"></i><span class="icon-name">fa-leanpub</span></li><li><i class="fa-legal"></i><span class="icon-name">fa-legal</span></li><li><i class="fa-lemon-o"></i><span class="icon-name">fa-lemon-o</span></li><li><i class="fa-level-down"></i><span class="icon-name">fa-level-down</span></li><li><i class="fa-level-up"></i><span class="icon-name">fa-level-up</span></li><li><i class="fa-life-bouy"></i><span class="icon-name">fa-life-bouy</span></li><li><i class="fa-life-buoy"></i><span class="icon-name">fa-life-buoy</span></li><li><i class="fa-life-ring"></i><span class="icon-name">fa-life-ring</span></li><li><i class="fa-life-saver"></i><span class="icon-name">fa-life-saver</span></li><li><i class="fa-lightbulb-o"></i><span class="icon-name">fa-lightbulb-o</span></li><li><i class="fa-line-chart"></i><span class="icon-name">fa-line-chart</span></li><li><i class="fa-link"></i><span class="icon-name">fa-link</span></li><li><i class="fa-linkedin"></i><span class="icon-name">fa-linkedin</span></li><li><i class="fa-linkedin-square"></i><span class="icon-name">fa-linkedin-square</span></li><li><i class="fa-linux"></i><span class="icon-name">fa-linux</span></li><li><i class="fa-list"></i><span class="icon-name">fa-list</span></li><li><i class="fa-list-alt"></i><span class="icon-name">fa-list-alt</span></li><li><i class="fa-list-ol"></i><span class="icon-name">fa-list-ol</span></li><li><i class="fa-list-ul"></i><span class="icon-name">fa-list-ul</span></li><li><i class="fa-location-arrow"></i><span class="icon-name">fa-location-arrow</span></li><li><i class="fa-lock"></i><span class="icon-name">fa-lock</span></li><li><i class="fa-long-arrow-down"></i><span class="icon-name">fa-long-arrow-down</span></li><li><i class="fa-long-arrow-left"></i><span class="icon-name">fa-long-arrow-left</span></li><li><i class="fa-long-arrow-right"></i><span class="icon-name">fa-long-arrow-right</span></li><li><i class="fa-long-arrow-up"></i><span class="icon-name">fa-long-arrow-up</span></li><li><i class="fa-magic"></i><span class="icon-name">fa-magic</span></li><li><i class="fa-magnet"></i><span class="icon-name">fa-magnet</span></li><li><i class="fa-mail-forward"></i><span class="icon-name">fa-mail-forward</span></li><li><i class="fa-mail-reply"></i><span class="icon-name">fa-mail-reply</span></li><li><i class="fa-mail-reply-all"></i><span class="icon-name">fa-mail-reply-all</span></li><li><i class="fa-male"></i><span class="icon-name">fa-male</span></li><li><i class="fa-map-marker"></i><span class="icon-name">fa-map-marker</span></li><li><i class="fa-mars"></i><span class="icon-name">fa-mars</span></li><li><i class="fa-mars-double"></i><span class="icon-name">fa-mars-double</span></li><li><i class="fa-mars-stroke"></i><span class="icon-name">fa-mars-stroke</span></li><li><i class="fa-mars-stroke-h"></i><span class="icon-name">fa-mars-stroke-h</span></li><li><i class="fa-mars-stroke-v"></i><span class="icon-name">fa-mars-stroke-v</span></li><li><i class="fa-maxcdn"></i><span class="icon-name">fa-maxcdn</span></li><li><i class="fa-meanpath"></i><span class="icon-name">fa-meanpath</span></li><li><i class="fa-medium"></i><span class="icon-name">fa-medium</span></li><li><i class="fa-medkit"></i><span class="icon-name">fa-medkit</span></li><li><i class="fa-meh-o"></i><span class="icon-name">fa-meh-o</span></li><li><i class="fa-mercury"></i><span class="icon-name">fa-mercury</span></li><li><i class="fa-microphone"></i><span class="icon-name">fa-microphone</span></li><li><i class="fa-microphone-slash"></i><span class="icon-name">fa-microphone-slash</span></li><li><i class="fa-minus"></i><span class="icon-name">fa-minus</span></li><li><i class="fa-minus-circle"></i><span class="icon-name">fa-minus-circle</span></li><li><i class="fa-minus-square"></i><span class="icon-name">fa-minus-square</span></li><li><i class="fa-minus-square-o"></i><span class="icon-name">fa-minus-square-o</span></li><li><i class="fa-mobile"></i><span class="icon-name">fa-mobile</span></li><li><i class="fa-mobile-phone"></i><span class="icon-name">fa-mobile-phone</span></li><li><i class="fa-money"></i><span class="icon-name">fa-money</span></li><li><i class="fa-moon-o"></i><span class="icon-name">fa-moon-o</span></li><li><i class="fa-mortar-board"></i><span class="icon-name">fa-mortar-board</span></li><li><i class="fa-motorcycle"></i><span class="icon-name">fa-motorcycle</span></li><li><i class="fa-music"></i><span class="icon-name">fa-music</span></li><li><i class="fa-navicon"></i><span class="icon-name">fa-navicon</span></li><li><i class="fa-neuter"></i><span class="icon-name">fa-neuter</span></li><li><i class="fa-newspaper-o"></i><span class="icon-name">fa-newspaper-o</span></li><li><i class="fa-openid"></i><span class="icon-name">fa-openid</span></li><li><i class="fa-outdent"></i><span class="icon-name">fa-outdent</span></li><li><i class="fa-pagelines"></i><span class="icon-name">fa-pagelines</span></li><li><i class="fa-paint-brush"></i><span class="icon-name">fa-paint-brush</span></li><li><i class="fa-paper-plane"></i><span class="icon-name">fa-paper-plane</span></li><li><i class="fa-paper-plane-o"></i><span class="icon-name">fa-paper-plane-o</span></li><li><i class="fa-paperclip"></i><span class="icon-name">fa-paperclip</span></li><li><i class="fa-paragraph"></i><span class="icon-name">fa-paragraph</span></li><li><i class="fa-paste"></i><span class="icon-name">fa-paste</span></li><li><i class="fa-pause"></i><span class="icon-name">fa-pause</span></li><li><i class="fa-paw"></i><span class="icon-name">fa-paw</span></li><li><i class="fa-paypal"></i><span class="icon-name">fa-paypal</span></li><li><i class="fa-pencil"></i><span class="icon-name">fa-pencil</span></li><li><i class="fa-pencil-square"></i><span class="icon-name">fa-pencil-square</span></li><li><i class="fa-pencil-square-o"></i><span class="icon-name">fa-pencil-square-o</span></li><li><i class="fa-phone"></i><span class="icon-name">fa-phone</span></li><li><i class="fa-phone-square"></i><span class="icon-name">fa-phone-square</span></li><li><i class="fa-photo"></i><span class="icon-name">fa-photo</span></li><li><i class="fa-picture-o"></i><span class="icon-name">fa-picture-o</span></li><li><i class="fa-pie-chart"></i><span class="icon-name">fa-pie-chart</span></li><li><i class="fa-pied-piper"></i><span class="icon-name">fa-pied-piper</span></li><li><i class="fa-pied-piper-alt"></i><span class="icon-name">fa-pied-piper-alt</span></li><li><i class="fa-pinterest"></i><span class="icon-name">fa-pinterest</span></li><li><i class="fa-pinterest-p"></i><span class="icon-name">fa-pinterest-p</span></li><li><i class="fa-pinterest-square"></i><span class="icon-name">fa-pinterest-square</span></li><li><i class="fa-plane"></i><span class="icon-name">fa-plane</span></li><li><i class="fa-play"></i><span class="icon-name">fa-play</span></li><li><i class="fa-play-circle"></i><span class="icon-name">fa-play-circle</span></li><li><i class="fa-play-circle-o"></i><span class="icon-name">fa-play-circle-o</span></li><li><i class="fa-plug"></i><span class="icon-name">fa-plug</span></li><li><i class="fa-plus"></i><span class="icon-name">fa-plus</span></li><li><i class="fa-plus-circle"></i><span class="icon-name">fa-plus-circle</span></li><li><i class="fa-plus-square"></i><span class="icon-name">fa-plus-square</span></li><li><i class="fa-plus-square-o"></i><span class="icon-name">fa-plus-square-o</span></li><li><i class="fa-power-off"></i><span class="icon-name">fa-power-off</span></li><li><i class="fa-print"></i><span class="icon-name">fa-print</span></li><li><i class="fa-puzzle-piece"></i><span class="icon-name">fa-puzzle-piece</span></li><li><i class="fa-qq"></i><span class="icon-name">fa-qq</span></li><li><i class="fa-qrcode"></i><span class="icon-name">fa-qrcode</span></li><li><i class="fa-question"></i><span class="icon-name">fa-question</span></li><li><i class="fa-question-circle"></i><span class="icon-name">fa-question-circle</span></li><li><i class="fa-quote-left"></i><span class="icon-name">fa-quote-left</span></li><li><i class="fa-quote-right"></i><span class="icon-name">fa-quote-right</span></li><li><i class="fa-ra"></i><span class="icon-name">fa-ra</span></li><li><i class="fa-random"></i><span class="icon-name">fa-random</span></li><li><i class="fa-rebel"></i><span class="icon-name">fa-rebel</span></li><li><i class="fa-recycle"></i><span class="icon-name">fa-recycle</span></li><li><i class="fa-reddit"></i><span class="icon-name">fa-reddit</span></li><li><i class="fa-reddit-square"></i><span class="icon-name">fa-reddit-square</span></li><li><i class="fa-refresh"></i><span class="icon-name">fa-refresh</span></li><li><i class="fa-remove"></i><span class="icon-name">fa-remove</span></li><li><i class="fa-renren"></i><span class="icon-name">fa-renren</span></li><li><i class="fa-reorder"></i><span class="icon-name">fa-reorder</span></li><li><i class="fa-repeat"></i><span class="icon-name">fa-repeat</span></li><li><i class="fa-reply"></i><span class="icon-name">fa-reply</span></li><li><i class="fa-reply-all"></i><span class="icon-name">fa-reply-all</span></li><li><i class="fa-retweet"></i><span class="icon-name">fa-retweet</span></li><li><i class="fa-rmb"></i><span class="icon-name">fa-rmb</span></li><li><i class="fa-road"></i><span class="icon-name">fa-road</span></li><li><i class="fa-rocket"></i><span class="icon-name">fa-rocket</span></li><li><i class="fa-rotate-left"></i><span class="icon-name">fa-rotate-left</span></li><li><i class="fa-rotate-right"></i><span class="icon-name">fa-rotate-right</span></li><li><i class="fa-rouble"></i><span class="icon-name">fa-rouble</span></li><li><i class="fa-rss"></i><span class="icon-name">fa-rss</span></li><li><i class="fa-rss-square"></i><span class="icon-name">fa-rss-square</span></li><li><i class="fa-rub"></i><span class="icon-name">fa-rub</span></li><li><i class="fa-ruble"></i><span class="icon-name">fa-ruble</span></li><li><i class="fa-rupee"></i><span class="icon-name">fa-rupee</span></li><li><i class="fa-save"></i><span class="icon-name">fa-save</span></li><li><i class="fa-scissors"></i><span class="icon-name">fa-scissors</span></li><li><i class="fa-search"></i><span class="icon-name">fa-search</span></li><li><i class="fa-search-minus"></i><span class="icon-name">fa-search-minus</span></li><li><i class="fa-search-plus"></i><span class="icon-name">fa-search-plus</span></li><li><i class="fa-sellsy"></i><span class="icon-name">fa-sellsy</span></li><li><i class="fa-send"></i><span class="icon-name">fa-send</span></li><li><i class="fa-send-o"></i><span class="icon-name">fa-send-o</span></li><li><i class="fa-server"></i><span class="icon-name">fa-server</span></li><li><i class="fa-share"></i><span class="icon-name">fa-share</span></li><li><i class="fa-share-alt"></i><span class="icon-name">fa-share-alt</span></li><li><i class="fa-share-alt-square"></i><span class="icon-name">fa-share-alt-square</span></li><li><i class="fa-share-square"></i><span class="icon-name">fa-share-square</span></li><li><i class="fa-share-square-o"></i><span class="icon-name">fa-share-square-o</span></li><li><i class="fa-shekel"></i><span class="icon-name">fa-shekel</span></li><li><i class="fa-sheqel"></i><span class="icon-name">fa-sheqel</span></li><li><i class="fa-shield"></i><span class="icon-name">fa-shield</span></li><li><i class="fa-ship"></i><span class="icon-name">fa-ship</span></li><li><i class="fa-shirtsinbulk"></i><span class="icon-name">fa-shirtsinbulk</span></li><li><i class="fa-shopping-cart"></i><span class="icon-name">fa-shopping-cart</span></li><li><i class="fa-sign-in"></i><span class="icon-name">fa-sign-in</span></li><li><i class="fa-sign-out"></i><span class="icon-name">fa-sign-out</span></li><li><i class="fa-signal"></i><span class="icon-name">fa-signal</span></li><li><i class="fa-simplybuilt"></i><span class="icon-name">fa-simplybuilt</span></li><li><i class="fa-sitemap"></i><span class="icon-name">fa-sitemap</span></li><li><i class="fa-skyatlas"></i><span class="icon-name">fa-skyatlas</span></li><li><i class="fa-skype"></i><span class="icon-name">fa-skype</span></li><li><i class="fa-slack"></i><span class="icon-name">fa-slack</span></li><li><i class="fa-sliders"></i><span class="icon-name">fa-sliders</span></li><li><i class="fa-slideshare"></i><span class="icon-name">fa-slideshare</span></li><li><i class="fa-smile-o"></i><span class="icon-name">fa-smile-o</span></li><li><i class="fa-soccer-ball-o"></i><span class="icon-name">fa-soccer-ball-o</span></li><li><i class="fa-sort"></i><span class="icon-name">fa-sort</span></li><li><i class="fa-sort-alpha-asc"></i><span class="icon-name">fa-sort-alpha-asc</span></li><li><i class="fa-sort-alpha-desc"></i><span class="icon-name">fa-sort-alpha-desc</span></li><li><i class="fa-sort-amount-asc"></i><span class="icon-name">fa-sort-amount-asc</span></li><li><i class="fa-sort-amount-desc"></i><span class="icon-name">fa-sort-amount-desc</span></li><li><i class="fa-sort-asc"></i><span class="icon-name">fa-sort-asc</span></li><li><i class="fa-sort-desc"></i><span class="icon-name">fa-sort-desc</span></li><li><i class="fa-sort-down"></i><span class="icon-name">fa-sort-down</span></li><li><i class="fa-sort-numeric-asc"></i><span class="icon-name">fa-sort-numeric-asc</span></li><li><i class="fa-sort-numeric-desc"></i><span class="icon-name">fa-sort-numeric-desc</span></li><li><i class="fa-sort-up"></i><span class="icon-name">fa-sort-up</span></li><li><i class="fa-soundcloud"></i><span class="icon-name">fa-soundcloud</span></li><li><i class="fa-space-shuttle"></i><span class="icon-name">fa-space-shuttle</span></li><li><i class="fa-spinner"></i><span class="icon-name">fa-spinner</span></li><li><i class="fa-spoon"></i><span class="icon-name">fa-spoon</span></li><li><i class="fa-spotify"></i><span class="icon-name">fa-spotify</span></li><li><i class="fa-square"></i><span class="icon-name">fa-square</span></li><li><i class="fa-square-o"></i><span class="icon-name">fa-square-o</span></li><li><i class="fa-stack-exchange"></i><span class="icon-name">fa-stack-exchange</span></li><li><i class="fa-stack-overflow"></i><span class="icon-name">fa-stack-overflow</span></li><li><i class="fa-star"></i><span class="icon-name">fa-star</span></li><li><i class="fa-star-half"></i><span class="icon-name">fa-star-half</span></li><li><i class="fa-star-half-empty"></i><span class="icon-name">fa-star-half-empty</span></li><li><i class="fa-star-half-full"></i><span class="icon-name">fa-star-half-full</span></li><li><i class="fa-star-half-o"></i><span class="icon-name">fa-star-half-o</span></li><li><i class="fa-star-o"></i><span class="icon-name">fa-star-o</span></li><li><i class="fa-steam"></i><span class="icon-name">fa-steam</span></li><li><i class="fa-steam-square"></i><span class="icon-name">fa-steam-square</span></li><li><i class="fa-step-backward"></i><span class="icon-name">fa-step-backward</span></li><li><i class="fa-step-forward"></i><span class="icon-name">fa-step-forward</span></li><li><i class="fa-stethoscope"></i><span class="icon-name">fa-stethoscope</span></li><li><i class="fa-stop"></i><span class="icon-name">fa-stop</span></li><li><i class="fa-street-view"></i><span class="icon-name">fa-street-view</span></li><li><i class="fa-strikethrough"></i><span class="icon-name">fa-strikethrough</span></li><li><i class="fa-stumbleupon"></i><span class="icon-name">fa-stumbleupon</span></li><li><i class="fa-stumbleupon-circle"></i><span class="icon-name">fa-stumbleupon-circle</span></li><li><i class="fa-subscript"></i><span class="icon-name">fa-subscript</span></li><li><i class="fa-subway"></i><span class="icon-name">fa-subway</span></li><li><i class="fa-suitcase"></i><span class="icon-name">fa-suitcase</span></li><li><i class="fa-sun-o"></i><span class="icon-name">fa-sun-o</span></li><li><i class="fa-superscript"></i><span class="icon-name">fa-superscript</span></li><li><i class="fa-support"></i><span class="icon-name">fa-support</span></li><li><i class="fa-table"></i><span class="icon-name">fa-table</span></li><li><i class="fa-tablet"></i><span class="icon-name">fa-tablet</span></li><li><i class="fa-tachometer"></i><span class="icon-name">fa-tachometer</span></li><li><i class="fa-tag"></i><span class="icon-name">fa-tag</span></li><li><i class="fa-tags"></i><span class="icon-name">fa-tags</span></li><li><i class="fa-tasks"></i><span class="icon-name">fa-tasks</span></li><li><i class="fa-taxi"></i><span class="icon-name">fa-taxi</span></li><li><i class="fa-tencent-weibo"></i><span class="icon-name">fa-tencent-weibo</span></li><li><i class="fa-terminal"></i><span class="icon-name">fa-terminal</span></li><li><i class="fa-text-height"></i><span class="icon-name">fa-text-height</span></li><li><i class="fa-text-width"></i><span class="icon-name">fa-text-width</span></li><li><i class="fa-th"></i><span class="icon-name">fa-th</span></li><li><i class="fa-th-large"></i><span class="icon-name">fa-th-large</span></li><li><i class="fa-th-list"></i><span class="icon-name">fa-th-list</span></li><li><i class="fa-thumb-tack"></i><span class="icon-name">fa-thumb-tack</span></li><li><i class="fa-thumbs-down"></i><span class="icon-name">fa-thumbs-down</span></li><li><i class="fa-thumbs-o-down"></i><span class="icon-name">fa-thumbs-o-down</span></li><li><i class="fa-thumbs-o-up"></i><span class="icon-name">fa-thumbs-o-up</span></li><li><i class="fa-thumbs-up"></i><span class="icon-name">fa-thumbs-up</span></li><li><i class="fa-ticket"></i><span class="icon-name">fa-ticket</span></li><li><i class="fa-times"></i><span class="icon-name">fa-times</span></li><li><i class="fa-times-circle"></i><span class="icon-name">fa-times-circle</span></li><li><i class="fa-times-circle-o"></i><span class="icon-name">fa-times-circle-o</span></li><li><i class="fa-tint"></i><span class="icon-name">fa-tint</span></li><li><i class="fa-toggle-down"></i><span class="icon-name">fa-toggle-down</span></li><li><i class="fa-toggle-left"></i><span class="icon-name">fa-toggle-left</span></li><li><i class="fa-toggle-off"></i><span class="icon-name">fa-toggle-off</span></li><li><i class="fa-toggle-on"></i><span class="icon-name">fa-toggle-on</span></li><li><i class="fa-toggle-right"></i><span class="icon-name">fa-toggle-right</span></li><li><i class="fa-toggle-up"></i><span class="icon-name">fa-toggle-up</span></li><li><i class="fa-train"></i><span class="icon-name">fa-train</span></li><li><i class="fa-transgender"></i><span class="icon-name">fa-transgender</span></li><li><i class="fa-transgender-alt"></i><span class="icon-name">fa-transgender-alt</span></li><li><i class="fa-trash"></i><span class="icon-name">fa-trash</span></li><li><i class="fa-trash-o"></i><span class="icon-name">fa-trash-o</span></li><li><i class="fa-tree"></i><span class="icon-name">fa-tree</span></li><li><i class="fa-trello"></i><span class="icon-name">fa-trello</span></li><li><i class="fa-trophy"></i><span class="icon-name">fa-trophy</span></li><li><i class="fa-truck"></i><span class="icon-name">fa-truck</span></li><li><i class="fa-try"></i><span class="icon-name">fa-try</span></li><li><i class="fa-tty"></i><span class="icon-name">fa-tty</span></li><li><i class="fa-tumblr"></i><span class="icon-name">fa-tumblr</span></li><li><i class="fa-tumblr-square"></i><span class="icon-name">fa-tumblr-square</span></li><li><i class="fa-turkish-lira"></i><span class="icon-name">fa-turkish-lira</span></li><li><i class="fa-twitch"></i><span class="icon-name">fa-twitch</span></li><li><i class="fa-twitter"></i><span class="icon-name">fa-twitter</span></li><li><i class="fa-twitter-square"></i><span class="icon-name">fa-twitter-square</span></li><li><i class="fa-umbrella"></i><span class="icon-name">fa-umbrella</span></li><li><i class="fa-underline"></i><span class="icon-name">fa-underline</span></li><li><i class="fa-undo"></i><span class="icon-name">fa-undo</span></li><li><i class="fa-university"></i><span class="icon-name">fa-university</span></li><li><i class="fa-unlink"></i><span class="icon-name">fa-unlink</span></li><li><i class="fa-unlock"></i><span class="icon-name">fa-unlock</span></li><li><i class="fa-unlock-alt"></i><span class="icon-name">fa-unlock-alt</span></li><li><i class="fa-unsorted"></i><span class="icon-name">fa-unsorted</span></li><li><i class="fa-upload"></i><span class="icon-name">fa-upload</span></li><li><i class="fa-usd"></i><span class="icon-name">fa-usd</span></li><li><i class="fa-user"></i><span class="icon-name">fa-user</span></li><li><i class="fa-user-md"></i><span class="icon-name">fa-user-md</span></li><li><i class="fa-user-plus"></i><span class="icon-name">fa-user-plus</span></li><li><i class="fa-user-secret"></i><span class="icon-name">fa-user-secret</span></li><li><i class="fa-user-times"></i><span class="icon-name">fa-user-times</span></li><li><i class="fa-users"></i><span class="icon-name">fa-users</span></li><li><i class="fa-venus"></i><span class="icon-name">fa-venus</span></li><li><i class="fa-venus-double"></i><span class="icon-name">fa-venus-double</span></li><li><i class="fa-venus-mars"></i><span class="icon-name">fa-venus-mars</span></li><li><i class="fa-viacoin"></i><span class="icon-name">fa-viacoin</span></li><li><i class="fa-video-camera"></i><span class="icon-name">fa-video-camera</span></li><li><i class="fa-vimeo-square"></i><span class="icon-name">fa-vimeo-square</span></li><li><i class="fa-vine"></i><span class="icon-name">fa-vine</span></li><li><i class="fa-vk"></i><span class="icon-name">fa-vk</span></li><li><i class="fa-volume-down"></i><span class="icon-name">fa-volume-down</span></li><li><i class="fa-volume-off"></i><span class="icon-name">fa-volume-off</span></li><li><i class="fa-volume-up"></i><span class="icon-name">fa-volume-up</span></li><li><i class="fa-warning"></i><span class="icon-name">fa-warning</span></li><li><i class="fa-wechat"></i><span class="icon-name">fa-wechat</span></li><li><i class="fa-weibo"></i><span class="icon-name">fa-weibo</span></li><li><i class="fa-weixin"></i><span class="icon-name">fa-weixin</span></li><li><i class="fa-whatsapp"></i><span class="icon-name">fa-whatsapp</span></li><li><i class="fa-wheelchair"></i><span class="icon-name">fa-wheelchair</span></li><li><i class="fa-wifi"></i><span class="icon-name">fa-wifi</span></li><li><i class="fa-windows"></i><span class="icon-name">fa-windows</span></li><li><i class="fa-won"></i><span class="icon-name">fa-won</span></li><li><i class="fa-wordpress"></i><span class="icon-name">fa-wordpress</span></li><li><i class="fa-wrench"></i><span class="icon-name">fa-wrench</span></li><li><i class="fa-xing"></i><span class="icon-name">fa-xing</span></li><li><i class="fa-xing-square"></i><span class="icon-name">fa-xing-square</span></li><li><i class="fa-yahoo"></i><span class="icon-name">fa-yahoo</span></li><li><i class="fa-yelp"></i><span class="icon-name">fa-yelp</span></li><li><i class="fa-yen"></i><span class="icon-name">fa-yen</span></li><li><i class="fa-youtube"></i><span class="icon-name">fa-youtube</span></li><li><i class="fa-youtube-play"></i><span class="icon-name">fa-youtube-play</span></li><li><i class="fa-youtube-square"></i><span class="icon-name">fa-youtube-square</span></li>';
?>

<!-- Swift Framework Shortcode Panel -->

<!-- OPEN html -->
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- OPEN head -->
	<head>
		
		<!-- Title & Meta -->
		<title><?php _e('Swift Framework Shortcodes', 'swift-framework-admin'); ?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />

		<!-- LOAD scripts -->
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/jquery/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/swift-framework/sf-shortcodes/sf.shortcodes.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/swift-framework/sf-shortcodes/sf.shortcode.embed.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>

		<base target="_self" />
		<link href="<?php echo get_template_directory_uri() ?>/css/ss-gizmo.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo get_template_directory_uri() ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo get_template_directory_uri() ?>/swift-framework/sf-shortcodes/base.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo get_template_directory_uri() ?>/swift-framework/sf-shortcodes/sf-shortcodes-style.css" rel="stylesheet" type="text/css" />

	<!-- CLOSE head -->
	</head>

	<!-- OPEN body -->
	<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" id="link" >
		
		<!-- OPEN swiftframework_shortcode_form -->
		<form name="swiftframework_shortcode_form" action="#">

			<!-- OPEN #shortcode_wrap -->
			<div id="shortcode_wrap">

				<!-- CLOSE #shortcode_panel -->
				<div id="shortcode_panel" class="current">

					<fieldset>

						<h4><?php _e('Select a shortcode', 'swift-framework-admin'); ?></h4>
						<div class="option">
							<label for="shortcode-select"><?php _e('Shortcode', 'swift-framework-admin'); ?></label>
							<select id="shortcode-select" name="shortcode-select">
								<option value="0"></option>
								<option value="shortcode-buttons"><?php _e('Button', 'swift-framework-admin'); ?></option>
								<option value="shortcode-chart"><?php _e('Chart', 'swift-framework-admin'); ?></option>
								<option value="shortcode-columns"><?php _e('Columns', 'swift-framework-admin'); ?></option>
								<option value="shortcode-counters"><?php _e('Counters', 'swift-framework-admin'); ?></option>
								<option value="shortcode-countdown"><?php _e('Countdown', 'swift-framework-admin'); ?></option>
								<option value="shortcode-icons"><?php _e('Icons', 'swift-framework-admin'); ?></option>
								<option value="shortcode-iconbox"><?php _e('Icon Box', 'swift-framework-admin'); ?></option>
								<option value="shortcode-imagebanner"><?php _e('Image Banner', 'swift-framework-admin'); ?></option>
								<option value="shortcode-labelledpricingtables"><?php _e('Labelled Pricing Table', 'swift-framework-admin'); ?></option>
								<option value="shortcode-lists"><?php _e('Lists', 'swift-framework-admin'); ?></option>
								<option value="shortcode-modal"><?php _e('Modal', 'swift-framework-admin'); ?></option>
								<option value="shortcode-pricingtables"><?php _e('Pricing Table', 'swift-framework-admin'); ?></option>
								<option value="shortcode-progressbar"><?php _e('Progress Bar', 'swift-framework-admin'); ?></option>
								<option value="shortcode-fwvideo"><?php _e('Fullscreen Video', 'swift-framework-admin'); ?></option>
								<option value="shortcode-responsivevis"><?php _e('Responsive Visiblity', 'swift-framework-admin'); ?></option>
								<option value="shortcode-social"><?php _e('Social', 'swift-framework-admin'); ?></option>
								<option value="shortcode-social-share"><?php _e('Social share', 'swift-framework-admin'); ?></option>
								<option value="shortcode-tables"><?php _e('Table', 'swift-framework-admin'); ?></option>
								<option value="shortcode-tooltip"><?php _e('Tooltip', 'swift-framework-admin'); ?></option>
								<option value="shortcode-typography"><?php _e('Typography', 'swift-framework-admin'); ?></option>
							</select>
						</div>

					
						<!--//////////////////////////////
						////	BUTTONS
						//////////////////////////////-->

						<div id="shortcode-buttons">
							<h5><?php _e('Buttons', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="button-size"><?php _e('Button size', 'swift-framework-admin'); ?></label>
								<select id="button-size" name="button-size">
									<option value="standard"><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="large"><?php _e('Large', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="button-colour"><?php _e('Button colour', 'swift-framework-admin'); ?></label>
								<select id="button-colour" name="button-colour">
									<option value="accent"><?php _e('Accent', 'swift-framework-admin'); ?></option>
									<option value="black"><?php _e('Black', 'swift-framework-admin'); ?></option>
									<option value="white"><?php _e('White', 'swift-framework-admin'); ?></option>
									<option value="blue"><?php _e('Blue', 'swift-framework-admin'); ?></option>
									<option value="grey"><?php _e('Grey', 'swift-framework-admin'); ?></option>
									<option value="lightgrey"><?php _e('Light Grey', 'swift-framework-admin'); ?></option>
									<option value="orange"><?php _e('Orange', 'swift-framework-admin'); ?></option>
									<option value="turquoise"><?php _e('Turquoise', 'swift-framework-admin'); ?></option>
									<option value="green"><?php _e('Green', 'swift-framework-admin'); ?></option>
									<option value="pink"><?php _e('Pink', 'swift-framework-admin'); ?></option>
									<option value="gold"><?php _e('Gold', 'swift-framework-admin'); ?></option>
									<option value="transparent-light"><?php _e('Transparent - Light (For use on images/dark backgrounds)', 'swift-framework-admin'); ?></option>
									<option value="transparent-dark"><?php _e('Transparent - Dark', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="button-type"><?php _e('Button type', 'swift-framework-admin'); ?></label>
								<select id="button-type" name="button-type">
									<option value="standard"><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="stroke-to-fill"><?php _e('Stroke To Fill', 'swift-framework-admin'); ?></option>
									<option value="sf-icon-reveal"><?php _e('Icon Reveal', 'swift-framework-admin'); ?></option>
									<option value="sf-icon-stroke"><?php _e('Icon Stroke', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="button-dropshadow" class="for-checkbox"><?php _e('Button drop shadow', 'swift-framework-admin'); ?></label>
								<input id="button-dropshadow" class="checkbox" name="button-dropshadow" type="checkbox"/>
							</div>
							<div class="option">
								<label for="button-icon"><?php _e('Button icon (for button types with icon)', 'swift-framework-admin'); ?></label>
								<input type="text" class="search-icon-grid textfield" placeholder="Search Icon">
								<input id="button-icon" name="icon-icon" type="text" value="" style="visibility: hidden;"/>
								<ul class="font-icon-grid"><?php echo $icon_list; ?></ul>
							</div>
							<div class="option">
								<label for="button-text"><?php _e('Button text', 'swift-framework-admin'); ?></label>
								<input id="button-text" name="button-text" type="text" value="<?php _e('Button text', 'swift-framework-admin'); ?>"/>
							</div>
							<div class="option">
								<label for="button-url"><?php _e('Button URL', 'swift-framework-admin'); ?></label>
								<input id="button-url" name="button-url" type="text" value="http://"/>
							</div>
							<div class="option">
								<label for="button-target" class="for-checkbox"><?php _e('Open link in a new window?', 'swift-framework-admin'); ?></label>
								<input id="button-target" class="checkbox" name="button-target" type="checkbox"/>
							</div>
							<div class="option">
								<label for="button-extraclass"><?php _e('Button Extra Class', 'swift-framework-admin'); ?></label>
								<input id="button-extraclass" name="button-extraclass" type="text" value=""/>
								<p class="info">Optional, for extra styling/custom colour control.</a></p>
							</div>
						</div>


						<!--//////////////////////////////
						////	ICONS
						//////////////////////////////-->

						<div id="shortcode-icons">
							<h5><?php _e('Icons', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="icon-size"><?php _e('Icon size', 'swift-framework-admin'); ?></label>
								<select id="icon-size" name="icon-size">
									<option value="small"><?php _e('Small', 'swift-framework-admin'); ?></option>
									<option value="medium"><?php _e('Medium', 'swift-framework-admin'); ?></option>
									<option value="large"><?php _e('Large', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="icon-image"><?php _e('Icon image', 'swift-framework-admin'); ?></label>
								<input type="text" class="search-icon-grid textfield" placeholder="Search Icon">
								<input id="icon-image" name="icon-image" type="text" value="" style="visibility: hidden;"/>
								<ul class="font-icon-grid"><?php echo $icon_list; ?></ul>
							</div>
							<div class="option">
								<label for="icon-character"><?php _e('Icon Character', 'swift-framework-admin'); ?></label>
								<input id="icon-character" name="icon-character" type="text" value=""/>
								<p class="info">Instead of an icon, you can optionally provide a single letter/digit here. NOTE: This will override the icon selection.</p>
							</div>
							<div class="option">
								<label for="icon-cont"><?php _e('Circular container', 'swift-framework-admin'); ?></label>
								<select id="icon-cont" name="icon-cont">
									<option value="no"><?php _e('No', 'swift-framework-admin'); ?></option>
									<option value="yes"><?php _e('Yes', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="icon-float"><?php _e('Icon float', 'swift-framework-admin'); ?></label>
								<select id="icon-float" name="icon-float">
									<option value="left"><?php _e('Left', 'swift-framework-admin'); ?></option>
									<option value="right"><?php _e('Right', 'swift-framework-admin'); ?></option>
									<option value="none"><?php _e('None', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="icon-color"><?php _e('Icon Color', 'swift-framework-admin'); ?></label>
								<select id="icon-color" name="icon-color">
									<option value="standard"><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="accent"><?php _e('Accent', 'swift-framework-admin'); ?></option>
									<option value="secondary-accent"><?php _e('Secondary Accent', 'swift-framework-admin'); ?></option>
									<option value="icon-one"><?php _e('Icon One', 'swift-framework-admin'); ?></option>
									<option value="icon-two"><?php _e('Icon Two', 'swift-framework-admin'); ?></option>
									<option value="icon-three"><?php _e('Icon Three', 'swift-framework-admin'); ?></option>
									<option value="icon-four"><?php _e('Icon Four', 'swift-framework-admin'); ?></option>
									<p class="info">These colours are all set in the Color Customiser (link in the WP Admin Bar).</p>
								</select>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	ICON BOX
						//////////////////////////////-->

						<div id="shortcode-iconbox">
							<h5><?php _e('Icon Box', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="iconbox-type"><?php _e('Icon Box Type', 'swift-framework-admin'); ?></label>
								<select id="iconbox-type" name="iconbox-type">
									<option value="standard"><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="standard-title"><?php _e('Standard Title Icon', 'swift-framework-admin'); ?></option>
									<option value="left-icon"><?php _e('Left Icon', 'swift-framework-admin'); ?></option>
									<option value="left-icon-alt"><?php _e('Left Icon Type 2', 'swift-framework-admin'); ?></option>
									<option value="boxed-one"><?php _e('Boxed Icon Box', 'swift-framework-admin'); ?></option>
									<option value="boxed-two"><?php _e('Boxed Icon Box Type 2', 'swift-framework-admin'); ?></option>
									<option value="boxed-three"><?php _e('Boxed Icon Box Type 3', 'swift-framework-admin'); ?></option>
									<option value="boxed-four"><?php _e('Boxed Icon Box Type 4', 'swift-framework-admin'); ?></option>
									<option value="animated"><?php _e('Animated', 'swift-framework-admin'); ?></option>	
								</select>
							</div>
							<div class="option">
								<label for="iconbox-image"><?php _e('Icon Box Image', 'swift-framework-admin'); ?></label>
								<input type="text" class="search-icon-grid textfield" placeholder="Search Icon">
								<input id="iconbox-image" name="iconbox-image" type="text" value="" style="visibility: hidden;"/>
								<ul class="font-icon-grid"><?php echo $icon_list; ?></ul>
							</div>
							<div class="option">
								<label for="iconbox-character"><?php _e('Icon Character', 'swift-framework-admin'); ?></label>
								<input id="iconbox-character" name="iconbox-character" type="text" value=""/>
								<p class="info">Instead of an icon, you can optionally provide a single letter/digit here. NOTE: This will override the icon selection.</p>
							</div>
							<div class="option">
								<label for="iconbox-color"><?php _e('Icon Color', 'swift-framework-admin'); ?></label>
								<select id="iconbox-color" name="iconbox-color">
									<option value="standard"><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="accent"><?php _e('Accent', 'swift-framework-admin'); ?></option>
									<option value="secondary-accent"><?php _e('Secondary Accent', 'swift-framework-admin'); ?></option>
									<option value="icon-one"><?php _e('Icon One', 'swift-framework-admin'); ?></option>
									<option value="icon-two"><?php _e('Icon Two', 'swift-framework-admin'); ?></option>
									<option value="icon-three"><?php _e('Icon Three', 'swift-framework-admin'); ?></option>
									<option value="icon-four"><?php _e('Icon Four', 'swift-framework-admin'); ?></option>
									<p class="info">These colours are all set in the Color Customiser (link in the WP Admin Bar).</p>
								</select>
							</div>
							<div class="option">
								<label for="iconbox-title"><?php _e('Icon Box Title', 'swift-framework-admin'); ?></label>
								<input id="iconbox-title" name="iconbox-title" type="text" value=""/>
							</div>
							<div class="option">
								<label for="iconbox-link"><?php _e('Icon Box Link', 'swift-framework-admin'); ?></label>
								<input id="iconbox-link" name="iconbox-link" type="text" value=""/>
								<p class="info">This is optional, only provide if you'd like the icon box to link on click.</p>
							</div>
							<div class="option">
								<label for="iconbox-target" class="for-checkbox"><?php _e('Open link in a new window?', 'swift-framework-admin'); ?></label>
								<input id="iconbox-target" class="checkbox" name="iconbox-target" type="checkbox"/>
							</div>
							<div class="option">
								<label for="iconbox-animation"><?php _e('Icon Box Animation', 'swift-framework-admin'); ?></label>
								<select id="iconbox-animation" name="iconbox-animation">
									<option value="none"><?php _e('None', 'swift-framework-admin'); ?></option>
									<option value="fade-in"><?php _e('Fade in', 'swift-framework-admin'); ?></option>
									<option value="fade-from-left"><?php _e('Fade from left', 'swift-framework-admin'); ?></option>
									<option value="fade-from-right"><?php _e('Fade from right', 'swift-framework-admin'); ?></option>
									<option value="fade-from-bottom"><?php _e('Fade from bottom', 'swift-framework-admin'); ?></option>
									<option value="move-up"><?php _e('Move up', 'swift-framework-admin'); ?></option>
									<option value="grow"><?php _e('Grow', 'swift-framework-admin'); ?></option>
									<option value="helix"><?php _e('Helix', 'swift-framework-admin'); ?></option>	
									<option value="flip"><?php _e('Flip', 'swift-framework-admin'); ?></option>	
									<option value="pop-up"><?php _e('Pop up', 'swift-framework-admin'); ?></option>	
									<option value="spin"><?php _e('Spin', 'swift-framework-admin'); ?></option>	
									<option value="flip-x"><?php _e('Flip X', 'swift-framework-admin'); ?></option>	
									<option value="flip-y"><?php _e('Flip Y', 'swift-framework-admin'); ?></option>	
								</select>
							</div>
							<div class="option">
								<label for="iconbox-animation-delay"><?php _e('Icon Box Animation Delay', 'swift-framework-admin'); ?></label>
								<input id="iconbox-animation-delay" name="iconbox-animation-delay" type="text" value="200"/>
								<p class="info">This value determines the delay to which the animation starts once it's visible on the screen.</p>
							</div>
						</div>
												

						<!--//////////////////////////////
						////	SOCIAL
						//////////////////////////////-->

						<div id="shortcode-social">
							<h5><?php _e('Social', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="social-size"><?php _e('Social Icon Size', 'swift-framework-admin'); ?></label>
								<select id="social-size" name="social-size">
									<option value="standard"><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="large"><?php _e('Large', 'swift-framework-admin'); ?></option>
								</select>
							</div>
						</div>


						<!--//////////////////////////////
						////	SOCIAL SHARE
						//////////////////////////////-->

						<div id="shortcode-social-share">
							<h5><?php _e('Social share', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<p class="info">This shortcode will embed the social share links asset, for sharing the current post/page on social media.</p>
							</div>
						</div>
						

						<!--//////////////////////////////
						////	TYPOGRAPHY
						//////////////////////////////-->

						<div id="shortcode-typography">
							<h5><?php _e('Typography', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="typography-type"><?php _e('Type', 'swift-framework-admin'); ?></label>
								<select id="typography-type" name="typography-type">
									<option value="0"></option>
									<option value="highlight"><?php _e('Highlight', 'swift-framework-admin'); ?></option>
									<option value="decorative_ampersand"><?php _e('Decorative Ampersand', 'swift-framework-admin'); ?></option>
									<option value="blockquote1"><?php _e('Blockquote Standard', 'swift-framework-admin'); ?></option>
									<option value="blockquote2"><?php _e('Blockquote Medium', 'swift-framework-admin'); ?></option>
									<option value="blockquote3"><?php _e('Blockquote Big', 'swift-framework-admin'); ?></option>
									<option value="pullquote"><?php _e('Pull Quote', 'swift-framework-admin'); ?></option>
									<option value="dropcap1"><?php _e('Dropcap Type 1', 'swift-framework-admin'); ?></option>
									<option value="dropcap2"><?php _e('Dropcap Type 2', 'swift-framework-admin'); ?></option>
									<option value="dropcap3"><?php _e('Dropcap Type 3', 'swift-framework-admin'); ?></option>
									<option value="dropcap4"><?php _e('Dropcap Type 4', 'swift-framework-admin'); ?></option>
								</select>
							</div>
						</div>


						<!--//////////////////////////////
						////	COLUMNS
						//////////////////////////////-->

						<div id="shortcode-columns" class="shortcode-option">
							<h5><?php _e('Columns', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="column-options"><?php _e('Layout', 'swift-framework-admin'); ?></label>
								<select id="column-options" name="column-options">
									<option value="0"></option>
									<option value="two_halves"><?php _e('1/2 + 1/2', 'swift-framework-admin'); ?></option>
									<option value="three_thirds"><?php _e('1/3 + 1/3 + 1/3', 'swift-framework-admin'); ?></option>
									<option value="one_third_two_thirds"><?php _e('1/3 + 2/3', 'swift-framework-admin'); ?></option>
									<option value="two_thirds_one_third"><?php _e('2/3 + 1/3', 'swift-framework-admin'); ?></option>
									<option value="four_quarters"><?php _e('1/4 + 1/4 + 1/4 + 1/4', 'swift-framework-admin'); ?></option>
									<option value="one_quarter_three_quarters"><?php _e('1/4 + 3/4', 'swift-framework-admin'); ?></option>
									<option value="three_quarters_one_quarter"><?php _e('3/4 + 1/4', 'swift-framework-admin'); ?></option>
									<option value="one_quarter_one_quarter_one_half"><?php _e('1/4 + 1/4 + 1/2', 'swift-framework-admin'); ?></option>
									<option value="one_quarter_one_half_one_quarter"><?php _e('1/4 + 1/2 + 1/4', 'swift-framework-admin'); ?></option>
									<option value="one_half_one_quarter_one_quarter"><?php _e('1/2 + 1/4 + 1/4', 'swift-framework-admin'); ?></option>
								</select>
							</div>
						</div>
						
						<!--//////////////////////////////
						////	PROGRESS BAR
						//////////////////////////////-->

						<div id="shortcode-progressbar" class="shortcode-option">
							<h5><?php _e('Progress Bar', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="progressbar-percentage"><?php _e('Percentage', 'swift-framework-admin'); ?></label>
								<input id="progressbar-percentage" name="progressbar-percentage" type="text" value=""/>
								<p class="info">Enter the percentage of the progress bar.</p>
							</div>
							<div class="option">
								<label for="progressbar-text"><?php _e('Progress Text', 'swift-framework-admin'); ?></label>
								<input id="progressbar-text" name="progressbar-text" type="text" value=""/>
								<p class="info">Enter the text that you'd like shown above the bar, i.e. "COMPLETED".</p>
							</div>
							<div class="option">
								<label for="progressbar-value"><?php _e('Progress Value', 'swift-framework-admin'); ?></label>
								<input id="progressbar-value" name="progressbar-value" type="text" value=""/>
								<p class="info">Enter value that you'd like shown at the end of the bar on completion, i.e. "90%".</p>
							</div>
							<div class="option">
								<label for="progressbar-type"><?php _e('Progress Bar Type', 'swift-framework-admin'); ?></label>
								<select id="progressbar-type" name="progressbar-type">
									<option value=""><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="progress-striped"><?php _e('Striped', 'swift-framework-admin'); ?></option>
									<option value="progress-striped active"><?php _e('Striped - Animated', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="progressbar-colour"><?php _e('Progress Bar Colour', 'swift-framework-admin'); ?></label>
								<input id="progressbar-colour" name="progressbar-colour" type="text" value=""/>
								<p class="info">Enter the hex value (with the #) for the progress bar colour, or it will default to accent colour.</p>
							</div>
						</div>
					
						
						<!--//////////////////////////////
						////	FULLSCREEN VIDEO
						//////////////////////////////-->

						<div id="shortcode-fwvideo" class="shortcode-option">
							<h5><?php _e('Fullscreen Video', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="fwvideo-type"><?php _e('Button type', 'swift-framework-admin'); ?></label>
								<select id="fwvideo-type" name="fwvideo-type">
									<option value="image-button"><?php _e('Image Button', 'swift-framework-admin'); ?></option>
									<option value="icon-button"><?php _e('Icon Button', 'swift-framework-admin'); ?></option>
									<option value="text-button"><?php _e('Text Button', 'swift-framework-admin'); ?></option>
								</select>
								<p class="info">Choose the button type you'd like to link to the fullscreen video.</p>
							</div>
							<div class="option">
								<label for="fwvideo-imageurl"><?php _e('Image URL (for image button)', 'swift-framework-admin'); ?></label>
								<input id="fwvideo-imageurl" name="fwvideo-imageurl" type="text" value=""/>
								<p class="info">If you've chosen the image button above, then please enter the full path for the image that you wish the fullscreen video to be linked from.</p>
							</div>
							<div class="option">
								<label for="fwvideo-btntext"><?php _e('Button Text (for text button)', 'swift-framework-admin'); ?></label>
								<input id="fwvideo-btntext" name="fwvideo-btntext" type="text" value=""/>
								<p class="info">If you've chosen the text button above, then please enter the text you'd like to show on the button. This also functions as the alt text for an image button.</p>
							</div>
							<div class="option">
								<label for="fwvideo-videourl"><?php _e('Video URL', 'swift-framework-admin'); ?></label>
								<input id="fwvideo-videourl" name="fwvideo-videourl" type="text" value=""/>
								<p class="info">Enter the video URL here. Vimeo/YouTube are supported, and please make sure you enter the full video URL, not shortened, and HTTP only.</p>
							</div>
							<div class="option">
								<label for="fwvideo-extraclass"><?php _e('Button Extra class', 'swift-framework-admin'); ?></label>
								<input id="fwvideo-extraclass" name="fwvideo-extraclass" type="text" value=""/>
								<p class="info">Provide any extra classes you'd like to add here (optional).</p>
							</div>
						</div>

						
						<!--//////////////////////////////
						////	RESPONSIVE VISIBILITY
						//////////////////////////////-->

						<div id="shortcode-responsivevis" class="shortcode-option">
							<h5><?php _e('Responsive Visibility', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="responsivevis-config"><?php _e('Device Visiblity', 'swift-framework-admin'); ?></label>
								<select id="responsivevis-config" name="responsivevis-config">
									<option value="visible-xs"><?php _e('Visible - Phone', 'swift-framework-admin'); ?></option>
									<option value="visible-md visible-sm"><?php _e('Visible - Tablet', 'swift-framework-admin'); ?></option>
									<option value="visible-lg"><?php _e('Visible - Desktop', 'swift-framework-admin'); ?></option>
									<option value="hidden-xs"><?php _e('Hidden - Phone', 'swift-framework-admin'); ?></option>
									<option value="hidden-md hidden-sm"><?php _e('Hidden - Tablet', 'swift-framework-admin'); ?></option>
									<option value="hidden-lg"><?php _e('Hidden - Desktop', 'swift-framework-admin'); ?></option>
								</select>
								<p class="info">Choose the responsive visibility for the content within the shortcode.</p>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	TOOLTIP
						//////////////////////////////-->

						<div id="shortcode-tooltip" class="shortcode-option">
							<h5><?php _e('Tooltip', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="tooltip-text"><?php _e('Text', 'swift-framework-admin'); ?></label>
								<input id="tooltip-text" name="tooltip-text" type="text" value=''/>
								<p class="info">Enter the text for the tooltip.</p>
							</div>
							<div class="option">
								<label for="tooltip-link"><?php _e('Link', 'swift-framework-admin'); ?></label>
								<input id="tooltip-link" name="tooltip-link" type="text" value=""/>
								<p class="info">Enter the link that the tooltip text links to.</p>
							</div>
							<div class="option">
								<label for="tooltip-direction"><?php _e('Direction', 'swift-framework-admin'); ?></label>
								<select id="tooltip-direction" name="tooltip-direction">
									<option value="top"><?php _e('Top', 'swift-framework-admin'); ?></option>
									<option value="bottom"><?php _e('Bottom', 'swift-framework-admin'); ?></option>
									<option value="left"><?php _e('Left', 'swift-framework-admin'); ?></option>
									<option value="right"><?php _e('Right', 'swift-framework-admin'); ?></option>
								</select>
								<p class="info">Choose the direction in which the tooltip appears.</p>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	MODAL
						//////////////////////////////-->

						<div id="shortcode-modal" class="shortcode-option">
							<h5><?php _e('Modal', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="modal-button-size"><?php _e('Modal Button size', 'swift-framework-admin'); ?></label>
								<select id="modal-button-size" name="modal-button-size">
									<option value="standard"><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="large"><?php _e('Large', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="modal-button-colour"><?php _e('Modal Button colour', 'swift-framework-admin'); ?></label>
								<select id="modal-button-colour" name="modal-button-colour">
									<option value="accent"><?php _e('Accent', 'swift-framework-admin'); ?></option>
									<option value="black"><?php _e('Black', 'swift-framework-admin'); ?></option>
									<option value="white"><?php _e('White', 'swift-framework-admin'); ?></option>
									<option value="blue"><?php _e('Blue', 'swift-framework-admin'); ?></option>
									<option value="grey"><?php _e('Grey', 'swift-framework-admin'); ?></option>
									<option value="lightgrey"><?php _e('Light Grey', 'swift-framework-admin'); ?></option>
									<option value="orange"><?php _e('Orange', 'swift-framework-admin'); ?></option>
									<option value="turquoise"><?php _e('Turquoise', 'swift-framework-admin'); ?></option>
									<option value="green"><?php _e('Green', 'swift-framework-admin'); ?></option>
									<option value="pink"><?php _e('Pink', 'swift-framework-admin'); ?></option>
									<option value="gold"><?php _e('Gold', 'swift-framework-admin'); ?></option>
									<option value="transparent-light"><?php _e('Transparent - Light (For use on images/dark backgrounds)', 'swift-framework-admin'); ?></option>
									<option value="transparent-dark"><?php _e('Transparent - Dark', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="modal-button-type"><?php _e('Modal Button type', 'swift-framework-admin'); ?></label>
								<select id="modal-button-type" name="modal-button-type">
									<option value="standard"><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="stroke-to-fill"><?php _e('Stroke To Fill', 'swift-framework-admin'); ?></option>
									<option value="sf-icon-reveal"><?php _e('Icon Reveal', 'swift-framework-admin'); ?></option>
									<option value="sf-icon-stroke"><?php _e('Icon Stroke', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="modal-button-text"><?php _e('Modal Button text', 'swift-framework-admin'); ?></label>
								<input id="modal-button-text" name="modal-button-text" type="text" value="<?php _e('Button text', 'swift-framework-admin'); ?>"/>
							</div>
							<div class="option">
								<label for="modal-button-icon"><?php _e('Modal Button Icon', 'swift-framework-admin'); ?></label>
								<input type="text" class="search-icon-grid textfield" placeholder="Search Icon">
								<input id="modal-button-icon" name="modal-button-icon" type="text" value="" style="visibility: hidden;height: 0;"/>
								<ul class="font-icon-grid"><?php echo $icon_list; ?></ul>
							</div>
							<div class="option">
								<label for="modal-header"><?php _e('Header', 'swift-framework-admin'); ?></label>
								<input id="modal-header" name="modal-header" type="text" value=''/>
								<p class="info">Enter the heading for the modal popup.</p>
							</div>
						</div>					
										
												
						<!--//////////////////////////////
						////	CHART
						//////////////////////////////-->

						<div id="shortcode-chart" class="shortcode-option">
							<h5><?php _e('Chart', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="chart-percentage"><?php _e('Percentage', 'swift-framework-admin'); ?></label>
								<input id="chart-percentage" name="chart-percentage" type="text" value=""/>
								<p class="info">Enter the percentage of the chart value. NOTE: This must be between 0-100, numeric only.</p>
							</div>
							<div class="option">
								<label for="chart-content"><?php _e('Content', 'swift-framework-admin'); ?></label>
								<input id="chart-content" name="chart-content" type="text" value=''/>
								<p class="info">Enter the content for the center of the chart, i.e. a number or percentage. NOTE: if you'd like to include a font awesome icon or Gizmo icon here, just enter the icon name, i.e. "fa-magic".</p>
							</div>
							<div class="option">
								<label for="chart-size"><?php _e('Chart Size', 'swift-framework-admin'); ?></label>
								<select id="chart-size" name="chart-size">
									<option value="70"><?php _e('Standard', 'swift-framework-admin'); ?></option>
									<option value="170"><?php _e('Large', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="chart-barcolour"><?php _e('Chart Bar Colour', 'swift-framework-admin'); ?></label>
								<input id="chart-barcolour" name="chart-barcolour" type="text" value=""/>
								<p class="info">Enter the hex value (with the #) for the chart bar colour.</p>
							</div>
							<div class="option">
								<label for="chart-trackcolour"><?php _e('Chart Track Colour', 'swift-framework-admin'); ?></label>
								<input id="chart-trackcolour" name="chart-trackcolour" type="text" value=""/>
								<p class="info">Enter the hex value (with the #) for the chart track colour (the path the bar follows).</p>
							</div>
							<div class="option">
								<label for="chart-align"><?php _e('Chart Align', 'swift-framework-admin'); ?></label>
								<select id="chart-align" name="chart-align">
									<option value="left"><?php _e('Left', 'swift-framework-admin'); ?></option>
									<option value="center"><?php _e('Center', 'swift-framework-admin'); ?></option>
								</select>
							</div>
						</div>
						
												
						<!--//////////////////////////////
						////	COUNTERS
						//////////////////////////////-->

						<div id="shortcode-counters" class="shortcode-option">
							<h5><?php _e('Counters', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="count-from"><?php _e('From Value', 'swift-framework-admin'); ?></label>
								<input id="count-from" name="count-from" type="text" value=""/>
								<p class="info">Enter the number from which the counter starts at.</p>
							</div>
							<div class="option">
								<label for="count-to"><?php _e('To Value', 'swift-framework-admin'); ?></label>
								<input id="count-to" name="count-to" type="text" value=""/>
								<p class="info">Enter the number from which the counter counts up to.</p>
							</div>
							<div class="option">
								<label for="count-prefix"><?php _e('Prefix Text', 'swift-framework-admin'); ?></label>
								<input id="count-prefix" name="count-prefix" type="text" value=""/>
								<p class="info">Enter the text which you would like to show before the count number (optional).</p>
							</div>
							<div class="option">
								<label for="count-suffix"><?php _e('Suffix Text', 'swift-framework-admin'); ?></label>
								<input id="count-suffix" name="count-suffix" type="text" value=""/>
								<p class="info">Enter the text which you would like to show after the count number (optional).</p>
							</div>
							<div class="option">
								<label for="count-commas" class="for-checkbox"><?php _e('Comma Seperated', 'swift-framework-admin'); ?></label>
								<input id="count-commas" class="checkbox" name="count-commas" type="checkbox"/>
								<p class="info">Include comma seperators in the numbers after every 3rd digit.</p>
							</div>
							<div class="option">
								<label for="count-subject"><?php _e('Subject Text', 'swift-framework-admin'); ?></label>
								<input id="count-subject" name="count-subject" type="text" value=""/>
								<p class="info">Enter the text which you would like to show below the counter.</p>
							</div>
							<div class="option">
								<label for="count-speed"><?php _e('Speed', 'swift-framework-admin'); ?></label>
								<input id="count-speed" name="count-speed" type="text" value=""/>
								<p class="info">Enter the time you want the counter to take to complete, this is in milliseconds and optional. The default is 2000.</p>
							</div>
							<div class="option">
								<label for="count-refresh"><?php _e('Refresh Interval', 'swift-framework-admin'); ?></label>
								<input id="count-refresh" name="count-refresh" type="text" value=""/>
								<p class="info">Enter the time to wait between refreshing the counter. This is in milliseconds and optional. The default is 25.</p>
							</div>
							<div class="option">
								<label for="count-textstyle"><?php _e('Text style', 'swift-framework-admin'); ?></label>
								<select id="count-textstyle" name="count-textstyle">
									<option value="h3"><?php _e('H3', 'swift-framework-admin'); ?></option>
									<option value="h6"><?php _e('H6', 'swift-framework-admin'); ?></option>
									<option value="div"><?php _e('Body', 'swift-framework-admin'); ?></option>
								</select>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	COUNTDOWN
						//////////////////////////////-->
	
						<div id="shortcode-countdown" class="shortcode-option">
							<h5><?php _e('Countdown', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="countdown-year"><?php _e('Year', 'swift-framework-admin'); ?></label>
								<input id="countdown-year" name="countdown-year" type="text" value=""/>
								<p class="info">Enter the year for which you want the countdown to count to (e.g. 2020).</p>
							</div>
							<div class="option">
								<label for="countdown-month"><?php _e('Month', 'swift-framework-admin'); ?></label>
								<input id="countdown-month" name="countdown-month" type="text" value=""/>
								<p class="info">Enter the month for which you want the countdown to count to (e.g. 10).</p>
							</div>
							<div class="option">
								<label for="countdown-day"><?php _e('Day', 'swift-framework-admin'); ?></label>
								<input id="countdown-day" name="countdown-day" type="text" value=""/>
								<p class="info">Enter the day for which you want the countdown to count to (e.g. 24).</p>
							</div>
							<div class="option">
								<label for="countdown-hour"><?php _e('Hour', 'swift-framework-admin'); ?></label>
								<input id="countdown-hour" name="countdown-hour" type="text" value=""/>
								<p class="info">Enter the hour for which you want the countdown to count to (e.g. 12) (24 hour format).</p>
							</div>
							<div class="option">
								<label for="countdown-type"><?php _e('Countdown Type', 'swift-framework-admin'); ?></label>
								<select id="countdown-type" name="countdown-type">
									<option value="countdown"><?php _e('Count Down', 'swift-framework-admin'); ?></option>
									<option value="countup"><?php _e('Count Up', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="countdown-fontsize"><?php _e('Countdown Font Size', 'swift-framework-admin'); ?></label>
								<select id="countdown-fontsize" name="countdown-fontsize">
									<option value="small"><?php _e('Small', 'swift-framework-admin'); ?></option>
									<option value="large"><?php _e('Large', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="countdown-displaytext"><?php _e('Display Text', 'swift-framework-admin'); ?></label>
								<input id="countdown-displaytext" name="countdown-displaytext" type="text" value=""/>
								<p class="info">Enter the text that you want to show below the countdown (optional).</p>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	IMAGE BANNER
						//////////////////////////////-->
	
						<div id="shortcode-imagebanner" class="shortcode-option">
							<h5><?php _e('Image Banner', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="imagebanner-image"><?php _e('Background Image', 'swift-framework-admin'); ?></label>
								<input id="imagebanner-image" name="imagebanner-image" type="text" value=""/>
								<p class="info">Provide the URL here for the background image that you would like to use.</p>
							</div>
							<div class="option">
								<label for="imagebanner-animation"><?php _e('Content Animation', 'swift-framework-admin'); ?></label>
								<select id="imagebanner-animation" name="imagebanner-animation">
									<option value="none"><?php _e('None', 'swift-framework-admin'); ?></option>
									<option value="fade-in"><?php _e('Fade in', 'swift-framework-admin'); ?></option>
									<option value="fade-from-left"><?php _e('Fade from left', 'swift-framework-admin'); ?></option>
									<option value="fade-from-right"><?php _e('Fade from right', 'swift-framework-admin'); ?></option>
									<option value="fade-from-bottom"><?php _e('Fade from bottom', 'swift-framework-admin'); ?></option>
									<option value="move-up"><?php _e('Move up', 'swift-framework-admin'); ?></option>
									<option value="grow"><?php _e('Grow', 'swift-framework-admin'); ?></option>
									<option value="helix"><?php _e('Helix', 'swift-framework-admin'); ?></option>	
									<option value="flip"><?php _e('Flip', 'swift-framework-admin'); ?></option>	
									<option value="pop-up"><?php _e('Pop up', 'swift-framework-admin'); ?></option>	
									<option value="spin"><?php _e('Spin', 'swift-framework-admin'); ?></option>	
									<option value="flip-x"><?php _e('Flip X', 'swift-framework-admin'); ?></option>	
									<option value="flip-y"><?php _e('Flip Y', 'swift-framework-admin'); ?></option>	
								</select>
								<p class="info">Choose the intro animation for the content.</p>
							</div>
							<div class="option">
								<label for="imagebanner-contentpos"><?php _e('Content Position', 'swift-framework-admin'); ?></label>
								<select id="imagebanner-contentpos" name="imagebanner-contentpos">
									<option value="left"><?php _e('Left', 'swift-framework-admin'); ?></option>
									<option value="center"><?php _e('Center', 'swift-framework-admin'); ?></option>
									<option value="right"><?php _e('Right', 'swift-framework-admin'); ?></option>
								</select>
								<p class="info">Choose the alignment for the content.</p>
							</div>
							<div class="option">
								<label for="imagebanner-textalign"><?php _e('Text Align', 'swift-framework-admin'); ?></label>
								<select id="imagebanner-textalign" name="imagebanner-textalign">
									<option value="left"><?php _e('Left', 'swift-framework-admin'); ?></option>
									<option value="center"><?php _e('Center', 'swift-framework-admin'); ?></option>
									<option value="right"><?php _e('Right', 'swift-framework-admin'); ?></option>
								</select>
								<p class="info">Choose the alignment for the text within the content.</p>
							</div>
							<div class="option">
								<label for="imagebanner-extraclass"><?php _e('Extra class', 'swift-framework-admin'); ?></label>
								<input id="imagebanner-extraclass" name="imagebanner-extraclass" type="text" value=""/>
								<p class="info">Provide any extra classes you'd like to add here (optional).</p>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	TABLE
						//////////////////////////////-->

						<div id="shortcode-tables" class="shortcode-option">
							<h5><?php _e('Tables', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="table-type"><?php _e('Table style', 'swift-framework-admin'); ?></label>
								<select id="table-type" name="table-type">
									<option value="standard_minimal"><?php _e('Standard minimal table', 'swift-framework-admin'); ?></option>
									<option value="striped_minimal"><?php _e('Striped minimal table', 'swift-framework-admin'); ?></option>
									<option value="standard_bordered"><?php _e('Standard bordered table', 'swift-framework-admin'); ?></option>
									<option value="striped_bordered"><?php _e('Striped bordered table', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="table-head"><?php _e('Table Head', 'swift-framework-admin'); ?></label>
								<select id="table-head" name="table-head">
									<option value="yes"><?php _e('Yes', 'swift-framework-admin'); ?></option>
									<option value="no"><?php _e('No', 'swift-framework-admin'); ?></option>
									<p class="info">Include a heading row in the table</p>
								</select>
							</div>
							<div class="option">
								<label for="table-columns"><?php _e('Number of columns', 'swift-framework-admin'); ?></label>
								<select id="table-columns" name="table-columns">
									<option value="1"><?php _e('1', 'swift-framework-admin'); ?></option>
									<option value="2"><?php _e('2', 'swift-framework-admin'); ?></option>
									<option value="3"><?php _e('3', 'swift-framework-admin'); ?></option>
									<option value="4"><?php _e('4', 'swift-framework-admin'); ?></option>
									<option value="5"><?php _e('5', 'swift-framework-admin'); ?></option>
									<option value="6"><?php _e('6', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							
							<div class="option">
								<label for="table-rows"><?php _e('Number of rows', 'swift-framework-admin'); ?></label>
								<select id="table-rows" name="table-rows">
									<option value="1"><?php _e('1', 'swift-framework-admin'); ?></option>
									<option value="2"><?php _e('2', 'swift-framework-admin'); ?></option>
									<option value="3"><?php _e('3', 'swift-framework-admin'); ?></option>
									<option value="4"><?php _e('4', 'swift-framework-admin'); ?></option>
									<option value="5"><?php _e('5', 'swift-framework-admin'); ?></option>
									<option value="6"><?php _e('6', 'swift-framework-admin'); ?></option>
									<option value="7"><?php _e('7', 'swift-framework-admin'); ?></option>
									<option value="8"><?php _e('8', 'swift-framework-admin'); ?></option>
									<option value="9"><?php _e('9', 'swift-framework-admin'); ?></option>
									<option value="10"><?php _e('10', 'swift-framework-admin'); ?></option>
								</select>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	PRICING TABLE
						//////////////////////////////-->

						<div id="shortcode-pricingtables" class="shortcode-option">
							<h5><?php _e('Pricing Tables', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="ptable-type"><?php _e('Table style', 'swift-framework-admin'); ?></label>
								<select id="ptable-type" name="ptable-type">
									<option value="standard"><?php _e('Standard pricing table', 'swift-framework-admin'); ?></option>
									<option value="bordered"><?php _e('Bordered pricing table', 'swift-framework-admin'); ?></option>
									<option value="bordered_alt"><?php _e('Alt bordered pricing table', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="ptable-columns"><?php _e('Number of columns', 'swift-framework-admin'); ?></label>
								<select id="ptable-columns" name="ptable-columns">
									<option value="1"><?php _e('1', 'swift-framework-admin'); ?></option>
									<option value="2"><?php _e('2', 'swift-framework-admin'); ?></option>
									<option value="3"><?php _e('3', 'swift-framework-admin'); ?></option>
									<option value="4"><?php _e('4', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="ptable-highlight"><?php _e('Highlighted column', 'swift-framework-admin'); ?></label>
								<select id="ptable-highlight" name="ptable-highlight">
									<option value="0"></option>
									<option value="1"><?php _e('1', 'swift-framework-admin'); ?></option>
									<option value="2"><?php _e('2', 'swift-framework-admin'); ?></option>
									<option value="3"><?php _e('3', 'swift-framework-admin'); ?></option>
									<option value="4"><?php _e('4', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="ptable-buttontext"><?php _e('Button text', 'swift-framework-admin'); ?></label>
								<input id="ptable-buttontext" name="ptable-buttontext" type="text" value=""/>
								<p class="info">Enter the button text here, or leave blank to hide the button.</p>
							</div>
						</div>
						
						
						<!--//////////////////////////////
						////	LABELLED PRICING TABLE
						//////////////////////////////-->

						<div id="shortcode-labelledpricingtables" class="shortcode-option">
							<h5><?php _e('Labelled Pricing Table', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="lptable-columns"><?php _e('Number of columns', 'swift-framework-admin'); ?></label>
								<select id="lptable-columns" name="lptable-columns">
									<option value="1"><?php _e('1', 'swift-framework-admin'); ?></option>
									<option value="2"><?php _e('2', 'swift-framework-admin'); ?></option>
									<option value="3"><?php _e('3', 'swift-framework-admin'); ?></option>
									<option value="4"><?php _e('4', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="lptable-highlight"><?php _e('Highlighted column', 'swift-framework-admin'); ?></label>
								<select id="lptable-highlight" name="lptable-highlight">
									<option value="0"></option>
									<option value="1"><?php _e('1', 'swift-framework-admin'); ?></option>
									<option value="2"><?php _e('2', 'swift-framework-admin'); ?></option>
									<option value="3"><?php _e('3', 'swift-framework-admin'); ?></option>
									<option value="4"><?php _e('4', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="lptable-rows"><?php _e('Number of rows', 'swift-framework-admin'); ?></label>
								<select id="lptable-rows" name="lptable-highlight">
									<option value="1"><?php _e('1', 'swift-framework-admin'); ?></option>
									<option value="2"><?php _e('2', 'swift-framework-admin'); ?></option>
									<option value="3"><?php _e('3', 'swift-framework-admin'); ?></option>
									<option value="4"><?php _e('4', 'swift-framework-admin'); ?></option>
									<option value="5"><?php _e('5', 'swift-framework-admin'); ?></option>
									<option value="6"><?php _e('6', 'swift-framework-admin'); ?></option>
									<option value="7"><?php _e('7', 'swift-framework-admin'); ?></option>
									<option value="8"><?php _e('8', 'swift-framework-admin'); ?></option>
									<option value="9"><?php _e('9', 'swift-framework-admin'); ?></option>
									<option value="10"><?php _e('10', 'swift-framework-admin'); ?></option>
									<option value="11"><?php _e('11', 'swift-framework-admin'); ?></option>
									<option value="12"><?php _e('12', 'swift-framework-admin'); ?></option>
									<option value="13"><?php _e('13', 'swift-framework-admin'); ?></option>
									<option value="14"><?php _e('14', 'swift-framework-admin'); ?></option>
									<option value="15"><?php _e('15', 'swift-framework-admin'); ?></option>
									<option value="16"><?php _e('16', 'swift-framework-admin'); ?></option>
									<option value="17"><?php _e('17', 'swift-framework-admin'); ?></option>
									<option value="18"><?php _e('18', 'swift-framework-admin'); ?></option>
									<option value="19"><?php _e('19', 'swift-framework-admin'); ?></option>
									<option value="20"><?php _e('20', 'swift-framework-admin'); ?></option>
									<option value="21"><?php _e('21', 'swift-framework-admin'); ?></option>
									<option value="22"><?php _e('22', 'swift-framework-admin'); ?></option>
									<option value="23"><?php _e('23', 'swift-framework-admin'); ?></option>
									<option value="24"><?php _e('24', 'swift-framework-admin'); ?></option>
									<option value="25"><?php _e('25', 'swift-framework-admin'); ?></option>
									<option value="26"><?php _e('26', 'swift-framework-admin'); ?></option>
									<option value="27"><?php _e('27', 'swift-framework-admin'); ?></option>
									<option value="28"><?php _e('28', 'swift-framework-admin'); ?></option>
									<option value="29"><?php _e('29', 'swift-framework-admin'); ?></option>
									<option value="30"><?php _e('30', 'swift-framework-admin'); ?></option>
								</select>
							</div>
							<div class="option">
								<label for="lptable-buttontext"><?php _e('Button text', 'swift-framework-admin'); ?></label>
								<input id="lptable-buttontext" name="lptable-buttontext" type="text" value=""/>
								<p class="info">Enter the button text here, or leave blank to hide the button.</p>
							</div>
						</div>						


						<!--//////////////////////////////
						////	LISTS
						//////////////////////////////-->

						<div id="shortcode-lists" class="shortcode-option">
							<h5><?php _e('Lists', 'swift-framework-admin'); ?></h5>
							<div class="option">
								<label for="list-icon"><?php _e('List icon', 'swift-framework-admin'); ?></label>
								<input type="text" class="search-icon-grid textfield" placeholder="Search Icon">
								<input id="list-icon" name="list-icon" type="text" value="" style="visibility: hidden;"/>
								<ul class="font-icon-grid"><?php echo $icon_list; ?></ul>
							</div>
							<div class="option">
								<label for="list-items"><?php _e('Number of list items', 'swift-framework-admin'); ?></label>
								<select id="list-items" name="list-items">
									<option value="1"><?php _e('1', 'swift-framework-admin'); ?></option>
									<option value="2"><?php _e('2', 'swift-framework-admin'); ?></option>
									<option value="3"><?php _e('3', 'swift-framework-admin'); ?></option>
									<option value="4"><?php _e('4', 'swift-framework-admin'); ?></option>
									<option value="5"><?php _e('5', 'swift-framework-admin'); ?></option>
									<option value="6"><?php _e('6', 'swift-framework-admin'); ?></option>
									<option value="7"><?php _e('7', 'swift-framework-admin'); ?></option>
									<option value="8"><?php _e('8', 'swift-framework-admin'); ?></option>
									<option value="9"><?php _e('9', 'swift-framework-admin'); ?></option>
									<option value="10"><?php _e('10', 'swift-framework-admin'); ?></option>
									<p class="info">You can easily add more by duplicating the code after.</p>
								</select>
							</div>
						</div>

					</fieldset>

				<!-- CLOSE #shortcode_panel -->					
				</div>

				<div class="buttons clearfix">
					<input type="submit" id="insert" name="insert" value="<?php _e('Insert Shortcode', 'swift-framework-admin'); ?>" onClick="embedSelectedShortcode();" />
				</div>

			<!-- CLOSE #shortcode_wrap -->
			</div>

		<!-- CLOSE swiftframework_shortcode_form -->
		</form>

	<!-- CLOSE body -->
	</body>

<!-- CLOSE html -->	
</html>
