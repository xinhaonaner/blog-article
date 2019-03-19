## PSR-2编码规范

### 规范

- ##### 文件

  - 所有 PHP 文件 **必须** 使用 `Unix LF (linefeed)` 作为行的结束符。

  - 所有 PHP 文件 **必须** 以一个空白行作为结束。
  - 纯 PHP 代码文件 **必须** 省略最后的 `?>` 结束标签。

- ##### 行

  - 每行 **不该** 多于80个字符，大于80字符的行 **应该** 折成多行。
  - 软性的长度约束 **必须** 要限制在 120 个字符以内，若超过此长度，带代码规范检查的编辑器 **必须** 要发出警告，不过 **一定不可** 发出错误提示。
  - 非空行后 **一定不可** 有多余的空格符。
  - 空行 **可以** 使得阅读代码更加方便以及有助于代码的分块。
  - 每行 **一定不可** 存在多于一条语句。

- ##### 缩进

  - 必须适应4个空格，不能使用tab键

- ##### 关键字与 True/False/Null

  - PHP 的常量 `true`， `false`， 还有 `null` **必须** 使用小写形式。

- ##### 命名空间和使用声明

  - `namespace` 声明之后 **必须** 存在一个空行。
  - 所有的 `use` 声明 **必须** 位于 `namespace` 声明之后。
  - 每条 `use` 声明 **必须** 只有一个 `use` 关键字。
  - `use` 语句块之后 **必须** 存在一个空行。

- ##### 扩展与继承

  - 关键词 `extends` 和 `implements` **必须** 写在类名称的同一行。

  - 类的开始花括号 **必须** 独占一行，结束花括号也 **必须** 在类主体后独占一行。

  - ```
    <?php
    namespace Vendor\Package;
    
    use FooClass;
    use BarClass as Bar;
    use OtherVendor\OtherPackage\BazClass;
    
    class ClassName extends ParentClass implements \ArrayAccess, \Countable
    {
        // 这里面是常量、属性、类方法
    }
    
    ```

  - `implements` 的继承列表也 **可以** 分成多行，这样的话，每个继承接口名称都 **必须** 分开独立成行，包括第一个。

    ```
    <?php
    namespace Vendor\Package;
    
    use FooClass;
    use BarClass as Bar;
    use OtherVendor\OtherPackage\BazClass;
    
    class ClassName extends ParentClass implements
        \ArrayAccess,
        \Countable,
        \Serializable
    {
        // 这里面是常量、属性、类方法
    }
    
    ```


