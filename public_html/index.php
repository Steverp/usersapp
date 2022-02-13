<?php

require_once '../bootstrap.php';
/**
 * @var $twig
 */
// Sample data
$foo = [
    [ 'name'          => 'Alice' ],
    [ 'name'          => 'Bob' ],
    [ 'name'          => 'Eve' ],
];

// Render our view
echo $twig->render('index.html.twig', ['foo' => $foo] );