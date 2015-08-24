<?php get_header(); ?>
<?php

  global $query_string;
  $query_args = explode("&", $query_string);
  $search_query = array();

  foreach($query_args as $key => $string) {
    $query_split = explode("=", $string);
    $search_query[$query_split[0]] = urldecode($query_split[1]);
  } // foreach

  $search = new WP_Query($search_query);

  global $wp_query;
  $total_results = $wp_query->found_posts;
?>
<!-- CONTENEDOR -->
<div id="contenedor" class="row">
  
  <!-- COLUMNA PRINCIPAL -->
  <div id="contenido" class="large-8 medium-8 columns">

    <div class="row">
      <div class="post-titulo-contenedor large-12 medium-12 columns">
        <h3 class="post-titulo">
          <?php 
            /* Contador de resultados */ 
            $allsearch = new WP_Query("s=$s&showposts=-1"); 
            $count = $allsearch->post_count; echo $count . ' '; 
            wp_reset_query(); 
          ?> 
            <!-- Texto del título -->
            resultados para 
            
          "<?php the_search_query() ?>"
        </h3>  
      </div>
      <hr/>
    </div>

    <div id="loop" class="row busqueda">

      <!-- RESULTADOS -->
      <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post(); ?>

          <div class="large-12 medium-12 columns">
            <div class="extracto-post extracto-mini">
              <div class="extracto-imagen-caja">
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
              <!-- <div class="extracto-info">
                <div class="extracto-categoria"><?php $cat_list = get_my_category_list(); echo $cat_list; ?></div>
                <div class="extracto-autor"><?php the_author_posts_link(); ?></div>
                <div class="extracto-fecha"><?php the_time('l j \d\e\ F \d\e\ Y'); ?></div>
              </div> -->
              <?php edit_post_link('Editar', ''); ?>
              <p class="extracto-texto">
                <?php $customLength=20; echo get_the_excerpt(); $customLength=0; ?>
              </p>
            </div>
          </div>

      <?php endwhile; else: ?>
        <div class="large-12 medium-12 medium-centered columns">
          <h3>Ups <small>Lo sentimos, no se ha encontrado ningún contenido relacionado con "<?php the_search_query() ?>".</small></h3> 
        </div>
      <?php endif; ?>
      <!-- /RESULTADOS -->

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
      <?php include('sidebar.php'); ?>
    </div>  
  </div>
  <!-- /SIDEBAR -->

</div>
<!-- /CONTENEDOR -->

<!-- BUSQUEDA -->
<div id="busqueda" class="row buscador">
  <div class="large-12 medium-12 columns">
    <h3>¿No encuentras lo que buscabas?</h3>
    <p>Busca otra vez...</p>
    <form method="get" id="buscador-extra" action="<?php bloginfo('url'); ?>/">
      <div class="row collapse">
        <div class="large-10 small-12 columns"> 
          <input id="buscador-texto-extra" type="text" placeholder="Buscar en Código Nuevo" name="s" value="<?php the_search_query(); ?>"> 
        </div> 
        <div class="large-2 small-12 columns"> 
          <button class="button postfix" type="submit" id="buscador-boton-extra"><i class="fa fa-search fa-lg"></i> Buscar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- /BUSQUEDA -->
<?php get_footer();?>