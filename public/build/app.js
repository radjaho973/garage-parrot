"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.error.to-string.js */ "./node_modules/core-js/modules/es.error.to-string.js");
/* harmony import */ var core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_date_to_string_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.date.to-string.js */ "./node_modules/core-js/modules/es.date.to-string.js");
/* harmony import */ var core_js_modules_es_date_to_string_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_date_to_string_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_regexp_to_string_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.regexp.to-string.js */ "./node_modules/core-js/modules/es.regexp.to-string.js");
/* harmony import */ var core_js_modules_es_regexp_to_string_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_regexp_to_string_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");






/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

var imgCollectionHolder = document.querySelector('#car_image_collection');
var indexCategory = imgCollectionHolder.querySelectorAll("car_category___name__").length;
function addImage() {
  //récupère les attributs à l'intérieur de la div
  // ImgCollectionHolder et remplace l'index [__name__]
  // par indexCategory 
  var dataPrototype = imgCollectionHolder.dataset.prototype.replace(/__name__/g, indexCategory);
  console.log(dataPrototype);
  // ajoute un nouveau champ image 
  // à partir du contenu de la div (dataPrototype)
  imgCollectionHolder.innerHTML += dataPrototype;
  AddDeleteBtn();
  indexCategory++;
  console.log(indexCategory);
}
function AddDeleteBtn() {
  var btnDelete = document.createElement("button");
  btnDelete.classList.add('btn', 'btn-delete');
  btnDelete.setAttribute('type', 'button');
  btnDelete.innerHTML = "Supprimer";
  var subFormId = "#car_image_collection_" + indexCategory.toString();
  //On sélectionne le wrapper puis le nouveau formulaire auquel
  //on ajoute le bouton supprimer
  var subForm = document.querySelector("".concat(subFormId)).querySelector("div");
  subForm.appendChild(btnDelete);
}

// function deleteForm(params) {

// }

