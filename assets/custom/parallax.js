var pContainerHeight = $('#home-section').height();

$(window).scroll(function(){

    var wScroll = $(this).scrollTop();

    if (wScroll <= pContainerHeight) {
        var height = 100-(wScroll*90/pContainerHeight);
        $(".header-nav").addClass("sticky");
        $('#home-section').css({
            //'height' : height+"vh",
            'transform' : 'translate(0px, '+(wScroll*0.5) +'px)'
        });

        /*
        $('#home-section-logo-container').css({
            'transform' : 'translate(0px, '+ wScroll /4 +'%)'
        });

        $('#tag-line-container').css({
            'transform' : 'translate(0px, '+ wScroll /8 +'%)'
        });

        $('#tag-line-two-container').css({
            'transform' : 'translate(0px, '+ wScroll /3 +'%)'
        });

        $('#btn-meet-us-home').css({
            'transform' : 'translate(0px, '+ wScroll/50+'%)'
        });
        */

        var opacity = 1-(wScroll*1.5/pContainerHeight);
        var translate = -(wScroll*2 /100);
        $("#home-section .container").css({
            'opacity' : opacity,
            'transform' : 'translate(0px, '+translate +'%)'
        });

    }else{

    }
});