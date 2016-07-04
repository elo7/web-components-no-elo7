<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit-on-change</title>
  <style>
label {
  display: inline-block;
  padding: 1em;
  background-color: #fdb933;
  color: #fff;
  cursor: pointer;
  border-radius: 5px;
}
label:hover {
  background-color: #e8d287;
}
  </style>
  <script>
// TODO
  </script>
</head>
<body>
  <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h1>Arquivo recebido!</h1>";
    echo "<p>Arquivo " . $_FILES[arquivo][name] . " com " . $_FILES[arquivo][size] . " bytes</p>";
  } ?>
  <form action="" method="post" enctype="multipart/form-data" is="submit-on-change">
    <input type="file" name="arquivo" id="file-picker">
    <label for="file-picker">
      Escolha um arquivo para enviar
    </label>
    <input type="submit">
  </form>
</body>
</html>