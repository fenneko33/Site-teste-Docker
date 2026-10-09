<?php
// Credenciais configuradas no docker-compose.yml
$servidor = "db"; 
$usuario = "[usuario]";
$senha = "[senha]";
$banco = "[nome do banco]";

// Cria a conexão com o banco
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Captura os dados enviados pelo formulário
$nome_deck = $_POST['nome_deck'] ?? '';
$formato = $_POST['formato'] ?? '';
$estrategia = $_POST['estrategia'] ?? '';
$carta_principal = $_POST['carta_principal'] ?? '';

// Transforma o array de cores recebido dos checkboxes em uma string separada por vírgula
$cores_array = $_POST['cores'] ?? [];
$cores = implode(", ", $cores_array);

// Prepara a query de inserção
$sql = "INSERT INTO decks (nome_deck, formato, cores, estrategia, carta_principal) 
        VALUES ('$nome_deck', '$formato', '$cores', '$estrategia', '$carta_principal')";

// Executa e valida
if ($conexao->query($sql) === TRUE) {
    echo "<h2>Deck registrado com sucesso na sua coleção!</h2>";
    echo "<br><a href='index_2.html'>Voltar ao registro</a>";
} else {
    echo "Erro ao registrar o deck: " . $conexao->error;
}

$conexao->close();
?>
