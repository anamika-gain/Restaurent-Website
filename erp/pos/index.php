<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('../includes/easyfunctions.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" id="favicon" href="../images/16071590237441.webp" sizes="32x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/style.css">
    <!-- <link href="assets/2.97fd0627.chunk.css" rel="stylesheet"> -->
    <!-- <link href="assets/main.e1af72b3.chunk.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <style type="text/css">
        <?php
        $subCategories = getAllDataOfProductSubCategoryTable("");
        $classNamesPHP = array();
        foreach ($subCategories as $key => $value) {
            if (preg_match('~[0-9]+~', $subCategories[$key]['name'])) {
                $className0 = "cat-" . strtolower(str_replace(" ", "-", "special char" . $subCategories[$key]['id']));
                echo "." . $className0 . "{ display: block;}";
            } else {
                $className0 = "cat-" . strtolower(str_replace(" ", "-", $subCategories[$key]['name']));
                echo "." . $className0 . "{ display: block;}";
            }
            array_push($classNamesPHP, $className0);
        }

        $classNamesJS = json_encode($classNamesPHP);
        ?>
    </style>

    <style type="text/css">
        .apexcharts-canvas {
            position: relative;
            user-select: none;
            /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */
        }


        /* scrollbar is not visible by default for legend, hence forcing the visibility */
        .apexcharts-canvas ::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 6px;
        }

        .apexcharts-canvas ::-webkit-scrollbar-thumb {
            border-radius: 4px;
            background-color: rgba(0, 0, 0, .5);
            box-shadow: 0 0 1px rgba(255, 255, 255, .5);
            -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
        }


        .apexcharts-inner {
            position: relative;
        }

        .apexcharts-text tspan {
            font-family: inherit;
        }

        .legend-mouseover-inactive {
            transition: 0.15s ease all;
            opacity: 0.20;
        }

        .apexcharts-series-collapsed {
            opacity: 0;
        }

        .apexcharts-tooltip {
            border-radius: 5px;
            box-shadow: 2px 2px 6px -4px #999;
            cursor: default;
            font-size: 14px;
            left: 62px;
            opacity: 0;
            pointer-events: none;
            position: absolute;
            top: 20px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            white-space: nowrap;
            z-index: 12;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip.apexcharts-active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip.apexcharts-theme-light {
            border: 1px solid #e3e3e3;
            background: rgba(255, 255, 255, 0.96);
        }

        .apexcharts-tooltip.apexcharts-theme-dark {
            color: #fff;
            background: rgba(30, 30, 30, 0.8);
        }

        .apexcharts-tooltip * {
            font-family: inherit;
        }


        .apexcharts-tooltip-title {
            padding: 6px;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
            background: #ECEFF1;
            border-bottom: 1px solid #ddd;
        }

        .apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
            background: rgba(0, 0, 0, 0.7);
            border-bottom: 1px solid #333;
        }

        .apexcharts-tooltip-text-value,
        .apexcharts-tooltip-text-z-value {
            display: inline-block;
            font-weight: 600;
            margin-left: 5px;
        }

        .apexcharts-tooltip-text-z-label:empty,
        .apexcharts-tooltip-text-z-value:empty {
            display: none;
        }

        .apexcharts-tooltip-text-value,
        .apexcharts-tooltip-text-z-value {
            font-weight: 600;
        }

        .apexcharts-tooltip-marker {
            width: 12px;
            height: 12px;
            position: relative;
            top: 0px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .apexcharts-tooltip-series-group {
            padding: 0 10px;
            display: none;
            text-align: left;
            justify-content: left;
            align-items: center;
        }

        .apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
            opacity: 1;
        }

        .apexcharts-tooltip-series-group.apexcharts-active,
        .apexcharts-tooltip-series-group:last-child {
            padding-bottom: 4px;
        }

        .apexcharts-tooltip-series-group-hidden {
            opacity: 0;
            height: 0;
            line-height: 0;
            padding: 0 !important;
        }

        .apexcharts-tooltip-y-group {
            padding: 6px 0 5px;
        }

        .apexcharts-tooltip-candlestick {
            padding: 4px 8px;
        }

        .apexcharts-tooltip-candlestick>div {
            margin: 4px 0;
        }

        .apexcharts-tooltip-candlestick span.value {
            font-weight: bold;
        }

        .apexcharts-tooltip-rangebar {
            padding: 5px 8px;
        }

        .apexcharts-tooltip-rangebar .category {
            font-weight: 600;
            color: #777;
        }

        .apexcharts-tooltip-rangebar .series-name {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .apexcharts-xaxistooltip {
            opacity: 0;
            padding: 9px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
            transition: 0.15s ease all;
        }

        .apexcharts-xaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .apexcharts-xaxistooltip:after,
        .apexcharts-xaxistooltip:before {
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-xaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-left: -6px;
        }

        .apexcharts-xaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-left: -7px;
        }

        .apexcharts-xaxistooltip-bottom:after,
        .apexcharts-xaxistooltip-bottom:before {
            bottom: 100%;
        }

        .apexcharts-xaxistooltip-top:after,
        .apexcharts-xaxistooltip-top:before {
            top: 100%;
        }

        .apexcharts-xaxistooltip-bottom:after {
            border-bottom-color: #ECEFF1;
        }

        .apexcharts-xaxistooltip-bottom:before {
            border-bottom-color: #90A4AE;
        }

        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after {
            border-bottom-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
            border-bottom-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-top:after {
            border-top-color: #ECEFF1
        }

        .apexcharts-xaxistooltip-top:before {
            border-top-color: #90A4AE;
        }

        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:after {
            border-top-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
            border-top-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip.apexcharts-active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-yaxistooltip {
            opacity: 0;
            padding: 4px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
        }

        .apexcharts-yaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .apexcharts-yaxistooltip:after,
        .apexcharts-yaxistooltip:before {
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-yaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-top: -6px;
        }

        .apexcharts-yaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-top: -7px;
        }

        .apexcharts-yaxistooltip-left:after,
        .apexcharts-yaxistooltip-left:before {
            left: 100%;
        }

        .apexcharts-yaxistooltip-right:after,
        .apexcharts-yaxistooltip-right:before {
            right: 100%;
        }

        .apexcharts-yaxistooltip-left:after {
            border-left-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-left:before {
            border-left-color: #90A4AE;
        }

        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:after {
            border-left-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
            border-left-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-right:after {
            border-right-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-right:before {
            border-right-color: #90A4AE;
        }

        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:after {
            border-right-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
            border-right-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip.apexcharts-active {
            opacity: 1;
        }

        .apexcharts-yaxistooltip-hidden {
            display: none;
        }

        .apexcharts-xcrosshairs,
        .apexcharts-ycrosshairs {
            pointer-events: none;
            opacity: 0;
            transition: 0.15s ease all;
        }

        .apexcharts-xcrosshairs.apexcharts-active,
        .apexcharts-ycrosshairs.apexcharts-active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-ycrosshairs-hidden {
            opacity: 0;
        }

        .apexcharts-selection-rect {
            cursor: move;
        }

        .svg_select_boundingRect,
        .svg_select_points_rot {
            pointer-events: none;
            opacity: 0;
            visibility: hidden;
        }

        .apexcharts-selection-rect+g .svg_select_boundingRect,
        .apexcharts-selection-rect+g .svg_select_points_rot {
            opacity: 0;
            visibility: hidden;
        }

        .apexcharts-selection-rect+g .svg_select_points_l,
        .apexcharts-selection-rect+g .svg_select_points_r {
            cursor: ew-resize;
            opacity: 1;
            visibility: visible;
        }

        .svg_select_points {
            fill: #efefef;
            stroke: #333;
        }

        .apexcharts-svg.apexcharts-zoomable.hovering-zoom {
            cursor: crosshair
        }

        .apexcharts-svg.apexcharts-zoomable.hovering-pan {
            cursor: move
        }

        .apexcharts-zoom-icon,
        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon,
        .apexcharts-reset-icon,
        .apexcharts-pan-icon,
        .apexcharts-selection-icon,
        .apexcharts-menu-icon,
        .apexcharts-toolbar-custom-icon {
            cursor: pointer;
            width: 20px;
            height: 20px;
            line-height: 24px;
            color: #6E8192;
            text-align: center;
        }

        .apexcharts-zoom-icon svg,
        .apexcharts-zoomin-icon svg,
        .apexcharts-zoomout-icon svg,
        .apexcharts-reset-icon svg,
        .apexcharts-menu-icon svg {
            fill: #6E8192;
        }

        .apexcharts-selection-icon svg {
            fill: #444;
            transform: scale(0.76)
        }

        .apexcharts-theme-dark .apexcharts-zoom-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomin-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomout-icon svg,
        .apexcharts-theme-dark .apexcharts-reset-icon svg,
        .apexcharts-theme-dark .apexcharts-pan-icon svg,
        .apexcharts-theme-dark .apexcharts-selection-icon svg,
        .apexcharts-theme-dark .apexcharts-menu-icon svg,
        .apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg {
            fill: #f3f4f5;
        }

        .apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg {
            fill: #008FFB;
        }

        .apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
        .apexcharts-theme-light .apexcharts-zoomout-icon:hover svg,
        .apexcharts-theme-light .apexcharts-reset-icon:hover svg,
        .apexcharts-theme-light .apexcharts-menu-icon:hover svg {
            fill: #333;
        }

        .apexcharts-selection-icon,
        .apexcharts-menu-icon {
            position: relative;
        }

        .apexcharts-reset-icon {
            margin-left: 5px;
        }

        .apexcharts-zoom-icon,
        .apexcharts-reset-icon,
        .apexcharts-menu-icon {
            transform: scale(0.85);
        }

        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon {
            transform: scale(0.7)
        }

        .apexcharts-zoomout-icon {
            margin-right: 3px;
        }

        .apexcharts-pan-icon {
            transform: scale(0.62);
            position: relative;
            left: 1px;
            top: 0px;
        }

        .apexcharts-pan-icon svg {
            fill: #fff;
            stroke: #6E8192;
            stroke-width: 2;
        }

        .apexcharts-pan-icon.apexcharts-selected svg {
            stroke: #008FFB;
        }

        .apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
            stroke: #333;
        }

        .apexcharts-toolbar {
            position: absolute;
            z-index: 11;
            max-width: 176px;
            text-align: right;
            border-radius: 3px;
            padding: 0px 6px 2px 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .apexcharts-menu {
            background: #fff;
            position: absolute;
            top: 100%;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px;
            right: 10px;
            opacity: 0;
            min-width: 110px;
            transition: 0.15s ease all;
            pointer-events: none;
        }

        .apexcharts-menu.apexcharts-menu-open {
            opacity: 1;
            pointer-events: all;
            transition: 0.15s ease all;
        }

        .apexcharts-menu-item {
            padding: 6px 7px;
            font-size: 12px;
            cursor: pointer;
        }

        .apexcharts-theme-light .apexcharts-menu-item:hover {
            background: #eee;
        }

        .apexcharts-theme-dark .apexcharts-menu {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        @media screen and (min-width: 768px) {
            .apexcharts-canvas:hover .apexcharts-toolbar {
                opacity: 1;
            }
        }

        .apexcharts-datalabel.apexcharts-element-hidden {
            opacity: 0;
        }

        .apexcharts-pie-label,
        .apexcharts-datalabels,
        .apexcharts-datalabel,
        .apexcharts-datalabel-label,
        .apexcharts-datalabel-value {
            cursor: default;
            pointer-events: none;
        }

        .apexcharts-pie-label-delay {
            opacity: 0;
            animation-name: opaque;
            animation-duration: 0.3s;
            animation-fill-mode: forwards;
            animation-timing-function: ease;
        }

        .apexcharts-canvas .apexcharts-element-hidden {
            opacity: 0;
        }

        .apexcharts-hide .apexcharts-series-points {
            opacity: 0;
        }

        .apexcharts-gridline,
        .apexcharts-annotation-rect,
        .apexcharts-tooltip .apexcharts-marker,
        .apexcharts-area-series .apexcharts-area,
        .apexcharts-line,
        .apexcharts-zoom-rect,
        .apexcharts-toolbar svg,
        .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-radar-series path,
        .apexcharts-radar-series polygon {
            pointer-events: none;
        }


        /* markers */

        .apexcharts-marker {
            transition: 0.15s ease all;
        }

        @keyframes opaque {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }


        /* Resize generated styles */

        @keyframes resizeanim {
            from {
                opacity: 0;
            }

            to {
                opacity: 0;
            }
        }

        .resize-triggers {
            animation: 1ms resizeanim;
            visibility: hidden;
            opacity: 0;
        }

        .resize-triggers,
        .resize-triggers>div,
        .contract-trigger:before {
            content: " ";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        .resize-triggers>div {
            background: #eee;
            overflow: auto;
        }

        .contract-trigger:before {
            width: 200%;
            height: 200%;
        }

        @media screen and (min-width: 768px) {
            .noticeForMobilePos {
                display: none;
            }
        }
    </style>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }


        .styled-checkbox {
            /* position: absolute; */
            opacity: 0;
        }

        .styled-checkbox+label {
            position: relative;
            cursor: pointer;
            padding: 0;
        }

        .styled-checkbox+label:before {
            content: "";
            margin-right: 10px;
            display: inline-block;
            vertical-align: text-top;
            width: 30px;
            height: 30px;
            background: grey;
        }

        .styled-checkbox:hover+label:before {
            background: #f35429;
        }

        .styled-checkbox:focus+label:before {
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.12);
        }

        .styled-checkbox:checked+label:before {
            background: #f35429;
        }

        .styled-checkbox:disabled+label {
            color: #b8b8b8;
            cursor: auto;
        }

        .styled-checkbox:disabled+label:before {
            box-shadow: none;
            background: #ddd;
        }

        .styled-checkbox:checked+label:after {
            content: "";
            position: absolute;
            left: 5px;
            top: 9px;
            background: white;
            width: 4px;
            height: 4px;
            box-shadow: 2px 0 0 white, 4px 0 0 white, 4px -2px 0 white, 4px -4px 0 white, 4px -6px 0 white, 4px -8px 0 white;
            transform: rotate(50deg);
        }

        .unstyled {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        li {
            margin: 20px 0;
        }

        .centered {
            width: 300px;
            margin-left: 5px;
            text-align: left;
        }

        .title {
            text-align: center;
            color: #4571ec;
        }

        /* Increment and Decrement */

        .quantity {
            display: flex;
            align-items: center;
            margin-left: 8%;
            /* padding: 0; */
        }

        .quantity__minus,
        .quantity__plus {
            display: block;
            width: 70px;
            height: 70px;
            /* margin: 0; */
            background: #ffa259;
            text-decoration: none;
            text-align: center;
            line-height: 70px;
            font-size: 30px;
            border: 3px solid #ffa259;
        }

        .quantity__minus:hover,
        .quantity__plus:hover {
            background: #ffa697;
            color: #000000;
        }

        .quantity__minus {
            border-radius: 4px 0 0 4px;
        }

        .quantity__plus {
            border-radius: 0px 4px 4px 0px;
        }

        .quantity__input {
            width: 130px;
            height: 70px;
            /* margin: 0;
            padding: 0; */
            text-align: center;
            border-top: 3px solid #ffa259;
            border-bottom: 3px solid #ffa259;
            background: transparent;
            color: #2c2c2f;
            font-size: 22px;
        }

        .quantity__minus:link,
        .quantity__plus:link {
            color: #232323;
        }

        .quantity__minus:visited,
        .quantity__plus:visited {
            color: #fff;
        }

        .ul-table {
            max-width: 100%;
            /* background-color: yellow; */
            max-height: 500px;
            overflow-x: scroll;
            overflow-y: scroll;
        }

        .li-table {
            border: 1px solid #000000;
            padding: 6px 5px;
            display: inline-grid;
        }

        .optionsClass {
            display: inline-block;
            padding: 4px;
            margin: 2px;
            border: 1px solid black;
            background-color: rgba(255, 255, 255, .7);
        }

        .finishingButtons {
            height: 55px;
        }
    </style>
    <title>KONA POS</title>
</head>

<body cz-shortcut-listen="true" class=""><noscript class="">You need to enable JavaScript to run this app.</noscript>
    <div id="kona">
        <div class="Toastify"></div>
        <header id="header" class="sticky-top">
            <div class="container-fluid">
                <div class="d-md-none">
                    <div class="row">
                        <div class="col-12">
                            <div class="fk-sm-nav" data-simplebar="init">
                                <div class="simplebar-track vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar"></div>
                                </div>
                                <div class="simplebar-track horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header><audio id="myAudio">
            <source src="assets/beep.mp3" type="audio/mpeg">
        </audio>
        <div class="d-none">
            <div></div>
        </div>
        <div class="d-none">
            <div></div>
        </div>
        <div class="modal fade" id="showCart" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header align-items-center">
                        <h3>Order details</h3><button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12"><span class="sm-text font-weight-bold text-uppercase font-italic">Order
                                    token: </span></div>
                        </div>
                        <div class="fk-sm-card__container t-mt-30">
                            <div class="fk-sm-card__content">
                                <h6 class="text-capitalize fk-sm-card__title t-mb-5">order items</h6>
                            </div>
                        </div>
                        <hr>
                        <ul class="t-list addons-list">
                            <div class="text-primary text-center font-weight-bold pt-2 xsm-text text-uppercase">Select
                                food item to add to the list</div>
                        </ul>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col"><span class="text-capitalize sm-text"> sub total </span></div>
                                    <div class="col text-center">:</div>
                                    <div class="col text-right"><span class="text-capitalize sm-text font-weight-bold"><span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">BDT
                                                0.00</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col"><span class="text-capitalize sm-text">VAT (10%)</span></div>
                                    <div class="col text-center">:</div>
                                    <div class="col text-right"><span class="text-capitalize sm-text font-weight-bold">BDT 0.00</span></div>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <div class="col"><span class="text-capitalize sm-text"> service </span></div>
                                    <div class="col text-center">:</div>
                                    <div class="col text-right"><span class="text-capitalize sm-text font-weight-bold"><input type="number" step="0.01" min="0" class="text-capitalize xsm-text d-inline-block font-weight-bold form-control rounded-0 text-right" value=""></span></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col"><span class="text-capitalize sm-text"> discount </span></div>
                                    <div class="col text-center">:</div>
                                    <div class="col text-right"><span class="text-capitalize sm-text font-weight-bold"><input type="number" step="0.01" min="0" class="text-capitalize xsm-text d-inline-block font-weight-bold form-control rounded-0 text-right" value=""></span></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col"><span class="text-capitalize sm-text font-weight-bold">total
                                            bill</span></div>
                                    <div class="col text-center">:</div>
                                    <div class="col text-right"><span class="text-capitalize sm-text font-weight-bold">BDT 0.00</span></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row py-2 mx-1"><button type="button" class="btn btn-secondary xsm-text text-uppercase col-3">Cancel</button><button type="button" class="btn btn-primary xsm-text text-uppercase ml-auto mr-1 col-4">settle</button><button type="button" class="btn btn-success xsm-text text-uppercase col-4">submit</button></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="extraInfo" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header align-items-center">
                        <div class="fk-sm-card__content">
                            <h5 class="text-capitalize fk-sm-card__title">additional information</h5>
                        </div><button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="t-list addons-list">

                            <li class="addons-list__item mx-1 border border-2 rounded-lg">
                                <div class="btn-group w-100">
                                    <button type="button" class="fk-right-nav__guest-btn btn w-100 t-bg-white dropdown-toggle new-customer-pos xsm-text pl-2" data-toggle="dropdown" aria-expanded="">+ Customer?</button>
                                    <ul class="dropdown-menu w-100 border-0 pt-4 change-background">
                                        <li><input type="text" name="name" class="form-control font-10px rounded-lg" placeholder="Name" autocomplete="off" value=""></li>
                                        <li class="pb-2"><input type="text" name="number" class="form-control font-10px mt-2 rounded-lg" autocomplete="off" placeholder="Number" value=""></li>
                                        <li class="pb-1 text-right"><button class="btn t-bg-white text-dark xsm-text text-uppercase btn-sm py-0 px-2 mr-1">Cancel</button>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="addons-list__item mx-1">
                                <div class="xsm-text css-2b097c-container">
                                    <div class="select__control css-yk16xz-control">
                                        <div class="select__value-container css-1hwfws3">
                                            <div class="select__placeholder css-1wa3eu0-placeholder" style="opacity: 1; transition: opacity 1ms ease 0s;">Dept tag..</div>
                                            <div class="css-1g6gooi">
                                                <div class="select__input" style="display: inline-block;"><input autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-43-input" spellcheck="" tabindex="0" type="text" aria-autocomplete="list" value="" style="box-sizing: content-box; width: 2px; background: 0px center; border: 0px; font-size: inherit; opacity: 1; outline: 0px; padding: 0px; color: inherit;">
                                                    <div style="position: absolute; top: 0px; left: 0px; visibility: hidden; height: 0px; overflow: scroll; white-space: pre; font-size: 12px; font-family: Roboto, sans-serif; font-weight: 400; font-style: normal; letter-spacing: normal; text-transform: none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select__indicators css-1wy0on6"><span class="select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                                            <div aria-hidden="true" class="select__indicator select__dropdown-indicator css-tlfecz-indicatorContainer">
                                                <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="" class="css-19bqh2r">
                                                    <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="addons-list__item mx-1 payment-type-parent ">
                                <div class="xsm-text css-2b097c-container">
                                    <div class="select__control css-yk16xz-control">
                                        <div class="select__value-container select__value-container--is-multi css-1hwfws3">
                                            <div class="select__placeholder css-1wa3eu0-placeholder" style="opacity: 1; transition: opacity 260ms ease 0s;">Payments..</div>
                                            <div class="css-1g6gooi">
                                                <div class="select__input" style="display: inline-block;"><input autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-44-input" spellcheck="" tabindex="0" type="text" aria-autocomplete="list" value="" style="box-sizing: content-box; width: 2px; background: 0px center; border: 0px; font-size: inherit; opacity: 1; outline: 0px; padding: 0px; color: inherit;">
                                                    <div style="position: absolute; top: 0px; left: 0px; visibility: hidden; height: 0px; overflow: scroll; white-space: pre; font-size: 12px; font-family: Roboto, sans-serif; font-weight: 400; font-style: normal; letter-spacing: normal; text-transform: none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select__indicators css-1wy0on6"><span class="select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                                            <div aria-hidden="true" class="select__indicator select__dropdown-indicator css-tlfecz-indicatorContainer">
                                                <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="" class="css-19bqh2r">
                                                    <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="addons-list__item mx-1">
                                <div class="xsm-text css-2b097c-container">
                                    <div class="select__control css-yk16xz-control">
                                        <div class="select__value-container css-1hwfws3">
                                            <div class="select__placeholder css-1wa3eu0-placeholder" style="opacity: 1; transition: opacity 1ms ease 0s;">Table..</div>
                                            <div class="css-1g6gooi">
                                                <div class="select__input" style="display: inline-block;"><input autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-45-input" spellcheck="" tabindex="0" type="text" aria-autocomplete="list" value="" style="box-sizing: content-box; width: 2px; background: 0px center; border: 0px; font-size: inherit; opacity: 1; outline: 0px; padding: 0px; color: inherit;">
                                                    <div style="position: absolute; top: 0px; left: 0px; visibility: hidden; height: 0px; overflow: scroll; white-space: pre; font-size: 12px; font-family: Roboto, sans-serif; font-weight: 400; font-style: normal; letter-spacing: normal; text-transform: none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select__indicators css-1wy0on6"><span class="select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                                            <div aria-hidden="true" class="select__indicator select__dropdown-indicator css-tlfecz-indicatorContainer">
                                                <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="" class="css-19bqh2r">
                                                    <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="addons-list__item mx-1">
                                <div class="xsm-text css-2b097c-container">
                                    <div class="select__control css-yk16xz-control">
                                        <div class="select__value-container css-1hwfws3">
                                            <div class="select__placeholder css-1wa3eu0-placeholder" style="opacity: 1; transition: opacity 1ms ease 0s;">Waiter..</div>
                                            <div class="css-1g6gooi">
                                                <div class="select__input" style="display: inline-block;"><input autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-46-input" spellcheck="" tabindex="0" type="text" aria-autocomplete="list" value="" style="box-sizing: content-box; width: 2px; background: 0px center; border: 0px; font-size: inherit; opacity: 1; outline: 0px; padding: 0px; color: inherit;">
                                                    <div style="position: absolute; top: 0px; left: 0px; visibility: hidden; height: 0px; overflow: scroll; white-space: pre; font-size: 12px; font-family: Roboto, sans-serif; font-weight: 400; font-style: normal; letter-spacing: normal; text-transform: none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select__indicators css-1wy0on6"><span class="select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                                            <div aria-hidden="true" class="select__indicator select__dropdown-indicator css-tlfecz-indicatorContainer">
                                                <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="" class="css-19bqh2r">
                                                    <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="addons-list__item mx-1"><input type="number" class="form-control xsm-text py-2 pl-2" min="1" placeholder="Total guests.."></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <main id="main" data-simplebar="init">
            <div class="simplebar-track vertical" style="visibility: hidden;">
                <div class="simplebar-scrollbar"></div>
            </div>
            <div class="simplebar-track horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar"></div>
            </div>
            <div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;">
                <div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">

                    <div class="noticeForMobilePos">
                        <h2 class="text-center">Please Take Orders on a Tablet or Desktop in Landscape Mode</h2>
                    </div>

                    <div class="fk-main d-none d-md-block t-mt-10">
                        <div class="container-fluid">
                            <div class="row gx-2">
                                <div class="col-md-7">
                                    <div class="fk-left-over">
                                        <div class="row gx-2 align-items-center">
                                            <div class="col-md-4 col-lg-5 col-xl-6 col-xxl-7">
                                                <div class="input-group"><button class="btn btn-primary" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                    <div class="form-file"><input type="text" class="form-control border-0 form-control--light-2 rounded-0" placeholder="Search by name, group.."></div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                                                <div class="row align-items-center gx-2">
                                                    <div class="col"><a class="t-link t-pt-8 t-pb-8 t-pl-12 t-pr-12 btn btn-success xsm-text text-uppercase text-center w-100" href="#">Settled</a></div>
                                                    <div class="col"><a class="t-link t-pt-8 t-pb-8 t-pl-12 t-pr-12 btn btn-primary xsm-text text-uppercase text-center w-100" href="#">Submitted</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row t-mt-10 gx-2">
                                            <div class="col-md-4 col-xl-3">
                                                <div class="fk-scroll--pos-menu" data-simplebar="init">
                                                    <div class="simplebar-track vertical" style="visibility: hidden;">
                                                        <div class="simplebar-scrollbar"></div>
                                                    </div>
                                                    <div class="simplebar-track horizontal" style="visibility: hidden;">
                                                        <div class="simplebar-scrollbar"></div>
                                                    </div>
                                                    <div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;">
                                                        <div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">
                                                            <ul class="t-list fk-pos-nav list-group">
                                                                <li class="fk-pos-nav__list">
                                                                    <button type="button" class="w-100 t-text-dark t-heading-font btn btn-outline-danger font-weight-bold text-uppercase null" onclick="sortProduct('All');">
                                                                        All
                                                                    </button>
                                                                    <?php
                                                                    $subCategories = getAllDataOfProductSubCategoryTable("");
                                                                    foreach ($subCategories as $key => $value) {
                                                                        if (preg_match('~[0-9]+~', $subCategories[$key]['name'])) {
                                                                            $className = "cat-" . strtolower(str_replace(" ", "-", "special char" . $subCategories[$key]['id']));
                                                                        } else {
                                                                            $className = "cat-" . strtolower(str_replace(" ", "-", $subCategories[$key]['name']));
                                                                        }
                                                                    ?>
                                                                        <button type="button" class="w-100 t-text-dark t-heading-font btn btn-outline-danger font-weight-bold text-uppercase null" onclick="sortProduct('<?php echo $className; ?>');">
                                                                            <?php echo $subCategories[$key]['name']; ?>
                                                                        </button>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-xl-9">
                                                <form action="addtocartpos.php" id="productForm" method="POST">
                                                    <input type="hidden" id="productId" value="0" name="productId">
                                                    <input type="hidden" name="tableIdNo" value="0" id="tableIdNo">
                                                    <div class="">
                                                        <div class="active" id="nav-1">
                                                            <div class="row gx-1">
                                                                <div class="col-xl-6 col-xxl-5 order-xl-2">
                                                                    <div class="tab-content t-mb-10 mb-xl-0">
                                                                        <div class="" id="addons-1">
                                                                            <div class="t-bg-white">
                                                                                <div class="fk-addons-variation" data-simplebar="init">
                                                                                    <div class="simplebar-track vertical" style="visibility: hidden;">
                                                                                        <div class="simplebar-scrollbar">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="simplebar-track horizontal" style="visibility: hidden;">
                                                                                        <div class="simplebar-scrollbar">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;">
                                                                                        <div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">
                                                                                            <div class="fk-addons-table">

                                                                                                <div class="fk-addons-table__head text-center" id="productName">
                                                                                                    Product
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="fk-addons-table__head text-center">
                                                                                                    Quantity
                                                                                                </div>
                                                                                                <div class="fk-addons-table__info py-4">
                                                                                                    <div class="row g-0">
                                                                                                        <div class="col-12 text-center border-right">
                                                                                                            <div class="quantity">
                                                                                                                <a href="#" class="quantity__minus"><span>-</span></a>
                                                                                                                <input name="productQuntity" type="text" class="quantity__input" value="1" id="productQuantity">
                                                                                                                <a href="#" class="quantity__plus"><span>+</span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="fk-addons-table__head text-center">
                                                                                                    Size
                                                                                                </div>
                                                                                                <div class="fk-addons-table__info py-4">
                                                                                                    <div class="row g-0">
                                                                                                        <div class="col-12 text-center border-right" id="sizeHolder">

                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="fk-addons-table__head text-center">
                                                                                                    Addons & Options
                                                                                                </div>
                                                                                                <div class="fk-addons-table__info py-4">
                                                                                                    <div class="row g-0">
                                                                                                        <div class="col-12 text-center border-right" id="optionHolder">




                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="d-none"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6 col-xxl-7 order-xl-1">
                                                                    <div class="fk-dish--scroll" data-simplebar="init">
                                                                        <div class="simplebar-track vertical" style="visibility: hidden;">
                                                                            <div class="simplebar-scrollbar" style="top: 2px; height: 246px;"></div>
                                                                        </div>
                                                                        <div class="simplebar-track horizontal" style="visibility: visible;">
                                                                            <div class="simplebar-scrollbar" style="left: 2px; width: 472px;"></div>
                                                                        </div>
                                                                        <div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;">

                                                                            <div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">
                                                                                <div class="list-group fk-dish row gx-2">

                                                                                    <?php
                                                                                    $products = getAllDataOfProductTable(" Order By name");
                                                                                    foreach ($products as $key => $value) {
                                                                                        $subCI = getProductSubCategoryDetailsFromId($products[$key]['sub_category_id']);
                                                                                        //$className2 = "cat-" . strtolower(str_replace(" ", "-", $subCI['name']));

                                                                                        if (preg_match('~[0-9]+~', $subCI['name'])) {
                                                                                            $className2 = "cat-" . strtolower(str_replace(" ", "-", "special char" . $products[$key]['sub_category_id']));
                                                                                        } else {
                                                                                            $className2 = "cat-" . strtolower(str_replace(" ", "-", $subCI['name']));
                                                                                        }
                                                                                    ?>


                                                                                        <!-- single product start here -->
                                                                                        <div class="single-product t-mb-10 col-md-6 col-lg-4 col-xl-6 col-xxl-4 border-0 <?php echo $className2; ?>" style="cursor: pointer;" onclick="loadSizes('<?php echo $products[$key]['id'] ?>', '<?php echo $products[$key]['name'] ?>-৳<?php echo getStartingPriceFromProductId($products[$key]['id']); ?>'); changeBgColor(this);">
                                                                                            <div class="fk-dish-card w-100">
                                                                                                <div class="fk-dish-card__img w-100">
                                                                                                    <img src="../images/<?php echo $products[$key]['photo']; ?>" alt="" class="img-fluid m-auto w-100">
                                                                                                </div>
                                                                                                <span class="fk-dish-card__title text-center text-uppercase" style="height: 110px;">
                                                                                                    <?php echo $products[$key]['name'] ?><br>৳<?php echo getStartingPriceFromProductId($products[$key]['id']); ?>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- single product start here -->
                                                                                    <?php
                                                                                    }
                                                                                    ?>

                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row gx-2">
                                        <div class="col-md-4 col-xl-3">
                                            <div class="fk-right-nav">
                                                <div class="row flex-column justify-content-between">
                                                <div class="col-12">
                                                        <label for="servedBy">Served By</label>
                                                        <select class="js-example-basic-single" id="servedBy" name="servedBy" onchange="clientSlected(this.value);">
                                                            <?php
                                                            $servedByDetails = getAllDataOfUserTable(" AND user_type = 2 OR user_type = 3 OR user_type = 4");

                                                            foreach ($servedByDetails as $key => $value) {
                                                            ?>
                                                                <option value="<?php echo $servedByDetails[$key]['id']; ?>">
                                                                    <?php echo $servedByDetails[$key]['full_name']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="clientId">Customer</label>
                                                        <select class="js-example-basic-single" id="clientId" name="clientId" onchange="clientSlected(this.value);">
                                                            <option value="73">
                                                                Walkin Guest
                                                            </option>
                                                            <option value="new">
                                                                Add New
                                                            </option>

                                                            <?php
                                                            $clientDetails = getAllDataOfClientTable("");

                                                            foreach ($clientDetails as $key => $value) {
                                                            ?>
                                                                <option value="<?php echo $clientDetails[$key]['id']; ?>">
                                                                    <?php echo $clientDetails[$key]['name']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>


                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <ul class="unstyled centered ul-table" id="tableHolder">
                                                            <?php
                                                            foreach ($_SESSION as $key => $index) {
                                                                if (strpos($key, "table") === 0) {
                                                                    if (count($_SESSION[$key]) > 0) {
                                                            ?>
                                                                        <li class="li-table" style="background-color: #ff114d;">
                                                                            <input class="styled-checkbox" id="ti<?php echo $key; ?>" type="radio" value="<?php echo substr($key, -2); ?>" name="tableId" onclick="reloadListPos(this.value)">
                                                                            <label for="ti<?php echo $key; ?>">T-<?php echo substr($key, -2); ?></label>
                                                                        </li>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <li class="li-table" style="background-color: #47f347;">
                                                                            <input class="styled-checkbox" id="ti<?php echo $key; ?>" type="radio" name="tableId" value="<?php echo substr($key, -2); ?>" onclick="reloadListPos(this.value)">
                                                                            <label for="ti<?php echo $key; ?>">T-<?php echo substr($key, -2); ?></label>
                                                                        </li>
                                                            <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    </form>
                                                    <div class="col-12">

                                                        <div class="col-12 t-mb-10">
                                                            <button class="w-100 btn font-weight-bold text-uppercase" onclick="submitForm();" style="height: 100px; font-size: xx-large; background-color: darkorange; color: cornsilk; border-radius: 25px;">
                                                                Add To List
                                                            </button>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-12"><button class="w-100 t-heading-font btn btn-primary font-weight-bold text-uppercase sm-text" onclick="cancelFunction();">cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-xl-9">
                                            <div class="fk-right-nav p-2 p-xl-3 t-bg-white">
                                                <div class="h-100 w-100 d-none" data-simplebar="init">
                                                    <div class="simplebar-track vertical" style="visibility: hidden;">
                                                        <div class="simplebar-scrollbar"></div>
                                                    </div>
                                                    <div class="simplebar-track horizontal" style="visibility: hidden;">
                                                        <div class="simplebar-scrollbar"></div>
                                                    </div>
                                                    <div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;">
                                                        <div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">
                                                            <div class="fk-receipt-content">
                                                                <div class="fk-receipt-body t-mt-10">
                                                                    <div class="row">
                                                                        <div class="col-6"><button type="button" class="btn btn-primary w-100 xsm-text text-uppercase">settle</button>
                                                                        </div>
                                                                        <div class="col-6"><button type="button" class="btn btn-success w-100 xsm-text text-uppercase">submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="h-100 w-100 d-none d-md-block" id="listHolder">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer id="footer" class="sicky-bottom">
            <div class="container-fluid">
                <div class="row align-items-lg-center">
                    <div class="col-lg-2 t-mb- mb-lg-0">
                        <div class="fk-brand--footer fk-brand--footer-sqr mx-auto mr-lg-auto ml-lg-0"><a class="t-link w-100 t-h-50 active" href="#" aria-current="page"><span class="fk-brand--footer-img fk-brand__img--fk" style="background-color: rgb(255, 255, 255); background-image: url(../images/16071590237441.webp);"></span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7 t-mb-0 mb-lg-0">
                        <p class="mb-0 text-center sm-text">© KONA || All rights reserved</p>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="clock" style="background-color: rgb(208, 2, 27);">
                            <div class="clock__icon t-mr-30"><span class="far fa-clock" style="color: #000000; "></span>
                            </div>
                            <div class="clock__content">
                                <div id="MyClockDisplay" class="clockDisply" style="color: rgb(255, 255, 255);">Time
                                </div>
                                <p id="datePlaceholder" class="mb-0 font-10px  text-center font-weight-normal" style="color: rgb(255, 255, 255);">Date</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- <script src="assets/simplebar.js"></script> -->
    <!-- <script src="assets/feather.js"></script> -->
    <!-- <script src="assets/anime-mouse-move.js"></script> -->
    <!-- <script src="assets/main.js"></script> -->
    <script>
        var d = new Date();
        document.getElementById("datePlaceholder").innerHTML = d.toDateString();
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        function showTime() {
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";

            if (h == 0) {
                h = 12;
            }

            if (h > 12) {
                h = h - 12;
                session = "PM";
            }

            h = h < 10 ? "0" + h : h;
            m = m < 10 ? "0" + m : m;
            s = s < 10 ? "0" + s : s;

            var time = h + ":" + m + ":" + s + " " + session;
            var clockDisplay = $("#MyClockDisplay");
            if (clockDisplay.length) {
                document.getElementById("MyClockDisplay").innerText = time;
                document.getElementById("MyClockDisplay").textContent = time;
            }

            setTimeout(showTime, 1000);
        }

        showTime();
    </script>
    <script>
        function sortProduct(className) {
            <?php
            echo "var classNamesJS = " . $classNamesJS . ";\n";
            ?>

            if (className != "All") {
                classNamesJS.forEach(hideAll);
                $("." + className).show("fast", "linear");
            } else {
                classNamesJS.forEach(showAll);
            }
        }

        function hideAll(item, index) {
            $("." + item).hide("fast", "swing");
        }

        function showAll(item, index) {
            $("." + item).show("fast", "swing");
        }

        function removeOption(arrayName, outereArrayIndex, innerArrayIndex) {


            swal("This Option Will Be Introduced Soon ! For Now, Remove The Whole Item Please !", {
                icon: "error",
            });


            // var tableId = $('#tableIdNo').val();

            // $.ajax({
            //         method: "post",
            //         url: '../ajaxfunctions.php',
            //         //url: 'test.php',
            //         data: {
            //             funName: "removeSingleOption",
            //             tableId: tableId,
            //             arrayName: arrayName,
            //             outereArrayIndex: outereArrayIndex,
            //             innerArrayIndex: innerArrayIndex
            //         }
            //     })
            //     .done(function(response) {
            //         alert(response);
            //         reloadListPos();
            //     });
        }

        var orderId = 0;

        function finalFunctions(buttonName) {
            var tableId = $('#tableIdNo').val();
            var totalBill = $('#totalBill').val();
            var shownBill = $('#shownBill').html();
            var discountAmount = totalBill - shownBill;
            if (buttonName == "kot") {
                printKot(tableId);
            } else if (buttonName == "print") {
                printBill(tableId, discountAmount)
            } else if (buttonName == "saveprint") {
                $.ajax({
                    url: saveFinal(1),
                    success: function() {
                        var url = "../print/bill.php?orderId=" + orderId;
                        window.open(url, '_blank');
                    }
                });
                reloadListPos();
                reloadTableList(tableId);
            } else if (buttonName == "saveclear") {
                $.ajax({
                    url: saveFinal(1),
                    success: function() {
                        var url = "../print/bill.php?orderId=" + orderId;
                        window.open(url, '_blank');
                    }
                });
                reloadListPos();
                reloadTableList(tableId);
            } else {
                alert("Network Issues ! Solve It Please !");
            }
        }

        function printBill(tableId, discountAmount) {
            var url = "../print/posbill.php?tableId=" + tableId + "&&discountAmount=" + discountAmount;
            window.open(url, '_blank');
        }

        function printKot(tableId) {
            var url = "../print/poskot.php?tableId=" + tableId;
            window.open(url, '_blank');
        }


        function saveFinal(returnValue = 0) {
            var tableId = $('#tableIdNo').val();
            var totalBill = $('#totalBill').val();
            var shownBill = $('#shownBill').html();
            var discountAmount = totalBill - shownBill;
            var paymentMethod = $('#paymentMethod').val();
            var clientId = $('#clientId').val();
            var servedBy = $('#servedBy').val();

            $.ajax({

                    method: "post",
                    url: 'saveOrderPos.php',
                    data: {
                        funName: "perfectOrder",
                        tableId: tableId,
                        discountAmount: discountAmount,
                        paymentMethod: paymentMethod,
                        clientId: clientId,
                        servedBy: servedBy
                    }
                })
                .done(function(response) {
                    if (response != null) {
                        var uniqueOrderId = parseInt(response);
                        if (returnValue) {
                            orderId = uniqueOrderId;
                            return uniqueOrderId;
                        } else {
                            reloadListPos();
                            reloadTableList(tableId);
                        }
                    } else {
                        swal("Could Not Save The Data !", {
                            icon: "error",
                        });
                    }


                });
        }

        function loadSizes(productId, productName) {
            //getProductSizesFromProductIdForPos

            $('#productName').html("<h4 style='color: #ffffff;'>" + productName + "</h4>");
            $('#productId').val(productId);
            $('#productQuantity').val("1");


            $.ajax({
                    method: "post",
                    url: '../ajaxfunctions.php',
                    data: {
                        funName: "getProductSizesFromProductIdForPos",
                        productId: productId
                    }
                })
                .done(function(response) {


                    if (response != null) {

                        $('#sizeHolder').html(response);
                        $('#optionHolder').html("");

                        var psi = document.getElementsByName("productSizeId");
                        if (psi.length == 1) {
                            $("input[name=productSizeId]").prop("checked", true);
                            var psiId = $('input[name=productSizeId]').attr('id');
                            var productSizeId = psiId.slice(5);
                            loadOptions(productId, productSizeId);
                        }

                    } else {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }


                });
        }

        function loadOptions(productId, productSizeId) {
            //getProductSizesFromProductIdForPos

            $.ajax({
                    method: "post",
                    url: '../ajaxfunctions.php',
                    data: {
                        funName: "getProductOtionDetailsFromSizeIdForPos",
                        productSizeId: productSizeId,
                        productId: productId
                    }
                })
                .done(function(response) {


                    if (response != null) {

                        $('#optionHolder').html(response);

                    } else {
                        $('#optionHolder').html("No Options");
                    }


                });
        }

        $(document).ready(function() {
            const minus = $('.quantity__minus');
            const plus = $('.quantity__plus');
            const input = $('.quantity__input');
            minus.click(function(e) {
                e.preventDefault();
                var value = input.val();
                if (value > 1) {
                    value--;
                }
                input.val(value);
            });

            plus.click(function(e) {
                e.preventDefault();
                var value = input.val();
                value++;
                input.val(value);
            })
        });

        function changeBgColor(divObj) {
            var x = document.getElementsByClassName("single-product");
            x.style.background = "#000000";
            divObj.style.background = "#000000";
        }

        function submitForm() {
            var tableId = $('#tableIdNo').val();
            var clientId = $('#clientId').val();
            var productId = $('#productId').val();

            if (clientId == 'new' || clientId == 'none') {
                alert("Customer Not Selected !");
            } else if (productId == "0") {
                alert("No Product Found !");
            } else if (tableId == "0") {
                alert("Table Not Selected !");
            } else {
                $("#productForm").submit();
            }
        }

        $("#productForm").submit(function(e) {

            $('#tableIdNo').val($("input[name='tableId']:checked").val());
            var tableId = $('#tableIdNo').val();

            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");

            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                success: function(data, textStatus, jqXHR) {
                    //data: return data from server
                    //alert(data);
                    reloadListPos();
                    //swal("Added to Table-" + tableId, "", "warning");
                    swal({
                        title: "Added to Table-" + tableId,
                        text: "",
                        icon: "success",
                        timer: 1000
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //if fails   
                    alert('Issues With Your Network, Please Check !');
                }
            });
            event.preventDefault();
            e.unbind();
        });

        function clientSlected(id) {
            if (id == 'new') {
                $('#showCart').modal('show');
            }
        }

        function cancelFunction() {
            $('input[name="tableId"]').checked = false;
        }

        function discountPressed(discountAmount) {
            console.log(discountAmount);
            var showBill = 0;
            var totalBill = $('#totalBill').val();
            var discountType = $('#discountType').val();
            if (discountType == "direct") {
                showBill = totalBill - discountAmount;
            } else {
                showBill = totalBill - ((totalBill * discountAmount) / 100);
            }

            showBill = showBill.toFixed(2);

            $('#shownBill').html(showBill);
        }

        function cartUpdate(productId, productSizeId, productOptionIds, productAddonIds, subCategoryAddonIds, productQuantity) {


            var tableId = $('#tableIdNo').val();

            $.ajax({
                    method: "post",
                    url: 'addtocartpos.php',
                    data: {
                        tableIdNo: tableId,
                        productId: productId,
                        productSizeId: productSizeId,
                        productOptionIds: productOptionIds,
                        productAddonIds: productAddonIds,
                        subCategoryAddonIds: subCategoryAddonIds,
                        productQuntity: productQuantity,
                        updateFrom: "cartPage"
                    }
                })
                .done(function(response) {
                    reloadListPos();
                    //alert(response);
                });
        }

        function reloadListPos(tableId = "") {
            //alert(tableId);
            if (tableId == "") {
                tableId = $("input[name='tableId']:checked").val();
            }

            $('#tableIdNo').val(tableId);


            $.ajax({
                    method: "post",
                    url: '../ajaxfunctions.php',
                    data: {
                        funName: "reloadListPos",
                        tableId: tableId
                    }
                })
                .done(function(response) {

                    if (response != null) {

                        $('#listHolder').html(response);
                        reloadTableList(tableId);
                        $("input[name='tableId']").val(["" + tableId]);
                        $('#listHolder').scrollTop($('#listHolder').height());

                    } else {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }


                });

        }

        function removeSingleCartItemPos(tableId, productId, productSizeId, productOptionIds, productAddonIds, subCategoryAddonIds) {
            $.ajax({
                    method: "post",
                    url: '../ajaxfunctions.php',
                    data: {
                        funName: "deleteSingleItemFromCartPos",
                        tableId: tableId,
                        productId: productId,
                        productSizeId: productSizeId,
                        productOptionIds: productOptionIds,
                        productAddonIds: productAddonIds,
                        subCategoryAddonIds: subCategoryAddonIds
                    }
                })
                .done(function(response) {
                    $('#listHolder').html(response);
                });
        }

        function reloadTableList(tableId) {
            $.ajax({
                    method: "post",
                    url: '../ajaxfunctions.php',
                    data: {
                        funName: "reloadTableList"
                    }
                })
                .done(function(response) {
                    $('#tableHolder').html(response);
                    $("input[name='tableId']").val(["" + tableId]);
                });
        }
    </script>
</body>

</html>