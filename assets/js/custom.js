/**
* Custom jQuery common functions
* Author: Sorav Garg
* Author Email: soravgarg123@gmail.com
* version: 1.0
*/

$(document).ready(function($) {

now       = new Date();
daysArr   = new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
monthsArr = new Array('January','February','March','April','May','June','July','August','September','October','November','December');

/*****************************************************************************
***************************Cancel button start *******************************
******************************************************************************/

$('body').on('click','.cancel-btn',function(){
  window.history.back();
});

/*****************************************************************************
***************************Cancel button end *********************************
******************************************************************************/

/*****************************************************************************
***********************Validate only numbers start ***************************
******************************************************************************/

$('body').on('keypress','.validate-no',function(event){
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode == 46){
       return false;
    }
    if (event.keyCode == 9 || event.keyCode == 8 || event.keyCode == 46) {
       return true;
    }
    else if ( key < 48 || key > 57 ) {
       return false;
    }
    else return true;
});

/*****************************************************************************
***********************Validate only numbers end *****************************
******************************************************************************/

/*****************************************************************************
****************For Phone no format 10 digits start **************************
******************************************************************************/

$('body').on('keyup', '.phone', function(e) {
  if(e.keyCode > 36 && e.keyCode < 41)
  {
      return true;
  }
  if ((e.keyCode > 47 && e.keyCode <58) || (e.keyCode < 106 && e.keyCode > 95))
  {
      this.value = this.value
      .match(/\d*/g).join('')
      .match(/(\d{0,3})(\d{0,3})(\d{0,4})/).slice(1).join('-')
      .replace(/-*$/g, '');
      return true;
  }
  this.value = this.value.replace(/[^\-0-9]/g,'');
});

/*****************************************************************************
****************For Phone no format 10 digits end ****************************
******************************************************************************/

/*****************************************************************************
****************Bootstrap common functions start *****************************
******************************************************************************/

$('.modal').on('hidden.bs.modal', function () {
  $('input, select, textarea').val('');
});

$('[data-toggle="tooltip"]').tooltip();

$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
  var id = $(e.target).attr("href").substr(1);
  window.location.hash = id;
});

var hash = window.location.hash;
$('ul.nav-tabs a[href="' + hash + '"]').tab('show');

/*****************************************************************************
****************Bootstrap common functions end *******************************
******************************************************************************/

});

/*****************************************************************************
****************Google address autocomplete start ****************************
******************************************************************************/

document.write("\<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCz7Bo_xQIywAxLvk5BRR5xz70VY2VhLPk&libraries=places&callback=initMap' type='text/javascript'>\<\/script>");

var autocomplete;
function initMap() {
    var class_exist = $('input').hasClass('google_autocomplete');
    if(class_exist == true){   
      autocomplete = new google.maps.places.Autocomplete(
          /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
          { types: ['geocode'] });
      google.maps.event.addListener(autocomplete, 'place_changed', function() {
      });
    }
}

/*****************************************************************************
****************Google address autocomplete end ******************************
******************************************************************************/

/*****************************************************************************
**********************Tinymce editor start ***********************************
******************************************************************************/

document.write("\<script src='//cdn.tinymce.com/4/tinymce.min.js' type='text/javascript'>\<\/script>");

function initEditor() {
    var class_exist = $('textarea').hasClass('mceEditor');
    if (class_exist == true) {
        tinymce.init({
            mode: "textareas",
            editor_selector: "mceEditor",
            theme: "modern",
            font_size_classes: "fontSize1, fontSize2, fontSize3, fontSize4, fontSize5, fontSize6",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],

            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | sizeselect | fontselect | fontsize | fontsizeselect",
            style_formats: [{
                title: 'Bold text',
                inline: 'b'
            }, {
                title: 'Red text',
                inline: 'span',
                styles: {
                    color: '#ff0000'
                }
            }, {
                title: 'Red header',
                block: 'h1',
                styles: {
                    color: '#ff0000'
                }
            }, {
                title: 'Example 1',
                inline: 'span',
                classes: 'example1'
            }, {
                title: 'Example 2',
                inline: 'span',
                classes: 'example2'
            }, {
                title: 'Table styles'
            }, {
                title: 'Table row 1',
                selector: 'tr',
                classes: 'tablerow1'
            }]
        });
    }
}

