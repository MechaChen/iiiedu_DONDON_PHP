<?php 
$errMsg = "";
try {
	require_once("connectBooks.php");

  $sql = "
    SELECT * 
    FROM member 
    WHERE memId= :memId AND memPsw= :memPsw";
  $members = $pdo->prepare($sql);
  $members->bindValue(":memId", $_REQUEST["memId"]);
  $members->bindValue(":memPsw", $_REQUEST["memPsw"]);
  $members->execute();
} catch (PDOException $e) {
       $errMsg .=  $e->getMessage(). "<br>"; 
       $errMsg .=  $e->getLine(). "<br>";    	
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
<style type="text/css">
h2 {
	color:deeppink;
}	
</style>
</head>
<body>
<?php
if( $errMsg != ""){
	exit( $errMsg);
}

if($members->rowCount() == 0 ){
  echo '<center>帳密錯誤, <a href="login.html">請重新登入</a></center>';
}else{
  $memRow = $members->fetch(PDO::FETCH_ASSOC);
  echo $memRow["memName"], "您好~~<br>";
}
   
?>      
</body>
</html>