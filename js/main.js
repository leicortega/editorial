$(document).ready(function () {
    $("#modalLogin").load('assets/html/login.html');

    // Peticion AJAX para mostrar los productos
    $.ajax({
        type: 'POST',
        url: 'assets/php/consultar_productos.php',
        success: function(data) {
            $("#favoritos").html(data);
        }
    });
});

function login() {
    $('#myModal').modal('show');
}