/*****************************************************************************
**********************Tinymce editor end *************************************
******************************************************************************/

window.onload = function() {
  initMap();
  initEditor();
};

/*****************************************************************************
*****************To show toaster messages start ******************************
******************************************************************************/

function showToaster(type,text)
{
    swal({
      html:true,
      title: (type == "error") ? "Error !" : "Success",
      text : text,
      timer: 3000
    });
}

/*****************************************************************************
*****************To show toaster messages end ********************************
******************************************************************************/

/*****************************************************************************
**********************Ajax loader start ***************************************
******************************************************************************/

function ajaxindicatorstart()
{
    if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
    jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="'+get_url()+'asset/img/ajax-loader.gif"><div>Loading...</div></div><div class="bg"></div></div>');
    }
    
    jQuery('#resultLoading').css({
        'width':'100%',
        'height':'100%',
        'position':'fixed',
        'z-index':'10000000',
        'top':'0',
        'left':'0',
        'right':'0',
        'bottom':'0',
        'margin':'auto'
    }); 
    
    jQuery('#resultLoading .bg').css({
        'background':'#000000',
        'opacity':'0.7',
        'width':'100%',
        'height':'100%',
        'position':'absolute',
        'top':'0'
    });
    
    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height':'75px',
        'text-align': 'center',
        'position': 'fixed',
        'top':'0',
        'left':'0',
        'right':'0',
        'bottom':'0',
        'margin':'auto',
        'font-size':'16px',
        'z-index':'10',
        'color':'#ffffff'
        
    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

/*****************************************************************************
**********************Ajax loader end ****************************************
******************************************************************************/

/*****************************************************************************
*******************Get Date/Time start ***************************************
******************************************************************************/

function getCurrentDate()
{
    var today = new Date();
    var dd = (today.getDate() >= 10) ? today.getDate() : "0"+today.getDate();
    var mm = (today.getMonth()+1 >= 10) ? today.getMonth()+1 : "0"+(today.getMonth()+1);
    var yyyy = today.getFullYear();
    var date = yyyy+'-'+mm+'-'+dd;
    return date;
}

function getCurrentTime()
{
   var d = new Date();
   var hours   = d.getHours();
   var minutes = (d.getMinutes() >= 10) ? d.getMinutes() : "0" + d.getMinutes();
   var ampm    = hours >= 12 ? 'PM' : 'AM';
   hours = (hours > 12)? hours -12 : hours;
   var time = (hours >= 10) ? hours : "0" +hours+":"+minutes+" "+ampm;
   return time;
}

/*****************************************************************************
*******************Get Date/Time end *****************************************
******************************************************************************/

/*****************************************************************************
****************To get query string from url start ***************************
******************************************************************************/

function getQueryStringValue(key)
{  
  return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));  
}

/*****************************************************************************
****************To get query string from url end *****************************
******************************************************************************/

function addZero(no)
{
  if(no >= 10){
    return no;
  }else{
    return "0".no;
  }
}

/*****************************************************************************
*******************To validate file start ************************************
******************************************************************************/

function validateFile(input,ext,size)
{
  var file_name = input.value;
  var split_extension = file_name.split(".").pop();
  var extArr = ext.split("|");
  if($.inArray(split_extension.toLowerCase(), extArr ) == -1)
  {
    $(input).val("");
    showToaster('error','You Can Upload Only .'+extArr.join(", ")+' files !');
    return false;
  }
  if(size != ""){
    
  }
}

/*****************************************************************************
*******************To validate file end **************************************
******************************************************************************/

/*****************************************************************************
*******************To check null value start *********************************
******************************************************************************/

function null_checker(check_val)
{
  if (typeof(default_val) === 'undefined') default_val = "";
  if(check_val == null || check_val == undefined || check_val == ""){
    return default_val;
  }else{
    return check_val;
  }
}

/*****************************************************************************
*******************To check null value end ***********************************
******************************************************************************/