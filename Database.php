<?php

Class Database
{
	private $_host, $_database, $_user, $_password;

	function Database()
	{
		$this->_host = "127.0.0.1";
		$this->_database = "emotion_test";
		$this->_user = "root";
		$this->_password = "";
	}

	private function _connect()
	{
		return new PDO("mysql:host={$this->_host};dbname={$this->_database}", $this->_user, $this->_password);
	}

	public function insertAluno($data)
	{
		//Variavel recebe query para inserção na tabela aluno do BD
		$sql = "INSERT INTO aluno (id, cpf, nome, sexo, dt_nascimento) VALUES (null, '{$data['cpf']}', '{$data['nome']}', '{$data['sexo']}', DATE('{$data['data_nascimento']}'))";
	
		try 
		{
			$conn = $this->_connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$conn = null;
		}
		catch (Exception $ex)
		{
			echo($ex->getMessage()); 
			exit();
		}

	}
	//Função para inserir os telefones na tabela telefone do BD
	public function insertTelefone($id_aluno, $numero, $flag_principal = false)
	{
		//Variável recebe query para inserção na tabela telefone do BD
		$sql = "INSERT INTO telefone (id, id_aluno, numero, flag_principal) VALUES (null, '{$id_aluno}', '{$numero}', '{$flag_principal}')";
	
		try 
		{
			$conn = $this->_connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$conn = null;
		}
		catch (Exception $ex)
		{
			echo($ex->getMessage()); 
			exit();
		}

	}

	//Função para validar se os CPFs do arquivo telefones.csv são os mesmos da tabela aluno no BD 
	public function buscaCPF($cpf)
	{

			//Variável recebe query para selecionar o id correspondente ao CPF pesquisado
			$sql = "SELECT id FROM aluno WHERE cpf = '{$cpf}'";

			try
			{
				$conn = $this->_connect();
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$conn = null;
				//Variável que recebe o id selecionado no BD para retorno da função
				$aluno = $stmt->fetchAll();
				
				if(isset($aluno[0]['id']))
				{
					return (int)$aluno[0]['id'];
				}
				return false;
			}
			catch (Exception $ex)
			{
				echo($ex->getMessage()); 
				exit();
			}
	}
}