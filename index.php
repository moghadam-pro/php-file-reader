<?php
// Base directory
$base_dir = __DIR__;

// Allowed image extensions
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

$images_dir = null;
$folder_name = 'Gallery'; // default

// Find the folder containing images
$folders = scandir($base_dir);
foreach ($folders as $folder) {
    if ($folder != '.' && $folder != '..' && is_dir($base_dir . '/' . $folder)) {
        $test_dir = $base_dir . '/' . $folder;
        $files = scandir($test_dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($file_extension, $allowed_extensions)) {
                    $images_dir = $test_dir;
                    $folder_name = $folder;
                    break 2;
                }
            }
        }
    }
}

$images = [];

if ($images_dir) {
    $files = scandir($images_dir);
    
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $file_path = $images_dir . '/' . $file;
            $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            
            // retrieve image details
            if (is_file($file_path) && in_array($file_extension, $allowed_extensions)) {
                $images[] = [
                    'name' => $file,
                    'path' => $folder_name . '/' . $file,
                    'size' => filesize($file_path),
                    'date' => date('Y-m-d H:i', filemtime($file_path))
                ];
            }
        }
    }
}

// Sort images by date (newest first)
usort($images, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($folder_name); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo htmlspecialchars($folder_name); ?></h1>
            <p>Gallery Count: <strong><?php echo count($images); ?></strong></p>
        </header>

        <main>
            <?php if (count($images) > 0): ?>
                <div class="gallery-grid">
                    <?php foreach ($images as $image): ?>
                        <div class="gallery-item" onclick="openModal('<?php echo htmlspecialchars($image['path']); ?>')">
                            <div class="image-wrapper">
                                <img src="<?php echo htmlspecialchars($image['path']); ?>" 
                                     alt="<?php echo htmlspecialchars($image['name']); ?>"
                                     loading="lazy">
                                <div class="overlay">
                                    <button class="view-btn">
                                        Click to Zoom
                                    </button>
                                </div>
                            </div>
                            <div class="image-info">
                                <p class="image-name"><?php echo htmlspecialchars($image['name']); ?></p>
                                <p class="image-date"><?php echo $image['date']; ?></p>
                                <p class="image-size"><?php echo round($image['size'] / 1024, 2); ?> KB</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-images">
                    <p>Nothing found on this directory</p>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <!-- Image Zoom Modal -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <script src="script.js"></script>
    <script>
        const images = [
            <?php foreach ($images as $image): ?>
                '<?php echo htmlspecialchars($image['path']); ?>',
            <?php endforeach; ?>
        ];
    </script>
</body>
</html>