var precss = require('precss');
var autoprefixer = require('autoprefixer');
module.exports = function postcss() {
  return [autoprefixer({
    remove: false,
    browsers: ['ie >= 8', '> 1% in CN'],
  })];
};
