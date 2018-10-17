/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/*!***********************!*\
  !*** ./src/blocks.js ***!
  \***********************/
/*! no exports provided */
/*! all exports used */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("Object.defineProperty(__webpack_exports__, \"__esModule\", { value: true });\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__timeline_timeline_js__ = __webpack_require__(/*! ./timeline/timeline.js */ 1);\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy9ibG9ja3MuanM/N2I1YiJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgJy4vdGltZWxpbmUvdGltZWxpbmUuanMnO1xuXG5cbi8vLy8vLy8vLy8vLy8vLy8vL1xuLy8gV0VCUEFDSyBGT09URVJcbi8vIC4vc3JjL2Jsb2Nrcy5qc1xuLy8gbW9kdWxlIGlkID0gMFxuLy8gbW9kdWxlIGNodW5rcyA9IDAiXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7Iiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///0\n");

/***/ }),
/* 1 */
/*!**********************************!*\
  !*** ./src/timeline/timeline.js ***!
  \**********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__style_scss__ = __webpack_require__(/*! ./style.scss */ 2);\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__style_scss___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__style_scss__);\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__editor_scss__ = __webpack_require__(/*! ./editor.scss */ 3);\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__editor_scss___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__editor_scss__);\n/**\n * BLOCK: timeline\n *\n * Registering a basic block with Gutenberg.\n * Simple block, renders and saves the same content without any interactivity.\n */\n\n//  Import CSS.\n\n\n\nvar __ = wp.i18n.__; // Import __() from wp.i18n\n\nvar registerBlockType = wp.blocks.registerBlockType; // Import registerBlockType() from wp.blocks\n\nvar _wp$components = wp.components,\n    Spinner = _wp$components.Spinner,\n    SelectControl = _wp$components.SelectControl;\nvar el = wp.element.createElement;\nvar withSelect = wp.data.withSelect;\n\n\nvar iconElement = el('svg', { width: 20, height: 20 }, el('path', { d: \"M5.173,16.49c-0.197,0.653 -0.812,1.135 -1.531,1.135c-0.876,0 -1.597,-0.714 -1.599,-1.582c-0.018,-0.733 0.491,-1.383 1.213,-1.547l0,-2.949c-0.732,-0.158 -1.258,-0.805 -1.258,-1.547c0,-0.742 0.526,-1.389 1.258,-1.547l0,-2.949c-0.722,-0.164 -1.231,-0.814 -1.213,-1.548c0.002,-0.868 0.723,-1.581 1.599,-1.581c0.662,0 1.236,0.408 1.477,0.983l1.819,0c0.004,-0.016 0.007,-0.031 0.011,-0.046c0.228,-0.883 1.066,-1.547 1.989,-1.582c1.183,-0.015 2.367,-0.022 3.551,-0.023l0.222,0.001c1.109,0.001 2.219,0.008 3.328,0.022c0.923,0.035 1.762,0.699 1.989,1.582c0.327,1.269 -0.722,2.588 -1.989,2.636c-1.183,0.015 -2.367,0.022 -3.55,0.023l-0.222,-0.001c-1.11,-0.001 -2.219,-0.008 -3.329,-0.022c-0.926,-0.035 -1.736,-0.75 -1.977,-1.627l-1.774,0l-0.002,0.045c-0.151,0.559 -0.605,1.007 -1.194,1.138l0,2.949c0.56,0.126 0.996,0.542 1.16,1.065l1.787,0c0.004,-0.015 0.007,-0.03 0.011,-0.045c0.228,-0.883 1.066,-1.547 1.989,-1.582c1.183,-0.015 2.367,-0.022 3.551,-0.023l0.222,0.001c1.109,0.001 2.219,0.008 3.328,0.022c0.923,0.035 1.762,0.699 1.989,1.582c0.327,1.269 -0.722,2.588 -1.989,2.636c-1.183,0.015 -2.367,0.022 -3.55,0.023l-0.222,-0.001c-1.11,-0.001 -2.219,-0.008 -3.329,-0.022c-0.926,-0.035 -1.736,-0.75 -1.977,-1.627l-1.81,0c-0.164,0.523 -0.6,0.939 -1.16,1.065l0,2.949c0.551,0.122 0.984,0.523 1.161,1.031l1.786,0c0.004,-0.015 0.007,-0.03 0.011,-0.045c0.228,-0.883 1.066,-1.547 1.989,-1.582c1.183,-0.015 2.367,-0.022 3.551,-0.023l0.222,0c1.109,0.001 2.219,0.009 3.328,0.023c0.923,0.035 1.762,0.699 1.989,1.582c0.327,1.269 -0.722,2.587 -1.989,2.636c-1.183,0.015 -2.367,0.022 -3.55,0.022l-0.222,0c-1.11,-0.001 -2.219,-0.008 -3.329,-0.022c-0.926,-0.036 -1.736,-0.75 -1.977,-1.628l-1.788,0Zm7.426,0.722c1.139,-0.009 2.278,-0.03 3.416,-0.044c0.498,-0.019 0.951,-0.37 1.086,-0.842c0.201,-0.709 -0.398,-1.467 -1.119,-1.477c-1.092,0 -2.183,-0.006 -3.275,-0.01l-0.218,0c-1.165,0.003 -2.329,0.01 -3.494,0.01c-0.72,0.01 -1.32,0.768 -1.118,1.477c0.134,0.472 0.587,0.823 1.085,0.842c1.175,0.015 2.351,0.037 3.527,0.044l0.11,0Zm-8.964,-1.862c0.4,0 0.725,0.325 0.725,0.725c0,0.401 -0.325,0.726 -0.725,0.726c-0.401,0 -0.726,-0.325 -0.726,-0.726c0,-0.4 0.325,-0.725 0.726,-0.725Zm8.964,-4.147c1.139,-0.008 2.278,-0.03 3.416,-0.044c0.498,-0.019 0.951,-0.37 1.086,-0.842c0.201,-0.709 -0.398,-1.467 -1.119,-1.476c-1.092,0 -2.183,-0.007 -3.275,-0.011l-0.218,0c-1.165,0.003 -2.329,0.011 -3.494,0.011c-0.72,0.009 -1.32,0.767 -1.118,1.476c0.134,0.472 0.587,0.823 1.085,0.842c1.175,0.015 2.351,0.037 3.527,0.045l0.11,-0.001Zm-8.964,-1.92c0.4,0 0.725,0.325 0.725,0.725c0,0.401 -0.325,0.726 -0.725,0.726c-0.401,0 -0.726,-0.325 -0.726,-0.726c0,-0.4 0.325,-0.725 0.726,-0.725Zm8.964,-4.241c1.139,-0.008 2.278,-0.03 3.416,-0.044c0.498,-0.019 0.951,-0.37 1.086,-0.842c0.201,-0.709 -0.398,-1.467 -1.119,-1.476c-1.092,0 -2.183,-0.007 -3.275,-0.011l-0.218,0c-1.165,0.003 -2.329,0.011 -3.494,0.011c-0.72,0.009 -1.32,0.767 -1.118,1.476c0.134,0.472 0.587,0.823 1.085,0.842c1.175,0.015 2.351,0.037 3.527,0.045l0.11,-0.001Zm-8.964,-1.849c0.4,0 0.725,0.325 0.725,0.725c0,0.4 -0.325,0.725 -0.725,0.725c-0.401,0 -0.726,-0.325 -0.726,-0.725c0,-0.4 0.325,-0.725 0.726,-0.725Z\" }));\n\n/**\n * Register our Timeline block.\n */\nregisterBlockType('wp-timeliner/timeline', {\n\ttitle: __('Timeline'),\n\ticon: iconElement,\n\tcategory: 'common',\n\tkeywords: [__('wp timeliner', 'wp-timeliner'), __('timeline', 'wp-timeliner'), __('event', 'wp-timeliner')],\n\tattributes: {\n\t\ttimelineId: {\n\t\t\ttype: 'number'\n\t\t},\n\t\ttimelineName: {\n\t\t\ttype: 'string'\n\t\t}\n\t},\n\tsupports: {\n\t\thtml: false\n\t},\n\n\tedit: withSelect(function (select) {\n\t\treturn {\n\t\t\ttimelines: select('core').getEntityRecords('taxonomy', 'wpt-timeline', { per_page: 100, hide_empty: true })\n\t\t};\n\t})(function (props) {\n\t\tvar attributes = props.attributes,\n\t\t    timelines = props.timelines,\n\t\t    className = props.className,\n\t\t    isSelected = props.isSelected,\n\t\t    setAttributes = props.setAttributes;\n\n\n\t\tif (!timelines) {\n\t\t\treturn wp.element.createElement(\n\t\t\t\t'p',\n\t\t\t\t{ className: className },\n\t\t\t\twp.element.createElement(Spinner, null),\n\t\t\t\t__('Loading timelines...', 'wp-timeliner')\n\t\t\t);\n\t\t}\n\t\tif (0 === timelines.length) {\n\t\t\treturn wp.element.createElement(\n\t\t\t\t'p',\n\t\t\t\tnull,\n\t\t\t\t__('No timeline to select... yet!', 'wp-timeliner')\n\t\t\t);\n\t\t}\n\n\t\tvar timelines_as_options = [];\n\n\t\ttimelines.map(function (timeline) {\n\t\t\tvar achievement_string = __('achievement', 'wp-timeliner');\n\t\t\tvar timeline_label = timeline.name + ' (' + timeline.count + ' ' + achievement_string + ')';\n\n\t\t\ttimelines_as_options.push({\n\t\t\t\tvalue: timeline.id,\n\t\t\t\tlabel: timeline_label\n\t\t\t});\n\t\t});\n\n\t\tprops.setAttributes({\n\t\t\ttimelineId: timelines_as_options[0].value\n\t\t});\n\n\t\tfunction onChange(value) {\n\t\t\treturn props.setAttributes({\n\t\t\t\ttimelineId: value\n\t\t\t});\n\t\t}\n\n\t\treturn wp.element.createElement(SelectControl, {\n\t\t\tlabel: __('Select timeline to display', 'wp-timeliner'),\n\t\t\tvalue: attributes.timelineId,\n\t\t\toptions: timelines_as_options,\n\t\t\tonChange: onChange\n\t\t});\n\t}),\n\tsave: function save(props) {\n\t\treturn null;\n\t}\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy90aW1lbGluZS90aW1lbGluZS5qcz85NjBmIl0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogQkxPQ0s6IHRpbWVsaW5lXG4gKlxuICogUmVnaXN0ZXJpbmcgYSBiYXNpYyBibG9jayB3aXRoIEd1dGVuYmVyZy5cbiAqIFNpbXBsZSBibG9jaywgcmVuZGVycyBhbmQgc2F2ZXMgdGhlIHNhbWUgY29udGVudCB3aXRob3V0IGFueSBpbnRlcmFjdGl2aXR5LlxuICovXG5cbi8vICBJbXBvcnQgQ1NTLlxuaW1wb3J0ICcuL3N0eWxlLnNjc3MnO1xuaW1wb3J0ICcuL2VkaXRvci5zY3NzJztcblxudmFyIF9fID0gd3AuaTE4bi5fXzsgLy8gSW1wb3J0IF9fKCkgZnJvbSB3cC5pMThuXG5cbnZhciByZWdpc3RlckJsb2NrVHlwZSA9IHdwLmJsb2Nrcy5yZWdpc3RlckJsb2NrVHlwZTsgLy8gSW1wb3J0IHJlZ2lzdGVyQmxvY2tUeXBlKCkgZnJvbSB3cC5ibG9ja3NcblxudmFyIF93cCRjb21wb25lbnRzID0gd3AuY29tcG9uZW50cyxcbiAgICBTcGlubmVyID0gX3dwJGNvbXBvbmVudHMuU3Bpbm5lcixcbiAgICBTZWxlY3RDb250cm9sID0gX3dwJGNvbXBvbmVudHMuU2VsZWN0Q29udHJvbDtcbnZhciBlbCA9IHdwLmVsZW1lbnQuY3JlYXRlRWxlbWVudDtcbnZhciB3aXRoU2VsZWN0ID0gd3AuZGF0YS53aXRoU2VsZWN0O1xuXG5cbnZhciBpY29uRWxlbWVudCA9IGVsKCdzdmcnLCB7IHdpZHRoOiAyMCwgaGVpZ2h0OiAyMCB9LCBlbCgncGF0aCcsIHsgZDogXCJNNS4xNzMsMTYuNDljLTAuMTk3LDAuNjUzIC0wLjgxMiwxLjEzNSAtMS41MzEsMS4xMzVjLTAuODc2LDAgLTEuNTk3LC0wLjcxNCAtMS41OTksLTEuNTgyYy0wLjAxOCwtMC43MzMgMC40OTEsLTEuMzgzIDEuMjEzLC0xLjU0N2wwLC0yLjk0OWMtMC43MzIsLTAuMTU4IC0xLjI1OCwtMC44MDUgLTEuMjU4LC0xLjU0N2MwLC0wLjc0MiAwLjUyNiwtMS4zODkgMS4yNTgsLTEuNTQ3bDAsLTIuOTQ5Yy0wLjcyMiwtMC4xNjQgLTEuMjMxLC0wLjgxNCAtMS4yMTMsLTEuNTQ4YzAuMDAyLC0wLjg2OCAwLjcyMywtMS41ODEgMS41OTksLTEuNTgxYzAuNjYyLDAgMS4yMzYsMC40MDggMS40NzcsMC45ODNsMS44MTksMGMwLjAwNCwtMC4wMTYgMC4wMDcsLTAuMDMxIDAuMDExLC0wLjA0NmMwLjIyOCwtMC44ODMgMS4wNjYsLTEuNTQ3IDEuOTg5LC0xLjU4MmMxLjE4MywtMC4wMTUgMi4zNjcsLTAuMDIyIDMuNTUxLC0wLjAyM2wwLjIyMiwwLjAwMWMxLjEwOSwwLjAwMSAyLjIxOSwwLjAwOCAzLjMyOCwwLjAyMmMwLjkyMywwLjAzNSAxLjc2MiwwLjY5OSAxLjk4OSwxLjU4MmMwLjMyNywxLjI2OSAtMC43MjIsMi41ODggLTEuOTg5LDIuNjM2Yy0xLjE4MywwLjAxNSAtMi4zNjcsMC4wMjIgLTMuNTUsMC4wMjNsLTAuMjIyLC0wLjAwMWMtMS4xMSwtMC4wMDEgLTIuMjE5LC0wLjAwOCAtMy4zMjksLTAuMDIyYy0wLjkyNiwtMC4wMzUgLTEuNzM2LC0wLjc1IC0xLjk3NywtMS42MjdsLTEuNzc0LDBsLTAuMDAyLDAuMDQ1Yy0wLjE1MSwwLjU1OSAtMC42MDUsMS4wMDcgLTEuMTk0LDEuMTM4bDAsMi45NDljMC41NiwwLjEyNiAwLjk5NiwwLjU0MiAxLjE2LDEuMDY1bDEuNzg3LDBjMC4wMDQsLTAuMDE1IDAuMDA3LC0wLjAzIDAuMDExLC0wLjA0NWMwLjIyOCwtMC44ODMgMS4wNjYsLTEuNTQ3IDEuOTg5LC0xLjU4MmMxLjE4MywtMC4wMTUgMi4zNjcsLTAuMDIyIDMuNTUxLC0wLjAyM2wwLjIyMiwwLjAwMWMxLjEwOSwwLjAwMSAyLjIxOSwwLjAwOCAzLjMyOCwwLjAyMmMwLjkyMywwLjAzNSAxLjc2MiwwLjY5OSAxLjk4OSwxLjU4MmMwLjMyNywxLjI2OSAtMC43MjIsMi41ODggLTEuOTg5LDIuNjM2Yy0xLjE4MywwLjAxNSAtMi4zNjcsMC4wMjIgLTMuNTUsMC4wMjNsLTAuMjIyLC0wLjAwMWMtMS4xMSwtMC4wMDEgLTIuMjE5LC0wLjAwOCAtMy4zMjksLTAuMDIyYy0wLjkyNiwtMC4wMzUgLTEuNzM2LC0wLjc1IC0xLjk3NywtMS42MjdsLTEuODEsMGMtMC4xNjQsMC41MjMgLTAuNiwwLjkzOSAtMS4xNiwxLjA2NWwwLDIuOTQ5YzAuNTUxLDAuMTIyIDAuOTg0LDAuNTIzIDEuMTYxLDEuMDMxbDEuNzg2LDBjMC4wMDQsLTAuMDE1IDAuMDA3LC0wLjAzIDAuMDExLC0wLjA0NWMwLjIyOCwtMC44ODMgMS4wNjYsLTEuNTQ3IDEuOTg5LC0xLjU4MmMxLjE4MywtMC4wMTUgMi4zNjcsLTAuMDIyIDMuNTUxLC0wLjAyM2wwLjIyMiwwYzEuMTA5LDAuMDAxIDIuMjE5LDAuMDA5IDMuMzI4LDAuMDIzYzAuOTIzLDAuMDM1IDEuNzYyLDAuNjk5IDEuOTg5LDEuNTgyYzAuMzI3LDEuMjY5IC0wLjcyMiwyLjU4NyAtMS45ODksMi42MzZjLTEuMTgzLDAuMDE1IC0yLjM2NywwLjAyMiAtMy41NSwwLjAyMmwtMC4yMjIsMGMtMS4xMSwtMC4wMDEgLTIuMjE5LC0wLjAwOCAtMy4zMjksLTAuMDIyYy0wLjkyNiwtMC4wMzYgLTEuNzM2LC0wLjc1IC0xLjk3NywtMS42MjhsLTEuNzg4LDBabTcuNDI2LDAuNzIyYzEuMTM5LC0wLjAwOSAyLjI3OCwtMC4wMyAzLjQxNiwtMC4wNDRjMC40OTgsLTAuMDE5IDAuOTUxLC0wLjM3IDEuMDg2LC0wLjg0MmMwLjIwMSwtMC43MDkgLTAuMzk4LC0xLjQ2NyAtMS4xMTksLTEuNDc3Yy0xLjA5MiwwIC0yLjE4MywtMC4wMDYgLTMuMjc1LC0wLjAxbC0wLjIxOCwwYy0xLjE2NSwwLjAwMyAtMi4zMjksMC4wMSAtMy40OTQsMC4wMWMtMC43MiwwLjAxIC0xLjMyLDAuNzY4IC0xLjExOCwxLjQ3N2MwLjEzNCwwLjQ3MiAwLjU4NywwLjgyMyAxLjA4NSwwLjg0MmMxLjE3NSwwLjAxNSAyLjM1MSwwLjAzNyAzLjUyNywwLjA0NGwwLjExLDBabS04Ljk2NCwtMS44NjJjMC40LDAgMC43MjUsMC4zMjUgMC43MjUsMC43MjVjMCwwLjQwMSAtMC4zMjUsMC43MjYgLTAuNzI1LDAuNzI2Yy0wLjQwMSwwIC0wLjcyNiwtMC4zMjUgLTAuNzI2LC0wLjcyNmMwLC0wLjQgMC4zMjUsLTAuNzI1IDAuNzI2LC0wLjcyNVptOC45NjQsLTQuMTQ3YzEuMTM5LC0wLjAwOCAyLjI3OCwtMC4wMyAzLjQxNiwtMC4wNDRjMC40OTgsLTAuMDE5IDAuOTUxLC0wLjM3IDEuMDg2LC0wLjg0MmMwLjIwMSwtMC43MDkgLTAuMzk4LC0xLjQ2NyAtMS4xMTksLTEuNDc2Yy0xLjA5MiwwIC0yLjE4MywtMC4wMDcgLTMuMjc1LC0wLjAxMWwtMC4yMTgsMGMtMS4xNjUsMC4wMDMgLTIuMzI5LDAuMDExIC0zLjQ5NCwwLjAxMWMtMC43MiwwLjAwOSAtMS4zMiwwLjc2NyAtMS4xMTgsMS40NzZjMC4xMzQsMC40NzIgMC41ODcsMC44MjMgMS4wODUsMC44NDJjMS4xNzUsMC4wMTUgMi4zNTEsMC4wMzcgMy41MjcsMC4wNDVsMC4xMSwtMC4wMDFabS04Ljk2NCwtMS45MmMwLjQsMCAwLjcyNSwwLjMyNSAwLjcyNSwwLjcyNWMwLDAuNDAxIC0wLjMyNSwwLjcyNiAtMC43MjUsMC43MjZjLTAuNDAxLDAgLTAuNzI2LC0wLjMyNSAtMC43MjYsLTAuNzI2YzAsLTAuNCAwLjMyNSwtMC43MjUgMC43MjYsLTAuNzI1Wm04Ljk2NCwtNC4yNDFjMS4xMzksLTAuMDA4IDIuMjc4LC0wLjAzIDMuNDE2LC0wLjA0NGMwLjQ5OCwtMC4wMTkgMC45NTEsLTAuMzcgMS4wODYsLTAuODQyYzAuMjAxLC0wLjcwOSAtMC4zOTgsLTEuNDY3IC0xLjExOSwtMS40NzZjLTEuMDkyLDAgLTIuMTgzLC0wLjAwNyAtMy4yNzUsLTAuMDExbC0wLjIxOCwwYy0xLjE2NSwwLjAwMyAtMi4zMjksMC4wMTEgLTMuNDk0LDAuMDExYy0wLjcyLDAuMDA5IC0xLjMyLDAuNzY3IC0xLjExOCwxLjQ3NmMwLjEzNCwwLjQ3MiAwLjU4NywwLjgyMyAxLjA4NSwwLjg0MmMxLjE3NSwwLjAxNSAyLjM1MSwwLjAzNyAzLjUyNywwLjA0NWwwLjExLC0wLjAwMVptLTguOTY0LC0xLjg0OWMwLjQsMCAwLjcyNSwwLjMyNSAwLjcyNSwwLjcyNWMwLDAuNCAtMC4zMjUsMC43MjUgLTAuNzI1LDAuNzI1Yy0wLjQwMSwwIC0wLjcyNiwtMC4zMjUgLTAuNzI2LC0wLjcyNWMwLC0wLjQgMC4zMjUsLTAuNzI1IDAuNzI2LC0wLjcyNVpcIiB9KSk7XG5cbi8qKlxuICogUmVnaXN0ZXIgb3VyIFRpbWVsaW5lIGJsb2NrLlxuICovXG5yZWdpc3RlckJsb2NrVHlwZSgnd3AtdGltZWxpbmVyL3RpbWVsaW5lJywge1xuXHR0aXRsZTogX18oJ1RpbWVsaW5lJyksXG5cdGljb246IGljb25FbGVtZW50LFxuXHRjYXRlZ29yeTogJ2NvbW1vbicsXG5cdGtleXdvcmRzOiBbX18oJ3dwIHRpbWVsaW5lcicsICd3cC10aW1lbGluZXInKSwgX18oJ3RpbWVsaW5lJywgJ3dwLXRpbWVsaW5lcicpLCBfXygnZXZlbnQnLCAnd3AtdGltZWxpbmVyJyldLFxuXHRhdHRyaWJ1dGVzOiB7XG5cdFx0dGltZWxpbmVJZDoge1xuXHRcdFx0dHlwZTogJ251bWJlcidcblx0XHR9LFxuXHRcdHRpbWVsaW5lTmFtZToge1xuXHRcdFx0dHlwZTogJ3N0cmluZydcblx0XHR9XG5cdH0sXG5cdHN1cHBvcnRzOiB7XG5cdFx0aHRtbDogZmFsc2Vcblx0fSxcblxuXHRlZGl0OiB3aXRoU2VsZWN0KGZ1bmN0aW9uIChzZWxlY3QpIHtcblx0XHRyZXR1cm4ge1xuXHRcdFx0dGltZWxpbmVzOiBzZWxlY3QoJ2NvcmUnKS5nZXRFbnRpdHlSZWNvcmRzKCd0YXhvbm9teScsICd3cHQtdGltZWxpbmUnLCB7IHBlcl9wYWdlOiAxMDAsIGhpZGVfZW1wdHk6IHRydWUgfSlcblx0XHR9O1xuXHR9KShmdW5jdGlvbiAocHJvcHMpIHtcblx0XHR2YXIgYXR0cmlidXRlcyA9IHByb3BzLmF0dHJpYnV0ZXMsXG5cdFx0ICAgIHRpbWVsaW5lcyA9IHByb3BzLnRpbWVsaW5lcyxcblx0XHQgICAgY2xhc3NOYW1lID0gcHJvcHMuY2xhc3NOYW1lLFxuXHRcdCAgICBpc1NlbGVjdGVkID0gcHJvcHMuaXNTZWxlY3RlZCxcblx0XHQgICAgc2V0QXR0cmlidXRlcyA9IHByb3BzLnNldEF0dHJpYnV0ZXM7XG5cblxuXHRcdGlmICghdGltZWxpbmVzKSB7XG5cdFx0XHRyZXR1cm4gd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFxuXHRcdFx0XHQncCcsXG5cdFx0XHRcdHsgY2xhc3NOYW1lOiBjbGFzc05hbWUgfSxcblx0XHRcdFx0d3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFNwaW5uZXIsIG51bGwpLFxuXHRcdFx0XHRfXygnTG9hZGluZyB0aW1lbGluZXMuLi4nLCAnd3AtdGltZWxpbmVyJylcblx0XHRcdCk7XG5cdFx0fVxuXHRcdGlmICgwID09PSB0aW1lbGluZXMubGVuZ3RoKSB7XG5cdFx0XHRyZXR1cm4gd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFxuXHRcdFx0XHQncCcsXG5cdFx0XHRcdG51bGwsXG5cdFx0XHRcdF9fKCdObyB0aW1lbGluZSB0byBzZWxlY3QuLi4geWV0IScsICd3cC10aW1lbGluZXInKVxuXHRcdFx0KTtcblx0XHR9XG5cblx0XHR2YXIgdGltZWxpbmVzX2FzX29wdGlvbnMgPSBbXTtcblxuXHRcdHRpbWVsaW5lcy5tYXAoZnVuY3Rpb24gKHRpbWVsaW5lKSB7XG5cdFx0XHR2YXIgYWNoaWV2ZW1lbnRfc3RyaW5nID0gX18oJ2FjaGlldmVtZW50JywgJ3dwLXRpbWVsaW5lcicpO1xuXHRcdFx0dmFyIHRpbWVsaW5lX2xhYmVsID0gdGltZWxpbmUubmFtZSArICcgKCcgKyB0aW1lbGluZS5jb3VudCArICcgJyArIGFjaGlldmVtZW50X3N0cmluZyArICcpJztcblxuXHRcdFx0dGltZWxpbmVzX2FzX29wdGlvbnMucHVzaCh7XG5cdFx0XHRcdHZhbHVlOiB0aW1lbGluZS5pZCxcblx0XHRcdFx0bGFiZWw6IHRpbWVsaW5lX2xhYmVsXG5cdFx0XHR9KTtcblx0XHR9KTtcblxuXHRcdHByb3BzLnNldEF0dHJpYnV0ZXMoe1xuXHRcdFx0dGltZWxpbmVJZDogdGltZWxpbmVzX2FzX29wdGlvbnNbMF0udmFsdWVcblx0XHR9KTtcblxuXHRcdGZ1bmN0aW9uIG9uQ2hhbmdlKHZhbHVlKSB7XG5cdFx0XHRyZXR1cm4gcHJvcHMuc2V0QXR0cmlidXRlcyh7XG5cdFx0XHRcdHRpbWVsaW5lSWQ6IHZhbHVlXG5cdFx0XHR9KTtcblx0XHR9XG5cblx0XHRyZXR1cm4gd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFNlbGVjdENvbnRyb2wsIHtcblx0XHRcdGxhYmVsOiBfXygnU2VsZWN0IHRpbWVsaW5lIHRvIGRpc3BsYXknLCAnd3AtdGltZWxpbmVyJyksXG5cdFx0XHR2YWx1ZTogYXR0cmlidXRlcy50aW1lbGluZUlkLFxuXHRcdFx0b3B0aW9uczogdGltZWxpbmVzX2FzX29wdGlvbnMsXG5cdFx0XHRvbkNoYW5nZTogb25DaGFuZ2Vcblx0XHR9KTtcblx0fSksXG5cdHNhdmU6IGZ1bmN0aW9uIHNhdmUocHJvcHMpIHtcblx0XHRyZXR1cm4gbnVsbDtcblx0fVxufSk7XG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gLi9zcmMvdGltZWxpbmUvdGltZWxpbmUuanNcbi8vIG1vZHVsZSBpZCA9IDFcbi8vIG1vZHVsZSBjaHVua3MgPSAwIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///1\n");

/***/ }),
/* 2 */
/*!*********************************!*\
  !*** ./src/timeline/style.scss ***!
  \*********************************/
/*! dynamic exports provided */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMi5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy90aW1lbGluZS9zdHlsZS5zY3NzPzAxZDgiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW5cblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyAuL3NyYy90aW1lbGluZS9zdHlsZS5zY3NzXG4vLyBtb2R1bGUgaWQgPSAyXG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJtYXBwaW5ncyI6IkFBQUEiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///2\n");

/***/ }),
/* 3 */
/*!**********************************!*\
  !*** ./src/timeline/editor.scss ***!
  \**********************************/
/*! dynamic exports provided */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy90aW1lbGluZS9lZGl0b3Iuc2Nzcz82YWU5Il0sInNvdXJjZXNDb250ZW50IjpbIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luXG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gLi9zcmMvdGltZWxpbmUvZWRpdG9yLnNjc3Ncbi8vIG1vZHVsZSBpZCA9IDNcbi8vIG1vZHVsZSBjaHVua3MgPSAwIl0sIm1hcHBpbmdzIjoiQUFBQSIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///3\n");

/***/ })
/******/ ]);