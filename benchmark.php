<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Benchmark/Timer.php';

//$timer = new Benchmark_Timer(TRUE);
//Timer is in automatic mode, so timing starts here.

/*
$j = array();

for ($i=0; $i < 100; $i++) {
 $j[] = $i;
	if($i == 24) {
		$timer->setMarker('25');
	}   
	if($i == 49) {
		$timer->setMarker('50');
	}   
	if($i == 74) {
		$timer->setMarker('75');
	}
	if($i == 99) {
		$timer->setMarker('100');
	}
}
*/

//Timer automatically stops and results are displayed.



//echo PHP_PEAR_PHP_BIN;
//$timer->display();

/*
$profiling = $timer->getProfiling();
echo "<pre>";
print_r($profiling);
echo "</pre>";
*/


//$db = new DB_msql();
//print_r($db);

?>
<!DOCTYPE html>
<html>
<body>
<h1>My First Heading</h1>
<p>My first paragraph.</p>
<table>
  <tr>
	<th>Nº</th>
    <th>Month</th>
    <th>Savings</th>
  </tr>
<?php
$timer = new Benchmark_Timer(TRUE);
for ($i=0; $i < 10; $i++) {
?>  
  <tr>
    <td><?php echo $i; ?></td>
    <td>January</td>
    <td>$100</td>
  </tr>
<?php
if($i == 4)
$timer->setMarker('5');
}

$timer->display();
?>
</table>


</body>
</html>