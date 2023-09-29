import{r,R as k}from"./react-18892649.js";import{i as p,g as O,r as U,j as R,A as L,p as M,s as A,m as _,a as w}from"./@remix-run-46b80ddf.js";/**
 * React Router v6.15.0
 *
 * Copyright (c) Remix Software Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE.md file in the root directory of this source tree.
 *
 * @license MIT
 */function P(){return P=Object.assign?Object.assign.bind():function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var l in n)Object.prototype.hasOwnProperty.call(n,l)&&(t[l]=n[l])}return t},P.apply(this,arguments)}const y=r.createContext(null),T=r.createContext(null),E=r.createContext(null),N=r.createContext(null),C=r.createContext({outlet:null,matches:[],isDataRoute:!1}),j=r.createContext(null);function se(t,e){let{relative:n}=e===void 0?{}:e;x()||p(!1);let{basename:l,navigator:a}=r.useContext(E),{hash:o,pathname:u,search:s}=G(t,{relative:n}),i=u;return l!=="/"&&(i=u==="/"?l:R([l,u])),a.createHref({pathname:i,search:s,hash:o})}function x(){return r.useContext(N)!=null}function B(){return x()||p(!1),r.useContext(N).location}function S(t){r.useContext(E).static||r.useLayoutEffect(t)}function z(){let{isDataRoute:t}=r.useContext(C);return t?ne():W()}function W(){x()||p(!1);let t=r.useContext(y),{basename:e,navigator:n}=r.useContext(E),{matches:l}=r.useContext(C),{pathname:a}=B(),o=JSON.stringify(O(l).map(i=>i.pathnameBase)),u=r.useRef(!1);return S(()=>{u.current=!0}),r.useCallback(function(i,c){if(c===void 0&&(c={}),!u.current)return;if(typeof i=="number"){n.go(i);return}let d=U(i,JSON.parse(o),a,c.relative==="path");t==null&&e!=="/"&&(d.pathname=d.pathname==="/"?e:R([e,d.pathname])),(c.replace?n.replace:n.push)(d,c.state,c)},[e,n,o,a,t])}const D=r.createContext(null);function ue(){return r.useContext(D)}function q(t){let e=r.useContext(C).outlet;return e&&r.createElement(D.Provider,{value:t},e)}function ce(){let{matches:t}=r.useContext(C),e=t[t.length-1];return e?e.params:{}}function G(t,e){let{relative:n}=e===void 0?{}:e,{matches:l}=r.useContext(C),{pathname:a}=B(),o=JSON.stringify(O(l).map(u=>u.pathnameBase));return r.useMemo(()=>U(t,JSON.parse(o),a,n==="path"),[t,o,a,n])}function K(t,e,n){x()||p(!1);let{navigator:l}=r.useContext(E),{matches:a}=r.useContext(C),o=a[a.length-1],u=o?o.params:{};o&&o.pathname;let s=o?o.pathnameBase:"/";o&&o.route;let i=B(),c;if(e){var d;let v=typeof e=="string"?M(e):e;s==="/"||(d=v.pathname)!=null&&d.startsWith(s)||p(!1),c=v}else c=i;let m=c.pathname||"/",g=s==="/"?m:m.slice(s.length)||"/",f=_(t,{pathname:g}),h=Z(f&&f.map(v=>Object.assign({},v,{params:Object.assign({},u,v.params),pathname:R([s,l.encodeLocation?l.encodeLocation(v.pathname).pathname:v.pathname]),pathnameBase:v.pathnameBase==="/"?s:R([s,l.encodeLocation?l.encodeLocation(v.pathnameBase).pathname:v.pathnameBase])})),a,n);return e&&h?r.createElement(N.Provider,{value:{location:P({pathname:"/",search:"",hash:"",state:null,key:"default"},c),navigationType:L.Pop}},h):h}function Q(){let t=te(),e=w(t)?t.status+" "+t.statusText:t instanceof Error?t.message:JSON.stringify(t),n=t instanceof Error?t.stack:null,a={padding:"0.5rem",backgroundColor:"rgba(200,200,200, 0.5)"},o=null;return r.createElement(r.Fragment,null,r.createElement("h2",null,"Unexpected Application Error!"),r.createElement("h3",{style:{fontStyle:"italic"}},e),n?r.createElement("pre",{style:a},n):null,o)}const V=r.createElement(Q,null);class X extends r.Component{constructor(e){super(e),this.state={location:e.location,revalidation:e.revalidation,error:e.error}}static getDerivedStateFromError(e){return{error:e}}static getDerivedStateFromProps(e,n){return n.location!==e.location||n.revalidation!=="idle"&&e.revalidation==="idle"?{error:e.error,location:e.location,revalidation:e.revalidation}:{error:e.error||n.error,location:n.location,revalidation:e.revalidation||n.revalidation}}componentDidCatch(e,n){console.error("React Router caught the following error during render",e,n)}render(){return this.state.error?r.createElement(C.Provider,{value:this.props.routeContext},r.createElement(j.Provider,{value:this.state.error,children:this.props.component})):this.props.children}}function Y(t){let{routeContext:e,match:n,children:l}=t,a=r.useContext(y);return a&&a.static&&a.staticContext&&(n.route.errorElement||n.route.ErrorBoundary)&&(a.staticContext._deepestRenderedBoundaryId=n.route.id),r.createElement(C.Provider,{value:e},l)}function Z(t,e,n){var l;if(e===void 0&&(e=[]),n===void 0&&(n=null),t==null){var a;if((a=n)!=null&&a.errors)t=n.matches;else return null}let o=t,u=(l=n)==null?void 0:l.errors;if(u!=null){let s=o.findIndex(i=>i.route.id&&(u==null?void 0:u[i.route.id]));s>=0||p(!1),o=o.slice(0,Math.min(o.length,s+1))}return o.reduceRight((s,i,c)=>{let d=i.route.id?u==null?void 0:u[i.route.id]:null,m=null;n&&(m=i.route.errorElement||V);let g=e.concat(o.slice(0,c+1)),f=()=>{let h;return d?h=m:i.route.Component?h=r.createElement(i.route.Component,null):i.route.element?h=i.route.element:h=s,r.createElement(Y,{match:i,routeContext:{outlet:s,matches:g,isDataRoute:n!=null},children:h})};return n&&(i.route.ErrorBoundary||i.route.errorElement||c===0)?r.createElement(X,{location:n.location,revalidation:n.revalidation,component:m,error:d,children:f(),routeContext:{outlet:null,matches:g,isDataRoute:!0}}):f()},null)}var J=function(t){return t.UseBlocker="useBlocker",t.UseRevalidator="useRevalidator",t.UseNavigateStable="useNavigate",t}(J||{}),b=function(t){return t.UseBlocker="useBlocker",t.UseLoaderData="useLoaderData",t.UseActionData="useActionData",t.UseRouteError="useRouteError",t.UseNavigation="useNavigation",t.UseRouteLoaderData="useRouteLoaderData",t.UseMatches="useMatches",t.UseRevalidator="useRevalidator",t.UseNavigateStable="useNavigate",t.UseRouteId="useRouteId",t}(b||{});function $(t){let e=r.useContext(y);return e||p(!1),e}function H(t){let e=r.useContext(T);return e||p(!1),e}function ee(t){let e=r.useContext(C);return e||p(!1),e}function F(t){let e=ee(),n=e.matches[e.matches.length-1];return n.route.id||p(!1),n.route.id}function te(){var t;let e=r.useContext(j),n=H(b.UseRouteError),l=F(b.UseRouteError);return e||((t=n.errors)==null?void 0:t[l])}function ne(){let{router:t}=$(J.UseNavigateStable),e=F(b.UseNavigateStable),n=r.useRef(!1);return S(()=>{n.current=!0}),r.useCallback(function(a,o){o===void 0&&(o={}),n.current&&(typeof a=="number"?t.navigate(a):t.navigate(a,P({fromRouteId:e},o)))},[t,e])}const re="startTransition",I=k[re];function me(t){let{fallbackElement:e,router:n,future:l}=t,[a,o]=r.useState(n.state),{v7_startTransition:u}=l||{},s=r.useCallback(m=>{u&&I?I(()=>o(m)):o(m)},[o,u]);r.useLayoutEffect(()=>n.subscribe(s),[n,s]);let i=r.useMemo(()=>({createHref:n.createHref,encodeLocation:n.encodeLocation,go:m=>n.navigate(m),push:(m,g,f)=>n.navigate(m,{state:g,preventScrollReset:f==null?void 0:f.preventScrollReset}),replace:(m,g,f)=>n.navigate(m,{replace:!0,state:g,preventScrollReset:f==null?void 0:f.preventScrollReset})}),[n]),c=n.basename||"/",d=r.useMemo(()=>({router:n,navigator:i,static:!1,basename:c}),[n,i,c]);return r.createElement(r.Fragment,null,r.createElement(y.Provider,{value:d},r.createElement(T.Provider,{value:a},r.createElement(oe,{basename:c,location:a.location,navigationType:a.historyAction,navigator:i},a.initialized?r.createElement(ae,{routes:n.routes,state:a}):e))),null)}function ae(t){let{routes:e,state:n}=t;return K(e,void 0,n)}function de(t){let{to:e,replace:n,state:l,relative:a}=t;x()||p(!1);let{matches:o}=r.useContext(C),{pathname:u}=B(),s=z(),i=U(e,O(o).map(d=>d.pathnameBase),u,a==="path"),c=JSON.stringify(i);return r.useEffect(()=>s(JSON.parse(c),{replace:n,state:l,relative:a}),[s,c,a,n,l]),null}function fe(t){return q(t.context)}function oe(t){let{basename:e="/",children:n=null,location:l,navigationType:a=L.Pop,navigator:o,static:u=!1}=t;x()&&p(!1);let s=e.replace(/^\/*/,"/"),i=r.useMemo(()=>({basename:s,navigator:o,static:u}),[s,o,u]);typeof l=="string"&&(l=M(l));let{pathname:c="/",search:d="",hash:m="",state:g=null,key:f="default"}=l,h=r.useMemo(()=>{let v=A(c,s);return v==null?null:{location:{pathname:v,search:d,hash:m,state:g,key:f},navigationType:a}},[s,c,d,m,g,f,a]);return h==null?null:r.createElement(E.Provider,{value:i},r.createElement(N.Provider,{children:n,value:h}))}new Promise(()=>{});function ve(t){let e={hasErrorBoundary:t.ErrorBoundary!=null||t.errorElement!=null};return t.Component&&Object.assign(e,{element:r.createElement(t.Component),Component:void 0}),t.ErrorBoundary&&Object.assign(e,{errorElement:r.createElement(t.ErrorBoundary),ErrorBoundary:void 0}),e}export{T as D,E as N,fe as O,me as R,B as a,se as b,z as c,de as d,ce as e,ue as f,ve as m,G as u};
