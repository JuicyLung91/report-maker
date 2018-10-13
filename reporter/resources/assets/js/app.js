
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



//Clone the hidden element and shows it
$('.add-one').click(function(){
  
  var thisForm = $(this).closest('form');
  var thisdynamic = $(this).closest('.dynamic-elements');
  thisdynamic.find('.row').first().clone().appendTo(thisdynamic).show();
  thisdynamic.find('.row').last().find('.btn').toggleClass('btn-primary btn-danger delete').text('-');
  attach_delete();
  create_name_attributes(thisForm);
});


//Attach functionality to delete buttons
function attach_delete(){
  $('.delete').click(function(){
    $(this).closest('.row').remove();
    create_name_attributes();
  });
}

function create_name_attributes(form) {
  var data = $(form).data('getname');
  $(form).find('.row').each(function (index) {
    console.log('index: ', index);
    var inputs = $(this).find('input');
    inputs.each(function() {
      var getname = $(this).data('getname');
      $(this).attr('name', data+'['+index+']['+getname+']');
    });

    // var date = $(this).find('input[type="date"]');
    
    // var reason = $(this).find('input[type="text"]');
    

    // $(date).attr('name', data+'['+index+'][date]');
    // $(reason).attr('name', data+'['+index+'][reason]');
  });
}