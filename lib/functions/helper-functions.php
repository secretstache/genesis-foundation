<?php

/**
 *  Sanitize multiple classes at once
 */
if ( ! function_exists( "sanitize_html_classes" ) && function_exists( "sanitize_html_class" ) ) {
  /**
   * sanitize_html_class works just fine for a single class
   * Some times le wild <span class="blue hedgehog"> appears, which is when you need this function,
   * to validate both blue and hedgehog,
   * Because sanitize_html_class doesn't allow spaces.
   *
   * @uses   sanitize_html_class
   * @param  (mixed: string/array) $class   "blue hedgehog goes shopping" or array("blue", "hedgehog", "goes", "shopping")
   * @param  (mixed) $fallback Anything you want returned in case of a failure
   * @return (mixed: string / $fallback )
   */
  function sanitize_html_classes( $class, $fallback = null ) {

    // Explode it, if it's a string
    if ( is_string( $class ) ) {
      $class = explode(" ", $class);
    }


    if ( is_array( $class ) && count( $class ) > 0 ) {
      $class = array_map("sanitize_html_class", $class);
      return implode(" ", $class);
    }
    else {
      return sanitize_html_class( $class, $fallback );
    }
  }
}


/**
  * Set classes for a block wrapper. These can be overridden or added to with a filter like the following:
  *     add_filter( 'fcb_set_block_wrapper_classes', 'custom_block_wrapper_classes' );
  *     function custom_block_wrapper_classes($classes) {
  *         if(is_page_template('template-landing-page.php') {
  *             $classes[]   = 'on-landing-page';
  *         }
  *         return $classes;
  *     }
  *
  * @return string string of classes
  */
 function ssm_block_wrapper_classes() {
    global $cb_i;
    $classes    = array();
    $classes[]  = get_sub_field('html_id');
    $classes[]  = sanitize_html_classes(get_sub_field('class_options'));
    $classes[]  = 0 == $cb_i % 2 ? 'even' : 'odd';

    $classes = array_filter(array_map('trim', $classes));
    echo trim(implode(' ', apply_filters( 'fcb_set_block_wrapper_classes', $classes )));
}


function ssm_maybe_add_content_block_header() { ?>
  <?php if ( get_sub_field('headline') || get_sub_field('subheadline') ) { ?>

    <div class="row align-center">

      <div class="small-12 medium-9 column">

        <header class="section-header">   

          <?php if ( $headline = get_sub_field('headline') ) { ?>

          <h1 class="section-headline"><?php echo $headline; ?></h1>

          <?php } ?>

          <?php if ( $subheadline = get_sub_field('subheadline') ) { ?>

          <h2 class="section-subheadline"><?php echo $subheadline; ?></h2>

          <?php } ?>

        </header>

      </div>

    </div>

  <?php } 
}

function ssm_do_business_information() { ?>
  
  <?php if ( in_array('Business Name', $business_information) ) { ?>

    <p><span itemprop="name"><?php the_field('legal_business_name', 'options'); ?></span></p>

    <?php } ?>

    <?php if ( in_array('Tagline', $business_information) && get_bloginfo('description') ) { ?>

    <p><span itemprop="description"><?php echo get_bloginfo('description'); ?></p>

    <?php } ?>

    <?php if ( in_array('Address', $business_information) ) { ?>

      <?php $address_line_1 = get_field('address_line_1', 'options'); ?>
      <?php $address_line_2 = get_field('address_line_2', 'options'); ?>
      <?php $city = get_field('city', 'options'); ?>
      <?php $state = get_field('state', 'options'); ?>
      <?php $zipcode = get_field('zipcode', 'options'); ?>

      <?php if ( $address_line_1 || $address_line_2 || $city || $state || $zip ) { ?>

      <div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">

        <?php if ( $address_line_1 ) { ?>

        <p><span itemprop="streetAddress"><?php echo $address_line_1; ?></span></p>

        <?php } ?>

        <?php if ( $address_line_2 ) { ?>

        <p><span itemprop="streetAddress"><?php echo $address_line_2; ?></span></p>

        <?php } ?>

        <?php if ( $city ) { ?>

        <p><span itemprop="addressLocality"><?php echo $city; ?><?php echo $state != NULL ? ',' : ''; ?></span>

        <?php } ?>

        <?php if ( $state ) { ?>

        <span itemprop="addressRegion"><?php echo $state; ?></span>

        <?php } ?>

        <?php if ( $zipcode ) { ?>

        <span itemprop="postalCode"><?php echo ' ' . $zipcode; ?></span></p>

        <?php } ?>

      </div>

      <?php } ?>

      <?php if ( in_array('Phone Number', $business_information) && $phone_number = get_field('phone_number', 'options') ) { ?>

      <p><span itemprop="telephone"><?php echo $phone_number; ?></span></p>

      <?php } ?>

      <?php if ( in_array('Email Address', $business_information) && $default_email = get_field('default_email', 'options') ) { ?>

      <p><a href="mailto:<?php echo $default_email; ?>" itemprop="email"><?php echo $default_email; ?></a></p>

    <?php } ?>

  <?php } ?>

<?php }

