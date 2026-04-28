<?php
function uploadCoverImage($file) {
    if (!isset($file) || $file["error"] !== UPLOAD_ERR_OK) {
        return [null, null];
    }

    $allowedTypes = ["image/jpeg", "image/png", "image/webp"];

    if (!in_array($file["type"], $allowedTypes)) {
        die("Formato immagine non valido. Usa JPG, PNG o WEBP.");
    }

    $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
    $fileName = uniqid("cover_", true) . "." . $extension;

    $coverPath = "../../uploads/covers/" . $fileName;
    $thumbnailPath = "../../uploads/thumbnails/thumb_" . $fileName;

    move_uploaded_file($file["tmp_name"], $coverPath);

    createThumbnail($coverPath, $thumbnailPath, 250, 350);

    return [
        "uploads/covers/" . $fileName,
        "uploads/thumbnails/thumb_" . $fileName
    ];
}

function createThumbnail($source, $destination, $thumbWidth, $thumbHeight) {
    $info = getimagesize($source);

    if (!$info) {
        return false;
    }

    [$width, $height] = $info;
    $mime = $info["mime"];

    switch ($mime) {
        case "image/jpeg":
            $image = imagecreatefromjpeg($source);
            break;
        case "image/png":
            $image = imagecreatefrompng($source);
            break;
        case "image/webp":
            $image = imagecreatefromwebp($source);
            break;
        default:
            return false;
    }

    $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);

    imagecopyresampled(
        $thumb,
        $image,
        0,
        0,
        0,
        0,
        $thumbWidth,
        $thumbHeight,
        $width,
        $height
    );

    imagejpeg($thumb, $destination, 85);

    imagedestroy($image);
    imagedestroy($thumb);

    return true;
}
?>