<?php

$usernameError = $passwordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
  $password = test_input($_POST["password"]);

  if (empty($username)) {
    $usernameError = "Username tidak boleh kosong";
  } else if (strlen($username) > 7) {
    $usernameError = "Username yang dinputkan tidak boleh lebih dari tujuh karakter";
  }

  if (empty($password)) {
    $passwordError = "Password tidak boleh kosong";
  } else  if (!preg_match("/[A-Z]/", $password)) {
    $passwordError = "Password harus mengandung huruf kapital";
  } else  if (!preg_match("/[a-z]/", $password)) {
    $passwordError = "Password harus mengandung huruf kecil";
  } else  if (!preg_match("/[0-9]/", $password)) {
    $passwordError = "Password harus mengandung angka";
  } else  if (!preg_match("/[^a-zA-Z\d]/", $password)) {
    $passwordError = "Password harus mengandung karakter khusus";
  } else  if (strlen($password) < 10) {
    $passwordError = "Jumlah karakter password tidak boleh kurang dari sepuluh karakter.";
  }

  if (empty($usernameError) && empty($passwordError)) {

    echo "Halo, $username <br>";
    echo "Password yang anda masukkan adalah $password";
    echo "<br>";
    echo "<a href='index.php'>Logout</a>";

    exit;
  }
}


function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modul 2</title>
</head>
<style>
  form {
    display: flex;
    flex-direction: column;
    max-width: 300px;
    margin: 0 auto;
    justify-content: center;
    background-color: #f1f1f1;
    padding: 20px;
    border-radius: 10px;
    gap: 10px;
  }

  .form-control label::before {
    content: "*";
    color: red;
    margin-right: 5px;
  }

  .form-control {
    display: flex;
    flex-direction: column;
    gap: 3px;
  }


  button {
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background-color: #45a049;

  }

  button:active {
    background-color: #3e8e41;
  }

  input {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  input:focus {
    border: 1px solid #4CAF50;
  }

  .form-control-error {
    color: red;
  }
</style>

<body>
  <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
    <div class="form-control">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Username">
      <span class="form-control-error">
        <?= $usernameError; ?>
      </span>
    </div>
    <div class="form-control">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Password">
      <span class="form-control-error">
        <?= $passwordError; ?>
      </span>
    </div>
    <button type="submit">Login</button>
  </form>
</body>

</html>