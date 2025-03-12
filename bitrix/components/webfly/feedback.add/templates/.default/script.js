$(document).ready(function () {
    $("#send").on('click', function () {
        $("#basketform").ajaxSubmit(function(){
            $('#orderCart').modal('hide').delay(500).queue(function(){
                showThanks();
                $(this).dequeue();
            });
        });
        $(".cart-modal .blog-content").html("<p class='sucorder'>Ваш заказ принят!</p>");
        $(".cart-modal").css({"width":"250px", "height":"60px",});
       setTimeout(function(){location.reload();},1900);
              
    });
});