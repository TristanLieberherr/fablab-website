(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2329b4e5"],{"09a3":function(e,t,n){},"1ca5":function(e,t,n){"use strict";n.d(t,"a",(function(){return a})),n.d(t,"b",(function(){return s}));var a=[{value:"3Dprinting",text:"Impression 3D",requirements:["step","stl"],machine:"Formlabs Form 3",link:"https://formlabs.com/3d-printers/form-3/",description:"Avec cette imprimante industrielle, réalisez vos pièces en résine allant jusqu'à une dimension de 14.5 x 14.5 x 18.5 cm, avec une précision inégalée de 25 μm.",thumb:"/assets/img/machines/formlabs3.png"},{value:"milling",text:"Fraisage CNC",requirements:["step"],machine:"Roland MDX-50",link:"https://www.rolanddg.fr/produits/3d/mdx-50-fraiseuse-de-precision/caracteristiques",description:"Cette fraiseuse à commande numérique possède un volume de travail de 40 x 30.5 x 13.5 cm à une résolution mécanique de 10 μm. Les matériaux utilisables sont nombreux : ABS, bois dur, Acétal, Mousses synthétiques, etc.",thumb:"/assets/img/machines/mdx50.jpg"},{value:"engraving",text:"Gravure laser",requirements:["dxf","ai","svg"],machine:"Trotec SpeedMarker 300",link:"https://www.troteclaser.com/fr-ch/machines-laser/marquage-laser-galvo-speedmarker/",description:"Gravez vos pièces avec ce laser à fibre sur un surface comprise jusqu'à 19 x 19 cm, d'une hauteur ne dépassant pas 17 cm. Les gravures font faisables sur des pièces en métal et en plastique.",thumb:"/assets/img/machines/speedmarker300.jpg"},{value:"cutting",text:"Découpe laser",requirements:["dxf","ai","svg"],machine:"Trotec Speedy 360",link:"https://www.troteclaser.com/fr-ch/machines-laser/machines-gravure-laser-speedy/",description:"Le découpage par laser peut se faire sur un surface de 81.3 x 50.8 cm, d'une hauteur maximale de 18.8 cm. La machine est capable de couper à travers l'acrylique, le bois, le plastique, etc.",thumb:"/assets/img/machines/speedy360.jpg"}],s=[{value:"new",text:"Nouveau",level:0,description:"Le travail a été créé."},{value:"assigned",text:"Assigné",level:0,description:"Le travail à été attribué à un technicien."},{value:"ongoing",text:"En cours",level:1,description:"Le travail est en cours de production."},{value:"on-hold",text:"En pause",level:1,description:"Le travail doit être interrompu."},{value:"completed",text:"Terminé",level:2,description:"Le travail est terminé et le client peut récupérer le travail."}]},be1a:function(e,t,n){"use strict";n("09a3")},d81d:function(e,t,n){"use strict";var a=n("23e7"),s=n("b727").map,i=n("1dde"),r=i("map");a({target:"Array",proto:!0,forced:!r},{map:function(e){return s(this,e,arguments.length>1?arguments[1]:void 0)}})},e69c:function(e,t,n){"use strict";n.r(t);var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("div",{style:{display:"flex","justify-content":"center","padding-bottom":"15px"}},[n("v-btn",{attrs:{disabled:!(e.selectedJobs.length>0),color:"green"},on:{click:function(t){e.dialog=!0}}},[e._v("Assigner")])],1),e._v(" "),n("v-data-table",{ref:"table",attrs:{headers:e.headers,items:e.jobs,"item-key":"id","show-select":""},scopedSlots:e._u([{key:"header.data-table-select",fn:function(){},proxy:!0},{key:"item.job_type",fn:function(t){var n=t.item;return[e._v("\n      "+e._s(e.JobTypes.find((function(e){return n.job_type==e.value})).text)+"\n    ")]}},{key:"item.created_at",fn:function(t){var a=t.item;return[n("span",[e._v(e._s(e._f("formatDate")(a.created_at)))])]}},{key:"item.deadline",fn:function(t){var a=t.item;return[n("span",[e._v(e._s(e._f("formatDate")(a.deadline)))])]}},{key:"item.client_name",fn:function(t){var a=t.item;return[n("span",[e._v(e._s(a.client_surname.charAt(0)+"."+a.client_name))])]}},{key:"item.description",fn:function(t){var a=t.item;return["null"!=a.description?n("v-dialog",{attrs:{"max-width":"80%","content-class":"comment"},scopedSlots:e._u([{key:"activator",fn:function(t){var a=t.on,s=t.attrs;return[n("v-btn",e._g(e._b({attrs:{text:""}},"v-btn",s,!1),a),[n("v-icon",[e._v(e._s(e.mdiCommentEyeOutline))])],1)]}}],null,!0)},[e._v(" "),n("v-card",[n("v-card-title",{staticClass:"text-h5"},[e._v(" Commentaire ")]),e._v(" "),n("v-card-text",[e._v(e._s(a.description))])],1)],1):n("span",[e._v("Aucun")])]}}]),model:{value:e.selectedJobs,callback:function(t){e.selectedJobs=t},expression:"selectedJobs"}}),e._v(" "),n("v-dialog",{attrs:{width:"450"},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[n("v-card",[n("v-card-title",{staticClass:"headline grey lighten-2"},[e._v("\n        Attribution des travaux\n      ")]),e._v(" "),n("v-card-text",[n("br"),e._v(" "),n("br"),e._v("\n        "+e._s(e.selectedJobs.length)+" travaux vont vous être attribués. Souhaitez\n        vous continuer ?\n      ")]),e._v(" "),n("v-divider"),e._v(" "),n("v-card-actions",[n("v-spacer"),e._v(" "),n("v-btn",{attrs:{color:"red",text:""},on:{click:function(t){e.dialog=e.loading=!1}}},[e._v("\n          Annuler\n        ")]),e._v(" "),n("v-btn",{attrs:{color:"primary",text:"",loading:e.loading},on:{click:e.assign}},[e._v("\n          Valider\n        ")])],1)],1)],1)],1)},s=[],i=n("5530"),r=(n("d3b7"),n("d81d"),n("4de4"),n("2f62")),o=n("94ed"),c=n("1ca5"),l={data:function(){return{headers:[{text:"Job",value:"job_type"},{text:"Date de création",value:"created_at"},{text:"Deadline",value:"deadline"},{text:"Client",value:"client_name"},{text:"Commentaire",value:"description",align:"center",sortable:!1}],dialog:!1,loading:!1,selectedJobs:[],mdiCommentEyeOutline:o["e"],JobTypes:c["a"]}},methods:Object(i["a"])(Object(i["a"])({},Object(r["b"])(["retrieveUnassignedJobs","assignJob"])),{},{getChipColor:function(e){switch(e.status){case"new":return"grey lighten-2";case"assigned":return"light-blue lighten-4";case"ongoing":return"light-blue";case"on-hold":return"red";case"completed":return"green";default:return""}},assign:function(){var e=this;this.loading=!0,this.$refs.table.toggleSelectAll(!1),this.assignJob(this.selectedJobs.map((function(e){return e.id}))).then((function(){e.$notify("success filled","Travaux assignés !","Les travaux vous ont été assignés",{duration:4e3,permanent:!1}),e.dialog=!1})).catch((function(t){console.log(t),e.$notify("error filled","Échec de l'assignation !","Les travaux n'ont pas pu vous être assignés",{duration:4e3,permanent:!1})})).finally((function(){e.loading=!1}))}}),computed:Object(i["a"])({},Object(r["c"])({jobs:"getUnassignedJobs"})),watch:{jobs:function(){var e=this;this.selectedJobs=this.jobs.filter((function(t){return e.$refs.table.isSelected(t)})),this.dialog&&0==this.selectedJobs.length&&(this.dialog=this.loading=!1)}},mounted:function(){this.retrieveUnassignedJobs()}},u=l,d=(n("be1a"),n("2877")),v=Object(d["a"])(u,a,s,!1,null,null,null);t["default"]=v.exports}}]);