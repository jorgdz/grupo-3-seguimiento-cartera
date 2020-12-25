
$(document).ready(function(){
    
  
    /**MODULO QUE MUESTRA LA CANTIDAD DE REGISTRO DEL DIA */
    var clientes = $("#cantidad");
   

    var ventas = $("#ventas");
    var putostt = $("#putostt");
    var porcentajett = $("#porcentajett");
    var incompletas = $("#incompletas");
    var interesados = $("#interesados");
    var dnc = $("#dnc");

    var putott = $("#putott");
    var porcentajestt = $("#porcentajestt");


    var tablaDatos = $("#tablaDatos");


     var route = "http://damplus.net/agendadatos";
    
    
    $.get(route, function(res){
       
        $(res).each(function (index,value){
            
           

        clientes.append(value.clientestocados);
        ventas.append(value.ventas);
        putostt.append(value.ttpuntos);
        porcentajett.append(value.ttporcentajes);

        incompletas.append(value.incompletas);
        interesados.append(value.interesados);
        dnc.append(value.nodesea);

        putott.append(value.ttpuntos);
        porcentajestt.append(value.ttporcentajes);
        var agendados = value.agendados;
   
            $(agendados).each(function (index,value){
                var hora = value.hora;
              
                console.log(hora);
                tablaDatos.append("<tr><td>"+value.cedula+"</td><td>"+value.Campo2+"</td><td>"+value.Descripcion+"</td><td>"+value.telefonoNuevo+"</td><td>"+value.fecha+"</td><td>"+hora+"</td><td style='width: 5px'> <a href='http://damplus.net/agendadatos/show/"+value.cedula+"/"+value.campana+"' class='btn btn-sm btn-info'><i class='fa fa-eye'></i></a></td></tr>");
                
            });
           
    
    
        });

    });
    

    

  


});