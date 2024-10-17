<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Crud</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Lista de clientes</h2>
        <a class="btn btn-primary" href="/projetocrud/create.php" role="button"> Novo Cliente </a>
        <br>
        <table class="table">
            <thead>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Criado em</th>
                <th>Ação</th>
            </thead>
            <tbody>

                <?php
                $servername="localhost";
                $username="root";
                $password="";
                $database="proj_crud";

                //Criar Conexão 
                $connection = new mysqli($servername, $username, $password, $database);

                // Verificar Conexão
                if($connection -> connect_error){
                    die("Falha na conexão: " . $connection -> connect_error);
                }

                // Lê todas as linhas da tabela do banco de dados
                $sql = "SELECT * FROM clients";
                $result = $connection->query($sql);

                if(!$result){
                    die("Query inválida" . $connection->error);
                }

                // Lê os dados de cada linha
                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class= 'btn btn-primary btn-sm' href='/projetocrud/edit.php?id=$row[id]'>Editar</a>
                            <a class= 'btn btn-danger btn-sm' href='/projetocrud/delete.php?id=$row[id]'>Deletar</a>
                        </td>
                    </tr>
                    ";
                }

                ?>
                
    
            </tbody>
        </table>
    </div>
</body>
</html>