<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Ultimate Google Maps
* Add-on URI: https://www.brainstormforce.com
*/
if(!class_exists("Ultimate_Google_Maps")) {
	class Ultimate_Google_Maps {
		function __construct() {

			add_shortcode( 'ultimate_google_map', array( &$this, 'crum_google_map_form' ) );
			add_action( 'init', array( &$this, 'crum_google_map_init' ) );

		}

		function crum_google_map_custom_styles() {
			return array(
				'subtle-grayscale'   => array(
					__( "Subtle Grayscale", 'dfd' ),
					"[{'featureType':'landscape','stylers':[{'saturation':-100},{'lightness':65},{'visibility':'on'}]},{'featureType':'poi','stylers':[{'saturation':-100},{'lightness':51},{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'road.arterial','stylers':[{'saturation':-100},{'lightness':30},{'visibility':'on'}]},{'featureType':'road.local','stylers':[{'saturation':-100},{'lightness':40},{'visibility':'on'}]},{'featureType':'transit','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'administrative.province','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':-25},{'saturation':-100}]},{'featureType':'water','elementType':'geometry','stylers':[{'hue':'#ffff00'},{'lightness':-25},{'saturation':-97}]}]"
				),
				'calm-grayscale'     => array(
					__( "Calm detailed grayscale", 'dfd' ),
					"[{'featureType':'all','elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#333333'},{'lightness':40}]},{'featureType':'all','elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#ffffff'},{'lightness':16}]},{'featureType':'all','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#fefefe'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#fefefe'},{'lightness':17},{'weight':1.2}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'lightness':20},{'color':'#ececec'}]},{'featureType':'landscape.man_made','elementType':'all','stylers':[{'visibility':'on'},{'color':'#f0f0ef'}]},{'featureType':'landscape.man_made','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#f0f0ef'}]},{'featureType':'landscape.man_made','elementType':'geometry.stroke','stylers':[{'visibility':'on'},{'color':'#d4d4d4'}]},{'featureType':'landscape.natural','elementType':'all','stylers':[{'visibility':'on'},{'color':'#ececec'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'lightness':21},{'visibility':'off'}]},{'featureType':'poi','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#d4d4d4'}]},{'featureType':'poi','elementType':'labels.text.fill','stylers':[{'color':'#303030'}]},{'featureType':'poi','elementType':'labels.icon','stylers':[{'saturation':'-100'}]},{'featureType':'poi.attraction','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.business','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.government','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.medical','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.park','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#dedede'},{'lightness':21}]},{'featureType':'poi.place_of_worship','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.school','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.school','elementType':'geometry.stroke','stylers':[{'lightness':'-61'},{'gamma':'0.00'},{'visibility':'off'}]},{'featureType':'poi.sports_complex','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffffff'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#ffffff'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#ffffff'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#ffffff'},{'lightness':16}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#f2f2f2'},{'lightness':19}]},{'featureType':'water','elementType':'geometry','stylers':[{'color':'#dadada'},{'lightness':17}]}]"
				),
				'pnk2'               => array(
					__( "PNK2", 'dfd' ),
					"[{'featureType':'all','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels.text.fill','stylers':[{'color':'#444444'}]},{'featureType':'landscape','elementType':'all','stylers':[{'color':'#f2f2f2'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'all','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','elementType':'all','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'color':'#b6e3f5'},{'visibility':'on'}]}]"
				),
				'pale-dawn'          => array(
					__( "Pale Dawn", 'dfd' ),
					"[{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#acbcc9'}]},{'featureType':'landscape','stylers':[{'color':'#f2e5d4'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'color':'#c5c6c6'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#e4d7c6'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#fbfaf7'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#c5dac6'}]},{'featureType':'administrative','stylers':[{'visibility':'on'},{'lightness':33}]},{'featureType':'road'},{'featureType':'poi.park','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':20}]},{},{'featureType':'road','stylers':[{'lightness':20}]}]"
				),
				'blue-water'         => array(
					__( "Blue water", 'dfd' ),
					"[{'featureType':'water','stylers':[{'color':'#46bcec'},{'visibility':'on'}]},{'featureType':'landscape','stylers':[{'color':'#f2f2f2'}]},{'featureType':'road','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels.text.fill','stylers':[{'color':'#444444'}]},{'featureType':'transit','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'off'}]}]"
				),
				'shades-of-grey'     => array(
					__( "Shades of Grey", 'dfd' ),
					"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]}]"
				),
				'midnight-commander' => array(
					__( "Midnight Commander", 'dfd' ),
					"[{'featureType':'water','stylers':[{'color':'#021019'}]},{'featureType':'landscape','stylers':[{'color':'#08304b'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#0c4152'},{'lightness':5}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#0b434f'},{'lightness':25}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.arterial','elementType':'geometry.stroke','stylers':[{'color':'#0b3d51'},{'lightness':16}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'elementType':'labels.text.stroke','stylers':[{'color':'#000000'},{'lightness':13}]},{'featureType':'transit','stylers':[{'color':'#146474'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#144b53'},{'lightness':14},{'weight':1.4}]}]"
				),
				'retro'              => array(
					__( "Retro", 'dfd' ),
					"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'water','stylers':[{'color':'#84afa3'},{'lightness':52}]},{'stylers':[{'saturation':-17},{'gamma':0.36}]},{'featureType':'transit.line','elementType':'geometry','stylers':[{'color':'#3f518c'}]}]"
				),
				'light-monochrome'   => array(
					__( "Light Monochrome", 'dfd' ),
					"[{'featureType':'water','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':-78},{'lightness':67},{'visibility':'simplified'}]},{'featureType':'landscape','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'simplified'}]},{'featureType':'road','elementType':'geometry','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'simplified'}]},{'featureType':'poi','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'off'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'hue':'#e9ebed'},{'saturation':-90},{'lightness':-8},{'visibility':'simplified'}]},{'featureType':'transit','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':10},{'lightness':69},{'visibility':'on'}]},{'featureType':'administrative.locality','elementType':'all','stylers':[{'hue':'#2c2e33'},{'saturation':7},{'lightness':19},{'visibility':'on'}]},{'featureType':'road','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'on'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':-2},{'visibility':'simplified'}]}]"
				),
				'paper'              => array(
					__( "Paper", 'dfd' ),
					"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'road.arterial','stylers':[{'visibility':'off'}]},{'featureType':'water','stylers':[{'color':'#5f94ff'},{'lightness':26},{'gamma':5.86}]},{},{'featureType':'road.highway','stylers':[{'weight':0.6},{'saturation':-85},{'lightness':61}]},{'featureType':'road'},{},{'featureType':'landscape','stylers':[{'hue':'#0066ff'},{'saturation':74},{'lightness':100}]}]"
				),
				'gowalla'            => array(
					__( "Gowalla", 'dfd' ),
					"[{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'},{'lightness':20}]},{'featureType':'administrative.land_parcel','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road.local','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'hue':'#a1cdfc'},{'saturation':30},{'lightness':49}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'hue':'#f49935'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'hue':'#fad959'}]}]"
				),
				'greyscale'          => array(
					__( "Greyscale", 'dfd' ),
					"[{'featureType':'all','stylers':[{'saturation':-100},{'gamma':0.5}]}]"
				),
				'apple-maps-esque'   => array(
					__( "Apple Maps-esque", 'dfd' ),
					"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#a2daf2'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'color':'#f7f1df'}]},{'featureType':'landscape.natural','elementType':'geometry','stylers':[{'color':'#d0e3b4'}]},{'featureType':'landscape.natural.terrain','elementType':'geometry','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#bde6ab'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.medical','elementType':'geometry','stylers':[{'color':'#fbd3da'}]},{'featureType':'poi.business','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffe15f'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#efd151'}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'road.local','elementType':'geometry.fill','stylers':[{'color':'black'}]},{'featureType':'transit.station.airport','elementType':'geometry.fill','stylers':[{'color':'#cfb2db'}]}]"
				),
				'subtle'             => array(
					__( "Subtle", 'dfd' ),
					"[{'featureType':'poi','stylers':[{'visibility':'off'}]},{'stylers':[{'saturation':-70},{'lightness':37},{'gamma':1.15}]},{'elementType':'labels','stylers':[{'gamma':0.26},{'visibility':'off'}]},{'featureType':'road','stylers':[{'lightness':0},{'saturation':0},{'hue':'#ffffff'},{'gamma':0}]},{'featureType':'road','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'lightness':50},{'saturation':0},{'hue':'#ffffff'}]},{'featureType':'administrative.province','stylers':[{'visibility':'on'},{'lightness':-50}]},{'featureType':'administrative.province','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'administrative.province','elementType':'labels.text','stylers':[{'lightness':20}]}]"
				),
				'neutral-blue'       => array(
					__( "Neutral Blue", 'dfd' ),
					"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#193341'}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#2c5a71'}]},{'featureType':'road','elementType':'geometry','stylers':[{'color':'#29768a'},{'lightness':-37}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#3e606f'},{'weight':2},{'gamma':0.84}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'administrative','elementType':'geometry','stylers':[{'weight':0.6},{'color':'#1a3541'}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#2c5a71'}]}]"
				),
				'flat-map'           => array(
					__( "Flat Map", 'dfd' ),
					"[{'stylers':[{'visibility':'off'}]},{'featureType':'road','stylers':[{'visibility':'on'},{'color':'#ffffff'}]},{'featureType':'road.arterial','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'road.highway','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'landscape','stylers':[{'visibility':'on'},{'color':'#f3f4f4'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#7fc8ed'}]},{},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#83cead'}]},{'elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'weight':0.9},{'visibility':'off'}]}]"
				),
				'shift-worker'       => array(
					__( "Shift Worker", 'dfd' ),
					"[{'stylers':[{'saturation':-100},{'gamma':1}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'saturation':50},{'gamma':0},{'hue':'#50a5d1'}]},{'featureType':'administrative.neighborhood','elementType':'labels.text.fill','stylers':[{'color':'#333333'}]},{'featureType':'road.local','elementType':'labels.text','stylers':[{'weight':0.5},{'color':'#333333'}]},{'featureType':'transit.station','elementType':'labels.icon','stylers':[{'gamma':1},{'saturation':50}]}]"
				),
				'becomeadinosaur'       => array(
					__( "Become a Dinosaur", 'dfd' ),
					'[{"elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#f5f5f2"},{"visibility":"on"}]},{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#ffffff"},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"visibility":"simplified"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"color":"#ffffff"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.park","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#71c8d4"}]},{"featureType":"landscape","stylers":[{"color":"#e5e8e7"}]},{"featureType":"poi.park","stylers":[{"color":"#8ba129"}]},{"featureType":"road","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.sports_complex","elementType":"geometry","stylers":[{"color":"#c7c7c7"},{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#a0d3d3"}]},{"featureType":"poi.park","stylers":[{"color":"#91b65d"}]},{"featureType":"poi.park","stylers":[{"gamma":1.51}]},{"featureType":"road.local","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.government","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","stylers":[{"visibility":"simplified"}]},{"featureType":"road"},{"featureType":"road"},{},{"featureType":"road.highway"}]'
				),
				'avocado-world'       => array(
					__( "Avocado World", 'dfd' ),
					'[{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]'
				),
				'nature'       => array(
					__( "Nature", 'dfd' ),
					'[{"featureType":"landscape","stylers":[{"hue":"#FFA800"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#53FF00"},{"saturation":-73},{"lightness":40},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FBFF00"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#00FFFD"},{"saturation":0},{"lightness":30},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#00BFFF"},{"saturation":6},{"lightness":8},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#679714"},{"saturation":33.4},{"lightness":-25.4},{"gamma":1}]}]'
				),
				'orange-green'       => array(
					__( "Orange and Green", 'dfd' ),
					'[{"featureType": "all","elementType": "geometry","stylers": [{"color": "#00a07f"}]},{"featureType": "all","elementType": "geometry.fill","stylers": [{"color": "#ff6700"},{"visibility": "on"}]},{"featureType": "all","elementType": "labels.text.fill","stylers": [{"gamma": 0.01},{"lightness": 20}]},{"featureType": "all","elementType": "labels.text.stroke","stylers": [{"saturation": -31},{"lightness": -33},{"weight": 2},{"gamma": 0.8}]},{"featureType": "all","elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"featureType": "administrative.country","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "landscape","elementType": "geometry","stylers": [{"lightness": 30},{"saturation": 30}]},{"featureType": "landscape","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "landscape.man_made","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "landscape.natural.landcover","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "poi","elementType": "geometry","stylers": [{"saturation": 20}]},{"featureType": "poi","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "poi.park","elementType": "geometry","stylers": [{"lightness": 20},{"saturation": -20},{"color": "#009c73"}]},{"featureType": "road","elementType": "geometry","stylers": [{"lightness": 10},{"saturation": -30}]},{"featureType": "road","elementType": "geometry.fill","stylers": [{"color": "#ff8400"}]},{"featureType": "road","elementType": "geometry.stroke","stylers": [{"saturation": 25},{"lightness": 25}]},{"featureType": "water","elementType": "all","stylers": [{"lightness": -20}]}]'
				),
				'blue-with-title'       => array(
					__( "Orange and Green", 'dfd' ),
					'[{"featureType": "all", "elementType": "geometry", "stylers": [ { "color": "#c0ebea"}]},{"featureType": "all","elementType": "labels.text.fill","stylers": [{"gamma": 0.01},{"lightness": 20}]},{"featureType": "all","elementType": "labels.text.stroke","stylers": [{"saturation": -31},{"lightness": -33},{"weight": 2},{"gamma": 0.8}]},{"featureType": "all","elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"featureType": "administrative.country","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "administrative.province","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "administrative.locality","elementType": "all","stylers": [{"visibility": "simplified"}]},{"featureType": "landscape","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "landscape","elementType": "geometry","stylers": [{"lightness": 30},{"saturation": 30}]},{"featureType": "landscape.man_made","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "poi","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "poi","elementType": "geometry","stylers": [{"saturation": 20}]},{"featureType": "poi.park","elementType": "geometry","stylers": [{"lightness": 20},{"saturation": -20}]},{"featureType": "road","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "road","elementType": "geometry","stylers": [{"lightness": 10},{"saturation": -30},{"visibility": "on"}]},{"featureType": "road","elementType": "geometry.stroke","stylers": [{"saturation": 25},{"lightness": 25}]},{"featureType": "road","elementType": "labels","stylers": [{"visibility": "off"}]},{"featureType": "road","elementType": "labels.text","stylers": [{"visibility": "off"}]},{"featureType": "transit","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "transit.station","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "water","elementType": "all","stylers": [{"lightness": -20}]}]'
				),

			);
		}

		function crum_map_select_values() {
			$opts = $this->crum_google_map_custom_styles();

			$values = array(
				0 => __( 'Default', 'crum' ),
			);

			foreach ( $opts as $k => $opt ) {
				if ( ! isset( $opt[0] ) ) {
					continue;
				}

				$values[ $k ] = $opt[0];
			}

			return $values;
		}

		function crum_get_map_style( $map_style ) {
			$opts = $this->crum_google_map_custom_styles();

			if ( empty( $map_style ) ) {
				return false;
			}
			if ( ! isset( $opts[ $map_style ] ) ) {
				return false;
			}
			if ( ! isset( $opts[ $map_style ][1] ) ) {
				return false;
			}

			return $opts[ $map_style ][1];
		}


		function crum_google_map_form( $atts, $content = null ) {
			$size = $img_link_target = $zoom = $enable_zoom = $marker_image = $map_markers = $map_style = $module_animation = '';
			extract( shortcode_atts( array(
					'size'             => '300',
					'img_link_target'  => '',
					'zoom'             => '14',
					'enable_zoom'      => '',
					'marker_image'     => '',
					'map_markers'      => '',
					'map_style'        => 'default',
					'module_animation' => '',
				),
				$atts ) );


			wp_enqueue_script( 'gmaps' );
			wp_enqueue_script( 'gmap3' );

			$explodedByBr = explode( "\n", $map_markers );

			$marker_image_src = 'https://mts.googleapis.com/vt/icon/name=icons/spotlight/spotlight-poi.png';
			if ( ! empty( $marker_image ) ) {
				$marker_image_src = wp_get_attachment_image_src( $marker_image, 'full' );
				$marker_image_src = $marker_image_src[0];
			}

			if ( isset( $map_style ) ) {
				$styleVal = $this->crum_get_map_style( $map_style );
			} else {
				$styleVal = false;
			}
			
			if(!isset($enable_zoom) || empty($enable_zoom)) {
				$enable_zoom = 'false';
			}

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			$unique_id = uniqid( "map_" );

			$block_html = '';

			$block_html .= '<div class="' . esc_attr($animate) . '" ' . $animation_data . '>';

			$block_html .= '<div id="' . esc_attr($unique_id) . '" style="height: ' . esc_attr($size) . 'px;" class="map-holder"></div>';

			$block_html .= '</div>';

			$block_html .= '
				<script type="text/javascript">
				 jQuery(document).ready(function () {
						 jQuery("#' . esc_js($unique_id) . '").bind(\'gmap-reload\', function() {
								 gmap3_init();
							 });

						 gmap3_init();

						 function gmap3_init() {
							 jQuery("#' . esc_js($unique_id) . '").gmap3(\'destroy\');

							 jQuery("#' . esc_js($unique_id) . '").gmap3({
								 marker: {
									 values: [';
			if ( $explodedByBr ):
				$resultstr = array();
				foreach ( $explodedByBr as $k => $val ) {
					$opt[ $k ]   = $val;
					$resultstr[] = '{address: " ' . strip_tags( $opt[ $k ] ) . '" , data:"' . strip_tags( $opt[ $k ] ) . '", options:{icon: "' . $marker_image_src . '"}}';
				}
				$result_names = implode( ",", $resultstr );
				$block_html .= $result_names;
			endif;
			$block_html .= '],
									 events:{
										 click: function(marker, event, context){
											 var map = jQuery(this).gmap3("get"),
												 infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
											 if (infowindow){
												 infowindow.open(map, marker);
												 infowindow.setContent(\'<div class="noscroll">\'+context.data+\'</div>\');
											 } else {
												 jQuery(this).gmap3({
													 infowindow:{
														 anchor:marker,
														 options:{content: \'<div class="noscroll">\'+context.data+\'</div>\'}
													 }
												 });
											 }
										 }
									 }
								 },
							map: {
								 options: {
									zoom: ' . esc_js($zoom) . ',
									navigationControl: ' . esc_js($enable_zoom) . ',';
			if ( $styleVal ) {
				$block_html .= 'styles:' . $styleVal . ',';
			}
			$block_html .= 'scrollwheel: false,
									streetViewControl: false,
									mapTypeControl: false
								}
							 }
						});
					}
					 });
            </script>';

			return $block_html;

		}

		function crum_google_map_init() {
			if ( function_exists( 'vc_map' ) ) {

				$group = __( "Main Options", 'dfd' );

				vc_map( array(
					"name" => __("Google Map", 'dfd'),
					"base" => "ultimate_google_map",
					"class" => "vc_google_map",
					"controls" => "full",
					"show_settings_on_create" => true,
					"icon" => "vc_google_map",
					//'deprecated' => '4.6',
					"description" => __("Display Google Maps to indicate your location.", 'dfd'),
					"category" => __("Ronneby 1.0", 'dfd'),
					"params"      => array(
						array(
							"type"        => "textfield",
							"heading"     => __( "Map height", 'dfd' ),
							"param_name"  => "size",
							"group"       => $group,
							"description" => __( 'Enter map height in pixels. Example: 200.', 'dfd' )
						),
						array(
							"type"       => "dropdown",
							"heading"    => __( "Map Zoom", 'dfd' ),
							"param_name" => "zoom",
							"group"      => $group,
							"value"      => array(
								__( "14 - Default", 'dfd' ) => 14,
								1,
								2,
								3,
								4,
								5,
								6,
								7,
								8,
								9,
								10,
								11,
								12,
								13,
								15,
								16,
								17,
								18,
								19,
								20
							)
						),
						array(
							"type"        => 'checkbox',
							"heading"     => __( "Enable Zoom In/Out", 'dfd' ),
							"param_name"  => "enable_zoom",
							"group"       => $group,
							"description" => __( "Do you want users to be able to zoom in/out on the map?", 'dfd' ),
							"value"       => Array( __( "Yes, please", 'dfd' ) => true ),
						),
						array(
							"type"        => "attach_image",
							"heading"     => __( "Marker Image", 'dfd' ),
							"param_name"  => "marker_image",
							"value"       => "",
							"group"       => $group,
							"description" => __( "Select image from media library.", 'dfd' )
						),
						array(
							"type"        => "textarea",
							"heading"     => __( "Map Marker Locations", 'dfd' ),
							"param_name"  => "map_markers",
							"group"       => $group,
							"admin_label" => true,
							"description" => __( "Please enter the the list of locations you would like. <br/> Divide values with linebreaks (Enter). Example: <br/> Our Location <br/> Our Location #2", 'dfd' )
						),
						array(
							"type"       => "dropdown",
							"heading"    => __( "Map Style", 'dfd' ),
							"param_name" => "map_style",
							"admin_label" => true,
							"value"      => array(
								"Default"                 => "default",
								"Subtle Grayscale"        => "subtle-grayscale",
								"Calm detailed grayscale" => "calm-grayscale",
								"PNK2"                    => "pnk2",
								"Pale Dawn"               => "pale-dawn",
								"Blue water"              => "blue-water",
								"Shades of Grey"          => "shades-of-grey",
								"Midnight Commander"      => "midnight-commander",
								"Retro"                   => "retro",
								"Light Monochrome"        => "light-monochrome",
								"Paper"                   => "paper",
								"Gowalla"                 => "gowalla",
								"Greyscale"               => "greyscale",
								"Apple Maps-esque"        => "apple-maps-esque",
								"Subtle"                  => "subtle",
								"Neutral Blue"            => "neutral-blue",
								"Flat Map"                => "flat-map",
								"Shift Worker"            => "shift-worker",
								"Become a Dinosaur"		  => 'becomeadinosaur',
								"Avocado World"			  => 'avocado-world',
								"Nature"				  => 'nature',
								"Orange and Green"		  => 'orange-green',
								"Blue with title"			=> 'blue-with-title'
							),
							"group"      => $group,
						),
						array(
							"type"        => "dropdown",
							"class"       => "",
							"heading"     => __( "Animation", 'dfd' ),
							"param_name"  => "module_animation",
							"value"       => dfd_module_animation_styles(),
							"description" => __( "", 'dfd' ),
							"group"       => "Animation Settings",
						),
					)
				) );
			}
		}
	}

	new Ultimate_Google_Maps;
}