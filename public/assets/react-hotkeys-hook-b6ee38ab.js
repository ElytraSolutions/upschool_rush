import{r as f}from"./react-f4831f7c.js";function P(){return P=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},P.apply(this,arguments)}var B=["shift","alt","meta","mod","ctrl"],q={esc:"escape",return:"enter",".":"period",",":"comma","-":"slash"," ":"space","`":"backquote","#":"backslash","+":"bracketright",ShiftLeft:"shift",ShiftRight:"shift",AltLeft:"alt",AltRight:"alt",MetaLeft:"meta",MetaRight:"meta",OSLeft:"meta",OSRight:"meta",ControlLeft:"ctrl",ControlRight:"ctrl"};function c(e){return(q[e]||e).trim().toLowerCase().replace(/key|digit|numpad|arrow/,"")}function N(e){return B.includes(e)}function H(e,t){return t===void 0&&(t=","),e.split(t)}function A(e,t,n){t===void 0&&(t="+");var o=e.toLocaleLowerCase().split(t).map(function(a){return c(a)}),i={alt:o.includes("alt"),ctrl:o.includes("ctrl")||o.includes("control"),shift:o.includes("shift"),meta:o.includes("meta"),mod:o.includes("mod")},y=o.filter(function(a){return!B.includes(a)});return P({},i,{keys:y,description:n})}(function(){typeof document<"u"&&(document.addEventListener("keydown",function(e){e.key!==void 0&&O([c(e.key),c(e.code)])}),document.addEventListener("keyup",function(e){e.key!==void 0&&_([c(e.key),c(e.code)])})),typeof window<"u"&&window.addEventListener("blur",function(){d.clear()})})();var d=new Set;function S(e){return Array.isArray(e)}function F(e,t){t===void 0&&(t=",");var n=S(e)?e:e.split(t);return n.every(function(o){return d.has(o.trim().toLowerCase())})}function O(e){var t=Array.isArray(e)?e:[e];d.has("meta")&&d.forEach(function(n){return!N(n)&&d.delete(n.toLowerCase())}),t.forEach(function(n){return d.add(n.toLowerCase())})}function _(e){var t=Array.isArray(e)?e:[e];e==="meta"?d.clear():t.forEach(function(n){return d.delete(n.toLowerCase())})}function W(e,t,n){(typeof n=="function"&&n(e,t)||n===!0)&&e.preventDefault()}function $(e,t,n){return typeof n=="function"?n(e,t):n===!0||n===void 0}function z(e){return M(e,["input","textarea","select"])}function M(e,t){var n=e.target;t===void 0&&(t=!1);var o=n&&n.tagName;return S(t)?!!(o&&t&&t.some(function(i){return i.toLowerCase()===o.toLowerCase()})):!!(o&&t&&t===!0)}function G(e,t){return e.length===0&&t?(console.warn('A hotkey has the "scopes" option set, however no active scopes were found. If you want to use the global scopes feature, you need to wrap your app in a <HotkeysProvider>'),!0):t?e.some(function(n){return t.includes(n)})||e.includes("*"):!0}var J=function(t,n,o){o===void 0&&(o=!1);var i=n.alt,y=n.meta,a=n.mod,v=n.shift,h=n.ctrl,s=n.keys,k=t.key,r=t.code,E=t.ctrlKey,g=t.metaKey,p=t.shiftKey,C=t.altKey,b=c(r),l=k.toLowerCase();if(!o){if(i===!C&&l!=="alt"||v===!p&&l!=="shift")return!1;if(a){if(!g&&!E)return!1}else if(y===!g&&l!=="meta"&&l!=="os"||h===!E&&l!=="ctrl"&&l!=="control")return!1}return s&&s.length===1&&(s.includes(l)||s.includes(b))?!0:s?F(s):!s},Q=f.createContext(void 0),T=function(){return f.useContext(Q)};function D(e,t){return e&&t&&typeof e=="object"&&typeof t=="object"?Object.keys(e).length===Object.keys(t).length&&Object.keys(e).reduce(function(n,o){return n&&D(e[o],t[o])},!0):e===t}var U=f.createContext({hotkeys:[],enabledScopes:[],toggleScope:function(){},enableScope:function(){},disableScope:function(){}}),V=function(){return f.useContext(U)};function X(e){var t=f.useRef(void 0);return D(t.current,e)||(t.current=e),t.current}var j=function(t){t.stopPropagation(),t.preventDefault(),t.stopImmediatePropagation()},Y=typeof window<"u"?f.useLayoutEffect:f.useEffect;function ee(e,t,n,o){var i=f.useRef(null),y=f.useRef(!1),a=n instanceof Array?o instanceof Array?void 0:o:n,v=S(e)?e.join(a==null?void 0:a.splitKey):e,h=n instanceof Array?n:o instanceof Array?o:void 0,s=f.useCallback(t,h??[]),k=f.useRef(s);h?k.current=s:k.current=t;var r=X(a),E=V(),g=E.enabledScopes,p=T();return Y(function(){if(!((r==null?void 0:r.enabled)===!1||!G(g,r==null?void 0:r.scopes))){var C=function(u,K){var R;if(K===void 0&&(K=!1),!(z(u)&&!M(u,r==null?void 0:r.enableOnFormTags))&&!(r!=null&&r.ignoreEventWhen!=null&&r.ignoreEventWhen(u))){if(i.current!==null&&document.activeElement!==i.current&&!i.current.contains(document.activeElement)){j(u);return}(R=u.target)!=null&&R.isContentEditable&&!(r!=null&&r.enableOnContentEditable)||H(v,r==null?void 0:r.splitKey).forEach(function(I){var x,w=A(I,r==null?void 0:r.combinationKey);if(J(u,w,r==null?void 0:r.ignoreModifiers)||(x=w.keys)!=null&&x.includes("*")){if(K&&y.current)return;if(W(u,w,r==null?void 0:r.preventDefault),!$(u,w,r==null?void 0:r.enabled)){j(u);return}k.current(u,w),K||(y.current=!0)}})}},b=function(u){u.key!==void 0&&(O(c(u.code)),((r==null?void 0:r.keydown)===void 0&&(r==null?void 0:r.keyup)!==!0||r!=null&&r.keydown)&&C(u))},l=function(u){u.key!==void 0&&(_(c(u.code)),y.current=!1,r!=null&&r.keyup&&C(u,!0))},L=i.current||(a==null?void 0:a.document)||document;return L.addEventListener("keyup",l),L.addEventListener("keydown",b),p&&H(v,r==null?void 0:r.splitKey).forEach(function(m){return p.addHotkey(A(m,r==null?void 0:r.combinationKey,r==null?void 0:r.description))}),function(){L.removeEventListener("keyup",l),L.removeEventListener("keydown",b),p&&H(v,r==null?void 0:r.splitKey).forEach(function(m){return p.removeHotkey(A(m,r==null?void 0:r.combinationKey,r==null?void 0:r.description))})}}},[v,r,g]),i}export{ee as u};
