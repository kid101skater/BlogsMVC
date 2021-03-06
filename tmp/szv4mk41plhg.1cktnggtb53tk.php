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
            <div class="col-sm-7">
                <!-- show about section -->
                <div class="aboutContainer">
                        <div class="container-fluid">
                            <div class="col-sm-9">
                                <div class="aboutHeader">
                                    <?php if ($postID === null): ?>
                                        
                                    <p class="aboutTitle">What's on your mind?</p>
                                        
                                        <?php else: ?><p class="aboutTitle">Change your mind?</p>
                                        <?php endif; ?>
                                        
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <img src="images/writing.png" class="img-responsive" alt="blog writing logo">
                            </div>
                        </div>
                </div>
                        <br>
                <!-- Show content below header -->
                <div class="container-fluid aboutContent">
                    <form class="form-inline" method="POST">
                            <div class="col-sm-1">
                            <label for="title">Title</label>
                            </div>
                            <div class="col-sm-11">
                            <input type="text" id="title" style="width:100%" name="title" value="<?= $title ?>" class="form-control">
                            </div>
                            <br>
                            <center>Post Content:</center>
                            <textarea class="form-control" style="width:100%" rows="8" id="entry" name="entry"><?= $entry ?></textarea>
                            <br><br><br>
                            <input type="text" id="postID" name="postID" value="<?= $postID ?>" hidden>
                            <center>
                            <button type="submit" class="btn btn-primary">Post</button>
                            </center>
                    </form>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- spacer -->
            </div>
        </div>
    </div>

</body>