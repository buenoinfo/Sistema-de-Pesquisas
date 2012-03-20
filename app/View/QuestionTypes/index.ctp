<h2>Blocos de Perguntas da Pesquisa</h2>
<br />
<?php echo $this->Html->link('Adicionar Novo', array('controller' => 'questiontypes', 'action' => 'add')); ?>
<br />
<br />
<table>
    <tr>
        <th>Título</th>
		<th>Ordem</th>
		<th></th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->
	
    <?php foreach ($questionTypes as $type): ?>
    <tr>
    	<td><?php echo $type['QuestionType']['title']; ?></td>
		<td><?php echo $type['QuestionType']['order']; ?></td>
		<td>
            <?php echo $this->Html->link('Editar', array('action' => 'edit', $type['QuestionType']['id']));?>
			<?php echo $this->Form->postLink(
                'Deletar',
                array('action' => 'delete', $type['QuestionType']['id']),
                array('confirm' => 'Tem certeza?'));
            ?>
            
        </td>
    </tr>
    <?php endforeach; ?>

</table>
