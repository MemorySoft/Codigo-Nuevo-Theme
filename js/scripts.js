/*******************************************************************************
  PLUGINS
  -------
  Sticky Plugin
  ScrollUp

*******************************************************************************/

// Sticky Plugin v1.0.0 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky
// Description: Makes an element on the page stick on the screen as you scroll
// It will only set the 'top' and 'position' of your element, you
// might need to adjust the width in some cases.

(function($) {
  var defaults = {
      topSpacing: 0,
      bottomSpacing: 0,
      className: 'is-sticky',
      wrapperClassName: 'sticky-wrapper',
      center: false,
      getWidthFrom: ''
    },
    $window = $(window),
    $document = $(document),
    sticked = [],
    windowHeight = $window.height(),
    scroller = function() {
      var scrollTop = $window.scrollTop(),
        documentHeight = $document.height(),
        dwh = documentHeight - windowHeight,
        extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

      for (var i = 0; i < sticked.length; i++) {
        var s = sticked[i],
          elementTop = s.stickyWrapper.offset().top,
          etse = elementTop - s.topSpacing - extra;

        if (scrollTop <= etse) {
          if (s.currentTop !== null) {
            s.stickyElement
              .css('position', '')
              .css('top', '');
            s.stickyElement.parent().removeClass(s.className);
            s.currentTop = null;
          }
        }
        else {
          var newTop = documentHeight - s.stickyElement.outerHeight() - s.topSpacing - s.bottomSpacing - scrollTop - extra;
          if (newTop < 0) {
            newTop = newTop + s.topSpacing;
          } else {
            newTop = s.topSpacing;
          }
          if (s.currentTop != newTop) {
            s.stickyElement
              .css('position', 'fixed')
              .css('top', newTop);

            if (typeof s.getWidthFrom !== 'undefined') {
              s.stickyElement.css('width', $(s.getWidthFrom).width());
            }

            s.stickyElement.parent().addClass(s.className);
            s.currentTop = newTop;
          }
        }
      }
    },
    resizer = function() {
      windowHeight = $window.height();
    },
    methods = {
      init: function(options) {
        var o = $.extend(defaults, options);
        return this.each(function() {
          var stickyElement = $(this);

          var stickyId = stickyElement.attr('id');
          var wrapper = $('<div></div>')
            .attr('id', stickyId + '-sticky-wrapper')
            .addClass(o.wrapperClassName);
          stickyElement.wrapAll(wrapper);

          if (o.center) {
            stickyElement.parent().css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});
          }

          if (stickyElement.css("float") == "right") {
            stickyElement.css({"float":"none"}).parent().css({"float":"right"});
          }

          var stickyWrapper = stickyElement.parent();
          stickyWrapper.css('height', stickyElement.outerHeight());
          sticked.push({
            topSpacing: o.topSpacing,
            bottomSpacing: o.bottomSpacing,
            stickyElement: stickyElement,
            currentTop: null,
            stickyWrapper: stickyWrapper,
            className: o.className,
            getWidthFrom: o.getWidthFrom
          });
        });
      },
      update: scroller
    };

  // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
  if (window.addEventListener) {
    window.addEventListener('scroll', scroller, false);
    window.addEventListener('resize', resizer, false);
  } else if (window.attachEvent) {
    window.attachEvent('onscroll', scroller);
    window.attachEvent('onresize', resizer);
  }

  $.fn.sticky = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };
  $(function() {
    setTimeout(scroller, 0);
  });
})(jQuery);


/*
 ScrollUp v2.3.1
 Author: Mark Goodyear - http://markgoodyear.com
 Git: https://github.com/markgoodyear/scrollup

 Copyright 2014 Mark Goodyear.
 Licensed under the MIT license
 http://www.opensource.org/licenses/mit-license.php

 Twitter: @markgdyr

 */
