<?php

namespace mc\unit;

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

    public function Reset() {
        $this->passed = 0;
        Assert::Reset();
    }

    public function AddTest(string $testName): void {
        $this->tests[$testName] = new Test($testName);
    }

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

    public function Run(): void {
        foreach($this->tests as $testName => $test){
            $this->RunTest($testName);
        }
    }

    public function TotalTests(): int {
        return count($this->tests);
    }

    public function TotalPassed(): int {
        return $this->passed;
    }

    public function TotalFailed(): int {
        return $this->TotalTests() - $this->TotalPassed();
    }

    public function PrintInfo(): void {
        echo "=============== TESTS ================" . PHP_EOL;
        echo "total: {$this->TotalTests()}, passed: {$this->TotalPassed()}, failed: {$this->TotalFailed()}" . PHP_EOL;
        echo "============== ASSERTS ===============" . PHP_EOL;
        echo "total: " . Assert::Total() . ", passed: " . Assert::Passed() . ", failed: " . Assert::Failed() . PHP_EOL;
    }
}