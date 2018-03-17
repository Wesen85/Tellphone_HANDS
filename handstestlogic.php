<?php
//// �������

function VerifyPhone($phone) 
{		
	return $phone=trim(htmlspecialchars($phone,ENT_QUOTES));	
}

//// ������� � ���������� ����������
function ParsePhone($phone)
{
	$tr=preg_match_all("#[0-9\s-\]\[()+]{7,19}#si",$phone,$phone_array);
	if ($tr==0) return $res=array("� ������ ��� ���������");

foreach($phone_array[0] as $value)
{
	$temp=str_replace("+7","8",$value);
	$temp=trim(str_replace(array(" ","+","-","(",")","[","]"),"",$temp));
	$strlen=strlen($temp);
	if($strlen < 7) $temp=null;
	elseif($strlen==7) $temp="8495".$temp;
	elseif ($strlen==10) $temp="8".$temp;
	elseif ($strlen==11 && $temp{0}==7) $temp{0}="8";
	elseif ($strlen==11 && $temp{0}!=8) $temp=null;
	elseif ($strlen > 11 && $temp{0}==8) $temp=substr($temp,0,11);
	elseif ($strlen > 11 or ($strlen==8 || $strlen==9))  $temp=null;
	
	if($temp) $res[]=$temp;
}
	return $res;
}

//// ������� ������� ��������
function ParsePhoneV($phone)
{
$strlen=iconv_strlen($phone);
$temp="";$resAr=null;$res=null;
for ($i = 0; $i < $strlen; $i++) {
   if (is_numeric($phone{$i})) $temp.=$phone{$i};
   elseif (!in_array( $phone{$i},array(" ","+","-","(",")","[","]")) && $temp ) {$resAr[]=$temp;$temp=null;}
}
if($temp) $resAr[]=$temp;
if(!$resAr) return $res=array("� ������ ��� ���������");
foreach ($resAr as $value)
{
	$strlen=strlen($value);
	if($strlen < 7) $value=null;
	elseif($strlen==7) $value="8495".$value;
	elseif ($strlen==10) $value="8".$value;
	elseif ($strlen==11 && $value{0}==7) $value{0}="8";
	elseif ($strlen==11 && $value{0}!=8) $value=null;
	elseif ($strlen > 11 && $value{0}==8) $value=substr($value,0,11);
	elseif ($strlen > 11 && $value{0}==7) $value="8".substr($value,1,10);
	elseif ($strlen > 11 or ($strlen==8 || $strlen==9)) $value=null;
	if($value) $res[]=$value;
}
	return $res;
}
/////
$res="������� ������ ��� ��������";
$resV="";
if($_POST["phone"]) 
{
	$phone=VerifyPhone($_POST["phone"]);
	$out=$phone;

$start = microtime(true); 
	$resAr=ParsePhone($phone);
$res= '����� ���������� ������� � ���������� ���������� (ParsePhone) :  '.(microtime(true) - $start).' ���.</br>';		
	if($resAr) $res.="���������: </br>". implode("</br>",$resAr );	

$start = microtime(true); 
	$resArV=ParsePhoneV($phone);
$resV=  '����� ���������� ������� ������� �������� (ParsePhoneV): '.(microtime(true) - $start).' ���.</br>';		
if($resArV) $resV.="���������: </br>". implode("</br>",$resArV);

}
?>