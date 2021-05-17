<?php
try {
    $redis = new Redis();
    $redis->connect('localhost', 6379);
    $redis->Rpush('eric:wishlist', 'dr.dk');
    function multiDoRedis($redis){
      $site = $redis->rpop('eric:wishlist');
      $visited = $redis->lrange('eric:visited', 0, -1);
      if(!in_array($site, $visited)){
         $redis->lPush('eric:visited', $site);
      }
   };
   multiDoRedis($redis);
} catch (Exception $ex) {
    echo $ex->getMessage();
}