<h2>Motivos da Pesquisa</h2>
<br />
<?php echo $this->Html->link('Adicionar Novo', array('controller' => 'questionreasons', 'action' => 'add')); ?>
<br />
<br />
<table>
    <tr>
        <th>Ano</th>
		<th>Motivo</th>
		<th>Ativa</th>
        <th></th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->
	
    <?php foreach ($questionsReasons as $reason): ?>
    <tr>
    	<td><?php echo $reason['QuestionReason']['year']; ?></td>
		<td><?php echo $reason['QuestionReason']['title']; ?></td>
		<td><?php echo (($reason['QuestionReason']['status'] == 0) ? 'Não' : 'Sim') ?></td>
		<td>
            <?php echo $this->Html->link('Editar', array('action' => 'edit', $reason['QuestionReason']['id']));?>
			<?php echo $this->Form->postLink(
                'Deletar',
                array('action' => 'delete', $reason['QuestionReason']['id']),
                array('confirm' => 'Tem certeza?'));
            ?>
            
        </td>
    </tr>
    <?php endforeach; ?>

</table>
