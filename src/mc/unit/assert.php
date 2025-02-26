<?php

namespace mc\unit;

/**
 * Assert class, used to perform unit tests.
 */
class Assert
{
    private static $total_asserts = 0;
    private static $failed_asserts = 0;

    /**
     * Reset the total and failed asserts.
     * @return void
     */
    public static function Reset(): void
    {
        Assert::$failed_asserts = 0;
        Assert::$total_asserts = 0;
    }

    /**
     * Get the total number of asserts.
     * @return int
     */
    public static function Total(): int
    {
        return Assert::$total_asserts;
    }

    /**
     * Get the number of passed asserts.
     * @return int
     */
    public static function Passed(): int
    {
        return Assert::Total() - Assert::Failed();
    }

    /**
     * Get the number of failed asserts.
     * @return int
     */
    public static function Failed(): int
    {
        return Assert::$failed_asserts;
    }

    /**
     * Assert that the given expression is true.
     * @param bool $expression The expression to evaluate.
     * @param string $pass The message to display if the expression is true.
     * @param string $fail The message to display if the expression is false.
     * @return bool
     */
    public static function True(bool $expression, string $pass = "PASS", string $fail = "FAIL"): bool
    {
        ++Assert::$total_asserts;
        if ($expression) {
            echo "[INFO] {$pass}" . PHP_EOL;
        } else {
            ++Assert::$failed_asserts;
            echo "[WARN] {$fail}" . PHP_EOL;
        }
        return $expression;
    }

    /**
     * Assert that the left and right expressions are equal.
     * @param mixed $left The left expression.
     * @param mixed $right The right expression.
     * @return bool
     */
    public static function Equal($left, $right): bool
    {
        return Assert::True(
            $left == $right,
            "PASS",
            "FAIL, '" . Assert::dump($left) . "' != '" . Assert::dump($right) . "'"
        );
    }

    /**
     * Assert that the left and right expressions are equal, and of the same type.
     * @param mixed $left The left expression.
     * @param mixed $right The right expression.
     * @return bool
     */
    public static function StrongEqual($left, $right): bool
    {
        return Assert::True(
            $left === $right,
            "PASS",
            "FAIL, '" . Assert::dump($left) . "' !== '" . Assert::dump($right) . "'"
        );
    }

    /**
     * Assert that the parameter is null.
     * @param mixed $param
     * @return bool
     */
    public static function IsNull($param): bool
    {
        return Assert::True(
            $param == null,
            "PASS",
            "FAIL, '" . Assert::dump($param) . "' != null"
        );
    }

    /**
     * Assert that the parameter is empty.
     * @param mixed $param
     * @return bool
     */
    public static function IsEmpty($param): bool
    {
        return Assert::True(
            empty($param),
            "PASS",
            "FAIL, '" . Assert::dump($param) . "' is not empty"
        );
    }

    private static function dump($var): string
    {
        if (is_array($var) || is_object($var)) {
            return json_encode($var, JSON_PRETTY_PRINT);
        }
        return (string) $var;
    }

    /**
     * Assert that the parameter is not null.
     * @param mixed $param
     * @return bool
     */
    public static function NotNull($param): bool
    {
        return Assert::True(
            $param != null,
            "PASS",
            "FAIL, '" . Assert::dump($param) . "' == null"
        );
    }

    /**
     * Assert that the parameter is not empty.
     * @param mixed $param
     * @return bool
     */
    public static function NotEmpty($param): bool
    {
        return Assert::True(
            !empty($param),
            "PASS",
            "FAIL, '" . Assert::dump($param) . "' is empty"
        );
    }

    /**
     * Assert that the parameter is an array.
     * @param mixed $param
     * @return bool
     */
    public static function IsArray($param): bool
    {
        return Assert::True(
            is_array($param),
            "PASS",
            "FAIL, '" . Assert::dump($param) . "' is not an array"
        );
    }

    /**
     * Assert that the parameter is a string.
     * @param mixed $param
     * @return bool
     */
    public static function IsString($param): bool
    {
        return Assert::True(
            is_string($param),
            "PASS",
            "FAIL, '" . Assert::dump($param) . "' is not a string"
        );
    }

    /**
     * Assert that the parameter is an integer.
     * @param mixed $param
     * @return bool
     */
    public static function IsInt($param): bool
    {
        return Assert::True(
            is_int($param),
            "PASS",
            "FAIL, '" . Assert::dump($param) . "' is not an integer"
        );
    }

    /**
     * Assert that the parameter is a float.
     * @param mixed $param
     * @return bool
     */
    public static function IsFloat($param): bool
    {
        return Assert::True(
            is_float($param),
            "PASS",
            "FAIL, '" . Assert::dump($param) . "' is not a float"
        );
    }
}
