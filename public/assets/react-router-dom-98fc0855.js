import{r as p}from"./react-18892649.js";import{m as O,u as _,a as k,D as j,N as x,b as B,c as D}from"./react-router-c8f2c9f0.js";import{c as F,b as W,E as z,s as K,d as E}from"./@remix-run-46b80ddf.js";/**
 * React Router DOM v6.15.0
 *
 * Copyright (c) Remix Software Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE.md file in the root directory of this source tree.
 *
 * @license MIT
 */function g(){return g=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var a=arguments[t];for(var n in a)Object.prototype.hasOwnProperty.call(a,n)&&(e[n]=a[n])}return e},g.apply(this,arguments)}function U(e,t){if(e==null)return{};var a={},n=Object.keys(e),r,i;for(i=0;i<n.length;i++)r=n[i],!(t.indexOf(r)>=0)&&(a[r]=e[r]);return a}function A(e){return!!(e.metaKey||e.altKey||e.ctrlKey||e.shiftKey)}function H(e,t){return e.button===0&&(!t||t==="_self")&&!A(e)}const T=["onClick","relative","reloadDocument","replace","state","target","to","preventScrollReset"],G=["aria-current","caseSensitive","className","end","style","to","children"];function $(e,t){return F({basename:t==null?void 0:t.basename,future:g({},t==null?void 0:t.future,{v7_prependBasename:!0}),history:W({window:t==null?void 0:t.window}),hydrationData:(t==null?void 0:t.hydrationData)||M(),routes:e,mapRouteProperties:O}).initialize()}function M(){var e;let t=(e=window)==null?void 0:e.__staticRouterHydrationData;return t&&t.errors&&(t=g({},t,{errors:X(t.errors)})),t}function X(e){if(!e)return null;let t=Object.entries(e),a={};for(let[n,r]of t)if(r&&r.__type==="RouteErrorResponse")a[n]=new z(r.status,r.statusText,r.data,r.internal===!0);else if(r&&r.__type==="Error"){if(r.__subType){let i=window[r.__subType];if(typeof i=="function")try{let s=new i(r.message);s.stack="",a[n]=s}catch{}}if(a[n]==null){let i=new Error(r.message);i.stack="",a[n]=i}}else a[n]=r;return a}const q=typeof window<"u"&&typeof window.document<"u"&&typeof window.document.createElement<"u",I=/^(?:[a-z][a-z0-9+.-]*:|\/\/)/i,J=p.forwardRef(function(t,a){let{onClick:n,relative:r,reloadDocument:i,replace:s,state:d,target:h,to:o,preventScrollReset:m}=t,w=U(t,T),{basename:C}=p.useContext(x),v,R=!1;if(typeof o=="string"&&I.test(o)&&(v=o,q))try{let l=new URL(window.location.href),f=o.startsWith("//")?new URL(l.protocol+o):new URL(o),b=K(f.pathname,C);f.origin===l.origin&&b!=null?o=b+f.search+f.hash:R=!0}catch{}let c=B(o,{relative:r}),y=Q(o,{replace:s,state:d,target:h,preventScrollReset:m,relative:r});function u(l){n&&n(l),l.defaultPrevented||y(l)}return p.createElement("a",g({},w,{href:v||c,onClick:R||i?n:u,ref:a,target:h}))}),ee=p.forwardRef(function(t,a){let{"aria-current":n="page",caseSensitive:r=!1,className:i="",end:s=!1,style:d,to:h,children:o}=t,m=U(t,G),w=_(h,{relative:m.relative}),C=k(),v=p.useContext(j),{navigator:R}=p.useContext(x),c=R.encodeLocation?R.encodeLocation(w).pathname:w.pathname,y=C.pathname,u=v&&v.navigation&&v.navigation.location?v.navigation.location.pathname:null;r||(y=y.toLowerCase(),u=u?u.toLowerCase():null,c=c.toLowerCase());let l=y===c||!s&&y.startsWith(c)&&y.charAt(c.length)==="/",f=u!=null&&(u===c||!s&&u.startsWith(c)&&u.charAt(c.length)==="/"),b=l?n:void 0,L;typeof i=="function"?L=i({isActive:l,isPending:f}):L=[i,l?"active":null,f?"pending":null].filter(Boolean).join(" ");let N=typeof d=="function"?d({isActive:l,isPending:f}):d;return p.createElement(J,g({},m,{"aria-current":b,className:L,ref:a,style:N,to:h}),typeof o=="function"?o({isActive:l,isPending:f}):o)});var P;(function(e){e.UseScrollRestoration="useScrollRestoration",e.UseSubmit="useSubmit",e.UseSubmitFetcher="useSubmitFetcher",e.UseFetcher="useFetcher"})(P||(P={}));var S;(function(e){e.UseFetchers="useFetchers",e.UseScrollRestoration="useScrollRestoration"})(S||(S={}));function Q(e,t){let{target:a,replace:n,state:r,preventScrollReset:i,relative:s}=t===void 0?{}:t,d=D(),h=k(),o=_(e,{relative:s});return p.useCallback(m=>{if(H(m,a)){m.preventDefault();let w=n!==void 0?n:E(h)===E(o);d(e,{replace:w,state:r,preventScrollReset:i,relative:s})}},[h,d,o,n,r,a,e,i,s])}export{ee as N,$ as c};
