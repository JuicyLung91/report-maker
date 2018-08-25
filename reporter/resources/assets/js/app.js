
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
console.log($);
console.log('test');

//Clone the hidden element and shows it
$('.add-one').click(function(){
  $('.dynamic-elements .row').first().clone().appendTo('.dynamic-elements').show();
  $('.dynamic-elements .row').last().find('.btn').toggleClass('btn-primary btn-danger delete').text('-');
  attach_delete();
  create_name_attributes();
});


//Attach functionality to delete buttons
function attach_delete(){
  $('.delete').click(function(){
    $(this).closest('.row').remove();
    create_name_attributes();
  });
}

function create_name_attributes() {
  $('#invalidDays').find('.row').each(function (index) {
    var date = $(this).find('input[type="date"]');
    console.log('date: ', date);
    var reason = $(this).find('input[type="text"]');
    console.log('reason: ', reason);

    $(date).attr('name', 'invalidDate['+index+'][date]');
    $(reason).attr('name', 'invalidDate['+index+'][reason]');
  });
}