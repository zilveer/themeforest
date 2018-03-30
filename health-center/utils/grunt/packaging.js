/* jshint node:true */
module.exports = function(grunt) {
	'use strict';

	var path = require('path');

	var basedir = path.dirname(grunt.file.findup('Gruntfile.js'));
	var theme_name = grunt.file.readJSON(path.join(basedir, 'package.json')).name;
	var builddir = path.join(basedir, 'build', theme_name);
	var secrets = require(grunt.file.findup('secrets.json'));

	function exportApiCall(action, callback) {
		var http = require('https');
		var url = secrets.export_api_url + secrets.export_api_key + '/' + action;

		grunt.log.writeln( url );

		http.get(url, function(res) {
			var body = '';

			res.on('data', function(chunk) {
				body += chunk;
			});

			res.on('end', function() {
				var response = body;

				try {
					response = JSON.parse(body.trim());
				} catch(e) {}

				callback(null, response);
			});
		}).on('error', function(err) {
			callback(err);
		});
	}

	grunt.registerTask('scp-download-samples', function() {
		var done = this.async();

		var files = [
			['cache/all.css', 'samples/all-default.css'],
			['samples/saved_skins/*', 'samples/saved_skins/']
		], fi = -1;

		var next = function() {
			if(++fi >= files.length)
				return done();

			grunt.log.writeln('Downloading '+files[fi][0]+' to '+files[fi][1]);

			var exec = require('child_process').exec;

			var scp = grunt.template.process("scp <%= ssh_host %>:<%= remotepath %> <%= localpath %>", {
				data: {
					ssh_host: secrets.ssh_host,
					remotepath: path.join( grunt.template.process(secrets.livepath, grunt.config()), files[fi][0] ),
					localpath: path.join(builddir, files[fi][1]),
				}
			});

			exec(scp, function(error) {
				if(error) return done(grunt.util.error(error));

				next();
			});
		};

		next();
	});

	grunt.registerTask('download-layerslider', function() {
		var done = this.async();

		var exec = require('child_process').exec;
		var fs   = require("fs");

		var localdir = path.join(builddir, 'samples/layerslider/');
		grunt.file.mkdir(localdir);

		grunt.log.writeln('Downloading layerslider-export.zip');

		var temp_file = '/tmp/layerslider-export.zip';

		exportApiCall( 'layerslider', function(err, res) {
			if(err) return done(false);


			var curl = "curl -o " + temp_file + " " + res.exported;

			exec(curl, function(error) {
				if(error) return done(grunt.util.error(error));

				var data = grunt.file.read( temp_file, { encoding: 'binary' } );

				var Zip = require('node-zip');
				var spread = new Zip( data, { base64: false, checkCRC32: true});

				Object.keys(spread.files).forEach( function( f ) {
					if ( ! f.match( /json$/ ) ) {
						return true;
					}

					var single = new Zip();

					single.file( f, spread.file(f).asText() );

					var data = single.generate( { base64: false } );

					var spath = path.join( localdir, f.split( '/' )[0] );
					grunt.file.mkdir( spath );
					fs.writeFileSync( path.join( spath, 'slider.zip' ), data, 'binary' );

					grunt.file.copy( path.join( basedir, 'samples', 'small.png' ), path.join( spath, 'preview.png' ) );
				} );

				done();
			});
		});
	});

	grunt.registerTask('download-revslider', function() {
		var done = this.async();

		exportApiCall('revslider', function(err, res) {
			if(err) return done(grunt.util.error("API error:"+err));

			if ( res.length === 0 ) {
				done( grunt.util.error( 'No sliders found, possibly something went wrong.' ) );

				console.error( res );

				return;
			}

			var exec = require('child_process').exec;

			var localdir = path.join(builddir, 'samples/revslider/');
			grunt.file.mkdir(localdir);

			var ri = -1;

			var next = function() {
				if(++ri >= res.length)
					return done();

				grunt.log.writeln('Downloading '+res[ri]);

				var url = secrets.export_api_url + secrets.export_api_key + '/revslider-single/' + res[ri];

				var curl = "curl -o " + path.join(localdir, res[ri] + '.zip') + " " + url;

				exec(curl, function(error) {
					if(error) return done(grunt.util.error(error));

					next();
				});
			};

			next();
		});
	});

	grunt.registerTask('prepare-skins', function() {
		var done = this.async();

		exportApiCall('fix-skin-urls', function(err, res) {
			if(err) return done(grunt.util.erorr('HTTP error'));

			if(!('status' in res) || res.status !== 'ok')
				return done(grunt.util.error("Cannot fix the skin urls - check the remote server's write permissions"));

			if(!('total' in res) || res.total === 0)
				return done(grunt.util.error("No skins found."));

			grunt.log.writeln("Success. Found "+res.total+" skins");

			done();
		});
	});

	grunt.registerTask('check-api', function() {
		var done = this.async();

		exportApiCall('api-version', function(err, res) {
			if(err) return done(false);
			if(!('version' in res) || res.version < grunt.config('pkg').vamtamApi)
				return done(grunt.util.error("Old Export API. Please update the plugin to version " + grunt.config('pkg').vamtamApi));

			done();
		});
	});

	grunt.registerTask('download-sidebars-options', function() {
		var done = this.async();

		var parts = [
			['sidebars', 'sidebars', 'sidebars'],
			['default-options', 'default-options.php', 'options'],
		], pi = -1;

		var next = function() {
			if(++pi >= parts.length)
				return done();

			grunt.log.writeln('Downloading '+parts[pi][1]);

			exportApiCall(parts[pi][0], function(err, res) {
				if(err) return done(false);

				grunt.file.write(path.join(builddir, "samples", parts[pi][1]), res[parts[pi][2]].replace(/(\r\n|\r|\n)/g, "\n"));
				next();
			});
		};

		next();
	});

	grunt.registerTask('download-content-xml', function() {
		var done = this.async();

		exportApiCall('content.xml', function(err, res) {
			if(err) return done(grunt.util.error("API error:"+err));

			console.log(res);

			var exec = require('child_process').exec;
			var curl = "curl -o "+path.join(builddir, 'samples', 'content.xml')+" "+res.download_url;

			exec(curl, function(err) {
				if(err) return done(grunt.util.error(err));

				grunt.log.writeln("saved content.xml");
				done();
			});
		});
	});

	grunt.registerTask('download-images', function() {
		var done = this.async();

		var localdir = path.join(builddir, 'samples/images/');
		grunt.file.mkdir(localdir);

		exportApiCall('image-replacements', function(err, res) {
			if(!('images' in res))
				return done(grunt.util.error('No image info.'));

			var images = res.images.filter(function(s) { return s; }),
				i = 0;

			var fix_skins = function() {
				if(images.length === 0) return done();

				var skins_dir = path.join(builddir, 'samples/saved_skins');
				require('fs').readdir(skins_dir, function(err, files) {
					if(err) return done(grunt.util.error('Cannot read skins'));
					for(var i in files) {
						var skin = files[i];

						if(skin.match('theme_')) {
							grunt.log.writeln('fixing urls in skin: '+skin);
							skin = path.join(skins_dir, skin);

							var skin_data = grunt.file.readJSON(skin);

							for(var prop in skin_data) {
								for(var ii in images) {
									if(typeof skin_data[prop] === "string" && skin_data[prop].match(images[ii])) {
										skin_data[prop] = skin_data[prop].replace(images[ii], '{WPV_SAMPLES_URI}images/' + path.basename(images[ii]));
									}
								}
							}

							grunt.file.write(skin, JSON.stringify(skin_data));
						}
					}

					done();
				});
			};

			var next = function() {
				if(i >= images.length) return fix_skins();

				var image_url = images[i++];
				var localpath = path.join(localdir, path.basename(image_url));

				var exec = require('child_process').exec;
				var curl = "curl -o "+localpath+" "+image_url;

				exec(curl, function(err) {
					if(err) return done(grunt.util.error(err));

					grunt.log.writeln("saved: "+image_url);
					next();
				});
			};

			next();
		});
	});

	grunt.registerMultiTask('add-textdomain', function() {
		var files = grunt.file.expand(this.data);

		for(var fi in files) {
			grunt.file.write(files[fi],
				grunt.file.read(files[fi])
					.replace(/,\s*(['"])wpv\1/g, ", '"+theme_name+"'")
					.replace("load_theme_textdomain('wpv'", "load_theme_textdomain('"+theme_name+"'")
					.replace("load_theme_textdomain( 'wpv'", "load_theme_textdomain( '"+theme_name+"'")
			);
		}
	});

	grunt.registerTask('download-lessphp', function() {
		var done = this.async();

		var download_url = 'https://raw.github.com/leafo/lessphp/master/lessc.inc.php';
		var local_path = path.join(basedir, 'vamtam', 'classes', 'lessc.php');

		var classes = [
			['lessc', 'WpvLessc'],
			['lessc_parser', 'WpvLesscParser'],
			['lessc_formatter_classic', 'WpvLesscFormatter_classic'],
			['lessc_formatter_compressed', 'WpvLesscFormatter_compressed'],
			['lessc_formatter_lessjs', 'WpvLesscFormatter_lessjs'],
		];

		var exec = require('child_process').exec;
		var curl = "curl -o "+local_path+" "+download_url;

		exec(curl, function(err) {
			if(err) return done(grunt.util.error(err));

			grunt.log.writeln("saved lessc.php");

			rename(0);
		});

		var rename = function(ci) {
			if(ci >= classes.length) return rename_strings();

			console.log('Renaming '+classes[ci][0]+' to '+classes[ci][1]);

			exec("scisr rename-class "+classes[ci][0]+' '+classes[ci][1]+' '+local_path, function(err) {
				if(err) return done(grunt.util.error(err));

				rename(ci+1);
			});
		};

		var rename_strings = function() {
			var contents = grunt.file.read(local_path);

			contents = contents.replace(/lessc_formatter_lessjs/g, 'WpvLesscFormatter_lessjs');

			// tries to replace callbacks with the new class name, since scisr doesn't recognize them
			contents = contents.replace(/(['"'])(lessc\w*)/g, function(match, quot, name) {
				return quot + 'Wpv' + name[0].toUpperCase() + name.replace(/_([a-z])/g, function(m) { return m[1].toUpperCase(); }).slice(1);
			});

			grunt.file.write(local_path, contents);

			done();
		};
	});

	grunt.registerTask('build-plugins', function() {
		var done = this.async();
		var prefix = 'vamtam/plugins/';

		var plugins = grunt.file.expand([
			prefix + '*',
			'!'+ prefix + '*.*',
		]);

		plugins.forEach(function(dirname) {
			var plugin_name = dirname.replace(prefix, '');

			grunt.config.set('compress.plugin-'+plugin_name, {
				options: {
					archive: prefix + plugin_name + '.zip',
					mode: 'zip',
					pretty: true
				},
				files: [{
					expand: true,
					src: [
						plugin_name + '/**/*',
						'!' + plugin_name + '/node_modules/**',
					],
					cwd: 'vamtam/plugins/'
				}]
			});

			grunt.task.run('compress:plugin-'+plugin_name);
		});

		done();
	});
};