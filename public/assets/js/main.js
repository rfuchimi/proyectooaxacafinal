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
      url: "preguntar",
      data: datos,
      success: (function(data) {
        console.log(data);
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
