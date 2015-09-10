<?php get_header(); ?>

<?php
  /*
  Template Name: NativeAD
  */
?>

<?php include('globalwidget.php'); ?>

<!-- CONTENEDOR -->
<div id="contenedor" class="row post">
  
  <!-- COLUMNA PRINCIPAL -->
  <div id="contenido" class="large-8 medium-8 columns">

    <div id="articulo" class="row">

      <div class="large-12 medium-12 columns">
        
        <!-- AQUI ENTRA EL INSERTO DE NATIVEAD -->

        <!-- POST WIDGETS -->
        <div class="row">
          <ul id="post-widget">
            <?php dynamic_sidebar('post'); ?>
          </ul>
        </div>
        <!-- /POST WIDGETS -->
      </div>

      <!-- SUSCRIPCIÓN NEWSLETTER | Formulario grande -->
      <div id="mc_embed_signup">
        <form action="//codigonuevo.us9.list-manage.com/subscribe/post?u=a573c058e7fed0529c41aa00f&amp;id=7197635359" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
          <div id="mc_embed_signup_scroll">
          
            <div class="row">
              <div class="large-12 columns">
                <div class="row collapse">
                  <div class="medium-12 columns">
                    <h2>RECIBE LOS MEJORES ARTÍCULOS</h2>
                  </div>
                  <div class="medium-4 columns calltoaction">
                    <span>SUSCRÍBETE A</span>
                    <br/><img src="<?php bloginfo('template_directory'); ?>/img/logo_solo.png" alt="CÓDIGO NUEVO">
                  </div>
                  <div class="medium-7 columns campos">
                    <div class="small-10 columns">
                      <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email" required>
                    </div>
                    <div class="small-2 columns">
                      <div style="position: absolute; left: -5000px;">
                        <input type="text" name="b_a573c058e7fed0529c41aa00f_7197635359" tabindex="-1" value="">
                      </div>
                      <input type="submit" value="OK" name="suscribirse" id="mc-embedded-subscribe" class="button postfix">
                    </div>  
                  </div>
                </div>
              </div>
            </div>

          </div>
        </form>
        <br>
        <br>
      </div>
      <!-- /SUSCRIPCIÓN NEWSLETTER -->
    
      <div class="large-12 medium-12 columns">

        <!-- BOTONES SOCIALES -->
        <div class="row botones-sociales">
          <hr/>
          <div class="large-4 medium-4 columns">
            <a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="boton-social boton-facebook">
              <i class="fa fa-facebook"></i>
              Facebook
              
            </a>
          </div>
          <div class="large-4 medium-4 columns">
            <a target="_blank" href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink(); ?>" class="boton-social boton-twitter">
              <i class="fa fa-twitter"></i> 
              Twitter
              
            </a>
          </div>
          <div class="large-4 medium-4 columns">
            <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="boton-social boton-google">
              <i class="fa fa-google-plus"></i> 
              Google +
              
            </a>
          </div>
        </div>
        <!-- /BOTONES SOCIALES -->

        <!-- SEGUIR EN FEISBUC -->
        <div class="row">
          <hr/>
          <div class="large-12 medium-12 columns facebook-megusta">
            <div class="fb-like" data-href="https://www.facebook.com/pages/C%C3%B3digo-Nuevo/228242773966385" data-width="auto" data-layout="standard" data-action="like" data-show-faces="false" data-share="false">
            </div>
          </div>
        </div>
        <!-- /SEGUIR EN FEISBUC -->
  
        <!-- NAVEGACION POSTS -->
        <div class="row navegacion-posts">
          <hr/>
          <div class="large-6 medium columns navegacion-anterior-post"> 
            <?php previous_post_link( '<p><i class="fa fa-chevron-left"></i> ARTÍCULO PREVIO</p> %link', '%title' ); ?>
          </div>
          <div class="large-6 medium columns navegacion-proximo-post">
            <?php next_post_link( '<p>PRÓXIMO ARTÍCULO <i class="fa fa-chevron-right"></i></p> %link', '%title' ); ?>
          </div>
        </div>
        <!-- /NAVEGACION POSTS -->
  
        <!-- FACEBOOK COMMENTS -->
        <div class="row">
          <div class="large-12 medium-12 columns">
            <h3>Comentarios</h3>
          </div>
          <hr/>
          <div class="large-12 medium-12 columns facebook-comentarios">
            <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="50" data-width="680" data-colorscheme="light" style="width:100%;"></div>
          </div>
        </div>
        <!-- /FACEBOOK COMMENTS -->
      </div>
    </div>
  </div>   
  <!-- /COLUMNA PRINCIPAL -->  

  <!-- SIDEBAR -->
  <div id="sidebar" class="large-4 medium-4 columns">
    <div class="row">
      <?php include('sidebar.php'); ?>
    </div>  
  </div>
  <!-- /SIDEBAR -->

</div>
<!-- /CONTENEDOR -->
<?php get_footer(); ?>
