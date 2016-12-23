var dirVars = require('./dir-vars.config.js');
var fs = require('fs');
var configEntry = {};

module.exports = fs.readdirSync(dirVars.pagesDir) ;