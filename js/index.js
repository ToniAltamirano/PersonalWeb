// function updateIcon(num,id){
//     var nav = $('.navegacion');
//     var count = 0;
//     $('html, body').animate({
//         scrollTop: $("#"+id).offset().top
//     }, 600);
//     nav.children().each(function(){
//         if($(this).html()=='<i class="fas fa-circle"></i>'){
//             $(this).html('<i class="far fa-circle"></i>')
//         }
//         if(count==num){
//             $(this).html('<i class="fas fa-circle"></i>')
//         }
//         count++;
//     })
// }
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
$(document).ready(function () {

    // $('#fullpage').fullpage();

    var $navs = $(".navegacion a");
        for (var i = 0; i < $navs.length; i++){
            var navElem = $($navs[i]);
            var nextElem = $($navs[i + 1]);
            if (nextElem.length !== 0 ? ($(navElem.attr("href")).offset().top <= (document.documentElement.scrollTop + 200) && $(nextElem.attr("href")).offset().top >= (document.documentElement.scrollTop + 200)) : $(navElem.attr("href")).offset().top <= (document.documentElement.scrollTop + 200)){
                navElem.find('.palito').addClass('palitoSelected');
            } else{
                navElem.find('.palito').removeClass('palitoSelected');
            }
        }
        
    window.onscroll = function() {
        var $navs = $(".navegacion a");
        for (var i = 0; i < $navs.length; i++){
            var navElem = $($navs[i]);
            var nextElem = $($navs[i + 1]);
            if (nextElem.length !== 0 ? ($(navElem.attr("href")).offset().top 
            <= (document.documentElement.scrollTop + 200) && 
            $(nextElem.attr("href")).offset().top >= (document.documentElement.scrollTop + 200)) 
            : $(navElem.attr("href")).offset().top <= (document.documentElement.scrollTop + 200)){
                navElem.find('.palito').addClass('palitoSelected');
            } else{
                navElem.find('.palito').removeClass('palitoSelected');
            }
        }
    };
});

