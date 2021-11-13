$(document).ready(function() {
    $(".alert").delay(4000).slideUp(200, function() {
        $(this).alert('close');
    });

    $('#tableLivre').DataTable();
    $('#userTable').DataTable();
    $('.paginate_button').addClass('btn btn-light shadow current mx-3');
    $('.paginate_button').removeClass('paginate_button current');
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });
});
