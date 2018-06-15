# PHP Query Builder

## Description

Foundry is a simple yet powerful SQL query builder written in PHP.

## Documentation

- [Create a db connection](doc/connection.md)
- [Build a SELECT query](doc/builder/select.md)
- [Build an INSERT query](doc/builder/insert.md)
- [Build a DELETE query](doc/builder/insert.md)
- [Build an UPDATE query](doc/builder/insert.md)
- [Execute the queries](doc/queries.md)

## Usage Example

Initialization:

```php
use Foundry\Connection;

$connection = new Connection(['dsn' => 'sqlite:db.sqlite']);
```

Select:

```php
use Foundry\Builder\Parameter;

$select = $connection
    ->select()
    ->from(['t' => 'transactions'])
    ->join(['a' => 'accounts'], 'a.account_id = t.account_id')
    ->where('a.name', 'like', new Parameter('name'))
    ->orWhere('a.balance', 'between', [0, 1000])
    ->order('t.date desc');

$statement = $connection->query($select, [':name' => '%stock%']);
$rows = $statement->fetchAll();
```

Insert:

```php
$query = $connection
    ->insert()
    ->ignore()
    ->into('accounts')
    ->columns(['name', 'balance'])
    ->values(['Account 1', 0]);

$connection->query($query);
```

Update:

```php
$query = $connection
    ->update()
    ->table('accounts')
    ->values(['name' => 'Account 5'])
    ->where('name', '=', 'Account 1');

$connection->query($query);
```

Delete:

```php
$query = $connection
    ->delete()
    ->from('accounts')
    ->where('name', '=', 'Account 1');

$connection->query($query);
```