(function($, window, document) {

    // Main function
    $.fn.scrollUp = function (options) {

        // Ensure that only one scrollUp exists
        if (!$.data(document.body, 'scrollUp')) {
            $.data(document.body, 'scrollUp', true);
            $.fn.scrollUp.init(options);
        }
    };

    // Init
    $.fn.scrollUp.init = function(options) {

        // Apply any options to the settings, override the defaults
        var o = $.fn.scrollUp.settings = $.extend({}, $.fn.scrollUp.defaults, options),

        // Set scrollTitle
        scrollTitle = (o.scrollTitle) ? o.scrollTitle : o.scrollText,

        // Create element
    $self;
    if (o.scrollTrigger) {
      $self = $(o.scrollTrigger);
    } else {
          $self = $('<a/>', {
              id: o.scrollName,
              href: '#top',
              title: scrollTitle
          });
    }
        $self.appendTo('body');

        // If not using an image display text
        if (!(o.scrollImg || o.scrollTrigger)) {
            $self.html(o.scrollText);
        }

        // Minimum CSS to make the magic happen
        $self.css({
            display: 'none',
            position: 'fixed',
            zIndex: o.zIndex
        });

        // Active point overlay
        if (o.activeOverlay) {
            $('<div/>', { id: o.scrollName + '-active' }).css({ position: 'absolute', 'top': o.scrollDistance + 'px', width: '100%', borderTop: '1px dotted' + o.activeOverlay, zIndex: o.zIndex }).appendTo('body');
        }

        // Switch animation type
        var animIn, animOut, animSpeed, scrollDis;

        switch (o.animation) {
            case 'fade':
                animIn  = 'fadeIn';
                animOut = 'fadeOut';
                animSpeed = o.animationInSpeed;
                break;
            case 'slide':
                animIn  = 'slideDown';
                animOut = 'slideUp';
                animSpeed = o.animationInSpeed;
                break;
            default:
                animIn  = 'show';
                animOut = 'hide';
                animSpeed = 0;
        }

        // If from top or bottom
        if (o.scrollFrom === 'top') {
            scrollDis = o.scrollDistance;
        } else {
            scrollDis = $(document).height() - $(window).height() - o.scrollDistance;
        }

        // Trigger visible false by default
        var triggerVisible = false;

        // Scroll function
        scrollEvent = $(window).scroll(function() {
            if ( $(window).scrollTop() > scrollDis ) {
                if (!triggerVisible) {
                    $self[animIn](animSpeed);
                    triggerVisible = true;
                }
            } else {
                if (triggerVisible) {
                    $self[animOut](animSpeed);
                    triggerVisible = false;
                }
            }
        });

        var scrollTarget;
        if (o.scrollTarget) {
            if (typeof o.scrollTarget === 'number') {
                scrollTarget = o.scrollTarget;
            } else if (typeof o.scrollTarget === 'string') {
                scrollTarget = Math.floor($(o.scrollTarget).offset().top);
            }
        } else {
            scrollTarget = 0;
        }

        // To the top
        $self.click(function(e) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: scrollTarget
            }, o.scrollSpeed, o.easingType);
        });
    };

    // Defaults
    $.fn.scrollUp.defaults = {
        scrollName: 'scrollUp', // Element ID
        scrollDistance: 300, // Distance from top/bottom before showing element (px)
        scrollFrom: 'top', // 'top' or 'bottom'
        scrollSpeed: 300, // Speed back to top (ms)
        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
        animation: 'fade', // Fade, slide, none
        animationInSpeed: 200, // Animation in speed (ms)
        animationOutSpeed: 200, // Animation out speed (ms)
        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
        scrollTarget: false, // Set a custom target element for scrolling to. Can be element or number
        scrollText: 'Scroll to top', // Text for element, can contain HTML
        scrollTitle: false, // Set a custom <a> title if required. Defaults to scrollText
        scrollImg: false, // Set true to use image
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 2147483647 // Z-Index for the overlay
    };

    // Destroy scrollUp plugin and clean all modifications to the DOM
    $.fn.scrollUp.destroy = function (scrollEvent){
        $.removeData( document.body, 'scrollUp' );
        $( '#' + $.fn.scrollUp.settings.scrollName ).remove();
        $( '#' + $.fn.scrollUp.settings.scrollName + '-active' ).remove();

        // If 1.7 or above use the new .off()
        if ($.fn.jquery.split('.')[1] >= 7) {
            $(window).off( 'scroll', scrollEvent );

        // Else use the old .unbind()
        } else {
            $(window).unbind( 'scroll', scrollEvent );
        }
    };

    $.scrollUp = $.fn.scrollUp;

})(jQuery, window, document);


/*******************************************************************************
  SCRIPTS
  -------
  1- Pegamos el sidebar al top
  2- Pegamos los titulos de los posts al top
  3- Icono patra el botón 'Editar'
  4- Redimensionamos los plugins de Facebook
  5- Lanzamos ScrollUp
  6- Construimos y gestionamos el Megamenú
  7- Construimos y gestionamos la caja de búsqueda
  8- Añadimos iconos a los post-format de Video y Audio
  9- Gestiona el nombre del autor fuera del loop
  10- Ocultamos las categorias secundarias
  11- Insertamos el superbanner en el contenido de portada

*******************************************************************************/

