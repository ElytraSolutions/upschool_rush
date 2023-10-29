import{d as ae}from"./deepmerge-15f827de.js";import{i as Fe,t as Re,c as ge,a as Ke}from"./lodash-es-062508fc.js";import{r as f}from"./react-cae9b7b8.js";import{i as U}from"./react-fast-compare-d29c9f72.js";import{w as Ce}from"./tiny-warning-c932d744.js";import{h as Ye}from"./hoist-non-react-statics-d2e87333.js";function E(){return E=Object.assign||function(r){for(var t=1;t<arguments.length;t++){var u=arguments[t];for(var a in u)Object.prototype.hasOwnProperty.call(u,a)&&(r[a]=u[a])}return r},E.apply(this,arguments)}function ke(r,t){r.prototype=Object.create(t.prototype),r.prototype.constructor=r,r.__proto__=t}function N(r,t){if(r==null)return{};var u={},a=Object.keys(r),e,i;for(i=0;i<a.length;i++)e=a[i],!(t.indexOf(e)>=0)&&(u[e]=r[e]);return u}function Ae(r){if(r===void 0)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return r}var Y=f.createContext(void 0);Y.displayName="FormikContext";var qe=Y.Provider,Je=Y.Consumer;function _e(){var r=f.useContext(Y);return r||Ce(!1),r}var be=function(t){return Array.isArray(t)&&t.length===0},b=function(t){return typeof t=="function"},W=function(t){return t!==null&&typeof t=="object"},Qe=function(t){return String(Math.floor(Number(t)))===t},ne=function(t){return Object.prototype.toString.call(t)==="[object String]"},Me=function(t){return f.Children.count(t)===0},te=function(t){return W(t)&&b(t.then)};function F(r,t,u,a){a===void 0&&(a=0);for(var e=Re(t);r&&a<e.length;)r=r[e[a++]];return a!==e.length&&!r||r===void 0?u:r}function L(r,t,u){for(var a=ge(r),e=a,i=0,o=Re(t);i<o.length-1;i++){var l=o[i],m=F(r,o.slice(0,i+1));if(m&&(W(m)||Array.isArray(m)))e=e[l]=ge(m);else{var h=o[i+1];e=e[l]=Qe(h)&&Number(h)>=0?[]:{}}}return(i===0?r:e)[o[i]]===u?r:(u===void 0?delete e[o[i]]:e[o[i]]=u,i===0&&u===void 0&&delete a[o[i]],a)}function Ve(r,t,u,a){u===void 0&&(u=new WeakMap),a===void 0&&(a={});for(var e=0,i=Object.keys(r);e<i.length;e++){var o=i[e],l=r[o];W(l)?u.get(l)||(u.set(l,!0),a[o]=Array.isArray(l)?[]:{},Ve(l,t,u,a[o])):a[o]=t}return a}function Xe(r,t){switch(t.type){case"SET_VALUES":return E({},r,{values:t.payload});case"SET_TOUCHED":return E({},r,{touched:t.payload});case"SET_ERRORS":return U(r.errors,t.payload)?r:E({},r,{errors:t.payload});case"SET_STATUS":return E({},r,{status:t.payload});case"SET_ISSUBMITTING":return E({},r,{isSubmitting:t.payload});case"SET_ISVALIDATING":return E({},r,{isValidating:t.payload});case"SET_FIELD_VALUE":return E({},r,{values:L(r.values,t.payload.field,t.payload.value)});case"SET_FIELD_TOUCHED":return E({},r,{touched:L(r.touched,t.payload.field,t.payload.value)});case"SET_FIELD_ERROR":return E({},r,{errors:L(r.errors,t.payload.field,t.payload.value)});case"RESET_FORM":return E({},r,t.payload);case"SET_FORMIK_STATE":return t.payload(r);case"SUBMIT_ATTEMPT":return E({},r,{touched:Ve(r.values,!0),isSubmitting:!0,submitCount:r.submitCount+1});case"SUBMIT_FAILURE":return E({},r,{isSubmitting:!1});case"SUBMIT_SUCCESS":return E({},r,{isSubmitting:!1});default:return r}}var B={},K={};function Ze(r){var t=r.validateOnChange,u=t===void 0?!0:t,a=r.validateOnBlur,e=a===void 0?!0:a,i=r.validateOnMount,o=i===void 0?!1:i,l=r.isInitialValid,m=r.enableReinitialize,h=m===void 0?!1:m,V=r.onSubmit,g=N(r,["validateOnChange","validateOnBlur","validateOnMount","isInitialValid","enableReinitialize","onSubmit"]),c=E({validateOnChange:u,validateOnBlur:e,validateOnMount:o,onSubmit:V},g),I=f.useRef(c.initialValues),k=f.useRef(c.initialErrors||B),C=f.useRef(c.initialTouched||K),_=f.useRef(c.initialStatus),R=f.useRef(!1),w=f.useRef({});f.useEffect(function(){return R.current=!0,function(){R.current=!1}},[]);var q=f.useState(0),Oe=q[1],$=f.useRef({values:c.initialValues,errors:c.initialErrors||B,touched:c.initialTouched||K,status:c.initialStatus,isSubmitting:!1,isValidating:!1,submitCount:0}),T=$.current,S=f.useCallback(function(n){var s=$.current;$.current=Xe(s,n),s!==$.current&&Oe(function(d){return d+1})},[]),oe=f.useCallback(function(n,s){return new Promise(function(d,v){var p=c.validate(n,s);p==null?d(B):te(p)?p.then(function(y){d(y||B)},function(y){v(y)}):d(p)})},[c.validate]),J=f.useCallback(function(n,s){var d=c.validationSchema,v=b(d)?d(s):d,p=s&&v.validateAt?v.validateAt(s,n):er(n,v);return new Promise(function(y,A){p.then(function(){y(B)},function(D){D.name==="ValidationError"?y(xe(D)):A(D)})})},[c.validationSchema]),le=f.useCallback(function(n,s){return new Promise(function(d){return d(w.current[n].validate(s))})},[]),se=f.useCallback(function(n){var s=Object.keys(w.current).filter(function(v){return b(w.current[v].validate)}),d=s.length>0?s.map(function(v){return le(v,F(n,v))}):[Promise.resolve("DO_NOT_DELETE_YOU_WILL_BE_FIRED")];return Promise.all(d).then(function(v){return v.reduce(function(p,y,A){return y==="DO_NOT_DELETE_YOU_WILL_BE_FIRED"||y&&(p=L(p,s[A],y)),p},{})})},[le]),we=f.useCallback(function(n){return Promise.all([se(n),c.validationSchema?J(n):{},c.validate?oe(n):{}]).then(function(s){var d=s[0],v=s[1],p=s[2],y=ae.all([d,v,p],{arrayMerge:rr});return y})},[c.validate,c.validationSchema,se,oe,J]),O=M(function(n){return n===void 0&&(n=T.values),S({type:"SET_ISVALIDATING",payload:!0}),we(n).then(function(s){return R.current&&(S({type:"SET_ISVALIDATING",payload:!1}),S({type:"SET_ERRORS",payload:s})),s})});f.useEffect(function(){o&&R.current===!0&&U(I.current,c.initialValues)&&O(I.current)},[o,O]);var G=f.useCallback(function(n){var s=n&&n.values?n.values:I.current,d=n&&n.errors?n.errors:k.current?k.current:c.initialErrors||{},v=n&&n.touched?n.touched:C.current?C.current:c.initialTouched||{},p=n&&n.status?n.status:_.current?_.current:c.initialStatus;I.current=s,k.current=d,C.current=v,_.current=p;var y=function(){S({type:"RESET_FORM",payload:{isSubmitting:!!n&&!!n.isSubmitting,errors:d,touched:v,status:p,values:s,isValidating:!!n&&!!n.isValidating,submitCount:n&&n.submitCount&&typeof n.submitCount=="number"?n.submitCount:0}})};if(c.onReset){var A=c.onReset(T.values,Se);te(A)?A.then(y):y()}else y()},[c.initialErrors,c.initialStatus,c.initialTouched]);f.useEffect(function(){R.current===!0&&!U(I.current,c.initialValues)&&h&&(I.current=c.initialValues,G(),o&&O(I.current))},[h,c.initialValues,G,o,O]),f.useEffect(function(){h&&R.current===!0&&!U(k.current,c.initialErrors)&&(k.current=c.initialErrors||B,S({type:"SET_ERRORS",payload:c.initialErrors||B}))},[h,c.initialErrors]),f.useEffect(function(){h&&R.current===!0&&!U(C.current,c.initialTouched)&&(C.current=c.initialTouched||K,S({type:"SET_TOUCHED",payload:c.initialTouched||K}))},[h,c.initialTouched]),f.useEffect(function(){h&&R.current===!0&&!U(_.current,c.initialStatus)&&(_.current=c.initialStatus,S({type:"SET_STATUS",payload:c.initialStatus}))},[h,c.initialStatus,c.initialTouched]);var ce=M(function(n){if(w.current[n]&&b(w.current[n].validate)){var s=F(T.values,n),d=w.current[n].validate(s);return te(d)?(S({type:"SET_ISVALIDATING",payload:!0}),d.then(function(v){return v}).then(function(v){S({type:"SET_FIELD_ERROR",payload:{field:n,value:v}}),S({type:"SET_ISVALIDATING",payload:!1})})):(S({type:"SET_FIELD_ERROR",payload:{field:n,value:d}}),Promise.resolve(d))}else if(c.validationSchema)return S({type:"SET_ISVALIDATING",payload:!0}),J(T.values,n).then(function(v){return v}).then(function(v){S({type:"SET_FIELD_ERROR",payload:{field:n,value:F(v,n)}}),S({type:"SET_ISVALIDATING",payload:!1})});return Promise.resolve()}),Le=f.useCallback(function(n,s){var d=s.validate;w.current[n]={validate:d}},[]),De=f.useCallback(function(n){delete w.current[n]},[]),fe=M(function(n,s){S({type:"SET_TOUCHED",payload:n});var d=s===void 0?e:s;return d?O(T.values):Promise.resolve()}),de=f.useCallback(function(n){S({type:"SET_ERRORS",payload:n})},[]),ve=M(function(n,s){var d=b(n)?n(T.values):n;S({type:"SET_VALUES",payload:d});var v=s===void 0?u:s;return v?O(d):Promise.resolve()}),z=f.useCallback(function(n,s){S({type:"SET_FIELD_ERROR",payload:{field:n,value:s}})},[]),H=M(function(n,s,d){S({type:"SET_FIELD_VALUE",payload:{field:n,value:s}});var v=d===void 0?u:d;return v?O(L(T.values,n,s)):Promise.resolve()}),pe=f.useCallback(function(n,s){var d=s,v=n,p;if(!ne(n)){n.persist&&n.persist();var y=n.target?n.target:n.currentTarget,A=y.type,D=y.name,ee=y.id,re=y.value,$e=y.checked,dr=y.outerHTML,Te=y.options,ze=y.multiple;d=s||D||ee,v=/number|range/.test(A)?(p=parseFloat(re),isNaN(p)?"":p):/checkbox/.test(A)?tr(F(T.values,d),$e,re):Te&&ze?nr(Te):re}d&&H(d,v)},[H,T.values]),Q=M(function(n){if(ne(n))return function(s){return pe(s,n)};pe(n)}),j=M(function(n,s,d){s===void 0&&(s=!0),S({type:"SET_FIELD_TOUCHED",payload:{field:n,value:s}});var v=d===void 0?e:d;return v?O(T.values):Promise.resolve()}),he=f.useCallback(function(n,s){n.persist&&n.persist();var d=n.target,v=d.name,p=d.id,y=d.outerHTML,A=s||v||p;j(A,!0)},[j]),X=M(function(n){if(ne(n))return function(s){return he(s,n)};he(n)}),me=f.useCallback(function(n){b(n)?S({type:"SET_FORMIK_STATE",payload:n}):S({type:"SET_FORMIK_STATE",payload:function(){return n}})},[]),ye=f.useCallback(function(n){S({type:"SET_STATUS",payload:n})},[]),Ee=f.useCallback(function(n){S({type:"SET_ISSUBMITTING",payload:n})},[]),Z=M(function(){return S({type:"SUBMIT_ATTEMPT"}),O().then(function(n){var s=n instanceof Error,d=!s&&Object.keys(n).length===0;if(d){var v;try{if(v=Ne(),v===void 0)return}catch(p){throw p}return Promise.resolve(v).then(function(p){return R.current&&S({type:"SUBMIT_SUCCESS"}),p}).catch(function(p){if(R.current)throw S({type:"SUBMIT_FAILURE"}),p})}else if(R.current&&(S({type:"SUBMIT_FAILURE"}),s))throw n})}),Ue=M(function(n){n&&n.preventDefault&&b(n.preventDefault)&&n.preventDefault(),n&&n.stopPropagation&&b(n.stopPropagation)&&n.stopPropagation(),Z().catch(function(s){console.warn("Warning: An unhandled error was caught from submitForm()",s)})}),Se={resetForm:G,validateForm:O,validateField:ce,setErrors:de,setFieldError:z,setFieldTouched:j,setFieldValue:H,setStatus:ye,setSubmitting:Ee,setTouched:fe,setValues:ve,setFormikState:me,submitForm:Z},Ne=M(function(){return V(T.values,Se)}),Be=M(function(n){n&&n.preventDefault&&b(n.preventDefault)&&n.preventDefault(),n&&n.stopPropagation&&b(n.stopPropagation)&&n.stopPropagation(),G()}),Pe=f.useCallback(function(n){return{value:F(T.values,n),error:F(T.errors,n),touched:!!F(T.touched,n),initialValue:F(I.current,n),initialTouched:!!F(C.current,n),initialError:F(k.current,n)}},[T.errors,T.touched,T.values]),He=f.useCallback(function(n){return{setValue:function(d,v){return H(n,d,v)},setTouched:function(d,v){return j(n,d,v)},setError:function(d){return z(n,d)}}},[H,j,z]),je=f.useCallback(function(n){var s=W(n),d=s?n.name:n,v=F(T.values,d),p={name:d,value:v,onChange:Q,onBlur:X};if(s){var y=n.type,A=n.value,D=n.as,ee=n.multiple;y==="checkbox"?A===void 0?p.checked=!!v:(p.checked=!!(Array.isArray(v)&&~v.indexOf(A)),p.value=A):y==="radio"?(p.checked=v===A,p.value=A):D==="select"&&ee&&(p.value=p.value||[],p.multiple=!0)}return p},[X,Q,T.values]),x=f.useMemo(function(){return!U(I.current,T.values)},[I.current,T.values]),Ge=f.useMemo(function(){return typeof l<"u"?x?T.errors&&Object.keys(T.errors).length===0:l!==!1&&b(l)?l(c):l:T.errors&&Object.keys(T.errors).length===0},[l,x,T.errors,c]),We=E({},T,{initialValues:I.current,initialErrors:k.current,initialTouched:C.current,initialStatus:_.current,handleBlur:X,handleChange:Q,handleReset:Be,handleSubmit:Ue,resetForm:G,setErrors:de,setFormikState:me,setFieldTouched:j,setFieldValue:H,setFieldError:z,setStatus:ye,setSubmitting:Ee,setTouched:fe,setValues:ve,submitForm:Z,validateForm:O,validateField:ce,isValid:Ge,dirty:x,unregisterField:De,registerField:Le,getFieldProps:je,getFieldMeta:Pe,getFieldHelpers:He,validateOnBlur:e,validateOnChange:u,validateOnMount:o});return We}function Sr(r){var t=Ze(r),u=r.component,a=r.children,e=r.render,i=r.innerRef;return f.useImperativeHandle(i,function(){return t}),f.createElement(qe,{value:t},u?f.createElement(u,t):e?e(t):a?b(a)?a(t):Me(a)?null:f.Children.only(a):null)}function xe(r){var t={};if(r.inner){if(r.inner.length===0)return L(t,r.path,r.message);for(var e=r.inner,u=Array.isArray(e),a=0,e=u?e:e[Symbol.iterator]();;){var i;if(u){if(a>=e.length)break;i=e[a++]}else{if(a=e.next(),a.done)break;i=a.value}var o=i;F(t,o.path)||(t=L(t,o.path,o.message))}}return t}function er(r,t,u,a){u===void 0&&(u=!1);var e=ue(r);return t[u?"validateSync":"validate"](e,{abortEarly:!1,context:a||e})}function ue(r){var t=Array.isArray(r)?[]:{};for(var u in r)if(Object.prototype.hasOwnProperty.call(r,u)){var a=String(u);Array.isArray(r[a])===!0?t[a]=r[a].map(function(e){return Array.isArray(e)===!0||Fe(e)?ue(e):e!==""?e:void 0}):Fe(r[a])?t[a]=ue(r[a]):t[a]=r[a]!==""?r[a]:void 0}return t}function rr(r,t,u){var a=r.slice();return t.forEach(function(i,o){if(typeof a[o]>"u"){var l=u.clone!==!1,m=l&&u.isMergeableObject(i);a[o]=m?ae(Array.isArray(i)?[]:{},i,u):i}else u.isMergeableObject(i)?a[o]=ae(r[o],i,u):r.indexOf(i)===-1&&a.push(i)}),a}function nr(r){return Array.from(r).filter(function(t){return t.selected}).map(function(t){return t.value})}function tr(r,t,u){if(typeof r=="boolean")return!!t;var a=[],e=!1,i=-1;if(Array.isArray(r))a=r,i=r.indexOf(u),e=i>=0;else if(!u||u=="true"||u=="false")return!!t;return t&&u&&!e?a.concat(u):e?a.slice(0,i).concat(a.slice(i+1)):a}var ir=typeof window<"u"&&typeof window.document<"u"&&typeof window.document.createElement<"u"?f.useLayoutEffect:f.useEffect;function M(r){var t=f.useRef(r);return ir(function(){t.current=r}),f.useCallback(function(){for(var u=arguments.length,a=new Array(u),e=0;e<u;e++)a[e]=arguments[e];return t.current.apply(void 0,a)},[])}function Tr(r){var t=r.validate,u=r.name,a=r.render,e=r.children,i=r.as,o=r.component,l=N(r,["validate","name","render","children","as","component"]),m=_e(),h=N(m,["validate","validationSchema"]),V=h.registerField,g=h.unregisterField;f.useEffect(function(){return V(u,{validate:t}),function(){g(u)}},[V,g,u,t]);var c=h.getFieldProps(E({name:u},l)),I=h.getFieldMeta(u),k={field:c,form:h};if(a)return a(E({},k,{meta:I}));if(b(e))return e(E({},k,{meta:I}));if(o){if(typeof o=="string"){var C=l.innerRef,_=N(l,["innerRef"]);return f.createElement(o,E({ref:C},c,_),e)}return f.createElement(o,E({field:c,form:h},l),e)}var R=i||"input";if(typeof R=="string"){var w=l.innerRef,q=N(l,["innerRef"]);return f.createElement(R,E({ref:w},c,q),e)}return f.createElement(R,E({},c,l),e)}var ar=f.forwardRef(function(r,t){var u=r.action,a=N(r,["action"]),e=u??"#",i=_e(),o=i.handleReset,l=i.handleSubmit;return f.createElement("form",E({onSubmit:l,ref:t,onReset:o,action:e},a))});ar.displayName="Form";function ur(r){var t=function(e){return f.createElement(Je,null,function(i){return i||Ce(!1),f.createElement(r,E({},e,{formik:i}))})},u=r.displayName||r.name||r.constructor&&r.constructor.name||"Component";return t.WrappedComponent=r,t.displayName="FormikConnect("+u+")",Ye(t,r)}var or=function(t,u,a){var e=P(t),i=e[u];return e.splice(u,1),e.splice(a,0,i),e},lr=function(t,u,a){var e=P(t),i=e[u];return e[u]=e[a],e[a]=i,e},ie=function(t,u,a){var e=P(t);return e.splice(u,0,a),e},sr=function(t,u,a){var e=P(t);return e[u]=a,e},P=function(t){if(t){if(Array.isArray(t))return[].concat(t);var u=Object.keys(t).map(function(a){return parseInt(a)}).reduce(function(a,e){return e>a?e:a},0);return Array.from(E({},t,{length:u+1}))}else return[]},Ie=function(t,u){var a=typeof t=="function"?t:u;return function(e){if(Array.isArray(e)||W(e)){var i=P(e);return a(i)}return e}},cr=function(r){ke(t,r);function t(a){var e;return e=r.call(this,a)||this,e.updateArrayField=function(i,o,l){var m=e.props,h=m.name,V=m.formik.setFormikState;V(function(g){var c=Ie(l,i),I=Ie(o,i),k=L(g.values,h,i(F(g.values,h))),C=l?c(F(g.errors,h)):void 0,_=o?I(F(g.touched,h)):void 0;return be(C)&&(C=void 0),be(_)&&(_=void 0),E({},g,{values:k,errors:l?L(g.errors,h,C):g.errors,touched:o?L(g.touched,h,_):g.touched})})},e.push=function(i){return e.updateArrayField(function(o){return[].concat(P(o),[Ke(i)])},!1,!1)},e.handlePush=function(i){return function(){return e.push(i)}},e.swap=function(i,o){return e.updateArrayField(function(l){return lr(l,i,o)},!0,!0)},e.handleSwap=function(i,o){return function(){return e.swap(i,o)}},e.move=function(i,o){return e.updateArrayField(function(l){return or(l,i,o)},!0,!0)},e.handleMove=function(i,o){return function(){return e.move(i,o)}},e.insert=function(i,o){return e.updateArrayField(function(l){return ie(l,i,o)},function(l){return ie(l,i,null)},function(l){return ie(l,i,null)})},e.handleInsert=function(i,o){return function(){return e.insert(i,o)}},e.replace=function(i,o){return e.updateArrayField(function(l){return sr(l,i,o)},!1,!1)},e.handleReplace=function(i,o){return function(){return e.replace(i,o)}},e.unshift=function(i){var o=-1;return e.updateArrayField(function(l){var m=l?[i].concat(l):[i];return o=m.length,m},function(l){return l?[null].concat(l):[null]},function(l){return l?[null].concat(l):[null]}),o},e.handleUnshift=function(i){return function(){return e.unshift(i)}},e.handleRemove=function(i){return function(){return e.remove(i)}},e.handlePop=function(){return function(){return e.pop()}},e.remove=e.remove.bind(Ae(e)),e.pop=e.pop.bind(Ae(e)),e}var u=t.prototype;return u.componentDidUpdate=function(e){this.props.validateOnChange&&this.props.formik.validateOnChange&&!U(F(e.formik.values,e.name),F(this.props.formik.values,this.props.name))&&this.props.formik.validateForm(this.props.formik.values)},u.remove=function(e){var i;return this.updateArrayField(function(o){var l=o?P(o):[];return i||(i=l[e]),b(l.splice)&&l.splice(e,1),b(l.every)&&l.every(function(m){return m===void 0})?[]:l},!0,!0),i},u.pop=function(){var e;return this.updateArrayField(function(i){var o=i.slice();return e||(e=o&&o.pop&&o.pop()),o},!0,!0),e},u.render=function(){var e={push:this.push,pop:this.pop,swap:this.swap,move:this.move,insert:this.insert,replace:this.replace,unshift:this.unshift,remove:this.remove,handlePush:this.handlePush,handlePop:this.handlePop,handleSwap:this.handleSwap,handleMove:this.handleMove,handleInsert:this.handleInsert,handleReplace:this.handleReplace,handleUnshift:this.handleUnshift,handleRemove:this.handleRemove},i=this.props,o=i.component,l=i.render,m=i.children,h=i.name,V=i.formik,g=N(V,["validate","validationSchema"]),c=E({},e,{form:g,name:h});return o?f.createElement(o,c):l?l(c):m?typeof m=="function"?m(c):Me(m)?null:f.Children.only(m):null},t}(f.Component);cr.defaultProps={validateOnChange:!0};var fr=function(r){ke(t,r);function t(){return r.apply(this,arguments)||this}var u=t.prototype;return u.shouldComponentUpdate=function(e){return F(this.props.formik.errors,this.props.name)!==F(e.formik.errors,this.props.name)||F(this.props.formik.touched,this.props.name)!==F(e.formik.touched,this.props.name)||Object.keys(this.props).length!==Object.keys(e).length},u.render=function(){var e=this.props,i=e.component,o=e.formik,l=e.render,m=e.children,h=e.name,V=N(e,["component","formik","render","children","name"]),g=F(o.touched,h),c=F(o.errors,h);return g&&c?l?b(l)?l(c):null:m?b(m)?m(c):null:i?f.createElement(i,V,c):c:null},t}(f.Component),Fr=ur(fr);export{Fr as E,Sr as F,Tr as a};
