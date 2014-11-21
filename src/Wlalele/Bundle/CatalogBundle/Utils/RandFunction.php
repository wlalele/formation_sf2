<?php
/**
 * Created by PhpStorm.
 * User: wlalele
 * Date: 11/21/14
 * Time: 10:51 AM
 */

namespace Wlalele\Bundle\CatalogBundle\Utils;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

class RandFunction extends FunctionNode
{
    /**
     * @param \Doctrine\ORM\Query\SqlWalker $sqlWalker
     *
     * @return string
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'RAND()';
    }

    /**
     * @param \Doctrine\ORM\Query\Parser $parser
     *
     * @return void
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}