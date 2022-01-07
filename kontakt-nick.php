<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktformular | Zunft zur Letzi</title>

    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/footer.css">

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/header.js" defer></script>
</head>
<body>
    <header>
        <div id="header-placeholder"></div>
        <script>
            $.get("header.html", function(data){
                $("#header-placeholder").replaceWith(data);
            });
        </script>
    </header>
    <main>
    <div class="formular">
      <?php
      //Versendetnachrict ausblenden
      echo "<style>.versendet { display:none; }</style>";
      //Initialisierung der Variabeln
      $name = $vorname = $email = $nachricht = $ausgabe = "";
      $nameErr = $vornameErr = $emailErr = $nachrichtErr = "";
      
      $titel = "Kontaktformular";
      //Wenn senden gedrückt wurde
      if (isset($_POST['senden'])) {
        //Name überprüfung
        if (empty($_POST["name"])) {
          $nameErr = "Bitte geben sie einen Name ein.";
        } else {
          $name = test_input($_POST["name"]);
          //Auf RegEx kontrolieren
          if (!preg_match("/^[a-zA-Z-' ]{2,}$/", $name)) {
            $nameErr = "Es sind nur Buchstaben erlaubt.";
          }
        }
        //Vorname überprüfung
        if (empty($_POST["vorname"])) {
          $vornameErr = "Bitte geben sie einen Vornamen ein.";
        } else {
          $vorname = test_input($_POST["vorname"]);
          //Auf RegEx kontrolieren
          if (!preg_match("/^[a-zA-Z-' ]{2,}$/", $vorname)) {
            $vornameErr = "Nur Buchstaben sind erlaubt.";
          }
        }
        //Nachrichtenfeld überprüfung
        if (empty($_POST["nachricht"])) {
          $nachrichtErr = "Bitte geben sie eine Nachricht ein.";
        } else {
          $nachricht = test_input($_POST["nachricht"]);
        }
        //Email überprüfung
        if (empty($_POST["email"])) {
          $emailErr = "Bitte geben sie eine verfügbare Email ein.";
        } else {
          $email = test_input($_POST["email"]);
          //Auf RegEx kontrolieren
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Geben sie eine formal gerechte Email ein.";
          }
        }

      }
      //Testet auf Cross Scripting
      function test_input($data)
      {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
       //Bestellung ausgeben
       if ($nameErr === '' && $vornameErr === '' && $emailErr === '' && $nachrichtErr === '' && isset($_POST['senden'])) {
        $ausgabe = "Name: $name \n Vorname: $vorname \n Email: $email \n Nachricht: $nachricht";
      }
      //Änderung der Hintergrundfarbe nach Auswahl des Users

      ?>
      <div id="Mail">
        <?php echo "<h1>$titel</h1>"; ?>
        <p style="font-size: 12px; font-weight: bold;">*Pflichtfelder</p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8">
          <!-- Erstellt die Einzelnen Eingaben -->
          <label>Name * <span class="error"><?php echo $nameErr; ?></span><br>
            <input  type="text" id="name"  name="name" value="<?php echo $name ?>" placeholder="" s>
          </label><br><br><br>
          <label>Vorname * <span class="error"><?php echo $vornameErr; ?></span><br>
            <input type="text" id="vorname" name="vorname" value="<?php echo $vorname ?>" placeholder="">
          </label><br><br><br>
          <label>Email * <span class="error"><?php echo $emailErr; ?></span><br>
            <input type="email" id="email" name="email" value="<?php echo $email ?>" placeholder="">
          </label><br><br><br>
          <label>Nachricht * <span class="error"><?php echo $nachrichtErr; ?></span>
            <textarea name="nachricht" id="nachricht" cols="50" rows="6" value="<?php echo $nachricht ?>"></textarea>
          </label>
          <br><br>
          <!--Absenden-->
          <div style="display: flex; flex-direction: row; align-items: center;">
            <input id="submit" type="submit" name="senden" value="senden">
            <div class="versendet" style="font-size: 20px; margin-left: 10px;"><p>Die Nachricht wurde versendet</p></div>
            <br><br>
           </div>
        </form>
      </div>
    </div>
    <div class="bestellung">
      <?php
      if ($nameErr === '' && $vornameErr === '' && $emailErr === '' && $nachrichtErr === '' && isset($_POST['senden']) && !empty($_POST['name']) && !empty($_POST['vorname']) && !empty($_POST['email']) && !empty($_POST['nachricht'])) {
          echo "<style>.versendet { display:block; }</style>"; //Versendet anzeigen
          mail('nick.c@menisch.ch', 'Kontakt', $ausgabe, "From: $email");
          $name = "";
          $vorname = "";
          $nachricht = "";
          $email = "";
          $name = $_POST['name'];
          $vorname = $_POST['vorname'];
          $email = $_POST['email'];
          $nachricht = $_POST['nachricht'];
      }
      ?>
    </div>
    </main>
    <footer>
        <div id="footer-placeholder"></div>
        <script>
            $.get("footer.html", function(data){
                $("#footer-placeholder").replaceWith(data);
            });
        </script>
    </footer>
</body>
</html>