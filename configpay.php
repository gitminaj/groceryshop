<?php
    require('stripe-php-master/init.php');

    $secretKey= "sk_test_51Laf0vSEljY4dYizskaasZJFUfqtXtGdVOFu07VDYyTcwD28tprmJgB7YhGCsiDyLUr5J7uI6hzQC0uCCUaPhLrm00rApMN0Im";
    $publishableKey = "pk_test_51Laf0vSEljY4dYizJ63PUoj5QUI6wiMIDmJNsTXlBVassNEmaXjT49UHmhgikMTvqwWEx0JuRE2YEcbRUN3gjHTu00J5qqhsQK";
    
    
    \Stripe\Stripe::setApiKey($secretKey);
?>