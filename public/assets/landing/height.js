function setColumns() {
( function() {
if ($(window).width() > 750) {
contentDiv = $("#ttr_content");
contentMarginDiv = $("#ttr_content_margin");
sidebar1Div = $("#ttr_sidebar_left");
sidebar2Div = $("#ttr_sidebar_right");
sidebar1MarginDiv = $("#ttr_sidebar_left_margin");
sidebar2MarginDiv = $("#ttr_sidebar_right_margin");
if (sidebar1Div != null)
{
if (contentDiv.height() > sidebar1Div.height())
{
if (sidebar2Div != null)
{
if (contentDiv.height() > sidebar2Div.height())
{
sidebar1MarginDiv.height(contentDiv.height() - 0 - 0 - 0 - 0);
sidebar2MarginDiv.height(contentDiv.height() - 0 - 0 - 0 - 0);
}
else
{
sidebar1MarginDiv.height(sidebar2Div.height() - 0 - 0 - 0 - 0);
var Height = sidebar2Div.height() - 20 - 0 - 0 - 0;
contentMarginDiv.css("min-height", Height+'px');
 }
}
else
{
sidebar1MarginDiv.height(contentDiv.height() - 0 - 0 - 0 - 0);
}
}
else
{
if (sidebar2Div != null)
{
if (sidebar1Div.height() > sidebar2Div.height())
{
sidebar2MarginDiv.height(sidebar1Div.height() - 0 - 0 - 0 - 0);
var Height = sidebar1Div.height() - 20 - 0 - 0 - 0;
contentMarginDiv.css("min-height", Height+'px');
}
else
{
sidebar1MarginDiv.height(sidebar2Div.height() - 0 - 0 - 0 - 0);
var Height = sidebar2Div.height() - 20 - 0 - 0 - 0;
contentMarginDiv.css("min-height", Height+'px');
}
}
else
{
var Height = sidebar1Div.height() - 20 - 0 - 0 - 0;
contentMarginDiv.css("min-height", Height+'px');
}
}
}
if (sidebar2Div != null)
{
if (contentDiv.height() > sidebar2Div.height())
{
if (sidebar1Div != null)
{
if (contentDiv.height() > sidebar1Div.height())
{
sidebar1MarginDiv.height(contentDiv.height() - 0 - 0 - 0 - 0);
sidebar2MarginDiv.height(contentDiv.height() - 0 - 0 - 0 - 0);
}
else
{
sidebar2MarginDiv.height(sidebar1Div.height() - 0 - 0 - 0 - 0);
var Height = sidebar1Div.height() - 20 - 0 - 0 - 0;
contentMarginDiv.css("min-height", Height+'px');
 }
}
else
{
sidebar2MarginDiv.height(contentDiv.height() - 0 - 0 - 0 - 0);
}
}
else
{
if (sidebar1Div != null)
{
if (sidebar2Div.height() > sidebar1Div.height())
{
sidebar1MarginDiv.height(sidebar1Div.height() - 0 - 0 - 0 - 0);
var Height = sidebar1Div.height() - 0 - 0 - 0 - 0;
contentMarginDiv.css("min-height", Height+'px');
}
else
{
sidebar2MarginDiv.height(sidebar1Div.height() - 0 - 0 - 0 - 0);
var Height = sidebar1Div.height() - 20 - 0 - 0 - 0;
contentMarginDiv.css("min-height", Height+'px');
}
}
else
{
var Height = sidebar2Div.height() - 20 - 0 - 0 - 0;
contentMarginDiv.css("min-height", Height+'px');
}
}
}
}
} )();
}
$(window).load(function(){
setColumns();
});
