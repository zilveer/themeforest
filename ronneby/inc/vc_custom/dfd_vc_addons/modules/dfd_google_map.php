<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists("Dfd_Google_Map")) {
	class Dfd_Google_Map {
		
		function __construct() {
			add_shortcode( 'dfd_google_map', array( &$this, 'dfd_google_map_form' ) );
			add_action( 'init', array( &$this, 'dfd_google_map_init' ) );
		}
		
		function dfd_google_map_custom_styles($simple = false) {
			$options = array(
				'subtle-grayscale'   => array(
					esc_attr__( 'Subtle Grayscale', 'dfd' ),
					"[{'featureType':'landscape','stylers':[{'saturation':-100},{'lightness':65},{'visibility':'on'}]},{'featureType':'poi','stylers':[{'saturation':-100},{'lightness':51},{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'road.arterial','stylers':[{'saturation':-100},{'lightness':30},{'visibility':'on'}]},{'featureType':'road.local','stylers':[{'saturation':-100},{'lightness':40},{'visibility':'on'}]},{'featureType':'transit','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'administrative.province','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':-25},{'saturation':-100}]},{'featureType':'water','elementType':'geometry','stylers':[{'hue':'#ffff00'},{'lightness':-25},{'saturation':-97}]}]"
				),
				'calm-grayscale'     => array(
					esc_attr__( 'Calm detailed grayscale', 'dfd' ),
					"[{'featureType':'all','elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#333333'},{'lightness':40}]},{'featureType':'all','elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#ffffff'},{'lightness':16}]},{'featureType':'all','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#fefefe'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#fefefe'},{'lightness':17},{'weight':1.2}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'lightness':20},{'color':'#ececec'}]},{'featureType':'landscape.man_made','elementType':'all','stylers':[{'visibility':'on'},{'color':'#f0f0ef'}]},{'featureType':'landscape.man_made','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#f0f0ef'}]},{'featureType':'landscape.man_made','elementType':'geometry.stroke','stylers':[{'visibility':'on'},{'color':'#d4d4d4'}]},{'featureType':'landscape.natural','elementType':'all','stylers':[{'visibility':'on'},{'color':'#ececec'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'lightness':21},{'visibility':'off'}]},{'featureType':'poi','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#d4d4d4'}]},{'featureType':'poi','elementType':'labels.text.fill','stylers':[{'color':'#303030'}]},{'featureType':'poi','elementType':'labels.icon','stylers':[{'saturation':'-100'}]},{'featureType':'poi.attraction','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.business','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.government','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.medical','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.park','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#dedede'},{'lightness':21}]},{'featureType':'poi.place_of_worship','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.school','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.school','elementType':'geometry.stroke','stylers':[{'lightness':'-61'},{'gamma':'0.00'},{'visibility':'off'}]},{'featureType':'poi.sports_complex','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffffff'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#ffffff'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#ffffff'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#ffffff'},{'lightness':16}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#f2f2f2'},{'lightness':19}]},{'featureType':'water','elementType':'geometry','stylers':[{'color':'#dadada'},{'lightness':17}]}]"
				),
				'pnk2'               => array(
					esc_attr__( 'PNK2', 'dfd' ),
					"[{'featureType':'all','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels.text.fill','stylers':[{'color':'#444444'}]},{'featureType':'landscape','elementType':'all','stylers':[{'color':'#f2f2f2'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'all','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','elementType':'all','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'color':'#b6e3f5'},{'visibility':'on'}]}]"
				),
				'pale-dawn'          => array(
					esc_attr__( 'Pale Dawn', 'dfd' ),
					"[{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#acbcc9'}]},{'featureType':'landscape','stylers':[{'color':'#f2e5d4'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'color':'#c5c6c6'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#e4d7c6'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#fbfaf7'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#c5dac6'}]},{'featureType':'administrative','stylers':[{'visibility':'on'},{'lightness':33}]},{'featureType':'road'},{'featureType':'poi.park','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':20}]},{},{'featureType':'road','stylers':[{'lightness':20}]}]"
				),
				'blue-water'         => array(
					esc_attr__( 'Blue water', 'dfd' ),
					"[{'featureType':'water','stylers':[{'color':'#46bcec'},{'visibility':'on'}]},{'featureType':'landscape','stylers':[{'color':'#f2f2f2'}]},{'featureType':'road','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels.text.fill','stylers':[{'color':'#444444'}]},{'featureType':'transit','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'off'}]}]"
				),
				'shades-of-grey'     => array(
					esc_attr__( 'Shades of Grey', 'dfd' ),
					"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]}]"
				),
				'midnight-commander' => array(
					esc_attr__( 'Midnight Commander', 'dfd' ),
					"[{'featureType':'water','stylers':[{'color':'#021019'}]},{'featureType':'landscape','stylers':[{'color':'#08304b'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#0c4152'},{'lightness':5}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#0b434f'},{'lightness':25}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.arterial','elementType':'geometry.stroke','stylers':[{'color':'#0b3d51'},{'lightness':16}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'elementType':'labels.text.stroke','stylers':[{'color':'#000000'},{'lightness':13}]},{'featureType':'transit','stylers':[{'color':'#146474'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#144b53'},{'lightness':14},{'weight':1.4}]}]"
				),
				'retro'              => array(
					esc_attr__( 'Retro', 'dfd' ),
					"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'water','stylers':[{'color':'#84afa3'},{'lightness':52}]},{'stylers':[{'saturation':-17},{'gamma':0.36}]},{'featureType':'transit.line','elementType':'geometry','stylers':[{'color':'#3f518c'}]}]"
				),
				'light-monochrome'   => array(
					esc_attr__( 'Light Monochrome', 'dfd' ),
					"[{'featureType':'water','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':-78},{'lightness':67},{'visibility':'simplified'}]},{'featureType':'landscape','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'simplified'}]},{'featureType':'road','elementType':'geometry','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'simplified'}]},{'featureType':'poi','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'off'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'hue':'#e9ebed'},{'saturation':-90},{'lightness':-8},{'visibility':'simplified'}]},{'featureType':'transit','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':10},{'lightness':69},{'visibility':'on'}]},{'featureType':'administrative.locality','elementType':'all','stylers':[{'hue':'#2c2e33'},{'saturation':7},{'lightness':19},{'visibility':'on'}]},{'featureType':'road','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'on'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':-2},{'visibility':'simplified'}]}]"
				),
				'paper'              => array(
					esc_attr__( 'Paper', 'dfd' ),
					"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'road.arterial','stylers':[{'visibility':'off'}]},{'featureType':'water','stylers':[{'color':'#5f94ff'},{'lightness':26},{'gamma':5.86}]},{},{'featureType':'road.highway','stylers':[{'weight':0.6},{'saturation':-85},{'lightness':61}]},{'featureType':'road'},{},{'featureType':'landscape','stylers':[{'hue':'#0066ff'},{'saturation':74},{'lightness':100}]}]"
				),
				'gowalla'            => array(
					esc_attr__( 'Gowalla', 'dfd' ),
					"[{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'},{'lightness':20}]},{'featureType':'administrative.land_parcel','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road.local','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'hue':'#a1cdfc'},{'saturation':30},{'lightness':49}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'hue':'#f49935'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'hue':'#fad959'}]}]"
				),
				'greyscale'          => array(
					esc_attr__( 'Greyscale', 'dfd' ),
					"[{'featureType':'all','stylers':[{'saturation':-100},{'gamma':0.5}]}]"
				),
				'apple-maps-esque'   => array(
					esc_attr__( 'Apple Maps-esque', 'dfd' ),
					"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#a2daf2'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'color':'#f7f1df'}]},{'featureType':'landscape.natural','elementType':'geometry','stylers':[{'color':'#d0e3b4'}]},{'featureType':'landscape.natural.terrain','elementType':'geometry','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#bde6ab'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.medical','elementType':'geometry','stylers':[{'color':'#fbd3da'}]},{'featureType':'poi.business','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffe15f'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#efd151'}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'road.local','elementType':'geometry.fill','stylers':[{'color':'black'}]},{'featureType':'transit.station.airport','elementType':'geometry.fill','stylers':[{'color':'#cfb2db'}]}]"
				),
				'subtle'             => array(
					esc_attr__( 'Subtle', 'dfd' ),
					"[{'featureType':'poi','stylers':[{'visibility':'off'}]},{'stylers':[{'saturation':-70},{'lightness':37},{'gamma':1.15}]},{'elementType':'labels','stylers':[{'gamma':0.26},{'visibility':'off'}]},{'featureType':'road','stylers':[{'lightness':0},{'saturation':0},{'hue':'#ffffff'},{'gamma':0}]},{'featureType':'road','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'lightness':50},{'saturation':0},{'hue':'#ffffff'}]},{'featureType':'administrative.province','stylers':[{'visibility':'on'},{'lightness':-50}]},{'featureType':'administrative.province','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'administrative.province','elementType':'labels.text','stylers':[{'lightness':20}]}]"
				),
				'neutral-blue'       => array(
					esc_attr__( 'Neutral Blue', 'dfd' ),
					"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#193341'}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#2c5a71'}]},{'featureType':'road','elementType':'geometry','stylers':[{'color':'#29768a'},{'lightness':-37}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#3e606f'},{'weight':2},{'gamma':0.84}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'administrative','elementType':'geometry','stylers':[{'weight':0.6},{'color':'#1a3541'}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#2c5a71'}]}]"
				),
				'flat-map'           => array(
					esc_attr__( 'Flat Map', 'dfd' ),
					"[{'stylers':[{'visibility':'off'}]},{'featureType':'road','stylers':[{'visibility':'on'},{'color':'#ffffff'}]},{'featureType':'road.arterial','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'road.highway','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'landscape','stylers':[{'visibility':'on'},{'color':'#f3f4f4'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#7fc8ed'}]},{},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#83cead'}]},{'elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'weight':0.9},{'visibility':'off'}]}]"
				),
				'shift-worker'       => array(
					esc_attr__( 'Shift Worker', 'dfd' ),
					"[{'stylers':[{'saturation':-100},{'gamma':1}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'saturation':50},{'gamma':0},{'hue':'#50a5d1'}]},{'featureType':'administrative.neighborhood','elementType':'labels.text.fill','stylers':[{'color':'#333333'}]},{'featureType':'road.local','elementType':'labels.text','stylers':[{'weight':0.5},{'color':'#333333'}]},{'featureType':'transit.station','elementType':'labels.icon','stylers':[{'gamma':1},{'saturation':50}]}]"
				),
				'becomeadinosaur'       => array(
					esc_attr__( 'Become a Dinosaur', 'dfd' ),
					'[{"elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#f5f5f2"},{"visibility":"on"}]},{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#ffffff"},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"visibility":"simplified"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"color":"#ffffff"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.park","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#71c8d4"}]},{"featureType":"landscape","stylers":[{"color":"#e5e8e7"}]},{"featureType":"poi.park","stylers":[{"color":"#8ba129"}]},{"featureType":"road","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.sports_complex","elementType":"geometry","stylers":[{"color":"#c7c7c7"},{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#a0d3d3"}]},{"featureType":"poi.park","stylers":[{"color":"#91b65d"}]},{"featureType":"poi.park","stylers":[{"gamma":1.51}]},{"featureType":"road.local","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.government","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","stylers":[{"visibility":"simplified"}]},{"featureType":"road"},{"featureType":"road"},{},{"featureType":"road.highway"}]'
				),
				'avocado-world'       => array(
					esc_attr__( 'Avocado World', 'dfd' ),
					'[{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]'
				),
				'nature'       => array(
					esc_attr__( 'Nature', 'dfd' ),
					'[{"featureType":"landscape","stylers":[{"hue":"#FFA800"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#53FF00"},{"saturation":-73},{"lightness":40},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FBFF00"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#00FFFD"},{"saturation":0},{"lightness":30},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#00BFFF"},{"saturation":6},{"lightness":8},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#679714"},{"saturation":33.4},{"lightness":-25.4},{"gamma":1}]}]'
				),
				/*
				'orange-green'       => array(
					esc_attr__( 'Orange and Green', 'dfd' ),
					'[{"featureType": "all","elementType": "geometry","stylers": [{"color": "#00a07f"}]},{"featureType": "all","elementType": "geometry.fill","stylers": [{"color": "#ff6700"},{"visibility": "on"}]},{"featureType": "all","elementType": "labels.text.fill","stylers": [{"gamma": 0.01},{"lightness": 20}]},{"featureType": "all","elementType": "labels.text.stroke","stylers": [{"saturation": -31},{"lightness": -33},{"weight": 2},{"gamma": 0.8}]},{"featureType": "all","elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"featureType": "administrative.country","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "landscape","elementType": "geometry","stylers": [{"lightness": 30},{"saturation": 30}]},{"featureType": "landscape","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "landscape.man_made","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "landscape.natural.landcover","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "poi","elementType": "geometry","stylers": [{"saturation": 20}]},{"featureType": "poi","elementType": "geometry.fill","stylers": [{"color": "#009c73"}]},{"featureType": "poi.park","elementType": "geometry","stylers": [{"lightness": 20},{"saturation": -20},{"color": "#009c73"}]},{"featureType": "road","elementType": "geometry","stylers": [{"lightness": 10},{"saturation": -30}]},{"featureType": "road","elementType": "geometry.fill","stylers": [{"color": "#ff8400"}]},{"featureType": "road","elementType": "geometry.stroke","stylers": [{"saturation": 25},{"lightness": 25}]},{"featureType": "water","elementType": "all","stylers": [{"lightness": -20}]}]'
				),
				'blue-with-title'       => array(
					esc_attr__( 'Blue with title', 'dfd' ),
					'[{"featureType": "all", "elementType": "geometry", "stylers": [ { "color": "#c0ebea"}]},{"featureType": "all","elementType": "labels.text.fill","stylers": [{"gamma": 0.01},{"lightness": 20}]},{"featureType": "all","elementType": "labels.text.stroke","stylers": [{"saturation": -31},{"lightness": -33},{"weight": 2},{"gamma": 0.8}]},{"featureType": "all","elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"featureType": "administrative.country","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "administrative.province","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "administrative.locality","elementType": "all","stylers": [{"visibility": "simplified"}]},{"featureType": "landscape","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "landscape","elementType": "geometry","stylers": [{"lightness": 30},{"saturation": 30}]},{"featureType": "landscape.man_made","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "poi","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "poi","elementType": "geometry","stylers": [{"saturation": 20}]},{"featureType": "poi.park","elementType": "geometry","stylers": [{"lightness": 20},{"saturation": -20}]},{"featureType": "road","elementType": "all","stylers": [{"visibility": "on"}]},{"featureType": "road","elementType": "geometry","stylers": [{"lightness": 10},{"saturation": -30},{"visibility": "on"}]},{"featureType": "road","elementType": "geometry.stroke","stylers": [{"saturation": 25},{"lightness": 25}]},{"featureType": "road","elementType": "labels","stylers": [{"visibility": "off"}]},{"featureType": "road","elementType": "labels.text","stylers": [{"visibility": "off"}]},{"featureType": "transit","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "transit.station","elementType": "all","stylers": [{"visibility": "off"}]},{"featureType": "water","elementType": "all","stylers": [{"lightness": -20}]}]'
				),
				*/
			);
			
			if($simple) {
				$return_array = array();
				foreach($options as $key => $val) {
					$return_array[$key] = array(
						'tooltip'	=> $val[0],
						'src'		=> get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/gmap/' . $key . '.png'
					);
				}
				
				return $return_array;
			}
			
			return $options;
		}
		
		function dfd_google_map_init() {
			if ( function_exists( 'vc_map' ) ) {

				vc_map( array(
					'name' => esc_html__('Google Map', 'dfd'),
					'base' => 'dfd_google_map',
					'class' => 'vc_google_map',
					'controls' => 'full',
					'show_settings_on_create' => true,
					'icon' => 'vc_google_map',
					'description' => esc_html__('Display Google Maps to indicate your location.', 'dfd'),
					'category' => esc_html__('Ronneby 2.0', 'dfd'),
					'params'      => array(
						array(
							'type'       => 'radio_image_select',
							'heading'    => esc_html__( 'Map Style', 'dfd' ),
							'param_name' => 'map_style',
							'admin_label' => true,
							'simple_mode'		=> false,
							'options'      => $this->dfd_google_map_custom_styles(true),
						),
						array(
							'type'        => 'number',
							'heading'     => esc_html__( 'Map height', 'dfd' ),
							'param_name'  => 'size',
							'suffix'	  => 'px',
							'edit_field_class' => 'vc_column vc_col-sm-4',
						),
						array(
							'type'       => 'dropdown',
							'heading'    => __( 'Map Zoom', 'dfd' ),
							'param_name' => 'zoom',
							'edit_field_class' => 'vc_column vc_col-sm-4',
							'value'      => array(
								esc_attr__( '14 - Default', 'dfd' ) => 14,
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
							'type'        => 'ult_switch',
							'heading'     => esc_html__( 'Enable Zoom In/Out', 'dfd' ),
							'param_name'  => 'enable_zoom',
							'value'       => 'true',
							'options' => array(
									'true' => array(
											'label' => '',
											'on' => 'Yes',
											'off' => 'No',
										),
									),
							'edit_field_class' => 'vc_column vc_col-sm-4',
						),
						array(
							'type'        => 'attach_image',
							'heading'     => esc_html__( 'Marker Image', 'dfd' ),
							'param_name'  => 'marker_image',
							'value'       => '',
							'edit_field_class' => 'vc_column vc_col-sm-5',
							'description' => esc_html__( 'Select image from media library.', 'dfd' )
						),
						array(
							'type'        => 'textarea',
							'heading'     => esc_html__( 'Map Marker Locations', 'dfd' ),
							'edit_field_class' => 'vc_column vc_col-sm-7',
							'param_name'  => 'map_markers',
							'admin_label' => true,
							'description' => esc_html__( 'Please enter the the list of locations you would like. Divide values with linebreaks (Enter). Example: Our Location <br/> Our Location #2', 'dfd' )
						),
						array(
							'type'        => 'dropdown',
							'class'       => '',
							'heading'     => esc_html__( 'Animation', 'dfd' ),
							'param_name'  => 'module_animation',
							'value'       => dfd_module_animation_styles(),
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => esc_html__('Info window style','dfd'),
							'param_name' => 'infobox_style',
							'value' => array(
								esc_attr__('Disabled','dfd') => '',
								esc_attr__('Contacts block','dfd') => 'contacts',
								esc_attr__('Shortcode','dfd') => 'shortcode',
							),
							'group'      => esc_html__( 'Info box', 'dfd' ),
						),
						array(
							'type'        => 'textarea',
							'heading'     => esc_html__( 'Contacts block shortcode', 'dfd' ),
							'param_name'  => 'content',
							'admin_label' => true,
							'description' => esc_html__( 'Please paste the shortcode to be displayed in front of the map in this field', 'dfd' ),
							'dependency'  => array( 'element' => 'infobox_style', 'value' => array( 'shortcode' ) ),
							'group'      => esc_html__( 'Info box', 'dfd' ),
						),
						array(
							'type'       => 'textfield',
							'heading'    => __( 'Infobox heading', 'dfd' ),
							'param_name' => 'infobox_heading',
							'dependency'  => array( 'element' => 'infobox_style', 'value' => array( 'contacts' ) ),
							'group'      => esc_html__( 'Info box', 'dfd' ),
						),
						array(
							'type'        => 'param_group',
							'heading'     => esc_html__( 'Contact information', 'dfd' ),
							'param_name'  => 'info_fields',
							'dependency' => array( 'element' => 'infobox_style', 'value' => array( 'contacts' ) ),
							'group'      => esc_html__( 'Info box', 'dfd' ),
							'params'      => array(
								array(
									'type' => 'dropdown',
									'heading' => esc_html__( 'Icon library', 'js_composer' ),
									'value' => array(
										esc_attr__( 'Theme default', 'js_composer' ) => 'dfd_icons',
										esc_attr__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
										esc_attr__( 'Open Iconic', 'js_composer' ) => 'openiconic',
										esc_attr__( 'Typicons', 'js_composer' ) => 'typicons',
										esc_attr__( 'Entypo', 'js_composer' ) => 'entypo',
										esc_attr__( 'Linecons', 'js_composer' ) => 'linecons',
									),
									'param_name' => 'icon_font',
									'description' => __( 'Select icon library.', 'js_composer' ),
								),
								array(
									'type'       => 'iconpicker',
									'class'      => '',
									'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
									'param_name' => 'icon_dfd_icons',
									'value' => '', // default value to backend editor admin_label
									'settings' => array(
										'emptyIcon' => false,
										// default true, display an "EMPTY" icon?
										'type' => 'dfd_icons',
										'iconsPerPage' => 4000,
										// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
									),
									'dependency' => array(
										'element' => 'icon_font',
										'value' => 'dfd_icons',
									),
								),
								array(
									'type'       => 'iconpicker',
									'class'      => '',
									'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
									'param_name' => 'icon_fontawesome',
									'value' => '', // default value to backend editor admin_label
									'settings' => array(
										'emptyIcon' => false,
										// default true, display an "EMPTY" icon?
										'iconsPerPage' => 4000,
										// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
									),
									'dependency' => array(
										'element' => 'icon_font',
										'value' => 'fontawesome',
									),
								),
								array(
									'type' => 'iconpicker',
									'heading' => __( 'Icon', 'js_composer' ),
									'param_name' => 'icon_openiconic',
									'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
									'settings' => array(
										'emptyIcon' => false, // default true, display an "EMPTY" icon?
										'type' => 'openiconic',
										'iconsPerPage' => 4000, // default 100, how many icons per/page to display
									),
									'dependency' => array(
										'element' => 'icon_font',
										'value' => 'openiconic',
									),
									'description' => __( 'Select icon from library.', 'js_composer' ),
								),
								array(
									'type' => 'iconpicker',
									'heading' => __( 'Icon', 'js_composer' ),
									'param_name' => 'icon_typicons',
									'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
									'settings' => array(
										'emptyIcon' => false, // default true, display an "EMPTY" icon?
										'type' => 'typicons',
										'iconsPerPage' => 4000, // default 100, how many icons per/page to display
									),
									'dependency' => array(
										'element' => 'icon_font',
										'value' => 'typicons',
									),
									'description' => __( 'Select icon from library.', 'js_composer' ),
								),
								array(
									'type' => 'iconpicker',
									'heading' => __( 'Icon', 'js_composer' ),
									'param_name' => 'icon_entypo',
									'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
									'settings' => array(
										'emptyIcon' => false, // default true, display an "EMPTY" icon?
										'type' => 'entypo',
										'iconsPerPage' => 4000, // default 100, how many icons per/page to display
									),
									'dependency' => array(
										'element' => 'icon_font',
										'value' => 'entypo',
									),
								),
								array(
									'type' => 'iconpicker',
									'heading' => __( 'Icon', 'js_composer' ),
									'param_name' => 'icon_linecons',
									'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
									'settings' => array(
										'emptyIcon' => false, // default true, display an "EMPTY" icon?
										'type' => 'linecons',
										'iconsPerPage' => 4000, // default 100, how many icons per/page to display
									),
									'dependency' => array(
										'element' => 'icon_font',
										'value' => 'linecons',
									),
									'description' => __( 'Select icon from library.', 'js_composer' ),
								),
								array(
									'type'        => 'textarea',
									'heading'     => esc_html__( 'Content', 'dfd' ),
									'param_name'  => 'info_text',
								),
							),
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => esc_html__('Info window alignment','dfd'),
							'param_name' => 'infobox_alignment',
							'value' => array(
								esc_attr__('Left','dfd') => 'left-aligned',
								esc_attr__('Right','dfd') => 'right-aligned',
							),
							'dependency'  => array( 'element' => 'infobox_style', 'value' => array( 'shortcode','contacts' ) ),
							'group'      => esc_html__( 'Info box', 'dfd' ),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'infobox_background',
							'heading' => esc_html__('Infobox background', 'dfd'),
							'value' => '',
							'dependency'  => array( 'element' => 'infobox_style', 'value' => array( 'shortcode','contacts' ) ),
							'group'      => esc_html__( 'Info box', 'dfd' ),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'infobox_color',
							'heading' => esc_html__('Infobox text color', 'dfd'),
							'value' => '',
							'dependency'  => array( 'element' => 'infobox_style', 'value' => array( 'shortcode','contacts' ) ),
							'dependency'  => array( 'element' => 'infobox_style', 'value' => array( 'contacts' ) ),
							'group'      => esc_html__( 'Info box', 'dfd' ),
						),
						array(
							'type'       => 'crumina_font_container',
							'heading'    => '',
							'param_name' => 'title_font_options',
							'settings'   => array(
								'fields' => array(
									'tag' => 'div',
									'letter_spacing',
									'font_size',
									'line_height',
									'color',
									'font_style'
								),
							),
							'dependency'  => array( 'element' => 'infobox_style', 'value' => array( 'contacts' ) ),
							'group'      => esc_attr__( 'Typography', 'dfd' ),
						),
						array(
							'type'        => 'checkbox',
							'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
							'param_name'  => 'title_google_fonts',
							'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
							'description' => esc_html__( 'Use font family from google.', 'dfd' ),
							'dependency'  => array( 'element' => 'infobox_style', 'value' => array( 'contacts' ) ),
							'group'       => esc_attr__( 'Typography', 'dfd' ),
						),
						array(
							'type'       => 'google_fonts',
							'param_name' => 'title_custom_fonts',
							'value'      => '',
							'group'      => esc_attr__( 'Typography', 'dfd' ),
							'settings'   => array(
								'fields' => array(
									'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
									'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
								),
							),
							'dependency' => array(
								'element' => 'title_google_fonts',
								'value'   => 'yes',
							),
						),
					)
				) );
			}
		}

		function dfd_get_map_style( $map_style ) {
			$opts = $this->dfd_google_map_custom_styles();

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


		function dfd_google_map_form( $atts, $content = null ) {
			$size = $img_link_target = $zoom = $enable_zoom = $marker_image = $map_markers = $map_style = $module_animation = $block_html = $css_rules = '';
			
			$atts = vc_map_get_attributes( 'dfd_google_map', $atts );
			extract( $atts );

			wp_enqueue_script( 'gmaps' );
			wp_enqueue_script( 'gmap3' );
			
			if($size == '') {
				$size = 450;
			}
			
			$unique_id = uniqid( "map_" );

			$explodedByBr = explode( '\n', $map_markers );

			$marker_image_src = 'https://mts.googleapis.com/vt/icon/name=icons/spotlight/spotlight-poi.png';
			if ( ! empty( $marker_image ) ) {
				$marker_image_src = wp_get_attachment_image_src( $marker_image, 'full' );
				$marker_image_src = $marker_image_src[0];
			}

			if ( isset( $map_style ) ) {
				$styleVal = $this->dfd_get_map_style( $map_style );
			} else {
				$styleVal = false;
			}
			
			if(!isset($enable_zoom) || $enable_zoom != 'true') {
				$enable_zoom = 'false';
			}

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if(isset($infobox_background) && $infobox_background != '')
				$css_rules .= '.'.esc_js($unique_id).'.dfd-gmap-module .dfd-gmap-tooltip-wrap .cover .dfd-gmap-tooltip {background: '.esc_attr($infobox_background).'}';
			
			if(isset($infobox_color) && $infobox_color != '') {
				$border_color = dfd_hex2rgb($infobox_color, .2);
				$css_rules .= '.'.esc_js($unique_id).'.dfd-gmap-module .dfd-gmap-tooltip-wrap .cover .dfd-gmap-tooltip {color: '.esc_attr($infobox_color).'}';
				$css_rules .= '.'.esc_js($unique_id).'.dfd-gmap-module .dfd-gmap-tooltip-wrap .cover .dfd-gmap-tooltip ul.dfd-gmap-infobox li:before {border-bottom-color: '.esc_attr($border_color).'}';
			}
			
			$infobox_alignment = (isset($infobox_alignment) && !empty($infobox_alignment)) ? $infobox_alignment : 'left-aligned';

			$block_html .= '<div class="dfd-gmap-module ' . esc_attr($unique_id) . ' ' . esc_attr($animate) . '" ' . $animation_data . '>';

				$block_html .= '<div id="' . esc_attr($unique_id) . '" style="height: ' . esc_attr($size) . 'px;" class="map-holder"></div>';

				if(isset($infobox_style) && ($infobox_style == 'shortcode' || $infobox_style == 'contacts')) {
					$block_html .= '<div class="dfd-gmap-tooltip-wrap"><div class="cover"><div class="dfd-gmap-tooltip '.esc_attr($infobox_alignment).'">';

						if($infobox_style == 'shortcode' && !empty($content)) {

							$block_html .= do_shortcode($content);

						} elseif($infobox_style == 'contacts') {

							if(isset($infobox_heading) && $infobox_heading != '') {
								$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'widget-title', $title_google_fonts, $title_custom_fonts );
								$block_html .= '<'.$title_options['tag'].' class="block-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . $infobox_heading . '</'.$title_options['tag'].'>';
							}

							if(isset($info_fields) && !empty($info_fields) && function_exists('vc_param_group_parse_atts')) {
								$info_fields = (array) vc_param_group_parse_atts( $info_fields );

								$block_html .= '<ul class="dfd-gmap-infobox">';

								foreach($info_fields as $field) {
									$block_html .= '<li>';
									
										vc_icon_element_fonts_enqueue( $field['icon_font'] );

										if(isset($field['icon_'.$field['icon_font']]))
											$block_html .= '<span><i class="'.esc_attr($field['icon_'.$field['icon_font']]).'"></i></span>';

										if(isset($field['info_text']))
											$block_html .= '<p>'.$field['info_text'].'</p>';

									$block_html .= '</li>';
								}

								$block_html .= '</ul>';
							}
						}

						$block_html .= '';

					$block_html .= '</div></div></div>';
				}

				$block_html .= '
					<script type="text/javascript">
						(function($) {
							$(document).ready(function () {
								$("#' . esc_js($unique_id) . '").bind(\'gmap-reload\', function() {
										 gmap3_init();
									});

								gmap3_init();

								function gmap3_init() {
									$("#' . esc_js($unique_id) . '").gmap3(\'destroy\');

									$("#' . esc_js($unique_id) . '").gmap3({
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
														infowindow = $(this).gmap3({get:{name:"infowindow"}});
													if (infowindow){
														infowindow.open(map, marker);
														infowindow.setContent(\'<div class="noscroll">\'+context.data+\'</div>\');
													} else {
														$(this).gmap3({
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
						});';
					
					if($css_rules != '')
						$block_html .= '$("head").append("<style>'.$css_rules.'</style>");';
					
					$block_html .= '})(jQuery);
				</script>';
			
			$block_html .= '</div>';

			return $block_html;

		}
	}

	new Dfd_Google_Map;
}