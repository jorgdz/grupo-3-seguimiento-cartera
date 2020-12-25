
$(document).ready(function(){
    
  
    /**MODULO QUE MUESTRA LA CANTIDAD DE REGISTRO DEL DIA */
    var clientes = $("#cantidad");
    var saldo = $("#saldo");

    var pagos = $("#pagos");
    var porcentaje = $("#porcentajepagos");
    var valors = $("#valors");
    var porcentajevalor = $("#porcentajevalor");
    var valors2 = $("#valors2");
    var porcentajevalor2 = $("#porcentajevalor2");

    var compromisostt = $("#compromisostt");
    var valorcompromiso = $("#valorcompromiso");
    var porcentajecompromisovalor = $("#porcentajecompromisovalor");
    var porcentajecompromiso = $("#porcentajecompromiso");


    var incumplidos = $("#incumplidos");
    var porcentajeincumplido = $("#porcentajeincumplido");
    var valorincumplido = $("#valorincumplido");
    var porcentajeincumplidovalor = $("#porcentajeincumplidovalor");

    var descripcionllmadas = $("#descripcion");
    var asignado = $("#asignado");
    var llamadastt = $("#llamadastt");
    var efectivos = $("#efectivos");
    var tocados = $("#tocados");
    var productividad = $("#productividad");


    var route = "http://damplus.net/bandeja/datos";
    $.get(route, function(res){
       
        $(res).each(function (index,value){
            
            var clientestt = value.cantidad;
            var saldodeuda=0;
            clientestt.forEach(function (elemento, indice, array) {
                cantidaclientes =elemento.CLIENTES;
                 saldodeuda     = parseFloat(elemento.SALDO).toFixed(2);
            });

            var pagostt = value.pagos;
            var recaudado=0;
            var cantidadpagos=0;
            pagostt.forEach(function (elemento, indice, array) {
                 cantidadpagos =elemento.pagos;
                recaudado     = parseFloat(elemento.valor).toFixed(2) ;
            });

            var compromisott = value.compromisostt;
            var valorcompromisos=0;
            var cantidadcompromisos=0;
            compromisott.forEach(function (elemento, indice, array) {
                 cantidadcompromisos=elemento.clientes;
                valorcompromisos     = parseFloat(elemento.valor).toFixed(2) ;
            });

            var incumplidostt = value.incumplidostt;
            var valorincumplidos=0;
            var cantidadincumplido=0;
            incumplidostt.forEach(function (elemento, indice, array) {
                cantidadincumplido=elemento.clientes;
                 valorincumplidos     = parseFloat(elemento.valor).toFixed(2);
            });


            var gestionesllamadas = value.llamadas;
            var llamadastotale=0;
            var descripcionllmada=0;
            var asignados=0;
            var efectividads=0;
            var clientestocados=0;
            gestionesllamadas.forEach(function (elemento, indice, array) {
                llamadastotale = elemento.llamadastotales;
                descripcionllmada = elemento.area;
                asignados = elemento.asignados;
                efectividads = elemento.efectividad;
                clientestocados = elemento.clientestocados;
            });

         
           

     if(cantidaclientes > 1){
         porcentajepagos =  Math.round(cantidadpagos * 100/cantidaclientes);
     }
     
     if(cantidaclientes > 1){
        porcentajecompromisos =  Math.round(cantidadcompromisos * 100/cantidaclientes);
        porcentajecompromisovalors=  Math.round(valorcompromisos * 100/saldodeuda);
    }
   

    if(cantidaclientes > 1){
        porcentajeincumplidox =  Math.round(cantidadincumplido * 100/cantidaclientes);
        porcentajeincumplidosovalors =  Math.round(valorincumplidos * 100/saldodeuda);
       // console.log(porcentajeincumplidosovalors);
    }

    if(cantidaclientes > 1){
        porcentajerecuperado =  Math.round(recaudado * 100/saldodeuda);
    }

    var productividads = 0;
    if(clientestocados > 1){
        productividads =  Math.round(efectividads  * 100/clientestocados);
    }


  

        clientes.append(cantidaclientes);
        saldo.append(saldodeuda);
        porcentaje.append(porcentajepagos);

        pagos.append(cantidadpagos);
        valors.append(recaudado);
        porcentajevalor.append(porcentajerecuperado);
     
        valors2.append(recaudado);
        porcentajevalor2.append(porcentajerecuperado);

        compromisostt.append(cantidadcompromisos);
        valorcompromiso.append(valorcompromisos);
        porcentajecompromisovalor.append(porcentajecompromisovalors);
        porcentajecompromiso.append(porcentajecompromisos);

        incumplidos.append(cantidadincumplido);
        porcentajeincumplido.append(porcentajeincumplidox);

        valorincumplido.append(valorincumplidos);
        porcentajeincumplidovalor.append(porcentajeincumplidosovalors);

        llamadastt.append(llamadastotale);
        descripcionllmadas.append(descripcionllmada);
        asignado.append(asignados);
        efectivos.append(efectividads);
        tocados.append(clientestocados);
        productividad.append(productividads);
        });

    });

  
});