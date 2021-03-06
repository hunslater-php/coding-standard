<?php declare(strict_types = 1);

namespace SlevomatCodingStandard\Sniffs\TypeHints;

class DeclareStrictTypesSniffTest extends \SlevomatCodingStandard\Sniffs\TestCase
{

	public function testMultipleOpenTagsInFile()
	{
		$this->assertNoSniffErrorInFile($this->checkFile(__DIR__ . '/data/declareStrictTypesMultipleOpenTags.php'));
	}

	/**
	 * @return mixed[][]
	 */
	public function dataDeclareStrictTypesMissing(): array
	{
		return [
			[
				__DIR__ . '/data/declareStrictTypesMissing.php',
				1,
			],
			[
				__DIR__ . '/data/declareStrictTypesMissingEmptyFile.php',
				1,
			],
			[
				__DIR__ . '/data/declareTicks.php',
				3,
			],
			[
				__DIR__ . '/data/declareStrictTypesZero.php',
				3,
			],
		];
	}

	/**
	 * @dataProvider dataDeclareStrictTypesMissing
	 * @param string $file
	 * @param int $line
	 */
	public function testDeclareStrictTypesMissing(string $file, int $line)
	{
		$report = $this->checkFile($file);
		$this->assertSniffError(
			$report,
			$line,
			DeclareStrictTypesSniff::CODE_DECLARE_STRICT_TYPES_MISSING
		);
	}

	/**
	 * @return string[][]
	 */
	public function dataDeclareStrictTypesIncorrectFormat(): array
	{
		return [
			[
				__DIR__ . '/data/declareStrictTypesIncorrectFormat1.php',
			],
			[
				__DIR__ . '/data/declareStrictTypesIncorrectFormat2.php',
			],
			[
				__DIR__ . '/data/declareStrictTypesIncorrectFormat3.php',
			],
		];
	}

	/**
	 * @dataProvider dataDeclareStrictTypesIncorrectFormat
	 * @param string $file
	 */
	public function testDeclareStrictTypesIncorrectFormat(string $file)
	{
		$report = $this->checkFile($file);
		$this->assertSniffError(
			$report,
			1,
			DeclareStrictTypesSniff::CODE_INCORRECT_STRICT_TYPES_FORMAT
		);
	}

	public function testDeclareStrictTypesIncorrectFormatNoSpaces()
	{
		$report = $this->checkFile(__DIR__ . '/data/declareStrictTypesIncorrectFormatNoSpaces.php', [
			'spacesCountAroundEqualsSign' => 0,
		]);
		$this->assertSniffError(
			$report,
			1,
			DeclareStrictTypesSniff::CODE_INCORRECT_STRICT_TYPES_FORMAT
		);
	}

	public function testDeclareStrictTwoNewlines()
	{
		$file = __DIR__ . '/data/declareStrictTypesTwoNewlines.php';
		$this->assertNoSniffErrorInFile($this->checkFile($file, [
			'newlinesCountBetweenOpenTagAndDeclare' => ' 2  ',
		]));
	}

	public function testDeclareStrictTwoNewlinesError()
	{
		$report = $this->checkFile(__DIR__ . '/data/declareStrictTypesTwoNewlinesError.php');
		$this->assertSniffError(
			$report,
			3,
			DeclareStrictTypesSniff::CODE_INCORRECT_WHITESPACE_BETWEEN_OPEN_TAG_AND_DECLARE,
			'There must be a single space between the PHP open tag and declare statement.'
		);
	}

	public function testDeclareStrictOneSpaceError()
	{
		$report = $this->checkFile(__DIR__ . '/data/declareStrictTypesOneSpaceError.php', [
			'newlinesCountBetweenOpenTagAndDeclare' => '2',
		]);
		$this->assertSniffError(
			$report,
			1,
			DeclareStrictTypesSniff::CODE_INCORRECT_WHITESPACE_BETWEEN_OPEN_TAG_AND_DECLARE,
			'Expected 2 newlines between PHP open tag and declare statement, found 0.'
		);
	}

