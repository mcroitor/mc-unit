<?php

namespace mc\unit;

class Test{
    private string $function = "";
    private bool $result = false;
    private bool $done = false;

    public function __construct(string $function) {
        if(\function_exists($function)) {
            $this->function = $function;
        }
        else {
            echo "[WARN] function {$function} is not defined, test will be skipped." . PHP_EOL;
        }
    }

    public function Run(): bool {
        $this->done = true;
        try {
            $functionName = $this->function;
            $this->result = $functionName();
        }
        catch(\Exception $e) {
            $this->result = false;
            echo "[WARN] test {$this->function} is failed with exception " . $e->getMessage() . PHP_EOL;
            return false;
        }
        return $this->result;
    }

    public function IsPassed(): bool {
        return $this->result;
    }
    
    public function IsInvoked(): bool {
        return $this->done;
    }
}