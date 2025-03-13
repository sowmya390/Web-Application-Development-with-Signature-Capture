<?php
include 'database.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM signatures WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $phone = htmlspecialchars($data['phone']);
    $signature = htmlspecialchars($data['signature']);
} else {
    $error = "Error: Data not found";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 1.5rem;
        }
        .error {
            color: #ff4d4d;
        }
        .confirmation-details {
            text-align: left;
            margin-top: 1.5rem;
        }
        .confirmation-details p {
            margin: 0.5rem 0;
            font-size: 1rem;
            color: #555;
        }
        .confirmation-details strong {
            color: #333;
        }
        .signature-container {
            margin-top: 1.5rem;
        }
        .signature-image {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 0.5rem;
            max-width: 100%;
            height: auto;
        }
        @media (max-width: 600px) {
            .container {
                padding: 1rem;
            }
            .confirmation-details p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($error)): ?>
            <h1 class="error"><?php echo $error; ?></h1>
        <?php else: ?>
            <h1>Submission Successful</h1>
            <div class="confirmation-details">
                <p><strong>Name:</strong> <?php echo $name; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone:</strong> <?php echo $phone; ?></p>
                <div class="signature-container">
                    <p><strong>Signature:</strong></p>
                    <img src="<?php echo $signature; ?>" alt="User Signature" class="signature-image">
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>