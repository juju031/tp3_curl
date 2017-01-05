## CURL
```
方法get
如果curl不存在，使用file_get_contents读取远程文件
```

##安装

```
composer require "juju/curl"

"juju/curl": "~1.0.0"
```

##GET控制器顶部
```
use \juju\curl\Curl;
```

##GET控制器调用
```
$url = "http://www.baidu.com";	//访问URL
$referer = '';		//来源
$curl = new Curl();
$info = $curl->get($url,$referer);
echo $info;
exit();
```

##POST控制器顶部
```
use \juju\curl\Curl;

$url = "http://www.baidu.com";
$data['search'] = '123';

$curl = new Curl();
$info = $curl->post($url,$data);
echo $info;
exit();
```