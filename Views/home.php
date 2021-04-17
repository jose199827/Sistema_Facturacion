<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo ($data['page_tag']); ?>
  </title>
</head>
Jose
<?php
if (function_exists('mail')) {
  echo "La función mail -SI- esta activada";
} else {
  echo "La función mail -NO- esta activada";
}
?>

<body>

</body>

</html>