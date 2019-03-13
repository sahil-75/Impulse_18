$(function() {
    $(document).on('click', 'a.page-scroll', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top-70
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});