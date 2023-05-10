<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php?error=You don't have the right to access this page");
  exit;
}
if (isset($_GET['code'])) {
  $pdo = new PDO("mysql:host=localhost;dbname=simple1", "root", "");
  $code = $_GET['code'];
  $req = "SELECT * FROM produit WHERE code=$code";
  $result = $pdo->query($req);
  $row = $result->fetch(PDO::FETCH_ASSOC);
} ?>

<head>
  <?php
require "include/header.php";
?>
</head>
<style>
  * {
    box-sizing: border-box;
  }

  input[type=text],
  input[type=number],
  input[type=file],
  input[type=list],
  select,
  textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }

  label {
    padding: 12px 12px 12px 0;
    display: inline-block;
  }

  input[type=submit] {
    background-color: #04AA6D;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
  }

  input[type=submit]:hover {
    background-color: #45a049;
  }

  .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    margin: 0px 0px 0px 20px;
  }

  .col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
  }

  .col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  h1 {
    text-align: center;
  }

  /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
  @media screen and (max-width: 600px) {

    .col-25,
    .col-75,
    input[type=submit] {
      width: 100%;
      margin-top: 0;
    }
  }
</style>
<h1> Edit Product</h1>

<body>
  <div class="container">
    <form action="index.php" method="get">
      <div class="row">
        <div class="col-25">
          <label>Code</label>
        </div>
        <div class="col-75">
          <input type="number" name="codee" value="<?php echo htmlspecialchars($row['code']); ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label>Designation</label>
        </div>
        <div class="col-75">
          <input type="text" name="dess" value="<?php echo htmlspecialchars($row['designation']); ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label>Prix Unitaire</label>
        </div>
        <div class="col-75">
          <input type="number" name="PUU" value="<?php echo htmlspecialchars($row['prix']); ?>" required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label>Quantité en stock</label>
        </div>
        <div class="col-75">
          <input type="number" name="Qtee" value="<?php echo htmlspecialchars($row['qte']); ?>" required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label>Image</label>
        </div>
        <div class="col-75">
          <input type="file" name="img" value="<?php echo htmlspecialchars($row['image']); ?>">
        </div>
      </div>
      <?php /* <div class="row">
    <div class="col-25">
    <label>Categorie</label>
    </div>
    <div class="col-75">
    <input type="number" name="Catt" value="<?php echo htmlspecialchars($row['code_categorie']); ?>"  required>
    </div>
    </div>
    */?>
      <div class="row">
        <div class="col-25">
          <label for="categories">Categorie</label>
        </div>
        <div class="col-75">
          <input list="categories" id="input" name="Catt"
            value="<?php echo htmlspecialchars($row['code_categorie']); ?>" class="form-control" required>
        </div>
        <datalist id="categories">
          <?php
      $pdo = new PDO("mysql:host=localhost;dbname=simple1", "root", "");
      $req = "SELECT * FROM categorie ORDER BY code";
      $result = $pdo->query($req); ?>
          <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
          <option value=<?php echo htmlspecialchars($row['code']); ?>>
            <?php echo htmlspecialchars($row['nom']); ?>
          </option>
          <?php endwhile; ?>
        </datalist>
      </div>
      <div>
        <input type="submit" value="Edit">
      </div>
    </form>
  </div>

</body>


</html>