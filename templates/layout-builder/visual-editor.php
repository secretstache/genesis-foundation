<?php

include( CHILD_DIR . '/templates/partials/additional-classes.php' );

?>

<section <?php echo $section_id_classes; ?>>

  <div class="wrap">

    <?php ssm_maybe_add_content_block_header(); ?>

    <?php if ( $wysiwyg = get_sub_field('visual_editor') ) { ?>

    <div class="section-entry small-12 column">

      <?php echo $wysiwyg; ?>

    </div>
    <!-- end .section-entry -->

    <?php } ?>

  </div>
  <!-- end .wrap -->

</section>
<!-- end .visual-editor -->
