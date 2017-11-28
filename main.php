<?php 

include "Database.php";



//variável para receber o nome do arquivo .csv na raiz do projeto
$arquivo_alunos = "alunos.csv";
$arquivo_telefones = "telefones.csv";

importarAlunos($arquivo_alunos);

//imprtarTelefones($arquivo_telefones);




function importarAlunos($arquivo)
{
	$db = new Database();
	$alunos = array_map('str_getcsv', file($arquivo));

	foreach ($alunos as $key => $aluno) {
		
		if ($key == 0)
			continue;
		
		$data_nascimento = DateTime::createFromFormat('d/m/y', $aluno[3]);
	
		$data = array(
				'cpf' => $aluno[0],
				'nome' => $aluno[1],
				'sexo' => $aluno[2],
				'data_nascimento' => $data_nascimento->format('Y-m-d'),
				
	 		);

		$db->insertAluno($data);

	}
	
}

function imprtarTelefones($arquivo)
{
	$db = new Database();

	//verificar se exsite cpf em aluno

	//inseir telefone
	
}