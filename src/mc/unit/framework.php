<?php

namespace mc\unit;

use \mc\unit\Unit;

/**
 * The unit test framework
 */
class Framework {
    /**
     * List of tests
     * @var array<Test>
     */
    private array $tests = [];
    /**
     * Total tests passed;
     * @var int
     */
    private $passed = 0;

    /**
     * Constructor
     */
    public function __construct() {
        $this->Reset();
        $this->scan_tests();
    }

    private static function method_has_attribute($methodReflection, $attributeName) {
        /** @var \ReflectionAttribute $attributes */
        $attributes = $methodReflection->getAttributes();
        foreach ($attributes as $attribute) {
            if ($attribute->getName() == $attributeName) {
                return true;
            }
        }
        return false;
    }

    /**
     * Scan tests, marked by @test annotation
     * @return void
     */
    private function scan_tests(): void {
        $functions = get_defined_functions();
        foreach($functions['user'] as $function){
            $reflection = new \ReflectionFunction($function);
            if(self::method_has_attribute($reflection, Unit::class)){
                $this->AddTest($function);
            }
        }
    }

    /**
     * Reset test results
     * @return void
     */
    public function Reset() {
        $this->passed = 0;
        Assert::Reset();
    }

    /**
     * Add a test
     * @param string $testName
     * @return void
     */
    public function AddTest(string $testName): void {
        $this->tests[$testName] = new Test($testName);
    }

    /**
     * Run a test
     * @param string $testName
     * @return void
     */
    public function RunTest($testName): void {
        if(empty($this->tests[$testName])){
            echo "[WARN] test {$testName} was not found." . PHP_EOL;
            return;
        }
        $this->tests[$testName]->Run();
        if($this->tests[$testName]->IsInvoked() && $this->tests[$testName]->IsPassed()) {
            ++ $this->passed;
        }
    }

    /**
     * Run all tests
     * @return void
     */
    public function Run(): void {
        echo "[INFO] Running tests..." . PHP_EOL;
        echo "[INFO] --------------------------------" . PHP_EOL;
        foreach($this->tests as $testName => $test){
            $this->RunTest($testName);
            echo "[INFO] --------------------------------" . PHP_EOL;
        }
        echo "[INFO] Tests completed." . PHP_EOL;
    }

    /**
     * Get number of tests
     * @return int
     */
    public function TotalTests(): int {
        return count($this->tests);
    }

    /**
     * Get number of tests passed
     * @return int
     */
    public function TotalPassed(): int {
        return $this->passed;
    }

    /**
     * Get number of tests failed
     * @return int
     */
    public function TotalFailed(): int {
        return $this->TotalTests() - $this->TotalPassed();
    }

    /**
     * Print test results
     * @return void
     */
    public function PrintInfo(): void {
        echo "=============== TESTS ================" . PHP_EOL;
        echo "total: {$this->TotalTests()}, passed: {$this->TotalPassed()}, failed: {$this->TotalFailed()}" . PHP_EOL;
        echo "============== ASSERTS ===============" . PHP_EOL;
        echo "total: " . Assert::Total() . ", passed: " . Assert::Passed() . ", failed: " . Assert::Failed() . PHP_EOL;
    }
}