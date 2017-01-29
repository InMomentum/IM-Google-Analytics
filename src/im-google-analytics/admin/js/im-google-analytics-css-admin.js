(function($) {
    'use strict';
    $(window).load(function() {

        $('.im-nav-tab-content').hide();
        $('.im-nav-tab-content[im-nav-tab-content=' + $('.nav-tab.nav-tab-active').attr('im-nav-tab-for') + ']').show();

        $('.nav-tab').click(function() {

            $('.im-nav-tab-content').hide();

            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');

            $('.im-nav-tab-content[im-nav-tab-content=' + $(this).attr('im-nav-tab-for') + ']').show();
        });
    });
})(jQuery);
