<?php

function search_filter($query) {
	if ( ! is_admin() && $query->is_main_query() ) {
		if ( $query->is_search ) {
			$the_query = $query->query;
			$search_term = $the_query['s'];
			if ( str_contains($search_term, 'fabric') ) {
				?>
				<script type="text/javascript">window.location.replace("/fabrics");</script>
				<?php
			} elseif ( str_contains($search_term, 'finish') ) {
				?>
				<script type="text/javascript">window.location.replace("/finishes");</script>
				<?php
			}
			else {
				$new_search = str_replace("x ", "x collection ", $search_term);
 				$query->set( 's', $new_search);
			}
		}
	}
}
add_action( 'pre_get_posts', 'search_filter' );