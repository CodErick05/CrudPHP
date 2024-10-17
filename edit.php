<?php
$servername="localhost";
$username="root";
$password="";
$database="proj_crud";

//Criar Conexão 
$connection = new mysqli($servername, $username, $password, $database);

$name="";
$email="";
$phone="";
$address="";
    
$errorMessage="";
$sucessMessage="";

if($_SERVER['REQUEST_METHOD']== 'GET'){
    //metodo GET : Mostra os dados do cliente

    if(!isset($_GET["id"])){
        header("location: /projetocrud/index.php");
        exit;
    }

    $id = $_GET["id"];

    // Lê a linha do cliente selecionado da tabela do banco de dados
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection ->query($sql);
    $row = $result -> fetch_assoc();

    if(!$row){
        header("location: /projetocrud/index.php");
        exit;
    }
    
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
}
else{
    //metodo POST : Atualiza os dados do cliente

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    
    //Verifica campos vazios
    do{
        if(empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage= "Todos os campos devem ser preenchidos";
            break;
        }
        
        // Código SQL que atualiza a tabela
        $sql = "UPDATE clients" . 
            " SET name='$name', email='$email', phone='$phone', address='$address'".
            " WHERE id=$id";


        $result= $connection->query($sql);

        if(!$result){
            $errorMessage = "Query Inválida". $connection->error;
            break;
        }

        $sucessMessage="Cliente atualizado com sucesso";

        header("location: /projetocrud/index.php");
        exit;
}while(false);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Crud</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Novo Cliente</h2>
            <?php
            if(!empty($errorMessage)){
                echo "
                 <div class='alert alert warning alert-dimissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dimiss ='alert' aria-label ='Close'></button>
                 </div>
                ";
            }
            
            ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> Nome</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>   
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Endereço</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>

                <?php
                    if(!empty($sucessMessage)){
                        echo"
                        <div class='alert alert warning alert-dimissible fade show' role='alert'>
                    <strong>$sucessMessage</strong>
                    <button type='button' class='btn-close' data-bs-dimiss ='alert' aria-label ='Close'></button>
                 </div>
                 ";
                    }
                
                ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary">Salvar</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/projetocrud/index.php" role="button">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>