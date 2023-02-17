<?php

namespace Dtest;

defined( 'ABSPATH' ) || exit;

class Main {
	public function init() {
		$this->assets->init();
		$this->shortcodes->init();

		\add_action( 'parse_request', array( $this, 'handle_todo_items' ) );
	}

	public function handle_todo_items( $o ) {
		if ( ! isset( $_REQUEST['details'] ) ) {
			return;
		}

		$entityManager = dtest_get_entity_manager();

		$todo_item = new TodoItem();
		$todo_item->setDetails( $_REQUEST['details'] );
		$entityManager->persist( $todo_item );
		$entityManager->flush();
	}

	public function __construct(
		public Assets $assets,
		public Shortcodes $shortcodes
	) {}
}
