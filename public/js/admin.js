/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
var delete_url;
var token;
var send_array_data = false;
var _method = 'DELETE';

restore_row = function restore_row(url, t, message_text) {
  _method = 'POST';
  delete_url = url;
  token = t;
  $("#msg").text(message_text);
  $('.message_div').show();
};

del_row = function del_row(url, t, message_text) {
  _method = 'DELETE';
  delete_url = url;
  token = t;
  $("#msg").text(message_text);
  $(".message_div").show();
};

delete_row = function delete_row() {
  if (send_array_data) {
    $("#data_form").submit();
  } else {
    console.log(delete_url);
    var form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', delete_url);
    var hiddenField1 = document.createElement('input');
    hiddenField1.setAttribute('name', '_method');
    hiddenField1.setAttribute('value', _method);
    form.appendChild(hiddenField1);
    var hiddenField2 = document.createElement('input');
    hiddenField2.setAttribute('name', '_token');
    hiddenField2.setAttribute('value', token);
    form.appendChild(hiddenField2);
    document.body.appendChild(form);
    console.log('form');
    form.submit();
    document.body.removeChild(form);
  }
};

hide_box = function hide_box() {
  token = '';
  delete_url = '';
  $(".message_div").hide();
};

$('input.check_box').click(function () {
  console.log('check_box');
  send_array_data = false;
  var $checkboxes = $('.panel_content input[type="checkbox"]');
  var count = $checkboxes.filter(':checked').length;

  if (count > 0) {
    console.log('count', count);
    $("#destroy_items").removeClass('off');
    $("#restore_items").removeClass('off');
  } else {
    $("#destroy_items").addClass('off');
    $("#restore_items").addClass('off');
  }
});
$('.item_form').click(function () {
  console.log('item_form clicked');
  send_array_data = true;
  var $checkboxes = $('.panel_content input[type="checkbox"]');
  var count = $checkboxes.filter(':checked').length;

  if (count > 0) {
    var href = window.location.href.split('?');
    var action = href[0] + "/" + this.id;

    if (href.length === 2) {
      action = action + "?" + href[1];
    }

    $("#data_form").attr('action', action);
    $("#msg").text($(this).attr('msg'));
    $('.message_div').show();
  }
});

logout = function logout() {
  $('#LogOut').submit();
};
/******/ })()
;