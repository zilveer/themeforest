        	<div id="front-box">
            	<?php
            	 $homebox_title1 = get_option('vulcan_homebox_title1');
            	 $homebox_desc1 = get_option('vulcan_homebox_desc1');
            	 $homebox_image1 = get_option('vulcan_homebox_image1');
            	 $homebox_desturl1 = get_option('vulcan_homebox_desturl1');
            	 $homebox_title2 = get_option('vulcan_homebox_title2');
            	 $homebox_desc2 = get_option('vulcan_homebox_desc2');
            	 $homebox_image2 = get_option('vulcan_homebox_image2');
            	 $homebox_desturl2 = get_option('vulcan_homebox_desturl2');
            	 $homebox_title3 = get_option('vulcan_homebox_title3');
            	 $homebox_desc3 = get_option('vulcan_homebox_desc3');
            	 $homebox_image3 = get_option('vulcan_homebox_image3');
            	 $homebox_desturl3 = get_option('vulcan_homebox_desturl3');
            	?>
                <!-- begin of front content 1 -->
                <div class="front-box-content">
                	<div class="img-front"><img src="<?php echo $homebox_image1;?>" alt=""/></div>
                <h4><a href="<?php echo $homebox_desturl1;?>"><?php echo ($homebox_title1) ? stripslashes($homebox_title1) : "Construct a Future";?></a></h4>
                <p><?php echo ($homebox_desc1) ? stripslashes($homebox_desc1) : "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusanti um dolorem que laudantium, totamr em aperiam, eaque ipsa quae abillo inventore veritatis quasi architectobe atae vitae dicta sunt explicabo nemo";?></p>
                </div>
                <!-- end of front content 1 -->
                
                <div class="dot-separator-content"></div>
                
                <!-- begin of front content 2 -->
                <div class="front-box-content">
                	<div class="img-front"><img src="<?php echo $homebox_image2;?>" alt=""/></div>
                <h4><a href="<?php echo $homebox_desturl2;?>"><?php echo ($homebox_title2) ? stripslashes($homebox_title2) : "Business Monitoring";?></a></h4>
                <p><?php echo ($homebox_desc2) ? stripslashes($homebox_desc2) : "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusanti um dolorem que laudantium, totamr em aperiam, eaque ipsa quae abillo inventore veritatis quasi architectobe atae vitae dicta sunt explicabo nemo";?></p>
                </div>
                <!-- end of front content 2 -->
                
                <div class="dot-separator-content"></div>
                
                <!-- begin of front content 3 -->
                <div class="front-box-content">
                	<div class="img-front"><img src="<?php echo $homebox_image3;?>" alt=""/></div>
                <h4><a href="<?php echo $homebox_desturl3;?>"><?php echo ($homebox_title3) ? stripslashes($homebox_title3) : "User Management";?></a></h4>
                <p><?php echo ($homebox_desc3) ? stripslashes($homebox_desc3) : "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusanti um dolorem que laudantium, totamr em aperiam, eaque ipsa quae abillo inventore veritatis quasi architectobe atae vitae dicta sunt explicabo nemo";?></p>
                </div>
                <!-- end of front content 3 -->
              <div class="clear"></div>
            </div>    