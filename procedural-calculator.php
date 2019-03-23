<?php declare(strict_types=1);

if (php_sapi_name() !== "cli") {
    die('This script can be called only from the command line.' . PHP_EOL);
}

if (count($argv) <= 1) {
    die('You need to provide an operation!' . PHP_EOL);
}

function findOperator(string $input, array $allowedOperators): ?string {
    $result = null;

    foreach ($allowedOperators as $operator) {
        if (strpos($input, $operator)) {
            $result = $operator;
            break;
        }
    }

    return $result;
}

function add(int $a, int $b): int {
    return $a + $b;
}

function subtract(int $a, int $b): int {
    return $a - $b;
}

function multiply(int $a, int $b): int {
    return $a * $b;
}

function divide(int $a, int $b): float {
    return $a / $b;
}

$operation = $argv[1];

$allowedOperators = [
    '+',
    '-',
    '*',
    '/'
];

$operator = findOperator($operation, $allowedOperators);

if (null === $operator) {
    die('Unrecognized operand provided!' . PHP_EOL);
}

[$a, $b] = explode($operator, $operation);

if (!is_numeric($a) || !is_numeric($b)) {
    die('Provided arguments are not of type integer.' . PHP_EOL);
}

switch($operator) {
    case '+':
        $result = add((int)$a, (int)$b);
        break;
    case '-':
        $result = subtract((int)$a, (int)$b);
        break;
    case '*':
        $result = multiply((int)$a, (int)$b);
        break;
    case '/':
        $result = divide((int)$a, (int)$b);
        break;
}

printf('Result is: %s' . PHP_EOL, $result);