<?php

$bagian = isset($_POST['bagian']) ? $_POST['bagian'] : 1;

if ($bagian == 1) {
?>
    <form method="post">
        <br><br>
        <label>Inputkan Jumlah Baris: </label>
        <input type="number" name="baris" required min="1"><br><br>

        <label>Inputkan Jumlah Kolom: </label>
        <input type="number" name="kolom" required min="1"><br><br>

        <input type="hidden" name="bagian" value="2">
        <button type="submit" style="margin-left:120px;">SUBMIT</button>
    </form>
<?php
} elseif ($bagian == 2) {
    $baris = (int) $_POST['baris'];
    $kolom = (int) $_POST['kolom'];
?>
    <form method="post">
        <br><br>
        <?php
        for ($b = 1; $b <= $baris; $b++) {
            for ($k = 1; $k <= $kolom; $k++) {
                echo "<strong>$b.$k: </strong><input type='text' name='data[$b][$k]' required> ";
            }
            echo "<br><br>";
        }
        ?>
        <input type="hidden" name="baris" value="<?php echo $baris; ?>">
        <input type="hidden" name="kolom" value="<?php echo $kolom; ?>">
        <input type="hidden" name="bagian" value="3">
        <button type="submit" style="margin-left:200px;">SUBMIT</button>
    </form>
<?php
} elseif ($bagian == 3) {
    $data = $_POST['data'];
    foreach ($data as $b => $kolom) {
        foreach ($kolom as $k => $nilai) {
            echo "<strong>$b.$k : " . htmlspecialchars($nilai) . "</strong><br>";
        }
    }
}
?>