<?php

// ophalen van group links die niet verborgen zijn
$this->visibility = 'visible';

$table = new Table($this->data, $this->id, $this->token, $this->method, $this->visibility, $this->group);
$table->table();
?>