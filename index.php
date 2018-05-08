<?php
	require_once 'vendor/autoload.php';

	use JsonSchema\Validator;
	use JsonSchema\Constraints\Constraint;

	$content = [
		0 => [
			'vorname' => 'Stephan',
			'name' => 'Krauss',
			'alter' => 60
		],
		[
			'vorname' => 'Antje',
			'name' => 'Krauss',
			'alter' => 59
		]
	];

	var_dump($content);
	exit();

	$jsonContent = json_encode($content);

	// $fileContent = file_get_contents('config.json');
	// $config = json_decode($fileContent);

	$config = json_decode($jsonContent);

	$validator = new Validator;

	$validator->validate(
	  $config,
	  (object)['$ref' => 'file://' . realpath('array_schema.json')],
	  Constraint::CHECK_MODE_APPLY_DEFAULTS
	);

	if ($validator->isValid()) {
	  echo "JSON validates OK\n";
	}
	else {
	  echo "JSON validation errors:\n";

	  foreach ($validator->getErrors() as $error) {
	    print_r($error);
	  }
	}

	print "\nResulting config:\n";

	print_r($config);