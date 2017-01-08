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
      $latlng=explode(',',API::GET('latlng'));
      $tik=0;
      $andArray=[];
      
      if(count($latlng)==4) { // 4个数字就假定其格式正确
        $lat1=intval($latlng[0]);
        $lng1=intval($latlng[1]);
        $lat2=intval($latlng[2]);
        $lng2=intval($latlng[3]);
        $posand=['lng[>]'=>$lng1,'lng[<]'=>$lng2,'lat[>]'=>$lat1,'lat[<]'=>$lat2 ];
        $tik++;
        $andArray["and#t$tik"]=$posand;
      }
      
      if(strlen($keys)==0) {
      } else {
        $k= preg_split("/[\s,;]+/",$keys);
        for($i=count($k); $i--;  ) {
          $w_or["or#".$i]=[ 'tel[~]'=>$k[$i], 'addr[~]'=>$k[$i], 'name[~]'=>$k[$i] ];
        }
        $tik++;
        $andArray["and#t$tik"]=$w_or;
      }
      if(count($andArray))
        $where=['and' => $andArray , "LIMIT" => 100 ] ;
      else
        $where=["LIMIT" => 100 ] ;
      //var_dump($where);

/*
增加字段star_1~5
利用下列 sql 语句 把五星数据直接变成单独的字段，方便搜索
UPDATE dp01_shop_v3 set star_5= cast( SUBSTRING_INDEX (stars,',',1) as unsigned)
UPDATE dp01_shop_v3 set star_4= cast( SUBSTRING_INDEX(SUBSTRING_INDEX (stars,',',2),',',-1) as unsigned)
UPDATE dp01_shop_v3 set star_3= cast( SUBSTRING_INDEX(SUBSTRING_INDEX (stars,',',3),',',-1) as unsigned)
UPDATE dp01_shop_v3 set star_2= cast( SUBSTRING_INDEX(SUBSTRING_INDEX (stars,',',4),',',-1) as unsigned)
UPDATE dp01_shop_v3 set star_1= cast( SUBSTRING_INDEX (stars,',',-1) as unsigned)

增加字段， lng lat 表示经度纬度坐标（乘 1E7 后取整），坐标整数1差别约等于0.01m
UPDATE dp01_shop_v3 set lat = 10000000 * SUBSTRING_INDEX (lnglat,',',-1)
UPDATE dp01_shop_v3 set lng = 10000000 * SUBSTRING_INDEX (lnglat,',',1)

*/
      //id	dpid	name	region	region_name	addr	tel	stars	star_count	scores	score_count	lnglat	mark1	mark2
      $r=$db->select('dp01_shop_v3',
          ['id','name','region_name','addr','tel','stars','star_count','scores','score_count','lnglat' ],
          $where);
      //var_dump($db);
      $res['data']=$r;
      return $res;
    }
    
    
    
    
    
    

}
