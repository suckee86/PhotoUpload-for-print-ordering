<!DOCTYPE html>
<html>
    <?php 
        session_start();
    ?>
<head>
    <title>Best Duo Fotó - Online képkidolgozás</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url("bgimg.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: cover; 
        }
        span{
            text-shadow: 1px 1px #000000;
        }
    </style>
</head>
<body>
        
    <center>
        <img id="logo" src="3D_logo.png" alt="BESTDUO logo" height="50%" width="50%"/>
    </center>
    <br><br>
    <div class="w3-display-bottommiddle w3-margin-bottom w3-card-4 w3-animate-zoom" style="max-width:600px">
        <form action="upload.php" class="w3-container w3-text-white" style="width:100%" method="post" enctype="multipart/form-data">
            <span>Kérjük a feltöltés megkezdése előtt adja meg az e-mail címét:</span><br>
            <input type="email" style="width:100%" name="e-mail" id="e-mail" required><br><br>
            <span>Válassza ki a feltöltendő képeket (maximum 100db):</span><br>
            <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" /><br><br>
            <input type="submit" class="w3-button w3-section w3-pale-blue w3-ripple" value="Képek feltölése" name="submit">
        </form>
    </div>
    <?php
    // remove all session variables
    session_unset(); 
    
    // destroy the session 
    session_destroy(); 
    ?>
</body>
</html>