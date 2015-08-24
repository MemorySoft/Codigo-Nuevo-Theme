<?php get_header(); ?>

<?php include('globalwidget.php'); ?>

<!-- CONTENEDOR -->
<div id="contenedor" class="row post">
  
  <!-- COLUMNA PRINCIPAL -->
  <div id="contenido" class="large-8 medium-8 columns">

    <div id="articulo" class="row">

      
        <div class="large-12 medium-12 columns">
          <?php if(have_posts()) : ?>
              <?php while(have_posts()) : the_post(); ?>

                <!-- CABECERA DEL POST -->
                <div class="row">
                  <div class="large-12 medium-12 columns">
                    <?php edit_post_link('Editar', ''); ?>

                    <div class="post-titulo-contenedor">
                      <h3 class="post-titulo"><?php the_title(); ?></h3>
                      <div class="post-info">
                        <div class="post-categoria"><?php $cat_list = get_my_category_list(); echo $cat_list; ?></div>
                        <div class="post-autor"><?php the_author_posts_link(); ?></div>
                        <!--<div class="post-vistas">
                          <?php if(function_exists('PostViews')) { 
                            echo PostViews(get_the_ID()); 
                          }?>
                        </div>-->
                        <div class="post-fecha"><?php the_time('l j \d\e\ F \d\e\ Y \| G:i'); ?></div>
                      </div>
                    </div>

                    <div class="fb-like" data-href="https://www.facebook.com/pages/C%C3%B3digo-Nuevo/228242773966385" data-width="auto" data-layout="standard" data-action="like" data-show-faces="false" data-share="false">
                    </div>

                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-539eacfa6967c5d7"></script>
                    <div class="addthis_sharing_toolbox"></div>
                    <br/>
                    <br/>
                  </div>
                  <hr/>
                </div>
                <!-- /CABECERA DEL POST -->

                <!-- CUERPO DEL POST -->
                <div class="post-cuerpo">
                  
                  <div class="post-imagen-caja">
                    <span height="auto" class="post-imagen">
                      <?php the_post_thumbnail('post'); ?>
                    </span>
                  </div>

                  <!-- VIDEO PROMO -->
                  <div style="padding-top: 20px; padding-bottom: 20px;">
        						<script>
        			        			var pnetPreSite = "73756";
        			        			var pnetPrePage = "550315";
        						</script>
        						<script type="text/javascript" src="http://adsby.publicidad.net/ad/adip/?r=<?=rand(0,9999999)?>"></script> 
        					</div>
                  <!-- /VIDEO PROMO -->

                  <div class="post-texto">
                    <?php the_content(); ?>  
                  </div>

			            <!-- RECOMENDADOS -->
                  <div id="lig_codigonuevo_smartbox"></div>
			            <script language="javascript" src="http://i.ligatus.com/angular_front/tags/es/codigonuevo/tags/angular-tag.js"></script>				  	
                  <!-- /RECOMENDADOS -->

	                <!-- 
                  ADMAN DESACTIVADO
				  	      <script src="http://icarus-wings.admanmedia.com/intext/intext_vast.js?pmu=bd4d2552;pmb=fdd32c1f;size=600x338;visibility=50"></script>
                  -->

                </div> 
                <!-- /CUERPO DEL POST -->

                <!-- POST WIDGETS -->
                <div class="row">
                  <ul id="post-widget">
                    <?php dynamic_sidebar('post'); ?>
                  </ul>
                  <br>
                  <br>
                </div>
                <!-- /POST WIDGETS -->

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
        
              <?php endwhile; ?>
        
              <!-- AUTOR -->
              <div class="row">
                <div class="large-12 medium-12 columns">
                  <div class="autor-caja">
                    <div class="large-12 medium-12 columns autor-enlaces">
                      <div class="autor-nombre">
                        <h3>
                          <?php the_author_posts_link(); ?> 
                        </h3>
                      </div>
                      <div class="autor-perfiles">
                        <?php if ( get_the_author_meta( 'email_alt' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo get_the_author_meta( 'email_alt' ); ?>"><i class="fa fa-envelope"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'user_url' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?>"><i class="fa fa-globe"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'twitter' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'twitter' ) ); ?>"><i class="fa fa-twitter"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'facebook' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'facebook' ) ); ?>"><i class="fa fa-facebook"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'linkedin' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'linkedin' ) ); ?>"><i class="fa fa-linkedin"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'googleplus' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'googleplus' ) ); ?>"><i class="fa fa-google-plus"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'instagram' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'instagram' ) ); ?>"><i class="fa fa-instagram"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'flickr' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'flickr' ) ); ?>"><i class="fa fa-flickr"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'pinterest' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'pinterest' ) ); ?>"><i class="fa fa-pinterest"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'youtube' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'youtube' ) ); ?>"><i class="fa fa-youtube-play"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'vimeo' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'vimeo' ) ); ?>"><i class="fa fa-vimeo-square"></i></a>
                        <?php } ?>

                        <?php if ( get_the_author_meta( 'tumblr' ) != '' )  { ?>
                          <a target="_blank" href="<?php echo esc_url( get_the_author_meta( 'tumblr' ) ); ?>"><i class="fa fa-tumblr"></i></a>
                        <?php } ?>
                        
                      </div>
                    </div>
                    <div class="large-3 medium-3 columns">
                      <div class="autor-imagen">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), '70' ); ?>
                      </div>
                    </div>
                    <div class="large-9 medium-9 columns">
                      <div class="autor-descripcion">
                        <p><?php echo wp_kses( get_the_author_meta( 'description' ), null ); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /AUTOR -->
        
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
                  <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="50" data-width="600" data-colorscheme="light" style="width:100%;"></div>
                </div>
              </div>
              <!-- /FACEBOOK COMMENTS -->
        
            <?php endif; ?>
        
            <!-- POSTS RELACIONADOS -->
            <div id="similares" class="row">
              
              <?php
                
                $tags = wp_get_post_tags($post->ID);
                
                if ($tags) {
        
                  $first_tag = $tags[0]->term_id;
                  $args=array(
                    'tag__in' => array($first_tag),
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=>6,
                    'ignore_sticky_posts'=>1
                  );
        
                  $my_query = new WP_Query($args);
        
                  if( $my_query->have_posts() ) { ?>

                    </hr>

                    <div class="large-12 medium-12 columns">
                       <h3 class="bloque-titulo"><span>Artículos similares</span></h3>
                    </div>

                    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                  
                      <div class="large-6 medium-6 columns">
                        <div class="extracto-post">
                          <div class="extracto-imagen-caja">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                              <span width="325" height="auto" class="extracto-imagen">
                                <?php the_post_thumbnail('portada'); ?>
                              </span>
                            </a>
                          </div>
                          <div class="extracto-info">
                            <div class="extracto-categoria"><?php $cat_list = get_my_category_list(); echo $cat_list; ?></div>
                            <div class="extracto-autor"><?php the_author_posts_link(); ?></div>
                            <div class="extracto-fecha"><?php the_time('j \d\e\ F'); ?></div>
                          </div>
                          <h3 class="extracto-titulo">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" >
                              <?php the_title(); ?>
                            </a>
                          </h3>
                        </div>
                      </div>
        
                    <?php endwhile; 
                  } wp_reset_query(); 
                } ?> 
        
            </div>
            <!-- /POSTS RELACIONADOS -->

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
