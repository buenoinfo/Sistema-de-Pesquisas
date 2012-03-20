<h2>Relação de Pendências</h2>
<br />
<br />
<?php 
$pesquisa = $this->Session->read('pesquisa');
$blocos = $this->Session->read('blocos');
?>
<h3><strong><?php echo $pesquisa['title'] ?></strong></h3><br />
<br />
<p>Abaixo relação de colaboradores que não concluiram todas as etapas da pesquisa.</p>
<br />
<?php
	$return = '
		<table>
			<tr>
				<th>Matricula</th>
				<th>Nome</th>
				<th>Etapa</th>
			</tr>
	';
	foreach($employees as $v){
		if($v['EmployeeReason']['question_type_id'] < $blocos){
			$return .= '
				<tr>
					<td>'.$v['Employee']['id'].'</td>
					<td>'.$v['Employee']['nome'].'</td>
					<td>'.$v['EmployeeReason']['question_type_id'].'</td>
				</tr>
			';
		}
	}
	$return .= '</table>';
	echo $return;
?>