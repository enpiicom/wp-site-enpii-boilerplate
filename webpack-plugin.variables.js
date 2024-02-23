/* Set webpack variables */
const basePath = './wp-content/plugins/demoda';

var webpackParams = {
    // Input file path
    entryPath: {
        main: [
			basePath + '/public-assets/src/js/main.js',
			basePath + '/public-assets/src/scss/main.scss',
		],
        admin: [
			basePath + '/public-assets/src/js/admin.js',
			basePath + '/public-assets/src/scss/admin.scss',
		],
	},

    // Output for CSS and JS
    jsOutputPath: basePath + '/public-assets/dist/js/[name].js',
    cssOutputPath: basePath + '/public-assets/dist/css/[name].css',
    fontOutputPath: basePath + '/public-assets/dist/fonts/[name].[ext]',
    fontRelativePath: '../../../../../../',
	imageOutputPath: basePath + '/public-assets/dist/images/[name].[ext]',
    imageRelativePath: '../../../../../../',
};

module.exports = {webpackParams};

