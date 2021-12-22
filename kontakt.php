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
        <?php
        
        ?>
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