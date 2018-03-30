<div class="wrap" style="margin-left: 20px; width: 790px;">
<h3 class="center alt">&ldquo;Guest List&rdquo; Documentation by &ldquo;Bebel&rdquo; for Theme v1.6</h3>

		

		<h1 class="center">&ldquo;Guest List&rdquo;</h1>

		<div class="borderTop">
			<div class="span-6 colborder info prepend-1">
				<p class="prepend-top">
					<strong>
					Created: 01/09/2012<br>
					U@pdated 01/17/2012<br>
					By: Bebel<br>
					Email: Send us a mail through our Themeforest profile <a href="http://themeforest.net/user/Bebel">here</a>!
					</strong>
				</p>
			</div><!-- end div .span-6 -->

			<div class="span-12 last">
				<p class="prepend-top append-0">Thank you for purchasing my theme. If you have any questions that are beyond the scope of this help file, please feel free to email via my user page contact form <a href="http://themeforest.net/user/Bebel">here</a>. Thanks so much!</p>
			</div>
		</div><!-- end div .borderTop -->

		<hr>

		<h2 id="toc" class="alt">Table of Contents</h2>
		<ol class="alpha" style="padding-left: 30px;">
			<li><a href="#introduction">Introduction</a></li>
			<li><a href="#installation">Installation</a></li>
			<li><a href="#installed">Uploaded, Installed, What Now?</a></li>
			<li><a href="#setup-theme">Setting Up The Theme</a></li>
			<li><a href="#setup-menu">Setting Up The Menu</a></li>
            <li><a href="#event">Creating a new Event</a></li>
			<li><a href="#activating-paypal">Activating Paypal</a></li>
            <li><a href="#guestlists">Managing The Guest Lists</a></li>
            <li><a href="#staticmain">Activating the static main page</a></li>
			<li><a href="#activating-mailchimp">Activating Mailchimp</a></li>
            <li><a href="#mailchimptemplate">Using The Mailchimp Email Template</a></li>
			<li><a href="#emailtemplates">Changing the Email templates</a></li>
			<li><a href="#icons">Changing Icons</a></li>
			<li><a href="#your-code">Extending and Modifying the Theme</a></li>
			<li><a href="#credits">Sources and Credits</a></li>
		</ol>

		<hr>

		<h3 id="introduction"><strong>A) Introduction</strong> - <a href="#toc">top</a></h3>
		<p>
        	Guest List is a premium wordpress theme specially built for event and guest list websites. If you are running a club or just partying a lot, this theme should be the right joice for you.
        </p>

        <p style="font-style:italic; color: #C63">We have created some screencasts that will guide you through the theme. If you currently have no access to the internet and though no connection to youtube, you can always watch the videos in the corresponding folder in the documentation folder.</p>

        <p>
   			First, let me tell you some requirements of this theme.
        </p>

        <ol>
        	<li>PHP version <strong>5.1</strong> or higher.<br />This is absolute necessary. If your host is still running on php4, you put yourself and others in danger. The version 4 is officially not supported anymore. It has a lot of security issues!</li>
            <li>Wordpress version <strong>3</strong> or higher. We developped this theme for wordpress 3 and tested every single functionality in wordpress 3.3. It works.</li>
            <li>Mailchimp account. If you want to get the full power of this theme, you should get a mailchimp account. The free one is good enough ;)</li>
        </ol>


		<hr>

		<h3 id="installation"><strong>B) Installation</strong> - <a href="#toc">top</a></h3>

		<p>You have two ways of installing the theme. You can upload it throug the wordpress theme uploader, which is the most simple solution, or you can upload it via ftp.</p>

        <h4 id="installation-wordpress"><strong>The Wordpress Way</strong> - <a href="#toc">top</a></h4>

		<p>There is a great tutorial on how do to that on the wordpress site. <a href="https://codex.wordpress.org/Appearance_Themes_SubPanel#Using_the_upload_method">Click here to access it</a> (redirecting to wordpress.org)</p>


        <h4 id="installation-ftp"><strong>Using FTP</strong> - <a href="#toc">top</a></h4>

        <p>For this, there is a great tutorial on wordpress.org, too. <a href="https://codex.wordpress.org/Appearance_Themes_SubPanel#Using_the_FTP_method">Access it here</a>.</p>


        <h4 id="installation-errors"><strong>Installation Errors</strong> - <a href="#toc">top</a></h4>

		<p>If you experience any errors during the installation, please read this short section before contacting us.</p>

        <ol>
        	<li>
            	I get the error: "Unexpected T_OLD_FUNCTION" or something similar: Please upgrade to php5.1. We don't support any prior versions.<br />
                To update, refer to your host's documentation.
            </li>
            <li>
            	Wordpress tells me the stylesheet is broken.<br /> This error comes often, when you upload the files via ftp, but the upload somehow was not completed. Remove all the theme's files from your server and upload again.
            </li>
            <li>
            	I get the error: "Undefined function xyz".<br />As above, this is an indicator that the files could not be completely uploaded. Reupload to be sure!
            </li>
        </ol>


		<hr>

		<h3 id="installed"><strong>C) Uploaded. Installed. Activated. What now?</strong> - <a href="#toc">top</a></h3>

        <p style="font-style:italic; color: #C63">prolog: in this tutorial / help file, we use some links to get you to the relevant sections of the wordpress configuration quickly and smoothly. They will only work if you read this tutorial in the help section of the theme's configuration panel. Read below how to access it</p>

		<p>Congratulations!</p>

        <p>
        	Lets get started! First of all, go to the theme's configuration panel. After the theme activation, you will notice there is a new point called "Guest List" beneith "Appearance" (Where you just activated the theme). <br />
            This is where all of the themes settings come together and are managed. You'll notice 3 points.
        </p>

        <ol>
			<li>Theme Configuration</li>
			<li>Manage Guest Lists</li>
			<li>Help &amp; Support</li>
		</ol>

        <h4 id="theme-configuration"><strong>1) Theme Configuration</strong> - <a href="#toc">top</a></h4>

        <p>The first point, <em>Theme Configuration</em>, lets you, you might have guessed rightly, configure the theme's settings. We have plenty of them, but all are pretty self explicatory. </p>


        <h4 id="sidebar-generator"><strong>2) Manage Guest Lists</strong> - <a href="#toc">top</a></h4>

        <p>The second point, <em>Manage Guest Lists</em> lets you ... manage your guest lists. You didn't expect that, did you! </p>


        <h4 id="help-support"><strong>3) Help &amp; Support</strong> - <a href="#toc">top</a></h4>

        <p>The third point, <em>Help &amp; Support</em> contains this help file. You don't have to worry if you log on from another computer. You can always read this documentation in your WordPress backend.</p>


        <p>
        	But before we go any further, please install all the delivered plugins.
        </p>



        <h3 id="setup-theme"><strong>D) Setting the theme up</strong> - <a href="#toc">top</a></h3>

        <p>This part has a video and some text. Please read and watch both. It will teach you all the important things about the theme. Please watch it, as it contains several important information!</p>
        
        <iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/KG2meuoAF7M" frameborder="0" allowfullscreen></iframe>

        <p style="font-weight: bold;">How do I set up my mail settings correctly? and why?</p>
        <p>This one is a good question. Let me first answer the "why". On the internet are a lot of spam sites. Sites, that send emails that nobody wants. To prevent spam filters from identifying your emails as spam, you have to configure the theme correctly.</p>
        <p>We have provided an interface where you can simply enter all the relevant data. There are 3 choices.</p>
        <ol>
            <li>mail()
                <br />
                This one is the most insecure, but easy way on sending emails from your server to other people. As I said above: spam is a huge problem. And this method is highly used by spam senders. So please only use that if you have no other choice!
            </li>
            <li>sendmail<br />
                Sendmail is way more secure than mail(). But unfortunately, as this one is widely spread too, it is considered as not 100% secure. The mails could often land in spam folders.
            </li>
            <li>
                smtp<br />
                The best way of sending emails. But the most "complicated". You need a mail account somewhere, where you get smtp configuration data. That would be the case for google and most of the private hosts.<br />
                Its basically the same way as configuring your local mail box. You need to enter a smtp hostname, a port, check wether ssl is on or not and finally enter your username and password. All these data should be provided by your host. If you don't know then - don't as us, ask your host!
                <br />
                After setting up these settings, you can start sending emails, and the chances of falling in somebodys spam folder is much less high than with the variations above.
            </li>
        </ol>
		<hr>

        <h3 id="setup-menu"><strong>E) Settig Up the Menu</strong> - <a href="#toc">top</a></h3>
        
        <p>This part is video only. It will teach you all the important things about the theme. Please watch it, as it contains several important information!</p>

        <iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/ccQsA76oFMs" frameborder="0" allowfullscreen></iframe>

		<hr>
        

        <h3 id="event"><strong>F) Creating a new Event</strong> - <a href="#toc">top</a></h3>
        
        <p>This part is video only. It will teach you all the important things about the theme. Please watch it, as it contains several important information!</p>

        <iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/ROQ6qRVcWzI" frameborder="0" allowfullscreen></iframe>
		
		
		<hr>
        
        
        <h3 id="activating-paypal"><strong>G) Activating Paypal</strong> - <a href="#toc">top</a></h3>
        
        
        <p>We haven't got the chance yet to make a video for this section. We will put it up as soon as possible. in the meanwhile, please read this written documentation</p>
        
        <p>We have included paypal in this theme, so you can easily make it possible to take money for your events.</p>
        
        <p>Activating paypal is really easy, but it has some requirements. Please make sure you have these necessary things before you continue:</p>
        
        <ul>
            <li>A Paypal Business Account - a standard account is <b>not</b> supported!</li>
            <li><b>You agree that we (the authors of the theme) do not take any warranty whatsoever on your business.</b></li>
        </ul>
        
        <p>Ok, you have everything you need?</p>
        
        <p>Fine, you need an API-Key now. You can get this in your paypal business account. Log in and go to profile -> more options</p>
        
        <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/paypal/profile.png" />
        
        <p>Once you are there, go to API Access</p>
        
        <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/paypal/apiaccess.png" />
        
        <p>
            Now, create new API credentials. You need those to connect your event page with paypal. There are solutions that don't require API data, but those are insecure and unreliable.<br>
            You can choose between 2 options. In most cases, Option 2 is the right choice. If you are not sure, ask somebody who knows it. (No, we do't :))
        </p>
        
        <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/paypal/chooseapi.png" />
        
        <p>Copy the data from this overview into the backend. You will find the fields in Payment -> Paypal</p>
        
        <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/paypal/apikey.png" />
        <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/paypal/paypalbackend.png" />
        
        <p><b>Note:</b></p>
        <p>You may have noticed the sandbox option. This is for testing your installation, if you want to make sure to get it set up correctly. You will need a paypal developer account, which is free and can be registered at <a href="https://www.sandbox.paypal.com/">sandbox.paypal.com/</a>. We encourage you to do the longer process, but it will be worth it, because you can be sure everything works as expected. </p>
        <p>You may have to read the manual, explaning how this works in this helpfile is not possible, as the documentation on paypal's side may change.</p>
        
        <p>There are some changes after you set up paypal.</p>
        
        <ul>
            <li>
                Next to the buy button (sign up button) is a paypal button. You will have to leave it there. This is required from paypal.<br>
                <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/paypal/paypalbutton.png" />
            </li>
            <li>
                If you buy an item, the transaction will be registered with paypal, the user signs in on paypal itself and then the user will be redirected to a last confirmation site. This is also required by paypal. You should not modify the functionality that the money is booked right after the user is logged in on paypal.
                <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/paypal/paypalcheckout.png" />
            </li>
        </ul>
        
        <p><b>Setting up the Event</b></p>
        <p>Make sure you set up the event completely. If you have activated paypal, you will HAVE TO insert following data</p>
        
        <ol>
            <li>
                Price<br>
                If the event is free, enter a 0 in the field and paypal will be disabled. 
            </li>
            <li>
                Currency<br>
                Don't make a mistake here. Its the currency that will be used by paypal. 15 yen and 15 us dollar are a huge difference ;)<br>
                These are the only currencies supported by paypal's express checkout. If you need a different currency I am afraid you will have to implement another payment type. (you can hire us ;)
            </li>
            <li>
                Slots<br>
                You probably want to limit the number of tickets to sell. Enter here the number and the theme will pay attention that not more tickets than available will be sold.<br>
                If you have access to a football stadium or something, you can set the slot count to unlimited by inserting a 0.
            </li>
            <li>
                Button Text<br>
                If its a free event, you might want to change the text to something else than "Buy Ticket".
            </li>
            <li>
                Event Registration Start / End / Event Date<br>
                Don't forget to set up these. And the event date should be after the registration end. Not before. Be logic :)
            </li>
            <li>Fill out the rest of the fields as you please.</li>
        </ol>
        
        <p><b>Event Access Codes</b></p>
        <p>If an user registers to your event, he will get an event access code. You can get a list of the codes when you take a look at your backend or are trying to print the list. We improved the layout in this version, btw.</p>
        <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/paypal/guestlistprint.png" />
        <p></p>
        
        
        
        
        
        <hr>
        

        <h3 id="guestlists"><strong>H) Managing the Guest Lists</strong> - <a href="#toc">top</a></h3>
        
        <p>This part is video only. It will teach you all the important things about the theme. Please watch it, as it contains several important information!</p>

        <iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/uySboWeF5A4" frameborder="0" allowfullscreen></iframe>
		
		
		
        <hr>
        

        <h3 id="staticmain"><strong>I) Activating the static main page</strong> - <a href="#toc">top</a></h3>
            
        <p>Activating the static main page is quite simple. Go to the theme configuration panel and select "Main Page" to acces to the configuration.</p>

        <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/misc/staticmain.png" />

        <p>You can either choose a page you created with wordpress or enter custom html into the box to fill the main page. If you want to change the layout of the main page, which we strongly recommend, you have to modify the file <code>./templates/static_main.php</code>.</p>
        <p>Finally, please do not forget, if you are using the content box, to upload a background image for the main page. If you use the page feature, upload the background image as featured image to the page directly.</p>

        <hr>
        <h3 id="activating-mailchimp"><strong>J) Activating Mailchimp</strong> - <a href="#toc">top</a></h3>
        
        
        
        <p>
            What is Mailchimp?<br />
            It’s one of the best and easiest ways to send newsletter campaigns over the internet these days. It’s free to sign up for and very cheap even for bigger campaigns (check out there free plan, which is incredible)
        </p>
        
        <p>
            Follow these steps to activate and use Mailchimp with Guest List Event Theme
        </p>
        <ol>
            <li>Go to your WordPress backend and to the „Theme Configuration“ within the Guest List menu.</li>
            <li>Click on the tab events and scroll down. Choose „Enable Mailchimp“</li>
            <li>Save your changes</li>
            <li>Go to <a href="http://mailchimp.com" target="_blank">Mailchimp.com</a> and create an account</li>
            <li>In the Mailchimp backend menu – go to „Account Api Keys & Authorized Apps“</li>
            <li>Click on „add a key“ to create an API Key</li>
            <li>Copy that key and go back to your WP Backend.</li>
            <li>Go to your WordPress backend and to the „Theme Configuration“ within the Guest List menu. Notice the new Mailchimp tab on top – click on it!</li>
            <li>You can now paste your API Key in the appropriate box and ckeck if then key is correct. Click on save changes and the big part is already done.</li>
            <li>Choose a default list from mailchimp in the field below. If you don't have a list set up yet, read below.</li>
        </ol>
        
        <p>You now activated Mailchimp. Congratulations! There is one more thing you have to do. Mailchimp works with lists, which means you can add a list to each of your event. In order to do so you have to create these lists in the Mailchimp backend on mailchimp.com</p>
        
        <ol>
            <li>Go to <a href="http://mailchimp.com" target="_blank">Mailchimp.com</a> and sign in</li>
            <li>click on „lists“ on the top navigation.</li>
            <li>Click on the big red button that says „create list“</li>
            <li>Create as many lists as you need. You can create a special list for each event or simply one list for all newsltter subscriptions</li>
            <li> Go back to wordpress. You now have to tell your events which lists to use, if you don't want to use the same for all of them. In this case, follow step 10 from the list above. So got to „events“ and edit or create a new event you want to assign a list to. Once you opened that event event you will notice that shiny new Mailchimp tab in the guest list options. Click on it on choose the appropriate list. Click on update or publish and that’s it. Mailchimp integration is done :-)</li>
        </ol>

        <iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/l3RMCi8lBAw" frameborder="0" allowfullscreen></iframe>
		
		
		<hr>
        
        <h3 id="mailchimptemplate"><strong>K) Using The Mailchimp Email Template</strong> - <a href="#toc">top</a></h3>
        
        <p>Now you activated mailchimp. You might want to use the mailchimp email template we provide for your newsletter campaigns. Watch the following video to get an idea on how to use it.</p>
        
        <iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/6oeWe7WKP48" frameborder="0" allowfullscreen></iframe>
        

        <h3 id="emailtemplates"><strong>L) Changing the Email templates</strong> - <a href="#toc">top</a></h3>
        
        <p>We do provide 2 templates.</p>
        <ol>
            <li>mailchimp template: you have to read your way through the email setup process on mailchimp. <a href="http://kb.mailchimp.com/article/how-do-i-create-my-own-custom-template">Check here</a></li>
            <li>
                the events template. <br />Change it by editing it in your favorite html editor. <br />
                <br />
                The template can be found in the theme configuration in Events > Email Template. <br />
                <img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/faq/emailtemplate.png" /><br /><br />
                You can use several placeholders for the template. The values of these placeholders will be inserted where you use them.<br /><br />
                There are two kinds of placeholders.<br />
                The ones you can edit and the ones you cannot edit.<br /><br />
                For example. If you use the placeholder %EVENTDATE%, the title of the event the user signes up for will be inserted. You <b>cannot</b> edit the value of this placeholder<br />
                However, if you use %TITLE%, you can edit the placeholders value. <br /><br />
                Above the template, you see several input fields. In these fields, you can edit the values of the editable parameters.<br />
                <br />
                <b>List of placeholders</b>:<br />
                (editable)<br />
                - %TITLE%<br />
                - %LOGO% (the logo you uploaded on the tab "basic" will be shown here, (<b>cannot be used in text only template!</b>)<br />
                - %SIGNEDUP%<br />
                - %WHEN%<br />
                - %CODE%<br />
                - %ADDRESS%<br />
                - %SENDERINFORMATION%<br />
                <br />
                (not editable)<br />
                - %FIRSTNAME%<br />
                - %LASTNAME%<br />
                - %THECODE% (contains the access code for the ticket. DO NOT FORGET TO PUT IN YOUR MAIL TEMPLATE!)<br />
                (in fact, the following ones are editable, but only in the event itself)<br />
                - %EVENTDATE%<br />
                - %EVENTADDRESS%<br />
                
                
            </li>
        </ol>

        <p>As of version 1.6, we offer a text version of the email template, too. You can use the same placeholders as for the html version, except for the logo, as it would not render in a text version :)</p>
        
        <h3 id="icons"><strong>M) Changing Icons</strong> - <a href="#toc">top</a></h3>
        
        <p style="font-weight: bold;">How do I add my countries currency into the theme?</p>
        <p>It is simple. You have to put a the graphic you want to use as <currencyname>.png (the file type doesn't matter, as long as its a graphic ;) ) in the following folder: <br />
            <code>guestlist/images/event/currency/</code><br /><br />

            Thats it. The Currency will be displayed in your select list.</p>
        
        <p style="font-weight: bold;">How can I add custom icons to the menu bar?</p>
        <p>It's simple, too. You have to put your graphic with a simple name and in the png format, (like about.png) into the folder:<br />
            <code>guestlist/images/menu/icons/</code><br /><br />

            The filename of the icon will be the Title Attribute you have to give the menu entry of your choice. You can have super complicated filenames, but it is better to keep it simple ;)</p>
        
        
		
		<hr>

		<h3 id="your-code"><strong>N) Extending and Modifying the Theme</strong> - <a href="#toc">top</a></h3>
		
		<p>I am pretty sure you want to extend or / and modify the theme's layout and functionality to fit your needs. Here are a few points, you should remember when modifying any files.</p>
		
		<ul>
			<li>Do never modify any css file we deliver (except custom.css)</li>
			<li>Do never modify any php file we deliver (except myFunctions.php)</li>
		</ul>
		
		<p>Why that? Because of possible updates in the future. We do not give support for custom modified files. </p>
		<p>However, all template files (header-*.php, footer.php, comments.php and the files in the templates/ folder) and images can of course be modified. The restrictions are only valid for the bebelCp2 folder, and the functions.php</p>
		
		<h4 id="your-css"><strong>1) Custom CSS</strong> - <a href="#toc">top</a></h4>
		
		<p>You have several points of adding your custom CSS.</p>
		
		<ol>
			<li>Put the code in the Theme Configuration Panel</li>
			<li>Put the code in the custom.css inside the css folder</li>
			<li>Add CSS to every page where you need it.</li>
		</ol>
		
		<h5>1. Theme Configuration Panel</h5>
		<p>Simply write the css code inside the field found at "Misc/Styling".</p>
		<img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/extend/css_backend.png" />
		
		<h5>2. css/custom.css</h5>
		<p>Paste the code into the custom.css file. The only difference to point 1. is that you can edit it in your favorite css editor.</p>
		
		
		<h5>3. Add to Post</h5>
		<p>This option should only be used if you have a css class only for one or two posts. This output won't be cached!</p>
		<img src="<?php echo get_bloginfo('stylesheet_directory').BebelUtils::getBundlePath() ?>/images/extend/css_post.png" />
		
		
		<h4 id="your-php"><strong>2) Custom PHP</strong> - <a href="#toc">top</a></h4>
		
		<p>If you have functions you wish to add to the theme, do not paste them in the functions.php. Put them in "myFunctions.php". This file is included in functions.php at the very bottom to make sure your options override ours. </p>


		<hr>

		<h3 id="credits"><strong>O) Sources and Credits</strong> - <a href="#toc">top</a></h3>

		<p>Thanks to the following projects for making Guest List possible<br />

