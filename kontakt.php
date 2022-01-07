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
            echo "Ihre Nachricht wurde Abgesendet, wir werden Sie in kürze kontaktieren <br>$ausgabe";
            mail($zielMail, $betreff, $ausgabe, "From: $mail");
            $name = $vorname = $mail = $betreff = $nachricht = $ausgabe = '';
            $nameFehler = $vornameFehler = $mailFehler = $betreffFehler = '';
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8">
            <fieldset>
                <legend>Kontakt</legend>
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
            </fieldset>
        </form>
        <!-- <?php
            if (isset($_POST['senden']) && $nameFehler === '' && $vornameFehler === '' && $mailFehler === '' && $betreffFehler == '') {
                if ($nachricht === '') {
                    $nachricht = 'Keine';
                }
                $ausgabe = "Name: $name <br>Vorname: $vorname <br>Email: $mail <br>Nachricht: $nachricht";
                echo "Ihre Nachricht wurde Abgesendet, wir werden Sie in kürze kontaktieren <br>$ausgabe";
                mail('nick_forster@icloud.com', $betreff, $ausgabe, "From: $mail");
                $name = $vorname = $mail = $betreff = $nachricht = $ausgabe = '';
                $nameFehler = $vornameFehler = $mailFehler = $betreffFehler = '';
            }
        ?> -->
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro tempore quia accusamus! Maiores autem iure nulla. Debitis maxime ea quibusdam soluta enim, incidunt laboriosam fuga atque aperiam placeat adipisci quasi?
            Eligendi quidem modi illum dolores soluta repellat nam veritatis. Error sit atque at molestias quo aut obcaecati praesentium saepe labore incidunt inventore, architecto minima repellendus odio accusamus fugit corporis voluptas?
            Beatae excepturi eum quos temporibus tenetur, officiis delectus dolorum voluptate quae error repudiandae animi quo ipsum ipsam velit aperiam? Explicabo modi, consequuntur dolore inventore maxime nobis quibusdam laboriosam repudiandae ipsam!
            Commodi iste voluptates aliquid quasi eum? In atque, possimus quo accusamus quaerat ratione rem illo perspiciatis molestias. Saepe, amet ea, perspiciatis quae soluta sunt sed illum ducimus reprehenderit veritatis ut.
            Exercitationem libero facilis iste, quod dolores dolorum iusto omnis dolore obcaecati ipsam totam est odit commodi id nihil deleniti beatae maiores consectetur, nisi temporibus. Placeat minus dolorum magnam! Error, repudiandae?
            Aperiam eveniet iste culpa enim natus maxime voluptatem id officiis nihil quod quae quas magni beatae ipsam voluptatibus vitae, earum, nulla praesentium recusandae aliquid. Enim officia atque iste adipisci! Hic.
            Architecto voluptas, labore magni molestias, vitae tenetur nobis alias eaque suscipit eveniet, nisi est fuga maxime. Porro ipsam at officia cupiditate vitae quia quis. Vel praesentium commodi sed officiis! Minus?
            Inventore a, in laborum, architecto laudantium quo suscipit corrupti earum, cupiditate facere deserunt dolorem reiciendis soluta exercitationem. Maiores repellendus officiis, delectus voluptate deserunt tempore, cupiditate fugit nihil animi labore praesentium.
            Perferendis magnam repudiandae necessitatibus reiciendis natus, quibusdam provident sunt voluptatem dolorum culpa obcaecati aperiam molestiae nesciunt facere! Fugit, dolore alias quod voluptas soluta beatae adipisci, quo esse quos cum blanditiis.
            Iste libero consequatur aperiam culpa alias. Quas dignissimos repellendus quos esse accusamus nisi, impedit, saepe neque fuga assumenda numquam eligendi obcaecati officia eos dolor magni consequatur quis sapiente! Sed, tempore!
            Voluptas fuga magni vel dolorem, beatae iste fugiat culpa totam, est commodi pariatur? Laborum ea ut sunt rem explicabo! A distinctio aspernatur omnis sunt nobis, blanditiis temporibus beatae animi iusto?
            Fugit vitae dolor quos nobis eligendi eos? Ea rerum recusandae, voluptas quia facilis quibusdam esse odio nobis blanditiis id? Blanditiis explicabo at dolorem sit doloremque omnis iusto eaque veniam laboriosam.
            Voluptatum odit odio veritatis, excepturi dignissimos autem adipisci nesciunt, dolorem modi sapiente neque natus unde! Ullam laudantium amet qui maxime corporis sapiente similique nobis sit aspernatur ab, eos atque quam.
            Commodi magnam nostrum, illum tenetur ipsam ab ducimus asperiores, reprehenderit eaque autem optio cupiditate accusantium expedita nesciunt, cum natus sed ipsa amet voluptatibus nobis aperiam cumque suscipit ut! Cupiditate, a!
            Quia, suscipit minima! Quod, distinctio veritatis accusantium aut possimus ea perspiciatis dolores quibusdam atque iure quia saepe unde esse numquam voluptas inventore iusto, labore nostrum consequuntur aliquam. Voluptatibus, laboriosam odit.
            Cumque temporibus non, rem ipsa iure unde eligendi possimus eos illo eum animi, vel ullam maxime pariatur tempora voluptate sunt eveniet ex facilis! Ducimus amet repudiandae voluptas illo, maxime laboriosam.
            Rem soluta, cumque nisi id animi aspernatur ipsum veniam sint minus accusamus pariatur expedita dicta, vero officia voluptatum, minima corrupti suscipit similique voluptate quisquam reprehenderit. Asperiores ad dolorum necessitatibus maxime!
            Minus soluta totam, hic ullam accusantium nisi quam nobis sit saepe ab quasi. Culpa adipisci consequuntur quaerat, aliquid enim vel facilis. Velit, enim officiis eos iusto ducimus aspernatur eveniet esse?
            Quae consequatur quod laboriosam cum, iste eius autem sint rem, doloremque quaerat fugit eveniet assumenda nisi nam amet nihil unde laudantium delectus nobis ea, rerum architecto? Voluptatum porro magnam molestiae.
            Vel nesciunt distinctio repellendus eveniet, suscipit autem maiores minus sequi molestiae eaque corporis soluta tempore repellat obcaecati ipsam fugit adipisci facilis nemo eos officiis explicabo aut! Fugit assumenda quos provident.
        </p>
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