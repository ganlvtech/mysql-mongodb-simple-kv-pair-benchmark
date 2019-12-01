# MySQL vs MongoDB simple k-v pair benchmark

## Prepare

Create MySQL table

```sql
CREATE TABLE `kv` (
	`k` CHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`v` MEDIUMBLOB NULL DEFAULT NULL,
	PRIMARY KEY (`k`)
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

I could also test using InnoDB with auto commit disabled (`SET AUTOCOMMIT=0;`). It got same time like MyISAM. When auto commit enabled. It costs 30 times time as the former one. 7.2s for 2000 insert * 1000 bytes.

MySQL is really fast if you use bulk insert or `SET AUTOCOMMIT=0` before insert. (`BEGIN TRANSACTION` and `COMMIT` is same as `autocommit=0`) You cannot say that MySQL is slow than MongoDB generally. But you can say that under specific circumstances. What's more. You can optimize you MySQL database schema to get similar performance like MongoDB or even better.
