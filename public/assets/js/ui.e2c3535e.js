(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["ui"],{"0da2":function(e,t,n){"use strict";n("3340")},3340:function(e,t,n){},"38d1":function(e,t,n){"use strict";n.r(t);var i=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("router-view")},a=[],r=n("2877"),s={},l=Object(r["a"])(s,i,a,!1,null,null,null);t["default"]=l.exports},"466d":function(e,t,n){"use strict";var i=n("d784"),a=n("825a"),r=n("50c4"),s=n("1d80"),l=n("8aa5"),o=n("14c3");i("match",1,(function(e,t,n){return[function(t){var n=s(this),i=void 0==t?void 0:t[e];return void 0!==i?i.call(t,n):new RegExp(t)[e](String(n))},function(e){var i=n(t,e,this);if(i.done)return i.value;var s=a(e),c=String(this);if(!s.global)return o(s,c);var u=s.unicode;s.lastIndex=0;var d,f=[],m=0;while(null!==(d=o(s,c))){var p=String(d[0]);f[m]=p,""===p&&(s.lastIndex=l(c,r(s.lastIndex),u)),m++}return 0===m?null:f}]}))},"4d63":function(e,t,n){var i=n("83ab"),a=n("da84"),r=n("94ca"),s=n("7156"),l=n("9bf2").f,o=n("241c").f,c=n("44e7"),u=n("ad6d"),d=n("9f7f"),f=n("6eeb"),m=n("d039"),p=n("69f3").set,v=n("2626"),h=n("b622"),g=h("match"),b=a.RegExp,y=b.prototype,_=/a/g,x=/a/g,w=new b(_)!==_,k=d.UNSUPPORTED_Y,C=i&&r("RegExp",!w||k||m((function(){return x[g]=!1,b(_)!=_||b(x)==x||"/a/i"!=b(_,"i")})));if(C){var j=function(e,t){var n,i=this instanceof j,a=c(e),r=void 0===t;if(!i&&a&&e.constructor===j&&r)return e;w?a&&!r&&(e=e.source):e instanceof j&&(r&&(t=u.call(e)),e=e.source),k&&(n=!!t&&t.indexOf("y")>-1,n&&(t=t.replace(/y/g,"")));var l=s(w?new b(e,t):b(e,t),i?this:y,j);return k&&n&&p(l,{sticky:n}),l},E=function(e){e in j||l(j,e,{configurable:!0,get:function(){return b[e]},set:function(t){b[e]=t}})},S=o(b),O=0;while(S.length>O)E(S[O++]);y.constructor=j,j.prototype=y,f(a,"RegExp",j)}v("RegExp")},"6e1d":function(e,t,n){"use strict";n("a9ec")},7156:function(e,t,n){var i=n("861d"),a=n("d2bb");e.exports=function(e,t,n){var r,s;return a&&"function"==typeof(r=t.constructor)&&r!==n&&i(s=r.prototype)&&s!==n.prototype&&a(e,s),e}},a3f0:function(e,t,n){"use strict";n.r(t);var i=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("div",{style:{display:"flex","justify-content":"center",padding:"5px"}},[e.user.is_technician?e._e():n("submit-job")],1),e._v(" "),n("div",[n("b-row",e._l(e.blogData,(function(t,i){return n("b-colxx",{key:"blogItem_"+i,staticClass:"mb-5",attrs:{xxs:"12",lg:"6"}},[n("b-card",{staticClass:"flex-row listing-card-container",attrs:{"no-body":""}},[n("div",{staticClass:"w-40 position-relative"},[n("v-img",{attrs:{src:t.thumb,width:"480",height:"200",contain:""}})],1),e._v(" "),n("div",{staticClass:"w-60 d-flex align-items-center"},[n("b-card-body",[n("h5",{directives:[{name:"line-clamp",rawName:"v-line-clamp",value:2,expression:"2"}],staticClass:"mb-3 listing-heading"},[e._v("\n                "+e._s(t.title)+"\n              ")]),e._v(" "),n("p",{staticClass:"listing-desc text-muted"},[e._v("\n                "+e._s(t.description)+"\n              ")])])],1)])],1)})),1)],1)])},a=[],r=n("5530"),s=n("2f62"),l=[{title:"Impression 3D",description:"Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration. Collaboratively administrate via plug-and-play networks.",thumb:"/assets/img/details/3D_printer.jpg"},{title:"Fraisage CNC",description:"Credibly reintermediate backend ideas for cross-platform models. Continually reintermediate integrated processes through technically sound intellectual capital.",thumb:"/assets/img/details/CNC_mill.png"},{title:"Gravure laser",description:"Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.",thumb:"/assets/img/details/laser_engraver.jpg"},{title:"Perçage",description:"Quickly deploy strategic networks with compelling e-business. Credibly pontificate highly efficient manufactured products and enabled data.",thumb:"/assets/img/details/drilling_machine.jpg"},{title:"Placeholder",description:"Completely synergize resource taxing relationships via premier niche markets.",thumb:"/assets/img/details/small-1.jpg",type:"image"},{title:"Placeholder",description:"Credibly reintermediate backend ideas for cross-platform models. Continually reintermediate integrated processes through technically sound intellectual capital.",thumb:"/assets/img/details/small-6.jpg",type:"image"},{title:"Placeholder",description:"Dramatically maintain clicks-and-mortar solutions without functional solutions. Completely synergize resource taxing relationships via premier niche markets.",thumb:"/assets/img/details/small-7.jpg",type:"image"},{title:"Placeholder",description:"Dramatically maintain clicks-and-mortar solutions without functional solutions.",thumb:"/assets/img/details/small-8.jpg",type:"image"}],o=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("v-dialog",{attrs:{width:"800",persistent:"","no-click-animation":""},scopedSlots:e._u([{key:"activator",fn:function(t){var i=t.on,a=t.attrs;return[n("v-btn",e._g(e._b({attrs:{color:"green",dark:""},on:{click:e.clearFields}},"v-btn",a,!1),i),[e._v("\n        Nouvelle demande\n      ")])]}}]),model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[e._v(" "),n("v-form",{ref:"form",attrs:{"lazy-validation":""}},[n("v-card",{attrs:{disabled:e.loading}},[n("v-card-title",{staticClass:"headline grey lighten-2"},[n("span",{style:{"word-break":"break-word"}},[e._v("Formulaire de nouvelle demande")])]),e._v(" "),n("v-card-text",[n("v-container",[n("v-row",[n("v-col",[n("v-select",{attrs:{items:e.jobTypes,label:"Type de travail","prepend-icon":e.icons.mdiBriefcaseVariant,required:"",rules:[function(e){return!!e||"Type de travail requis"}]},model:{value:e.selectedJob,callback:function(t){e.selectedJob=t},expression:"selectedJob"}})],1)],1),e._v(" "),n("v-row"),e._v(" "),n("v-row",[n("v-col",[n("v-menu",{attrs:{"close-on-content-click":!1,transition:"scale-transition","offset-y":"","min-width":"auto"},scopedSlots:e._u([{key:"activator",fn:function(t){var i=t.on,a=t.attrs;return[n("v-text-field",e._g(e._b({attrs:{label:"Deadline","prepend-icon":"mdi-calendar",readonly:"",required:"",rules:[function(e){return!!e||"Date limite requise"}]},model:{value:e.deadline,callback:function(t){e.deadline=t},expression:"deadline"}},"v-text-field",a,!1),i))]}}]),model:{value:e.menu,callback:function(t){e.menu=t},expression:"menu"}},[e._v(" "),n("v-date-picker",{attrs:{locale:"fr-FR",min:e.disabledDates.toISOString()},on:{input:function(t){e.menu=!1}},model:{value:e.deadline,callback:function(t){e.deadline=t},expression:"deadline"}})],1)],1)],1),e._v(" "),n("v-row",[n("v-col",[n("drop-zone",{attrs:{multiple:!0},model:{value:e.files,callback:function(t){e.files=t},expression:"files"}})],1)],1),e._v(" "),n("v-row",[n("v-col",[n("v-textarea",{attrs:{label:"Commentaires éventuels","prepend-icon":"mdi-comment","auto-grow":"",rows:"1",clearable:""},model:{value:e.comment,callback:function(t){e.comment=t},expression:"comment"}})],1)],1)],1)],1),e._v(" "),n("v-card-actions",[n("v-spacer"),e._v(" "),n("v-btn",{attrs:{color:"red",text:""},on:{click:function(t){e.dialog=e.loading=!1}}},[e._v("\n            Annuler\n          ")]),e._v(" "),n("v-btn",{attrs:{color:"primary",text:"",loading:e.loading},on:{click:e.validate}},[e._v("\n            Soumettre\n          ")])],1)],1)],1)],1)],1)},c=[],u=(n("d3b7"),n("94ed")),d=n("df65"),f={components:{"drop-zone":d["a"]},data:function(){return{icons:{mdiBriefcaseVariant:u["b"]},selectedJob:null,deadline:null,comment:null,loading:!1,files:[],dialog:!1,menu:!1}},methods:Object(r["a"])(Object(r["a"])({},Object(s["b"])(["storeJob","storeFiles"])),{},{submit:function(){var e=this;this.loading=!0,this.storeJob({job:{clientId:this.user.id,jobType:this.selectedJob,deadline:new Date(this.deadline),description:this.comment},files:this.files}).then((function(){e.$notify("success filled","Requête envoyée !","La requête a été déposée avec succès",{duration:4e3,permanent:!1}),e.dialog=!1})).catch((function(){e.$notify("error filled","Échec de l'envoi !","La requête n'a pas pu être envoyée",{duration:4e3,permanent:!1})})).finally((function(){e.loading=!1}))},clearFields:function(){try{this.$refs.form.reset()}catch(e){}},validate:function(){this.$refs.form.validate()&&this.submit()}}),computed:Object(r["a"])(Object(r["a"])({},Object(s["c"])({user:"getUser",jobTypes:"getJobTypes"})),{},{disabledDates:function(){var e=5;return new Date(Date.now()+864e5*e)}})},m=f,p=n("2877"),v=Object(p["a"])(m,o,c,!1,null,null,null),h=v.exports,g={components:{"submit-job":h},data:function(){return{blogData:l,currentPage:1}},computed:Object(r["a"])({},Object(s["c"])({user:"getUser"}))},b=g,y=Object(p["a"])(b,i,a,!1,null,null,null);t["default"]=y.exports},a9ec:function(e,t,n){},d4d3:function(e,t,n){"use strict";n.r(t);var i=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("v-card",[n("v-col",[n("v-card-title",[e._v("Informations du compte")])],1),e._v(" "),n("v-card-text",[n("v-col",[n("v-row",[n("v-col",[n("p",[e._v("Prénom : "+e._s(e.user.surname))])]),e._v(" "),n("v-col",[n("p",[e._v("Addresse mail : "+e._s(e.user.email))])])],1),e._v(" "),n("v-row",[n("v-col",[n("p",[e._v("Nom : "+e._s(e.user.name))])]),e._v(" "),n("v-col",[n("p",[e._v("Date de création : "+e._s(e._f("formatDate")(e.user.created_at)))])])],1),e._v(" "),n("v-row",[n("v-col",[n("p",[e._v("Travaux en cours : "+e._s(e.jobs.length))])])],1)],1)],1)],1),e._v(" "),n("br"),e._v(" "),n("v-card",[n("v-card-title",[n("v-col",[e._v("Notifications par mail")]),e._v(" "),n("v-col",[n("v-switch",{on:{change:e.emailEnabledChanged},model:{value:e.emailEnabled,callback:function(t){e.emailEnabled=t},expression:"emailEnabled"}})],1)],1),e._v(" "),n("v-card-text",e._l(e.settingsItems,(function(t,i){return n("v-list-item",{key:t.name},[n("v-col",[e._v(" "+e._s(t.label)+" ")]),e._v(" "),n("v-col",[n("v-switch",{attrs:{value:t.name,loading:t.loading,disabled:t.loading},on:{change:function(t){return e.settingChanged(i)}},model:{value:e.enabledSettings,callback:function(t){e.enabledSettings=t},expression:"enabledSettings"}})],1)],1)})),1)],1)],1)},a=[],r=n("5530"),s=(n("159b"),n("c740"),n("b0c0"),n("4de4"),n("d81d"),n("caad"),n("2532"),n("d3b7"),n("2f62")),l=[{label:"Nouveau statut",name:"notify_email_status",loading:!1,submitted:!1},{label:"Nouveaux messages",name:"notify_email_messages",loading:!1,submitted:!1},{label:"Nouveaux fichiers",name:"notify_email_files",loading:!1,submitted:!1}],o=l,c={data:function(){return{settingsItems:o,enabledSettings:[],emailEnabled:!0}},methods:Object(r["a"])(Object(r["a"])({},Object(s["b"])(["updateSettings","retrieveUser"])),{},{emailEnabledChanged:function(){var e=this;this.emailEnabled?(this.settingsItems.filter((function(t){return!e.user[t.name]})).forEach((function(t,n){e.settingChanged(n)})),this.enabledSettings=this.settingsItems.map((function(e){return e.name}))):(this.enabledSettings.forEach((function(t){var n=e.settingsItems.findIndex((function(e){return e.name==t}));e.settingChanged(n)})),this.enabledSettings=[])},settingChanged:function(e){var t=this.settingsItems[e];t.loading=!0,t.submitted=!0},init:function(){var e=this;this.enabledSettings=[],this.settingsItems.forEach((function(t){t.loading=!1,e.user[t.name]&&e.enabledSettings.push(t.name)})),this.emailEnabled=this.enabledSettings.length>0}}),computed:Object(r["a"])({},Object(s["c"])({user:"getUser",jobs:"getJobs"})),beforeMount:function(){this.init()},watch:{enabledSettings:function(){var e=this;this.emailEnabled=this.enabledSettings.length>0;var t=this.settingsItems.filter((function(e){return e.submitted}));if(t.length>0){t.forEach((function(e){return e.submitted=!1}));var n=t.map((function(t){return{name:t.name,value:e.enabledSettings.includes(t.name)}}));this.updateSettings(n).catch((function(){return e.$notify("error filled","Échec de la modification !","La modification n'a pas pu être appliquée. La page va être remise à jour avec les derniers paramètres enregistrés",{duration:4e3,permanent:!1})})).finally((function(){return e.init()}))}}}},u=c,d=(n("6e1d"),n("2877")),f=Object(d["a"])(u,i,a,!1,null,null,null);t["default"]=f.exports},df65:function(e,t,n){"use strict";var i=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{ref:"dropzone",staticClass:"dropzone",on:{dragover:function(e){e.preventDefault()},dragleave:e.dragleave,dragenter:e.dragenter,drop:e.drop}},[n("v-file-input",{style:{width:"-webkit-fill-available"},attrs:{multiple:"",chips:"","show-size":"",counter:"",label:"Fichiers à joindre","append-outer-icon":e.showSend?"mdi-upload":"",disabled:!!e.disabled},on:{"click:append-outer":function(t){return e.$emit("uploadClicked")}},model:{value:e.files,callback:function(t){e.files=t},expression:"files"}})],1)},a=[],r=(n("d81d"),n("5319"),n("ac1f"),n("4d63"),n("25f0"),n("4de4"),n("1276"),n("466d"),n("a434"),n("b0c0"),n("159b"),{props:{label:{type:String,required:!1},value:{type:Array,required:!0},showSend:{type:Boolean,required:!1},disabled:{type:Boolean,required:!1},accept:{type:String,required:!1},multiple:{type:Boolean,required:!1},disableLabel:{type:Boolean,required:!1},disableHint:{type:Boolean,required:!1}},data:function(){return{hoverCounter:0,hoveringContent:null,matchAnything:/.*/,files:[]}},computed:{filebtn:{cache:!1,get:function(){return this.$refs.filebtn}},dropzone:{cache:!1,get:function(){return this.$refs.dropzone}},validTypes:function(){return this.validatedAccept?{extensions:this.validatedAccept.extensions.map((function(e){return e.replace(/(\W)/g,"\\$1")})).map((function(e){return new RegExp("".concat(e,"$"),"i")})),mimetypes:this.validatedAccept.mimetypes.map((function(e){return e.replace(/([-+/])/g,"\\$1")})).map((function(e){return e.replace(/\*/g,"(?:[A-Za-z0-9\\-\\+]*)*")})).map((function(e){return new RegExp("^".concat(e,"$"))}))}:{extensions:[this.matchAnything],mimetypes:[this.matchAnything]}},validatedAccept:function(){return this.accept?{extensions:this.accept.split(",").filter((function(e){return e.match(/^\.(?!.*\/)/)})),mimetypes:this.accept.split(",").filter((function(e){return e.match(/^(?:(?:[A-Za-z0-9\-+]*)|\*)\/(?:(?:[A-Za-z0-9\-+.]*)|\*)$/)}))}:null}},methods:{upload:function(){for(var e,t=this,n=null!==(e=this.filebtn.files)&&void 0!==e?e:[],i=function(e){t.multiple||t.files.splice(0,t.files.length);var i=t.validTypes.extensions.reduce((function(t,i){return t||!!n[e].name.match(i)}),!1)||t.validTypes.mimetypes.reduce((function(t,i){return t||!!n[e].type.match(i)}),!1);i&&t.files.push(n[e])},a=0;a<n.length;a++)i(a);this.filebtn.value=""},dragenter:function(e){this.hoveringContent=e.dataTransfer.items,this.hoverCounter++},dragleave:function(e){this.hoverCounter--},drop:function(e){var t=this;if(e.preventDefault(),this.hoverCounter=0,e.dataTransfer.items){for(var n=[],i=0;i<e.dataTransfer.items.length;i++)if("file"===e.dataTransfer.items[i].kind){var a=function(){if(e.dataTransfer.items[i].webkitGetAsEntry){var a=e.dataTransfer.items[i].webkitGetAsEntry();if(a.isDirectory)return n.push(a.name),"continue"}var r=e.dataTransfer.items[i].getAsFile();if(!r)return"continue";var s=t.validTypes.extensions.reduce((function(e,t){return e||!!r.name.match(t)}),!1)||t.validTypes.mimetypes.reduce((function(e,t){return e||!!r.type.match(t)}),!1);if(!s)return n.push(r),"continue";t.multiple?t.files.filter((function(e){return e.name===r.name})).forEach((function(e){return t.files.splice(t.files.indexOf(e),1)})):t.files.splice(0,t.files.length),t.files.push(r)}();if("continue"===a)continue}n.length&&this.$emit("rejectedFiles",n)}},remove:function(e){var t=this.files;t.splice(t.indexOf(e),1),this.$emit("update",null)}},watch:{files:function(){this.$emit("input",this.files)},value:function(){this.files=this.value},multiple:function(e){e||this.files.splice(0,this.files.length-1)},hoveringContent:function(e){var t=this;if(e)if(this.accept&&this.accept.length&&0===this.validTypes.extensions.length){for(var n=!1,i=function(i){if(t.validTypes.mimetypes.reduce((function(t,n){return t||!!e[i].type.match(n)})))return n=!0,"break"},a=0;a<e.length;a++){var r=i(a);if("break"===r)break}n&&(this.dropzone.style.backgroundColor="rgba(0, 0, 0, 0.25)")}else{for(var s=!1,l=0;l<e.length;l++)if("file"===e[l].kind){s=!0;break}s&&(this.dropzone.style.backgroundColor="rgba(0, 0, 0, 0.25)")}else this.dropzone.style.backgroundColor=""},hoverCounter:function(e){0===e&&(this.hoveringContent=null)}}}),s=r,l=(n("0da2"),n("2877")),o=Object(l["a"])(s,i,a,!1,null,"04a78961",null);t["a"]=o.exports}}]);