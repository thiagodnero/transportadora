<html>
    <head>
        <title>Home</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            $url = (isset($_GET['url'])) ? $_GET['url']:'index.html';
            $url = array_filter(explode('/',$url));
            
            $file = $url[0].'.php';
            
            if(is_file($file)){
                include $file;
            }else{
                include '404.html';
            }            
        ?>
    </body>
</html>