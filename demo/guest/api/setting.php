<?php
function getPre(){
		
				$query = sprintf("SELECT * FROM `preference` WHERE uid='%s'",
		mysql_real_escape_string(1));
	$result = mysql_query($query);
				
				
				if (!$result) {
				    $message  = 'Invalid query: ' . mysql_error() . "\n";
				    $message .= 'Whole query: ' . $query;
				    echo $message;
				}
				else{    
				while($row=mysql_fetch_array($result))
			$hotel[]=$row;
			
		return $hotel;
				}
			}
			else echo "Invalid Access Token";
		}else echo "parameters missing for changeprofile";
	  
			
}

?>