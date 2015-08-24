<!-- FOOTER -->
  <footer id="footer">
    <div id="footer-contenedor">
      <div class="row">

        <!-- FOOTER-UNO -->
        <div class="large-4 medium-4 columns">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-uno') ) : ?>
            <div class="bloque">
              <h3 class="bloque-titulo"><span>LO QUE ESTÁ CALIENTE</span></h3>

              <?php $posts = get_posts(6); foreach($posts as $post) { ?>
                <div class="extracto-post extracto-mini">
                  <div class="extracto-imagen-caja">
                    <a class="extracto-imagen" title="Ver <?php the_title(); ?>" href="<?php the_permalink(); ?>">
                      <?php the_post_thumbnail('portada'); ?>
                    </a>
                  </div>
                  <h3 class="extracto-titulo">
                    <a class="extracto-imagen" title="Ver <?php the_title(); ?>" href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                    </a>
                  </h3>
                </div>
             <?php } ?>

            </div>
          <?php endif; ?>
        </div>
        <!-- /FOOTER-UNO -->

        <!-- FOOTER-DOS -->
        <div class="large-4 medium-4 columns">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-dos') ) : ?>
            <div class="bloque">
              <h3 class="bloque-titulo"><span>CATEGORÍAS</span></h3>
              <div class="tagcloud">
                <?php $args = array('exclude' => '1,2'); $categories = get_categories($args);
                  foreach($categories as $category)
                  {
                    echo '<a title="'.$category->name.'" href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a>';
                  }
                ?>
              </div>
            </div>

          <?php endif; ?>
        </div>
        <!-- /FOOTER-DOS -->

        <!-- FOOTER-TRES -->
        <div class="large-4 medium-4 columns">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-tres') ) : ?>
            <div class="bloque">
              <h3 class="bloque-titulo"><span>SÍGUENOS</span></h3>
              <div class="botones-sociales">
                <a target="_blank" class="boton-social boton-facebook" href="https://www.facebook.com/pages/C%C3%B3digo-Nuevo/228242773966385"><i class="fa fa-facebook fa-2x"></i></a>
                <a target="_blank" class="boton-social boton-google" href="http://www.google.com/+codigonuevo01"><i class="fa fa-google-plus fa-2x"></i></a>
                <a target="_blank" class="boton-social boton-instagram" href="http://instagram.com/codigonuevo"><i class="fa fa-instagram fa-2x"></i></a>
                <a target="_blank" class="boton-social boton-twitter" href="https://twitter.com/codigonuevo"><i class="fa fa-twitter fa-2x"></i></a>
              </div>
            </div>

          <?php endif; ?>
        </div>
        <!-- /FOOTER-TRES -->

      </div>
    </div>

    <!-- SUBFOOTER -->
    <div class="subfooter">
      <div class="row">

        <div class="large-4 medium-4 columns">
          <p class=" creditos">&copy; Copyright 2015 - Propiedad de <a href="http://www.oraclecreatives.com" target="_blank">Oracle Creatives</a></p>
        </div>

        <div class="large-8 medium-8 columns">
          <?php footer_nav(); ?>
        </div>
      </div>
    </div>
    <!-- /FIN SUBFOOTER -->

  </footer>
  <!-- /FIN FOOTER -->

  <!-- MODALES -->
  <div id="modal-info" class="reveal-modal small" data-reveal>
    <div class="row">
      <div class="large-12 medium-12 columns">
        <h2>Código Nuevo</h2>
        <p>Revista online escrita por y para la Generación Milenial</p>
      </div>
    </div>

    <div class="row">
      <div class="large-6 medium-6 columns">
        <a href="<?php echo get_site_url(); ?>/sobre-nosotros">
        <div class="panel">
          <p>Sobre nosotros</p>
          <i class="fa fa-users fa-4x"></i>
        </div>
        </a>
      </div>
      <div class="large-6 medium-6 columns">
        <a href="<?php echo get_site_url(); ?>/contacto">
        <div class="panel">
          <p>Contacto</p>
          <i class="fa fa-envelope fa-4x"></i>
        </div>
        </a>
      </div>
      <div class="large-6 medium-6 columns">
        <a href="<?php echo get_site_url(); ?>/publicidad">
        <div class="panel">
          <p>Publicidad</p>
          <i class="fa fa-signal fa-4x"></i>
        </div>
        </a>
      </div>
      <div class="large-6 medium-6 columns">
        <a href="<?php echo get_site_url(); ?>/trabaja-con-nosotros">
        <div class="panel">
          <p>Escribe para Código Nuevo</p>
          <i class="fa fa-file fa-4x"></i>
        </div>
        </a>
      </div>
    </div>
    <div class="botones-sociales">
      <h3>Síguenos</h3>
      <a target="_blank" class="boton-social boton-facebook" href="https://www.facebook.com/pages/C%C3%B3digo-Nuevo/228242773966385"><i class="fa fa-facebook fa-2x"></i></a>
      <a target="_blank" class="boton-social boton-google" href="http://www.google.com/+codigonuevo01"><i class="fa fa-google-plus fa-2x"></i></a>
      <a target="_blank" class="boton-social boton-instagram" href="http://instagram.com/codigonuevo"><i class="fa fa-instagram fa-2x"></i></a>
      <a target="_blank" class="boton-social boton-twitter" href="https://twitter.com/codigonuevo"><i class="fa fa-twitter fa-2x"></i></a>
    </div>
    <a href="" class="close-reveal-modal">&#215</a>
  </div>
  <!-- /MODALES -->

  <!-- JAVASCRIPT -->
  <script>
    $(document).foundation();
  </script>


  <!-- Google Analytics -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-45905816-1', 'auto');
    ga('require', 'linkid', 'linkid.js');
    ga('send', 'pageview');

  </script>


  <!-- Quantcast -->

  <script type="text/javascript">
  var _qevents = _qevents || [];

  (function() {
  var elem = document.createElement('script');
  elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
  elem.async = true;
  elem.type = "text/javascript";
  var scpt = document.getElementsByTagName('script')[0];
  scpt.parentNode.insertBefore(elem, scpt);
  })();

  _qevents.push({
  qacct:"p-KRRMvUBb2qHQ9"
  });
  </script>

  <noscript>
  <div style="display:none;">
  <img src="//pixel.quantserve.com/pixel/p-KRRMvUBb2qHQ9.gif" border="0" height="1" width="1" alt="Quantcast"/>
  </div>
  </noscript>
  
  <?php wp_footer() ?>
  </body>
</html>
