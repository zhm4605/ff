var path = require('path');
var moduleExports = {};

// 源文件目录
moduleExports.staticRootDir = path.resolve(__dirname, '../../../'); // 项目根目录
moduleExports.srcRootDir = path.resolve(moduleExports.staticRootDir, './front/src'); // 项目业务代码根目录

moduleExports.pagesDir = path.resolve(moduleExports.srcRootDir, './pages'); // 存放各个页面独有的部分，如入口文件、只有该页面使用到的css、模板文件等


//共用函数、小工具
moduleExports.utilsDir = path.resolve(moduleExports.srcRootDir, './utils');

// 存放组件，可以是纯HTML，也可以包含js/css/image等，看自己需要
moduleExports.componentsDir = path.resolve(moduleExports.srcRootDir, './components'); 

//dll
moduleExports.dllDir = path.resolve(moduleExports.srcRootDir, './dll');

// 生成文件目录
moduleExports.buildDir = path.resolve(moduleExports.staticRootDir, './build'); 
// 存放编译后生成的所有代码、资源（图片、字体等，虽然只是简单的从源目录迁移过来）

//console.log(moduleExports.staticRootDir);

module.exports = moduleExports;
