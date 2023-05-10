<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: login.php?error=You don't have the right to access this page");
	exit;
}
if (isset($_GET['codee'])) {
	$pdo = new PDO("mysql:host=localhost;dbname=simple1", "root", "");
	$code = $_GET['codee'];
	$des = $_GET['dess'];
	$pu = $_GET['PUU'];
	$qte = $_GET['Qtee'];
	$codd = $_GET['Catt'];
	$req = "UPDATE `produit` SET `designation` = '$des', `prix` = '$pu', `qte` = '$qte', `code_categorie` = '$codd' WHERE `produit`.`code` = '$code'";
	$pdo->exec($req);
	if ((!empty($_GET["img"]))) {
		$img = $_GET['img'];
		$req = "UPDATE produit SET image='$img' WHERE code='$code' ";
		$pdo->exec($req);
	}
}
if (isset($_GET['code'])) {
	$pdo = new PDO("mysql:host=localhost;dbname=simple1", "root", "");
	$code = $_GET['code'];
	$req = "DELETE FROM  produit WHERE code='$code'";
	$pdo->exec($req);
}
?>
<?php
 if (isset($_GET['cod'])) {
	 $pdo = new PDO("mysql:host=localhost;dbname=simple1", "root", "");
	 $cod = $_GET['cod'];
	 $des = $_GET['des'];
	 $pu = $_GET['pu'];
	 $qte = $_GET['qte'];
	 $img = $_GET['img'];
	 $codd = $_GET['codd'];
	 $req = "INSERT INTO produit VALUES ('$cod', '$des', '$pu', '$qte', '$img', '$codd')";
	 $pdo->exec($req);
 }
 ?>
<?php
/*echo 'DOCUMENT_ROOT : ' . $_SERVER['C:/xampp/htdocs/simple1'] . '<br />';
switch ($_GET['action']) {
case 'upload':
$root = $_SERVER['C:/xampp/htdocs/simple1'] . '/';
$repertoire_upload_absolu   = $root . 'include/image/';
$the_name = $_FILES['img']['name'];
$result = move_uploaded_file($_FILES['img']['tmp_name'], $repertoire_upload_absolu.$the_name);
echo 'result : ' . $result . '<br />';
break;
}*/
?>

<?php
require "include/header.php";
?>
<main>
	<script type="text/javascript">
		function getXMLHttpRequest() {
			var xhr = null;
			try {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {
				xhr = new XMLHttpRequest();
			}
			return xhr;
		}
		function search(code) {
			var xhr = getXMLHttpRequest();
			obj = document.getElementById("resultat");
			obj.innerHTML = "";
			xhr.open("GET", "list.php?value=" + code, true);
			xhr.send();
			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					document.getElementById("resultat").innerHTML = xhr.responseText;
				}
			}
		}
	</script>
	<script>
		function showResult(str) {
			if (str.length == 0) {
				document.getElementById("livesearch").innerHTML = "";
				document.getElementById("livesearch").style.border = "0px";
				return;
			}
			if (window.XMLHttpRequest) {// IE7+, Firefox, Chrome, Opera, Safari 
				xmlhttp = new XMLHttpRequest();
			}
			else {// IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
					document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET", "livesearch.php?q=" + str, true);
			xmlhttp.send();
		}
	</script>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Gestion <b>Produit</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
									class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
						</div>
						<div class="col-sm-6">
							<form>
								<select class="box" name="founisseur" onchange="search(this.value)">
									<option value="0">Tous les Produits</option>
									<option value="1">Flowers</option>
									<option value="2">Roses</option>
									<option value="3">Violets</option>
									<option value="4">Bouquets</option>
								</select>
							</form>
						</div>
						<div>
							<div class="input-group">
								<div class="form-outline">
									<form>
										<input placeholder="Search By Name" type="search" id="form1"
											class="form-control" onkeyup="showResult(this.value)">
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div id="livesearch">
					<div id="resultat">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Designation</th>
									<th>Prix Unitaire</th>
									<th>Quantité en stock</th>
									<th>Images</th>
									<th>Categorie</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
                    $pdo = new PDO("mysql:host=localhost;dbname=simple1", "root", "");
                    $req = "SELECT * FROM produit ORDER BY code";
                    $result = $pdo->query($req); ?>
								<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
								<tr>
									<td>
										<?php echo htmlspecialchars($row['code']); ?>
									</td>
									<td>
										<?php echo htmlspecialchars($row['designation']); ?>
									</td>
									<td>
										<?php echo htmlspecialchars($row['prix']); ?>
									</td>
									<td>
										<?php echo htmlspecialchars($row['qte']); ?>
									</td>
									<td><img src="include\image\<?php echo $row['image'] ?>" width="80" height="80" />
									</td>
									<td>
										<?php echo htmlspecialchars($row['code_categorie']); ?>
									</td>
									<td>
										<a href="update.php?code=<?php echo $row['code']; ?>" class="edit"><i
												class="material-icons" data-toggle="tooltip"
												title="Edit">&#xE254;</i></a>
										<a href="index.php?code=<?php echo $row['code']; ?>" class="delete"><i
												class="material-icons" data-toggle="tooltip"
												title="Delete">&#xE872;</i></a>
									</td>
								</tr>
								<?php endwhile; ?>

								<?php
                            /*if(!$result) {
							$erreur=$pdo->errorInfo();
							echo "Lecture impossible, code", $pdo->errorCode(),$erreur[2];
							}else {
							$rows = $result->fetchAll(PDO::FETCH_NUM);
							foreach($rows as $row){
							echo '<tr>';
							foreach($row as $donn){
							echo '<td>' .$donn.'</td>';}
							$code=$row[0];
							echo '<td>
							<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="index.php?code='.$code.'"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
							</td>';
							echo '</tr><br>';}
							}*/
                            ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="clearfix">
					<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Previous</a></li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item active"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Next</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->

	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="index.php" method="get">
					<div class="modal-header">
						<h4 class="modal-title">Ajouter Produit</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Code</label>
							<input type="number" name="cod" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Designation</label>
							<input type="text" name="des" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Prix Unitaire</label>
							<input type="number" name="pu" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Quantité en stock</label>
							<input type="number" name="qte" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Image</label>
							<input type="file" name="img" class="form-control" required>
						</div>
						<?php /*<div class="form-group">
					 <label>Code categorie</label>
					 <input type="number" name="codd" class="form-control" required>
					 </div>	*/?>
						<div class="form-group">
							<label for="categories">Code Categorie</label>
							<input list="categories" id="input" name="codd" class="form-control" required>
							<datalist id="categories">
								<?php
                        $pdo = new PDO("mysql:host=localhost;dbname=simple1", "root", "");
                        $req = "SELECT * FROM categorie ORDER BY code";
                        $result = $pdo->query($req); ?>
								<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
								<option value="<?php echo htmlspecialchars($row['code']); ?>">
									<?php echo htmlspecialchars($row['nom']); ?>
								</option>
								<?php endwhile; ?>
							</datalist>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="ADD">
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="index.php" method="get">
					<div class="modal-header">
						<h4 class="modal-title">Edit Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>


</main>
<?php
require "include/footer.php";
?>