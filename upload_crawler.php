<?php
set_time_limit(0);
include(dirname(__FILE__) . '/common.php');
include(dirname(__FILE__) . '/includes/Uploader.class.php');

SetStyle('api','API');

Auth(1,0,true);

/* 上传配置 */
$config = array(
    "pathFormat" => $Config['WebsitePath'].$UploadConfig['catcherPathFormat'],
    "maxSize" => $UploadConfig['catcherMaxSize'],
    "allowFiles" => $UploadConfig['catcherAllowFiles'],
    "oriName" => "remote.png"
);
$fieldName = $UploadConfig['catcherFieldName'];

/* 抓取远程图片 */
$list = array();
if (isset($_POST[$fieldName])) {
    $source = $_POST[$fieldName];
} else {
    $source = $_GET[$fieldName];
}
foreach ($source as $imgUrl) {
    $item = new Uploader($imgUrl, $config, "remote", $Prefix, $CurUserName, $DB);
    $info = $item->getFileInfo();
    array_push($list, array(
        "state" => $info["state"],
        "url" => $info["url"],
        "size" => $info["size"],
        "title" => htmlspecialchars($info["title"]),
        "original" => htmlspecialchars($info["original"]),
        "source" => htmlspecialchars($imgUrl)
    ));
}

/* 返回抓取数据 */
return json_encode(array(
    'state'=> count($list) ? 'SUCCESS':'ERROR',
    'list'=> $list
));
?>