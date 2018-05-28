$(document).ready(function() {
  function checkTime(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }

  function getTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    return h + ":" + m + ":" + s;
  }

  $("#hora_inicio").text(getTime());

  var enviar_mensaje = (function(datos) {
    console.log(datos);
    $("#cont_mensajes_chat").
      append(''+
          '<div class="media chat-messages">'+
              '<div class="media-body chat-menu-reply">'+
                  '<div class="">'+
                      '<p class="chat-cont">'+
                          $("#text_nvo_mensaje").val()+
                      '</p>'+
                      '<p class="chat-time">'+
                          getTime()+
                      '</p>'+
                  '</div>'+
              '</div>'+
              '<div class="media-right photo-table">'+
                  '<a href="#!">'+
                      '<img alt="Generic placeholder image" class="media-object img-circle m-t-5" src="public/assets/images/avatar-2.png">'+
                      '</img>'+
                  '</a>'+
              '</div>'+
          '</div>'
      );
    $("#text_nvo_mensaje").val("");
    //Aquí solicitamos la respuesta
    $.ajax({
      type: "POST",
      url: BASE_URL + "preguntar",
      data: datos,
      success: (function(data) {
        console.log(data);
        if (data['chat_ui']) {
          if(data['chat_ui']['datepicker']) {
            console.log('GOT IN');
            $("#text_nvo_mensaje").replaceWith('<input type="text" name="daterange" class="form-control" id="text_nvo_mensaje">');            
          }
        } 
        //llamado al mapa o la grafica
        if (data['output']) {
          if (data['output']['datos']) {
            if (data['output']['datos']['pintaFrame']) {
                 setTimeout(ocultarMapa, 500);
                 setTimeout(ocultarGrafica, 500);
                if (data['output']['datos']['pintaFrame'] == "Mapa") {

                  var post_array = 
                  {
                    "entrada" : data['output']['datos']['region'] ? data['output']['datos']['region'] : data['output']['datos']['estados'],
                    "estado" : data['output']['datos']['estados'] ? "true" : "false"
                  }

                  //alert(JSON.stringify(post_array));
                  //Aqui generamos el JSON del mapa y lo incrustamos en el HTML
                  $.post(BASE_URL + "GeneraJSON/mapa", post_array,
                    function(data)
                    {
                        var res = jQuery.parseJSON(data);
                        alert(JSON.stringify(res));
                        //$('#mapaJSON').HTML('');
                        //$('#mapaJSON').append(data);
                        //$(".mapcontainer").mapael(jQuery.parseJSON(data));

                        var replaceOptions = true;
                        var mapOptions = {"areas" : res};
                        //mapOptions['areas'] = {};


                        $(".mapcontainer").trigger('update', [{replaceOptions}, {mapOptions}, {animDuration : 1000}]);
                    });

                 setTimeout(mostrarMapa, 1000);

               }
               if (data['output']['datos']['pintaFrame'] == "Grafica") {
                 setTimeout(mostrarGrafica, 1000);                 

               }
            }
          }
        }

        $("#cont_mensajes_chat").
          append(''+
            '<div class="media chat-messages">'+
                '<a class="media-left photo-table" href="#!">'+
                    '<img alt="Generic placeholder image" class="media-object img-circle m-t-5" src="public/assets/images/watson.png">'+
                    '</img>'+
                '</a>'+
                '<div class="media-body chat-menu-content">'+
                    '<div class="">'+
                        '<p class="chat-cont">'+
                            data.output.text+
                        '</p>'+
                        '<p class="chat-time">'+
                            getTime()+
                        '</p>'+
                    '</div>'+
                '</div>'+
            '</div>'
          );
          getAudio(data.output.text,1);// asistente de voz
        $("#cont_mensajes_chat").scrollTop($("#cont_mensajes_chat")[0].scrollHeight);
      })
    });
    $("#cont_mensajes_chat").scrollTop($("#cont_mensajes_chat")[0].scrollHeight);
  });

  $("#form_mensaje").on("submit", function(event) {
    event.preventDefault();
    enviar_mensaje($(this).serialize());
  });

  $("#text_nvo_mensaje").keydown(function(e) {
    var code = e.which;
    if (code == 13) {
      e.preventDefault();
      //$("#text_nvo_mensaje").val($("#text_nvo_mensaje").val().replace(/(\r\n\t|\n|\r\t)/gm,""));
      $("#form_mensaje").submit();
    }
  });
});
