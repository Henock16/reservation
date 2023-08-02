<?php


function tri($agent,$niveau,$col,$crit1,$crit2)
	{
<<<<<<< HEAD

=======
	if($crit2>0)
		for($i=0;$i<$niveau;$i++)
			$agent[$i][$crit2]=(($agent[$i][$crit2]==3)?2:(($agent[$i][$crit2]==2)?3:$agent[$i][$crit2]));
	
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
	for($i=$niveau-1;$i>=1;$i--)
		for($j=1;$j<=$i;$j++)
			if(($agent[$j-1][$crit1]>$agent[$j][$crit1])||(($crit2>0)&&($agent[$j-1][$crit1]==$agent[$j][$crit1])&&($agent[$j-1][$crit2]>$agent[$j][$crit2])))
				for($k=0;$k<$col;$k++)
					{
					$tmp=$agent[$j-1][$k];
					$agent[$j-1][$k]=$agent[$j][$k];
					$agent[$j][$k]=$tmp;
					}

<<<<<<< HEAD
=======
	if($crit2>0)
		for($i=0;$i<$niveau;$i++)
			$agent[$i][$crit2]=(($agent[$i][$crit2]==3)?2:(($agent[$i][$crit2]==2)?3:$agent[$i][$crit2]));

>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
	return $agent;
	}

?>
