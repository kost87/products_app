<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <title>Товары</title>
    </head>
    <body>
        <div class="container">
            <br>
            <div class="row">
                <div class="col">
                    <a href="./">Все товары</a>
                    <?php echo $content?>
                </div>
                <div class="col">
                    <?php 
                    foreach ($products as $product) {
                        echo $product->name . "<br>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>