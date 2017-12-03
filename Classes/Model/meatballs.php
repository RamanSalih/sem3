<?php
	include('top.php');
	$xml=simplexml_load_file("recipes.xml") or die("Error: Cannot create object");
	
	$query = $xml->xpath('/cookbook/recipe[title="Meatballs"]');
	$data = $query[0];
	
	$ingredients = $data->ingredient;
	$recipetext = $data->recipetext;
	$imagepath = $data->imagepath;
	$nutrition = $data->nutrition;

?>	

<h1>Meatballs</h1>
<img src="<?php echo (string) $imagepath ?>" id="recipe" align="middle" alt="">
<h2>Ingredients</h2>
<ul class="list">
	<?php 
		foreach($ingredients->children() as $ingredient) {
			echo "<li>" . $ingredient . "</li>";
		}
	?>
</ul>
		
<h2>Directions</h2>
<ol id="directions">
	<?php
		foreach($recipetext->children() as $direction) {
			echo "<li>" . $direction . "</li>";
		}
	?>
</ol>
		
<h2>Nutrition Facts</h2>
	<?php
		echo (string) $nutrition;
	?>
		
<div id="comments">
	<h2>Comments</h2>
	<?php
		include("connect.php");
		$result = mysqli_query($link, "SELECT id, username, recipe, comment, time FROM comments WHERE recipe='meatballs'");
		if (mysqli_num_rows($result) == 0) {
			echo "<li>There are no comments for this recipe</li>";
		} else {
			$divindex = 1;
			while($row = mysqli_fetch_assoc($result)) {
				// display comments
				echo '<div class="comment_div"> 
					<p class="name">Posted By: ' . $row['username'] . '</p>';
					
					
					if (!empty($_SESSION['username'])) { // check if logged in
						if ($row["username"] == $_SESSION["username"]) { // if you are the author, you can edit this comment
							echo "<div class='show' target='" . $divindex . "'>Click to toggle comment edit form</div>";
							echo "<div id='div" . $divindex . "' class='targetDiv'>
								<form method='post'>
									Edit comment:<br />
									<textarea name='comment' id='comment'></textarea><br />
									<input type='hidden' name='username' id='username' value='" . $_SESSION["username"] . "' />
									<input type='hidden' name='editid' id='editid' value='" . $row['id'] . "' />
									<input type='submit' value='Submit' />
								</form>
							</div>";
						}
					}
					echo '<p class="comment">"' . $row['comment'] . '"</p>';
					echo '<p class="time">' . $row['time'] . '</p>
				</div>';
				$divindex = $divindex + 1;
			}
		}
	?>
</div>

<script> <!-- Script to hide/show div's for editing comment purposes --> 
	$(document).ready(function() {
		$('.targetDiv').hide();
		$(".show").click(function(){
			$(".targetDiv").not($(this).next()).hide(400);
			$("#div" + $(this).attr("target")).toggle(400);
		});
         
	});
</script>

<?php
	if($_SERVER['REQUEST_METHOD'] != 'POST') {
		if (isset($_SESSION["username"])) {
			echo "<h2>Add new comment</h2>
			<form method='post'>
				Name: " . $_SESSION['username'] . "<br />
				Comment:<br />
				<textarea name='comment' id='comment'></textarea><br />
				<input type='hidden' name='username' id='username' value='" . $_SESSION["username"] . "' />
				<input type='submit' value='Submit' />
			</form>";
		} else {
			echo "Login to post new comment";
		}
	} else {
		if (!empty($_POST['editid']) && !empty($_POST['comment'])) { // If 'editid' is sent by form, we are editing a comment
			if ($_SESSION['username'] == $_POST['username']) { // check if user is editing his own comments
				$sql = "UPDATE comments SET comment = '" . $_POST['comment'] . "' WHERE id = " . $_POST['editid'] . ";";
				$result = mysqli_query($link, $sql);
				if(!$result) {
					$_SESSION["message"] = mysqli_error();
					$_SESSION["success"] = false;
				} else {
					$_SESSION["message"] = "Comment successfully edited";
					$_SESSION["success"] = true;
				}
			} else {
				$_SESSION["message"] = "You can only edit your own comments";
				$_SESSION["success"] = false;
			}
		} elseif (!empty($_POST["comment"])) { // else, we are posting a new one
			$sql = "INSERT INTO comments (username, recipe, comment) VALUES ('" . $_POST['username'] . "', 'meatballs', '" . $_POST['comment'] . "')";
            $result = mysqli_query($link, $sql);
            if(!$result) {
				$_SESSION["message"] = mysqli_error();
				$_SESSION["success"] = false;
            } else {
				$_SESSION["message"] = "Comment successfully added";
				$_SESSION["success"] = true;
			}
		} else {
			$_SESSION["message"] = "Comment cannot be empty";
			$_SESSION["success"] = false;
		}
		header("Refresh:0");
	}
	include('bot.php');
?>