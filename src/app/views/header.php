<!DOCTYPE html>
<html>
    <head lang="bg">
        <meta charset="windows-1251">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>App</title>
        <script src="<?php echo BASEURL; ?>www/js/jquery.js"></script>
        <script src="<?php echo BASEURL; ?>www/js/bootstrap.min.js"></script>
        <link href="<?php echo BASEURL; ?>www/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div id='header'>
            <nav class="navbar navbar-inverse">
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li ><a href="<?php echo BASEURL; ?>">Начало</a></li>
                        <li><a href="<?php echo BASEURL; ?>pictures/index">Снимки</a></li>
                        <li><a href="<?php echo BASEURL; ?>users/index">Потребители</a></li>
                        <?php if ((isset($_SESSION['user']['is_admin']) and $_SESSION['user']['is_admin'] != 1) || !isset($_SESSION['user'])): ?>
                            <li><a href="<?php echo BASEURL; ?>contact/index">Контакти</a></li>
                        <?php endif; ?>
                    </ul>
                    <div style="padding-top:15px; padding-bottom:15px;float: right;">
                        <?php if (!isset($_SESSION['user']['id'])): ?>		  
                            <form class="form-inline"  action="<?php echo BASEURL; ?>users/entrance" method='post'>
                                <div class="form-group">
                                    <label class="sr-only" for="Username">Username</label>
                                    <input type="text" class="form-control" name ="username" id="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name='password' placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-default">Sign in</button>
                                <div><a href="<?php echo BASEURL; ?>users/register">Регистрация</a></div>
                            </form>

                        <?php else: ?>
                            <div style="display: inline;">
                                <li role="presentation" class="dropdown" style="display: inline;">

                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="true">
                                        <?php echo $_SESSION['user']['first_name']; ?> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo BASEURL; ?>users/profile">Profile</a></li>
                                        <li><a href="<?php echo BASEURL; ?>pictures/upload">Upload Pictures</a></li>

                                    </ul>
                                </li>

                                <li role="presentation" style="display: inline;">
                                    | <a href="<?php echo BASEURL; ?>users/logout">Logout</a>
                                </li>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>


