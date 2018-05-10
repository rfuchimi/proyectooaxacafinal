<!DOCTYPE html>
<html lang="en">
    <head>
      <title>
          Telcel - <?= explode("_", $this->router->fetch_class())[0] ?>
      </title>
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
			<meta charset="utf-8" />
			<meta content="IE=edge" http-equiv="X-UA-Compatible" />
			<meta content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" name="viewport" />
			<meta content="#" name="description" />
			<meta content="flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app" name="keywords" />
			<meta content="#" name="author" />
			<link href="public/assets/images/telcel_icon.png" rel="icon" type="image/x-icon" />
			<!-- <link href="https://fonts.googleapis.com/css?family=Mada:300,400,500,600,700" rel="stylesheet" /> -->
			<link href="public/bower_components/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/icon/themify-icons/themify-icons.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/icon/icofont/css/icofont.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/pages/flag-icon/flag-icon.min.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/icon/SVG-animated/svg-weather.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/pages/menu-search/css/component.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/pages/dashboard/horizontal-timeline/css/style.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/pages/dashboard/amchart/css/amchart.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/pages/widget/calender/pignose.calendar.min.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/pages/flag-icon/flag-icon.min.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/css/style.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/icon/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" />
			<link href="public/assets/css/linearicons.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/css/simple-line-icons.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/css/ionicons.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
			<link href="public/assets/css/estilo.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="theme-loader">
            <div class="ball-scale">
                <div>
                </div>
            </div>
        </div>
        <div class="pcoded" id="pcoded">
            <div class="pcoded-overlay-box">
            </div>
            <div class="pcoded-contentainer navbar-wrapper">
                <nav class="navbar header-navbar pcoded-header" style="position: absolute; left: 0; top: 0;">
                    <div class="navbar-wrapper">
                        <div class="navbar-logo" data-navbar-theme="theme4">
                            <a class="mobile-menu" href="#!" id="mobile-collapse">
                                <i class="ti-menu">
                                </i>
                            </a>
                            <a href="/">
                                <img alt="Theme-Logo" class="img-fluid" src="public/assets/images/telcel/logo.png" width="130px"/>
                            </a>
                            <a class="mobile-options">
                                <i class="ti-more">
                                </i>
                            </a>
                        </div>
                        <div class="navbar-container container-fluid">
                            <div>
                                <ul class="nav-left">
                                    <li>
                                        <div class="sidebar_toggle">
                                            <a href="javascript:void(0)">
                                                <i class="ti-menu">
                                                </i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="nav-right">
																	<li class="user-profile header-notification">
																		<a href="#!" class="userlist-box">
																			<img src="public/assets/images/chat.png" alt="User-Profile-Image">
																			 	<span>Chat</span>
																			<i class="ti-angle-down"></i>
																		</a> 
																		<!-- <div class="userlist-box">
																			<a class="" href="#!">
																				<img src="public/assets/images/chat.png" alt="Chat image" width="32px">
																			</a>
																			<div class="media-body">
																				<div class="f-13 chat-header">Chat</div>
																			</div>						
																		</div> -->
																	</li>
																</ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar">
                            <div class="sidebar_toggle">
                                <a href="#">
                                    <i class="icon-close icons">
                                    </i>
                                </a>
                            </div>
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">
                                    Navegar
                                </div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu active pcoded-trigger">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon">
                                                <i class="ti-home">
                                                </i>
                                            </span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">
                                                Menú principal
                                            </span>
                                            <span class="pcoded-mcaret">
                                            </span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="<?= explode('_', $this->router->fetch_class())[0] == 'Inicio' ? 'active' : '' ?>">
                                                <a href="/">
                                                    <span class="pcoded-micon">
                                                        <i class="fa fa-address-book-o">
                                                        </i>
                                                    </span>
                                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">
                                                        Inicio
                                                    </span>
                                                    <span class="pcoded-mcaret">
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="<?= explode('_', $this->router->fetch_class())[0] == 'Chat' ? 'active' : '' ?>">
                                                <a href="#" class="userlist-box">
                                                    <span class="pcoded-micon">
                                                        <i class="ti-angle-right">
                                                        </i>
                                                    </span>
                                                    <span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">
                                                        Chat
                                                    </span>
                                                    <span class="pcoded-mcaret">
                                                    </span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="#">
                                                    <span class="pcoded-micon">
                                                        <i class="ti-angle-right">
                                                        </i>
                                                    </span>
                                                    <span class="pcoded-mtext" data-i18n="nav.dash.crm">
                                                        Ajustes
                                                    </span>
                                                    <span class="pcoded-mcaret">
                                                    </span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="#">
                                                    <span class="pcoded-micon">
                                                        <i class="ti-angle-right">
                                                        </i>
                                                    </span>
                                                    <span class="pcoded-mtext" data-i18n="nav.dash.analytics">
                                                        Salir
                                                    </span>
                                                    <span class="pcoded-mcaret">
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <div class="page-header">
                                            <div class="page-header-title">
                                                <h4>
                                                    <?= explode("_", $this->router->fetch_class())[0] ?>
                                                </h4>
                                            </div>
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="/">
                                                            <i class="icofont icofont-home">
                                                            </i>
                                                        </a>
                                                    </li>
                                                    <li class="breadcrumb-item">
                                                        <a href="#">
                                                            Menú
                                                        </a>
                                                    </li>
                                                    <li class="breadcrumb-item">
                                                        <a href="#!">
                                                            <?= explode("_", $this->router->fetch_class())[0] ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="page-body">


<!-- Contenido del CHAT -->
<div class="showChat_inner" id="all_chat">
    <div class="media chat-inner-header">
        <a class="back_chatBox">
            <i class="icofont icofont-rounded-left">
            </i>
            Chat
        </a>
    </div>
    <div id="cont_mensajes_chat">
    	<div class="media chat-messages">
	        <a class="media-left photo-table" href="#!">
	            <img alt="Imagen watson" class="media-object img-circle m-t-5" src="public/assets/images/watson.png">
	            </img>
	        </a>
	        <div class="media-body chat-menu-content">
	            <div class="">
	                <p class="chat-cont">
	                    Puedes empezar por un saludo
	                </p>
	                <p class="chat-time">
	                    <?= date("h:m:s") ?>
	                </p>
	            </div>
	        </div>
	    </div>
    </div>
    <div class="chat-reply-box p-b-20">
        <div class="right-icon-control">
        	<form class="form-inline" id="form_mensaje" >
        		<input class="form-control search-text" placeholder="(Enter para enviar)" type="text" id="text_nvo_mensaje" name="query" autocomplete="off">
        		<div class="form-icon" id="form_mensaje">
            		<button type="submit" id="btn_send_message">
                <i class="icofont icofont-paper-plane"></i>
                </button>
            </div>
		      </form>
        </div>
    </div>
</div>