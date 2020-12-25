$(document).ready(function(){
    jQuery(document).ready(function(){
        jQuery('#registro').click(function(e){
           e.preventDefault();
           $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });
           jQuery.ajax({
              url: "{{ url('/agendar/post') }}",
              method: 'post',
              data: {
                 "_token": $("meta[name='csrf-token']").attr("content"),
                 telefonoContacto: jQuery('#telefonoContacto').val(),
                 contacto: jQuery('#contacto').val(),
                 telefonoNuevo: jQuery('#telefonoNuevo').val(),
                 contactarcel: jQuery('#contactarcel').val(),
                 codigoArea: jQuery('#codigoArea').val(),
                 convencional: jQuery('#convencional').val(),
                 contactarconv: jQuery('#contactarconv').val(),
                 comentario: jQuery('#comentario').val(),
                 fecha: jQuery('#fecha').val(),
                 hora: jQuery('#hora').val(),
                 turno: jQuery('#turno').val(),
                 IdCampañaPersona: jQuery('#IdCampañaPersona').val(),
                 IdCampaña: jQuery('#IdCampaña').val(),
                 comentario: jQuery('#comentario').val(),
                 comentario: jQuery('#comentario').val()
              },
              success: function(result){
                 console.log(result);
              }});
           });
        });

});