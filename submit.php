<?

require_once('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] != "POST") {
	$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
	header($protocol . ' 405 Method Not Allowed');

	die('Not permited');
}

$postData = $_POST;

$device_hash = $postData['device_hash'];
$device_name = $postData['device_name'];
$device_version = $postData['device_version'];
$device_country = $postData['device_country'];
$device_carrier = $postData['device_carrier'];
$device_carrier_id = $postData['device_carrier_id'];

$rom_name = $postData['rom_name'];
$rom_version = $postData['rom_version'];;

if ((empty($device_hash) || empty($device_name) || empty($device_version) || empty($rom_name))) {
	$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
	header($protocol . ' 400 Bad Request');

	die('Incomplete data');
}

$deviceData = DB::query('SELECT * FROM zrom_stats WHERE device_hash = %s', $device_hash);

if ($deviceData) {
	DB::update('zrom_stats', array(
		'date_last_checking' => DB::sqlEval("NOW()"),
		'device_name' => $device_name,
		'device_version' => $device_version,
		'device_country' => $device_country,
		'device_carrier' => $device_carrier,
		'device_carrier_id' => $device_carrier_id,
		'rom_name' => $rom_name,
		'rom_version' => $rom_version
	), "device_hash=%s", $device_hash);
} else {
	DB::insert('zrom_stats', array(
		'date_register' => DB::sqlEval("NOW()"),
		'date_last_checking' => DB::sqlEval("NOW()"),
		'device_hash' => $device_hash,
		'device_name' => $device_name,
		'device_version' => $device_version,
		'device_country' => $device_country,
		'device_carrier' => $device_carrier,
		'device_carrier_id' => $device_carrier_id,
		'rom_name' => $rom_name,
		'rom_version' => $rom_version
	));
}

echo "OK";
