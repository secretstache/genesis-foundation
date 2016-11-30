<section <?php echo section_id_classes(); ?>>

  <?php ssm_maybe_add_content_block_header(); ?>

  <div class="row">

    <?php if ( $wysiwyg = get_sub_field('visual_editor') ) { ?>

    <div class="section-entry small-12 column">

      <?php echo $wysiwyg; ?>

    </div>
    <!-- end .section-entry -->

    <?php } ?>

  </div>
  <!-- end .row -->

</section>
<!-- end .visual-editor -->
