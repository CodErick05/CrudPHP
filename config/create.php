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

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $name= $_POST ["name"];
        $email= $_POST ["email"];
        $phone= $_POST ["phone"];
        $address= $_POST ["address"];

        do{
            if(empty($name) || empty($email) || empty($phone) || empty($address)){
                $errorMessage= "Todos os campos devem ser preenchidos";
                break;
            }

            // Adiciona um novo cliente no banco de dados
            
            $sql = "INSERT INTO clients (name, email, phone, address)" . 
            "VALUES ('$name', '$email','$phone', '$address')";
            $result = $connection->query($sql);

            if(!$result){
                $errorMessage= "Query inválida". $connection->error;
                break;
            }

            $name="";
            $email="";
            $phone="";
            $address="";

            $sucessMessage="Cliente adicionado corretamente";
            
            header("location: /projetocrud/index.php");
            exit;
        }while (false);
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