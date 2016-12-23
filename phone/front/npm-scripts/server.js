var webpack = require('webpack');
var WebpackDevServer = require('webpack-dev-server');

var config = require('../webpack.dev.config.js');
delete config.output.publicPath;
var compiler = webpack(config);
var server = new WebpackDevServer(compiler, config.devServer);
server.listen(9090);