/* jshint node:true */
module.exports = function(grunt) {
	'use strict';

	grunt.util.linefeed = '\n';

	grunt.util.linefeed = '\n';

	grunt.initConfig(require('./utils/grunt/init')(grunt));
	require('./utils/grunt/packaging')(grunt);

	require('matchdep').filterDev('grunt-*').forEach( grunt.loadNpmTasks );

	grunt.registerTask('buildjs', ['concat', 'uglify']);
	grunt.registerTask('dev', ['parallel:dev']);

	// build process - related tasks go on the same row
	grunt.registerTask('package', [
		'jshint', 'buildjs',
		'build-plugins',
		'parallel:composer',
		'check-api',
		'clean:build', 'clean:dist',
		'makepot', 'add-textdomain',
		'copy:theme',
		'prepare-skins', 'scp-download-samples', 'download-images', 'download-content-xml', 'download-sidebars-options', 'download-revslider',
		'clean:post-copy',
		'replace:style-switcher',
		'compress:theme',
		'clean:build'
	]);
};