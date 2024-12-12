<?php

namespace mc\unit;

class Assert {
    private static $total_asserts = 0;
    private static $failed_asserts = 0;

    public static function Reset(): void {
        Assert::$failed_asserts = 0;
        Assert::$total_asserts = 0;
    }

    public static function Total(): int {
        return Assert::$total_asserts;
    }

    public static function Passed(): int {
        return Assert::Total() - Assert::Failed();
    }

    public static function Failed(): int {
        return Assert::$failed_asserts;
    }

    public static function True(bool $expression, string $pass = "PASS", string $fail = "FAIL"): bool {
        ++ Assert::$total_asserts;
        if($expression) {
            echo "[INFO] {$pass}" . PHP_EOL;
        }
        else {
            ++ Assert::$failed_asserts;
            echo "[WARN] {$fail}" . PHP_EOL;
        }
        return $expression;
    }

    public static function Equal($left, $right): bool {
        return Assert::True(
            $left == $right, 
            "PASS", 
            "FAIL, '" . Assert::dump($left) . "' != '" . Assert::dump($right) . "'");
    }

    public static function StrongEqual($left, $right): bool {
        return Assert::True(
            $left === $right, 
            "PASS", 
            "FAIL, '" . Assert::dump($left) . "' !== '" . Assert::dump($right) . "'");
    }

    public static function IsNull($param): bool {
        return Assert::True(
            $param == null, 
            "PASS", 
            "FAIL, '" . Assert::dump($param) . "' != null");
    }
    public static function IsEmpty($param): bool {
        return Assert::True(
            empty($param), 
            "PASS", 
            "FAIL, '" . Assert::dump($param) . "' is not empty");
    }

    private static function dump($var): string {
        return str_replace("\n", "", print_r($var, true));
    }
}