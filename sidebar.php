<!-- SIDEBAR SUPERIOR -->
<div class="hack-guarrete" style="width:350px;height:0;">
<!-- Lo sé, iré al infierno de los desarrolladores web pero oye, uno tiene sus días... -->
</div>

<div id="sidebar-superior" class="sidebar">
  <!-- LATERAL-ARRIBA -->
  <div class="anuncio-contenedor large-12 medium-12 columns">
    <div id="lateral-arriba" class="widget-area">
      <?php dynamic_sidebar('lateral-arriba'); ?>
    </div>
  </div>
  <!-- /LATERAL-ARRIBA -->

  <div class="large-12 medium-12 columns">

    <!-- FACEBOOK LIKE BOX & TWITTER FOLLOW -->
    <div class="bloque">
      <h3 class="bloque-titulo"><span>Crezcamos</span></h3>
      <div class="row">
        <div class="facebook-like-box">
          <div class="fb-like-box" data-href="https://www.facebook.com/pages/C%C3%B3digo-Nuevo/228242773966385" data-width="auto" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
        </div>
        <div class="large-12 medium-12 columns">
          <br>
          <a class="twitter-timeline" href="https://twitter.com/CodigoNuevo" data-widget-id="482173184209219585">Tweets por el @CodigoNuevo.</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          <br><br>
        </div>
        <hr>
      </div>
    </div>
    <!-- /FACEBOOK LIKE BOX & TWITTER FOLLOW -->

    <!-- SUSCRIPCIÓN NEWSLETTER | Formulario pequeño -->
    <div id="mc_embed_signup" class="mc_signup_small">
      <form action="//codigonuevo.us9.list-manage.com/subscribe/post?u=a573c058e7fed0529c41aa00f&amp;id=7197635359" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
        
          <div class="row">
            <div class="large-12 columns">
              <div class="row collapse">
                <div class="medium-12 columns calltoaction">
                  <span>SUSCRÍBETE A</span>
                  <br/><img src="<?php bloginfo('template_directory'); ?>/img/logo_solo.png" alt="CÓDIGO NUEVO">
                </div>
                <div class="medium-12 columns campos">
                  <div class="small-10 columns">
                    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email" required>
                  </div>
                  <div class="small-2 columns">
                    <div style="position: absolute; left: -5000px;">
                      <input type="text" name="b_a573c058e7fed0529c41aa00f_7197635359" tabindex="-1" value="">
                    </div>
                    <input type="submit" value="GO" name="suscribirse" id="mc-embedded-subscribe" class="button postfix">
                  </div>  
                </div>
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>
    <br>
    <hr>
    <!-- /SUSCRIPCIÓN NEWSLETTER -->

    <!-- CALLOUT AUTORES -->
    <div class="row cn-callout">     
      <div class="medium-12 columns calltoaction">
        <span>ESCRIBE PARA</span>
        <br/><img src="<?php bloginfo('template_directory'); ?>/img/logo_solo.png" alt="CÓDIGO NUEVO">
        <br/><a href="/trabaja-con-nosotros" class="button">+ INFO</a>
      </div>
    </div>
    <!-- CALLOUT AUTORES -->

  </div>

  <!-- /LATERAL-MEDIO -->
  <div class="anuncio-contenedor large-12 medium-12 columns">
    <div id="lateral-medio" class="widget-area">
      <?php dynamic_sidebar('lateral-medio'); ?>
    </div>
  </div>
  <!-- /LATERAL-MEDIO -->
  
</div>
<!-- /SIDEBAR SUPERIOR -->

<!-- SIDEBAR INFERIOR -->
<div id="sidebar-inferior" class="sidebar">
  <div class="large-12 medium-12 columns">

    <!-- LATERAL-ABAJO -->
    <div id="lateral-abajo" class="widget-area">
      <?php dynamic_sidebar('lateral-abajo'); ?>
    </div>
    <!-- /LATERAL-ABAJO -->

  </div>
</div>
<!-- /SIDEBAR INFERIOR -->