$(document).ready(function(){

  //    Pegamos elementos del sidebar al top de la página

  //////////////////////////////////////////////////////////////////////////
  $(".menu").sticky({
    topSpacing: 0,
    getWidthFrom: '#cabecera'
  });

  $("#sidebar-inferior-secundario").sticky({
    topSpacing: 130,
    bottomSpacing: 970,
    getWidthFrom: '.hack-guarrete'
  });

  $("#sidebar-inferior, .pagina #sidebar-inferior-secundario, .category #sidebar-inferior-secundario, .single #sidebar-inferior-secundario").sticky({
    topSpacing: 50,
    bottomSpacing: 970,
    getWidthFrom: '.hack-guarrete'
  });


  //    Decoramos el boton de editar

  //////////////////////////////////////////////////////////////////////////
  $('.post-edit-link').prepend('<i class="fa fa-pencil"></i>');


  //    Redimensionamos los plugins de Facebook
  //    por SlavikMe en Stack Overflow
  //    http://stackoverflow.com/questions/22187961/responsive-facebook-comments-css-hack-broken
  //
  //    TODO: cuando tengamos tiempo refactorizar para evitar duplicaciones!

  //////////////////////////////////////////////////////////////////////////

  (function(window){
    var dh = null;
    $(window).on("resize",function(){
        if ( dh ) {
            clearTimeout(dh);
        }
        dh = setTimeout(function(){
            var $fb_plug = $(".fb-comments");
            var $fb_cont = $(".facebook-comentarios");
            dh = null;
            if ( $fb_plug.attr("data-width") != $fb_cont.width() ) {
                $fb_cont.css({height:$fb_cont.height()});
                $fb_plug.attr("data-width", $fb_cont.width());
            }
        },300);
    }).trigger("resize");
  })(this);

  (function(window){
      var dh = null;
      $(window).on("resize",function(){
          if ( dh ) {
              clearTimeout(dh);
          }
          dh = setTimeout(function(){
              var $fb_plug = $(".fb-like-box");
              var $fb_cont = $(".facebook-like-box");
              dh = null;
              if ( $fb_plug.attr("data-width") != $fb_cont.width() ) {
                  $fb_cont.css({height:$fb_cont.height()});
                  $fb_plug.attr("data-width", $fb_cont.width());
              }
          },300);
      }).trigger("resize");
  })(this);


  //    Dispara Scroll Up

  //////////////////////////////////////////////////////////////////////////
  $(function () {
    $.scrollUp({
        scrollImg: true
    });
  });


  //  Panel lateral

  //////////////////////////////////////////////////////////////////////////

  $('#menu-disparador').click(function() {
    //$('#menu-contenedor').animate({width: 'toggle'});
    $('.menu-contenedor').toggleClass('oculta');
  });


  //    Buscador desplegeble

  //////////////////////////////////////////////////////////////////////////

  $('#buscador-texto').click(function() {
    $('#buscador').animate({width: 260});
    if (document.documentElement.clientWidth < 640){
        $('.logo-contenedor h1').animate({width: 0});
    }
  });


  //    Mega Menú

  //////////////////////////////////////////////////////////////////////////

  if (document.documentElement.clientWidth > 640){

    $('#menu-navegacion-primaria .menu-desplegable-items').prepend('<div class="menu-desplegable-categorias"><div class="menu-loader">');

    $('.menu-item.tiene-desplegable').hover(function() {

      $(this).find('a').toggleClass('menu-desplegable-activo');
      $(this).find('.menu-desplegable').slideToggle(0);

      $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'mega_menu'
        },
        success: function(data, textStatus, XMLHttpRequest){

          $(".categorias-menu").html('');
          $(".categorias-menu").append(data);
          
          $('.nombre-categoria').each(function () {
            var nombre_categoria = $(this).text().toLowerCase().replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
            var elementos_categoria = $('#'+ nombre_categoria +'-menu').html();
            var menu_desplegable_categorias = $( '.'+ nombre_categoria +' .menu-desplegable-categorias');

            menu_desplegable_categorias.empty();
            menu_desplegable_categorias.prepend(elementos_categoria);

            // $('.menu-desplegable-items li a').hover(function() {
            //   var nombre_sub_categoria = $(this).text().toLowerCase().replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
            //   var elementos_sub_categoria = $('#'+ nombre_sub_categoria +'-menu').html();

            //   menu_desplegable_categorias.empty();
            //   menu_desplegable_categorias.prepend(elementos_sub_categoria);
            // });
          });

        },
        error: function(MLHttpRequest, textStatus, errorThrown){
            console.log(errorThrown);
        }
      });
    });
  
  } else {
  
    /*  Responsive
    */
    //$('.menu').append('<a href="#" class="menu-desplegar-boton"><i class="fa fa-list"></i></a>');
    $('#menu-disparador').click(function() {
      $('.menu-seccion').slideToggle(0);
    });
  
  }

  // 8- Iconos para los post-format

  //////////////////////////////////////////////////////////////////////////
  $('.format-audio .extracto-titulo a').prepend('<i title="Este artículo tiene audio" class="fa fa-volume-up"></i> ');
  $('.format-video .extracto-titulo a').prepend('<i title="Este artículo tiene video" class="fa fa-youtube-play"></i> ');


  // 9- Gestiona el nombre de autor antes del loop

  //////////////////////////////////////////////////////////////////////////
  var autorNombre = $('#autor .autor-nombre h3').text();
  $('.js-autor-nombre').text(autorNombre);


  // 10- Evita que se muestren las categorias secundarias

  //////////////////////////////////////////////////////////////////////////
  var categorias_secundarias = [];
  $('.menu-seccion .menu-item .menu-desplegable a').each(function(){
    categorias_secundarias.push($(this).text().toLowerCase());
    $('.post-categories .category-'+ categorias_secundarias).css('display','none');
  });


  // Espacio para NativeAD

  //////////////////////////////////////////////////////////////////////////
  // $('.home #loop .caja-post:nth-child(1)').after('<div class="caja-post columns" id="nativeadHome">
  //   <span class="post-38766 post type-post status-publish format-standard has-post-thumbnail hentry category-humor">
  //     <div class="extracto-post">
  //       <div class="extracto-imagen-caja">
  //         <a title="Este es el espacio reservado para los contenidos de Native AD" href="/nativead/">
  //           <div class="extracto-imagen">
  //             <img src="http://native.ad/es/wp-content/img/sites/5/2014/05/bilbao.jpg" class="attachment-post wp-post-image" alt="native image" height="450" width="600">
  //           </div>
  //         </a>
  //       </div>
  //       <div class="extracto-info">                  
  //         <div class="extracto-categoria">
  //           <ul class="post-categories">
  //             <li><a class="category-humor" href="#" title="View all posts in NATIVE" rel="category tag">NATIVE</a></li>
  //           </ul>
  //         </div>
  //         <div class="extracto-autor"><a href="#" title="Entradas de NativeAD" rel="author">Native Ad</a></div>
  //         <div class="extracto-fecha">18 de marzo</div>
  //       </div>
  //       <h3 class="extracto-titulo">
  //         <a title="Este es el espacio reservado para los contenidos de Native AD" href="/nativead/">
  //          Este es el espacio reservado para los contenidos de Native AD
  //         </a>
  //       </h3>
  //       <p class="extracto-texto">
  //         En este espacio aparecerá el post patrocinado de NativeAD y enlazará a la plantilla que hemos diseñado especialmente para ellos.
  //       </p>
  //     </div>
  //   </span>
  // </div>');
  $('.home #loop .caja-post:nth-child(1)').after('<div class="caja-post columns" id="nativeadHome"><span class="post-38766 post type-post status-publish format-standard has-post-thumbnail hentry category-humor"><div class="extracto-post"><div class="extracto-imagen-caja"><a title="Este es el espacio reservado para los contenidos de Native AD" href="/nativead/"><div class="extracto-imagen"><img src="http://native.ad/es/wp-content/img/sites/5/2014/05/bilbao.jpg" class="attachment-post wp-post-image" alt="native image" height="450" width="600"></div></a></div><div class="extracto-info">                  <div class="extracto-categoria"><ul class="post-categories"><li><a class="category-humor" href="#" title="View all posts in NATIVE" rel="category tag">NATIVE</a></li></ul></div><div class="extracto-autor"><a href="#" title="Entradas de NativeAD" rel="author">Native Ad</a></div><div class="extracto-fecha">18 de marzo</div></div><h3 class="extracto-titulo"><a title="Este es el espacio reservado para los contenidos de Native AD" href="/nativead/">Este es el espacio reservado para los contenidos de Native AD</a></h3><p class="extracto-texto">En este espacio aparecerá el post patrocinado de NativeAD y enlazará a la plantilla que hemos diseñado especialmente para ellos.</p></div></span></div>');
});


