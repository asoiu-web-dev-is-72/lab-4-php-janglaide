<!DOCTYPE html>
<html>
<head>
 <title>lab</title>
 <style type="text/css">
 body{
  font-family: sans-serif;
 }
 td{
  height: 30px;

 }
 .t1{
    width:35px;
 }
 .t{
  background-color: #4c1e0a;
 }
 .t td{
  background-color: #d15119;
  border-color: #4c1e0a;

 }
 .e{
  border: red 3px solid;
  padding: 0.5%;
  margin-right: 50%;
  color: red;
  font-size: 1.4em;
 }
 </style>
 </head>
 <body>

<?php

    $connection = mysqli_connect('localhost', 'root', '', 'lab4');
    $sizeHor = $_POST['sizeHor'];
    $sizeVer = $_POST['sizeVer'];
    if($connection == false){
      echo 'No connection to localhost';
      echo mysqli_connect_error();
      exit();
    }
    else{

      if(is_numeric($sizeHor) and is_numeric($sizeVer) and $sizeHor > 0 and $sizeVer > 0){
           $query = "INSERT INTO `correct`(`sizeHor`, `sizeVer`) VALUES (" . (int)($sizeHor). "," . (int)($sizeVer). ")";
           mysqli_query($connection, $query);
      }         
      else {
          $query = "INSERT INTO `incorrect`(`sizeHor`, `sizeVer`) VALUES (' $sizeHor ','  $sizeVer')";
          mysqli_query($connection, $query);
          echo"<div class = \"e\">Try again. Tables were built by default size = 6</div><br>";
          $sizeVer = 6;
          $sizeHor = 6;
      }
    }
?>

<form action="index.php" method="POST">
 Enter horisontal size:<input type="text" name="sizeHor" required> <br><br>
 Enter vertical size:<input type="text" name="sizeVer" required><br><br>
 <input type="submit" value="Go">
</form>
<hr>



<h3>Table 1</h3>
<?php

 $width = 900;
 echo "<table border = \"1px\" width= \" " . $width . "px\">";
 for($i = 0; $i < $sizeHor; $i++){
  echo"<tr>"; 
  if( $i % 4 == 0 and $i != 0){
    if ( $i != 0) 
      echo "<td class = \"t1\" rowspan=" . ($sizeHor - $i) . "></td>";  
      echo "<td class = \"t1\" colspan=" . ($sizeHor - $i) . ">4 cell</td>";
    
  }
  else {
    if ( $i != 0) 
      echo "<td class = \"t1\" rowspan=" . ($sizeHor - $i) . "></td>";  
    echo "<td class = \"t1\" colspan=" . ($sizeHor - $i) . "></td>";
    }


  echo "</tr>";
 }
 echo"</table>";
?>

<br><br>
<h3>Table 2</h3>
<?php
 $width = 900;
 $flag = false;
 echo "<table border = \"1px\" width = \"" . $width . "px\">";
 for($i = 0; $i < $sizeHor + 1; $i++){
    echo"<tr>";
          if($i >= 4 and $i % 2 == 0 and $flag == false){
                //echo"<td rowspan = \"" . ($sizeHor + 1 - $i) . "\"></td>";
                echo"<td colspan = \"" . ($sizeHor + 1 - $i - 1) . "\"></td>";
                $flag = true;
          }
          else if($flag == false){
                echo"<td rowspan = \"" . ($sizeHor + 1 - $i) . "\"></td>";
                echo"<td colspan = \"" . ($sizeHor + 1 - $i - 2) . "\"></td>";
          }
          else if ($i == $sizeHor){
                echo"<td rowspan = \"" . ($sizeHor + 1 - $i) . "\"></td>";
          }
          else{
                echo"<td rowspan = \"" . ($sizeHor + 1 - $i) . "\"></td>";
                echo"<td colspan = \"" . ($sizeHor + 1 - $i - 1) . "\"></td>";
          }
    
    echo"</tr>";


  /*    echo "<tr>";
        if($i % 4 == 0 and $i != 0){
          echo "<td class = \"t1\" rowspan=" . ($sizeHor - $i) . ">4 cell</td>";
        }
        else{
          echo "<td class = \"t1\" rowspan=" . ($sizeHor - $i) . "></td>";
        }
          echo "<td class = \"t1\" colspan=" . ($sizeHor - $i) . "></td>";
      echo "</tr>";*/
  }
 echo "</table>";
?>
<br>

<h3>Table 3</h3>

<?php
 $width = 900;
 echo "<table class = \"t\" border=\"1px\" width=\"" . $width . "px\">";
 for($i = 0; $i < $sizeVer; $i++){
  echo "<tr>";
  for($j = 0; $j < $sizeHor; $j++){
    if($i % 4 == 0 and $i != 0){
         if(($i % 2 == 0 and $j < ($sizeHor - 1)) or ($i % 2 != 0 and $j > 0))
          echo"<td width = \"" . $width/$sizeHor . "\"colspan=\" 2 \">4 cell</td>";
         
         else
          echo"<td width=\"" . $width/($sizeHor * 2) . "px\">4 cell</td>";
    }
    else{
         if(($i % 2 == 0 and $j < ($sizeHor - 1)) or ($i % 2 != 0 and $j > 0))
          echo"<td width = \"" . $width/$sizeHor . "\" colspan=\" 2 \"></td>";
         
         else
          echo"<td width=\"" . $width/($sizeHor * 2) . "px\"></td>";      
    }
  }
  echo "</tr>";
 }
 echo "</table>";
?>

<br><br>
<h3>Table 4</h3>
<?php
 $width = 900;
 $m = 3;
 echo "<table border = \"1px\" width = \"" . $width . "px\" height = \"" . $sizeVer * 20 . "px\">";
 for($i = 0; $i < $sizeVer; $i++){
  echo'<tr>';
  if($i == 0){
   for($j = 0; $j < $sizeHor; $j++, $m++){
    echo"<td rowspan=\"" . $m . "\" height=\"" . $m * 20 . "px\"></td>";
    if($m == 3) 
     $m = 0;
   }
  }
  else if($i % 4 != 0){
   if($i % 3 == 0) 
    $size = floor(($sizeHor + 2)/ 3);
   else if (($i + 1)% 3 != 0) 
    $size = floor(($sizeHor + 1)/ 3);
   else 
    $size = floor($sizeHor / 3);

   if($i < ($sizeVer - 2))
    $m = 3;
   else if($i == ($sizeVer - 2))
    $m = 2;
   else
    $m = 1;

   for($j = 0; $j < $size; $j++){
    echo "<td rowspan = \"" . $m . "\" height=\"" . $m * 20 . "px\"></td>";
   }
  }
  else{
    if($i % 3 == 0) 
        $size = floor(($sizeHor + 2)/ 3);
       else if (($i + 1)% 3 != 0) 
        $size = floor(($sizeHor + 1)/ 3);
       else 
        $size = floor($sizeHor / 3);

       if($i < ($sizeVer - 2))
        $m = 3;
       else if($i == ($sizeVer - 2))
        $m = 2;
       else
        $m = 1;

       for($j = 0; $j < $size; $j++){
        echo "<td width = \"" . $width/$sizeHor . "\" rowspan = \"" . $m . "\" height=\"" . $m * 20 . "px\">4 cell</td>";
       }

  }
  echo'</tr>';
 }
 echo '</table>';
?>

</body>
</html>