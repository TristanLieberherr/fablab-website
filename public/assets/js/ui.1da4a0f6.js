(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["ui"],{"38d1":function(e,t,i){"use strict";i.r(t);var n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("router-view")},a=[],s=i("2877"),l={},r=Object(s["a"])(l,n,a,!1,null,null,null);t["default"]=r.exports},"4ac6":function(e,t,i){"use strict";i("60fd")},"60fd":function(e,t,i){},"6e1d":function(e,t,i){"use strict";i("a9ec")},a3f0:function(e,t,i){"use strict";i.r(t);var n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"pad"},[i("div",{staticClass:"btn-pos"},[i("submit-job")],1),e._v(" "),i("b-row",e._l(e.blogData,(function(t,n){return i("b-colxx",{key:"blogItem_"+n,staticClass:"mb-5",attrs:{xxs:"12",lg:"6"}},[i("b-card",{staticClass:"flex-row listing-card-container",attrs:{"no-body":""}},[i("div",{staticClass:"w-40 position-relative"},[i("v-img",{attrs:{src:t.thumb,width:"480",height:"200",contain:""}})],1),e._v(" "),i("div",{staticClass:"w-60 d-flex align-items-center"},[i("b-card-body",[i("h5",{directives:[{name:"line-clamp",rawName:"v-line-clamp",value:2,expression:"2"}],staticClass:"mb-3 listing-heading"},[e._v("\n              "+e._s(t.title)+"\n            ")]),e._v(" "),i("p",{directives:[{name:"line-clamp",rawName:"v-line-clamp",value:3,expression:"3"}],staticClass:"listing-desc text-muted"},[e._v("\n              "+e._s(t.description)+"\n            ")])])],1)])],1)})),1)],1)},a=[],s=i("5530"),l=i("2f62"),r=[{title:"Impression 3D",description:"Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration. Collaboratively administrate via plug-and-play networks.",thumb:"/assets/img/details/3D_printer.jpg"},{title:"Fraisage CNC",description:"Credibly reintermediate backend ideas for cross-platform models. Continually reintermediate integrated processes through technically sound intellectual capital.",thumb:"/assets/img/details/CNC_mill.png"},{title:"Gravure laser",description:"Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.",thumb:"/assets/img/details/laser_engraver.jpg"},{title:"Perçage",description:"Quickly deploy strategic networks with compelling e-business. Credibly pontificate highly efficient manufactured products and enabled data.",thumb:"/assets/img/details/drilling_machine.jpg"},{title:"Placeholder",description:"Completely synergize resource taxing relationships via premier niche markets.",thumb:"/assets/img/details/small-1.jpg",type:"image"},{title:"Placeholder",description:"Credibly reintermediate backend ideas for cross-platform models. Continually reintermediate integrated processes through technically sound intellectual capital.",thumb:"/assets/img/details/small-6.jpg",type:"image"},{title:"Placeholder",description:"Dramatically maintain clicks-and-mortar solutions without functional solutions. Completely synergize resource taxing relationships via premier niche markets.",thumb:"/assets/img/details/small-7.jpg",type:"image"},{title:"Placeholder",description:"Dramatically maintain clicks-and-mortar solutions without functional solutions.",thumb:"/assets/img/details/small-8.jpg",type:"image"}],o=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("v-dialog",{attrs:{width:"800",persistent:"","no-click-animation":""},scopedSlots:e._u([{key:"activator",fn:function(t){var n=t.on,a=t.attrs;return[i("v-btn",e._g(e._b({attrs:{color:"green",dark:""},on:{click:e.clearFields}},"v-btn",a,!1),n),[e._v("\n        Nouvelle demande\n      ")])]}}]),model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[e._v(" "),i("v-form",{ref:"form",attrs:{"lazy-validation":""}},[i("v-card",{attrs:{disabled:e.loading}},[i("v-card-title",{staticClass:"headline grey lighten-2"},[i("span",[e._v("Formulaire de nouvelle demande")])]),e._v(" "),i("v-card-text",[i("v-container",[i("v-row",[i("v-col",[i("v-select",{attrs:{items:e.jobTypes,label:"Type de travail","prepend-icon":e.icons.mdiBriefcaseVariant,required:"",rules:[function(e){return!!e||"Type de travail requis"}]},model:{value:e.selectedJob,callback:function(t){e.selectedJob=t},expression:"selectedJob"}})],1)],1),e._v(" "),i("v-row"),e._v(" "),i("v-row",[i("v-col",[i("v-menu",{attrs:{"close-on-content-click":!1,"nudge-right":40,transition:"scale-transition","offset-y":"","min-width":"auto"},scopedSlots:e._u([{key:"activator",fn:function(t){var n=t.on,a=t.attrs;return[i("v-text-field",e._g(e._b({attrs:{label:"Deadline","prepend-icon":"mdi-calendar",readonly:"",required:"",rules:[function(e){return!!e||"Date limite requise"}]},model:{value:e.deadline,callback:function(t){e.deadline=t},expression:"deadline"}},"v-text-field",a,!1),n))]}}]),model:{value:e.menu,callback:function(t){e.menu=t},expression:"menu"}},[e._v(" "),i("v-date-picker",{attrs:{locale:"fr-FR",min:e.disabledDates.toISOString()},on:{input:function(t){e.menu=!1}},model:{value:e.deadline,callback:function(t){e.deadline=t},expression:"deadline"}})],1)],1)],1),e._v(" "),i("v-row",[i("v-col",[i("v-file-input",{attrs:{multiple:"",chips:"","show-size":"",counter:"",label:"Fichiers à joindre"},model:{value:e.files,callback:function(t){e.files=t},expression:"files"}})],1)],1),e._v(" "),i("v-row",[i("v-textarea",{attrs:{label:"Commentaires éventuels","prepend-icon":"mdi-comment","auto-grow":"",rows:"1",clearable:""},model:{value:e.comment,callback:function(t){e.comment=t},expression:"comment"}})],1)],1)],1),e._v(" "),i("v-card-actions",[i("v-spacer"),e._v(" "),i("v-btn",{attrs:{color:"red",text:""},on:{click:function(t){e.dialog=e.loading=!1}}},[e._v("\n            Annuler\n          ")]),e._v(" "),i("v-btn",{attrs:{color:"primary",text:"",loading:e.loading},on:{click:e.validate}},[e._v("\n            Soumettre\n          ")])],1)],1)],1)],1)],1)},c=[],d=i("94ed"),u={data:function(){return{icons:{mdiBriefcaseVariant:d["b"]},selectedJob:null,deadline:null,comment:null,loading:!1,files:[],dialog:!1,menu:!1}},methods:Object(s["a"])(Object(s["a"])({},Object(l["b"])(["storeJob","storeFiles"])),{},{submit:function(){var e=this;this.loading=!0,this.storeJob({job:{clientId:this.user.id,jobType:this.selectedJob,deadline:new Date(this.deadline),description:this.comment},files:this.files}).then((function(){e.$notify("success filled","Requête envoyée !","La requête a été déposée avec succès",{duration:4e3,permanent:!1}),e.loading=!1})).catch((function(){e.$notify("error filled","Échec de l'envoi !","La requête n'a pas pu être envoyée",{duration:4e3,permanent:!1}),e.loading=!1}))},clearFields:function(){try{this.$refs.form.reset()}catch(e){}},validate:function(){this.$refs.form.validate()&&this.submit()}}),computed:Object(s["a"])(Object(s["a"])({},Object(l["c"])({user:"getUser",jobTypes:"getJobTypes"})),{},{disabledDates:function(){var e=5;return new Date(Date.now()+864e5*e)}})},m=u,v=i("2877"),b=Object(v["a"])(m,o,c,!1,null,null,null),g=b.exports,p={components:{"submit-job":g},data:function(){return{blogData:r,currentPage:1}},computed:Object(s["a"])({},Object(l["c"])({user:"getUser"}))},f=p,h=(i("4ac6"),Object(v["a"])(f,n,a,!1,null,"5332ad01",null));t["default"]=h.exports},a9ec:function(e,t,i){},d4d3:function(e,t,i){"use strict";i.r(t);var n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("v-card",[i("v-col",[i("v-card-title",[e._v("Informations du compte")])],1),e._v(" "),i("v-card-text",[i("v-col",[i("v-row",[i("v-col",[i("p",[e._v("Prénom : "+e._s(e.user.surname))])]),e._v(" "),i("v-col",[i("p",[e._v("Addresse mail : "+e._s(e.user.email))])])],1),e._v(" "),i("v-row",[i("v-col",[i("p",[e._v("Nom : "+e._s(e.user.name))])]),e._v(" "),i("v-col",[i("p",[e._v("Date de création : "+e._s(e._f("formatDate")(e.user.created_at)))])])],1),e._v(" "),i("v-row",[i("v-col",[i("p",[e._v("Travaux en cours : "+e._s(e.jobs.length))])])],1)],1)],1)],1),e._v(" "),i("br"),e._v(" "),i("v-card",[i("v-card-title",[i("v-col",[e._v("Notifications par mail")]),e._v(" "),i("v-col",[i("v-switch",{on:{change:e.emailEnabledChanged},model:{value:e.emailEnabled,callback:function(t){e.emailEnabled=t},expression:"emailEnabled"}})],1)],1),e._v(" "),i("v-card-text",e._l(e.settingsItems,(function(t,n){return i("v-list-item",{key:t.name},[i("v-col",[e._v(" "+e._s(t.label)+" ")]),e._v(" "),i("v-col",[i("v-switch",{attrs:{value:t.name,loading:t.loading,disabled:t.loading},on:{change:function(t){return e.settingChanged(n)}},model:{value:e.enabledSettings,callback:function(t){e.enabledSettings=t},expression:"enabledSettings"}})],1)],1)})),1)],1)],1)},a=[],s=i("5530"),l=(i("159b"),i("c740"),i("b0c0"),i("4de4"),i("d81d"),i("caad"),i("2532"),i("d3b7"),i("2f62")),r=[{label:"Nouveau statut",name:"notify_email_status",loading:!1,submitted:!1},{label:"Nouveaux messages",name:"notify_email_messages",loading:!1,submitted:!1},{label:"Nouveaux fichiers",name:"notify_email_files",loading:!1,submitted:!1}],o=r,c={data:function(){return{settingsItems:o,enabledSettings:[],emailEnabled:!0}},methods:Object(s["a"])(Object(s["a"])({},Object(l["b"])(["updateSettings","retrieveUser"])),{},{emailEnabledChanged:function(){var e=this;this.emailEnabled||(this.enabledSettings.forEach((function(t){var i=e.settingsItems.findIndex((function(e){return e.name==t}));e.settingChanged(i)})),this.enabledSettings=[])},settingChanged:function(e){var t=this.settingsItems[e];t.loading=!0,t.submitted=!0},init:function(){var e=this;this.enabledSettings=[],this.settingsItems.forEach((function(t){t.loading=!1,e.user[t.name]&&e.enabledSettings.push(t.name)})),this.emailEnabled=this.enabledSettings.length>0}}),computed:Object(s["a"])({},Object(l["c"])({user:"getUser",jobs:"getJobs"})),beforeMount:function(){this.init()},watch:{enabledSettings:function(){var e=this;this.emailEnabled=this.enabledSettings.length>0;var t=this.settingsItems.filter((function(e){return e.submitted}));if(t.length>0){t.forEach((function(e){return e.submitted=!1}));var i=t.map((function(t){return{name:t.name,value:e.enabledSettings.includes(t.name)}}));this.updateSettings(i).catch((function(){return e.$notify("error filled","Échec de la modification !","La modification n'a pas pu être appliquée. La page va être remise à jour avec les derniers paramètres enregistrés",{duration:4e3,permanent:!1})})).finally((function(){return e.init()}))}}}},d=c,u=(i("6e1d"),i("2877")),m=Object(u["a"])(d,n,a,!1,null,null,null);t["default"]=m.exports}}]);