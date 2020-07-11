(function($) {
    $.fn.sameHeight = function() {
        var selector = this;
        var heights = [];
        selector.each(function() {
            var height = $(this).css('height', 'auto').height();
            heights.push(height);
        });
        var maxHeight = Math.max.apply(null, heights);
        selector.height(maxHeight);
    };
}(jQuery));

$(document).ready(function() {
    $(".navtabs li").click(function(event) {
        var _this = $(this),
            _tabs = _this.attr('id-tabs');
        $(".navtabs li").removeClass('active');
        _this.addClass('active');
        $(".tab-content div").removeClass('active');
        $("#" + _tabs).addClass('active');
    });
    $(window).on('load resize', function() {
        $(".opacity").css({ 'opacity': '1', 'visibility': 'visible', 'max-height': '100%' });
        $('.sameheight .box-sp').sameHeight();
        $('.sameHeight2 .box-sp').sameHeight();
    });

    $(window).on('scroll', function(event) {
        event.preventDefault();
    });
});
new WOW().init();