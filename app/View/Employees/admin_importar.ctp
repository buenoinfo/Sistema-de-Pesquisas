<h2>Importar Funcion�rios</h2>
<br />
<p>Informe o arquivo .txt para importa��o/atualiza��o dos funcion�rios</p>
<p>Formato do arquivo: <strong>matricula;nome;CPF;dataNascimento;Situa��o</strong></p>
<?php
echo $this->Form->create('Employee',array('type' => 'file'));
echo $this->Form->input('arquivo', array('label' => 'Arquivo:', 'type' => 'file'));
echo $this->Form->end('Importar');
?>