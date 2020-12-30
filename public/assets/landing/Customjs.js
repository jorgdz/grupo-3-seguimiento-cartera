$(document).ready(function(){

/*************** Checkbox script ***************/
var inputs = document.getElementsByTagName('input');
for (a = 0; a < inputs.length; a++) {
if (inputs[a].type == "checkbox") {
var id = inputs[a].getAttribute("id");
if (id==null){
id=  "checkbox" +a;
}
inputs[a].setAttribute("id",id);
var container = document.createElement('div');
container.setAttribute("class", "ttr_checkbox");
var label = document.createElement('label');
label.setAttribute("for", id);
$(inputs[a]).wrap(container).after(label);
}
}

/*************** Radiobutton script ***************/
var inputs = document.getElementsByTagName('input');
for (a = 0; a < inputs.length; a++) {
if (inputs[a].type == "radio") {
var id = inputs[a].getAttribute("id");
if (id==null){
id=  "radio" +a;
}
inputs[a].setAttribute("id",id);
var container = document.createElement('div');
container.setAttribute("class", "ttr_radio");
var label = document.createElement('label');
label.setAttribute("for", id);
$(inputs[a]).wrap(container).after(label);
}
}

/*************** Staticfooter script ***************/
var window_height =  Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
var body_height = $(document.body).height();
$content = $("#ttr_content_and_sidebar_container");
if(body_height < window_height){
differ = (window_height - body_height);
content_height = $content.height() + differ;
$("#ttr_content_and_sidebar_container").css("min-height", content_height+"px");
}

/* Slideshow Function Call */

if(jQuery('#ttr_slideshow_inner').length){
jQuery('#ttr_slideshow_inner').TTSlider({
slideShowSpeed:6000, begintime:1000,cssPrefix: 'ttr_'
});
}

/*************** Hamburgermenu slideleft script ***************/
$('#nav-expander').on('click',function(e){
e.preventDefault();
$('body').toggleClass('nav-expanded');
});

/*************** Menu click script ***************/
$('ul.ttr_menu_items.nav li [data-toggle=dropdown]').on('click', function() {
var window_width =  Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
if(window_width > 1025 && $(this).attr('href')){
window.location.href = $(this).attr('href'); 
}
else{
if($(this).parent().hasClass('open')){
location.assign($(this).attr('href'));
}
}
});

/*************** Sidebarmenu click script ***************/
$('ul.ttr_vmenu_items.nav li [data-toggle=dropdown]').on('click', function() {
var window_width =  Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
if(window_width > 1025 && $(this).attr('href')){
window.location.href = $(this).attr('href'); 
}
else{
if($(this).parent().hasClass('open')){
location.assign($(this).attr('href'));
}
}
});

/*************** Tab menu click script ***************/
$('.ttr_menu_items ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) { 
var window_width =  Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
if(window_width < 1025){
event.preventDefault();
event.stopPropagation();
$(this).parent().siblings().removeClass('open');
$(this).parent().toggleClass(function() {
if ($(this).is(".open") ) {
window.location.href = $(this).children("[data-toggle=dropdown]").attr('href'); 
return "";
} else {
return "open";
}
});
}
});

/*************** Page Alignment format tab  script ***************/
var page_width = $('#ttr_page').width();
var window_width =  Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
if(window_width < 1025){
$('.ttr_page_align_left').each(function() {
var left_div_width = $(this).width(); 
var page_align_left_value = page_width - left_div_width;
left_div_width = left_div_width + 1;
$(this).css({'left' : '-' + page_align_left_value + 'px', 'width': left_div_width + 'px'});
});
$('.ttr_page_align_right').each(function() {
var right_div_width = $(this).width(); 
var page_align_left_value = page_width - right_div_width;
right_div_width = right_div_width + 1;
$(this).css({'right' : '-' + page_align_left_value + 'px', 'width': right_div_width + 'px'});
});
}

/*************** Tab-Sidebarmenu script ***************/
$('.ttr_vmenu_items ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) { 
var window_width =  Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
if(window_width < 1025){
event.preventDefault();
event.stopPropagation();
$(this).parent().siblings().removeClass('open');
$(this).parent().toggleClass(function() {
if ($(this).is(".open") ) {
window.location.href = $(this).children("[data-toggle=dropdown]").attr('href'); 
return "";
} else {
return "open";
}
});
}
});

/*************** Sticky menu script ***************/
var menutop = $('#ttr_menu').offset().top;
$(window).scroll(function () {
if ($(this).scrollTop() > menutop) {
$('#ttr_menu').addClass('navbar-fixed-top');
} else {
$('#ttr_menu').removeClass('navbar-fixed-top');
}
});

/*************** Html video script ***************/
var objects = ['iframe[src*="youtube.com"]','iframe[src*="youtu.be"]', 'video','object'];
for(var i = 0 ; i < objects.length ; i++){
if ($(objects[i]).length > 0) {
$(objects[i]).wrap( "<div class='embed-responsive embed-responsive-16by9'></div>" );
$(objects[i]).addClass('embed-responsive-item');
}
}

/*************** Html Equal column height ***************/
$(window).bind('load', function() { tt_columns(); }); 
$(window).resize(tt_columns);
});

/*************** Html Equal column height ***************/
function tt_equal_height(cols){
var maxHeight = 0;
maxHeight = Math.max.apply(Math, cols.map(function(){return $(this).height(); }).get());
cols.each(function(){
$child_h = $(this).children().outerHeight();
$parent_h = $(this).height();
if(maxHeight != $parent_h){
$(this).children().css('height','inherit');
if($child_h ==  $parent_h){
$(this).css('height', maxHeight+'px'); 
}
else{
$mrg = $parent_h - $child_h;
$m = maxHeight - $mrg; 
$(this).css('height', $m + 'px');
}
}
});
}
function tt_columns(){
var window_width =  Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
$('#ttr_content .row').each(function() {
$child = $(this).children();
var col = [];
$k = 0;
var params = [];
for($i=0;$i<=$child.length;$i++){
$(params).css('height','auto'); 
if(window_width > 1199){
if($($child[$i]).hasClass('visible-lg-block')){
if( params.length > 1) {  
tt_equal_height($(params)); 
} 
params = [];
$k = 0;
}
else if($($child[$i]).hasClass('post_column')){
params[$k] = $child[$i];
$k++;
}
else if(!($($child[$i]).hasClass('clearfix'))) {
tt_equal_height($(params));
}
}
if(window_width > 767 && window_width < 1199){
if($($child[$i]).hasClass('visible-sm-block')){
if( params.length > 1) {  
tt_equal_height($(params)); 
} 
params = [];
$k = 0;
}
else if($($child[$i]).hasClass('post_column')){
params[$k] = $child[$i];
$k++;
}
else if(!($($child[$i]).hasClass('clearfix'))) {
tt_equal_height($(params));
}
}
if(window_width < 768){
if($($child[$i]).hasClass('visible-xs-block')){
if( params.length > 1) {  
tt_equal_height($(params)); 
} 
params = [];
$k = 0;
}
else if($($child[$i]).hasClass('post_column')){
params[$k] = $child[$i];
$k++;
}
else if(!($($child[$i]).hasClass('clearfix'))) {
tt_equal_height($(params));
}
}
}
});
}
