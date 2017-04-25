$(document).ready(function(){
  site_url = get_url();

  jQuery('#example').dataTable({
    aoColumnDefs: [
    {
       bSortable: false,
       aTargets: [0]
    }
  ]
  });


/**************** Cancel Button Script Start *************/

$('body').on('click','.cancel-btn',function(){
  $('.download-salary').attr('href','javascript:void(0)');
  $('input:not([type="radio"])').val("");
  $('select:not([name="autoupdate_salary_length"],[name="team_salary_length"])').val("");
  $('#featured').prop('checked',false);
  $('#upload-file-info').html("");
  $('.file_btn').addClass('hidden');
  $('#sport').val('').trigger('chosen:updated');
  $('#match_detail').html("").hide();
  $('#match_select').hide();
  $('#autoupdate').val('Auto-update');
  $('#match_detail_daliy, #match_select_daliy').hide();
  tinyMCE.activeEditor.setContent('');
});

/**************** Cancel Button Script End ***************/

function showToaster(type,text){
    var myToast = $().toastmessage('showToast', {
        text     : text,
        sticky   : true,
        position : 'top-right',
        type     : type,
        close    : function () {console.log("toast is closed ...");}
    });
    setTimeout(function(){
        $().toastmessage('removeToast', myToast);
    },4000);
}
});

function validateNumbers(event) {
  if (event.keyCode == 46){
    return false;
  }
  var key = window.event ? event.keyCode : event.which;
  if (event.keyCode == 9 || event.keyCode == 8 || event.keyCode == 46) {
      return true;
  }
  else if ( key < 48 || key > 57 ) {
      return false;
  }
  else return true;
};

window.onload = function() {
  initEditor();
};

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
