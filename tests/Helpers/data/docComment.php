<?php

/**
 * Class WithDocComment
 *
 * @see https://www.slevomat.cz
 */
abstract class WithDocCommentAndDescription
{

	/**
	 * Constant WITH_DOC_COMMENT_AND_DESCRIPTION
	 *
	 * @var bool
	 */
	const WITH_DOC_COMMENT_AND_DESCRIPTION = true;

	/**
	 * @var bool
	 */
	const WITH_DOC_COMMENT = true;

	const WITHOUT_DOC_COMMENT = false;

	/**
	 * Property with doc comment and description
	 *
	 * @var bool
	 */
	private $withDocCommentAndDescription;

	/**
	 * @var bool
	 */
	protected static $withDocComment;

	public $withoutDocComment;

	/**
	 * Function with doc comment and description
	 *
	 * @see Whatever
	 */
	final public function withDocCommentAndDescription($d)
	{

	}

	/**
	 * @see Whatever
	 */
	public static function withDocComment($b, $c)
	{

	}

	abstract public function withoutDocComment();

}

/**
 * @see https://www.zlavomat.sk
 */
interface WithDocComment
{

}

trait WithoutDocComment
{

}
