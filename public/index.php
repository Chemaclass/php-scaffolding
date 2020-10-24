<?php

declare(strict_types=1);

use App\PhpScaffolding;

require dirname(__DIR__) . '/vendor/autoload.php';

$date = (new DateTimeImmutable())->format(DATE_ATOM);
$sum = PhpScaffolding::sum(1, 2, 3);
?>

<html>
    <head>
        <title><?php echo $date ?></title>
    </head>
    <body>
        <h1><?php echo $date ?></h1>
        <div>
            <?php echo $sum ?>
        </div>
    </body>
</html>
