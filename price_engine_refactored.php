<!--
Behzad Ghabaei 
CS 85 - PHP
Module 2A 
Instructor Seno 
6/25/2026
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>T-Shirt Price Engine</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f6f8; color: #333; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .receipt { background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 400px; border-top: 5px solid #005a9c; }
        h1 { text-align: center; color: #005a9c; }
        ul { list-style: none; padding: 0; }
        li { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee; }
        .total { font-size: 1.5em; color: #28a745; }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Order Summary</h1>
        <?php
            // --- Configuration: Change these values to test all business rules! ---
            $size = 'XL'; // Options: 'S', 'M', 'L', 'XL'
            $color = 'Sunset Orange'; // Any string, but test with 'Sunset Orange' or 'Ocean Blue'
            $isCustomized = true; // Options: true, false
            $customerFirstName = 'Behzzzzzad'; // <-- IMPORTANT: REPLACE WITH YOUR ACTUAL FIRST NAME

            // --- Part A: Implement the logic below using ONLY simple, nested if-statements ---
            $finalPrice = 22.50;  //this can be removed.
            $details = "<li>Base Price: <span>$" . number_format($finalPrice, 2) . "</span></li>";

            // Your nested if-statement logic goes here...
            // Example of a rule:
            // if ($size == 'L') {
            //     $finalPrice = $finalPrice + 1.75;
            //     $details .= "<li>Size (L) Upcharge: <span>+$1.75</span></li>";
            // }

// --- Part B: Refactored Logic using compound operators and elseif ---
$finalPrice = 22.50;
$details = "<li>Base Price: <span>$" . number_format($finalPrice, 2) . "</span></li>";

// 1. Refactored Size Upcharges. Curly braces used after condition.
if ($size == 'L') {
    $finalPrice += 1.75;
    $details .= "<li>Size (L) Upcharge: <span>+$1.75</span></li>";
} elseif ($size == 'XL') {
    $finalPrice += 2.50;
    $details .= "<li>Size (XL) Upcharge: <span>+$2.50</span></li>";
}

// 2. Refactored Premium Color Upcharge (Using OR operator).  OR -> T = F || T.
// <li> indicate HTML list tags to display.
if ($color == 'Sunset Orange' || $color == 'Ocean Blue') {
    $finalPrice += 2.00;
    $details .= "<li>Premium Color ($color) Upcharge: <span>+$2.00</span></li>";
}

// 3. Refactored Customization Rules (Using AND operator to flatten code)
// additional charge for custom handling T -> T && T.
if ($isCustomized) {
    $finalPrice += 5.00;
    $details .= "<li>Custom Text Fee: <span>+$5.00</span></li>";
}
if ($isCustomized && $size == 'XL') {
    $finalPrice += 3.00;
    $details .= "<li>XL Custom Handling Fee: <span>+$3.00</span></li>";
}

// 4. Personalized Discount
// Testing on short names and longer names. 
if (strlen($customerFirstName) > 6) {
    $finalPrice -= 1.00;
    $details .= "<li>Long Name Discount: <span>-$1.00</span></li>";
}

/* MY DEBUGGING LOG:
Problem: In Part A, avoiding compound operators meant I had to nest the XL check inside the customization check. Initially, I accidentally put the baseline $5.00 custom text fee inside the XL block, which meant standard shirts weren't getting charged the base custom fee.
Solution: I carefully traced the brackets to ensure the $5.00 fee executed immediately when $isCustomized was true, while the extra $3.00 was deeply nested to only hit XL sizes. In Part B, using the '&&' operator completely eliminated this nesting confusion.

Problem: Initially I could not find the path to this file. I included additional code in the
web.php file to display the price_engine.php code in the browser.
Solution: Route::get('/module2a/price_engine_refactored.php', function () {
require base_path('module2a/price_engine_refactored.php');
});
This code redirected Herd to change paths from "routes/web.php" to
"module2a/price_engine_refactored.php"
Example rule was really helpful to write the rat of the conditions.
*/
            // --- DO NOT EDIT BELOW THIS LINE ---
            echo "<ul>" . $details . "</ul>";
            echo "<ul><li><span class='total'>Final Price:</span> <span class='total'>$" . number_format($finalPrice, 2) . "</span></li></ul>";

        ?>
    </div>
</body>
</html>
