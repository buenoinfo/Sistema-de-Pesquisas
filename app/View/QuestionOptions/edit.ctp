<h2>Editar de Op��es para as Perguntas</h2>
<br />
<?php

	echo $this->Form->create('QuestionOption',array('type' => 'file'));
	echo $this->Form->input('title', array('label'=>'Op��o:'));
	echo $this->Form->input('question_id', array('label'=>'Pergunta:', 'options' => $perguntas, 'empty' => 'Selecione uma op��o'));
	
	echo $this->Form->end('Editar Op��o de Resposta');
?>

<?php echo $this->Html->link('Cadastrar nova pergunta', array('controller' => 'questions', 'action' => 'add')); ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $this->Html->link('Terminar', array('controller' => 'questions', 'action' => 'index')); ?>
