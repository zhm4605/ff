var webpack = require('webpack');
var pluginsConfig = require('./inherit/plugins.config.js');

pluginsConfig.push(new webpack.DefinePlugin({
  IS_PRODUCTION: false,
  'process.env.NODE_ENV': '"development"'
}));

pluginsConfig.push(new webpack.HotModuleReplacementPlugin());
module.exports = pluginsConfig;
