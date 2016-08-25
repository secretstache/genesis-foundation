<?php

include( CHILD_DIR . '/templates/partials/additional-classes.php' );

?>

<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block visual-editor row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

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
