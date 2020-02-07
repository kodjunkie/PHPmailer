<?php
/*
 * Index page
 * */

require_once("./includes/init.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple PHP mailer Package">
    <meta name="author" content="Lawrence Onah">
    <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">

    <title>Mailer</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/app.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./assets/css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container-fluid">

    <div class="row">
        <div class="top-section">
            <?php
                if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                    <div class="row">
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
                            <div class="alert alert-<?= ($_SESSION['msg'][1]) ? 'success' : 'danger' ?>"
                                 style="margin-top: 2em">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php
                                    echo trim($_SESSION['msg'][0]);
                                    unset($_SESSION['msg']);
                                ?>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 card">
                <form action="./handler.php" method="post" role="form" enctype="multipart/form-data">
                    <legend>Send e-Mail</legend>

                    <div class="form-group">
                        <label for="subject" class="control-label">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <label for="from" class="control-label">From</label>
                        <input type="text" class="form-control" name="from" id="from" placeholder="Sender's name" required>
                    </div>
                    <div class="form-group">

                        <label class="switch pull-right">
                            <input type="checkbox" name="send_to_group" id="send_to_group">
                            <span class="slider round"></span>
                        </label>

                        <label for="send-to" class="control-label">To group</label>
                        <input name="email_to_list" class="form-control" placeholder="Email list" id="email_to_list" type="file" style="display: none">
                        <input type="email" class="form-control" name="to" id="to" placeholder="recipient's email" required>
                    </div>

                    <div class="form-group">
                        <label for="message" class="control-label">Message</label>
                        <textarea name="message" id="message" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Send Mail">
                        </div>
                    </div>
                </form>
            </div>
        </div>

</div><!-- /.container -->

<script src="./assets/js/app.js"></script>
<script src="./assets/js/custom.js"></script>
</body>
</html>
