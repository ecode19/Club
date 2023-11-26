<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Preview</title>
</head>

<body>
    <?php
    // Get the PDF file path from the URL parameter
    $pdfFilePath = $_GET['pdf'];

    if (isset($pdfFilePath)) {
        echo "<iframe src='" . $pdfFilePath . "' width='100%' height='500px'></iframe>";
    } else {
        echo "Invalid PDF file path.";
    }
    ?>
</body>

</html>