$(document).ready(function() {

	$('#backtotop').click(function(event) {
		event.preventDefault();
		$('html , body').animate({scrollTop:0}, 1000);		
	});


	$(window).scroll(function() {
        if ( $(this).scrollTop() > 2){
            $('#backtotop').fadeIn();
        } else {
            $('#backtotop').fadeOut();
        }
    });

});

function func_addtocart() {    
    const queryString = window.location.search;
    const contents = Object.fromEntries(new URLSearchParams(queryString));
    $.ajax({
        url:'../php/form_addtocart.php',
        type: 'post',
        dataType: 'json',
        data: contents,
        success: function(data){
            if(data.success)
            {
                alert("商品已加入購物車");
            }
            if(!data.login)
            {
                alert("請先登入");
            }
        }
    })
}




 