<?php
$this->visibility = 'hidden';

$table = new Table($this->data, $this->id, $this->token, $this->method, $this->visibility, $this->group);
$table->table();
?>
