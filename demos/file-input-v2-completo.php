<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit-on-change</title>
  <style id="submittable-file">
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
label input {
  display: none;
}
  </style>
  <script>
var proto = Object.create(HTMLElement.prototype);

proto.attachedCallback = function() {
  var submittable = this;
  var text = 'Escolha um arquivo para enviar';
  var input = document.createElement('input');
  var label = document.createElement('label');
  var form = document.createElement('form');
  var style = document.getElementById('submittable-file');
  var root = this.createShadowRoot();
  root.appendChild(style.cloneNode(true));
  input.type = 'file';
  input.name = submittable.getAttribute('name');
  label.textContent = text;
  label.appendChild(input);
  input.addEventListener('change', function() {
    form.submit();
  });
  form.method = 'POST';
  form.enctype = 'multipart/form-data';
  form.action = submittable.getAttribute('action');
  form.appendChild(label);
  root.appendChild(form);
};

document.registerElement('submittable-file', {
  prototype: proto
});
  </script>
</head>
<body>
  <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h1>Arquivo recebido!</h1>";
    echo "<p>Arquivo " . $_FILES["arquivo"]["name"] . " com " . $_FILES["arquivo"]["size"] . " bytes</p>";
  } ?>
  <submittable-file action="" name="arquivo">
    Você precisa de JS para poder usar esse componente
  </submittable-file>
</body>
</html>