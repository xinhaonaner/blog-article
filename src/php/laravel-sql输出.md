## Laravel -SQL 输出

```
 DB::connection()->enableQueryLog();

 $query = DB::getQueryLog();
 dd(vsprintf(str_replace('?', '%s', $query[0]['query']), $query[0]['bindings']));
```


