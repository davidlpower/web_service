<?php
$data = null;
foreach ($temp as $key => $value) {
    $data[] = $value;
}
?>
<html>
    <h3>This is where I want to display my graph</h3>
    <img src="graph_bar.php?mydata=<?php echo urlencode(serialize($data)); ?>" />
</html>