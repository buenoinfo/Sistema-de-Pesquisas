<?php
$pesquisa = $this->Session->read('pesquisa');
$pesquisa = $pesquisa[0]['question_reasons'];
$ordem = 	$this->Session->read('bloco');		
$ordem = $ordem[0]['blocos'];
$employee = $this->Session->read('employee');		
?>
<h2><?php echo $employee['nome']?></h2>
<br />
<h3>PESQUISA: <?php echo $pesquisa['title']?></h3>
<br /><br />
<p>Muito obrigado por responder a essa pesquisa, a FUNDIMISA agradece sua participa��o.</p>
<p>Sua opini�o � muito importante para n�s.</p>
<p>� Dire��o.</p>
<br />
<?php echo $this->Form->postLink('Voltar para o inicio', array('action' => 'end')); ?>
