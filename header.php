<!DOCTYPE html>
<html class="no-js" itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?>>
<head>

  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico">
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

  <!-- RSS -->
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0 Feed para los artículos de Código Nuevo" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="alternate" type="application/atom+xml" title="Atom 0.3 - <?php bloginfo('name'); ?> " href="<?php bloginfo('atom_url'); ?>" />
  <link rel="alternate" type="application/rss+xml" title="Comments Feed - para todos los comentarios de Código Nuevo" href="<?php bloginfo('comments_rss2_url'); ?>" />

  <!-- Estilos -->
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" /> 
  <!--
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/librerias.css" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/estilos.css" />
  -->

  <!-- Estilos críticos -->
  <style type="text/css">
  .cl{font-size:0;line-height:0;display:block;clear:both;height:0;text-indent:-4000px}.mpfy-fullwrap{position:relative;margin-bottom:8px}.mpfy-controls-wrap{position:absolute;top:-23px;right:0;left:0}.mpfy-controls-bar{position:relative;width:100%;height:47px;background:#FED130;border-bottom:1px solid #999;overflow:hidden;z-index:100}.mpfy-controls{position:relative;overflow:hidden}.mpfy-controls .mpfy-search-wrap{-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;width:333px;height:47px;background:#fff}.mpfy-controls .mpfy-search-wrap .mpfy_search{display:inline;float:left;width:220px;height:47px;margin:0 20px 0 0;padding:0 0 0 10px;border:0;background:none;box-shadow:none;font-size:16px}.mpfy-controls .mpfy-search-wrap .mpfy_search_button{display:inline;float:right;width:89px;height:47px;margin:0;padding:0;border:0;background:#000;color:#fff;font-family:Oswald,"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:16px}.mpfy-controls .mpfy-filter{float:right}.mpfy-search-form{display:inline;float:right}.mpfy-search-form .mpfy-search-wrap{position:relative}.mpfy-search-form .mpfy-search-wrap .mpfy-clear-search{font-size:0;line-height:0;position:absolute;top:50%;right:102px;display:none;width:12px;height:12px;margin-top:-6px;text-indent:-4000px;background:url(images/icon-refresh.png) no-repeat 0 0}.mpfy-controls .mpfy-search-form{float:right;margin-left:5px}.mpfy-tags-list{width:auto;position:absolute;top:0;background:#fed130}.mpfy-tags-list a.mpfy-tl-item{line-height:27px;position:relative;display:inline;float:left;box-sizing:border-box;height:27px;margin:10px;text-decoration:none;color:#000}.mpfy-sugerir{position:relative;z-index:11;float:right;margin:25px 20px 0 10px}@media screen and (max-width: 640px){.mpfy-sugerir{font-size:.8rem;padding:.5rem 1rem}}
  </style>

  <script src="<?php bloginfo('template_directory'); ?>/js/modernizr.js"></script>
  <!-- Cabeceras insertadas por WordPress -->
  <?php wp_head(); ?>
  
  <!-- Scripts -->
  <script src="<?php bloginfo('template_directory'); ?>/js/produccion.min.js"></script>
  <!--
  <script src="<?php bloginfo('template_directory'); ?>/js/librerias.js"></script> 
  <script src="<?php bloginfo('template_directory'); ?>/js/scripts.js"></script> 
  -->
  
  <!-- Twitter card -->
  <meta name="twitter:widgets:csp" content="on">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:url" content="<?php bloginfo('url'); ?>">
  <meta name="twitter:title" content="<?php bloginfo('name'); ?>">
  <meta name="twitter:description" content="<?php echo bloginfo( 'description' ); ?>">
  <meta name="twitter:image" content="<?php echo esc_url( get_theme_mod( 'new_code_logo' ) ); ?>">

  <!-- Google + -->
  <meta itemprop="name" content="<?php bloginfo('name'); ?>">
  <meta itemprop="description" content="<?php echo bloginfo( 'description' ); ?>">
  <meta itemprop="image" content="<?php echo esc_url( get_theme_mod( 'new_code_logo' ) ); ?>">
  
</head>

<body <?php body_class(); ?>>

  <!-- PUBLICIDAD.NET | Producción --
    <script src="http://adsby.publicidad.net/ads/73756_1.js" type="text/javascript"></script> 

    <!-- PUBLICIDAD.NET | Testing -->
    <!-- Ejemplo Skin RON --
    <script>
      var adKeyword = 'gCampaign=skin_demo';
    </script>
    <script src="http://adsby.publicidad.net/tad/test.js"></script>

    <!-- Ejemplo Skin Preimum Dinamico --
    <script>
      var adKeyword = 'gCampaign=SPtest';
    </script>
    <script src="http://adsby.publicidad.net/tad/test.js"></script>

    <!-- Ejemplo Full Video Skin --
    <script>
      var adKeyword = 'gCampaign=fvs_bigbuckbunny';
    </script>
    <script src="http://adsby.publicidad.net/tad/test.js"></script>

    <!-- Ejemplo Toggle Skin --
    <script>
      var adKeyword = 'gCampaign=toggle_demo';
    </script>
    <script src="http://adsby.publicidad.net/tad/test.js"></script>
  <!-- /PUBLICIDAD.NET -->

  <!-- FACEBOOK HOOK -->
    <div id="fb-root"></div>
    <script>
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=521523557965875&version=v2.0";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
  <!-- /FACEBOOK HOOK -->

  <!-- CONDICIONAL IE8 -->
    <!--[if lt IE 9]>
      <p class="browsehappy">
        Estas usando un navegador <strong>del siglo pasado</strong>. Por favor <a href="http://browsehappy.com/">actualízate</a> para mejorar tu experiencia.
      </p>
    <![endif]-->
  <!-- /CONDICIONAL IE8 -->

  <!-- CABECERA -->
  <header id="cabecera">
    <div class="row">

      <!-- Logo y hamburguesa -->
      <div id="top-contenido">
        <div class="logo-contenedor large-4 medium-4 small-6 columns">
        <i id="menu-disparador" class="fa fa-bars"></i>
          <?php if ( get_theme_mod( 'new_code_logo' ) ) : ?>
            <h1>
              <a class="logo"
                href="<?php echo esc_url( home_url( '/' ) ); ?>"
                title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'
                rel='home'>
                  <img src="<?php bloginfo('template_directory'); ?>/img/logo_solo_blanco.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
              </a>
            </h1>
          <?php else : ?>
            <hgroup>
                <h1 class='titulo-pagina'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
                <h2 class='descripcion-pagina'><?php bloginfo( 'description' ); ?></h2>
            </hgroup>
          <?php endif; ?>
        </div>

        <!-- Iconos sociales y buscador -->
        <div id="top-menu" class="large-8 medium-8 small-6 columns">
          <div id="buscador" class="large-3 medium-3 small-6 columns">
            <form method="get" id="formulario-buscador" action="<?php bloginfo('url'); ?>/">
              <div class="row collapse postfix-round">
                <div class="small-8 columns">
                  <input id="buscador-texto" type="text" placeholder="" name="s" value="<?php the_search_query(); ?>">
                </div>
                <div class="small-4 columns">
                  <button class="button postfix" type="submit" id="buscador-boton"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>

          <div class="botones-sociales">
            <a target="_blank" title="Nuestro perfil en Facebook" class="boton-social boton-facebook" href="https://www.facebook.com/pages/C%C3%B3digo-Nuevo/228242773966385"><i class="fa fa-facebook"></i></a>
            <a target="_blank" title="Nuestro perfil en Google+" class="boton-social boton-google" href="http://www.google.com/+codigonuevo01"><i class="fa fa-google-plus"></i></a>
            <a target="_blank" title="Nuestro perfil en Instagram" class="boton-social boton-instagram" href="http://instagram.com/codigonuevo"><i class="fa fa-instagram"></i></a>
            <a target="_blank" title="Nuestro perfil en Twitter" class="boton-social boton-twitter" href="https://twitter.com/codigonuevo"><i class="fa fa-twitter"></i></a>
          </div>

        </div>

      </div>
    </div>

    <div class="menu-contenedor oculta">
      <?php navegacion(); ?>
    </div>

  </header>
  <!-- /CABECERA -->

  <!-- MEGAMENU -->
  <div style="display:none;">
    <div class="categorias-menu">

    </div>   
  </div>  
  <!-- /MEGAMENU -->
    
