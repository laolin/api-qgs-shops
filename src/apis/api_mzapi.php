<?php
//WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW
/*
 
*/
class class_mzapi{
    public static function main( $para1,$para2) {
      $res=API::msg(0,'Ok.');
      $db=API::db();
      return $res;
    }
    public static function citylist( $para1,$para2) {
      $res=API::msg(0,'Ok.');
      //$db=API::db();
      $res['data']=[
        '上海',
        '测试中...','仅限上海','其他无效',
        '北京',
        //'杭州','南京','苏州','宁波','南通','无锡',
        '深圳',
        '乌鲁木齐'
      ];
      return $res;
    }

    
    
    
    
    

}
