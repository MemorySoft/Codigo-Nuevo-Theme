<!-- SIDEBAR AUTOR -->
  <div class="hack-guarrete" style="width:343px;height:0;">
    <!-- Lo sé, iré al infierno de los desarrolladores web pero oye, uno tiene sus días... -->
  </div>

  <div class="large-12 medium-12 columns">

    <div id="autor" class="autor-caja sidebar">

      <div class="large-12 medium-12 columns autor-enlaces">
        <div class="autor-nombre">
          <h3>
            <?php the_author(); ?> 
          </h3>
        </div>
      </div>

      <div class="large-12 medium-12 columns">
        <div class="autor-imagen">
          <?php echo get_avatar( get_the_author_meta( 'ID' ), '70' ); ?>
        </div>
        <hr/>
      </div>

      <div class="large-12 medium-12 columns">
        <div class="autor-descripcion">
          <p><?php echo wp_kses( get_the_author_meta( 'description' ), null ); ?></p>
        </div>
        <hr/>
        <div class="autor-perfiles">
          <?php if ( get_the_author_meta( 'email_alt' ) != '' )  { ?>
            <a target="_blank" href="mailto:<?php echo get_the_author_meta( 'email_alt' ); ?>"><i class="fa fa-envelope"></i></a>
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

    </div>

  </div>
<!-- /SIDEBAR AUTOR -->