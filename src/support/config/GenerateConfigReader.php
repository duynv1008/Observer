<?php
namespace DNV\Observer\support\config;
class GenerateConfigReader {
	public static function read(string $value): GeneratorPath {
		return new GeneratorPath(config("modules.paths.generator.$value"));
	}
}