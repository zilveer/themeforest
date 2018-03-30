<?php

$pexeto_general_options= array( array(
"name" => "Documentation",
"type" => "title",
"img" => PEXETO_IMAGES_URL."icon_doc.png"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"general", "name"=>"General"))
),

array(
"type" => "subtitle",
"id"=>'general'
),

array(
"type" => "documentation",
"text" => '<h2>Documentation</h2><p> Please note that there is a documentation included where all the theme customization settings are explained. The documentation
is located within the <strong>documentation</strong> folder of the main zip file you have downloaded. </p>
<h2>If you have any questions</h2>
<p>We will do our best to assist with questions directly related to 
		the theme set up, however please note that theme support is completely voluntary for ThemeForest authors and
		we do it as appreciation to our customers. 
		Therefore before you contact us, please consider finding an answer to your question in:</p>
		<ul class="list">
		<li>The relevant section of the documentation</li>
		<li>Search our <a href="http://pexetothemes.com/support/knowledgebase/">Knowledgebase</a> which contains frequently asked questions</li>
		<li>Troubleshooting section of the documentation</li>
		<li><a href="http://codex.wordpress.org/Main_Page">WordPress Codex</a> for general WordPress questions</li>
		<li><a href="http://google.com">Google</a> for general questions</li>
		</ul>
		
		<div class="note_box">
		 <b>Note: </b>If you have already explored all the sources of information stated above, and you are still experiencing 
		problems with the theme set up, you can open a ticket with your question on the <a href="http://pexetothemes.com/support/">Pexeto Support Site</a>. 
		</div>'
),


array(
"type" => "close"),


array(
"type" => "close"));

pexeto_add_options($pexeto_general_options);