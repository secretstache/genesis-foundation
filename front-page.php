<?php
/**
 * This is the homepage template file.
 *
 * @package  Genesis-Starter-Child-Theme
 * @since    1.0.0
 */

/** Force full width layout */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'ssm_home_loop' );

function ssm_home_loop() { ?>

	<div class="demo-section">
		
		<h2>Modal Window</h2>

		<p><a href="#" data-reveal-id="myModal">Click Me For A Modal</a></p>

		<div id="myModal" class="reveal-modal" data-reveal>
		  <h2>Awesome. I have it.</h2>
		  <p class="lead">Your couch.  It is mine.</p>
		  <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
		  <a class="close-reveal-modal">&#215;</a>
		</div>
	
	</div>
	
	<div class="demo-section">
	
		<h2>Alert Box</h2>
	
		<div data-alert class="alert-box success radius">
		  This is a success alert with a radius.
		  <a href="#" class="close">&times;</a>
		</div>
	
		<div>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">
			    <p>First panel content goes here...</p>
			  </div>
			  <div class="content" id="panel2-2">
			    <p>Second panel content goes here...</p>
			  </div>
			  <div class="content" id="panel2-3">
			    <p>Third panel content goes here...</p>
			  </div>
			  <div class="content" id="panel2-4">
			    <p>Fourth panel content goes here...</p>
			  </div>
			</div>
			<ul class="tabs" data-tab>
			  <li class="tab-title active"><a href="#panel2-1">Tab 1</a></li>
			  <li class="tab-title"><a href="#panel2-2">Tab 2</a></li>
			  <li class="tab-title"><a href="#panel2-3">Tab 3</a></li>
			  <li class="tab-title"><a href="#panel2-4">Tab 4</a></li>
			</ul>
		
		</div>
	
	</div>
	
	<div class="demo-section">
	
		<div data-interchange="[<?php echo get_stylesheet_directory_uri(); ?>/templates/partials/small.php, (small)], [<?php echo get_stylesheet_directory_uri(); ?>/templates/partials/medium.php, (medium)]">
		
			<div data-alert class="alert-box alert radius">
				<p>This is the DEFAULT content.</p>
				<a href="#" class="close">&times;</a>
			</div>
		
		</div>
	
	</div>
	
	<div class="demo-section">
		
		<h2>Orbit Slider</h2>
	
		<ul class="example-orbit" data-orbit>
		  <li>
		    <img src="http://foundation.zurb.com/docs/assets/img/examples/satelite-orbit.jpg" alt="slide 1" />
		    <div class="orbit-caption">
		      Caption One.
		    </div>
		  </li>
		  <li class="active">
		    <img src="http://foundation.zurb.com/docs/assets/img/examples/andromeda-orbit.jpg" alt="slide 2" />
		    <div class="orbit-caption">
		      Caption Two.
		    </div>
		  </li>
		  <li>
		    <img src="http://foundation.zurb.com/docs/assets/img/examples/launch-orbit.jpg" alt="slide 3" />
		    <div class="orbit-caption">
		      Caption Three.
		    </div>
		  </li>
		</ul>
	
	</div>
	
	<div class="demo-section">
	
		<ul class="small-block-grid-1 medium-block-grid-3">
		  <li>
		    <dl class="accordion" data-accordion="myAccordionGroup">
		      <dd class="accordion-navigation">
		        <a href="#panel1c">Accordion 1</a>
		        <div id="panel1c" class="content">
		          Panel 1. Lorem ipsum dolor
		        </div>
		      </dd>
		      <dd class="accordion-navigation">
		        <a href="#panel2c">Accordion 2</a>
		        <div id="panel2c" class="content">
		          Panel 2. Lorem ipsum dolor
		        </div>
		      </dd>
		      <dd class="accordion-navigation">
		        <a href="#panel3c">Accordion 3</a>
		        <div id="panel3c" class="content">
		          Panel 3. Lorem ipsum dolor
		        </div>
		      </dd>
		    </dl>
		  </li>
		  <li>
		    <dl class="accordion" data-accordion="myAccordionGroup">
		      <dd class="accordion-navigation">
		        <a href="#panel4c">Accordion 4</a>
		        <div id="panel4c" class="content">
		          Panel 4. Lorem ipsum dolor
		        </div>
		      </dd>
		      <dd class="accordion-navigation">
		        <a href="#panel5c">Accordion 5</a>
		        <div id="panel5c" class="content">
		          Panel 5. Lorem ipsum dolor
		        </div>
		      </dd>
		      <dd class="accordion-navigation">
		        <a href="#panel6c">Accordion 6</a>
		        <div id="panel6c" class="content">
		          Panel 6. Lorem ipsum dolor
		        </div>
		      </dd>
		    </dl>
		  </li>
		</ul>
	
	</div>
	
	<div class="demo-section">
		
		<h2>Equal Height Columns</h2>
	
		<div class="info-cols" data-equalizer>
			<div class="large-6 column">
			  <div class="panel" data-equalizer-watch>
			    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam dignissim convallis sem vel ornare. In non risus vel nunc semper luctus. Pellentesque sed elit massa, a fermentum arcu. Cras sit amet nisi nec arcu tincidunt mollis quis nec lorem. Mauris sapien tortor, feugiat in mollis vitae, eleifend id nisi. Aliquam congue, risus eget ornare aliquet, metus magna tristique quam, ut elementum turpis arcu a velit. Quisque urna ante, semper sit amet faucibus eget, cursus sit amet ante. Vivamus rhoncus accumsan ligula, quis aliquam nisl iaculis vitae. Nullam blandit purus a massa pulvinar vitae posuere nisl vulputate. Quisque pretium facilisis turpis, ut sollicitudin turpis sodales eget. Donec interdum tincidunt molestie. Aliquam commodo consectetur egestas. Suspendisse convallis, arcu in sodales ullamcorper, arcu est ornare enim, sit amet varius tortor libero sit amet tellus. Pellentesque sit amet tortor vitae nisl mollis posuere.
			  </div>
			</div>
		  <div class="large-6 column">
			  <div class="panel"  data-equalizer-watch>
			    Vivamus rhoncus accumsan ligula, quis aliquam nisl iaculis vitae. Nullam blandit purus a massa pulvinar vitae posuere nisl vulputate. Quisque pretium facilisis turpis, ut sollicitudin turpis sodales eget. Donec interdum tincidunt molestie. Aliquam commodo consectetur egestas. Suspendisse convallis, arcu in sodales ullamcorper, arcu est ornare enim, sit amet varius tortor libero sit amet tellus. Pellentesque sit amet tortor vitae nisl mollis posuere.
			  </div>
		  </div>
		</div>
	
	</div>
	
	<div class="demo-section">
	
	<span data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip tip-top radius" title="Tooltips are awesome, you should totally use them!">extended information</span>
	
	</div>
	
	<div class="demo-section">
		
		<h2>Dropdown Button</h2>
	
		<a href="#" data-dropdown="drop1" class="button dropdown">Dropdown Button</a><br>
		<ul id="drop1" data-dropdown-content class="f-dropdown">
		  <li><a href="#">This is a link</a></li>
		  <li><a href="#">This is another</a></li>
		  <li><a href="#">Yet another</a></li>
		</ul>
	
	</div>
	
	<div class="demo-section">
		
	<h2>Range Slider</h2>
	
	<div class="range-slider" data-slider>
	  <span class="range-slider-handle"></span>
	  <span class="range-slider-active-segment"></span>
	  <input type="hidden">
	</div>
	
	</div>
	
	<div class="demo-section">
	
		<h2>Foundation Icons</h2>
		
		<i class="fi-heart">Heart</i>
		<i class="fi-star">Star</i>
	
	</div>


<?php }

genesis();
