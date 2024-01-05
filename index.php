<?php
// This line makes PHP behave in a more strict way
declare(strict_types=1);

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

$products = [
    ['Jungle-Hut' => 'Your kittens favorite place', 'price' => 75,50],
    ['Purrchitecture Palace' => 'Palace of kitties dreams', 'price' => 60],
    ['Climb-a-lot Condo' => 'Climb like a tiger', 'price' => 30],
    ['Whisker Haven Hideaway' => 'A cozy retreat', 'price' => 80],
    ['Catnap Nook Shelves' => 'Designed for the perfect catnap', 'price' => 30],
    ['Kitty Cloud Climb' => 'Soar among the clouds', 'price' => 110],
    ['Scratch-a-Sky Sanctuary' => 'Heavenly haven for scratching', 'price' => 90],
    ['Paw-some Wall Playland' => 'Turn your walls into an interactive playland', 'price' => 125,00],
    ['Feline Fortress Fixture' => 'Fortress of fun and comfort', 'price' => 25],
];

$totalValue = 0;

function validate()
{
    // TODO: This function will send a list of invalid fields back
    return [];
}

function handleForm()
{
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

// TODO: replace this if by an actual check for the form to be submitted
$formSubmitted = false;
if ($formSubmitted) {
    handleForm();
}

require 'form-view.php';