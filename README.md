# mc-unit

Simple PHP unit test framework.

## Usage

```php
// include the mc-unit framework

use mc\unit\Assert;
use mc\unit\Test;
use mc\unit\Framework;

// test function
function simple_test() {
    Assert::Equal(1, 1);
}

$framework = new Framework();

$framework->AddTest("simple_test");

$framework->Run();

$framework->PrintInfo();
```
