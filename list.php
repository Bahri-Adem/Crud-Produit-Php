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
if (isset($_GET['value'])) {
	$req = "SELECT * FROM produit WHERE code_categorie=?";
	$value = $_GET['value'];
	$result = $pdo->prepare($req);
	if ($value == 1) {
		$result->execute([1]);
	} elseif ($value == 2) {
		$result->execute([2]);
	} elseif ($value == 3) {
		$result->execute([3]);
	} elseif ($value == 4) {
		$result->execute([4]);
	} else {
		$req = "SELECT * FROM produit ORDER BY code";
		$result = $pdo->query($req);
	}
	if (!$result) {
		$erreur = $pdo->errorInfo();
		echo "Lecture impossible, code", $pdo->errorCode(), $erreur[2];
	} else { ?>
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
			<td><img src="include\image\<?php echo $row['image'] ?>" width="80" height="80" /></td>
			<td>
				<?php echo htmlspecialchars($row['code_categorie']); ?>
			</td>
			<td>
				<a href="update.php?code=<?php echo $row['code']; ?>" class="edit"><i class="material-icons"
						data-toggle="tooltip" title="Edit">&#xE254;</i></a>
				<a href="index.php?code=<?php echo $row['code']; ?>" class="delete"><i class="material-icons"
						data-toggle="tooltip" title="Delete">&#xE872;</i></a>
			</td>
		</tr>
		<?php endwhile; ?>
		<?php }
	$pdo = null;
}
    ?>
	</tbody>
</table>