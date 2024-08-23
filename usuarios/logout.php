    <?php
session_start();
session_unset();
session_destroy();

// Responder con un mensaje de éxito en formato JSON
$response = array('success' => true);
echo json_encode($response);
header("Location: ../public/index.html");
?>
