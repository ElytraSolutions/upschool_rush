import{e as v,d as x}from"./@babel-029bab3e.js";import{p as g}from"./performance-now-97d3f6eb.js";var m={exports:{}},w=g,a=typeof window>"u"?x:window,s=["moz","webkit"],t="AnimationFrame",o=a["request"+t],l=a["cancel"+t]||a["cancelRequest"+t];for(var c=0;!o&&c<s.length;c++)o=a[s[c]+"Request"+t],l=a[s[c]+"Cancel"+t]||a[s[c]+"CancelRequest"+t];if(!o||!l){var p=0,u=0,e=[],F=1e3/60;o=function(r){if(e.length===0){var n=w(),h=Math.max(0,F-(n-p));p=h+n,setTimeout(function(){var i=e.slice(0);e.length=0;for(var f=0;f<i.length;f++)if(!i[f].cancelled)try{i[f].callback(p)}catch(d){setTimeout(function(){throw d},0)}},Math.round(h))}return e.push({handle:++u,callback:r,cancelled:!1}),u},l=function(r){for(var n=0;n<e.length;n++)e[n].handle===r&&(e[n].cancelled=!0)}}m.exports=function(r){return o.call(a,r)};m.exports.cancel=function(){l.apply(a,arguments)};m.exports.polyfill=function(r){r||(r=a),r.requestAnimationFrame=o,r.cancelAnimationFrame=l};var y=m.exports;const C=v(y);export{C as r};
