<?php

namespace Dtest;

defined( 'ABSPATH' ) || exit;

class Shortcodes {
	public function init() {
		\add_shortcode( 'todo_items', array( $this, 'render_todo_items' ) );
	}

	public function render_todo_items() {
		$entityManager       = dtest_get_entity_manager();
		$todoItemsRepository = $entityManager->getRepository( 'Dtest\TodoItem' );
		$todoItems           = $todoItemsRepository->findAll();
		$todo_items_html     = '<ul>';
		foreach ( $todoItems as $todoItem ) {
			$todo_items_html .= '<li>' . $todoItem->getDetails() . '</li>';
		}
		$todo_items_html .= '</ul>';
		$html             = sprintf( '<h2>Todo items</h2> %s <form method="POST"> <div><input type="text" name="details" ><input type="submit"></div> </form>', $todo_items_html );
		return $html;
	}
}
