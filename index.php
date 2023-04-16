<?php

if(isset($_POST['name'])){
//  connecting Database..... 
$server="localhost";
$username="root";
$password="";

$con = mysqli_connect($server, $username, $password);

if(!$con)
{
    die("connection to this database failes due to". mysqli_connect_error());
}
echo "Success connecting to database";


$issuer = $_POST['issuer'];
$issued = $_POST['issued'];
$EID = $_POST['EID'];
$mail = $_POST['mail'];
$AID = $_POST['AID'];
$DOI = $_POST['DOI'];
$desc = $_POST['others'];
$sql = "INSERT INTO `assets` (`sno`, `issuer`, `issued`, `EID`, `mail`, `AID`, `DOI`, `others`) VALUES (NULL, $issuer, $issued, $EID, $mail, $AID, $DOI, $desc);";
if($con->query ($sql) == true)
{
// echo"Successfully submit hogaya !!";
}
else {
echo"ERROR: $sql <br> $con->error";
}   
$con->close();
}
?>

<!-- ************HTML STARTS HERE************ -->
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- Manual CSS -->
<link rel="stylesheet" href="style.css">
<link  rel="stylesheet" media="screen and (max-width:544px)" href="phone.css">

<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap" rel="stylesheet">
<title>WorkIndia Asset Allocation </title>
</head>
<body>

<!-- **********ERROR DISPLAY THROUGH PHP IN BETWEEN HTML********** -->

<?php
if (isset($_POST['issuer']))
{
if (empty($_POST["issuer"]))
{
  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Form cannot be empty </strong> Please enter the mandate details !
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
else
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Asset Allocated Success Mueen!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}}
?>
<!-- **********ERROR DISPLAY THROUGH PHP IN BETWEEN HTML ENDS HERE********** -->


<!-- Assets and headings -->
<img src="asset.jpg" alt="WorkIndia" class="back">
<div class="container">
<h1>Welcome to WorkIndia Asset Allocation!</h1>
<p> Please fill the form to Allocate the Asset</p>

<!-- ****************************************PHP FORM VALIDATION FOR EMPTY FIELDS************************************************** -->
<?php
$issuerErr = $issuedErr = $mailErr = $AIDErr = $DOIErr = $EIDErr = "";
$issuer = $issued = $mail = $AID = $DOI = $EID = "";

// Function declared here
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_POST['issuer']))  
{
  if (empty($_POST["issuer"])) {
    $issuerErr = "* Issuer is required";
  } else {
    $issuer = test_input($_POST["issuer"]);
  }
  if (empty($_POST["issued"])) {
    $issuedErr = "* Issued to is required";
  } else {
    $issued = test_input($_POST["issued"]);
  }

  if (empty($_POST["EID"])) {
    $mailrErr = "* employee code is required";
  } else {  
    $mail = test_input($_POST["EID"]);
  }

  if (empty($_POST["mail"])) {
    $mailrErr = "* E mail is required";
  } else {  
    $mail = test_input($_POST["mail"]);
  }
  if (empty($_POST["AID"])) {
    $AIDErr = " * Asset ID zaroori hai";
  } else {
    $AID = test_input($_POST["AID"]);
  }
  if (empty($_POST["DOI"])) {
    $DOIErr = " * Date bhi lagti hai";
  } else {
    $DOI = test_input($_POST["DOI"]);
  }
}
?>

<!-- CONTENT OF THE FORM SARTRS HERE -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <input type="text"  name="issuer" id="issuer" placeholder="issuer" required>
 <span class="error" > <?php echo $issuerErr; ?></span>

 <input type="text"  name="issued" id="issued" placeholder="Issued to" required>
 <span class="error" > <?php echo $issuedErr; ?></span>
    
 <input type="text" name="EID" id="EID" placeholder="Employee Code" required>
 <span class="error" > <?php echo $EIDErr ?></span>

 <input type="text" name="AID" id="AiD" placeholder="Asset ID" required>
 <span class="error" > <?php echo $EIDErr ?></span>
    
 <input type="email"  name="mail" id="mail" placeholder="Employee mail" required>
 <span class="error" > <?php echo $mailErr; ?></span>

 <input type="date"  name="DOI" id="DOI" placeholder="Date Of Allocation" required>
 <span class="error" > <?php echo $DOIErr; ?></span>

 
 <textarea name="desc" id="desc" cols="20" rows="5" placeholder="Additional Comments"></textarea>
 <button class="btn" id=submit >Allocate</button> 
 <!-- <button class="reset" type="reset" id=reset>Reset</button> -->

</form>
</div>

<!-- Script for dismissable alert -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

<!-- *********SCRIPT FOR AVOIDING FORM RESUBMISSION********* -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>