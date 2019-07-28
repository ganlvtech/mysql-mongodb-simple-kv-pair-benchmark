# MySQL vs MongoDB simple k-v pair benchmark

## Prepare

Create MySQL table

```sql
CREATE TABLE `kv` (
	`k` CHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`v` MEDIUMBLOB NULL DEFAULT NULL,
	PRIMARY KEY (`k`) USING HASH
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=MyISAM
;
```

MongoDB collection index is automatically created in `mongodb_write.php` with the following code. 

```php
$collection->createIndex(['k' => 1], ['unique' => true]);
```

## Result

| Item | Value |
|:---|:---|
| MySQL Write | 25s / 20000 insert * 100000 bytes |
| MongoDB Write | 24.8s / 20000 insert * 100000 bytes |
| MySQL Read | 5.3s / 20000 select * 100000 bytes |
| MongoDB Read | 14.4s / 20000 find * 100000 bytes |

| Item | Value |
|:---|:---|
| MySQL Write | 20.6s / 200000 insert * 1000 bytes |
| MongoDB Write | 36.6s / 200000 insert * 1000 bytes |
| MySQL Read | 20.9s / 200000 select * 1000 bytes |
| MongoDB Read | 51.6s / 200000 find * 1000 bytes |

So, is RDBMS slow and NoSQL fast? Is there any problem in my test script?
