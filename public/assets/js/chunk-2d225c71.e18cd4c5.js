(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d225c71"],{e69c:function(e,t,n){"use strict";n.r(t);var s=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("div",{style:{display:"flex","justify-content":"center",padding:"5px"}},[n("v-btn",{attrs:{disabled:!(e.selectedJobs.length>0),color:"green"},on:{click:function(t){e.dialog=!0}}},[e._v("Assigner")])],1),e._v(" "),n("v-data-table",{ref:"table",attrs:{headers:e.headers,items:e.jobs,"item-key":"id","show-select":""},scopedSlots:e._u([{key:"header.data-table-select",fn:function(){},proxy:!0},{key:"item.job_type",fn:function(t){var n=t.item;return[e._v("\n      "+e._s(e.jobTypes.find((function(e){return n.job_type==e.value})).text)+"\n    ")]}},{key:"item.status",fn:function(t){var s=t.item;return[n("v-chip",{attrs:{label:"",color:e.getChipColor(s)}},[e._v(e._s(s.status.toUpperCase()))])]}},{key:"item.created_at",fn:function(t){var s=t.item;return[n("span",[e._v(e._s(e._f("formatDate")(s.created_at)))])]}},{key:"item.deadline",fn:function(t){var s=t.item;return[n("span",[e._v(e._s(e._f("formatDate")(s.deadline)))])]}}]),model:{value:e.selectedJobs,callback:function(t){e.selectedJobs=t},expression:"selectedJobs"}}),e._v(" "),n("v-dialog",{attrs:{width:"450"},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[n("v-card",[n("v-card-title",{staticClass:"headline grey lighten-2"},[e._v("\n        Attribution des travaux\n      ")]),e._v(" "),n("v-card-text",[n("br"),e._v(" "),n("br"),e._v("\n        "+e._s(e.selectedJobs.length)+" travaux vont vous être attribués. Souhaitez\n        vous continuer ?\n      ")]),e._v(" "),n("v-divider"),e._v(" "),n("v-card-actions",[n("v-spacer"),e._v(" "),n("v-btn",{attrs:{color:"red",text:""},on:{click:function(t){e.dialog=e.loading=!1}}},[e._v("\n          Annuler\n        ")]),e._v(" "),n("v-btn",{attrs:{color:"primary",text:"",loading:e.loading},on:{click:e.assign}},[e._v("\n          Valider\n        ")])],1)],1)],1)],1)},a=[],i=n("5530"),o=(n("d81d"),n("4de4"),n("2f62")),r={data:function(){return{headers:[{text:"Job",value:"job_type"},{text:"Date de création",value:"created_at"},{text:"Deadline",value:"deadline"},{text:"Statut",value:"status"}],dialog:!1,loading:!1,selectedJobs:[]}},methods:Object(i["a"])(Object(i["a"])({},Object(o["b"])(["retrieveUnassignedJobs","assignJob"])),{},{getChipColor:function(e){switch(e.status){case"new":return"grey lighten-2";case"assigned":return"light-blue lighten-4";case"ongoing":return"light-blue";case"on-hold":return"red";case"completed":return"green";default:return""}},assign:function(){var e=this;this.loading=!0,this.$refs.table.toggleSelectAll(!1),this.assignJob(this.selectedJobs.map((function(e){return e.id}))).then((function(){e.$notify("success filled","Travaux assignés !","Les travaux vous ont été assignés",{duration:4e3,permanent:!1}),e.loading=!1,e.dialog=!1})).catch((function(t){console.log(t),e.$notify("error filled","Échec de l'assignation !","Les travaux n'ont pas pu vous être assignés",{duration:4e3,permanent:!1}),e.loading=!1}))}}),computed:Object(i["a"])({},Object(o["c"])({jobs:"getUnassignedJobs",jobTypes:"getJobTypes"})),watch:{jobs:function(){var e=this;this.selectedJobs=this.jobs.filter((function(t){return e.$refs.table.isSelected(t)})),this.dialog&&0==this.selectedJobs.length&&(this.dialog=this.loading=!1)}},mounted:function(){this.retrieveUnassignedJobs()}},l=r,c=n("2877"),d=Object(c["a"])(l,s,a,!1,null,null,null);t["default"]=d.exports}}]);