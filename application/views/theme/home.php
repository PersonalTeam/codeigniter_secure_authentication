<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title></title>
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">FNV horecabond</a>
        </div>
        <?php if(!$this->session->userdata('userId')) : ?>
        <center>
            <div class="navbar-collapse collapse" id="navbar-main">

                <form class="navbar-form navbar-right" action="<?= base_url('login/tryLogin') ?>" method="post" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="e-mail">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="pass" placeholder="wachtwoord">
                    </div>
                    <button type="submit" class="btn btn-default">Sign In</button>
                </form>

            </div>
        </center>
        <?php else : ?>

        <p style="margin-top: 16px; float: right;">Welkom <?= $this->session->userdata('username'); ?> - <a href="<?= base_url('/ledenportaal/dashboard') ?>">Mijn FNV</a> - <a href="<?= base_url('/login/destroy') ?>">uitloggen</a></p>

        <?php endif; ?>
    </div>
</div>

<div id="wrapper" class="container" >
    <div class="row">
        <div class="col-sm-12" >

            <?php if (isset($login_error)) : ?>
                <div id="auth-error" class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <?= $login_error; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

