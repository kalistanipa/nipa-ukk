<?php
echo "Current Script: " . __FILE__ . "<br>";
echo "Current Directory: " . __DIR__ . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Server Name: " . $_SERVER['SERVER_NAME'] . "<br>";

$css_path = __DIR__ . '/assets/css/style.css';
echo "Checking CSS path: $css_path <br>";
if (file_exists($css_path)) {
    echo "CSS File EXISTS.<br>";
}
else {
    echo "CSS File NOT FOUND.<br>";
}

echo "<a href='login.php'>Go to Login</a>";
?>
