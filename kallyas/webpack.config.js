const webpack = require('webpack');
const path = require('path');

const APP_DIR = path.resolve(__dirname, 'framework/pagebuilder/assets/js/src/frontend/');
const BUILD_DIR = path.resolve(__dirname, 'framework/pagebuilder/assets/js/');
const IS_PROD = process.argv[2] === '-p';
const MIN = IS_PROD ? '.min' : '';

var config = {
	// devtool: 'eval',
	entry: {
		frontend_pagebuilder : APP_DIR + '/frontend.js'
	},
	output: {
		path: BUILD_DIR,
		filename: '[name].bundle.js'
	},
	externals: {
		"jquery": "jQuery",
		"jQuery": "jQuery",
		"$": "jQuery"
	},
	module: {
		loaders: [
			{
				test: /\.js$/,
				loaders: ['babel'],
				exclude: /node_modules/
			},
			{
				test: /\.css$/,
				loader: "style-loader!css-loader"
			},
		]
	},
	plugins: [],
};

// Extra config for PRODUCTION
if( IS_PROD ){
	var minify = new webpack.DefinePlugin({
		"process.env": {
			NODE_ENV: JSON.stringify("production")
		}
	});
	config.plugins.push(minify);
}

module.exports = config;