var dirVars = require('./base/dir-vars.config.js');
var path = require('path');
module.exports = {
  path: dirVars.staticRootDir,
  filename: 'build/[name]/entry.js', // [name]表示entry每一项中的key，用以批量指定生成后文件的名称
  chunkFilename: '[id].bundle.js',
};
