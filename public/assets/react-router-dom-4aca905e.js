import{r as u}from"./react-f4831f7c.js";import{m as j,u as k,a as C,D as B,N as x,b as N,c as D}from"./react-router-2bd5f159.js";import{c as F,b as W,E as z,s as K,d as E}from"./@remix-run-46b80ddf.js";/**
 * React Router DOM v6.15.0
 *
 * Copyright (c) Remix Software Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE.md file in the root directory of this source tree.
 *
 * @license MIT
 */function g(){return g=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var a=arguments[t];for(var n in a)Object.prototype.hasOwnProperty.call(a,n)&&(e[n]=a[n])}return e},g.apply(this,arguments)}function O(e,t){if(e==null)return{};var a={},n=Object.keys(e),r,o;for(o=0;o<n.length;o++)r=n[o],!(t.indexOf(r)>=0)&&(a[r]=e[r]);return a}function H(e){return!!(e.metaKey||e.altKey||e.ctrlKey||e.shiftKey)}function T(e,t){return e.button===0&&(!t||t==="_self")&&!H(e)}function L(e){return e===void 0&&(e=""),new URLSearchParams(typeof e=="string"||Array.isArray(e)||e instanceof URLSearchParams?e:Object.keys(e).reduce((t,a)=>{let n=e[a];return t.concat(Array.isArray(n)?n.map(r=>[a,r]):[[a,n]])},[]))}function M(e,t){let a=L(e);return t&&t.forEach((n,r)=>{a.has(r)||t.getAll(r).forEach(o=>{a.append(r,o)})}),a}const G=["onClick","relative","reloadDocument","replace","state","target","to","preventScrollReset"],X=["aria-current","caseSensitive","className","end","style","to","children"];function te(e,t){return F({basename:t==null?void 0:t.basename,future:g({},t==null?void 0:t.future,{v7_prependBasename:!0}),history:W({window:t==null?void 0:t.window}),hydrationData:(t==null?void 0:t.hydrationData)||q(),routes:e,mapRouteProperties:j}).initialize()}function q(){var e;let t=(e=window)==null?void 0:e.__staticRouterHydrationData;return t&&t.errors&&(t=g({},t,{errors:J(t.errors)})),t}function J(e){if(!e)return null;let t=Object.entries(e),a={};for(let[n,r]of t)if(r&&r.__type==="RouteErrorResponse")a[n]=new z(r.status,r.statusText,r.data,r.internal===!0);else if(r&&r.__type==="Error"){if(r.__subType){let o=window[r.__subType];if(typeof o=="function")try{let l=new o(r.message);l.stack="",a[n]=l}catch{}}if(a[n]==null){let o=new Error(r.message);o.stack="",a[n]=o}}else a[n]=r;return a}const Q=typeof window<"u"&&typeof window.document<"u"&&typeof window.document.createElement<"u",V=/^(?:[a-z][a-z0-9+.-]*:|\/\/)/i,Y=u.forwardRef(function(t,a){let{onClick:n,relative:r,reloadDocument:o,replace:l,state:c,target:f,to:s,preventScrollReset:p}=t,w=O(t,G),{basename:S}=u.useContext(x),v,R=!1;if(typeof s=="string"&&V.test(s)&&(v=s,Q))try{let i=new URL(window.location.href),m=s.startsWith("//")?new URL(i.protocol+s):new URL(s),P=K(m.pathname,S);m.origin===i.origin&&P!=null?s=P+m.search+m.hash:R=!0}catch{}let d=D(s,{relative:r}),y=Z(s,{replace:l,state:c,target:f,preventScrollReset:p,relative:r});function h(i){n&&n(i),i.defaultPrevented||y(i)}return u.createElement("a",g({},w,{href:v||d,onClick:R||o?n:h,ref:a,target:f}))}),re=u.forwardRef(function(t,a){let{"aria-current":n="page",caseSensitive:r=!1,className:o="",end:l=!1,style:c,to:f,children:s}=t,p=O(t,X),w=k(f,{relative:p.relative}),S=C(),v=u.useContext(B),{navigator:R}=u.useContext(x),d=R.encodeLocation?R.encodeLocation(w).pathname:w.pathname,y=S.pathname,h=v&&v.navigation&&v.navigation.location?v.navigation.location.pathname:null;r||(y=y.toLowerCase(),h=h?h.toLowerCase():null,d=d.toLowerCase());let i=y===d||!l&&y.startsWith(d)&&y.charAt(d.length)==="/",m=h!=null&&(h===d||!l&&h.startsWith(d)&&h.charAt(d.length)==="/"),P=i?n:void 0,b;typeof o=="function"?b=o({isActive:i,isPending:m}):b=[o,i?"active":null,m?"pending":null].filter(Boolean).join(" ");let A=typeof c=="function"?c({isActive:i,isPending:m}):c;return u.createElement(Y,g({},p,{"aria-current":P,className:b,ref:a,style:A,to:f}),typeof s=="function"?s({isActive:i,isPending:m}):s)});var _;(function(e){e.UseScrollRestoration="useScrollRestoration",e.UseSubmit="useSubmit",e.UseSubmitFetcher="useSubmitFetcher",e.UseFetcher="useFetcher"})(_||(_={}));var U;(function(e){e.UseFetchers="useFetchers",e.UseScrollRestoration="useScrollRestoration"})(U||(U={}));function Z(e,t){let{target:a,replace:n,state:r,preventScrollReset:o,relative:l}=t===void 0?{}:t,c=N(),f=C(),s=k(e,{relative:l});return u.useCallback(p=>{if(T(p,a)){p.preventDefault();let w=n!==void 0?n:E(f)===E(s);c(e,{replace:w,state:r,preventScrollReset:o,relative:l})}},[f,c,s,n,r,a,e,o,l])}function ae(e){let t=u.useRef(L(e)),a=u.useRef(!1),n=C(),r=u.useMemo(()=>M(n.search,a.current?null:t.current),[n.search]),o=N(),l=u.useCallback((c,f)=>{const s=L(typeof c=="function"?c(r):c);a.current=!0,o("?"+s,f)},[o,r]);return[r,l]}export{Y as L,re as N,te as c,ae as u};
