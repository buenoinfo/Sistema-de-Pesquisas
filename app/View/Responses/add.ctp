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
<br />
<br />
<br />
<fieldset><h3><?php echo $ordem['title']?></h3>
<br />
<br />
<?php
foreach ($perguntas as $pergunta){
	if($pergunta['Question']['question_reason_id'] == $pesquisa['id']){
		if($pergunta['Question']['question_type_id'] == $ordem['id']){
			$tmp[$pergunta['Question']['id']]['Question'] = $pergunta['Question']['title'];
			$tmp[$pergunta['Question']['id']]['multiple'] = $pergunta['Question']['multiple'];
			$tmp[$pergunta['Question']['id']]['option'][$pergunta['QuestionOption']['id']] = $pergunta['QuestionOption']['title'];
		}
	}
}
echo $this->Form->create('Responses',array('type' => 'file'));
$temp = 0;
foreach($tmp as $k=>$v){
	unset($option);
	foreach($v['option'] as $kk=>$vv){
		$option[$kk] = $vv;
	}
	$temp ++;
	if($v['multiple'] == 1){
		echo '<fieldset><h4>'.$v['Question'].'</h4>';
		echo $this->Form->select($k, $option, array('multiple' => 'checkbox'));
		echo $this->Form->input('valores', array('type'=>'hidden', 'label'=>'2ª Opção','value' => 1));
		echo '</fieldset>';
	}elseif($v['multiple'] == 2){
		$num = 0;
		$texto = $value = 0;
		foreach($v['option'] as $text1=>$text){
			$num ++;
			if($texto == 0){
				$texto = false;
				$value = false;
			}
			$texto .= $num.' - '.$text.'<br />';
			$value .= $text1.'||'.$num.'_';
		}
		echo '<fieldset><h4>'.$v['Question'].'</h4><br />';
		echo $texto;
		echo $this->Form->input('1', array('label'=>'1ª Opção'));
		echo $this->Form->input('2', array('label'=>'2ª Opção'));
		echo $this->Form->input('valores', array('type'=>'hidden', 'label'=>'2ª Opção','value' => $value));
		echo $this->Form->input('multiple', array('type'=>'hidden', 'value' => $v['multiple']));
		echo $this->Form->input('question_id', array('type'=>'hidden', 'value' => $k));
		echo '</fieldset>';
	}elseif($v['multiple'] == 3){
		$num = 0;
		$texto = $value = 0;
		foreach($v['option'] as $text1=>$text){
			$num ++;
			if($texto == 0){
				$texto = false;
				$value = false;
			}
			$texto .= $num.' - '.$text.'<br />';
			$value .= $text1.'||'.$num.'_';
		}
		echo '<fieldset><h4>'.$v['Question'].'</h4><br />';
		echo $texto;
		echo $this->Form->input('1', array('label'=>'1ª Opção'));
		echo $this->Form->input('2', array('label'=>'2ª Opção'));
		echo $this->Form->input('3', array('label'=>'3ª Opção'));
		echo $this->Form->input('valores', array('type'=>'hidden', 'label'=>'2ª Opção','value' => $value));
		echo $this->Form->input('multiple', array('type'=>'hidden', 'value' => $v['multiple']));
		echo $this->Form->input('question_id', array('type'=>'hidden', 'value' => $k));
		echo '</fieldset>';
	}else{
		echo '<fieldset><h4>'.$v['Question'].'</h4>';
		echo $this->Form->radio($k, $option, array('legend' => false));
		echo $this->Form->input('valores', array('type'=>'hidden', 'label'=>'2ª Opção','value' => 1));
		echo '</fieldset>';
	}
}
echo $this->Form->end('Avançar');
?>
</fieldset>
