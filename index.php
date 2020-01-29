<?php require_once 'app/counter.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('inc/meta.php'); ?>


    <title>Eissaweb - Facebook video  Downloader</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="icon"
      type="image/png" 
      href="icons/favicon-32x32.png">
    <script data-ad-client="ca-pub-8029326152956282" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body class="" style="font-family: 'Roboto', sans-serif !important;">
    <div class="container">
        <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="icons/apple-touch-icon.png" width="30" height="30" class="d-inline-block align-top" alt=" Facebook downloader">
        <span style="font-family: 'Fredoka One', cursive;">Eissaweb</span>
      </a>
      <span class="float-right d-none d-md-inline">
            Want to create a website ? <a href="mailto:iss7a99@gmail.com" class="btn btn-outline-secondary">Contact the Developer</a> 
        </span>
    </nav>
    </div>
    <div class="container  bg-white rounded"  style="border:1px solid #bbb">
        <!-- Navbar -->
        <!-- Image and text -->
    <!-- Navbar -->
        <h1 class="text-center my-5">Download & Save Facebook Video</h1>
        <div class="row">
            <div class="col-md-2 mt-3 d-none d-md-block">
               
            </div>
            <div class="col-md-8" id="app">
                <!-- This will be part  of download-video component -->
                <download-video></download-video>
                <affiliate-ads ads=""></affiliate-ads>
                <!-- Ads here -->
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                </div>
            </div>
            <div class="col-md-2">
                <!-- Google ads -->
                               
            </div>
        </div>
    </div>
    
    <!-- Blog Place, we will not use vue.js for the sake of SEO -->
    <?php include ('inc/how-to-download.php') ?>
    <!-- Footer -->
    
    <?php include ('inc/footer.php') ?>
    <script src="js/app.js"></script>
</body>
</html>