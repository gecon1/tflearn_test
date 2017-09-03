<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/effects.js"></script>

<?php

include("connect_db.php");
	$sl=$_POST['sl'];
	$sw=$_POST['sw'];
	$pl=$_POST['pl'];
	$pw=$_POST['pw'];
	$var=$_POST['var'];

function classify($sl,$sw,$pl,$pw,$var)
{

	$nod=0;
	
	equ:
	$nod=$nod+1;
	$tol=0;
	
	echo "<div id=\"clic\">[+] Click for backend details</div>";
	echo "<div id=\"backend\">";
	
	echo "Recieved values: ".$sl.",  ".$sw.",  ".$pl.",  ".$pw.",  ".$var."<br /><br />";
	
	
	$query="SELECT * FROM  `iris`";
	
	//NORMALISING 'SL' VALUE 
	$amax=0;
	$amin=20;
	
	$rt=mysql_query($query);
	while($nt=mysql_fetch_array($rt))
	{
		$amax=($nt['sl']>$amax)?$nt['sl']:$amax;
		$amin=($nt['sl']<$amin)?$nt['sl']:$amin;
	}
	
	$sl=($sl-$amin)/($amax-$amin);
	$tol=$amin+$var;
	$tsl=($tol-$amin)/($amax-$amin);
	
	
	$tsl=($tsl<0)?(0-$tsl):$tsl;
	$tsl=($tsl==0)?(0.01):$tsl;
	
	echo "sl part ::: <br>amax = ".$amax.", amin = ".$amin.", tol= ".$tsl."<br><br>";
	
	
	//NORMALISING 'SW' VALUE 
	$amax=0;
	$amin=20;
	
	$rt=mysql_query($query);
	while($nt=mysql_fetch_array($rt))
	{
		$amax=($nt['sw']>$amax)?$nt['sw']:$amax;
		$amin=($nt['sw']<$amin)?$nt['sw']:$amin;
	}
	
	$sw=($sw-$amin)/($amax-$amin);
	$tol=$amin+$var;
	$tsw=($tol-$amin)/($amax-$amin);
	
	$tsw=($tsw<0)?(0-$tsw):$tsw;
	$tsw=($tsw==0)?(0.01):$tsw;
	
	echo "sw part ::: <br>amax = ".$amax.", amin = ".$amin.", tol= ".$tsw."<br><br>";
	
	
	//NORMALISING 'PL' VALUE 
	$amax=0;
	$amin=20;
	
	$rt=mysql_query($query);
	while($nt=mysql_fetch_array($rt))
	{
		$amax=($nt['pl']>$amax)?$nt['pl']:$amax;
		$amin=($nt['pl']<$amin)?$nt['pl']:$amin;
	}
	
	$pl=($pl-$amin)/($amax-$amin);
	$tol=$amin+$var;
	$tpl=($tol-$amin)/($amax-$amin);
	
	$tpl=($tpl<0)?(0-$tpl):$tpl;
	$tpl=($tpl==0)?(0.01):$tpl;
	
	echo "pl part ::: <br>amax = ".$amax.", amin = ".$amin.", tol= ".$tpl."<br><br>";
	
	
	//NORMALISING 'PW' VALUE 
	$amax=0;
	$amin=20;
	
	$rt=mysql_query($query);
	while($nt=mysql_fetch_array($rt))
	{
		$amax=($nt['pw']>$amax)?$nt['pw']:$amax;
		$amin=($nt['pw']<$amin)?$nt['pw']:$amin;
	}
	
	$pw=($pw-$amin)/($amax-$amin);
	$tol=$amin+$var;
	$tpw=($tol-$amin)/($amax-$amin);
	
	$tpw=($tpw<0)?(0-$tpw):$tpw;
	$tpw=($tpw==0)?(0.01):$tpw;
	
	echo "pw part ::: <br>amax = ".$amax.", amin = ".$amin.", tol= ".$tpw."<br><br>";
	echo "Normalised values: ".$sl.",  ".$sw.",  ".$pl.",  ".$pw."<br /><br />";
	
	
	$sl1=$sl+$tsl;
	$sl2=$sl-$tsl;
	
	$sw1=$sw+$tsw;
	$sw2=$sw-$tsw;
	
	$pl1=$pl+$tpl;
	$pl2=$pl-$tpl;
	
	$pw1=$pw+$tpw;
	$pw2=$pw-$tpw;
	
	$query="SELECT * FROM  `iris` WHERE  
	`sln` <= $sl1 AND `sln` >= $sl2 AND 
	`swn` <= $sw1 AND `swn` >= $sw2 AND 
	`pln` <= $pl1 AND `pln` >= $pl2 AND 
	`pwn` <= $pw1 AND `pwn` >= $pw2";
	
	
	echo "<br /><br />QUERY SENT: ".$query."<br /><br />";
	
	$rt=mysql_query($query);
	$number=mysql_num_rows($rt); 
	echo "</div>";
	
	
	if($number)
	{
	echo "<table>";
	echo "<tr>";
	echo "<td id=\"tabh\">Sepal Length</td>";
	echo "<td id=\"tabh\">Sepal Width</td>";
	echo "<td id=\"tabh\">Petal Length</td>";
	echo "<td id=\"tabh\">Petal width</td>";
	echo "<td id=\"tabh\">Flower</td>";
	echo "</tr>";
	while($nt=mysql_fetch_array($rt))
	{
	echo "<tr>
	<td id=\"tab\">".$nt['sl']."</td>
	<td id=\"tab\">".$nt['sw']."</td>
	<td id=\"tab\">".$nt['pl']."</td>
	<td id=\"tab\">".$nt['pw']."</td>
	<td id=\"tab\">".$nt['flower']."</td>
	</tr>";
	}
	
	echo "</table><br />";
	
	$rt=mysql_query("SELECT * FROM  `iris`");
	$tnumber=mysql_num_rows($rt); 
	
	
	//NO. OF CASES IN SETOSA TYPE WITH sl,sw,pl,pw IN RANGE
	$query="SELECT * FROM  `iris` WHERE  
	`sln` <= $sl1 AND `sln` >= $sl2 AND 
	`swn` <= $sw1 AND `swn` >= $sw2 AND 
	`pln` <= $pl1 AND `pln` >= $pl2 AND 
	`pwn` <= $pw1 AND `pwn` >= $pw2 AND `flower` LIKE 'setosa'";
	
	$rt=mysql_query($query);
	$setosa_number=mysql_num_rows($rt);
	
	//NO. OF CASES IN versicolor TYPE WITH sl,sw,pl,pw IN RANGE
	$query="SELECT * FROM  `iris` WHERE  
	`sln` <= $sl1 AND `sln` >= $sl2 AND 
	`swn` <= $sw1 AND `swn` >= $sw2 AND 
	`pln` <= $pl1 AND `pln` >= $pl2 AND 
	`pwn` <= $pw1 AND `pwn` >= $pw2 AND `flower` LIKE 'versicolor'";
	
	$rt=mysql_query($query);
	$versicolor_number=mysql_num_rows($rt);
	
	//NO. OF CASES IN virginica TYPE WITH sl,sw,pl,pw IN RANGE
	$query="SELECT * FROM  `iris` WHERE  
	`sln` <= $sl1 AND `sln` >= $sl2 AND 
	`swn` <= $sw1 AND `swn` >= $sw2 AND 
	`pln` <= $pl1 AND `pln` >= $pl2 AND 
	`pwn` <= $pw1 AND `pwn` >= $pw2 AND `flower` LIKE 'virginica'";
	
	$rt=mysql_query($query);
	$virginica_number=mysql_num_rows($rt);
	
	
	//CALCULATING PROBABILITY OF VALUE
	$den=($number/$tnumber);
	$psetosa=($setosa_number/$tnumber)/$den;
	$pversicolor=($versicolor_number/$tnumber)/$den;
	$pvirginica=($virginica_number/$tnumber)/$den;
	
	/*if  ( ( (($psetosa==$pversicolor) && ($psetosa!=0)) || (($psetosa==$pvirginica) && ($pvirginica!=0)) ||(($pversicolor==$pvirginica) && ($pversicolor!=0)) ) && ($var>0) )
			{
				$var=($var-0.05);
				goto equ;
			}*/
	
	echo "<div id=\"tab\" >no. of favourable cases with values in range: ".$number."<br /><br />";
	echo "no. of favourable cases in range with setosa : ".$setosa_number."<br />";
	echo "no. of favourable cases in range with versicolor  : ".$versicolor_number."<br />";
	echo "no. of favourable cases in range with virginica  : ".$virginica_number."<br /><br />";
	
	echo "<div id=\"mires\">PROBABILITY OF setosa     : ".$psetosa."</div>";
	echo "<div id=\"mores\">PROBABILITY OF versicolor : ".$pversicolor."</div>";
	echo "<div id=\"seres\">PROBABILITY OF virginica  : ".$pvirginica."</div><br />";
	
	
	echo "total no. of cases: ".$tnumber."<br />True tolerance variable (TTV) is ".$var.", no. of decrements is ".($nod-1)."<br />";
	
	$answer=0;
	
	if($psetosa>$pversicolor)
	{
	$answer_name="Setosa";
	$answer=$psetosa;
	}
	else
	{
	$answer_name="Versicolor";
	$answer=$pversicolor;
	}
	
	if($answer<$pvirginica)
	{
	$answer_name="Virginica";
	$answer=$pvirginica;
	}
	
	echo '<div style="font-size:18px; color:#093;">Answer is '.$answer_name."</div></div>";
	}
	else
	{
		echo "--- No values found in the range ---";
	}
	$ret[]=$answer_name;
	$ret[]=$var;
	return $ret;
}

list($result,$comp_tol) = classify($sl,$sw,$pl,$pw,$var);
//echo "Result: ".$result." , Tol: ".$comp_tol;


?>