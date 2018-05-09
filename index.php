<?php
	require_once 'vendor/autoload.php';

	use JsonSchema\Validator;
	use JsonSchema\Constraints\Constraint;

	$fileContent = file_get_contents('example/'.'example.json');
	$fileContent = json_decode($fileContent);

	$schemaContent = file_get_contents('example/'.'example_schema.json');
	$schemaContent = json_decode($schemaContent);

	$validator = new Validator;

	$validator->validate(
		$fileContent,
		$schemaContent,
	  Constraint::CHECK_MODE_APPLY_DEFAULTS
	);

	if ($validator->isValid()) {
	  echo "JSON validates OK\n";
	}
	else
	{
		echo "JSON validation errors:\n";

		foreach ($validator->getErrors() as $error) {
			print_r($error);
		}
	}