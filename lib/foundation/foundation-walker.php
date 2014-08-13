<?php

class Foundation_Walker extends Walker_Nav_Menu{
// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown\">\n";
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if($depth == 0)
			$output .= "</li>\n<li class=\"divider\"></li>\n";
		else
			$output .= "</li>\n";
	}

	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
		$id_field = $this->db_fields['id'];
		if (!empty($children_elements[$element->$id_field])) {
			$element->classes[] = 'has-dropdown'; //enter any classname you like here!
		}
		Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}