<!DOCTYPE html>
<html>
    <head>
        <title><?= $PageTitle ?></title>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        
        <!-- Custom style sheet -->
        <link rel="stylesheet" href="styles/Style.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 side_nav">
                <?php echo $this->render($sidenav,NULL,get_defined_vars(),0); ?> 
            </div>
            <div class="col-sm-9">
            <div class="container">
                <div class="col-sm-2">
            <!-- repeat card layout for each blog -->
                <div class="card">
                    <img class="card-img-top" src="" alt="Users Profile">
                        <div class="card-block">
                            <h4 class="card-title">Username - Date</h4>
                            <hr>
                                <p class="card-text"><a href="#UsersBlog">View Blogs</a> - Total: 10</p>
                            <hr>
                                Users latest post
                                </p>
                        </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

</body>