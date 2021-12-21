<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <!-- Kontaktformular -->
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