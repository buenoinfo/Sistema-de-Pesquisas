<h2>Seja bem vindo!</h2>
<br />
<br />
<?php 
$pesquisa = $this->Session->read('pesquisa');
?>
<p>Voc� ir� participar da <strong><?php echo strtolower	($pesquisa[0]['question_reasons']['title']) ?>.</strong> Sua participa��o � muito importante para a empresa.</p><br />
<p>Lembramos que essa pesquisa tem a inten��o de nos ajudar a entender a suas necessidades e sentimentos para com a empresa, as respostas aqui fornecidas em momento algum ser�o vinculadas ao trabalhador.</p><br />
<p>Para iniciar iremos solicitar alguns dados pessoais, apenas para confirmar sua participa��o:</p><br />
<br />
<?php
	$pergunta = explode('|',$perguntas[array_rand(range(1,count($perguntas)),1)]);
	
	echo $this->Form->create('Employee',array('type' => 'file'));
	echo $this->Form->input('matricula', array('label'=>'Matricula:'));
	echo $this->Form->input($pergunta[0], array('label'=>$pergunta[1].':'));
	echo $this->Form->end('Conferir dados');

?>