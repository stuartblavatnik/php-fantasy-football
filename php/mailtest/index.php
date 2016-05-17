<?
    $to = "stuartb@twoforboth.com";
    $subject = "Testing from PHP";
    $message = "Hello out there....";
    $from = "whoever@whereever.com";
    $replyTo = "$from";

    $fullFrom = "From: $from\r\n";
    $fullReplyTo = "Reply-to: $replyTo\r\n";

    $otherArgs = $fullFrom . $fullReplyTo;

    mail($to, $subject, $message, $otherArgs);
?>