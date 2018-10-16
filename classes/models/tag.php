<?php

namespace WP_Timeliner\Models;

use WP_Timeliner\Schema\Taxonomy_Tag;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A model to get easy access to Tag terms data.
 */
class Tag extends Abstract_Term {
	/**
	 * Define the Tag taxonomy.
	 */
	protected function set_taxonomy() {
		$this->taxonomy = Taxonomy_Tag::TAXONOMY;
	}
}
