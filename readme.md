## Sql Query Builder examples

- [Sql Query Builder examples](#sql-query-builder-examples)
  - [Select](#select)
    - [mysql](#mysql)
    - [pgsql](#pgsql)
  - [Select(Alias Column)](#selectalias-column)
    - [mysql](#mysql-1)
    - [pgsql](#pgsql-1)
  - [Select+Where+Like](#selectwherelike)
    - [mysql](#mysql-2)
    - [pgsql](#pgsql-2)
  - [Select+Where+Not Like](#selectwherenot-like)
    - [mysql](#mysql-3)
    - [pgsql](#pgsql-3)
  - [Select+Where+Where 1](#selectwherewhere-1)
    - [mysql](#mysql-4)
    - [pgsql](#pgsql-4)
  - [Select+Where+Where 2](#selectwherewhere-2)
    - [mysql](#mysql-5)
    - [pgsql](#pgsql-5)
  - [Select+Where+=Null](#selectwherenull)
    - [mysql](#mysql-6)
    - [pgsql](#pgsql-6)
  - [Select+Where+Null](#selectwherenull-1)
    - [mysql](#mysql-7)
    - [pgsql](#pgsql-7)
  - [Select+Where+NotNull](#selectwherenotnull)
    - [mysql](#mysql-8)
    - [pgsql](#pgsql-8)
  - [Select+Where+Between](#selectwherebetween)
    - [mysql](#mysql-9)
    - [pgsql](#pgsql-9)
  - [Select+Where+Not Between](#selectwherenot-between)
    - [mysql](#mysql-10)
    - [pgsql](#pgsql-10)
  - [Select+Join+Inner](#selectjoininner)
    - [mysql](#mysql-11)
    - [pgsql](#pgsql-11)
  - [Select+Join+Left](#selectjoinleft)
    - [mysql](#mysql-12)
    - [pgsql](#pgsql-12)
  - [Select+Join+Right](#selectjoinright)
    - [mysql](#mysql-13)
    - [pgsql](#pgsql-13)
  - [Select+Join(3)](#selectjoin3)
    - [mysql](#mysql-14)
    - [pgsql](#pgsql-14)
  - [Select+Join+OrderBy 1](#selectjoinorderby-1)
    - [mysql](#mysql-15)
    - [pgsql](#pgsql-15)
  - [Select+Join+OrderBy 2](#selectjoinorderby-2)
    - [mysql](#mysql-16)
    - [pgsql](#pgsql-16)
  - [Select+Sum](#selectsum)
    - [mysql](#mysql-17)
    - [pgsql](#pgsql-17)
  - [Select+Sum(Alias Column)](#selectsumalias-column)
    - [mysql](#mysql-18)
    - [pgsql](#pgsql-18)
  - [Select+Limit 1](#selectlimit-1)
    - [mysql](#mysql-19)
    - [pgsql](#pgsql-19)
  - [Select+Limit 2](#selectlimit-2)
    - [mysql](#mysql-20)
    - [pgsql](#pgsql-20)
  - [Select+Distinct](#selectdistinct)
    - [mysql](#mysql-21)
    - [pgsql](#pgsql-21)
  - [Select+OrderBy](#selectorderby)
    - [mysql](#mysql-22)
    - [pgsql](#pgsql-22)
  - [Select+GroupBy](#selectgroupby)
    - [mysql](#mysql-23)
    - [pgsql](#pgsql-23)
  - [Select+Having](#selecthaving)
    - [mysql](#mysql-24)
    - [pgsql](#pgsql-24)
  - [Select+Having+Between](#selecthavingbetween)
    - [mysql](#mysql-25)
    - [pgsql](#pgsql-25)
  - [Select+Having+Not Between](#selecthavingnot-between)
    - [mysql](#mysql-26)
    - [pgsql](#pgsql-26)
  - [Select+In(Array)](#selectinarray)
    - [mysql](#mysql-27)
    - [pgsql](#pgsql-27)
  - [Select+In(Select)](#selectinselect)
    - [mysql](#mysql-28)
    - [pgsql](#pgsql-28)
  - [Select+In(Select)+MultiColumns](#selectinselectmulticolumns)
    - [mysql](#mysql-29)
    - [pgsql](#pgsql-29)
  - [Select+In(Select)+Function](#selectinselectfunction)
    - [mysql](#mysql-30)
    - [pgsql](#pgsql-30)
  - [Select+In(Select)+Context.Name](#selectinselectcontextname)
    - [mysql](#mysql-31)
    - [pgsql](#pgsql-31)
  - [Insert+Values(Array)](#insertvaluesarray)
    - [mysql](#mysql-32)
    - [pgsql](#pgsql-32)
  - [Insert+Values(Closure)](#insertvaluesclosure)
    - [mysql](#mysql-33)
    - [pgsql](#pgsql-33)
  - [Delete](#delete)
    - [mysql](#mysql-34)
    - [pgsql](#pgsql-34)
  - [Delete+In(Array)](#deleteinarray)
    - [mysql](#mysql-35)
    - [pgsql](#pgsql-35)
  - [Update](#update)
    - [mysql](#mysql-36)
    - [pgsql](#pgsql-36)
  - [Select+Pagination](#selectpagination)
    - [mysql](#mysql-37)
    - [pgsql](#pgsql-37)


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


### <a name="user-content-SelectWhereNotLike"></a>Select+Where+Not Like
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


### <a name="user-content-SelectWhereWhere1"></a>Select+Where+Where 1
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


### <a name="user-content-SelectWhereWhere2"></a>Select+Where+Where 2
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


### <a name="user-content-SelectWhereNull"></a>Select+Where+=Null
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


### <a name="user-content-SelectWhereNull"></a>Select+Where+Null
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


### <a name="user-content-SelectWhereNotNull"></a>Select+Where+NotNull
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


### <a name="user-content-SelectWhereBetween"></a>Select+Where+Between
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


### <a name="user-content-SelectWhereNotBetween"></a>Select+Where+Not Between
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


### <a name="user-content-SelectJoinInner"></a>Select+Join+Inner
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


### <a name="user-content-SelectJoinLeft"></a>Select+Join+Left
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


### <a name="user-content-SelectJoinRight"></a>Select+Join+Right
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


### <a name="user-content-SelectJoin3"></a>Select+Join(3)
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


### <a name="user-content-SelectJoinOrderBy1"></a>Select+Join+OrderBy 1
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


### <a name="user-content-SelectJoinOrderBy2"></a>Select+Join+OrderBy 2
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


### <a name="user-content-SelectSum"></a>Select+Sum
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


### <a name="user-content-SelectSumAliasColumn"></a>Select+Sum(Alias Column)
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


### <a name="user-content-SelectLimit1"></a>Select+Limit 1
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


### <a name="user-content-SelectLimit2"></a>Select+Limit 2
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


### <a name="user-content-SelectDistinct"></a>Select+Distinct
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


### <a name="user-content-SelectOrderBy"></a>Select+OrderBy
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


### <a name="user-content-SelectGroupBy"></a>Select+GroupBy
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


### <a name="user-content-SelectHaving"></a>Select+Having
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


### <a name="user-content-SelectHavingBetween"></a>Select+Having+Between
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


### <a name="user-content-SelectHavingNotBetween"></a>Select+Having+Not Between
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


### <a name="user-content-SelectInArray"></a>Select+In(Array)
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


### <a name="user-content-SelectInSelect"></a>Select+In(Select)
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


### <a name="user-content-SelectInSelectMultiColumns"></a>Select+In(Select)+MultiColumns
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


### <a name="user-content-SelectInSelectFunction"></a>Select+In(Select)+Function
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


### <a name="user-content-SelectInSelectContextName"></a>Select+In(Select)+Context.Name
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


### <a name="user-content-InsertValuesArray"></a>Insert+Values(Array)
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
VALUES('Igor', 60, 'Moderator')
```
#### pgsql
```sql
INSERT INTO "shasoft-dbschemadev-table-user"("name", "age", "role")
VALUES('Igor', 84, 'Moderator')
```


### <a name="user-content-InsertValuesClosure"></a>Insert+Values(Closure)
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


### <a name="user-content-Delete"></a>Delete
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


### <a name="user-content-DeleteInArray"></a>Delete+In(Array)
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


### <a name="user-content-Update"></a>Update
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


### <a name="user-content-SelectPagination"></a>Select+Pagination
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


