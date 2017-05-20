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
            <!-- repeat card layout for each blog -->
            <?php foreach (($users?:[]) as $user): ?>
            <div class="col-sm-3">
                <div class="card homeBlogCards">
                    <img class="card-img-top img-responsive" src="<?= './profilephotos/'.$user->getProfilePic() ?>" alt="Users Profile">
                        <div class="card-block">
                            <h4 class="card-title"><center><?= $user->getUserName() ?></center></h4>
                            <hr>
                                <p class="card-text"><center><a href="<?= './'.$user->getUserName() ?>">View Blogs</a> - Total: <?= $user->getPostCount() ?></center></p>
                            <hr>
                                <span><?= $user->getPostExcerpt() ?></span>
                                </p>
                        </div>
                </div>
            </div>
            <?php endforeach; ?>
                
            </div>
            </div>
        </div>
    </div>

</body>