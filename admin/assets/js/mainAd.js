
function ActualizarHora(){
    var fecha = new Date();
    var segundos = fecha.getSeconds();
    var minutos = fecha.getMinutes();
    var horas = fecha.getHours();
 
    var elementoHoras = document.getElementById("pHoras");
    var elementoMinutos = document.getElementById("pMinutos");
    var elementoSegundos = document.getElementById("pSegundos");
 
    var sufijo = ' am';
    if(horas > 12) {
      horas = horas - 12;
      sufijo = ' pm';
    }

    if(minutos < 10) { minutos = '0' + minutos; }
    if(segundos < 10) { segundos = '0' + segundos; }

    elementoHoras.textContent = horas;
    elementoMinutos.textContent = minutos;
    elementoSegundos.textContent = segundos + ' ' + sufijo;
    

}
 
setInterval(ActualizarHora,1000);