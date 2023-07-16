<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAYIYI YAZIYA ÇEVİRME PROGRAMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" 
    crossorigin="anonymous">
  </head>
  
  <body>

    <br>
    <h5 class="display-7" align="center" style='color:red'>SAYIYI YAZIYA ÇEVİR</h5>
    <br><br>
    <form method="post">
        <table border="3" class="table table-striped" align="center" style="width: 500px; height:100px;">
            <tr>
            <td>Sayıyı Giriniz:</td>
            <td><input size= "35px;" type="text" name="sayi" value="<?php if(isset($sayi)){echo $sayi;}?>"/></Td>
            </tr>
            <tr>
            <td colspan="3" align="center">
            <input type="submit" name="convert" value= Çevir <button type="button" class="btn btn-primary"> </button> </input>
            </td>
            </tr>
        </table>
    </form>
    <br><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb//68SIy3Te4Bkz" 
    crossorigin="anonymous"></script>

  </body>
</html>

<?php

function SayiyiYaziyaCevirme($sayi)
{
  try{
  if (($sayi < 0) || ($sayi > 999999999999999)) 
  {
    echo throw new Exception ("<h5 align='center' style='color:rgb(0,255,0)'>Verilen Sayı 15 Basamaktan Büyük Olmamalı!!</h5>");
  } 
  }
  catch (Exception $e){
    echo "<h4 align='center' style='color:red'>UYARI:</h4>".$e->getMessage();
  exit;
  } 

      $birler=array('Sıfır', 'Bir', 'İki', 'Üç', 'Dört', 'Beş', 'Altı', 'Yedi', 
                'Sekiz', 'Dokuz', 'On', 'On bir', 'On iki', 'On üç', 'On dört', 
                'On beş', 'On altı', 'On yedi', 'On sekiz', 'On dokuz'); 
      $onlar=array('Sıfır', 'On', 'Yirmi', 'Otuz', 'Kırk', 'Elli', 
                'Altmış', 'Yetmiş', 'Seksen', 'Doksan');
      $binler=array('Yüz', 'Bin', 'Milyon', 'Milyar', 'Trilyon'); 

  $sayi=number_format($sayi, 2, ".", ","); 
  $sayidizisi=explode(".", $sayi); 
  $tumsayi=$sayidizisi[0]; 
  $ondaliksayi=$sayidizisi[1]; 
  $tumdizi=array_reverse(explode(",", $tumsayi)); 
  krsort($tumdizi,1); 
  $sonuc=" "; 

  foreach($tumdizi as $j => $i)
  {	
      while(substr($i,0,1)=="0")
		  $i=substr($i,1,5);

      if($i < 20){ 
      $sonuc .= $birler[$i];}

      elseif($i < 100)
      { 
        if(substr($i,0,1)!="0")  $sonuc .= $onlar[substr($i,0,1)]; 
        if(substr($i,1,1)!="0")  $sonuc .= " " .$birler[substr($i,1,1)]; 
      }
        else{ 
          if(substr($i,0,1)!="0") $sonuc .= $birler[substr($i,0,1)] ." " .$binler[0]; 
          if(substr($i,1,1)!="0") $sonuc .= " " .$onlar[substr($i,1,1)]; 
          if(substr($i,2,1)!="0") $sonuc .= " " .$birler[substr($i,2,1)]; 
            } 
      if($j > 0){ 
        $sonuc .= " ".$binler[$j]." ";}
  } 

  if($ondaliksayi > 0)
  {
     $sonuc .= " Nokta ";
  if($ondaliksayi < 20){
     $sonuc .= $birler[$ondaliksayi];}

  elseif($ondaliksayi < 100)
      {
         $sonuc .= $onlar[substr($ondaliksayi,0,1)];
         $sonuc .= " ".$birler[substr($ondaliksayi,1,1)];
      }
  }

    return $sonuc;

}

  extract($_POST);
  if(isset($convert))
  
{
echo "<p align='center' style='color:green'>".SayiyiYaziyaCevirme("$sayi")."</p>";
}

?>