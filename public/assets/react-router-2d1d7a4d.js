import{r as n,R as F}from"./react-18892649.js";import{i as g,A as O,p as I,s as k,g as L,r as M,m as A,j as R,a as _}from"./@remix-run-46b80ddf.js";/**
 * React Router v6.15.0
 *
 * Copyright (c) Remix Software Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE.md file in the root directory of this source tree.
 *
 * @license MIT
 */function b(){return b=Object.assign?Object.assign.bind():function(t){for(var e=1;e<arguments.length;e++){var r=arguments[e];for(var l in r)Object.prototype.hasOwnProperty.call(r,l)&&(t[l]=r[l])}return t},b.apply(this,arguments)}const y=n.createContext(null),T=n.createContext(null),x=n.createContext(null),N=n.createContext(null),C=n.createContext({outlet:null,matches:[],isDataRoute:!1}),j=n.createContext(null);function ie(t,e){let{relative:r}=e===void 0?{}:e;E()||g(!1);let{basename:l,navigator:o}=n.useContext(x),{hash:a,pathname:u,search:s}=q(t,{relative:r}),i=u;return l!=="/"&&(i=u==="/"?l:R([l,u])),o.createHref({pathname:i,search:s,hash:a})}function E(){return n.useContext(N)!=null}function B(){return E()||g(!1),n.useContext(N).location}function D(t){n.useContext(x).static||n.useLayoutEffect(t)}function se(){let{isDataRoute:t}=n.useContext(C);return t?te():w()}function w(){E()||g(!1);let t=n.useContext(y),{basename:e,navigator:r}=n.useContext(x),{matches:l}=n.useContext(C),{pathname:o}=B(),a=JSON.stringify(L(l).map(i=>i.pathnameBase)),u=n.useRef(!1);return D(()=>{u.current=!0}),n.useCallback(function(i,c){if(c===void 0&&(c={}),!u.current)return;if(typeof i=="number"){r.go(i);return}let m=M(i,JSON.parse(a),o,c.relative==="path");t==null&&e!=="/"&&(m.pathname=m.pathname==="/"?e:R([e,m.pathname])),(c.replace?r.replace:r.push)(m,c.state,c)},[e,r,a,o,t])}const z=n.createContext(null);function W(t){let e=n.useContext(C).outlet;return e&&n.createElement(z.Provider,{value:t},e)}function ue(){let{matches:t}=n.useContext(C),e=t[t.length-1];return e?e.params:{}}function q(t,e){let{relative:r}=e===void 0?{}:e,{matches:l}=n.useContext(C),{pathname:o}=B(),a=JSON.stringify(L(l).map(u=>u.pathnameBase));return n.useMemo(()=>M(t,JSON.parse(a),o,r==="path"),[t,a,o,r])}function G(t,e,r){E()||g(!1);let{navigator:l}=n.useContext(x),{matches:o}=n.useContext(C),a=o[o.length-1],u=a?a.params:{};a&&a.pathname;let s=a?a.pathnameBase:"/";a&&a.route;let i=B(),c;if(e){var m;let v=typeof e=="string"?I(e):e;s==="/"||(m=v.pathname)!=null&&m.startsWith(s)||g(!1),c=v}else c=i;let d=c.pathname||"/",p=s==="/"?d:d.slice(s.length)||"/",f=A(t,{pathname:p}),h=Y(f&&f.map(v=>Object.assign({},v,{params:Object.assign({},u,v.params),pathname:R([s,l.encodeLocation?l.encodeLocation(v.pathname).pathname:v.pathname]),pathnameBase:v.pathnameBase==="/"?s:R([s,l.encodeLocation?l.encodeLocation(v.pathnameBase).pathname:v.pathnameBase])})),o,r);return e&&h?n.createElement(N.Provider,{value:{location:b({pathname:"/",search:"",hash:"",state:null,key:"default"},c),navigationType:O.Pop}},h):h}function K(){let t=ee(),e=_(t)?t.status+" "+t.statusText:t instanceof Error?t.message:JSON.stringify(t),r=t instanceof Error?t.stack:null,o={padding:"0.5rem",backgroundColor:"rgba(200,200,200, 0.5)"},a=null;return n.createElement(n.Fragment,null,n.createElement("h2",null,"Unexpected Application Error!"),n.createElement("h3",{style:{fontStyle:"italic"}},e),r?n.createElement("pre",{style:o},r):null,a)}const Q=n.createElement(K,null);class V extends n.Component{constructor(e){super(e),this.state={location:e.location,revalidation:e.revalidation,error:e.error}}static getDerivedStateFromError(e){return{error:e}}static getDerivedStateFromProps(e,r){return r.location!==e.location||r.revalidation!=="idle"&&e.revalidation==="idle"?{error:e.error,location:e.location,revalidation:e.revalidation}:{error:e.error||r.error,location:r.location,revalidation:e.revalidation||r.revalidation}}componentDidCatch(e,r){console.error("React Router caught the following error during render",e,r)}render(){return this.state.error?n.createElement(C.Provider,{value:this.props.routeContext},n.createElement(j.Provider,{value:this.state.error,children:this.props.component})):this.props.children}}function X(t){let{routeContext:e,match:r,children:l}=t,o=n.useContext(y);return o&&o.static&&o.staticContext&&(r.route.errorElement||r.route.ErrorBoundary)&&(o.staticContext._deepestRenderedBoundaryId=r.route.id),n.createElement(C.Provider,{value:e},l)}function Y(t,e,r){var l;if(e===void 0&&(e=[]),r===void 0&&(r=null),t==null){var o;if((o=r)!=null&&o.errors)t=r.matches;else return null}let a=t,u=(l=r)==null?void 0:l.errors;if(u!=null){let s=a.findIndex(i=>i.route.id&&(u==null?void 0:u[i.route.id]));s>=0||g(!1),a=a.slice(0,Math.min(a.length,s+1))}return a.reduceRight((s,i,c)=>{let m=i.route.id?u==null?void 0:u[i.route.id]:null,d=null;r&&(d=i.route.errorElement||Q);let p=e.concat(a.slice(0,c+1)),f=()=>{let h;return m?h=d:i.route.Component?h=n.createElement(i.route.Component,null):i.route.element?h=i.route.element:h=s,n.createElement(X,{match:i,routeContext:{outlet:s,matches:p,isDataRoute:r!=null},children:h})};return r&&(i.route.ErrorBoundary||i.route.errorElement||c===0)?n.createElement(V,{location:r.location,revalidation:r.revalidation,component:d,error:m,children:f(),routeContext:{outlet:null,matches:p,isDataRoute:!0}}):f()},null)}var S=function(t){return t.UseBlocker="useBlocker",t.UseRevalidator="useRevalidator",t.UseNavigateStable="useNavigate",t}(S||{}),P=function(t){return t.UseBlocker="useBlocker",t.UseLoaderData="useLoaderData",t.UseActionData="useActionData",t.UseRouteError="useRouteError",t.UseNavigation="useNavigation",t.UseRouteLoaderData="useRouteLoaderData",t.UseMatches="useMatches",t.UseRevalidator="useRevalidator",t.UseNavigateStable="useNavigate",t.UseRouteId="useRouteId",t}(P||{});function Z(t){let e=n.useContext(y);return e||g(!1),e}function $(t){let e=n.useContext(T);return e||g(!1),e}function H(t){let e=n.useContext(C);return e||g(!1),e}function J(t){let e=H(),r=e.matches[e.matches.length-1];return r.route.id||g(!1),r.route.id}function ee(){var t;let e=n.useContext(j),r=$(P.UseRouteError),l=J(P.UseRouteError);return e||((t=r.errors)==null?void 0:t[l])}function te(){let{router:t}=Z(S.UseNavigateStable),e=J(P.UseNavigateStable),r=n.useRef(!1);return D(()=>{r.current=!0}),n.useCallback(function(o,a){a===void 0&&(a={}),r.current&&(typeof o=="number"?t.navigate(o):t.navigate(o,b({fromRouteId:e},a)))},[t,e])}const re="startTransition",U=F[re];function ce(t){let{fallbackElement:e,router:r,future:l}=t,[o,a]=n.useState(r.state),{v7_startTransition:u}=l||{},s=n.useCallback(d=>{u&&U?U(()=>a(d)):a(d)},[a,u]);n.useLayoutEffect(()=>r.subscribe(s),[r,s]);let i=n.useMemo(()=>({createHref:r.createHref,encodeLocation:r.encodeLocation,go:d=>r.navigate(d),push:(d,p,f)=>r.navigate(d,{state:p,preventScrollReset:f==null?void 0:f.preventScrollReset}),replace:(d,p,f)=>r.navigate(d,{replace:!0,state:p,preventScrollReset:f==null?void 0:f.preventScrollReset})}),[r]),c=r.basename||"/",m=n.useMemo(()=>({router:r,navigator:i,static:!1,basename:c}),[r,i,c]);return n.createElement(n.Fragment,null,n.createElement(y.Provider,{value:m},n.createElement(T.Provider,{value:o},n.createElement(ae,{basename:c,location:o.location,navigationType:o.historyAction,navigator:i},o.initialized?n.createElement(ne,{routes:r.routes,state:o}):e))),null)}function ne(t){let{routes:e,state:r}=t;return G(e,void 0,r)}function de(t){return W(t.context)}function ae(t){let{basename:e="/",children:r=null,location:l,navigationType:o=O.Pop,navigator:a,static:u=!1}=t;E()&&g(!1);let s=e.replace(/^\/*/,"/"),i=n.useMemo(()=>({basename:s,navigator:a,static:u}),[s,a,u]);typeof l=="string"&&(l=I(l));let{pathname:c="/",search:m="",hash:d="",state:p=null,key:f="default"}=l,h=n.useMemo(()=>{let v=k(c,s);return v==null?null:{location:{pathname:v,search:m,hash:d,state:p,key:f},navigationType:o}},[s,c,m,d,p,f,o]);return h==null?null:n.createElement(x.Provider,{value:i},n.createElement(N.Provider,{children:r,value:h}))}new Promise(()=>{});function me(t){let e={hasErrorBoundary:t.ErrorBoundary!=null||t.errorElement!=null};return t.Component&&Object.assign(e,{element:n.createElement(t.Component),Component:void 0}),t.ErrorBoundary&&Object.assign(e,{errorElement:n.createElement(t.ErrorBoundary),ErrorBoundary:void 0}),e}export{T as D,x as N,de as O,ce as R,B as a,ie as b,se as c,ue as d,me as m,q as u};
