<?php
$query = strtolower($artist . " " . $song);

$output = shell_exec('ls -lart');
echo $output;

include("simple_html_dom.php");
$crawled_urls=array();
$found_urls=array();
function rel2abs($rel, $base){
 if (parse_url($rel, PHP_URL_SCHEME) != ''){
  return $rel;
 }
 if ($rel[0]=='#' || $rel[0]=='?'){
  return $base.$rel;
 }
 extract(parse_url($base));
 $path = preg_replace('#/[^/]*$#', '', $path);
 if ($rel[0] == '/'){
  $path = '';
 }
 $abs = "$host$path/$rel";
 $re = array('#(/.?/)#', '#/(?!..)[^/]+/../#');
 for($n=1; $n>0;$abs=preg_replace($re,'/', $abs,-1,$n)){}
 $abs=str_replace("../","",$abs);
 return $scheme.'://'.$abs;
}
function perfect_url($u,$b){
 $bp=parse_url($b);
 if(($bp['path']!="/" && $bp['path']!="") || $bp['path']==''){
  if($bp['scheme']==""){
   $scheme="http";
  }else{
   $scheme=$bp['scheme'];
  }
  $b=$scheme."://".$bp['host']."/";
 }
 if(substr($u,0,2)=="//"){
  $u="http:".$u;
 }
 if(substr($u,0,4)!="http"){
  $u=rel2abs($u,$b);
 }
 return $u;
}
function crawl_site($u, $depth, $query){
 global $crawled_urls, $found_urls;
 $uen=urlencode($u);
 if((array_key_exists($uen,$crawled_urls)==0 || $crawled_urls[$uen] < date("YmdHis",strtotime('-25 seconds', time())))){
  $html = file_get_html($u);
  $crawled_urls[$uen]=date("YmdHis");
  foreach($html->find("a") as $li){
   $url=perfect_url($li->href,$u);
   $enurl=urlencode($url);
   if($url!='' && substr($url,0,4)!="mail" && substr($url,0,4)!="java" && array_key_exists($enurl,$found_urls)==0){
    $found_urls[$enurl]=1;
    if ($depth == 1 && (strpos("a" . $url, "http://www.midikaraokes.com/") == 1)) {
      $words = explode(' ',$query);
      $i = str_word_count($query);
      $required = floor(($i / 2) + ($i % 2));
      $found = 0;
      foreach ($words as $word) {
        if (strpos("a" . $url,$word) != false) {
          ++$found;
        }
      }
      if ($required <= 0) {
        $required = 2;
      }
      if ($found >= $required) {
        $depth = 2;
        crawl_site($url, $depth, $query);
      }
    } elseif ($depth == 2 && (strpos("a" . $url, "http://www.midikaraokes.com/") == 1) && (strpos("a" . $url, ".zip") !=false)) {
      echo $url;
    }
   }
  }
 }
}
$search = str_replace(" ", "+", $query);
crawl_site("http://www.midikaraokes.com/?s=" . $search, 1, $query);
?>
