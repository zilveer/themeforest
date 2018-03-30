<?php
/**
 * This file contains the instructions for the documentation and support
 * within the Options panel.
 */

$pexeto_general_options= array( array(
		'name' => 'Documentation',
		'type' => 'title',
		'img' => ' icon-support'
	),

	array(
		'type' => 'open',
		'subtitles'=>array( array( 'id'=>'general', 'name'=>'General' ) )
	),

	array(
		'type' => 'subtitle',
		'id'=>'general'
	),

	array(
		'type' => 'documentation',
		'text' => '<h2>Documentation</h2><p> Please note that there is a detailed documentation 
			that comes with the theme - it includes detailed instructions about how to use and set up 
			every aspect of the theme.</p>
			<div class="doc-btn "><a href="http://pexetothemes.com/docs/story/?src=pexpanel" target="_blank"> Access Online Documentation </a></div>

			<br/><strong>Where to find the documentation:</strong><br/><br/>
			<ol>
			<li>Download the theme zip file ("All files & Documentation") from the Downloads section of your
			ThemeForest profile</li>
			<li>Unzip the download file</li>
			<li>In the unzipped folder you will find another folder called 
			<strong>documentation</strong>. In this folder, the actual documentation
			file is called index.html - just open this file with your favorite browser.</li>
			</ol>
<br/><br/>
			<h2>If you have 
			any questions</h2> <p>We will do our best to assist with questions 
			directly related to the theme set up, however please note that theme 
			support is completely voluntary for ThemeForest authors and we do it as 
			appreciation to our customers. Therefore before you contact us, 
			please consider finding an answer to your question in:</p> <ul class="list"> 
			<li>The relevant section of the documentation</li> <li>Search our 
			<a href="http://pexetothemes.com/support/knowledgebase/?source=pexpanel&theme=story">Knowledgebase</a> 
			which contains frequently asked questions</li> 
			<li>Troubleshooting section of the documentation</li> 
			<li><a href="http://codex.wordpress.org/Main_Page">WordPress Codex</a> 
			for general WordPress questions</li> <li><a href="http://google.com">Google</a> 
			for general questions</li> </ul> 
			<div class="note_box"> <b>Note: </b>If you have already explored all 
			the sources of information stated above, and you are still experiencing 
			problems with the theme set up, you can open a ticket with your 
			question on the <a href="http://pexetothemes.com/support/?source=pexpanel&theme=story">Pexeto 
			Support Site</a>. </div>'
	),


	array(
		'type' => 'close' ),


	array(
		'type' => 'close' ) );

$pexeto->options->add_option_set( $pexeto_general_options );
