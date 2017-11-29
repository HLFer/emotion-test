<?php 

include "Database.php";

//variáveis para receber os arquivos .csv localizados na raiz do projeto
$arquivo_alunos = "alunos.csv";
$arquivo_telefones = "telefones.csv";

//Chamada das funções para importar alunos e telefones passando os arquivos como parametro
importarAlunos($arquivo_alunos);
importarTelefones($arquivo_telefones);

//Definição da função de importação de alunos
function importarAlunos($arquivo)
{
	//Criação do Objeto Database
	$db = new Database();

	//Mapeamento do arquivo .csv e conversão para string - armazenado na varável $alunos
	$alunos = array_map('str_getcsv', file($arquivo));

	//Loop para coletar os dados dos alunos na planilha
	foreach ($alunos as $key => $aluno) {
		
		//Remoção da primeira linha da planilha
		if ($key == 0)
			continue;
		//Conversão do formato da data coletada
		$data_nascimento = DateTime::createFromFormat('d/m/y', $aluno[3]);
		
		//Variável que recebe os registros e armazena no vetor
		$data = array(
				'cpf' => $aluno[0],
				'nome' => $aluno[1],
				'sexo' => $aluno[2],//Data no formato do BD
				'data_nascimento' => $data_nascimento->format('Y-m-d'),
				
	 		);

		//Chamada da função (implementada em Database.php) para inserir os alunos no BD
		$db->insertAluno($data);
	}
	
}

//Definição da função de importação de telefones
function importarTelefones($arquivo)
{
	//Criação do Objeto Database
	$db = new Database();

	//Mapeamento do arquivo .csv e conversão para string - armazenado na varável $telefones
	$telefones = array_map('str_getcsv', file($arquivo));

	//Loop para coletar os CPFs e Telefones na planilha
	foreach ($telefones as $key => $telefone) {
		
		//Remoção da primeira linha da planilha
		if ($key == 0)
			continue;
		
		//Variável que recebe os registros e armazena no vetor
		$data = array(
				'cpf' => $telefone[0],
				'telefone' => $telefone[1]
	 		);

		//Chamada da função (implementada em Database.php) 
		//para comparar os CPFs no BD com os CPFs do arquivo
		$id_aluno = $db->buscaCPF($data['cpf']);

		if($id_aluno){
			//Chamada da função para inserir na tabela telefone os dados de id, id_aluno(estrangeiro), numero e flag_principal
			$db->insertTelefone($id_aluno, $data['telefone']);
		}
	}
}