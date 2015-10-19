jQuery(document).ready(function(){

    //Ajax loading
    $(document).on({
        ajaxStart: function() { $(".main").addClass("loading"); $(".modalLoad").css("display", "block"); },
        ajaxStop: function() { $(".main").removeClass("loading"); $(".modalLoad").css("display", "none"); }
    });
});
