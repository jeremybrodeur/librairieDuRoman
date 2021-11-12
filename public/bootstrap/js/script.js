$(document).ready(function() {
    $(".alert").delay(4000).slideUp(200, function() {
        $(this).alert('close');
    });

    $('#tableLivre').DataTable();
    $('#userTable').DataTable();
    $('.paginate_button').addClass('btn btn-light shadow current mx-3');
    $('.paginate_button').removeClass('paginate_button current');
});
