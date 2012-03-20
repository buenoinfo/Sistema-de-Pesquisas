<h2>Opções de Resposta para as Perguntas</h2>
<br />
<?php echo $this->Html->link('Adicionar Novo', array('controller' => 'questionoptions', 'action' => 'add')); ?>
<br />
<br />
<table>
    <tr>
        <th>Título</th>
		<th></th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->
	
    <?php foreach ($questionOptions as $options): ?>
    <tr>
    	<td><?php echo $options['QuestionOption']['title']; ?></td>
		<td><?php echo $options['Question']['title']; ?></td>
		<td>
            <?php echo $this->Html->link('Editar', array('action' => 'edit', $options['QuestionOption']['id']));?>
			<?php echo $this->Form->postLink(
                'Deletar',
                array('action' => 'delete', $options['QuestionOption']['id']),
                array('confirm' => 'Tem certeza?'));
            ?>
            
        </td>
    </tr>
    <?php endforeach; ?>

</table>
