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
         /*else {
            $("#text_nvo_mensaje").replaceWith('<input class="form-control search-text" placeholder="(Enter para enviar)" type="text" id="text_nvo_mensaje" name="query" autocomplete="off">');
        }*/
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
                            data.output.text[0]+
                        '</p>'+
                        '<p class="chat-time">'+
                            getTime()+
                        '</p>'+
                    '</div>'+
                '</div>'+
            '</div>'
          );
          
          getAudio(data.output.text[0],1);// asistente de voz
        $("#cont_mensajes_chat").scrollTop($("#cont_mensajes_chat")[0].scrollHeight);
      })
    });
    $("#cont_mensajes_chat").scrollTop($("#cont_mensajes_chat")[0].scrollHeight);
  });

  $("#form_mensaje").on("submit", function(event) {
    event.preventDefault();
    enviar_mensaje($(this).serialize());
    setTimeout(mostrarMapa, 1000);
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
