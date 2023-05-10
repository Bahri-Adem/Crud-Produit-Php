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
        $erreur = '';
        if (isset($_GET["q"])) {
            $q = $_GET["q"];
        }
        function begnWith($str, $begnString)
        {
            $len = strlen($begnString);
            return (substr($str, 0, $len) == $begnString);
        }
        ?>
        <?php
/*if (($_GET["q"] !== 0)) {
$pdo = new PDO("mysql:host=localhost;dbname=simple1", "root", "");
$req="SELECT * FROM produit WHERE desigintaion =?";
$result=$pdo->prepare($req);
$q = $_GET["q"];
$result->execute([$q]);?>
<?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
<tr>
<td><?php echo htmlspecialchars($row['code']); ?></td>
<td><?php echo htmlspecialchars($row['designation']); ?></td>
<td><?php echo htmlspecialchars($row['prix']); ?></td>
<td><?php echo htmlspecialchars($row['qte']); ?></td>
<td><img src="include\image\<?php echo $row['image']?>"  width="80" height="80"/></td>
<td><?php echo htmlspecialchars($row['code_categorie']);?></td>
<td>
<a href="update.php?code=<?php echo $row['code'];?>" class="edit" ><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
<a href="index.php?code=<?php echo $row['code'];?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
</td>
</tr>
<?php endwhile; ?>
<?php } else*/
if (isset($_GET["q"])) {
    $pdo = new PDO("mysql:host=localhost;dbname=simple1", "root", "");
    $req = "SELECT * FROM produit ORDER BY code";
    $result = $pdo->query($req);
    /*$req="SELECT * FROM produit WHERE desigintaion =?";
    $result=$pdo->prepare($req);
    $q = $_GET["q"];
    $result->execute([$q]);*/?>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
        <?php if (begnWith(strtoupper($row["designation"]), strtoupper($q)) !== false) { ?>
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
        <?php }endwhile;
} ?>
    </tbody>
</table>