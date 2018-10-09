<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="fix.css">

<title>|| Tugas 5 ||</title>
</head>
<body>  

<?php

  $nameErr = $emailErr = $addressErr = "";
  $name = $email = $address = " ";
  $alrt= $Err= "";
  $cek = 0 ;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Nama GAN NAMA!!!";
      $Err= "1";
    } else {
      $name = test_input($_POST["name"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Cuma bisa Alfabet dan space gan";
        $Err= "1";
      }
    }
    
    if (empty($_POST["email"])) {
      $emailErr = "Email GAN EMAIL!!!";
      $Err= "1";
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Yang bener gan emailnya";
        $Err= "1";
      }
    }

    if (empty($_POST["address"])) {
      $nameErr = "Alamat GAN ALAMAT!!!";
      $Err= "1";
    } else {
      $address = test_input($_POST["address"]);
      }
    }

  function test_input($data) {  
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  //-----------------------------------------------------------

  

if(  $name != " " && $email != " " && $address != " " && $Err != "1" )
{


      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "myDB";


      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      // if (!$conn) {
      //     die("Connection failed: " . mysqli_connect_error());
      // }
      


        $sql = "CREATE DATABASE IF NOT EXISTS myDB";
        // if (mysqli_query($conn, $sql)) {
        //     echo "Database created successfully";
        // } else {
        //     echo "Error creating database: " . mysqli_error($conn);
        // }

        $sql = "CREATE TABLE IF NOT EXISTS data_pekerja (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        nama VARCHAR(30) NOT NULL,
        email VARCHAR(30),
        alamat VARCHAR(30)
        )";
        // if ($conn->query($sql) === TRUE) {
        //     echo "Table created successfully";
        // } else {
        //     echo "Error creating table: " . $conn->error;
        // }

      
      $sql = "INSERT INTO data_pekerja (nama, email, alamat)
      VALUES ( '$name' , '$email' , '$address' )";

      if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }

$sql = "SELECT nama, email, alamat FROM data_pekerja";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo "<br><br>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Nama: " . $row["nama"]. " - Email: " . $row["email"]. " - Alamat: " . $row["alamat"]. "<br>";
    }
} else {
    echo "0 results";
}

$sql = "UPDATE data_pekerja SET alamat='Jl. Kota' WHERE id=2";
$sql = "UPDATE data_pekerja SET alamat='Jl. Desa' WHERE id=5";
$sql = "DELETE FROM data_pekerja WHERE id=3";
$sql = "DELETE FROM data_pekerja WHERE id=6";

      mysqli_close($conn);
    }
?>

<div class="header">
  <h2>Address Book MYM Corp</h2>
</div>
<div>
  <div>
      <div class="form0">
      Name<br><br>
      E-mail<br><br>
      Address<br>
      </div>
      <div class="form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          : <input type="text" name="name" value="<?php echo $name;?>">
          <span class="error">* <?php echo $nameErr;?></span>
          <br><br>
          : <input type="text" name="email" value="<?php echo $email;?>">
          <span class="error">* <?php echo $emailErr;?></span>
          <br><br>
          : <input type="text" name="address" value="<?php echo $address;?>">
          <span class="error">* <?php echo $addressErr;?></span>
          <br><br>
          <div class="sbutton">
            <br>
            <input id="sub" type="submit" name="submit" value="Submit">
            <br><br>
          </div>
        </form>
      </div>
    </div>
</div>


</body>
</html>