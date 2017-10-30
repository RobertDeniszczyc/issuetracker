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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ 40:
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 8:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(9);
module.exports = __webpack_require__(40);


/***/ }),

/***/ 9:
/***/ (function(module, exports) {

window.onload = function () {
    var editComment = document.getElementsByClassName('comment--edit'),
        editForm = document.getElementById('edit-comment-form'),
        commentPanels = document.getElementsByClassName('comment_panel'),
        newCommentForm = document.getElementById('comment-add-form'),
        commentContent = null,
        commentId = null;

    if (editForm) {
        var editField = editForm.querySelector('#edited-content'),
            editCommentSubmit = document.getElementById('comment--submit-edit');
    }

    for (var i = 0; i < editComment.length; i++) {
        editComment[i].addEventListener('click', function () {

            for (var i = commentPanels.length - 1; i >= 0; i--) {
                commentPanels[i].classList.add('is-display-none');
            }

            newCommentForm.classList.add('is-display-none');

            editForm.classList.add('is-display-block');
            commentId = this.parentNode.dataset.commentid;
            commentContent = this.parentNode.getElementsByClassName('comment-content')[0].innerHTML;

            editField.value = commentContent;
            editForm.action = editForm.action + '/' + commentId;
            editForm.querySelector('#comment_id').value = commentId;
        });
    }

    if (editCommentSubmit && editForm && commentPanels) {
        editForm.classList.remove('is-display-block');
        newCommentForm.classList.remove('is-display-none');
        newCommentForm.classList.add('is-display-block');

        for (var i = commentPanels.length - 1; i >= 0; i--) {
            commentPanels[i].classList.remove('is-display-none');
            commentPanels[i].classList.add('is-display-block');
        }
    }
};

/***/ })

/******/ });