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
      $keys=API::GET('s');
      
      $where=["LIMIT" => 100];
      if(strlen($keys)==0) {
      } else {
        $k= preg_split("/[\s,;]+/",$keys);
        for($i=count($k); $i--;  ) {
          $w_or["or#".$i]=[ 'tel[~]'=>$k[$i], 'addr[~]'=>$k[$i], 'name[~]'=>$k[$i] ];
        }
        $where=['and' => $w_or, "LIMIT" => 100 ];
        //var_dump($where);
      }
      //id	dpid	name	region	region_name	addr	tel	stars	star_count	scores	score_count	lnglat	mark1	mark2
      $r=$db->select('dp01_shop_v3',
          ['id','dpid','name','region_name','addr','tel','stars','star_count','scores','score_count','lnglat' ],
          $where);
      $res['data']=$r;
      return $res;
    }
    
    
    
    
    
    

}
