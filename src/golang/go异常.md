go异常 defer panic recover
```
package main

import "fmt"

// go异常 defer panic recover
func main() {
    // 匿名调用 defer(压栈，如果有多个defer情况下，后进先出)，
    defer func() {
        fmt.Println("第1个defer")
        defer func() {
            fmt.Println("第2个defer")
            // recover（内置函数），对异常进行捕获
            if err := recover(); err != nil {
                fmt.Println(err) // 这里的err其实就是panic传入的内容，抛出panic
            }
        }()
        fmt.Println("第1个defer结束")
    }()
    f()
    fmt.Println("此处不会运行")
}

func f() {
    fmt.Println("a")
    panic("抛出panic") // panic抛出后，寻找之前的defer,依次调用
    fmt.Println("b")
    fmt.Println("c")
}
```