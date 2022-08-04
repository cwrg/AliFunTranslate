
# AliFunTranslate
阿里云函数翻译


###  包含Google翻译和国内百度翻译

#### Google翻译请部署到阿里云香港节点 ,使用阿里云自带域名调用接口

#### 要百度翻译请在.env文件配置appid和key

### 请注意项目请自行本地composer install
#### php >= 7.2

###### HTTP请求方式

> GET

###### 请求参数

| 参数   | 必选    |类型| 说明          |
|:-----|:------|:-----|-------------|
| text | ture  |string| 翻译文本        |
| source | false | string  | 来源语言 默认auto |
| target | false  |string   | 翻译语言 默认en   |

###### Google翻译调用

> 地址：/translate/google?text=你好&source=zh&target=en

``` javascript
{
    "code": 0,
    "data": {
       "content":"Hello"
    },
    "msg": "success"
}
``` 

###### 百度翻译调用

> 地址：/translate/baidu?text=你好&source=zh&target=en

``` javascript
{
    "code": 0,
    "data": {
       "content":"Hello"
    },
    "msg": "success"
}
``` 

如果项目帮助到了您，请您给个star吧，如您遇到了问题和建议欢迎留言 :)
