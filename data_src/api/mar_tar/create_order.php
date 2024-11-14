<?php
// create_order.php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$database = "mercurycorp";

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$database", $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Capture POST data with the correct names and sanitize
    $medication = filter_input(INPUT_POST, 'medication', FILTER_SANITIZE_SPECIAL_CHARS);
    $dosage = filter_input(INPUT_POST, 'dosage', FILTER_SANITIZE_SPECIAL_CHARS);
    $frequency = filter_input(INPUT_POST, 'frequency', FILTER_SANITIZE_SPECIAL_CHARS);
    $start_date = filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_SPECIAL_CHARS);
    $end_date = filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_SPECIAL_CHARS) ?: null;
    $instructions = filter_input(INPUT_POST, 'instructions', FILTER_SANITIZE_SPECIAL_CHARS);
    $physician_id = filter_input(INPUT_POST, 'physician_id', FILTER_VALIDATE_INT);
    $resident_id = filter_input(INPUT_POST, 'res_id', FILTER_SANITIZE_SPECIAL_CHARS);
    $employee_id = filter_input(INPUT_POST, 'emp_id', FILTER_VALIDATE_INT);

    // Check if required fields are present and not empty
    if (empty($medication)) {
        echo "Error: Medication is missing.";
    } elseif (empty($dosage)) {
        echo "Error: Dosage is missing.";
    } elseif (empty($frequency)) {
        echo "Error: Frequency is missing.";
    } elseif (empty($start_date)) {
        echo "Error: Start date is missing.";
    } elseif (empty($physician_id)) {
        echo "Error: Physician ID is missing.";
    } elseif (empty($resident_id)) {
        echo "Error: Resident ID is missing.";
    } else {
        echo "All fields are filled.";
    }
    exit;
    
    

    // Check if the physician_id exists
    $physicianCheckStmt = $pdo->prepare("SELECT COUNT(*) FROM physician WHERE physician_id = :physician_id");
    $physicianCheckStmt->bindValue(':physician_id', $physician_id, PDO::PARAM_INT);
    $physicianCheckStmt->execute();
    if ($physicianCheckStmt->fetchColumn() == 0) {
        echo "Error: The specified physician_id does not exist.";
        exit;
    }

    // Check if the resident_id exists and retrieve the rec_id
    $recordCheckStmt = $pdo->prepare("SELECT rec_id FROM residents WHERE res_id = :res_id");
    $recordCheckStmt->bindValue(':res_id', $resident_id, PDO::PARAM_STR);
    $recordCheckStmt->execute();
    $rec_id = $recordCheckStmt->fetchColumn();

    if (!$rec_id) {
        echo "Error: No associated medical record ('rec_id') found for the provided resident ID ('res_id').";
        exit;
    }

    // Prepare SQL to insert into the `physician_orders` table
    $stmt = $pdo->prepare("INSERT INTO physician_orders (rec_id, order_date, order_text, physician_id)
                           VALUES (:rec_id, CURDATE(), :order_text, :physician_id)");

    // Create order text description
    $order_text = "Medication: $medication, Dosage: $dosage, Frequency: $frequency, Start Date: $start_date";
    $order_text .= $end_date ? ", End Date: $end_date" : "";
    $order_text .= ", Instructions: $instructions";

    // Bind parameters
    $stmt->bindValue(':rec_id', $rec_id, PDO::PARAM_INT);
    $stmt->bindValue(':order_text', $order_text, PDO::PARAM_STR);
    $stmt->bindValue(':physician_id', $physician_id, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Redirect back to the dashboard with a success message
    header("Location: nurse_dash.php?success=1");
    exit;

} catch (PDOException $e) {
    // Log the error and display a generic message to the user
    error_log("Database error: " . $e->getMessage());
    echo "An error occurred while processing your request. Please try again later.";
    exit;
}
?>
