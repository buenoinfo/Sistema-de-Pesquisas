<h2>Perguntas</h2>
<br />
<?php echo $this->Html->link('Adicionar nova Pergunta', array('controller' => 'questions', 'action' => 'add')); ?>
<br />
<br />
<table>
    <tr>
        <th>Pergunta</th>
		<th>Bloco</th>
		<th>Pesquisa</th>
		<th></th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->
	
    <?php foreach ($questions as $question): ?>
    <tr>
    	<td><?php echo $question['Question']['title']; ?></td>
		<td><?php echo $question['QuestionType']['title']; ?></td>
		<td><?php echo $question['QuestionReason']['title']; ?></td>
		<td>
            <?php echo $this->Html->link('Editar', array('action' => 'edit', $question['Question']['id']));?>
			<?php echo $this->Form->postLink(
                'Deletar',
                array('action' => 'delete', $question['Question']['id']),
                array('confirm' => 'Tem certeza?'));
            ?>
            
        </td>
    </tr>
    <?php endforeach; ?>
	<?php 
	?>
</table>