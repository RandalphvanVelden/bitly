<?php

$visTable = new Visible($this->group, $this->token);
$visTable->get();
$visTable->default();
$visTable->headers();
$visTable->result();
$visTable->links();
$links = $visTable->links;

// ophalen van group links die niet verborgen zijn
$visibility = 'visible';

$table = new Table( $links, $this->token, $visibility, $this->group);
$table->table();
?>