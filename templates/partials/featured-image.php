<?php

if ( has_post_thumbnail() ) { ?>

	<div class="row">

		<div class="featured-image small-12 column">

			<?php the_post_thumbnail('featured-image'); ?>

		</div>

	</div>

<?php } ?>