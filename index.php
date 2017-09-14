<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>

    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="icon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="icon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="icon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="icon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="icon/mstile-310x310.png" />

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="icon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="icon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="icon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="icon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="icon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="icon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="icon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="icon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="icon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="icon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="icon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="icon/favicon-128.png" sizes="128x128" />

    <link rel="stylesheet" href="style/grid.css" type="text/css">
    <link rel="stylesheet" href="style/framework-style.css" type="text/css">
    <link rel="stylesheet" href="style/project.css" type="text/css">

    <script src="js/main.js"></script>
    <script src="js/project.js"></script>
  </head>

<?php
  if (ISSET($_COOKIE['color'])) {
    if (ISSET($_GET['color'])) {
      if ($_GET['color'] <> $_COOKIE['color']) {
        updateColor($_GET['color']);
      }
    }
    echo '<body style="background-color: ' . $_COOKIE['color'] . ';">';

  }

  else if (ISSET($_GET['color'])) {
    setcookie('color', $_GET['color'], time() + 100);
  }
  else {
    echo "<body>";
  }

  function updateColor($color) {
    setcookie('color', $color, time() + 100);
    header("Refresh:0; url=index.php");
  }


?>


  <div class="header">
      <img src="image/logo.png">
      <h1><a href="">Template</a></h1>
      <div id="loader"></div>
  </div>
  <div class="row">
    <div class="col-12">
      <form method="post" class="center">
        <label>Lengte</label>
        <input type="text" name="personLenght">
        <br>
        <label>Gewicht in KG</label>
        <input type="text" name="personWeight">
        <br>
        <br>
        <input type="submit" name="calculateBMI" value="Berekenen">
      </form>
    </div>

<?php

  /**
   * Converts all dots to commas
   * @param  [string] $string [A string that contains . that needs to go to ,]
   * @return [string]         [The converted number]
   */
  function dotToComma($string) {
    $string = str_replace('.', ',', $string);
    return($string);
  }

  /**
   * Convert all comm's to dots
   * @param  [type] $string [description]
   * @return [float]         [The transformed number]
   */
  function commaToDot($string) {
    $string = str_replace(',', '.', $string);
    return(floatval($string));
  }

  function getPersonWeight() {
    return($_REQUEST['personWeight']);
  }
  function getPersonLenght() {
    return($_REQUEST['personLenght']);
  }

  function calculateBMI() {
    $weight = getPersonWeight();
    $weight = commaToDot($weight);

    $lenght = getPersonLenght();
    $lenght = commaToDot($lenght);

    $bmi = $weight / ($lenght * $lenght);
    $bmi = round($bmi, 2);
    return($bmi);
  }

  function checkIfBMIIsHealty($bmi) {
    if ($bmi < 18.5) {
      return('Ongezond');
    }

    else if ($bmi > 18.6 && $bmi < 24.9) {
      return('Gezond');
    }

    else {
      return('Ongezond');
    }
  }

  if (ISSET($_POST['calculateBMI'])) {
    $bmi = calculateBMI();
    $bmiHealty = checkIfBMIIsHealty($bmi);
    $bmi = dotToComma($bmi);
    echo "<p class='col-12 center'>Uw BMI is: $bmi <br>";
    echo "Het is: $bmiHealty";
    echo '</p>';
  }



?>
</div>

<div class="row">
  <div class="col-12 center">
    <h3>Kies een kleur</h3>
    <br>
    <br>
    <a href="?color=blue">Blauw</a>       <a href="?color=red">Rood</a>
  </div>
</div>

<div class="footer">
  <h1>&copy; Peter Romijn</h1>
</div>

</body>
</html>
