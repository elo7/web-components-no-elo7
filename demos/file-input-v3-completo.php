<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit-on-change</title>
  <template id="label-content">
⇡ Upload
  </template>
  <template id="submittable-file">
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
label input {
  display: none;
}
    </style>
    <form>
      <label>
        <input type="file">
      </label>
    </form>
  </template>
  <script>
var proto = Object.create(HTMLElement.prototype);

proto.attachedCallback = function() {
  var submittable = this;
  var rootContent = document.getElementById('submittable-file').content.cloneNode(true);
  var input = rootContent.querySelector('input');
  var label = rootContent.querySelector('label');
  var form = rootContent.querySelector('form');
  var root = submittable.createShadowRoot();
  var labelContentId = submittable.getAttribute('template');
  var labelContent = document.getElementById(labelContentId).content.cloneNode(true);
  root.appendChild(rootContent);
  label.appendChild(labelContent);
  input.name = submittable.getAttribute('name');
  input.addEventListener('change', function() {
    form.submit();
  });
  form.method = 'POST';
  form.enctype = 'multipart/form-data';
  form.action = submittable.getAttribute('action');
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
  <submittable-file action="" name="arquivo" template="label-content">
    Você precisa de JS para poder usar esse componente
  </submittable-file>
</body>
</html>