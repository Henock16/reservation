<?php


function tri($agent,$niveau,$col,$crit1,$crit2)
	{

	for($i=$niveau-1;$i>=1;$i--)
		for($j=1;$j<=$i;$j++)
			if(($agent[$j-1][$crit1]>$agent[$j][$crit1])||(($crit2>0)&&($agent[$j-1][$crit1]==$agent[$j][$crit1])&&($agent[$j-1][$crit2]>$agent[$j][$crit2])))
				for($k=0;$k<$col;$k++)
					{
					$tmp=$agent[$j-1][$k];
					$agent[$j-1][$k]=$agent[$j][$k];
					$agent[$j][$k]=$tmp;
					}

	return $agent;
	}

?>
