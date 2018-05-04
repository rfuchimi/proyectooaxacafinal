<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Telcel - Watson</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/fontawesome-all.min.css">
  <link rel="stylesheet" type="text/css" href="public/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
  <div class="progress" style="display: none;">
    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
  </div>
  <!-- primary -->
  <ul class="nav nav-tabs bg-primary">
    <li class="nav-item">
      <a class="nav-link" href="#">Inicio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Chat</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Otra función</a>
    </li>
    <div class="align-self-center ml-3 float-right" id="menu_usuario">
          <div class="dropdown">
            <button class="btn bmd-btn-icon dropdown-toggle" type="button" id="ex2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user" id="icono_menu"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="ex1">
              <button class="dropdown-item" type="button">Ver perfil</button>
              <button class="dropdown-item" type="button">Configurar</button>
              <button class="dropdown-item" type="button">Salir</button>
            </div>
          </div>
    </div>
  </ul><br>
  <div class="" id="contenedor">
        <div class="row" id="cont_todo">
            <div class="col-4" id="cont_chat">
                <div class="row border" id="cont_mensajes_chat">
                    <!-- <div class="card mensaje bg-info" style="width: 95%;">
                      <div class="card-body">
                        <p class="card-title">Usuario</p>
                        <div class="contenedor_cuerpo_mensaje">
                            <p class="card-text">Esto contendrá el cuerpo del mensaje</p>
                        </div>
                      </div>
                      <img src="public/img/user.png" width="45px" class="img_chat_mensaje">
                    </div> -->
                    <div class="card saludo bg-success">
                      <div class="card-body">
                        <p class="card-title">Bienvenido</p>
                      </div>
                      <img src="public/img/ibm-watson_logo.png" width="45px" class="img_chat_saludo">
                    </div>
                </div>
                <div class="row border" id="cont_enviar_mensaje_chat">
                    <form class="form-inline" id="form_mensaje">
                        <div class="form-group" id="form_enviar_mensaje">
                            <label for="text_nvo_mensaje" class="bmd-label-floating">Nuevo mensaje (Enter para enviar)</label>
                            <textarea class="form-control" id="text_nvo_mensaje" cols="35" name="query"></textarea>
                        </div>
                        <button type="button" onclick="enviar_mensaje()" class="btn btn-primary btn-raised" id="btn_send"><i class="fas fa-share-square"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-8 border" id="cont_resultados">
                resultados
            </div>
        </div>
    </div>
    <script type="text/javascript" src="public/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="public/js/popper.js"></script>
    <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/js/fontawesome-all.min.js"></script>
    <script type="text/javascript" src="public/js/bootstrap-material-design.min.js"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
    <script type="text/javascript" src="public/js/main.js"></script>
</body>
</html>
