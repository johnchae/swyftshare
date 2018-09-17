var main = function() {
    $(".icon-sidemenu").click(function() {
        if ($(".sidemenu").css("left") == "-230px") {
            $(".sidemenu").animate({
               left: "0px"
            }, 500);
        }
        else {
            $(".sidemenu").animate({
               left: "-230px"
            }, 500);
        }
    });
    $(".display").click(function() {
        if ($(".sidemenu").css("left") == "0px") {
            $(".sidemenu").animate({
               left: "-230px"
            }, 500);
        }
    });
}
    
$(document).ready(main);