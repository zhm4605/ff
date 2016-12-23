var outputConfig = require('./webpack-config/output.config.js');
outputConfig.publicPath = 'http://localhost:9090';

module.exports = {
  entry: require('./webpack-config/entry.config.js'),

  output: outputConfig,

  module: require('./webpack-config/module.config.js'),

  devtool: 'eval-source-map',
  devServer: {
    historyApiFallback: true,
    hot: true,
    progress: true,
    port: '9090',
    //inline: true,
    contentBase: 'http://www.shop.com/',
    host:'0.0.0.0',
    publicPath: "http://localhost:9090",
    /*
    proxy: [
        {
            path: './build',
            target: "http://www.shjz.com/"
        }
    ],*/
  },

  resolve: require('./webpack-config/resolve.config.js'),

  plugins: require('./webpack-config/plugins.dev.config.js'),

  postcss: require('./webpack-config/vendor/postcss.config.js'),

};
