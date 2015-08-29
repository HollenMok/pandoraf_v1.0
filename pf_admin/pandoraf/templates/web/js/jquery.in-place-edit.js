(function($){
$.fn.inPlaceEdit=function(options){
return this.each(function(){
var settings=$.extend({},$.fn.inPlaceEdit.defaults,options);
var element=$(this);
element.click(function(){
element.data('skipBlur',false)
if(element.hasClass("editing")||element.hasClass("disabled")){
return;}
element.addClass("editing");
element.old_value=element.html();
if(typeof(settings.html)=='string'){
element.html(settings.html);}
else{
element.html('');
var form_template=settings.html.children(':first').clone(true);
form_template.appendTo(element);}
$('.field',element).val(element.old_value);
$('.field',element).focus();
$('.field',element).select();
if(settings.onBlurDisabled==false){
$('.field',element).blur(function(){
var skipBlur=element.data('skipBlur')
if(skipBlur!=true){
element.timeout=setTimeout(cancel,50);}
element.data('skipBlur',false)});}
$('.save-button',element).click(function(){
return submit();});
$('.save-button',element).mousedown(function(){
element.data('skipBlur',true)});
$('.cancel-button',element).mousedown(function(){
element.data('skipBlur',true)});
$('.cancel-button',element).click(function(){
return cancel();});
if(settings.onKeyupDisabled==false){
$('.field',element).keyup(function(event){
var keycode=event.which;
var type=this.tagName.toLowerCase();
if(keycode==27&&settings.escapeKeyDisabled==false){
return cancel();}
else if(keycode==13){
if(type!="textarea"){
return submit();}}
return true;});}});
element.mouseover(function(){
element.addClass("hover");});
element.mouseout(function(){
element.removeClass("hover");});
function cancel(){
element.html(element.old_value);
element.removeClass("hover editing");
if(options.cancel){
options.cancel.apply(element,[element]);}
return false;};
function submit(){
clearTimeout(element.timeout);
var id=element.attr('id');
var value=$('.field',element).val();
if(options.submit){
options.submit.apply(element,[element,id,value,element.old_value]);}
element.removeClass("hover editing");
element.html(value);
return false;};});};
$.fn.inPlaceEdit.defaults={
onBlurDisabled:false,
onKeyupDisabled:false,
escapeKeyDisabled:false,
html:' \<div class="inplace-edit"> \<textarea class="field"></textarea> \<div class="buttons"> \<input type="button" value="Save" class="save-button"/> \<input type="button" value="Cancel" class="cancel-button"/> \</div> \</div>'};})(jQuery);

