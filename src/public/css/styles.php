<?php
/**
 * PHP library for handling exceptions and errors.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2016 - 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-ErrorHandler
 * @since      1.0.0
 */
?>

<style type="text/css" media="screen">
@import url(https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese);
	
hr {
  width: 30%; 
}
.jst-alert {
	padding: 15px 25px;
	border-radius: 2px;
	word-break: break-all;
	margin: 25px;
	line-height: 20px;
	max-width: 1000px;
	font-family: Roboto;
	box-shadow: 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12), 0 2px 4px -1px rgba(0,0,0,.2); 
	color: #fff; 
}
.jst-right {
	color: rgba(255, 255, 255, 0.31) !important;
	float: right; 
}
.jst-head {
	font-size: 18px;
	color: rgba(255, 255, 255, 0.5);
	top: 18px;
	font-weight: 600; 
}
.Default {
      background-color: #446CB3; 
}
.Error {
  background-color: #D91E18; 
}
.Warning {
  background-color: #F9690E; 
}
.Notice {
  background-color: #674172; 
}
.jst-mark {
	background: #D91E18;
	padding: 4px;
	margin-left: -4px;
	color: white; 
}
.jst-preview {
	width: 85%;
	margin-left: auto;
	margin-right: auto;
	overflow-x: auto;
	white-space: nowrap;
	background: white;
	color: #333;
	padding: 2pc; 
}
.stackoverflow-link {
	text-decoration: none;
	color: rgba(255, 255, 255, 0.5);
	cursor: pointer;
	display: inline-block;
	font-weight: inherit;
	transform: rotate(-35deg);
	-webkit-transform: rotate(35deg);
	-moz-transform: rotate(-35deg);
	-o-transform: rotate(-35deg);
	font-size: 23px; 
}
.jst-line {
    margin-left: -10px;
    background: rgba(0,0,0,.14);
    padding: 2px 2px;
    margin-top: -1px;
    margin-right: 14px;
    width: 44px;
    display: inline-table;
    text-align: center;
}
.jst-trace{
    font-weight: 300;
    padding: 0pc 2pc 0pc 2pc;
}
.jst-file {
	float: right;
    font-weight: 300;
    font-size: 14px;
    margin-right: -18px;
    word-break: break-all;
    color: #363838;
    margin-top: -24px;
}
.jst-preview code {
	margin-top: -16px;
    display: block;
}
@media (max-width: 600px) {
	.jst-preview {
    	width: auto;
	}
	.jst-file {
		float: left;
    	margin-left: -9px;
	}
}
</style>