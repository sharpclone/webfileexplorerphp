<?php
function displayFolderContents($directory)
{
    echo '<h1 > Files in ' . $directory . '</h1>';
    echo '<div id="file-list">';
    $files = scandir($directory);

    $folders = [];
    $filesByType = [];

    // Array of blacklisted file types
    $blacklistedTypes = ['.doc', '.docx'];

    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && $file !== 'index.php') {
            $file_type = getFileIcon($file);
            if (is_dir($directory . '/' . $file)) {
                $folders[] = $file;
            } elseif (!in_array($file_type, $blacklistedTypes)) {
                $filesByType[$file_type][] = $file;
            }
        }
    }

    // Sort folders alphabetically
    sort($folders);

    // Sort files by file type
    ksort($filesByType);

    // Check if the current directory is the root
    $isRoot = $directory === './content/' || $directory === './';

    // Display back button if not in root directory
    if (!$isRoot) {
        echo '<a class="back-button" onclick="goBack()">Back</a>';
    }

    // Display folders first
    foreach ($folders as $folder) {
        echo '<div class="file-item folder" data-folder="' . $folder . '">';
        echo '<img src="./src/folder.png">';
        echo '<span class="file-name">' . $folder . '</span>';
        echo '</div>';
    }

    // Display files by file type
    foreach ($filesByType as $fileType => $filesOfType) {
        foreach ($filesOfType as $file) {
            $file_icon = '';
            $file_anchor = '';
            if ($fileType == 'png' || $fileType == 'jpg' || $fileType == 'jpeg' || $fileType == 'gif') {
                $file_anchor = '<a href="' . urlencode($directory . '/' . $file) . '" target="_blank">';
                $file_icon = 'image.png';
            } elseif ($fileType == 'mp3') {
                $file_anchor = '<a href="media-player.php?file=' . urlencode($directory . '/' . $file) . '">';
                $file_icon = 'audio.png';
            } elseif ($fileType == 'mp4') {
                $file_anchor = '<a href="media-player.php?file=' . urlencode($directory . '/' . $file) . '">';
                $file_icon = 'video.png';
            } elseif ($fileType == 'pdf') {
                $file_anchor = '<a href="media-player.php?file=' . urlencode($directory . '/' . $file) . '">';
                $file_icon = 'pdf.png';
            } elseif ($fileType == 'txt') {
                $file_anchor = '<a href="media-player.php?file=' . urlencode($directory . '/' . $file) . '">';
                $file_icon = 'txt.png';
            } else {
                $file_icon = 'default.png';
            }
            echo '<div class="file-item">';
            if ($file_anchor != '') {
                echo $file_anchor;
            } else {
                echo '<a>';
            }
            echo '<img src="./src/' . $file_icon . '">';
            echo '<span class="file-name">' . $file . '</span>';
            echo '</a>';
            echo '</div>';
        }
    }
    echo '</div>';
}

function getFileIcon($filename)
{
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    return $extension;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Content Folder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style><?php require("./index.css");?>
        .back-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #63ee88;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            visibility:
            <?php echo $isRoot ? 'hidden' : 'visible'; ?>
            ;
            font-family: 'Rubik', monospace, 'Times New Roman', serif;
        }
        </style>
        

    <script>
        function goBack() {
            var referrer = document.referrer;
            if (referrer.includes('media-player.php')) {
                window.history.go(-2);
            } else {
                window.history.back();
            }
        }
    </script>
</head>

<body>

</body>

</html>