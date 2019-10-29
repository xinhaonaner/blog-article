```
POST _analyze
{
  "tokenizer": "standard",
  "text":"Hello World!"
}
```
- es自带分词器
	-Standard 【默认、小写处理】
	-Simple 【按词切分、小写处理】
	-Whitespace
	-Stop
	-Keyword
	-Pattern
	-Language
	
- 中文分词器
	-IK
	-jieba
	

​	

| JSON类型 | es类型                                                       |
| -------- | ------------------------------------------------------------ |
| null     | 忽略                                                         |
| boolean  | boolean                                                      |
| 浮点型   | float                                                        |
| 整数     | Long                                                         |
| object   | object                                                       |
| array    | 由第一个非null值的类型决定                                   |
| string   | 匹配为日期则设为date类型（默认开启）<br/>匹配为数字的话设为float或者long类型（默认关闭）<br/>设为text类型，并附带keyword的子字段 |


​	
​	
