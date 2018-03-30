<?php
global $road_opt;

//Style Switcher
function style_switcher() { ?>
    <div class="style-switcher hidden-xs hidden-sm hidden-md">
		<div class="stoggler"><i class="fa fa-cog"></i></div>
		<div class="spanel">
			<h2>Style Switcher</h2>
			<form name="styleswitcher" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
				<div class="layout">
					<select name="slayout" class="slayout">
						<option value="">-- Select Layout --</option>
						<option value="full">Full Width</option>
						<option value="box">Box</option>
					</select>
				</div>
				<div class="bg-color">
					<h3>Background Color</h3>
					<ul id="bgsolid" class="colors bgsolid">
						<li><a title="Green" class="green-bg" href="#"></a></li>
						<li><a title="Blue" class="blue-bg" href="#"></a></li>
						<li><a title="Orange" class="orange-bg" href="#"></a></li>
						<li><a title="Navy" class="navy-bg" href="#"></a></li>
						<li><a title="Yellow" class="yellow-bg" href="#"></a></li>
						<li><a title="Peach" class="peach-bg" href="#"></a></li>
						<li><a title="Beige" class="beige-bg" href="#"></a></li>
						<li><a title="Purple" class="purple-bg" href="#"></a></li>
						<li><a title="Red" class="red-bg" href="#"></a></li>
						<li><a title="Pink" class="pink-bg" href="#"></a></li>
						<li><a title="Celadon" class="celadon-bg" href="#"></a></li>
						<li><a title="Brown" class="brown-bg" href="#"></a></li>
						<li><a title="Cherry" class="cherry-bg" href="#"></a></li>
						<li><a title="Cyan" class="cyan-bg" href="#"></a></li>
						<li><a title="Gray" class="gray-bg" href="#"></a></li>
						<li><a title="Dark" class="dark-bg" href="#"></a></li>
					</ul>
				</div>
				<div class="bg-image">
					<h3>Background Image</h3>
					<ul id="bg" class="colors bg">
						<li><a class="bg0" href="#"></a></li>
						<li><a class="bg1" href="#"></a></li>
						<li><a class="bg2" href="#"></a></li>
						<li><a class="bg3" href="#"></a></li>
						<li><a class="bg4" href="#"></a></li>
						<li><a class="bg5" href="#"></a></li>
						<li><a class="bg6" href="#"></a></li>
						<li><a class="bg7" href="#"></a></li>
						<li><a class="bg8" href="#"></a></li>
						<li><a class="bg9" href="#"></a></li>
						<li><a class="bg10" href="#"></a></li>
						<li><a class="bg11" href="#"></a></li>
						<li><a class="bg12" href="#"></a></li>
						<li><a class="bg13" href="#"></a></li>
						<li><a class="bg14" href="#"></a></li>
						<li><a class="bg15" href="#"></a></li>
						<li><a class="bg16" href="#"></a></li>
						<li><a class="bg17" href="#"></a></li>
						<li><a class="bg18" href="#"></a></li>
						<li><a class="bg19" href="#"></a></li>
						<li><a class="bg20" href="#"></a></li>
						<li><a class="bg21" href="#"></a></li>
						<li><a class="bg22" href="#"></a></li>
						<li><a class="bg23" href="#"></a></li>
						<li><a class="bg24" href="#"></a></li>
						<li><a class="bg25" href="#"></a></li>
						<li><a class="bg26" href="#"></a></li>
						<li><a class="bg27" href="#"></a></li>
						<li><a class="bg28" href="#"></a></li>
						<li><a class="bg29" href="#"></a></li>
						<li><a class="bg30" href="#"></a></li>
					</ul>
				</div>
				<button type="button" id="resetpreview" class="btn btn-primary">Reset</button>
				<!--<div class="presets">
					<h2>Preset Switcher</h2>
					<ul id="preset" class="preset">
						<li><a class="preset1" href="?preset=1">Preset 1</a></li>
						<li><a class="preset2" href="?preset=2">Preset 2</a></li>
						<li><a class="preset3" href="?preset=3">Preset 3</a></li>
						<li><a class="preset4" href="?preset=4">Preset 4</a></li>
						<li><a class="preset5" href="?preset=5">Preset 5</a></li>
						<li><a class="preset6" href="?preset=6">Preset 6</a></li>
					</ul>
				</div>-->
			</form>
		</div>
	</div>
<?php
}
if( isset($road_opt['enable_sswitcher']) ) {
	if($road_opt['enable_sswitcher']) {
		add_action('wp_footer', 'style_switcher');
	}
}
?>