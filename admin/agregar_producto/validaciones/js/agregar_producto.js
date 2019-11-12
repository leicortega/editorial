
$("#agg_producto").submit(function () {

    var frData = new FormData();
    frData.append("imagen", $("#imagen")[0].files[0]);
    
    $.ajax({
        url: "../agregar-producto.php",
        type: "POST",
        data: frData,
        processDate: "false",
        contentType: "false",
        cache: "false",
        success: function (data) {
            console.log("Bien");
            alert("bien");
        }
    });

    return false;

});