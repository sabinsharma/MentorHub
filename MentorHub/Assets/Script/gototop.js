//Go to Top
$(function() {
    var topBtn = $('#page-top');    
    topBtn.hide();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) { // When scroll over 100
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
});