<h2>Seja bem vindo!</h2>
<br />
<br />
<?php 
$pesquisa = $this->Session->read('pesquisa');
?>
<p>Você irá participar da <strong><?php echo strtolower	($pesquisa[0]['question_reasons']['title']) ?>.</strong> Sua participação é muito importante para a empresa.</p><br />
<p>Lembramos que essa pesquisa tem a intenção de nos ajudar a entender a suas necessidades e sentimentos para com a empresa, as respostas aqui fornecidas em momento algum serão vinculadas ao trabalhador.</p><br />
<p>Para iniciar iremos solicitar alguns dados pessoais, apenas para confirmar sua participação:</p><br />
<br />
<?php
	$pergunta = explode('|',$perguntas[array_rand(range(1,count($perguntas)),1)]);
	
	echo $this->Form->create('Employee',array('type' => 'file'));
	echo $this->Form->input('matricula', array('label'=>'Matricula:'));
	echo $this->Form->input($pergunta[0], array('label'=>$pergunta[1].':'));
	echo $this->Form->end('Conferir dados');

?>