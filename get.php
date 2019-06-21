<?php
$id = $_GET['id'];
include "php/connection.php";
$sql = "select Jumlah from Barang where IdBarang = $id";
$hasil=mysqli_query ($conn,$sql);
echo "<select name='jumlah' >";
while ($row = mysqli_fetch_array($hasil)) 
{
  echo "<option value='" . $row['Jumlah'] . "'> " . $row['Jumlah'] . " </option>";
}
echo "</select>";
?>