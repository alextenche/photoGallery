<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Alexandru Tenche">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/main.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default">

        <div class="container container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> photoGallery </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!--<ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>

                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>-->

                <?php if ( $session->is_logged_in() ) : 
                    $user = User::find_by_id($session->user_id); ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"> logged as <?php echo $user->username; ?> </li></a>
                        <li <?php if( $section == 'listphotos') {echo 'class="active"';} ?>><a href="list_photos.php">
                            <span class="glyphicon glyphicon-list"> </span> List Photos </a></li>
                        <li <?php if( $section == 'logfile') {echo 'class="active"';} ?>><a href="logfile.php">
                            <span class="glyphicon glyphicon-list-alt"> </span> View Log file </a></li>
                        <li <?php if( $section == 'settings') {echo 'class="active"';} ?>><a href="settings.php">
                            <span class="glyphicon glyphicon-user"> </span> Settings </a></li>
                        <li><a href="logout.php"> <span class="glyphicon glyphicon-log-out"> </span> Log Out </a></li>
                    </ul>
                <?php else : ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php if( $section == 'login') {echo 'class="active"';} ?>><a href="login.php">
                            <span class="glyphicon glyphicon-log-in"></span> &nbsp;Log In </a></li>
                        <li <?php if( $section == 'signup') {echo 'class="active"';} ?>><a href="signup.php">
                            <span class="glyphicon glyphicon-edit"> </span> &nbsp;Sign Up </a></li>
                    </ul>
                <?php endif; ?>

            </div><!-- end collapse navbar-collapse -->

        </div><!-- end container-fluid -->

    </nav><!-- end nav -->