# mc-unit

Simple PHP unit test framework.

## Usage

### Direct test inclusion

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

### Attribute test inclusion

```php
// include the mc-unit framework

use mc\unit\Unit;
use mc\unit\Assert;
use mc\unit\Test;
use mc\unit\Framework;

#[Unit]
function simple_test() {
    Assert::Equal(1, 1);
}

#[Unit]
function simple_test2() {
    Assert::IsEmpty([]);
}

$framework = new Framework();

$framework->Run();

$framework->PrintInfo();
```
