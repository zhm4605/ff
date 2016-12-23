var path = require('path');
var dirVars = require('./base/dir-vars.config.js');
var pageArr = require('./base/page-entries.config.js');

var configEntry = {};

pageArr.forEach((page) => {
  configEntry[page] = [
  	path.resolve(dirVars.pagesDir, page + '/page.jsx'),
  	'webpack/hot/dev-server',   
		'webpack-dev-server/client?http://0.0.0.0:9090'
	];
});

//console.log(configEntry);
module.exports = configEntry;