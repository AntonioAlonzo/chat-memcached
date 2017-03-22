<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Chat Memcached</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <h1><span class="glyphicon glyphicon-comment"></span> Chat con Memcached</h1>

            <div class="panel panel-default" style="min-height: 300px; max-height: 300px; overflow-y: scroll;">
                <div class="panel-body">
                    <?php
                        if (sizeof($messages) > 0) {
                            foreach ($messages as $message) {
                                // echo $message['username'] . " dice: " . $message['message'] . "<br />";
                                echo $message['username'] . " dice: " . $message['message'] . "<br />";
                            }
                        } else {
                            echo 'No hay mensajes.';
                        }
                    ?>
                </div>
            </div>

            <form action="" method="post">
                <div class="input-group">
                    <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" value="Enviar">
                    </span>
                    <input type="text" id="message" name="message" class="form-control" placeholder="Ingresa tu mensaje..." required>
                </div><!-- /input-group -->
            </form>
        </div>
    </body>
</html>
