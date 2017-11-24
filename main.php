<?php 

include "Database.php";

$db = new Database();

insertAlunos('12121212121', 'Fulano', '1999-01-01', 'M');

function insertAlunos($cpf, $nome, $dtnascimento, $sexo)
{
	$db = new Database();

	$data = array(
			'cpf' => $cpf,
			'nome' => $nome, 
			'dt_nascimento' => $dtnascimento,
			'sexo' => $sexo
 		);

	$db->insertAluno($data);
}

function insertTelefones($db)
{
	$db = new Database();
}