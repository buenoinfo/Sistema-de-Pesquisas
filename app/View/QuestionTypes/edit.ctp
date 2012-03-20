<h2>Editar Bloco de Perguntas para Pesquisa</h2>
<br />
<?php

	echo $this->Form->create('QuestionType',array('type' => 'file'));
	echo $this->Form->input('title', array('label'=>'Título Bloco:'));
	echo $this->Form->input('question_reason_id', array('label'=>'Motivo/Pesquisa:', 'options' => $motivos, 'empty' => 'Selecione uma opção'));
	echo $this->Form->input('order', array('label'=>'Ordem na Pesquisa:'));
	echo $this->Form->end('Editar Bloco');
?>

