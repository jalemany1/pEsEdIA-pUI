<?php

/* 
El mecanismo de asignación del CSS está tomado del plugin galliElggCSS

Los estilos tomados del plugin tema Hexagon
*/
?> 
/*<style>
p, body {
	font-family: "Trebuchet MS",Arial,Tahoma,Verdana,sans-serif;
	font-size: 13px;
}

/* Ocultamos la franja donde se muestra el nombre de la red social */
.elgg-page-header {
    display: none; 
}

/* Hacemos más ancha la topbar y ponemos imagen de fondo */
.elgg-page-topbar {
    background: url(<?=elgg_get_simplecache_url('graphics/header-bg.jpg');?>);
    background-size: cover;
    height: 40px;
}

/* Tamaño de los iconos de la topbar */
.elgg-menu-item-inbox > a .elgg-icon,
.elgg-page-topbar .elgg-icon {
	color: #EEE;
	font-size: 24px;
}

.elgg-icon {
	font-size: 20px;
}

.elgg-menu-topbar > li > a.elgg-topbar-avatar {
	padding-top: 2.5px;
}


/* Fondo de la barra de navegación */
.elgg-page-navbar {
    background: #4EC3CD;
}

/* Color de los ítems del menú principal cuando se pasa el ratón por encima o se seleccionan */
.elgg-menu-site > .elgg-state-selected > a,
.elgg-menu-site > li:hover > a {
    color: #D1D5CE;
    background-color: inherit;	
}

/* Color de fondo del cuerpo de la página */
.elgg-page-body {
     background-color: #EDF4F6;
}

/* Ajustes del botón de Publicar */
.elgg-button-submit {
	border: 1px solid rgba(0, 0, 0, 0.2);
	background: #F0F0F0;
	color: #333;
}


.elgg-button-submit:hover, .elgg-button-action:focus {
	background: #DEDEDE;
	color: #333;
}

/* Color de las etiquetas */

label, .elgg-field-label {
	color: #11A5C6;
}

/* Ajustes de los menús desplegables */ 
select {
    max-width: 100%;
    padding: 2px;
    font-family: Arial,"Helvetica Neue",Helvetica,sans-serif;
    font-size: 100%;
}

.elgg-river-selector {
    font-size: 100%;
}

/* Fondo blanco en los elementos de listas como entradas del river etc */
.elgg-item {
	background-color: white;
	margin-bottom: 8px;
}

/* ... pero que no afecte a las fotos de tidypics ni a las galerías de logros*/

.tidypics-gallery .elgg-item, .gm-badge-item {
	background-color: #EDF4F6;
}

/* ... pero sí a las galerías de logros que aparecen en la clasificación de usuarios */
.elgg-item .gm-badge-item {
	background-color: white;
	margin-bottom: 8px;
}


.gm-badge-gallery {
	display : block;
}

.elgg-module .gm-badge-gallery {
	display : flex;
}

/* Estilo del formulario para elegir álbum o crearlo antes de subir fotos */
#cboxWrapper {
	color: #11A5C6;
}


/* Eliminar círculos que resaltan los logros */
.gm-badge.gm-badge-eligible {
	border: none;
}


.gm-badge.gm-badge-claimed {
	border: none;
}

.gm-badge.gm-badge-unclaimed {
	border: none;
}

.gm-badge {
	border: none;
}

/* Cambiar el color del icono de denuncia */

.elgg-icon-report-this {
    color : Red;
}
.elgg-icon-report-this:hover {
    color : Black;
}


.site-announcement {
	border: 1px solid #5097CF;
	background-color: white;
	margin: 15px 0px;
	padding-top: 20px;
	padding-bottom: 5px;
	padding-left: 15px;
	padding-right: 25px;
}

#groups-tools > li {
	width: 100%;
}

.elgg-button-submit {	
	border: transparent;
	background: #5097CF;
	color: #FFF;
}

.elgg-button {	
	border: transparent;
	background: #5097CF;
	color: #FFF;
}

.gm-score-positive {
	background: #5097CF;
}

.elgg-menu-filter > li > a {
	color: #5097CF;
}


.elgg-menu-filter > li {
	border: 0px;
	background: transparent;
}

.elgg-menu-filter {
	border: 0px;
}
