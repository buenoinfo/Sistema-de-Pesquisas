<h2>Importar Funcionários</h2>
<br />
<p>Informe o arquivo .txt para importação/atualização dos funcionários</p>
<p>Formato do arquivo: <strong>matricula;nome;CPF;dataNascimento;Situação</strong></p>
<?php
echo $this->Form->create('Employee',array('type' => 'file'));
echo $this->Form->input('arquivo', array('label' => 'Arquivo:', 'type' => 'file'));
echo $this->Form->end('Importar');
?>