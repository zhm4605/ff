var path = require('path');
var dirVars = require('./base/dir-vars.config.js');
module.exports = {
  // 模块别名的配置，为了使用方便，一般来说所有模块都是要配置一下别名的
  alias: {
    srcRootDir: dirVars.srcRootDir,
    /* 各种目录 */
    iconfontDir: path.resolve(dirVars.srcRootDir, 'iconfont/'),

    /* less */
    lessDir: path.resolve(dirVars.srcRootDir, 'less'),

    /* components */
    utilsDir: dirVars.utilsDir,
    /* components */
    componentsDir: dirVars.componentsDir,
    /* device */
    deviceDir: path.resolve(dirVars.srcRootDir, './device'),

    comm: path.resolve(dirVars.utilsDir, 'common.jsx'),
    
  },

  // 当require的模块找不到时，尝试添加这些后缀后进行寻找
  extentions: ['', 'js','jsx'],
};

