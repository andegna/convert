<?php require_once 'raw.php';require_once 'loginnew.php';

    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

        if(isset($_REQUEST['ID']) && isset($_REQUEST['password'])){
            $valUsername = $_REQUEST['ID'];        // the value to submit for the username
            $valPassword = $_REQUEST['password'];

            $html = getHtml($valUsername, $valPassword);
            $courses = parse($html);
            if(empty($courses)){
                $error = "Please check ID and password!";
            }else{
                $result = calculate($courses);
            }
        } else {
            die('Sorry thier was an error. Come back again');
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
</head>

<body class="container"><!--400px-->
<header class="row"><!--Header-->
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8" style="text-align: center">
            <h1>AndegnaSoft</h1>

            <h3>ECTS to Modular Conversion Aid (developed by Amanu Amex)</h3>
        </div>
        <div></div>
    </div>
    <br/>
    <nav class="row panel-footer">
        <ul class="pull-left nav nav-pills">
            <li>&nbsp;&nbsp;&nbsp;</li>
            <li><a href="//amexsofts.blogspot.com">Aman's Blog</a></li>
            <li class="active"><a href="#">Grade Data Retriever<span class="sr-only">(current)</span></a></li>
            <li><a href="//convert.andegnasoft.com/">Convert Main Page</a></li>
            <li><a href="//www.facebook.com/amexsofts">AmexSofts FB page</a></li>
        </ul>

    </nav>
</header>
<!--/Header-->

<div class="row"><!--Content-->
    <div class="col-md-2"></div>
    <div class="col-md-8" style="text-align: center">
        <form class="form-signin" action="no_save.php" method="post">
            <h2 class="form-signin-heading">Enter your <a href="//studentinfo.bdu.edu.et" target="_blank">studentinfo.bdu.edu.et</a>
                details</h2>

            <div class="col-md-3"></div>
            <div class="col-md-6">

                <label for="inputEmail" class="sr-only">ID</label>
                <input type="text" name="ID" class="form-control" placeholder="ID" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <br/>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <br/>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <?php if(isset($error)) : ?>
                <div class="alert alert-error">
                   <?php echo $error ?>
                </div>
                <?php endif ?>
            </div>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
<!--/Content-->
<?php if(isset($result)) : ?>
    <h1 class="cover-heading text-success"> <i class="glyphicon glyphicon-random"></i> Grade converted.</h1>
    <div class="panel panel-success">
        <div class="panel-heading" style="color: #333">Result Window</div>
        <table class="b table">
            <tr><td>Number of Course</td><td><?=($result['count'])?></td></tr>
            <tr><td>Total Number of Credit Hour</td><td><?=($result['sum_ch'])?></td></tr>
            <tr><td>Total Credit Point in ECTS-Modular</td><td><?=($result['sum_old_cp'])?></td></tr>
            <tr><td>Total Credit Point in Convensional</td><td><?=($result['sum_new_cp'])?></td></tr>
            <tr><td>Old GPA</td><td><?=($result['old_gpa'])?></td></tr>
            <tr><td>New GPA</td><td><?=($result['new_gpa'])?></td></tr>
        </table>
        <div class="panel-footer">
            <div class="alert alert-warning">
                If your <b>Old GPA</b> is wrong, the <b>New GPA</b> might be too. <br/>
                Come back soon. Thanks.
            </div>
            <hr/>
            <div class="alert alert-success">
                Conversion curtesy of  <a href="//convert.andegnasoft.com/">AndegnaSoft</a>
            </div>
        </div>
    </div>
<?php endif ?>
<br/>

<div class="row panel-footer"><!--Content-->
    <div class="col-md-3"></div>
    <div class="col-md-6">
        Developed by Amanu - 0918221184:
    </div>
</div>
<!--/Content-->

</body>

</html>