function section_id_classes() {

  global $cb_i;

  $even_odd = 0 == $cb_i % 2 ? 'even' : 'odd';

  $inline_classes = get_sub_field('html_classes');

  if ( get_sub_field('column_list') ) {
    $column_count = count(get_sub_field('column_list'));
  }

  if ( get_sub_field('media_type') ) {
    $media_type = sanitize_title_with_dashes( get_sub_field('media_type') );
  }

  $section_id_classes = '';
  // $wrapper_id_classes = '';

  if ( $html_id = get_sub_field('html_id') ) {
    $html_id = sanitize_html_class(strtolower($html_id));
    $section_id_classes .= ' id="' . $html_id . '" class="content-block row-' . $cb_i . ' row-' . $even_odd;
    // $wrapper_id_classes .= ' id="' . $html_id . '" class=" section-wrapper';
  } else { 
    $section_id_classes .= ' class="content-block row-' . $cb_i . ' row-' . $even_odd;
    // $wrapper_id_classes .= ' class="section-wrapper';
  }

  if ( get_row_layout() == 'visual_editor' ) {
    $section_id_classes .= ' visual-editor';
  }

  if ( get_row_layout() == 'headline' ) {
    $section_id_classes .= ' headline';
    if ( get_sub_field('include_cta') == 'Yes') {
      $section_id_classes .= ' with-cta';
    }
  }

  if ( get_row_layout() == 'media' ) {
    $section_id_classes .= ' media ' . $media_type;
  }

  if ( get_row_layout() == 'columns') {
    $section_id_classes .= ' cols has-' . $column_count . '-cols';
    if ( get_sub_field('column_template') == 'Features') {
      $section_id_classes .= ' features';
    } elseif ( get_sub_field('column_template') == 'Services') {
      $section_id_classes .= ' services';
    } elseif ( get_sub_field('column_template') == 'large-8 / large-4') {
      $section_id_classes .= ' grid-8-4';
    }
  }

  if ( get_row_layout() == 'blog_posts' ) {
    $section_id_classes .= ' blog-posts';
  }

  if ( get_row_layout() == 'accordion' ) {
    $section_id_classes .= ' accordion';
  }

  if ( get_row_layout() == 'tabs' ) {
    $section_id_classes .= ' tab-set';
  }

  if ( get_row_layout() == 'form' ) {
    $section_id_classes .= ' form';
  }

  if ( get_row_layout() == 'team' ) {
    $section_id_classes .= ' team';
  }

  // if ( get_row_layout() == 'brag_block' ) {
  //   $section_id_classes .= ' brag-block';
  // }

  // if ( get_row_layout() == 'html_code_block' ) {
  //   $section_id_classes .= ' custom-html';
  // }

  if ( $inline_classes != NULL ) {
    $section_id_classes .= ' ' . $inline_classes;
    // $wrapper_id_classes .= ' ' . $inline_classes;
  }

  $section_id_classes .= '"';
  // $wrapper_id_classes .= '"';

  return $section_id_classes;

}

function genesis_lite() {
  genesis_header_lite();

  do_action('genesis_before_content');

  genesis_markup( array(
    'open'   => '<div %s>',
    'context' => 'row',
  ) );

  genesis_markup( array(
      'open'   => '<main %s>',
      'context' => 'content',
    ) );

  do_action( 'genesis_before_loop' );
  do_action( 'genesis_loop' );
  do_action( 'genesis_after_loop' );
  
  genesis_markup( array(
    'close' => '</main>', // End .content
    'context' => 'content',
  ) );
    
  do_action( 'genesis_after_content' );

  genesis_footer_lite();
}

function genesis_header_lite() {

  do_action( 'genesis_doctype' );
  do_action( 'genesis_title' );
  do_action( 'genesis_meta' );

  wp_head(); //* we need this for plugins
  ?>

  </head>

  <?php

  genesis_markup( array(
    'html5' => '<body %s>',
    'xhtml' => sprintf( '<body class="%s">', implode( ' ', get_body_class() ) ),
    'context' => 'body',
  ) );

  do_action( 'genesis_before' );

  do_action( 'genesis_before_header' );
  do_action( 'genesis_header' );
  do_action( 'genesis_after_header' );

}

function genesis_footer_lite() {

  genesis_markup( array(
    'close' => '</div>', // End .row
    'context' => 'row',
  ) );

  do_action( 'genesis_before_footer' );
  do_action( 'genesis_footer' );
  do_action( 'genesis_after_footer' );
  
  do_action( 'genesis_after' );
  wp_footer(); //* we need this for plugins

  echo '</body>';
  echo '</html>';
}
