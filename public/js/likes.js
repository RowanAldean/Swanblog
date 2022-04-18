/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/likes.js ***!
  \*******************************/
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function setColors(_this, status) {
  //if liked
  if (status) {
    _this.classList.add = "text-red-500";
    _this.classList.remove = "text-muted";
  } else {
    _this.classList.add = "text-muted";
    _this.classList.remove = "text-red-500";
  }
}

window.giveLike = function (likeStatus) {
  return _objectSpread({
    formData: {
      likeable_type: '',
      id: ''
    },
    liked: likeStatus,
    numberLikes: ''
  }, submitData);
};

var submitData = {
  submitData: function submitData() {
    var _this2 = this;

    console.log(this.formData.likeable_type);
    console.log(this.formData.id);
    console.log(this.liked);

    if (this.liked == true) {
      fetch('/like', {
        method: 'DELETE',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
        },
        body: JSON.stringify(this.formData)
      }).then(function (res) {
        return res.json();
      }).then(function (data) {
        _this2.numberLikes = data.likes;
      })["catch"](function () {
        _this2.numberLikes = 'ACTION FAILED';
      })["finally"](function () {
        _this2.liked = !_this2.liked;
      });
    } else if (this.liked == false) {
      fetch('/like', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
        },
        body: JSON.stringify(this.formData)
      }).then(function (res) {
        return res.json();
      }).then(function (data) {
        _this2.numberLikes = data.likes;
      })["catch"](function () {
        _this2.numberLikes = 'ACTION FAILED';
      })["finally"](function () {
        _this2.liked = !_this2.liked;
      });
    }
  }
};
window.submitData = submitData;
/******/ })()
;