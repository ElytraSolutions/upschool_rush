function y(c,i,t,n){function a(e){return e instanceof t?e:new t(function(l){l(e)})}return new(t||(t=Promise))(function(e,l){function f(u){try{r(n.next(u))}catch(s){l(s)}}function o(u){try{r(n.throw(u))}catch(s){l(s)}}function r(u){u.done?e(u.value):a(u.value).then(f,o)}r((n=n.apply(c,i||[])).next())})}function h(c,i){var t={label:0,sent:function(){if(e[0]&1)throw e[1];return e[1]},trys:[],ops:[]},n,a,e,l;return l={next:f(0),throw:f(1),return:f(2)},typeof Symbol=="function"&&(l[Symbol.iterator]=function(){return this}),l;function f(r){return function(u){return o([r,u])}}function o(r){if(n)throw new TypeError("Generator is already executing.");for(;l&&(l=0,r[0]&&(t=0)),t;)try{if(n=1,a&&(e=r[0]&2?a.return:r[0]?a.throw||((e=a.return)&&e.call(a),0):a.next)&&!(e=e.call(a,r[1])).done)return e;switch(a=0,e&&(r=[r[0]&2,e.value]),r[0]){case 0:case 1:e=r;break;case 4:return t.label++,{value:r[1],done:!1};case 5:t.label++,a=r[1],r=[0];continue;case 7:r=t.ops.pop(),t.trys.pop();continue;default:if(e=t.trys,!(e=e.length>0&&e[e.length-1])&&(r[0]===6||r[0]===2)){t=0;continue}if(r[0]===3&&(!e||r[1]>e[0]&&r[1]<e[3])){t.label=r[1];break}if(r[0]===6&&t.label<e[1]){t.label=e[1],e=r;break}if(e&&t.label<e[2]){t.label=e[2],t.ops.push(r);break}e[2]&&t.ops.pop(),t.trys.pop();continue}r=i.call(c,t)}catch(u){r=[6,u],a=0}finally{n=e=0}if(r[0]&5)throw r[1];return{value:r[0]?r[1]:void 0,done:!0}}}function d(c,i){var t=typeof Symbol=="function"&&c[Symbol.iterator];if(!t)return c;var n=t.call(c),a,e=[],l;try{for(;(i===void 0||i-- >0)&&!(a=n.next()).done;)e.push(a.value)}catch(f){l={error:f}}finally{try{a&&!a.done&&(t=n.return)&&t.call(n)}finally{if(l)throw l.error}}return e}function b(c,i,t){if(t||arguments.length===2)for(var n=0,a=i.length,e;n<a;n++)(e||!(n in i))&&(e||(e=Array.prototype.slice.call(i,0,n)),e[n]=i[n]);return c.concat(e||Array.prototype.slice.call(i))}export{y as _,h as a,b,d as c};