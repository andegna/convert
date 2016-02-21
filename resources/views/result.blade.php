<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>ECTS to Modular BDU</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="/cover.css" rel="stylesheet">

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
                                <tr><td>Number of Course</td><td><?=count($result['courses'])?></td></tr>
                                <tr><td>Total Number of Credit Hour</td><td><?=($result['credit_hour'])?></td></tr>
                                <tr><td>Total Credit Point in ECTS-Modular</td><td><?=($result['old_credit_point'])?></td></tr>
                                <tr><td>Total Credit Point in Convensional</td><td><?=($result['new_credit_point'])?></td></tr>
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
</body>
</html>
