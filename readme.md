## Sql Query Builder examples
* [Select](#select)
* [Select(Alias Column)](#selectalias-column)
* [Select+Where+Like](#selectwherelike)
* [Select+Where+Not Like](#selectwherenot-like)
* [Select+Where+Where 1](#selectwherewhere-1)
* [Select+Where+Where 2](#selectwherewhere-2)
* [Select+Where+=Null](#selectwherenull)
* [Select+Where+Null](#selectwherenull)
* [Select+Where+NotNull](#selectwherenotnull)
* [Select+Where+Between](#selectwherebetween)
* [Select+Where+Not Between](#selectwherenot-between)
* [Select+Join+Inner](#selectjoininner)
* [Select+Join+Left](#selectjoinleft)
* [Select+Join+Right](#selectjoinright)
* [Select+Join(3)](#selectjoin3)
* [Select+Join+OrderBy 1](#selectjoinorderby-1)
* [Select+Join+OrderBy 2](#selectjoinorderby-2)
* [Select+Sum](#selectsum)
* [Select+Sum(Alias Column)](#selectsumalias-column)
* [Select+Limit 1](#selectlimit-1)
* [Select+Limit 2](#selectlimit-2)
* [Select+Distinct](#selectdistinct)
* [Select+OrderBy](#selectorderby)
* [Select+GroupBy](#selectgroupby)
* [Select+Having](#selecthaving)
* [Select+Having+Between](#selecthavingbetween)
* [Select+Having+Not Between](#selecthavingnot-between)
* [Select+In(Array)](#selectinarray)
* [Select+In(Select)](#selectinselect)
* [Select+In(Select)+MultiColumns](#selectinselectmulticolumns)
* [Select+In(Select)+Function](#selectinselectfunction)
* [Select+In(Select)+Context.Name](#selectinselectcontextname)
* [Insert+Values(Array)](#insertvaluesarray)
* [Insert+Values(Closure)](#insertvaluesclosure)
* [Delete](#delete)
* [Delete+In(Array)](#deleteinarray)
* [Update](#update)
* [Select+Pagination](#selectpagination)

---
### Select
```php
$builder->select(User::class)->get();
```
#### mysql
```sql
SELECT
    `U`.`id`,
    `U`.`name`,
    `U`.`age`,
    `U`.`role`
FROM
    `shasoft-dbschemadev-table-user` `U`
```
#### pgsql
```sql
SELECT
    "U"."id",
    "U"."name",
    "U"."age",
    "U"."role"
FROM
    "shasoft-dbschemadev-table-user" "U"
```


---
### Select(Alias Column)
```php
$builder
    ->select(User::class, [
        'id',
        'name' => 'asName',
        'age as asAge',
        'role As asRole'
    ])
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`id`,
    `U`.`name` AS `asName`,
    `U`.`age` AS `asAge`,
    `U`.`role` AS `asRole`
FROM
    `shasoft-dbschemadev-table-user` `U`
```
#### pgsql
```sql
SELECT
    "U"."id",
    "U"."name" AS "asName",
    "U"."age" AS "asAge",
    "U"."role" AS "asRole"
FROM
    "shasoft-dbschemadev-table-user" "U"
```


---
### Select+Where+Like
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where): void {
        $where
            ->like('name', 'I%');
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    `U`.`name` LIKE 'I%'
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    "U"."name" LIKE 'I%'
```


---
### Select+Where+Not Like
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where): void {
        $where
            ->notLike('name', 'I%');
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    `U`.`name` NOT LIKE 'I%'
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    "U"."name" NOT LIKE 'I%'
```


---
### Select+Where+Where 1
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where): void {
        $where
            ->or()
            ->cond('id', '=', 4)
            ->cond('id', '=', 5)
            ->where(function (Where $where) {
                $where
                    ->and()
                    ->cond('id', '>', 3)
                    ->cond('id', '<', 6);
            });
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    (
        `U`.`id` = 4 OR `U`.`id` = 5 OR(`U`.`id` > 3 AND `U`.`id` < 6)
    )
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    (
        "U"."id" = 4 OR "U"."id" = 5 OR("U"."id" > 3 AND "U"."id" < 6)
    )
```


---
### Select+Where+Where 2
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where): void {
        $where
            ->and()
            ->cond('id', '=', 4)
            ->cond('id', '=', 5)
            ->where(function (Where $where) {
                $where
                    ->or()
                    ->cond('id', '>', 3)
                    ->cond('id', '<', 6);
            });
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    (
        `U`.`id` = 4 AND `U`.`id` = 5 AND(`U`.`id` > 3 OR `U`.`id` < 6)
    )
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    (
        "U"."id" = 4 AND "U"."id" = 5 AND("U"."id" > 3 OR "U"."id" < 6)
    )
```


---
### Select+Where+=Null
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where): void {
        $where
            ->or()
            ->cond('id', '=', null);
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    `U`.`id` = NULL
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    "U"."id" = NULL
```


---
### Select+Where+Null
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where): void {
        $where
            ->or()
            ->cond('id', '=', 4)
            ->null('name');
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    (`U`.`id` = 4 OR `U`.`name` IS NULL)
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    ("U"."id" = 4 OR "U"."name" IS NULL)
```


---
### Select+Where+NotNull
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where): void {
        $where
            ->or()
            ->cond('id', '=', 4)
            ->notNull('name');
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    (`U`.`id` = 4 OR `U`.`name` IS NOT NULL)
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    ("U"."id" = 4 OR "U"."name" IS NOT NULL)
```


---
### Select+Where+Between
```php
$builder
    ->select(Article::class, ['id'])
    ->where(function (Where $where): void {
        $where
            ->between('id', 2, 7);
    })
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`id`
FROM
    `shasoft-dbschemadev-table-article` `A`
WHERE
    `A`.`id` BETWEEN 2 AND 7
```
#### pgsql
```sql
SELECT
    "A"."id"
FROM
    "shasoft-dbschemadev-table-article" "A"
WHERE
    "A"."id" BETWEEN 2 AND 7
```


---
### Select+Where+Not Between
```php
$builder
    ->select(Article::class, ['id'])
    ->where(function (Where $where): void {
        $where
            ->notBetween('id', 2, 7);
    })
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`id`
FROM
    `shasoft-dbschemadev-table-article` `A`
WHERE
    `A`.`id` BETWEEN 2 AND 7
```
#### pgsql
```sql
SELECT
    "A"."id"
FROM
    "shasoft-dbschemadev-table-article" "A"
WHERE
    "A"."id" BETWEEN 2 AND 7
```


---
### Select+Join+Inner
```php
$builder
    ->select(Article::class, ['title'])
    ->join(function (Join $join): void {
        // Соединение с таблицей User
        $join
            ->inner(User::class, ['id' => 'userId'], ['name'])
            ->where(function (Where $where) {
                $where->cond('id', '>', 3);
            });
    })
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`title`,
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-article` `A`
INNER JOIN `shasoft-dbschemadev-table-user` `U` ON
    `U`.`id` = `A`.`userId`
WHERE
    `U`.`id` > 3
```
#### pgsql
```sql
SELECT
    "A"."title",
    "U"."name"
FROM
    "shasoft-dbschemadev-table-article" "A"
INNER JOIN "shasoft-dbschemadev-table-user" "U" ON
    "U"."id" = "A"."userId"
WHERE
    "U"."id" > 3
```


---
### Select+Join+Left
```php
$builder
    ->select(Article::class, ['title'])
    ->join(function (Join $join): void {
        // Соединение с таблицей User
        $join
            ->left(User::class, ['id' => 'userId'], ['name'])
            ->where(function (Where $where) {
                $where->cond('id', '>', 3);
            });
    })
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`title`,
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-article` `A`
LEFT JOIN `shasoft-dbschemadev-table-user` `U` ON
    `U`.`id` = `A`.`userId`
WHERE
    `U`.`id` > 3
```
#### pgsql
```sql
SELECT
    "A"."title",
    "U"."name"
FROM
    "shasoft-dbschemadev-table-article" "A"
LEFT JOIN "shasoft-dbschemadev-table-user" "U" ON
    "U"."id" = "A"."userId"
WHERE
    "U"."id" > 3
```


---
### Select+Join+Right
```php
$builder
    ->select(Article::class, ['title'])
    ->join(function (Join $join): void {
        // Соединение с таблицей User
        $join
            ->right(User::class, ['id' => 'userId'], ['name'])
            ->where(function (Where $where) {
                $where->cond('id', '>', 3);
            });
    })
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`title`,
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-article` `A`
RIGHT JOIN `shasoft-dbschemadev-table-user` `U` ON
    `U`.`id` = `A`.`userId`
WHERE
    `U`.`id` > 3
```
#### pgsql
```sql
SELECT
    "A"."title",
    "U"."name"
FROM
    "shasoft-dbschemadev-table-article" "A"
RIGHT JOIN "shasoft-dbschemadev-table-user" "U" ON
    "U"."id" = "A"."userId"
WHERE
    "U"."id" > 3
```


---
### Select+Join(3)
```php
$builder
    ->select(Article::class, ['title'])
    ->where(function (Where $where): void {
        $where->cond('id', '=', 4)->cond('id', '=', 5);
    })
    ->join(function (Join $join): void {
        // Соединение с таблицей User
        $joinUser = $join
            ->left(User::class, ['id' => 'userId'], ['name'])
            ->where(function (Where $where) {
                $where->cond('id', '>', 3);
            });
        // Соединение таблицы User из соединения выше с таблицей User
        $joinUser
            ->left(User::class, ['id' => 'id'], ['name' => 'name2'])
            ->where(function (Where $where) {
                $where->cond('id', '!=', 33);
            });
        // Соединение с таблицей UserInfo
        $join
            ->left(UserInfo::class, ['id' => $joinUser->column('id')])
            ->where(function (Where $where) {
                $where->cond('id', '!=', 7);
            });
    })
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`title`,
    `U`.`name`,
    `B`.`name` AS `name2`,
    `C`.`id`,
    `C`.`description`,
    `C`.`userId`
FROM
    `shasoft-dbschemadev-table-article` `A`
LEFT JOIN `shasoft-dbschemadev-table-user` `U` ON
    `U`.`id` = `A`.`userId`
LEFT JOIN `shasoft-dbschemadev-table-user` `B` ON
    `B`.`id` = `U`.`id`
LEFT JOIN `shasoft-dbschemadev-table-userinfo` `C` ON
    `C`.`id` = `U`.`id`
WHERE
    (
        `A`.`id` = 4 AND `A`.`id` = 5 AND `U`.`id` > 3 AND `B`.`id` != 33 AND `C`.`id` != 7
    )
```
#### pgsql
```sql
SELECT
    "A"."title",
    "U"."name",
    "B"."name" AS "name2",
    "C"."id",
    "C"."description",
    "C"."userId"
FROM
    "shasoft-dbschemadev-table-article" "A"
LEFT JOIN "shasoft-dbschemadev-table-user" "U" ON
    "U"."id" = "A"."userId"
LEFT JOIN "shasoft-dbschemadev-table-user" "B" ON
    "B"."id" = "U"."id"
LEFT JOIN "shasoft-dbschemadev-table-userinfo" "C" ON
    "C"."id" = "U"."id"
WHERE
    (
        "A"."id" = 4 AND "A"."id" = 5 AND "U"."id" > 3 AND "B"."id" != 33 AND "C"."id" != 7
    )
```


---
### Select+Join+OrderBy 1
```php
$builder
    ->select(Article::class, ['title'])
    ->where(function (Where $where): void {
        $where->cond('id', '=', 4)->cond('id', '=', 5);
    })
    ->join(function (Join $join): void {
        // Соединение с таблицей User
        $join
            ->left(User::class, ['id' => 'userId'], ['name'])
            ->where(function (Where $where) {
                $where->cond('id', '>', 3);
            })
            ->orderBy('id');
    })
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`title`,
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-article` `A`
LEFT JOIN `shasoft-dbschemadev-table-user` `U` ON
    `U`.`id` = `A`.`userId`
WHERE
    (
        `A`.`id` = 4 AND `A`.`id` = 5 AND `U`.`id` > 3
    )
ORDER BY
    `U`.`id` ASC
```
#### pgsql
```sql
SELECT
    "A"."title",
    "U"."name"
FROM
    "shasoft-dbschemadev-table-article" "A"
LEFT JOIN "shasoft-dbschemadev-table-user" "U" ON
    "U"."id" = "A"."userId"
WHERE
    (
        "A"."id" = 4 AND "A"."id" = 5 AND "U"."id" > 3
    )
ORDER BY
    "U"."id" ASC
```


---
### Select+Join+OrderBy 2
```php
$select = $builder
    ->select(Article::class, ['title'])
    ->name('article');
$select
    ->where(function (Where $where): void {
        $where->cond('id', '=', 4)->cond('id', '=', 5);
    })
    ->join(function (Join $join): void {
        // Соединение с таблицей User
        $join
            ->left(User::class, ['id' => 'userId'], ['name'])
            ->name('user')
            ->where(function (Where $where) {
                $where
                    // Добавим условия по полю 
                    // из сохраненного контекста article
                    ->cond(
                        $where->column('id', 'article'),
                        '=',
                        7
                    )
                    ->cond(
                        'id',
                        '=',
                        $where->column('id', 'article')
                    );
            });
    })
    // Добавить сортировку по полю 
    // сохраненного именованного контекста user
    ->orderBy($select->column('id', 'user'))
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`title`,
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-article` `A`
LEFT JOIN `shasoft-dbschemadev-table-user` `U` ON
    `U`.`id` = `A`.`userId`
WHERE
    (
        `A`.`id` = 4 AND `A`.`id` = 5 AND(`A`.`id` = 7 AND `U`.`id` = `A`.`id`)
    )
ORDER BY
    `U`.`id` ASC
```
#### pgsql
```sql
SELECT
    "A"."title",
    "U"."name"
FROM
    "shasoft-dbschemadev-table-article" "A"
LEFT JOIN "shasoft-dbschemadev-table-user" "U" ON
    "U"."id" = "A"."userId"
WHERE
    (
        "A"."id" = 4 AND "A"."id" = 5 AND("A"."id" = 7 AND "U"."id" = "A"."id")
    )
ORDER BY
    "U"."id" ASC
```


---
### Select+Sum
```php
$builder
    ->select(User::class, ['sum(age)'])
    ->where(function (Where $where): void {
        $where->or()->cond('id', '=', 4)->cond('id', '=', 5);
    })
    ->get();
```
#### mysql
```sql
SELECT
    SUM(`U`.`age`) AS `sum(age)`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    (`U`.`id` = 4 OR `U`.`id` = 5)
```
#### pgsql
```sql
SELECT
    SUM("U"."age") AS "sum(age)"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    ("U"."id" = 4 OR "U"."id" = 5)
```


---
### Select+Sum(Alias Column)
```php
$builder
    ->select(User::class, [
        'sum(age) as sumAge',
        'avg(age)' => 'avgAge'
    ])
    ->where(function (Where $where): void {
        $where->or()->cond('id', '=', 4)->cond('id', '=', 5);
    })
    ->get();
```
#### mysql
```sql
SELECT
    SUM(`U`.`age`) AS `sumAge`,
    AVG(`U`.`age`) AS `avgAge`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    (`U`.`id` = 4 OR `U`.`id` = 5)
```
#### pgsql
```sql
SELECT
    SUM("U"."age") AS "sumAge",
    AVG("U"."age") AS "avgAge"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    ("U"."id" = 4 OR "U"."id" = 5)
```


---
### Select+Limit 1
```php
$builder
    ->select(User::class, ['id', 'name'])
    ->limit(10, 5)
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`id`,
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
LIMIT 10 OFFSET 5
```
#### pgsql
```sql
SELECT
    "U"."id",
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
LIMIT 10 OFFSET 5
```


---
### Select+Limit 2
```php
$builder
    ->select(User::class, ['id', 'name'])
    ->limit(9)
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`id`,
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
LIMIT 9
```
#### pgsql
```sql
SELECT
    "U"."id",
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
LIMIT 9
```


---
### Select+Distinct
```php
$builder
    ->select(Article::class, ['userId'])
    ->Distinct()
    ->get();
```
#### mysql
```sql
SELECT DISTINCT
    `A`.`userId`
FROM
    `shasoft-dbschemadev-table-article` `A`
```
#### pgsql
```sql
SELECT DISTINCT
    "A"."userId"
FROM
    "shasoft-dbschemadev-table-article" "A"
```


---
### Select+OrderBy
```php
$builder
    ->select(User::class, ['id', 'name'])
    ->OrderBy('id', false)
    ->OrderBy('name', true)
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`id`,
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
ORDER BY
    `U`.`id`
DESC
    ,
    `U`.`name` ASC
```
#### pgsql
```sql
SELECT
    "U"."id",
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
ORDER BY
    "U"."id"
DESC
    ,
    "U"."name" ASC
```


---
### Select+GroupBy
```php
$builder
    ->select(Article::class, ['userId'])
    ->GroupBy('userId')
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`userId`
FROM
    `shasoft-dbschemadev-table-article` `A`
GROUP BY
    `A`.`userId`
```
#### pgsql
```sql
SELECT
    "A"."userId"
FROM
    "shasoft-dbschemadev-table-article" "A"
GROUP BY
    "A"."userId"
```


---
### Select+Having
```php
$builder
    ->select(Article::class, ['userId', 'count(userId)' => 'cnt'])
    ->GroupBy('userId')
    ->Having('count(userId)', '>', 1)
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`userId`,
    COUNT(`A`.`userId`) AS `cnt`
FROM
    `shasoft-dbschemadev-table-article` `A`
GROUP BY
    `A`.`userId`
HAVING
    COUNT(`A`.`userId`) > 1
```
#### pgsql
```sql
SELECT
    "A"."userId",
    COUNT("A"."userId") AS "cnt"
FROM
    "shasoft-dbschemadev-table-article" "A"
GROUP BY
    "A"."userId"
HAVING
    COUNT("A"."userId") > 1
```


---
### Select+Having+Between
```php
$builder
    ->select(Article::class, ['userId', 'count(userId)' => 'cnt'])
    ->GroupBy('userId')
    ->Having('count(userId)', 'between', [2, 5])
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`userId`,
    COUNT(`A`.`userId`) AS `cnt`
FROM
    `shasoft-dbschemadev-table-article` `A`
GROUP BY
    `A`.`userId`
HAVING
    COUNT(`A`.`userId`) BETWEEN 2 AND 5
```
#### pgsql
```sql
SELECT
    "A"."userId",
    COUNT("A"."userId") AS "cnt"
FROM
    "shasoft-dbschemadev-table-article" "A"
GROUP BY
    "A"."userId"
HAVING
    COUNT("A"."userId") BETWEEN 2 AND 5
```


---
### Select+Having+Not Between
```php
$builder
    ->select(Article::class, ['userId', 'count(userId)' => 'cnt'])
    ->GroupBy('userId')
    ->Having('count(userId)', '   not    between  ', [2, 5])
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`userId`,
    COUNT(`A`.`userId`) AS `cnt`
FROM
    `shasoft-dbschemadev-table-article` `A`
GROUP BY
    `A`.`userId`
HAVING
    COUNT(`A`.`userId`) NOT BETWEEN 2 AND 5
```
#### pgsql
```sql
SELECT
    "A"."userId",
    COUNT("A"."userId") AS "cnt"
FROM
    "shasoft-dbschemadev-table-article" "A"
GROUP BY
    "A"."userId"
HAVING
    COUNT("A"."userId") NOT BETWEEN 2 AND 5
```


---
### Select+In(Array)
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where) {
        $where->inArray('id', [3, 4]);
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    `U`.`id` IN(3, 4)
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    "U"."id" IN(3, 4)
```


---
### Select+In(Select)
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where) {
        $where->inSelect('id', Article::class, 'userId', function (Select $select) {
            $select
                ->where(function (Where $where) {
                    $where->cond('id', '=', 3);
                });
        });
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    `U`.`id` IN(
    SELECT
        `A`.`userId`
    FROM
        `shasoft-dbschemadev-table-article` `A`
    WHERE
        `A`.`id` = 3
)
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    "U"."id" IN(
    SELECT
        "A"."userId"
    FROM
        "shasoft-dbschemadev-table-article" "A"
    WHERE
        "A"."id" = 3
)
```


---
### Select+In(Select)+MultiColumns
```php
$builder
    ->select(User::class, ['name'])
    ->where(function (Where $where) {
        $where->inSelect(
            ['id', 'name'],
            Article::class,
            ['userId', 'title'],
            function (Select $select) {
                $select
                    ->where(function (Where $where) {
                        $where->cond('id', '=', 2);
                    });
            }
        );
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    (`U`.`id`, `U`.`name`) IN(
    SELECT
        `A`.`userId`,
        `A`.`title`
    FROM
        `shasoft-dbschemadev-table-article` `A`
    WHERE
        `A`.`id` = 2
)
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    ("U"."id", "U"."name") IN(
    SELECT
        "A"."userId",
        "A"."title"
    FROM
        "shasoft-dbschemadev-table-article" "A"
    WHERE
        "A"."id" = 2
)
```


---
### Select+In(Select)+Function
```php
$builder
    ->select(Article::class, ['id', 'userId'])
    ->where(function (Where $where) {
        $where->inSelect('userId', Article::class, 'min(userId)');
    })
    ->get();
```
#### mysql
```sql
SELECT
    `A`.`id`,
    `A`.`userId`
FROM
    `shasoft-dbschemadev-table-article` `A`
WHERE
    `A`.`userId` IN(
    SELECT
        MIN(`B`.`userId`) AS `min(userId)`
    FROM
        `shasoft-dbschemadev-table-article` `B`
)
```
#### pgsql
```sql
SELECT
    "A"."id",
    "A"."userId"
FROM
    "shasoft-dbschemadev-table-article" "A"
WHERE
    "A"."userId" IN(
    SELECT
        MIN("B"."userId") AS "min(userId)"
    FROM
        "shasoft-dbschemadev-table-article" "B"
)
```


---
### Select+In(Select)+Context.Name
```php
$builder->select(User::class, ['name'])
    ->name('main')
    ->where(function (Where $where) {
        $where->inSelect('id', Article::class, 'userId', function (Select $select) {
            $select
                ->where(function (Where $where) {
                    $where->cond('id', '=', $where->column('id', 'main'));
                });
        });
    })
    ->get();
```
#### mysql
```sql
SELECT
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    `U`.`id` IN(
    SELECT
        `A`.`userId`
    FROM
        `shasoft-dbschemadev-table-article` `A`
    WHERE
        `A`.`id` = `U`.`id`
)
```
#### pgsql
```sql
SELECT
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    "U"."id" IN(
    SELECT
        "A"."userId"
    FROM
        "shasoft-dbschemadev-table-article" "A"
    WHERE
        "A"."id" = "U"."id"
)
```


---
### Insert+Values(Array)
```php
$builder
    ->insert(User::class)
    ->values([
        'name' => 'Igor',
        'age' => ColumnInteger::random(18, 88),
        'role' => 'Moderator'
    ])
    ->exec();
```
#### mysql
```sql
INSERT INTO `shasoft-dbschemadev-table-user`(`name`, `age`, `role`)
VALUES('Igor', 30, 'Moderator')
```
#### pgsql
```sql
INSERT INTO "shasoft-dbschemadev-table-user"("name", "age", "role")
VALUES('Igor', 27, 'Moderator')
```


---
### Insert+Values(Closure)
```php
$builder
    ->insert(User::class)
    ->values(function (Values $values) {
        $values->value('name', 'Alex');
        $values->valueSelect('age', User::class, 'id', function (Select $select) {
            $select->where(function (Where $where) {
                $where->cond('id', '=', 8);
            });
        });
        $values->value('role', 'Vip');
    })
    ->exec();
```
#### mysql
```sql
INSERT INTO `shasoft-dbschemadev-table-user`(`name`, `age`, `role`)
VALUES(
    'Alex',
    (
    SELECT
        `A`.`id`
    FROM
        `shasoft-dbschemadev-table-user` `A`
    WHERE
        `A`.`id` = 8
),
'Vip'
)
```
#### pgsql
```sql
INSERT INTO "shasoft-dbschemadev-table-user"("name", "age", "role")
VALUES(
    'Alex',
    (
    SELECT
        "A"."id"
    FROM
        "shasoft-dbschemadev-table-user" "A"
    WHERE
        "A"."id" = 8
),
'Vip'
)
```


---
### Delete
```php
$builder
    ->delete(User::class)
    ->where(function (Where $where) {
        $where->cond('id', '>', 3);
    })
    ->exec();
```
#### mysql
```sql
DELETE
    `U`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    `U`.`id` > 3
```
#### pgsql
```sql
DELETE
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    "U"."id" > 3
```


---
### Delete+In(Array)
```php
$builder
    ->delete(User::class)
    ->where(function (Where $where) {
        $where->inArray('id', [3, 4]);
    })
    ->exec();
```
#### mysql
```sql
DELETE
    `U`
FROM
    `shasoft-dbschemadev-table-user` `U`
WHERE
    `U`.`id` IN(3, 4)
```
#### pgsql
```sql
DELETE
FROM
    "shasoft-dbschemadev-table-user" "U"
WHERE
    "U"."id" IN(3, 4)
```


---
### Update
```php
$builder
    ->update(User::class)
    ->where(function (Where $where) {
        $where->cond('id', '=', 3);
    })
    ->values(
        [
            'name' => 'Admin',
            'age' => 7
        ]
    )
    ->exec();
```
#### mysql
```sql
UPDATE
    `shasoft-dbschemadev-table-user` `U`
SET
    `name` = 'Admin',
    `age` = 7
WHERE
    `U`.`id` = 3
```
#### pgsql
```sql
UPDATE
    "shasoft-dbschemadev-table-user" "U"
SET
    "name" = 'Admin',
    "age" = 7
WHERE
    "U"."id" = 3
```


---
### Select+Pagination
```php
$builder->select(User::class, ['id', 'name'])->pagination(2, 3);
```
#### mysql
```sql
SELECT
    COUNT(*) AS `cnt`
FROM
    `shasoft-dbschemadev-table-user` `U`
SELECT
    `U`.`id`,
    `U`.`name`
FROM
    `shasoft-dbschemadev-table-user` `U`
LIMIT 2 OFFSET 6
```
#### pgsql
```sql
SELECT
    COUNT(*) AS "cnt"
FROM
    "shasoft-dbschemadev-table-user" "U"
SELECT
    "U"."id",
    "U"."name"
FROM
    "shasoft-dbschemadev-table-user" "U"
LIMIT 2 OFFSET 6
```


