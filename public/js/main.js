var enviar_mensaje = (function(datos) {
  console.log(datos);
  $(".progress").show();
  $("#cont_mensajes_chat").
    append(''+
    		'<div class="card mensaje bg-info" style="width: 95%;">'+
          '<div class="card-body">'+
            '<p class="card-title">Usuario</p>'+
            '<div class="contenedor_cuerpo_mensaje">'+
              '<p class="card-text">' + $("#text_nvo_mensaje").val() + '</p>'+
            '</div>'+
          '</div>'+
          '<img src="public/img/user.png" width="45px" class="img_chat_mensaje">'+
        '</div>'
    );
  $("#text_nvo_mensaje").val("");
  //Aquí solicitamos la respuesta
  $.ajax({
    type: "POST",
    url: "/preguntar",
    data: datos,
    success: (function(data) {
      $("#cont_mensajes_chat").
        append(''+
          '<div class="card respuesta bg-success" style="width: 95%;">'+
            '<div class="card-body">'+
              '<p class="card-title">ChatBot</p>'+
              '<div class="contenedor_cuerpo_mensaje">'+
                  '<p class="card-text">' + data.output.text[0] + '</p>'+
              '</div>'+
              '<button class="btn btn-default">Gráfica</button> '+
              '<button class="btn btn-default">Mapa</button>'+
            '</div>'+
            '<img src="public/img/ibm-watson_logo.png" width="45px" class="img_chat_respuesta">'+
          '</div>'
        );
      $("#cont_mensajes_chat").scrollTop($("#cont_mensajes_chat")[0].scrollHeight);
      $(".progress").hide();
    })
  });
  $("#cont_mensajes_chat").scrollTop($("#cont_mensajes_chat")[0].scrollHeight);
});

$("#form_mensaje").on("submit", function(event) {
  event.preventDefault();
  enviar_mensaje($(this).serialize());
});

$("#text_nvo_mensaje").keyup(function(e) {
	var code = e.which;
  if (code == 13) e.preventDefault();
  if (code == 13) {
    $("#text_nvo_mensaje").val($("#text_nvo_mensaje").val().replace(/(\r\n\t|\n|\r\t)/gm,""));
    $("#form_mensaje").submit();
  }
});