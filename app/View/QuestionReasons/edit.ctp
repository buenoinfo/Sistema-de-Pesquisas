<h2>Editar Motivo para Pesquisa</h2>
<br />
<?php

	echo $this->Form->create('QuestionReason',array('type' => 'file'));
	echo $this->Form->input('title', array('label'=>'Motivo:'));
	echo $this->Form->input('year', array('label'=>'Ano:'));
	echo '&nbsp;Pesquisa Ativa'.$this->Form->checkbox('status');
	echo $this->Form->end('Editar Motivo');
?>

