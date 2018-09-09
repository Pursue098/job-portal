 $(function() {
            var offset = $("#sidebar").offset();
            var offset_footer_height = $("#footer").height();
            var offset_footer = $("#footer").offset().top - offset_footer_height;
            var topPadding = 15;
            $(window).scroll(function() {
           if (offset_footer > $(window).scrollTop()) {
                    $("#sidebar").stop().animate({
                        marginTop: offset_footer
                    }, 0);
                
                if ($(window).scrollTop() > offset.top) {
                    $("#sidebar").stop().animate({
                        marginTop: $(window).scrollTop() - offset.top + topPadding
                    }, 0);
                }
                else {
                    $("#sidebar").stop().animate({
                        marginTop: 0
                    }, 0);
                };
           }
            });
        });