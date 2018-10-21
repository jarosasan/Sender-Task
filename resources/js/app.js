
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var $ = require('jquery');

window.Vue = require('vue');

$(document).ready(function() {
    var page = $('.tab-content').children('div').attr('id');
    $('.nav-tabs').find('.active').attr('aria-selected', 'false');
    $('.nav-tabs').find('.active').removeClass('active');
    $('.nav-tabs li a[name='+page+']').addClass('active');
    $('.nav-tabs li a[name='+page+']').attr('aria-selected', 'true');
});
