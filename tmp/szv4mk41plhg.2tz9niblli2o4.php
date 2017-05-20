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
                <!-- show about section -->
                        <div class="container-fluid">
                            <div class="col-sm-12">
                                <div class="aboutContainer">
                                    <p class="aboutTitle"><center><?= $_user->getUserName() ?> Blogs</center></p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php if ($hasPosts == 'true'): ?>
                        
                        <div class="container-fluid">
                            <div class="col-sm-8 aboutContainer">
                                <h3>My Recent blog:</h3>
                                <?= $posts[0]->getPostData().PHP_EOL ?>
                            </div>
                        </div>
                            <br>
                        <div class="container-fluid">
                            <div class="col-sm-8 aboutContainer">
                                <!-- start blogs loop at 1 so we can skip the latest posted above -->
                                <?php for ($i=1;$i < count($posts);$i++): ?>
                                    <?= $posts[$i]->getPostData() ?><br/>
                                <?php endfor; ?>
                            </div>

                        
                        <?php else: ?>
                            <div class="col-sm-8 aboutContainer">
                                <p><?= $_user->getUserName() ?> Does not have any blog posts to show :( </p>
                            </div>
                        
                        <?php endif; ?>
                            <div class="col-sm-2">
                                <img src="profilephotos/<?= $_user->getProfilePic() ?>">
                            </div>
                        </div>
            </div>
        </div>
    </div>

</body>