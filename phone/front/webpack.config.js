var outputConfig = require('./webpack-config/output.config.js');
//outputConfig.publicPath = '/build';

module.exports = {
  entry: require('./webpack-config/entry.config.js'),

  output: outputConfig,

  module: require('./webpack-config/module.config.js'),

  resolve: require('./webpack-config/resolve.config.js'),

  plugins: require('./webpack-config/plugins.product.config.js'),
  
  postcss: require('./webpack-config/vendor/postcss.config.js'),

};
