# mc-unit

Simple PHP unit test framework.

## Usage

### Direct test inclusion

```php
// include the mc-unit framework

use Mc\Unit\Assert;
use Mc\Unit\Test;
use Mc\Unit\Framework;

// test function
function simple_test() {
    Assert::Equal(1, 1);

    return Assert::Passed() === Assert::Total();
}

$framework = new Framework();

$framework->AddTest("simple_test");

$framework->Run();

$framework->PrintInfo();
```

### Attribute test inclusion

```php
// include the mc-unit framework

use Mc\Unit\Unit;
use Mc\Unit\Assert;
use Mc\Unit\Framework;

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
```
