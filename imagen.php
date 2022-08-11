<!DOCTYPE html>

<meta charset="utf-8">

<title>Dropzone simple example</title>


<!--
  DO NOT SIMPLY COPY THOSE LINES. Download the JS and CSS files from the
  latest release (https://github.com/enyo/dropzone/releases/latest), and
  host them yourself!
-->
<script src="js.js"></script>
<link rel="stylesheet" href="css.css">


<p>
  Este es el ejemplo más mínimo de Dropzone. La carga en este ejemplo no funciona, porque no hay un servidor real para manejar la carga del archivo.
</p>

<!-- Change /upload-target to your upload address -->
<form action="upload.php" class="dropzone dropzone-single dz-clickable" id="my-awesome-dropzone">
</form>
<p>
  Solo un div
</p>
<div url="upload.php" class="dropzone dropzone-single dz-clickable" id="my-awesome-dropzone">
</div>