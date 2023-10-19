import{d as E}from"./@babel-029bab3e.js";import{r as x}from"./react-cae9b7b8.js";import{p as N}from"./prop-types-a9b871a2.js";var T={},d={},g;function j(){return g||(g=1,function(c){(function(p,s){s(c,x,N)})(E,function(p,s,w){Object.defineProperty(p,"__esModule",{value:!0}),p.setHasSupportToCaptureOption=m;var h=S(s),a=S(w);function S(t){return t&&t.__esModule?t:{default:t}}var b=Object.assign||function(t){for(var n=1;n<arguments.length;n++){var i=arguments[n];for(var e in i)Object.prototype.hasOwnProperty.call(i,e)&&(t[e]=i[e])}return t};function R(t,n){var i={};for(var e in t)n.indexOf(e)>=0||Object.prototype.hasOwnProperty.call(t,e)&&(i[e]=t[e]);return i}function D(t,n){if(!(t instanceof n))throw new TypeError("Cannot call a class as a function")}var O=function(){function t(n,i){for(var e=0;e<i.length;e++){var r=i[e];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(n,r.key,r)}}return function(n,i,e){return i&&t(n.prototype,i),e&&t(n,e),n}}();function P(t,n){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return n&&(typeof n=="object"||typeof n=="function")?n:t}function U(t,n){if(typeof n!="function"&&n!==null)throw new TypeError("Super expression must either be null or a function, not "+typeof n);t.prototype=Object.create(n&&n.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),n&&(Object.setPrototypeOf?Object.setPrototypeOf(t,n):t.__proto__=n)}var v=!1;function m(t){v=t}try{addEventListener("test",null,Object.defineProperty({},"capture",{get:function(){m(!0)}}))}catch{}function _(){var t=arguments.length>0&&arguments[0]!==void 0?arguments[0]:{capture:!0};return v?t:t.capture}function M(t){if("touches"in t){var n=t.touches[0],i=n.pageX,e=n.pageY;return{x:i,y:e}}var r=t.screenX,u=t.screenY;return{x:r,y:u}}var f=function(t){U(n,t);function n(){var i;D(this,n);for(var e=arguments.length,r=Array(e),u=0;u<e;u++)r[u]=arguments[u];var o=P(this,(i=n.__proto__||Object.getPrototypeOf(n)).call.apply(i,[this].concat(r)));return o._handleSwipeStart=o._handleSwipeStart.bind(o),o._handleSwipeMove=o._handleSwipeMove.bind(o),o._handleSwipeEnd=o._handleSwipeEnd.bind(o),o._onMouseDown=o._onMouseDown.bind(o),o._onMouseMove=o._onMouseMove.bind(o),o._onMouseUp=o._onMouseUp.bind(o),o._setSwiperRef=o._setSwiperRef.bind(o),o}return O(n,[{key:"componentDidMount",value:function(){this.swiper&&this.swiper.addEventListener("touchmove",this._handleSwipeMove,_({capture:!0,passive:!1}))}},{key:"componentWillUnmount",value:function(){this.swiper&&this.swiper.removeEventListener("touchmove",this._handleSwipeMove,_({capture:!0,passive:!1}))}},{key:"_onMouseDown",value:function(e){this.props.allowMouseEvents&&(this.mouseDown=!0,document.addEventListener("mouseup",this._onMouseUp),document.addEventListener("mousemove",this._onMouseMove),this._handleSwipeStart(e))}},{key:"_onMouseMove",value:function(e){this.mouseDown&&this._handleSwipeMove(e)}},{key:"_onMouseUp",value:function(e){this.mouseDown=!1,document.removeEventListener("mouseup",this._onMouseUp),document.removeEventListener("mousemove",this._onMouseMove),this._handleSwipeEnd(e)}},{key:"_handleSwipeStart",value:function(e){var r=M(e),u=r.x,o=r.y;this.moveStart={x:u,y:o},this.props.onSwipeStart(e)}},{key:"_handleSwipeMove",value:function(e){if(this.moveStart){var r=M(e),u=r.x,o=r.y,l=u-this.moveStart.x,y=o-this.moveStart.y;this.moving=!0;var L=this.props.onSwipeMove({x:l,y},e);L&&e.cancelable&&e.preventDefault(),this.movePosition={deltaX:l,deltaY:y}}}},{key:"_handleSwipeEnd",value:function(e){this.props.onSwipeEnd(e);var r=this.props.tolerance;this.moving&&this.movePosition&&(this.movePosition.deltaX<-r?this.props.onSwipeLeft(1,e):this.movePosition.deltaX>r&&this.props.onSwipeRight(1,e),this.movePosition.deltaY<-r?this.props.onSwipeUp(1,e):this.movePosition.deltaY>r&&this.props.onSwipeDown(1,e)),this.moveStart=null,this.moving=!1,this.movePosition=null}},{key:"_setSwiperRef",value:function(e){this.swiper=e,this.props.innerRef(e)}},{key:"render",value:function(){var e=this.props;e.tagName;var r=e.className,u=e.style,o=e.children;e.allowMouseEvents,e.onSwipeUp,e.onSwipeDown,e.onSwipeLeft,e.onSwipeRight,e.onSwipeStart,e.onSwipeMove,e.onSwipeEnd,e.innerRef,e.tolerance;var l=R(e,["tagName","className","style","children","allowMouseEvents","onSwipeUp","onSwipeDown","onSwipeLeft","onSwipeRight","onSwipeStart","onSwipeMove","onSwipeEnd","innerRef","tolerance"]);return h.default.createElement(this.props.tagName,b({ref:this._setSwiperRef,onMouseDown:this._onMouseDown,onTouchStart:this._handleSwipeStart,onTouchEnd:this._handleSwipeEnd,className:r,style:u},l),o)}}]),n}(s.Component);f.displayName="ReactSwipe",f.propTypes={tagName:a.default.string,className:a.default.string,style:a.default.object,children:a.default.node,allowMouseEvents:a.default.bool,onSwipeUp:a.default.func,onSwipeDown:a.default.func,onSwipeLeft:a.default.func,onSwipeRight:a.default.func,onSwipeStart:a.default.func,onSwipeMove:a.default.func,onSwipeEnd:a.default.func,innerRef:a.default.func,tolerance:a.default.number.isRequired},f.defaultProps={tagName:"div",allowMouseEvents:!1,onSwipeUp:function(){},onSwipeDown:function(){},onSwipeLeft:function(){},onSwipeRight:function(){},onSwipeStart:function(){},onSwipeMove:function(){},onSwipeEnd:function(){},innerRef:function(){},tolerance:0},p.default=f})}(d)),d}(function(c){(function(p,s){s(c,j())})(E,function(p,s){Object.defineProperty(p,"__esModule",{value:!0});var w=h(s);function h(a){return a&&a.__esModule?a:{default:a}}p.default=w.default})})(T);export{T as l};
