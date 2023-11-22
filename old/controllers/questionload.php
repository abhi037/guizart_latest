<?php
	
	if($_GET['']){

		$con=mysqli_connect("localhost","root",""); 
		if (!$con)
		{
		    die('Could not connect: ' . mysqli_error());
		}   

		mysqli_select_db("quizart_lms",$con);

		$result=mysqli_query("select questions.*, subject.name from questions  join subject on subject.id= questions.subject_id where questions.id= '".$param1."' ");


		while($data = mysqli_fetch_row($result))
		{   
		    echo "<tr>";
		    echo "<td align=center>$data[0]</td>";
		    echo "<td align=center>$data[1]</td>";
		    echo "<td align=center>$data[2]</td>";
		    echo "<td align=center>$data[3]</td>";
		    echo "<td align=center>$data[4]</td>";
		    echo "</tr>";
		}
	}

?>