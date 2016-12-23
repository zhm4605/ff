;(function(window) {

var svgSprite = '<svg>' +
  ''+
    '<symbol id="icon-arrow-down" viewBox="0 0 1024 1024">'+
      ''+
      '<path d="M532.915867 648.339178c0.166799-0.165776 0.309038-0.346901 0.470721-0.51677L737.804281 445.028703c9.706059-9.624195 9.769504-25.28078 0.13917-34.983769-9.623171-9.708106-25.279756-9.770528-34.982746-0.13917L515.605619 595.766822 329.745584 408.416853c-9.629311-9.708106-25.285896-9.770528-34.986839-0.140193-4.851495 4.811586-7.296173 11.130502-7.321756 17.46272-0.024559 6.328126 2.368954 12.668531 7.182586 17.520025l202.800869 204.426903c0.156566 0.167822 0.295735 0.346901 0.458441 0.511653 4.820796 4.857635 11.150968 7.299243 17.489326 7.317663C521.705548 655.54837 528.056186 653.15895 532.915867 648.339178z"  ></path>'+
      ''+
    '</symbol>'+
  ''+
    '<symbol id="icon-nav-up" viewBox="0 0 1024 1024">'+
      ''+
      '<path d="M723.696401 533.102744c0.486519-0.973037 1.337926-1.824445 1.702815-2.797482 8.514075-17.757928 5.716593-39.651265-9.365483-53.881934L372.30835 151.307281c-18.730966-17.757928-48.28697-16.906521-66.044898 1.824445-17.757928 18.730966-16.906521 48.28697 1.824445 66.044898l308.452785 291.789524L309.304193 807.012709c-18.609336 17.879558-19.095855 47.435562-1.216296 66.044898 9.122224 9.487112 21.406818 14.352298 33.569783 14.352298 11.676446 0 23.352892-4.378667 32.353486-13.136002l340.563012-328.278418c0.608148-0.608148 0.851408-1.581185 1.581185-2.189334 0.486519-0.486519 0.973037-0.851408 1.581185-1.337926C720.53403 539.670745 721.871956 536.265115 723.696401 533.102744L723.696401 533.102744zM723.696401 533.102744"  ></path>'+
      ''+
    '</symbol>'+
  ''+
    '<symbol id="icon-nav-down" viewBox="0 0 1024 1024">'+
      ''+
      '<path d="M490.897 723.696c0.973 0.486 1.824 1.338 2.797 1.703 17.758 8.514 39.651 5.717 53.882-9.365l325.116-343.725c17.758-18.731 16.907-48.287-1.824-66.045s-48.287-16.907-66.045 1.824l-291.79 308.453-296.047-307.236c-17.881-18.609-47.436-19.096-66.045-1.216-9.487 9.122-14.351 21.407-14.352 33.57 0 11.676 4.378 23.353 13.137 32.353l328.278 340.563c0.608 0.608 1.581 0.851 2.189 1.581 0.487 0.487 0.851 0.973 1.338 1.581 2.797 2.797 6.203 4.135 9.365 5.959v0zM490.897 723.696z"  ></path>'+
      ''+
    '</symbol>'+
  ''+
'</svg>'
var script = function() {
    var scripts = document.getElementsByTagName('script')
    return scripts[scripts.length - 1]
  }()
var shouldInjectCss = script.getAttribute("data-injectcss")

/**
 * document ready
 */
var ready = function(fn){
  if(document.addEventListener){
      document.addEventListener("DOMContentLoaded",function(){
          document.removeEventListener("DOMContentLoaded",arguments.callee,false)
          fn()
      },false)
  }else if(document.attachEvent){
     IEContentLoaded (window, fn)
  }

  function IEContentLoaded (w, fn) {
      var d = w.document, done = false,
      // only fire once
      init = function () {
          if (!done) {
              done = true
              fn()
          }
      }
      // polling for no errors
      ;(function () {
          try {
              // throws errors until after ondocumentready
              d.documentElement.doScroll('left')
          } catch (e) {
              setTimeout(arguments.callee, 50)
              return
          }
          // no errors, fire

          init()
      })()
      // trying to always fire before onload
      d.onreadystatechange = function() {
          if (d.readyState == 'complete') {
              d.onreadystatechange = null
              init()
          }
      }
  }
}

/**
 * Insert el before target
 *
 * @param {Element} el
 * @param {Element} target
 */

var before = function (el, target) {
  target.parentNode.insertBefore(el, target)
}

/**
 * Prepend el to target
 *
 * @param {Element} el
 * @param {Element} target
 */

var prepend = function (el, target) {
  if (target.firstChild) {
    before(el, target.firstChild)
  } else {
    target.appendChild(el)
  }
}

function appendSvg(){
  var div,svg

  div = document.createElement('div')
  div.innerHTML = svgSprite
  svg = div.getElementsByTagName('svg')[0]
  if (svg) {
    svg.setAttribute('aria-hidden', 'true')
    svg.style.position = 'absolute'
    svg.style.width = 0
    svg.style.height = 0
    svg.style.overflow = 'hidden'
    prepend(svg,document.body)
  }
}

if(shouldInjectCss && !window.__iconfont__svg__cssinject__){
  window.__iconfont__svg__cssinject__ = true
  try{
    document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>");
  }catch(e){
    console && console.log(e)
  }
}

ready(appendSvg)


})(window)
