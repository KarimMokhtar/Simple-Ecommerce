<?php 
	function put_title(){
		global $Title;
		if(isset($Title)){
			echo $Title;
		}
		else{
			echo "string";
		}
	}
?>