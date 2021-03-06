var webpack = require('webpack');
var HtmlWebpackPlugin = require('html-webpack-plugin');
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var path = require('path');
var dirVars = require('../base/dir-vars.config.js');
var pageArr = require('../base/page-entries.config.js');

var configPlugins = [
  /* 全局shimming */
  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
    'window.jQuery': 'jquery',
    'window.$': 'jquery',
    Promise: 'promise-polyfill',
    React: 'react',
    'fetch': 'imports?this=>global!exports?global.fetch!whatwg-fetch',
  }),
  /* 抽取出所有通用的部分 */
  new webpack.optimize.CommonsChunkPlugin({
    name: 'commons/commons',      // 需要注意的是，chunk的name不能相同！！！
    filename: 'build/[name]/bundle.js',
    minChunks: 4,
  }),
  //抽取出chunk的css
  new ExtractTextPlugin('build/[name]/styles.css'),

  /*
  new ExtractTextPlugin('styles.css', {
      disable: false,
      allChunks: true
    }),
  */
  new webpack.optimize.OccurenceOrderPlugin(),

  /* 配置好Dll */
  new webpack.DllReferencePlugin({
    context: dirVars.staticRootDir, // 指定一个路径作为上下文环境，需要与DllPlugin的context参数保持一致，建议统一设置为项目根目录
    manifest: require('../../manifest.json'), // 指定manifest.json
    name: 'dll',  // 当前Dll的所有内容都会存放在这个参数指定变量名的一个全局变量下，注意与DllPlugin的name参数保持一致
  }),
];

pageArr.forEach((page) => {
  const htmlPlugin = new HtmlWebpackPlugin({
    filename: path.resolve(dirVars.staticRootDir, `./application/views/${page}.html`),
    template: path.resolve(dirVars.pagesDir, `./${page}/page.html`),
    chunks: [page, 'commons/commons'],
    /*
    chunks:{
     "head": {
        "entry": ['commons/commons','dll'],
        "css": ["dll/dll.css"]
      },
      "main": {
        "entry": page
      },
    },*/
    //hash: true, // 为静态资源生成hash值
    xhtml: true,
  });
  configPlugins.push(htmlPlugin);
});
//console.log(configPlugins);

module.exports = configPlugins;
