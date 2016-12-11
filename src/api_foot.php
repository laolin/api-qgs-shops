<?php
//WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW
/*
 
*/
class class_foot{
    public static function main( $para1,$para2) {
      $res=API::msg(0,'Ok.');
      $db=API::db();
      return $res;
      //return self::s( $para1,$para2);
    }
    

    public static function search( $para1,$para2) {
      $res=API::msg(0,'Ok.');
      $db=API::db();
      $s=API::GET('s');
      //id	dpid	name	region	region_name	addr	tel	stars	star_count	scores	score_count	lnglat	mark1	mark2
      $r=$db->select('dp01_shop_v3',
          ['id','dpid','name','region_name','addr','tel','stars','star_count','scores','score_count','lnglat' ],
          ["or" => [
                      'tel[~]'=>$s,
                      'addr[~]'=>$s,
                      'name[~]'=>$s
                   ] ,
            "LIMIT" => 100  ]);
      $res['data']=$r;
      return $res;
    }
    
    
    
    
    
    

}
