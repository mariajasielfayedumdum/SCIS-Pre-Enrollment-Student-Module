<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/scis.png">
        <title>Login Page</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/login.css">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="search" method="post" action="/loginAuth">
                {{ csrf_field() }}
                <fieldset>
                    <div class="text-center">
                        <img class="logoLogin" src="../plugins/images/scislogo.png">
                        <p class="titleLogo">School of Computing and Information Sciences</p>
                        <p class="subTitle">Pre - Enrollment System</p>
                    </div>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input name="username" type="text" id="username" class="form-control input-lg" placeholder="username">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="password">
                    </div>

                    <hr class="colorgraph">

                    <!-- Add login URL in index.php -->

                    <div class="row">
                        <div>
                            <input type="submit" name="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

</body>
</html>

