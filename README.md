# VibeTiger

VibeTiger: Your seamless VTiger CRM companion. Effortlessly manage customer relationships with our powerful PHP library. Simplify tasks, boost productivity, and elevate the customer experience. Say hello to seamless CRM integration!

## Installation

To use VibeTiger in your project, run the following command in your terminal:

```bash
composer install alirezajavadi/vibetiger
```

## Usage

To get started with VibeTiger, include it in your PHP script. Here's how you can interact with different modules:

### Examples

```php
//init
use VibeTiger\App\CRM;
require "vendor/autoload.php";

$vibeTiger = CRM::getInstance($yourEndPoint, $yourUserName, $YourAccessKey);
//
//1. Create a Document
$params =array(
    'example' => "test",
);
$vibeTiger::module("Documents")->operation("create")->params($params)->post();

//2. Update a Document
$vibeTiger::module("Documents")->operation("update")->params($element)->post();

//3. Query Contacts
$vibeTiger::module("Contacts")->operation("query")->get();

//4. Query a Specific User
$vibeTiger::module("Users")->operation("query")->where("id = 123x123")->get();

```
## Features

- Fluent interface to interact with various modules.
- Supports multiple operations including `create`, `query`, and `update`.
- Easy integration with existing PHP applications.

## Requirements

- PHP 7.4 or higher
- Composer

## Contributing

Contributions are welcome! Feel free to submit pull requests or create issues for bugs and feature requests.

## License

VibeTiger is open-sourced software licensed under the [MIT license](LICENSE).

## Support

If you encounter any problems or have any suggestions, please open an issue on the GitHub repository.
