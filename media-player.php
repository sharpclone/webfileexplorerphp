<!DOCTYPE html>
<html>

<head>
    <title>Media Player</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        <?php require("./index.css"); ?>
    </style>
</head>

<body>
    <?php
    $file = $_GET['file'];
    $file_name_arr = explode("/",$file);
    echo '<h1 style="margin-bottom: 0px !important;"> ' . end($file_name_arr) . '</h1>';
    echo '<div class="container">';
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    if (in_array($extension, ['mp3', 'ogg', 'wav'])) {
        // Audio player
        echo '<img src="src/audio.png" >';
        echo '<audio controls>';
        echo '<source src="' . $file . '" type="audio/' . $extension . '">';
        echo 'Your browser does not support the audio element.';
        echo '</audio>';
    } elseif (in_array($extension, ['mp4', 'webm', 'ogg'])) {
        // Video player
        echo '<video controls>';
        echo '<source src="' . $file . '" type="video/' . $extension . '">';
        echo 'Your browser does not support the video tag.';
        echo '</video>';
    } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
        // Image viewer
        echo '<img src="' . $file . '" alt="Image">';
    } elseif ($extension === 'pdf') {
        // Display PDF file
        echo '<embed src="' . $file . '" type="application/pdf" width="100%" height="600px" />';
    } elseif ($extension === 'txt') {
        // Display text file
        $content = file_get_contents($file);
        echo '<pre class="txt--view">' . htmlspecialchars($content) . '</pre>';
    }
    echo ' </div>';
    ?>
    <!-- <button class="back-button" onclick="goBack()">Exit</button> -->


</body>

</html>