<ul>
	<li><a href="http://jquery.com/">jQuery</a></li>
		<li><a href="http://jacklmoore.com/colorbox/">jQuery Colorbox</a></li>
        <li><a href="http://buildinternet.com/project/supersized/">jQuery Supersized</a></li>
		<li><a href="http://pixelmatrixdesign.com/uniform/">jQuery Uniform</a></li>
		<li><a href="http://www.komodomedia.com/blog/2009/06/social-network-icon-pack/">Komodo Social Icon Pack</a></li>
		<li><a href="http://jonatancastro.com/">32px Mania</a> </li>
        <li>TWG Retina Icons</li>
		<li>Finally: This Preview features the great crystal icons from <a href="http://yellowicon.com/downloads/page/1">here</a></li>
		

		
	</ul>

    <h3>Images liscensed from Photodone</h3> <br />    
    <ul>
        <li>francesco83</li>
		<li>Pressmaster</li>
		<li>eastwestimaging</li>
	</ul>


    <h3>Fonts Used</h3> <br />

    <ul>
        <li>Tittilium get it <a href="http://www.cufonfonts.com/en/font/437/titillium-text">here</a></li>
		<li>Arial (Standard Font)</li>
		<li>Pacifico get it <a href="http://www.fontsquirrel.com/fonts/pacifico">here</a></li>
	</ul>

		<hr>

		<p>Once again, thank you so much for purchasing this theme. As I said at the beginning, I'd be glad to help you if you have any questions relating to this theme. No guarantees, but I'll do my best to assist. If you have a more general question relating to the themes on ThemeForest, you might consider visiting the forums and asking your question in the "Item Discussion" section.</p>

		<p class="append-bottom alt large"><strong>Bebel</strong></p>
		<p><a href="#toc">Go To Table of Contents</a></p>

		<hr class="space">
	</div><!-- end div .container -->