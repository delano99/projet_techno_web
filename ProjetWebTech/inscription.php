<?php
    include('connexion.php');

    $user = 'root';
    $pass = '';
  
    try{
      $db = new PDO ('mysql:host=localhost;dbname=projettechweb', $user, $pass);
    }
    catch (PDOException $e) {
      print "Erreur :". $e->getMessage() . "<br/>";
      die;
    }

    if(isset($_POST['forInscription']))
    {
        $nom= htmlspecialchars($_POST['nom']);
        $prenom= htmlspecialchars($_POST['prenom']);
        $mail= htmlspecialchars($_POST['email']);
        $passWord= sha1($_POST['passWord']);            $RpassWord= sha1($_POST['RpassWord']);
        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['passWord']) AND !empty($_POST['RpassWord']))
        {
            echo "ok";

            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
                if($passWord == $RpassWord)
                {
                    $insert = $db->prepare("INSERT INTO users(nom, prenom, e_mail, passWord) VALUES(?,?,?,?) ");
                    $insert->execute(array($nom, $prenom, $mail, $passWord));
                    $erreur = "compte créer";
                }
                else
                {
                    $erreur="vos pass word sont different verifier vos entrer";
                }
            }
            else
            {
                $erreur = "le mail entrer est incorrecte";
            }
        }
        else
        {
            $erreur="tt les champs doivent etre controler";
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>test</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/typicons.min.css">
    <link rel="stylesheet" href="assets/css/CDRFormularioIngresoSocio.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body>
    <div class="row register-form">
        <div class="col-md-8 offset-md-2">
            <form class="custom-form" method="POST">
                <h1>Register Form</h1>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Nom </label></div>
                    <div class="col-sm-6 input-column"><input class="form-control" type="text" name ="nom" id="nom" value="<?php if(isset($nom)) { echo $nom; }?>"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Prenom </label></div>
                    <div class="col-sm-6 input-column"><input class="form-control" type="text" name="prenom" id="prenom" value="<?php if(isset($prenom)) { echo $prenom; }?>"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Email </label></div>
                    <div class="col-sm-6 input-column"><input class="form-control" type="email" name = "email" id="email" value="<?php if(isset($mail)) { echo $mail; }?>"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="pawssword-input-field">Password </label></div>
                    <div class="col-sm-6 input-column"><input class="form-control" type="text" name="passWord" id="passWord" value="<?php if(isset($passWord)) { echo $passWord; }?>"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="repeat-pawssword-input-field">Repeat Password </label></div>
                    <div class="col-sm-6 input-column"><input class="form-control" type="text" name="RpassWord" id="RpassWord"></div>
                </div>
                <input class="btn btn-light submit-button" type="submit" value="Inscription" name="forInscription"></form>
             <?php
             if(isset($erreur))
             {
                 echo '<font color="red">'.$erreur.'</font';
             }
             ?>   
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/current-day.js"></script>
</body>

</html>