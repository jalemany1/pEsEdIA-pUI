<?php

/* 
El mecanismo de asignación del CSS está tomado del plugin galliElggCSS

Los estilos tomados del plugin tema Hexagon
*/
?>
/*<style>

/* ***************************************
	SIMPLIFY STYLE
*****************************************/
#ul.elgg-menu-filter-ctivity,
label.elgg-river-selector,
li.elgg-more,
li.elgg-menu-item-feature,
ul.elgg-breadcrumbs,
div.elgg-widget-add-control,
ul.elgg-menu-wall-tools .elgg-menu-item-add-content{
	display: none;
}

.wall-post-list > li{
    border: 1px solid #dcdcdc;
    padding: 0;
    margin-bottom: 15px;
}

.profile .elgg-inner,
.elgg-input-dropzone.wall-photo{
	background-color: white;
}

.wall-container{
	border: 1px solid #dcdcdc;
	background-color: white;
	margin: 15px 0px;
	padding-top: 20px;
	padding-bottom: 5px;
	padding-left: 15px;
	padding-right: 25px;
}

.profile-wall{
	float: right;
	width: 65.66%;
	margin-right: 1%;
}

.profile-wall > .elgg-main,
.profile-wall .elgg-heading-main{
	padding-top: 0px;
}

li.elgg-item-user,
li.elgg-item-group,
li.elgg-item-object-poll,
li.elgg-item-object-leader,
li.elgg-item-object-gm_score_history{
	padding: 0px 15px;
	border: 1px solid #dcdcdc;
	background-color: white;
}


/* ***************************************
	TOPBAR MENU DROPDOWN
*****************************************/
.elgg-page-topbar{
	height: auto;
}

.elgg-page-topbar .top-search{
 	float: right;
	margin: -40px 150px;
	max-width: 200px;
	padding: 10px;
	color: #EEE;
}

.elgg-page-topbar form.elgg-search{
	max-width: 150px;
	margin: 0 15px 0 0;
}

.elgg-page-topbar span.fa-search{
    float: left;
    margin: 2.5px 5px;
    color: #EEE;
}

.elgg-menu-topbar-default > li > a > span{
	color: #EEE;
}

.elgg-menu-topbar-default > li > a > span:hover{
	color: #60B8F7;
}

.elgg-page-topbar form.elgg-search input{
   border: 0px solid;
   border-bottom-width: 1px;
   background: none;
   border-color: #EEE;
   padding: 6px;
   color: #EEE;
}

.elgg-topbar-dropdown{
	padding-bottom: 8px; /* forces button to reach bottom of topbar */
}
.elgg-menu-topbar > li > .elgg-topbar-dropdown:hover{
	cursor: default;
}
.elgg-menu-topbar-alt ul {
	position: absolute;
	display: none;
	background-color: #FFF;
	border: 1px solid #DEDEDE;
	text-align: left;
	top: 33px;
	margin-left: -100px;
	width: 180px;

	border-radius: 0 0 3px 3px;
	box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.25);
}
.elgg-menu-topbar-alt li ul > li > a {
	text-decoration: none;
	padding: 10px 20px;
	background-color: #FFF;
	color: #444;
}
.elgg-menu-topbar-alt li ul > li > a:hover {
	background-color: #F0F0F0;
	color: #444;
}
.elgg-menu-topbar-alt > li:hover > ul {
	display: block;
}
.elgg-menu-item-account > a:after {
	
}

.elgg-river-item input[type="text"] {
    width: 84%;
}

.profile-text{
	display: block;
	margin: 0px 30px;
	width: 150px;
}

.elgg-avatar > a > img {
	float: left;
}

/* ***************************************
	RESPONSIVE
*****************************************/
@media (max-width: 600px) {
	.groups-profile-fields {
		float: left;
		padding-left: 0;
	}
	#profile-owner-block {
		border-right: none;
		width: auto;
	}

	.elgg-menu-item-home{
		display: none;
	}

	.elgg-avatar-topbar{
		display: none;
	}
	
	.elgg-river-item input[type="text"] {
    width: 60%;
	}

	audio {
		max-width: 220px;
	}

	.elgg-form-comment-save{
		width: 90%;
	}

	.elgg-page-topbar form.elgg-search {
	    width: 110px;
	    margin: 0 15px 0 0;
	}

	#groups-tools > li {
		width: 100%;
		margin-bottom: 20px;
	}
	#groups-tools > li:nth-child(odd) {
		margin-right: 0;
	}
	#groups-tools > li:last-child {
		margin-bottom: 0;
	}
	.elgg-menu-entity, .elgg-menu-annotation {
		margin-left: 0;
	}
	.elgg-menu-entity > li, .elgg-menu-annotation > li {
		margin-left: 0;
		margin-right: 15px;
	}
	.elgg-subtext {
		margin-right: 15px;
	}
}