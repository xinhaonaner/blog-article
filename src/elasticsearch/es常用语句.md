整理常用的es查询语句： 基于kibana的Dev Tools控制板

--------------- 索引相关查询

//查询所有索引及容量

    GET _cat/indices

//查询索引映射结构
    GET my_index/_mapping

// 查询所有索引映射结构    

    GET _all

// 查询所有的相同前缀索引

    GET my-*/_search

// 查询所有索引模板   

    GET _template

// 查询具体索引模板

    GET _template/my_template



---------------集群相关

//查询集群健康状态

    GET _cluster/health

// 查询所有节点

    GET _cat/nodes

// 查询索引及分片的分布
    GET _cat/shards

// 查询所有插件

    GET _cat/plugins

// 清空索引内容

```
POST请求：
http://localhost:9200/magic-index/magic-type/_delete_by_query?conflicts=proceed

{
  "query": {
    "match_all": {}
  }
}
```

-----------------写入模块

-----写入索引模板

PUT _template/my_template
{
    "template" : "my-*",
    "order" : 0,
    "settings" : {
         "number_of_shards" : 10,
 "number_of_replicas" : 0
    },
    "mappings": {

      "default": {

  "_all": {
        "enabled": false
      }，
        "properties": {
          "name": {
            "type": "text"
          },
          "age": {
            "type": "long"
          }
        }
    }
  }
}

-----------创建索引映射结构

PUT my_index
{
  "mappings": {
    "doc": {
      "properties": {
        "name": {
          "type": "text"
        },
        "blob": {
          "type": "binary"
        }
      }
    }
  }
}
-------------写入索引

PUT my_index/doc/1
{
  "name": "Some binary blob",
  "blob": "U29tZSBiaW5hcnkgYmxvYg==" 
}
-------------删除

// 索引

DELETE my-index

// 模板

DELETE  _template/my_template 



--------------DSL query查询

---------使用本地插件查询

{

"size": 10,

"from": 0,

"query": {
"function_score": {
"script_score": {
"script": {
"inline": "featurescore",
"lang": "native",
"params": {
"name": "you",
"age": "20"
}
}
},
"query": {
"bool": {
"filter": {
"term": {
"name": "you"
}
}
}
}
}
},
"_source": {
"includes": ["name", "age"]
},
"sort": {
"_score": {
"order": "asc"
}
}
}

// 说明 inline 指定插件名   lang指定插件形式  native是本地插件   param定义参数  插件里使用XContentMapValues.nodeStringValue(params.get("name"), null)获取  ,  elasticseach里存储的字段值使用 source().get("name") 来获取,插件会并行处理es中每一条数据 ； 

_source 指定返回字段 ， sort 指定插件处理结果的排序字段

---------基础query

//查询所有
GET _search
{
  "query": {
    "match_all": {}
  }
}

// 查询单个索引 的 固定属性

---精确匹配

GET _search
{
  "query": {
    "term": { "name" : "you" }
  }
}

---模糊匹配

GET _search
{
  "query": {
    "match": { "name" : "you" }
  }
}
---范围查找

GET _search
{
  "query": {
    "range": {
        "age":{ "gte" : 15 , "lte" : 25 }
    }
  }
}
// 功能性查询

-----过滤

GET my_index/_search
{
  "query": {
    "bool": {
      "filter": {
        "term":{"age":1095}
      }
    }
  }
}

---或  or

GET my - test / _search {
"query": {
"bool": {
"should": [{
"term": {
"name": "you"
}
}, {
"match": {
"age": 20
}
}]
}
}
}

---与 AND

GET my-test/_search
{
  "query": {
    "bool": {
      "must" : [{
        "match" : {
          "name" : "you"
        }
      },{
        "range":{
        "age":{
          "from" : 10 , "to" : 20
        } 
        }
      }]
    }
  }
}

---必须 =

GET my_index/_search
{
  "query": {
    "bool": {
      "must" : {
        "range" : {
          "age" : { "from" : 10, "to" : 20 }
        }
      }
    }
  }
}

---必须不 not

GET my_index/_search
{
  "query": {
    "bool": {
      "must_not" : {
        "term" : {
          "name" : "you"
        }
      }
    }
  }
}

----复合查找

GET my_index/_search 
{
"query": {
"bool": {
"should": [{
"match": {
"age": 40
}
}, 
{
"match": {
"age": 20
}
}],
"filter": {
  "match":{
    "name":"you"
  }
}
}
}
}

------索引迁移

---场景 从A索引 复制到B索引
POST _reindex
{
  "source": {
    "index": "my_index"
  },
  "dest": {
    "index": "new_my_index"
  }
}



-------------基于查询的删除

POST test-index/_delete_by_query
{
  "query":{
        "term": {
         "cameraId":"00000000002"
        }
  }

}

--查询

GET test-index/_search
{
  "query":{
        "term": {
         "cameraId":"00000000002"
        }
  }
}

