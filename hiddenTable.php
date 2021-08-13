<?php


$hidTable = new Hidden($this->group, $this->token);
$hidTable->get();
$hidTable->default();
$hidTable->headers();
$hidTable->result();
$hidTable->links();
$links = $hidTable->links;


// ophalen van group links die niet verborgen zijn
$visibility = 'hidden';

$table = new Table( $links, $this->token, $visibility, $this->group);
$table->table();

?>
