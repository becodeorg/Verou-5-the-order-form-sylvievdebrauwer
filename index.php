<?php
// This line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
$city = $email = $street = $zipcode = $streetnumber = "";

$products = [
    ['name' => 'Jungle Hut', 'price' => 75,50],
    ['name' => 'Purrchitecture Palace', 'price' => 60],
    ['name' => 'Climb-a-lot Condo', 'price' => 30],
    ['name' => 'Whisker Haven Hideaway', 'price' => 80],
    ['name' => 'Catnap Nook Shelves', 'price' => 30],
    ['name' => 'Kitty Cloud Climb', 'price' => 110],
    ['name' => 'Scratch-a-Sky Sanctuary', 'price' => 90],
    ['name' => 'Paw-some Wall Playland', 'price' => 125,00],
    ['name' => 'Feline Fortress Fixture', 'price' => 25],
];

$totalValue = 0;

function validate()
{
    // TODO: This function will send a list of invalid fields back
    $invalidFields = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //validate email
    if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $invalidFields[] = "Please enter a valid email";
    }
    // validate address fields
    $addressFields = ['street', 'streetnumber', 'city', 'zipcode'];
    foreach ($addressFields as $field){
      if (empty($_POST[$field])) {
        $invalidFields[$field] = ucfirst($field). 'is required';
      }
    }
    // validate zip code (only numbers)
    $zipCode = $_POST["zipcode"];
    if (empty($zipCode) || !is_numeric($zipCode)) {
        $invalidFields[] = "Enter a valid zipcode in numbers please";
    }

   // Check product selection
    if (empty($_POST["products"])) {
      $invalidFields[] = "Select a product first";
    }
  
  }
    // add more rules as needed
    return $invalidFields;
}

function handleForm()
{
  global $products;
  $totalValue = 0;
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
      echo '<div class="alert alert-danger" role="alert">';
      echo '<h4 class="alert-heading"> Validation Errors:</h4>';
      echo '<ul>';
      foreach ($invalidFields as $error) {
        echo '<li>' . $error . '</li>';
      }
      echo '</ul>';
      echo '</div>';

        // TODO: handle errors
    } else {
        // TODO: handle successful submission
        // process order, save to database

        //display order confirmation
        echo '<div class="confirmation">';
        echo '<h2>Order Confirmation</h2>';

        //display chosen products
        echo '<p>Chosen Products:</p>';
        if (!empty($_POST['products'])) {
          echo '<ul>';
          foreach ($_POST['products'] as $productId => $value) {
            $productName = $products[$productId]['name'];
            $productPrice = $products[$productId]['price'];
            echo '<li>' . $productName . ' -&euro;' . number_format($productPrice,2) . '</li>';
          }
          echo '</ul>';
        } else {
          echo '<p>No products selected</p>';
        }

        // display delivery address
        echo '<p>Delivery Address:</p>';
        echo '<ul>';
        echo '<li>Email: ' . htmlspecialchars($_POST['email']) . '</li>';
        echo '<li>Street: ' . htmlspecialchars($_POST['street']) . '</li>';
        echo '<li>Street Number: ' . htmlspecialchars($_POST['streetnumber']) . '</li>';
        echo '<li>City: ' . htmlspecialchars($_POST['city']) . '</li>';
        echo '<li>Zip Code: ' . htmlspecialchars($_POST['zipcode']) . '</li>';
        echo '</ul>';

        //display total value
        echo '<p>Total Order Value: &euro;' . number_format($totalValue, 2) . '</p>';

        echo '</div>';
        
    }
}

// TODO: replace this if by an actual check for the form to be submitted
// $formSubmitted = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    handleForm();
}

require 'form-view.php';