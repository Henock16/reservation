<?php
	function logger($bdd, $acteur, $action, $cible, $id, $motif){

		$query = $bdd -> prepare("INSERT INTO Journal(VU,ACTEUR, ACTION, CIBLE, ID, MOTIF) VALUES(0,:act, :acti, :cible, :id, :motif)");
		$query -> bindParam(':act',$acteur, PDO::PARAM_INT);
		$query -> bindParam(':acti',$action, PDO::PARAM_INT);
		$query -> bindParam(':cible',$cible, PDO::PARAM_INT);
		$query -> bindParam(':id',$id, PDO::PARAM_INT);
		$query -> bindParam(':motif',$motif, PDO::PARAM_STR);
		$query -> execute();
		$query -> closeCursor();
	}
?>
