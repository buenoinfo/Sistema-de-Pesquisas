<h2>Adiconar Pergunta para Pesquisa</h2>
<br />
<?php

	echo $this->Form->create('Question',array('type' => 'file'));
	echo $this->Form->input('title', array('label'=>'Pergunta:'));
	echo $this->Form->input('question_type_id', array('label'=>'Bloco:', 'options' => $blocos, 'empty' => 'Selecione uma op��o'));
	echo $this->Form->input('question_reason_id', array('label'=>'Motivo/Pesquisa:', 'options' => $motivos, 'empty' => 'Selecione uma op��o'));
	echo '&nbsp;M�ltipla Escolha'.$this->Form->checkbox('multiple', array('label'=>'M�ltipla Escolha:'));
	echo $this->Form->end('Adicionar Pergunta');
?>

<?php echo $this->Html->link('Terminar', array('controller' => 'questions', 'action' => 'index')); ?>

