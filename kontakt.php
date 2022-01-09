<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktformular | Zunft zur Letzi</title>

    <link rel="stylesheet" href="styles/header2.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/kontakt.css">
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
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur natus quod dolores sapiente ea quis delectus minus, corrupti doloribus quibusdam possimus nihil fugiat architecto nulla obcaecati inventore nobis rem officia!
            Ea ut tempora illum unde nesciunt facilis inventore voluptatum atque doloremque eos dolore sit, aliquam adipisci eum doloribus corrupti perspiciatis vitae commodi placeat temporibus eaque iste nam! Reiciendis, ea odit?
            Mollitia repellat vero, et ratione molestiae, minima fugiat est modi, quisquam doloribus voluptatum in veritatis consequatur. Quos deleniti explicabo commodi delectus impedit ea optio quia magni ab laboriosam. Ex, illum.
            Accusantium in praesentium saepe, maxime vero hic sapiente nemo nostrum labore voluptate odio dignissimos, nulla facere? Eaque libero aliquam et, itaque veniam nihil consequatur, esse culpa modi sequi neque saepe?
            Nulla doloribus numquam minima. At, commodi pariatur! Incidunt ad quo saepe quod earum dignissimos numquam accusamus rerum quis, aliquid modi reprehenderit sint natus amet! Distinctio, natus commodi? Exercitationem, assumenda harum.
        </p>
        <?php
        $name = $vorname = $mail = $betreff = $nachricht = $ausgabe = '';
        $nameFehler = $vornameFehler = $mailFehler = $betreffFehler = '';
        $regexBuchstaben = "/[a-zA-Z',.-]{2,30}$/i";
        $zielMail = 'nick_forster@icloud.com';

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if (isset($_POST['senden'])){
            if (empty($_POST['name'])) {
                $nameFehler = 'Bitte geben Sie einen Namen ein';
            } else {
                $name = test_input($_POST['name']);
                if (!preg_match($regexBuchstaben, $name)) {
                    $nameErr = "Es sind nur Buchstaben erlaubt";
                } else {
                    $nameFehler = '';
                }
            }
            if (empty($_POST['vorname'])) {
                $vornameFehler = 'Bitte geben Sie einen Vornamen ein';
            } else {
                $vorname = test_input($_POST['vorname']);
                if (!preg_match($regexBuchstaben, $vorname)) {
                    $vornameFehler = "Es sind nur Buchstaben erlaubt";
                } else {
                    $vornameFehler = '';
                }
            }
            if (empty($_POST['mail'])) {
                $mailFehler = 'Bitte geben Sie ein Email-Adresse ein';
            } else {
                $mail = test_input($_POST['mail']);
                if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $mailFehler = "Bitte geben Sie eine Formal korrekte Email-Adresse ein";
                } else {
                    $mailFehler = '';
                }
            }
            if (empty($_POST['betreff'])) {
                $betreffFehler = 'Bitte geben Sie einen Betreff ein';
            } else {
                $betreff = test_input($_POST['betreff']);
                if (!preg_match($regexBuchstaben, $betreff)) {
                    $betreffFehler = "Es sind nur Buchstaben erlaubt";
                } else {
                    $betreffFehler = '';
                }
            }
            $nachricht = $_POST['nachricht'];
        }

        if (isset($_POST['senden']) && $nameFehler === '' && $vornameFehler === '' && $mailFehler === '' && $betreffFehler == '') {
            if ($nachricht === '') {
                $nachricht = 'Keine';
            }
            $ausgabe = "Name: $name <br>Vorname: $vorname <br>Email: $mail <br>Nachricht: $nachricht";
            mail($zielMail, $betreff, $ausgabe, "From: $mail");
            $name = $vorname = $mail = $betreff = $nachricht = '';
            $nameFehler = $vornameFehler = $mailFehler = $betreffFehler = '';
            echo "<style>.ausgabebestaetigung {display: block !important;} .kontaktformular {display: none;}</style>";
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8" class="kontaktformular">
                <div>
                    <label for="name">Name * <span><?php echo $nameFehler ?></span><br></label>
                    <input type="text" id="name" name="name" value="<?php echo $name?>">
                </div>
                <div>
                    <label for="vorname">Vorname * <span><?php echo $vornameFehler ?></span><br></label>
                    <input type="text" id="vorname" name="vorname" value="<?php echo $vorname?>">
                </div>
                <div>
                    <label for="mail">E-Mail-Adresse * <span><?php echo $mailFehler ?></span><br></label>
                    <input type="mail" id="mail" name="mail" value="<?php echo $mail?>">
                </div>
                <div>
                    <label for="betreff">Betreff * <span><?php echo $betreffFehler ?></span><br></label>
                    <input type="text" id="betreff" name="betreff" value="<?php echo $betreff?>"><br>
                </div>
                <div>
                    <label for="nachricht">Inhalt der Nachricht<br></label>
                    <textarea name="nachricht" id="nachricht" cols="30" rows="10"><?php echo $nachricht?></textarea>
                </div>
                <input type="submit" id="senden" name="senden" value="Senden">
                <p>Pflichtfelder sind mit einem * markiert</p>
        </form>
        <div class="ausgabebestaetigung">
            <?php
                echo "Ihre Nachricht wurde Abgesendet, wir werden Sie in kürze kontaktieren <br>$ausgabe";
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