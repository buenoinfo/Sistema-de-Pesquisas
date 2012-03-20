<?php
	class ResponsesController extends AppController {
		public $name = 'Responses';
		public $helpers = array('Html', 'Form');
				
		public function index() {
			$this->set('perguntas', array ('cpf|CPF (somente números)', 'diaNasc|Dia Nascimento (dd)', 'mesNasc|Mês Nascimento (mm)','anoNasc|Ano Nascimento (aaaa)','diaMesNasc|Dia e Mês de Nascimento (dd/aaaa)','mesAnoNasc|Mês e Ano de Nascimento (mm/aaaa)'));
			$this->Session->write('pesquisa', $this->Response->query('SELECT * FROM question_reasons WHERE status = 1 LIMIT 1'));
			$pesquisa = $this->Session->read('pesquisa');
			$pesquisa = $pesquisa[0]['question_reasons'];
			$blocos = $this->Response->query('SELECT COUNT(id) as total FROM question_types WHERE question_reason_id = '.$pesquisa['id'].'');
			$this->Session->write('pesquisa_blocos', $blocos[0][0]['total']);
			$this->set('responses', $this->Response->find('all'));
			if($this->request->is('post')) {
				$this->verifica($this->request->data['Employee']);
				if($this->erro){
					$this->Session->setFlash($this->erro);
					$this->redirect(array('action' => 'index'));
				}else{
					$employee = $this->Session->read('employee');
					$pesquisa = $this->Session->read('pesquisa');
					$pesquisa = $pesquisa[0]['question_reasons'];
					
					$employee_reason = $this->Response->query('SELECT * FROM employee_reasons WHERE employee_id = '.$employee['matricula'].' AND question_reason_id = '.$pesquisa['id'].' LIMIT 1');
					if($employee_reason){
						$etapa = ($employee_reason[0]['employee_reasons']['question_type_id']) + 1;
						$this->redirect('add/'.$etapa);
					}else{
						$this->redirect('add/1');
					}
				}
			}
		}
		
		public function add($id) {
			if(!$this->Session->check('employee')){
				$this->Session->setFlash('Para responder a pesquisa primeiro você precisa informar os seus dados');
				$this->redirect(array('action' => 'index'));
			}
			$employee = $this->Session->read('employee');
			$pesquisa = $this->Session->read('pesquisa');
			$pesquisa = $pesquisa[0]['question_reasons'];
			$employee_reason = $this->Response->query('SELECT * FROM employee_reasons WHERE employee_id = '.$employee['matricula'].' AND question_reason_id = '.$pesquisa['id'].' LIMIT 1');
			if($employee_reason){
				$etapa = ($employee_reason[0]['employee_reasons']['question_type_id']) + 1;
				if($etapa != $id){
					$this->Session->setFlash('Você precisa responder todas as etapas');
					$this->redirect('add/'.$etapa);
				}
			}
			if($id > 1){
				if(!$employee_reason){
					$this->Session->setFlash('Para responder a pesquisa primeiro você precisa informar os seus dados');
					$this->redirect(array('action' => 'index'));
				}
				$etapa = ($employee_reason[0]['employee_reasons']['question_type_id']) + 1;
				if($etapa != $id){
					$this->Session->setFlash('Você precisa responder todas as etapas');
					$this->redirect('add/'.$etapa);
				}
			}
			
			$this->Response->recursive = 2;
			$this->Response->Question->recursive = 2;
			$this->Session->write('bloco', $this->Response->query('SELECT * FROM question_types blocos WHERE blocos.order = '.$id.' LIMIT 1'));
			$this->set('perguntas', $this->Response->Question->QuestionOption->find('all'));
			if($this->request->is('post')) {
				$dados = $this->request->data;
				$this->verificaDados($dados['Responses']);
				if($this->erro){
					$this->Session->setFlash($this->erro);
				}else{
					$reponses['Response']['question_reason_id'] = $pesquisa['id'];
					
					if($dados['Responses']['valores'] != 1){
						$tmp = explode('_',$dados['Responses']['valores']);
						$total_valor = 0;
						foreach($tmp as $v){
							if($v){
								$temp = explode('||',$v);
								$valor[$temp[0]] = $temp[1];
								$total_valor ++;
							}
						}
						for($i=1;$i<=$dados['Responses']['multiple'];$i++){
							if(!is_numeric($dados['Responses'][$i]) or $dados['Responses'][$i] < 1 or $dados['Responses'][$i] > $total_valor){
								$this->Session->setFlash('Para está questão informar somente o número corresponte ao fator desejado!');
								$this->redirect('add/'.$etapa);
							}
							for($ii=1;$ii<=$dados['Responses']['multiple'];$ii++){
								if($i != $ii){
									if($dados['Responses'][$i] == $dados['Responses'][$ii]){
										$this->Session->setFlash('Para está questão os valores não podem se repetir');
										$this->redirect('add/'.$etapa);
									}
								}
							}
						}
						for($i=1;$i<=$dados['Responses']['multiple'];$i++){
							foreach($valor as $k=>$v){
								if($dados['Responses'][$i] == $v){
									$reponses['Response']['question_id'] = $dados['Responses']['question_id'];
									$reponses['Response']['question_option_id'] = $k;
									$reponses['Response']['value'] = $i;
									$this->Response->create();
									$this->Response->save($reponses);
								}
							}
						}
					}else{
						
						foreach($dados['Responses'] as $k=>$v){
							if(is_numeric($k)){
								if(!is_array($v)){
									$reponses['Response']['question_id'] = $k;
									$reponses['Response']['question_option_id'] = $v;
									$this->Response->create();
									$this->Response->save($reponses);
								}else{
									foreach($v as $vv){
										$reponses['Response']['question_id'] = $k;
										$reponses['Response']['question_option_id'] = $vv;
										$this->Response->create();
										$this->Response->save($reponses);
									}	
								}
							}
						}
					}
					if($id == 1){
						$this->Response->query('INSERT INTO employee_reasons (employee_id,question_reason_id,question_type_id,created) VALUES('.$employee['matricula'].','.$pesquisa['id'].','.$id.',NOW())');
					}else{
						$this->Response->query('UPDATE employee_reasons SET question_type_id = '.$id.', updated = NOW() WHERE employee_id =  '.$employee['matricula'].' AND question_reason_id = '.$pesquisa['id'].' LIMIT 1');
					}
					$id ++;
					$blocos = $this->Session->read('pesquisa_blocos');
					if($blocos >= $id){
						$this->redirect('add/'.$id);
					}else{
						$this->redirect(array('action' => 'end'));
					}
				}
			}
		}
		
		public function end() {
			if($this->request->is('post')) {
				$this->Session->delete('employee');
				$this->Session->delete('pesquisa');
				$this->Session->delete('blocos');
				$this->redirect(array('action' => 'index'));
			}
		}
		
		public function verificaDados($dados){
			foreach($dados as $v){
				if(!$v){
					$this->erro = 'Todos os campos são de preenchimento obrigatório';
				}
			}
			return;
		}
		
		public function verifica($dados){
			if(!$employee = $this->Response->query('SELECT * FROM employees WHERE id = '.$dados['matricula'].' LIMIT 1')){
				$this->erro = 'Matricula do colaborador informado não é válida';
				return;
			}else{
				if($employee[0]['employees']['sitAfa'] != 1){
					$this->erro = 'Dados do colaborador informado não são válidos';
					return;
				}
				foreach($dados as $k=>$v){
					if($k != 'matricula')
						$campo = $k;
				}
				if($campo == 'diaNasc'){
					$diaNasc = substr($employee[0]['employees']['dataNasc'],-2);
					if(count($dados['diaNasc']) == 1){
						if(substr($diaNasc,-1) != $dados['diaNasc']){
							$this->erro = 'Dados do colaborador informado não são válidos';
							return;
						}
					}else{
						if($diaNasc != $dados['diaNasc']){
							$this->erro = 'Dados do colaborador informado não são válidos';
							return;
						}
					}
				}elseif($campo == 'mesNasc'){
					$mesNasc = substr($employee[0]['employees']['dataNasc'],5,2);
					if(strlen($dados[$campo]) != 2 or !is_numeric($dados[$campo])){
						$this->erro = 'Formato dos dados não são válidos';
						return;
					}
					if($dados[$campo] != $mesNasc){
							$this->erro = 'Dados do colaborador informado não são válidos';
							return;
					}
				}elseif($campo == 'cpf'){
					if($this->validaCPF($dados['cpf'])){
						$this->erro = 'Dados do colaborador informado não são válidos';
						return;
					}
					if($employee[0]['employees']['cpf'] != $dados[$campo]){
						$this->erro = 'Dados do colaborador informado não são válidos';
						return;
					}
				}elseif($campo == 'anoNasc'){
					$anoNasc = substr($employee[0]['employees']['dataNasc'],0,4);
					if(strlen($dados[$campo]) != 4 or !is_numeric($dados[$campo])){
						$this->erro = 'Formato dos dados não são válidos';
						return;
					}
					if($dados[$campo] != $anoNasc){
						$this->erro = 'Dados do colaborador informado não são válidos';
						return;
					}
				}elseif($campo == 'diaMesNasc'){
					$diaNasc = substr($employee[0]['employees']['dataNasc'],-2);
					$mesNasc = substr($employee[0]['employees']['dataNasc'],5,2);
					$tmp = explode('/',$dados[$campo]);
					if(count($tmp) != 2 or strlen($tmp[0]) != 2 or strlen($tmp[1]) != 2 or !is_numeric($tmp[0]) or !is_numeric($tmp[1])){
						$this->erro = 'Formato dos dados não são válidos';
						return;
					}
					if($tmp[0] != $diaNasc or $tmp[1] != $mesNasc){
						$this->erro = 'Dados do colaborador informado não são válidos';
						return;
					}
				}elseif($campo == 'mesAnoNasc'){
					$mesNasc = substr($employee[0]['employees']['dataNasc'],5,2);
					$anoNasc = substr($employee[0]['employees']['dataNasc'],0,4);
					$tmp = explode('/',$dados[$campo]);
					if(count($tmp) != 2 or strlen($tmp[0]) != 2 or strlen($tmp[1]) != 4 or !is_numeric($tmp[0]) or !is_numeric($tmp[1])){
						$this->erro = 'Formato dos dados não são válidos';
						return;
					}
					if($tmp[0] != $mesNasc or $tmp[1] != $anoNasc){
						$this->erro = 'Dados do colaborador informado não são válidos';
						return;
					}
					
				}
			}
			$funcionario['matricula'] = $dados['matricula'];
			$funcionario['nome'] = $employee[0]['employees']['nome'];
			$blocos = $this->Session->read('pesquisa_blocos');
			$pesquisa = $this->Session->read('pesquisa');
			$pesquisa = $pesquisa[0]['question_reasons'];
			$employee_reason = $this->Response->query('SELECT * FROM employee_reasons WHERE employee_id = '.$funcionario['matricula'].' AND question_reason_id = '.$pesquisa['id'].' LIMIT 1');
			if($employee_reason){
				if($blocos == $employee_reason[0]['employee_reasons']['question_type_id']){
					$this->erro = 'Prezado '.$funcionario['nome'].' você já respondeu com sucesso está pesquisa, muito obrigado';
					return;
				}
			}
			$this->Session->write('employee', $funcionario);
			$this->erro = null;
			return;
		}
		
		public function validaCPF($cpf){
			$soma = 0;
			if (strlen($cpf) <> 11)
				return 'CPF informado não é válido';
			for ($i = 0; $i < 9; $i++) {         
				$soma += (($i+1) * $cpf[$i]);
			}
			$d1 = ($soma % 11);
			if ($d1 == 10) {
				$d1 = 0;
			}
			$soma = 0;
			for ($i = 9, $j = 0; $i > 0; $i--, $j++) {
				$soma += ($i * $cpf[$j]);
			}
			$d2 = ($soma % 11);
			if ($d2 == 10) {
				$d2 = 0;
			}      
			if ($d1 == $cpf[9] && $d2 == $cpf[10]) {
				return false;
			}
			else {
				return 'CPF informado não é válido';
			}
		}

	}




?>