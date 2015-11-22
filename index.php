<?php require_once 'raw.php';

    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_FILES['file'])) {
            $courses = parse();
            $result = calculate($courses);
        } else {
            die('Sorry thier was an error. Come back again');
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>ECTS to Modular BDU</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="cover.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="site-wrapper">

        <div class="site-wrapper-inner">

            <div class="cover-container">

                <div class="masthead clearfix">
                    <div class="inner">
                        <h3 class="masthead-brand">AndegnaSoft</h3>
                        <nav>
                            <ul class="nav masthead-nav">
                                <li class="active"><a href="/">Home</a></li>
                                <li><a href="http://www.andegnasoft.com" target="_blank">AndegnaSoft.com</a></li>
                                <li><a href="http://studentinfo.bdu.edu.et" target="_blank">SIMS</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <style>
                    table.b td {
                        color: #333333;
                    }
                    .b  tr  td:nth-child(2) {
                        font-weight: bolder;
                    }
                </style>

                <div class="inner cover">
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
                            </div>
                        </div>
                    <?php else : ?>
                        <h1 class="cover-heading"> <i class="glyphicon glyphicon-random"></i> Convert your grade.</h1>
                        <p class="lead text-left">
                            <code>Step 1:</code> Visit the site <a class="text-info" href="http://studentinfo.bdu.edu.et/MyStatus.aspx">http://studentinfo.bdu.edu.et/MyStatus.aspx</a><br/>
                            <code>Step 2:</code> Login with your username and password<br/>
                            <code>Step 3:</code> Right Click and choose the <code>Save Page As</code> menu<br/>
                            <code>Step 4:</code> Come back here and Click the Convert Big Button<br/>
                        </p>
                    <?php endif ?>
                    <p class="lead">
                        <a href="#" class="btn btn-lg btn-default" data-toggle="modal"
                           data-target="#myModal">Convert</a>
                    </p>
                </div>

                <div class="mastfoot">
                    <div class="inner">
                        <p>Developed by <a href="mailto:sam@andegnasoft.com">Sam As End</a> and <a href="mailto:wende@andegnasoft.com">Gebre</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" style="color: black" id="myModalLabel">
                        Choose The File
                    </h4>
                </div>
                <div class="modal-body">
                    <form name="form" action="index.php" method="POST" enctype="multipart/form-data">
                        <input required name="file" type="file">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close
                    </button>
                    <button onclick="document.forms[0].submit()" type="submit" class="btn btn-primary">
                        Upload
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
