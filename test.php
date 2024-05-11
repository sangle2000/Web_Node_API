<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP to JavaScript</title>
</head>
<body>
    <?php
        // PHP code to generate data
        $message = "Hello from PHP!";
    ?>
    <script type="module">
        // JavaScript module to access PHP data
        const message = "<?php echo $message; ?>";
        console.log(message); // Output: Hello from PHP!
    </script>
</body>
</html>
