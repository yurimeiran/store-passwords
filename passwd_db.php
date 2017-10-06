<?php

session_start();

?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
	
}

tr:nth-child(even) {
    background-color: #dddddd;
}
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}

#username {
	width:100%;
	height:100%;
	}
	
#button{
	
	margin-top:5px;
	width:100px;
	height:50px;
}
</style>

</head>
<body>



<?php 

$servername = "192.168.16.1:3306";
$username = "web";
$password = "//GE1981//Oakland5";
$dbname = "cameras";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "<h1 style='color:green;'>Connected successfully to <strong>$dbname</strong> database</h1>";

//echo"<br>";

$sql = "SELECT * from logins";

$result = $conn->query($sql);
?>
<table>

<tr>
         <th id="id">Id</th>
         <th>Username</th> 
         <th>Password <input id="box" onclick="myFunction()" type="checkbox"></input></th> 
		 <th>Description</th>
</tr>

<?php

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<tr>";
	    echo "<td>" . $row["id"]. "</td>" ."<td>". $row["username"] . "</td> ". "<td style=\"display: ; visibility: hidden \">" .  $row["password"] . "</td>" . " &nbsp <td> ". $row["description"] . "</td> &nbsp" . "";

	}

	} else {
    echo "0 results";
	
	
}

echo " </tr></table>";

?>


<script>

function myFunction() {
	
	var chk = document.getElementById("box");
	
	if (chk = true)
	{
    //alert("Checked!!");
	}

}
</script>


<?php

echo "


<H3>Query Database </H3>
<select id=\"mySelect\">
  <option>SELECT</option>
  <option>INSERT</option>
  <option>ALTER</option>
  <option>DROP</option>
</select>


";
?>
<form action="" method="post">   
<table>

<tr>
         <th id="id">Id</th>
         <th>Username</th> 
         <th>Password</th> 
		 <th>Description</th>
</tr>


<tr>
         <td id="id">1xxx</td>
         <td style="margin:0px; padding: 0px;height: 40px; "><input style="margin:0px; padding: 0px; width: 100%; height: 40px;font-size: 15px" name="username" id="username" type="text" placeholder="username"/></td> 
         <td style="margin:0px; padding: 0px;height: 40px; "><input style="margin:0px; padding: 0px; width: 100%; height: 40px;font-size: 15px" name="password" type="password" placeholder="password"></td> 
		 <td style="margin:0px; padding: 0px;height: 40px; "><input style="margin:0px; padding: 0px; width: 100%; height: 40px;font-size: 15px" name="descript" type="text" placeholder="short description"/></td>
</tr>
</table>
<input type="submit" name="submit" action="passwd_db.php" value="Add Login Details" style="margin: 5px;margin-left:0px; width: 100%; height: 50px;font-size: 20px "></input>
</form>
<?php





if (isset($_POST['submit'])){
	
	$username=$_POST['username'];

$password=$_POST['password'];
$description = $_POST['descript'];
	
	if (!empty($username) && !empty($password) && !empty($description))
	{

		mysqli_query($conn,"INSERT INTO logins (username,password,description)
		        VALUES ('$username','$password','$description')");
				
						if(mysqli_affected_rows($conn) > 0)
				{
						echo "<p>Login Information Added</p>";
						echo "<a href=\"passwd_db.php\">Go Back</a>";
				} 
	else {
	         echo "Employee NOT Added<br />";
	         echo mysqli_error ($conn);
         }
    }
    else if (empty($username) && empty($password) && empty($description))
	    {
	
	       echo "<h3><strong style='color: red'>value is empty</strong></h3>";
	     
	    }
}


	

$conn->close();

?>

</body>
</html>