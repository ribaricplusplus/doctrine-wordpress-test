<?php

namespace Dtest;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table( name: 'wp_todo_items' )]
class TodoItem {
	#[ORM\Id]
	#[ORM\Column( type: 'integer' )]
	#[ORM\GeneratedValue]
	private int $id;
	#[ORM\Column( type: 'string' )]
	private string $details;

	public function getDetails(): string {
		return $this->details;
	}

	public function setDetails( string $details ): void {
		$this->details = $details;
	}
}
