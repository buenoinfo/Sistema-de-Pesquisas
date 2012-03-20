<h2>Editar Pergunta para Pesquisa</h2>
<br />
<?php

	echo $this->Form->create('Question',array('type' => 'file'));
	echo $this->Form->input('title', array('label'=>'Pergunta:'));
	echo $this->Form->input('question_type_id', array('label'=>'Bloco:', 'options' => $blocos, 'empty' => 'Selecione uma opção'));
	echo $this->Form->input('question_reason_id', array('label'=>'Motivo/Pesquisa:', 'options' => $motivos, 'empty' => 'Selecione uma opção'));
	echo $this->Form->end('Editar Pergunta');
?>

