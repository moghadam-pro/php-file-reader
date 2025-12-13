<?php
// Image directory path
$images_dir = __DIR__ . '/images';

// Allowed image extensions
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$images = [];

if (is_dir($images_dir)) {
    $files = scandir($images_dir);
    
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $file_path = $images_dir . '/' . $file;
            $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            
            // retrieve image details
            if (is_file($file_path) && in_array($file_extension, $allowed_extensions)) {
                $images[] = [
                    'name' => $file,
                    'path' => 'images/' . $file,
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
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمایش عکس‌ها</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>گالری عکس</h1>
            <p>تعداد عکس: <strong><?php echo count($images); ?></strong></p>
        </header>

        <main>
            <?php if (count($images) > 0): ?>
                <div class="gallery-grid">
                    <?php foreach ($images as $image): ?>
                        <div class="gallery-item">
                            <div class="image-wrapper">
                                <img src="<?php echo htmlspecialchars($image['path']); ?>" 
                                     alt="<?php echo htmlspecialchars($image['name']); ?>"
                                     loading="lazy">
                                <div class="overlay">
                                    <button class="view-btn" onclick="openModal('<?php echo htmlspecialchars($image['path']); ?>')">
                                        بزرگ‌نمایی
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
                    <p>هیچ عکسی در پوشه یافت نشد.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <!-- Image Zoom Modal -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <script src="js/script.js"></script>
</body>
</html>