var newImgBtn = document.querySelector("#new_image");
newImgBtn.addEventListener('click', addImage);

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_date_to-string_js-node_modules_core-js_modules_es_err-ad23f2"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQzBCO0FBRTFCLElBQUlBLG1CQUFtQixHQUFHQyxRQUFRLENBQUNDLGFBQWEsQ0FBQyx1QkFBdUIsQ0FBQztBQUVyRSxJQUFJQyxhQUFhLEdBQUdILG1CQUFtQixDQUFDSSxnQkFBZ0IsQ0FBQyx1QkFBdUIsQ0FBQyxDQUFDQyxNQUFNO0FBSXhGLFNBQVNDLFFBQVFBLENBQUEsRUFBRztFQUNoQjtFQUNBO0VBQ0E7RUFDQSxJQUFJQyxhQUFhLEdBQUlQLG1CQUFtQixDQUFDUSxPQUFPLENBQUNDLFNBQVMsQ0FBQ0MsT0FBTyxDQUFDLFdBQVcsRUFBRVAsYUFBYSxDQUFDO0VBRTlGUSxPQUFPLENBQUNDLEdBQUcsQ0FBQ0wsYUFBYSxDQUFDO0VBQzFCO0VBQ0E7RUFDQVAsbUJBQW1CLENBQUNhLFNBQVMsSUFBSU4sYUFBYTtFQUU5Q08sWUFBWSxDQUFDLENBQUM7RUFFZFgsYUFBYSxFQUFFO0VBRWZRLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDVCxhQUFhLENBQUM7QUFFOUI7QUFFQSxTQUFTVyxZQUFZQSxDQUFBLEVBQUc7RUFFcEIsSUFBSUMsU0FBUyxHQUFHZCxRQUFRLENBQUNlLGFBQWEsQ0FBQyxRQUFRLENBQUM7RUFDaERELFNBQVMsQ0FBQ0UsU0FBUyxDQUFDQyxHQUFHLENBQUMsS0FBSyxFQUFFLFlBQVksQ0FBQztFQUM1Q0gsU0FBUyxDQUFDSSxZQUFZLENBQUMsTUFBTSxFQUFDLFFBQVEsQ0FBQztFQUN2Q0osU0FBUyxDQUFDRixTQUFTLEdBQUcsV0FBVztFQUVqQyxJQUFJTyxTQUFTLEdBQUcsd0JBQXdCLEdBQUVqQixhQUFhLENBQUNrQixRQUFRLENBQUMsQ0FBQztFQUNsRTtFQUNBO0VBQ0EsSUFBSUMsT0FBTyxHQUFHckIsUUFBUSxDQUFDQyxhQUFhLElBQUFxQixNQUFBLENBQUlILFNBQVMsQ0FBRSxDQUFDLENBQUNsQixhQUFhLENBQUMsS0FBSyxDQUFDO0VBQ3pFb0IsT0FBTyxDQUFDRSxXQUFXLENBQUNULFNBQVMsQ0FBQztBQUNsQzs7QUFFQTs7QUFFQTs7QUFHSSxJQUFJVSxTQUFTLEdBQUd4QixRQUFRLENBQUNDLGFBQWEsQ0FBQyxZQUFZLENBQUM7QUFDcER1QixTQUFTLENBQUNDLGdCQUFnQixDQUFDLE9BQU8sRUFBQ3BCLFFBQVEsQ0FBQzs7Ozs7Ozs7Ozs7QUN2RHBEIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3MiXSwic291cmNlc0NvbnRlbnQiOlsiLypcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcbiAqXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxuICovXG5cbi8vIGFueSBDU1MgeW91IGltcG9ydCB3aWxsIG91dHB1dCBpbnRvIGEgc2luZ2xlIGNzcyBmaWxlIChhcHAuY3NzIGluIHRoaXMgY2FzZSlcbmltcG9ydCAnLi9zdHlsZXMvYXBwLmNzcyc7XG5cbmxldCBpbWdDb2xsZWN0aW9uSG9sZGVyID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2Nhcl9pbWFnZV9jb2xsZWN0aW9uJylcblxuICAgIGxldCBpbmRleENhdGVnb3J5ID0gaW1nQ29sbGVjdGlvbkhvbGRlci5xdWVyeVNlbGVjdG9yQWxsKFwiY2FyX2NhdGVnb3J5X19fbmFtZV9fXCIpLmxlbmd0aFxuXG4gICAgXG4gICAgXG4gICAgZnVuY3Rpb24gYWRkSW1hZ2UoKSB7XG4gICAgICAgIC8vcsOpY3Vww6hyZSBsZXMgYXR0cmlidXRzIMOgIGwnaW50w6lyaWV1ciBkZSBsYSBkaXZcbiAgICAgICAgLy8gSW1nQ29sbGVjdGlvbkhvbGRlciBldCByZW1wbGFjZSBsJ2luZGV4IFtfX25hbWVfX11cbiAgICAgICAgLy8gcGFyIGluZGV4Q2F0ZWdvcnkgXG4gICAgICAgIGxldCBkYXRhUHJvdG90eXBlID0gIGltZ0NvbGxlY3Rpb25Ib2xkZXIuZGF0YXNldC5wcm90b3R5cGUucmVwbGFjZSgvX19uYW1lX18vZywgaW5kZXhDYXRlZ29yeSk7XG4gICAgICAgIFxuICAgICAgICBjb25zb2xlLmxvZyhkYXRhUHJvdG90eXBlKTtcbiAgICAgICAgLy8gYWpvdXRlIHVuIG5vdXZlYXUgY2hhbXAgaW1hZ2UgXG4gICAgICAgIC8vIMOgIHBhcnRpciBkdSBjb250ZW51IGRlIGxhIGRpdiAoZGF0YVByb3RvdHlwZSlcbiAgICAgICAgaW1nQ29sbGVjdGlvbkhvbGRlci5pbm5lckhUTUwgKz0gZGF0YVByb3RvdHlwZTtcbiAgICAgICAgXG4gICAgICAgIEFkZERlbGV0ZUJ0bigpXG5cbiAgICAgICAgaW5kZXhDYXRlZ29yeSsrO1xuXG4gICAgICAgIGNvbnNvbGUubG9nKGluZGV4Q2F0ZWdvcnkpO1xuICAgICAgICBcbiAgICB9XG5cbiAgICBmdW5jdGlvbiBBZGREZWxldGVCdG4oKSB7XG4gICAgICAgIFxuICAgICAgICBsZXQgYnRuRGVsZXRlID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudChcImJ1dHRvblwiKVxuICAgICAgICBidG5EZWxldGUuY2xhc3NMaXN0LmFkZCgnYnRuJywgJ2J0bi1kZWxldGUnKVxuICAgICAgICBidG5EZWxldGUuc2V0QXR0cmlidXRlKCd0eXBlJywnYnV0dG9uJylcbiAgICAgICAgYnRuRGVsZXRlLmlubmVySFRNTCA9IFwiU3VwcHJpbWVyXCJcbiAgICAgICAgXG4gICAgICAgIGxldCBzdWJGb3JtSWQgPSBcIiNjYXJfaW1hZ2VfY29sbGVjdGlvbl9cIisgaW5kZXhDYXRlZ29yeS50b1N0cmluZygpXG4gICAgICAgIC8vT24gc8OpbGVjdGlvbm5lIGxlIHdyYXBwZXIgcHVpcyBsZSBub3V2ZWF1IGZvcm11bGFpcmUgYXVxdWVsXG4gICAgICAgIC8vb24gYWpvdXRlIGxlIGJvdXRvbiBzdXBwcmltZXJcbiAgICAgICAgbGV0IHN1YkZvcm0gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKGAke3N1YkZvcm1JZH1gKS5xdWVyeVNlbGVjdG9yKFwiZGl2XCIpXG4gICAgICAgIHN1YkZvcm0uYXBwZW5kQ2hpbGQoYnRuRGVsZXRlKVxuICAgIH1cblxuICAgIC8vIGZ1bmN0aW9uIGRlbGV0ZUZvcm0ocGFyYW1zKSB7XG4gICAgICAgIFxuICAgIC8vIH1cblxuXG4gICAgICAgIGxldCBuZXdJbWdCdG4gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiI25ld19pbWFnZVwiKVxuICAgICAgICBuZXdJbWdCdG4uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLGFkZEltYWdlKVxuXG4gICAgICAgIFxuXG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOlsiaW1nQ29sbGVjdGlvbkhvbGRlciIsImRvY3VtZW50IiwicXVlcnlTZWxlY3RvciIsImluZGV4Q2F0ZWdvcnkiLCJxdWVyeVNlbGVjdG9yQWxsIiwibGVuZ3RoIiwiYWRkSW1hZ2UiLCJkYXRhUHJvdG90eXBlIiwiZGF0YXNldCIsInByb3RvdHlwZSIsInJlcGxhY2UiLCJjb25zb2xlIiwibG9nIiwiaW5uZXJIVE1MIiwiQWRkRGVsZXRlQnRuIiwiYnRuRGVsZXRlIiwiY3JlYXRlRWxlbWVudCIsImNsYXNzTGlzdCIsImFkZCIsInNldEF0dHJpYnV0ZSIsInN1YkZvcm1JZCIsInRvU3RyaW5nIiwic3ViRm9ybSIsImNvbmNhdCIsImFwcGVuZENoaWxkIiwibmV3SW1nQnRuIiwiYWRkRXZlbnRMaXN0ZW5lciJdLCJzb3VyY2VSb290IjoiIn0=