<?php
include_once 'conexao.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'editar' ) {
    
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    $conexaoComBanco = abrirBanco();

    $sql = "Select * From vales WHERE id = ?";
    $pegarDados =  $conexaoComBanco->prepare($sql);
    //substituir o ?????
    $pegarDados->bind_param("i", $id);
    //executar o SQL que preparemos
    $pegarDados->execute();
    $result = $pegarDados->get_result();

    if($result->num_rows == 1){
        $registro = $result->fetch_assoc();
        // dd($registro);
    } else {
        echo "Nenhum regisro encotrado";
        exit;
    }
    $pegarDados->close();
    fecharBanco( $conexaoComBanco);
}

if ($_SERVER ['REQUEST_METHOD'] == "POST")  {
    $descricao = $_POST['descricao'];
    $data_do_vale = $_POST['data_do_vale'];
    $valor = $_POST['valor'];

}


$conexaoComBanco = abrirBanco();

$sql = "UPDATE vales SET descricao = '$descricao', data_do_vale = '$data_do_vale', valor = '$valor'";
          

        if ($conexaoComBanco->query($sql) === TRUE ) {
            echo " Sucesso ao cadastrar o contado ";
            header('location:index.php');
        } else {
            echo " Erro ao cadastrar o contado ";
            
        }
        fecharBanco($conexaoComBanco); 
        

        

?>