/**
 * Created by agupta on 5/24/17.
 */

$(document).ready(function() {
    $('.header').nextUntil('tr.header').slideToggle(100, function(){
    });
});

$('.header').click(function(){
    $(this).find('span').text(function(_, value){return value=='Show'?'Hide':'Show'});
    $(this).nextUntil('tr.header').slideToggle(100, function(){
    });
});