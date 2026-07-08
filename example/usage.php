<?php
// include the mc-unit framework

include_once __DIR__ ."/../src/mc/unit/assert.php";
include_once __DIR__ ."/../src/mc/unit/unit.php";
include_once __DIR__ ."/../src/mc/unit/test.php";
include_once __DIR__ ."/../src/mc/unit/framework.php";

#[Unit]
function simple_test() {
    $result = true;
    
    $result = $result && Assert::Equal(1, 1);
    $result = $result && Assert::IsString("test");

    return $result;
}

#[Unit]
function simple_test2() {
    $result = true;
    
    $result = $result && Assert::IsEmpty([]);
    $result = $result && Assert::NotEmpty([1, 2, 3]);

    return $result;
}

$framework = new Framework();

$framework->Run();

$framework->PrintInfo();