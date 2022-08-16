<?php include("include/DB.php"); ?>
<?php include("include/function.php"); ?>
<?php include("include/session.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Blog Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/syles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <!-- NaVbar -->
    <div style="height: 10px; background: #27aae1"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">WWW.COM</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a href="blog.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="blog.php" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">contact us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Feachures</a>
                    </li>
                </ul>

                <ul class="navbar-nav mr-auto">
                    <form class="form-inline d-none d-sm-block" action="blog.php">
                        <div class="form-group">
                            <input class="form-control" type="text" name="Search" placeholder="Type.." value="">
                            <button  class="btn btn-primary ml-2" name="SearchButton">Go</button>
                        </div>
                    </form>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height: 10px; background: #27aae1"></div>
    <!-- Navbar End -->

    <!-- header start -->
    <div class="container">
        <div class="row mt-3">
            <!-- main area -->
            <div class="col-sm-8">
                <h1>Hello World</h1>
                <h1 class="lead">I am sonam</h1>
                <?php
                echo ErrorMessage();
                ?>
                <?php
                global $connectingDB;
                // sql query when search button is active
                if(isset($_GET["SearchButton"])){
                   $Search = $_GET["Search"];
                   $sql = "SELECT * FROM posts
                    WHERE datetimee LIKE :search
                    OR title LIKE :search 
                    OR category LIKE :search 
                    OR post LIKE :search";
                   $stmt =$connectingDB->prepare($sql);
                   $stmt->bindValue(':search','%'.$Search.'%');
                   $stmt->execute();
                }
                // The default sql query
                 else{ $sql = "SELECT * FROM posts ORDER BY id desc"; //desc use for desending order
                 $stmt = $connectingDB->query($sql);
               }
                while ($DataRows = $stmt->fetch()) {
                    $Id = $DataRows["id"];
                    $DateTime = $DataRows["datetimee"];
                    $Title = $DataRows["title"];
                    $Category = $DataRows["category"];
                    $Author = $DataRows["author"];
                    $Image = $DataRows["image"];
                    $Post = $DataRows["post"];
                ?>

                <div class="card">
                    <img src="Upload/<?php echo htmlentities($Image);?>" style="max-height:350px;" class="img-fluid card-img-top"/>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo htmlentities($Title); ?></h4>
                        <small class="text-muted">Writen by <?php echo htmlentities($Author); ?> On <?php echo htmlentities($DateTime); ?></small>
                        <span style="float:right;" class="badge badge-dark text-light">Comments 20</span>
                        <hr>
                        <p class="card-text">
                        <?php if (strlen($Post) > 150){$Post = substr($Post, 0, 149) . '..';  }echo htmlentities($Post); ?></p>
                        <a href="FullPost.php?id=<?php echo $Id; ?>" style="float:right;">
                        <span class="btn btn-info">Read More>></span>
                        </a>
                    </div>
                </div>
                <?php  }  ?>
            </div>
            <!-- main area end -->

            <!-- side Area start -->
            <div class="col-sm-4" style="min-height:40px; background:yellow;">

            </div>
            <!-- side Area End -->

        </div>

    </div>
    <!-- header end -->
    <br>

    <!-- footer start -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">
                        Theme By| Sonam Rajput |<span id="year"></span> &copy; ---All
                        right Reserved.
                    </p>
                    <p class="text-center small">
                        <a style="color: aliceblue; text-decoration: none; cursor: ponter" href="http://jazebakram.com/coupons" target="_blank">
                            This site is only used for study purpose jazebakram.com have you
                            all the rights. No one is allow to distribute copies other than
                            <br />&trade; jazebakram.com &trade; udemy ; &trade; skillshare
                            ; &trade; stackskills
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <div style="height: 10px; background: #27aae1"></div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $("#year").text(new Date().getFullYear());
    </script>
</body>

</html>