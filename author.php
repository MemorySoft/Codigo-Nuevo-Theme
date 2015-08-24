<?php get_header(); ?>

<!-- CONTENEDOR -->
<div id="contenedor" class="row">
  
  <!-- COLUMNA PRINCIPAL -->
  <div id="contenido" class="large-8 medium-8 columns">

    <!--  Por alguna maldita razón si ponemos the_author() antes del loop
          aparece siempre el nombre de Rubén Sanchéz... :? y detrá no tiene sentido -->

          <div class="row">
            <div class="post-titulo-contenedor large-12 medium-12 columns">
              <h3 class="post-titulo">
                Artículos de <span class="js-autor-nombre"></span>     
              </h3>  
            </div>
            <hr/>
          </div> 


    <div id="loop" class="row autor">  


      <!-- POSTS -->
      <?php if(have_posts()) : ?>

        <?php while(have_posts()) : the_post(); ?>

          <div class="large-12 medium-12 columns">
            <div class="extracto-post extracto-mini">
              <div class="extracto-imagen-caja">
                <?php edit_post_link('Editar', ''); ?>
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                  <div width="325" class="extracto-imagen">
                    <?php the_post_thumbnail('portada'); ?>
                  </div>
                </a>
              </div>
              <h3 class="extracto-titulo">
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" >
                  <?php the_title(); ?>
                </a>
              </h3>
              <p class="extracto-texto">
                <?php $customLength=20; echo get_the_excerpt(); $customLength=0; ?>
              </p>
            </div>
          </div>
          <!-- /POSTS -->

        <?php endwhile; ?>
      <?php endif; ?>

    </div>  

    <!-- PAGINADOR -->
    <div id="post-navegacion" class="row">
      <hr/>
      <div class="large-12 medium-12 columns">
        <div class="post-recientes"><i class="fa fa-chevron-left"></i> <?php previous_posts_link( 'Atrás' ); ?></div>
        <div class="post-antiguos"><?php next_posts_link( 'Más' ); ?> <i class="fa fa-chevron-right"></i></div>
      </div>
    </div>
    <!-- /PAGINADOR -->
  </div>   
  <!-- /COLUMNA PRINCIPAL -->  

  <!-- SIDEBAR -->
  <div id="sidebar" class="large-4 medium-4 columns">
    <div class="row">
      <?php include('sidebar-autor.php'); ?>
    </div>  
  </div>
  <!-- /SIDEBAR -->

</div>
<!-- /CONTENEDOR -->

<?php get_footer();?>