	public function testDeclareStrictOneSpace()
	{
		$this->assertNoSniffErrorInFile($this->checkFile(__DIR__ . '/data/declareStrictTypesOneSpace.php'));
	}

	public function testDeclareStrictWithTicks()
	{
		$this->assertNoSniffErrorInFile($this->checkFile(__DIR__ . '/data/declareStrictTypesWithTicks.php'));
	}

	public function testFixableNoNewLines()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesNoNewLines.php', [
			'newlinesCountBetweenOpenTagAndDeclare' => 0,
		], [DeclareStrictTypesSniff::CODE_DECLARE_STRICT_TYPES_MISSING, DeclareStrictTypesSniff::CODE_INCORRECT_WHITESPACE_BETWEEN_OPEN_TAG_AND_DECLARE]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableMissingNoNewLines()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesMissingNoNewLines.php', [
			'newlinesCountBetweenOpenTagAndDeclare' => 0,
		], [DeclareStrictTypesSniff::CODE_DECLARE_STRICT_TYPES_MISSING, DeclareStrictTypesSniff::CODE_INCORRECT_WHITESPACE_BETWEEN_OPEN_TAG_AND_DECLARE]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableOneNewLine()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesOneNewLine.php', [
			'newlinesCountBetweenOpenTagAndDeclare' => 1,
		], [DeclareStrictTypesSniff::CODE_DECLARE_STRICT_TYPES_MISSING, DeclareStrictTypesSniff::CODE_INCORRECT_WHITESPACE_BETWEEN_OPEN_TAG_AND_DECLARE]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableMissingOneNewLine()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesMissingOneNewLine.php', [
			'newlinesCountBetweenOpenTagAndDeclare' => 1,
		], [DeclareStrictTypesSniff::CODE_DECLARE_STRICT_TYPES_MISSING, DeclareStrictTypesSniff::CODE_INCORRECT_WHITESPACE_BETWEEN_OPEN_TAG_AND_DECLARE]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableMoreNewLines()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesMoreNewLines.php', [
			'newlinesCountBetweenOpenTagAndDeclare' => 4,
		], [DeclareStrictTypesSniff::CODE_DECLARE_STRICT_TYPES_MISSING, DeclareStrictTypesSniff::CODE_INCORRECT_WHITESPACE_BETWEEN_OPEN_TAG_AND_DECLARE]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableMissingMoreNewLines()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesMissingMoreNewLines.php', [
			'newlinesCountBetweenOpenTagAndDeclare' => 4,
		], [DeclareStrictTypesSniff::CODE_DECLARE_STRICT_TYPES_MISSING, DeclareStrictTypesSniff::CODE_INCORRECT_WHITESPACE_BETWEEN_OPEN_TAG_AND_DECLARE]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableMissingIncorrectFormatOneSpace()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesIncorrentFormatOneSpace.php', [], [DeclareStrictTypesSniff::CODE_INCORRECT_STRICT_TYPES_FORMAT]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableMissingIncorrectFormatNoSpaces()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesIncorrentFormatNoSpaces.php', [
			'spacesCountAroundEqualsSign' => 0,
		], [DeclareStrictTypesSniff::CODE_INCORRECT_STRICT_TYPES_FORMAT]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableMissingIncorrectFormatMoreSpaces()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesIncorrentFormatMoreSpaces.php', [
			'spacesCountAroundEqualsSign' => 4,
		], [DeclareStrictTypesSniff::CODE_INCORRECT_STRICT_TYPES_FORMAT]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableMissingWithTicks()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesMissingWithTicks.php', [], [DeclareStrictTypesSniff::CODE_DECLARE_STRICT_TYPES_MISSING]);
		$this->assertAllFixedInFile($report);
	}

	public function testFixableDisabled()
	{
		$report = $this->checkFile(__DIR__ . '/data/fixableDeclareStrictTypesDisabled.php', [], [DeclareStrictTypesSniff::CODE_DECLARE_STRICT_TYPES_MISSING]);
		$this->assertAllFixedInFile($report);
	}

}
