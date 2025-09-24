<?php

// Read the SVG file
$svgFile = 'public/docs/static/structure.svg';
$content = file_get_contents($svgFile);

// List of missing image files to remove
$missingImages = [
    '3F41918F.png',
    '3F41918D.jpg', 
    '3F419193.png',
    '3F419195.jpg',
    '3F419194.jpg',
    '3F419197.png',
    '3F41919D.jpg',
    '3F41919F.png',
    '247A09BC.jpg',
    '247A09BC.png',
    '247A09B4.jpg',
    '247A09B4.png',
    '247A09B5.jpg',
    '247A09AC.jpg',
    '3F41919C.png'
];

// Remove image tags that reference missing files
foreach ($missingImages as $image) {
    // Pattern to match image tags with this file reference
    $pattern = '/<image[^>]*xlink:href="' . preg_quote($image, '/') . '"[^>]*>.*?<\/image>/s';
    $content = preg_replace($pattern, '<!-- Removed broken image reference: ' . $image . ' -->', $content);
    
    // Also handle self-closing image tags
    $pattern2 = '/<image[^>]*xlink:href="' . preg_quote($image, '/') . '"[^>]*\/?\s*>/';
    $content = preg_replace($pattern2, '<!-- Removed broken image reference: ' . $image . ' -->', $content);
}

// Create backup
copy($svgFile, $svgFile . '.backup');

// Write cleaned content
file_put_contents($svgFile, $content);

echo "SVG file cleaned successfully!\n";
echo "Backup created at: " . $svgFile . ".backup\n";
echo "Original file size: " . filesize($svgFile . '.backup') . " bytes\n";
echo "New file size: " . filesize($svgFile) . " bytes\n";

?>