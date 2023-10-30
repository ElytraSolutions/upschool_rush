import{h as M,a as R,j as I,_ as P}from"./@babel-029bab3e.js";import{a as c,r as d}from"./react-cae9b7b8.js";import{R as T}from"./react-dom-80dba45a.js";const D={disabled:!1},b=c.createContext(null);var U=function(a){return a.scrollTop},g="unmounted",h="exited",E="entering",x="entered",S="exiting",f=function(s){M(a,s);function a(r,e){var t;t=s.call(this,r,e)||this;var n=e,i=n&&!n.isMounting?r.enter:r.appear,u;return t.appearStatus=null,r.in?i?(u=h,t.appearStatus=E):u=x:r.unmountOnExit||r.mountOnEnter?u=g:u=h,t.state={status:u},t.nextCallback=null,t}a.getDerivedStateFromProps=function(e,t){var n=e.in;return n&&t.status===g?{status:h}:null};var o=a.prototype;return o.componentDidMount=function(){this.updateStatus(!0,this.appearStatus)},o.componentDidUpdate=function(e){var t=null;if(e!==this.props){var n=this.state.status;this.props.in?n!==E&&n!==x&&(t=E):(n===E||n===x)&&(t=S)}this.updateStatus(!1,t)},o.componentWillUnmount=function(){this.cancelNextCallback()},o.getTimeouts=function(){var e=this.props.timeout,t,n,i;return t=n=i=e,e!=null&&typeof e!="number"&&(t=e.exit,n=e.enter,i=e.appear!==void 0?e.appear:n),{exit:t,enter:n,appear:i}},o.updateStatus=function(e,t){if(e===void 0&&(e=!1),t!==null)if(this.cancelNextCallback(),t===E){if(this.props.unmountOnExit||this.props.mountOnEnter){var n=this.props.nodeRef?this.props.nodeRef.current:T.findDOMNode(this);n&&U(n)}this.performEnter(e)}else this.performExit();else this.props.unmountOnExit&&this.state.status===h&&this.setState({status:g})},o.performEnter=function(e){var t=this,n=this.props.enter,i=this.context?this.context.isMounting:e,u=this.props.nodeRef?[i]:[T.findDOMNode(this),i],l=u[0],p=u[1],O=this.getTimeouts(),k=i?O.appear:O.enter;if(!e&&!n||D.disabled){this.safeSetState({status:x},function(){t.props.onEntered(l)});return}this.props.onEnter(l,p),this.safeSetState({status:E},function(){t.props.onEntering(l,p),t.onTransitionEnd(k,function(){t.safeSetState({status:x},function(){t.props.onEntered(l,p)})})})},o.performExit=function(){var e=this,t=this.props.exit,n=this.getTimeouts(),i=this.props.nodeRef?void 0:T.findDOMNode(this);if(!t||D.disabled){this.safeSetState({status:h},function(){e.props.onExited(i)});return}this.props.onExit(i),this.safeSetState({status:S},function(){e.props.onExiting(i),e.onTransitionEnd(n.exit,function(){e.safeSetState({status:h},function(){e.props.onExited(i)})})})},o.cancelNextCallback=function(){this.nextCallback!==null&&(this.nextCallback.cancel(),this.nextCallback=null)},o.safeSetState=function(e,t){t=this.setNextCallback(t),this.setState(e,t)},o.setNextCallback=function(e){var t=this,n=!0;return this.nextCallback=function(i){n&&(n=!1,t.nextCallback=null,e(i))},this.nextCallback.cancel=function(){n=!1},this.nextCallback},o.onTransitionEnd=function(e,t){this.setNextCallback(t);var n=this.props.nodeRef?this.props.nodeRef.current:T.findDOMNode(this),i=e==null&&!this.props.addEndListener;if(!n||i){setTimeout(this.nextCallback,0);return}if(this.props.addEndListener){var u=this.props.nodeRef?[this.nextCallback]:[n,this.nextCallback],l=u[0],p=u[1];this.props.addEndListener(l,p)}e!=null&&setTimeout(this.nextCallback,e)},o.render=function(){var e=this.state.status;if(e===g)return null;var t=this.props,n=t.children;t.in,t.mountOnEnter,t.unmountOnExit,t.appear,t.enter,t.exit,t.timeout,t.addEndListener,t.onEnter,t.onEntering,t.onEntered,t.onExit,t.onExiting,t.onExited,t.nodeRef;var i=R(t,["children","in","mountOnEnter","unmountOnExit","appear","enter","exit","timeout","addEndListener","onEnter","onEntering","onEntered","onExit","onExiting","onExited","nodeRef"]);return c.createElement(b.Provider,{value:null},typeof n=="function"?n(e,i):c.cloneElement(c.Children.only(n),i))},a}(c.Component);f.contextType=b;f.propTypes={};function v(){}f.defaultProps={in:!1,mountOnEnter:!1,unmountOnExit:!1,appear:!1,enter:!0,exit:!0,onEnter:v,onEntering:v,onEntered:v,onExit:v,onExiting:v,onExited:v};f.UNMOUNTED=g;f.EXITED=h;f.ENTERING=E;f.ENTERED=x;f.EXITING=S;const X=f;function C(s,a){var o=function(t){return a&&d.isValidElement(t)?a(t):t},r=Object.create(null);return s&&d.Children.map(s,function(e){return e}).forEach(function(e){r[e.key]=o(e)}),r}function _(s,a){s=s||{},a=a||{};function o(p){return p in a?a[p]:s[p]}var r=Object.create(null),e=[];for(var t in s)t in a?e.length&&(r[t]=e,e=[]):e.push(t);var n,i={};for(var u in a){if(r[u])for(n=0;n<r[u].length;n++){var l=r[u][n];i[r[u][n]]=o(l)}i[u]=o(u)}for(n=0;n<e.length;n++)i[e[n]]=o(e[n]);return i}function m(s,a,o){return o[a]!=null?o[a]:s.props[a]}function y(s,a){return C(s.children,function(o){return d.cloneElement(o,{onExited:a.bind(null,o),in:!0,appear:m(o,"appear",s),enter:m(o,"enter",s),exit:m(o,"exit",s)})})}function F(s,a,o){var r=C(s.children),e=_(a,r);return Object.keys(e).forEach(function(t){var n=e[t];if(d.isValidElement(n)){var i=t in a,u=t in r,l=a[t],p=d.isValidElement(l)&&!l.props.in;u&&(!i||p)?e[t]=d.cloneElement(n,{onExited:o.bind(null,n),in:!0,exit:m(n,"exit",s),enter:m(n,"enter",s)}):!u&&i&&!p?e[t]=d.cloneElement(n,{in:!1}):u&&i&&d.isValidElement(l)&&(e[t]=d.cloneElement(n,{onExited:o.bind(null,n),in:l.props.in,exit:m(n,"exit",s),enter:m(n,"enter",s)}))}}),e}var G=Object.values||function(s){return Object.keys(s).map(function(a){return s[a]})},L={component:"div",childFactory:function(a){return a}},N=function(s){M(a,s);function a(r,e){var t;t=s.call(this,r,e)||this;var n=t.handleExited.bind(I(t));return t.state={contextValue:{isMounting:!0},handleExited:n,firstRender:!0},t}var o=a.prototype;return o.componentDidMount=function(){this.mounted=!0,this.setState({contextValue:{isMounting:!1}})},o.componentWillUnmount=function(){this.mounted=!1},a.getDerivedStateFromProps=function(e,t){var n=t.children,i=t.handleExited,u=t.firstRender;return{children:u?y(e,i):F(e,n,i),firstRender:!1}},o.handleExited=function(e,t){var n=C(this.props.children);e.key in n||(e.props.onExited&&e.props.onExited(t),this.mounted&&this.setState(function(i){var u=P({},i.children);return delete u[e.key],{children:u}}))},o.render=function(){var e=this.props,t=e.component,n=e.childFactory,i=R(e,["component","childFactory"]),u=this.state.contextValue,l=G(this.state.children).map(n);return delete i.appear,delete i.enter,delete i.exit,t===null?c.createElement(b.Provider,{value:u},l):c.createElement(b.Provider,{value:u},c.createElement(t,i,l))},a}(c.Component);N.propTypes={};N.defaultProps=L;const w=N;export{w as T,X as a};