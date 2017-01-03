var ExtractTextPlugin = require('extract-text-webpack-plugin');
var dirVars = require('./base/dir-vars.config.js');


var theme = {};

var getThemeConfig = require('../theme.js');
theme = getThemeConfig();

//console.log(theme);

module.exports = {
  loaders: [
    /*
    {
      test: require.resolve('jquery'),
      loader: 'expose?$!expose?jQuery',
    },*/
    {
      test: require.resolve('promise-polyfill'),
      loader: 'expose?Promise',
    },
    {
      test: require.resolve("react"), 
      loader: "expose?React"
    },
    {
      test: /\.jsx?$/,
      loader: 'babel',
      include: dirVars.srcRootDir,
      query: {
        presets: ['es2015','react'],
        //plugins: [["import", { libraryName: "antd", style: "true" }]]
        plugins: [["import", { libraryName: "antd", style: true }],'babel-plugin-add-module-exports','babel-plugin-transform-decorators-legacy']
        //plugins: ['babel-plugin-add-module-exports','babel-plugin-transform-decorators-legacy']
      }
    },
    {
      test: /\.html$/,
      include: dirVars.srcRootDir,
      loader: 'html',
    },
    {
      // 图片加载器，雷同file-loader，更适合图片，可以将较小的图片转成base64，减少http请求
      // 如下配置，将小于8192byte的图片转成base64码
      test: /\.(png|jpg|gif)$/,
      include: dirVars.srcRootDir,
      loader: 'url?limit=8192&name=/build/static/img/[hash].[ext]',
    },
    {
      // 专供iconfont方案使用的，后面会带一串时间戳，需要特别匹配到
      test: /\.(woff|woff2|svg|eot|ttf)\??.*$/,
      include: dirVars.srcRootDir,
      loader: 'file?name=/build/static/fonts/[name].[ext]',
    },
    {
      test: /\.css$/,
      //include: dirVars.srcRootDir,
      loader: ExtractTextPlugin.extract('css?minimize&-autoprefixer!postcss'),
      //loader: ExtractTextPlugin.extract('css?minimize'),
    },
    {
      test: /\.less$/,
      //include: dirVars.srcRootDir,
      loader: ExtractTextPlugin.extract('css?minimize&-autoprefixer!postcss!'+
            `less-loader?{"sourceMap":true,"modifyVars":${JSON.stringify(theme)}}`),
    },
  ],
};
