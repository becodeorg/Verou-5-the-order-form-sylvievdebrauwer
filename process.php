<?php
session_start();

// Step 1: Accepting Orders
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data and display order confirmation
    $chosenProducts = $_POST['products']; // Adjust accordingly
    $deliveryAddress = $_POST['address']; // Adjust accordingly

    echo "<h2>Order Confirmation</h2>";
    echo "<p>Chosen Products: " . implode(", ", $chosenProducts) . "</p>";
    echo "<p>Delivery Address: " . $deliveryAddress . "</p>";

    // Step 2: Validation
    $errors = validateForm($_POST);
    if (!empty($errors)) {
        // Display errors
        echo "<div class='alert alert-danger'>";
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }
        echo "</div>";

        // Display previous values
        // Note: The values may need to be sanitized before echoing in a real-world scenario
        echo "<script>document.getElementById('name').value = '" . $_POST['name'] . "';</script>";
        // Repeat for other fields
    }
}

// Step 3: Improve UX by Saving User Data
function validateForm($formData) {
    $errors = [];

    // Validate required fields
    $requiredFields = ['name', 'address']; // Add other required fields
    foreach ($requiredFields as $field) {
        if (empty($formData[$field])) {
            $errors[] = ucfirst($field) . " is required.";
        }
    }

    // Validate zip code
    if (!empty($formData['zip']) && !ctype_digit($formData['zip'])) {
        $errors[] = "Zip code must contain only numbers.";
    }

    // Validate email address
    if (!empty($formData['email']) && !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    return $errors;
}
?>
