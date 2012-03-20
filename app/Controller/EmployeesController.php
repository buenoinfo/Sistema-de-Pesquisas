<?php
	class EmployeesController extends AppController {
		public $name = 'Employees';
		public $helpers = array('Html', 'Form');
		
		public function admin_index() {
		
		
		}
		
		public function pendente() {
			$pesquisa = $this->Employee->query('SELECT * FROM question_reasons WHERE status = 1 LIMIT 1');
			$this->Session->write('pesquisa', $pesquisa[0]['question_reasons']);
			$blocos = $this->Employee->query('SELECT COUNT(id) as total FROM question_types WHERE question_reason_id = '.$pesquisa[0]['question_reasons']['id'].'');
			$blocos =  $blocos[0][0]['total'];
			$this->Session->write('blocos', $blocos);
			$this->set('employees', $this->Employee->EmployeeReason->find('all'));
		}

		public function admin_importar() {
			if($this->request->is('post')) {
				if($this->request->data['Employee']['arquivo']['error'] != 0){
					$this->Session->setFlash("Necessário informar um arquivo!"); 
				}elseif($this->request->data['Employee']['arquivo']['type'] != 'text/plain'){
					$this->Session->setFlash("O arquivo deve estar no formato .txt");
				}else{
					$name = $this->request->data['Employee']['arquivo']['name'];
					if (file_exists('files/'.$name)){
						unlink('files/'.$name);
					}
					if(!move_uploaded_file($this->request->data['Employee']['arquivo']['tmp_name'], 'files/'.$name)){
						$this->Session->setFlash("Falha ao realizar o upload do arquivo!");
					}else{
						$this->Employee->query('TRUNCATE TABLE employees');
						$dados = fopen('files/'.$name, "r");
						while(!feof($dados)) { 
							$func = explode(';',fgets($dados));
							$employees['Employee']['id'] = $func[0];
							$employees['Employee']['nome'] = $func[1];
							$employees['Employee']['cpf'] = $func[2];
							$employees['Employee']['sitAfa'] = $func[4];
							$employees['Employee']['dataNasc'] = $func[3];
							$this->Employee->create();
							$this->Employee->save($employees);
						}
						$this->Session->setFlash("Funcionários importados/atualizados com sucesso!");
						$this->redirect('index');
					}
				}
			}
		}
		
	}
?>