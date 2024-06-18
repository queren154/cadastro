<?php
include 'conexao.php';
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
// exit;

// total inicio

//tatal fim
 if ($_SERVER ['REQUEST_METHOD'] == "POST")  {
    // capturar os dados digitado no  form e salva em variaveis
    // para  facilitat a manipulação do dados
    $descricao = $_POST['descricao'];
    $data_do_vale = $_POST['data_do_vale'];
    $valor = $_POST['valor'];



// vamos abrir a conexao com o banco de dados
$conexaoComBanco = abrirBanco();

// vamos criar o sql para realizar o insert do dados no BD
$sql = "INSERT INTO vales
        (descricao, data_do_vale, valor)
        VALUES
        ('$descricao',  '$data_do_vale',  '$valor' )";

        if ($conexaoComBanco->query($sql) === TRUE ) {
            echo ":) Sucesso ao cadastrar o contado :)";
            header("location:index.php");
        } else {
            echo ":( Erro ao cadastrar o contado :(";
        }
        fecharBanco($conexaoComBanco);
    }

    
    //excluir


    if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {

        $id = $_GET ['id'];
        if ($id > 0){
            //abrir a conexão com o banco
            $conexaoComBanco = abrirBanco();
            //preparar um SQL de exclusão
            $sql ="DELETE FROM vales where id = $id";
            //executar comando no banco
            if ($conexaoComBanco->query($sql) === TRUE) {
                echo "<script>alert ('contato excluido com sucesso')</script>";
                header("location:index.php");
            }else{
             echo "contato excluido com sucesso! :(";   
            }
    
        }
        fecharBanco($conexaoComBanco);
    }

    //fim excluir



 ?>


   
   
   
   <!-- <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="php.css">
    <title>vales</title>
</head>
<body>
    <h1> GERENCIAR VALES </h1>
    <hr>
    <h2>cadastrar vales</h2>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cadastrar.php">cadastrar</a></li>
       </ul>

       


    </nav>
    </header> -->
    <div class="container">
    <section>
        <h2 class="titulo">Cadastrar contatos</h2>
        <form class="form" method="post" enctype="multipart/form-data">
            <label class="label" for="descricao">Descrição:</label>
            <input class="input" type="text"id ="descricao" name="descricao" placeholder="Descrição" required> <br><br>

            <label class="label" for="data_do_vale">Data de Vale:</label>
            <input class="input" type="date"id ="data_do_vale" name="data_do_vale" placeholder="Data Do Vale" required> <br><br>
        
            <label class="label" for="valor">Valor:</label>
            <input class="input" type="text"id ="valor" name="valor" placeholder="Valor"required> <br><br>
            
            <button class="btn" type="submit">Cadastrar</button>
               
        </form>
    </section>
    </div>
</body>
</html>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="php.css">
</head>
<body>
    <div class="container">
   
    <h1 class="titulo">Agenda de contatos</h1>
    <section>
        <h2>Lista de contados</h2>
        <div class="container_table">
        <table border="1" class="table-listar">
            <thead>
                <tr>
                     <td>Data do cadastro </td>
                    <td> nome </td>
                    <td>Descrição</td>
                    <td>Valor</td>
                    <td>Ações</td>
                </tr>
                
            </thead>
            <tbody>
            <?php 
            //abrir conexao com o banco de dados 
            $conexaoComBanco = abrirBanco();
            //preparar a consulta SQL para selecionar os dados do BD
            $query = "SELECT id, descricao, data_do_vale, valor, atualizado_em from vales";
            //Executar a query (o sql no banco)
            $result =  $conexaoComBanco ->query($query);
            // $registros = $result->fetch_assoc();
            //verificar se a query retornar registro 
             if ($result->num_rows > 0) {
            //     //tem registro no banco 
            while ($registro = $result->fetch_assoc()) {
               ?>
              
                <tr>
                    <td><?= date("d/m/Y", strtotime ($registro ['data_do_vale'] )) ?></td>
                    <td><?= date("d/m/Y", strtotime ($registro ['atualizado_em'])) ?></td>
                <td><?= $registro['descricao'] ?></td>
                <td><?= $registro['valor'] ?></td>
                <td> 
                    <a href="editar.php?acao=editar&id=<?= $registro['id']?>"><button class="btn-editar">Editar</button></a>
                    <a href="?acao=excluir&id=<?= $registro['id']?>"
                    onclick="return confirm ('tem certeza que deseja excluir?');"><button class="btn-excluir">Excluir</button></a>
                   
            
                </td>
                </tr>
                </div>
                </div>
            
               <?php
            }
             } else {
            //     //nao tem registo no banco 
            // 
            }             
            //criar um laço de repetição para prencher linha por tabela
            ?>
            </tbody>
        </table>

        <p> TOTAL DOS VALES: <?php echo number_format($total_valor, ',','.');?></p>
        

    </section>
</body>
</html>