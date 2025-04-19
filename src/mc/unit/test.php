<?php

namespace Mc\Unit;

/**
 * Test Wrapper
 */
class Test{
    private string $function = "";
    private bool $result = false;
    private bool $done = false;

    /**
     * Constructor, set the function name
     * @param string $function
     */
    public function __construct(string $function) {
        if(\function_exists($function)) {
            $this->function = $function;
        }
        else {
            echo "[WARN] function {$function} is not defined, test will be skipped." . PHP_EOL;
        }
    }

    /**
     * Run the test
     * @return bool
     */
    public function Run(): bool {
        $this->done = true;
        try {
            echo "[INFO] running test: `{$this->function}`" . PHP_EOL;
            $functionName = $this->function;
            $this->result = $functionName();
            echo "[INFO] test `{$this->function}` is " . ($this->result ? "passed" : "failed") . PHP_EOL;
        }
        catch(\Exception $e) {
            $this->result = false;
            echo "[WARN] test {$this->function} is failed with exception " . $e->getMessage() . PHP_EOL;
            return false;
        }
        return $this->result;
    }

    /**
     * Get the test result
     * @return bool
     */
    public function IsPassed(): bool {
        return $this->result;
    }
    
    /**
     * Check if the test is invoked
     * @return bool
     */
    public function IsInvoked(): bool {
        return $this->done;
    }
}