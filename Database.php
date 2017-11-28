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

	public function buscaCPF($cpf)
	{
		$sql = "SELECT id FROM aluno WHERE cpf = '{$cpf}'";
	
		try 
		{}
		catch (Exception $ex)
		{
			echo($ex->getMessage()); 
			exit();
		}
	}
}