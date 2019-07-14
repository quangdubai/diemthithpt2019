<?php
error_reporting(0);
set_time_limit(0);
$min = 1000029;
$max = 1999999;
function CURL($sbd) {
    
    $url = "https://diemthi.vnanet.vn/Home/SearchBySobaodanh?nam=2019&code=".$sbd;
    $ch = curl_init($url);
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3833.0 Safari/537.36',
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true
    ));
    $data = curl_exec($ch);
        curl_close($ch);
        return $data;
}
for ($i = $min; $i <= $max; $i++) {
$i = '0'.$i;
$re = json_decode(CURL($i));
$sbd = $re->result[0]->Code;
$toan = $re->result[0]->Toan;
$nv = $re->result[0]->NguVan;
$nn = $re->result[0]->NgoaiNgu;
$vl = $re->result[0]->VatLi;
$hh = $re->result[0]->HoaHoc;
$sh = $re->result[0]->SinhHoc;
$khtn = $re->result[0]->KHTN;
$dia = $re->result[0]->DiaLi;
$ls = $re->result[0]->LichSu;
$gdcd = $re->result[0]->GDCD;
$khxh = $re->result[0]->KHXH;
$result = $re->result[0]->ResultGroup;
$array = array(
  'SBD' => $i,
  'toan' => $toan,
  'ngoaingu' => $nn,
  'van' => $nv,
  'vatly' => $vl,
  'hoahoc' => $hh,
  'sinhhoc' => $sh,
  'khtn' => $khtn,
  'dia' =>$dia,
  'lichsu' => $ls,
  'gdcd' => $gdcd,
  'khxh' => $khxh,
  'tonghop' => $result
);
$json = json_encode($array);
file_put_contents('diem.json', $json."\n", FILE_APPEND);
}
