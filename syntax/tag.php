<?php

/**
 * Info tIndexmenu tag: Tag a page with a sort number. 
 *
 * @license     GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author      Samuele Tognini <samuele@netsons.org>
 * @author     	 Rene Hadler <rene.hadler@iteas.at>
 * 
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
 
/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_indexmenu_tag extends DokuWiki_Syntax_Plugin {
  
  /**
   * return some info
   */
  function getInfo(){
    return array(
		 'author' => 'Samuele Tognini mod. by Rene Hadler',
		 'email'  => 'samuele@netsons.org, rene.hadler@iteas.at',
		 'date'   => rtrim(io_readFile(DOKU_PLUGIN.'tindexmenu/VERSION.txt')),
		 'name'   => 'tIndexmenu tag',
		 'desc'   => 'tIndexmenu tag plugin.',
		 'url'    => 'http://wiki.splitbrain.org/plugin:tindexmenu'
		 );
  }
  
  /**
   * What kind of syntax are we?
   */
  function getType(){
    return 'substition';
  }
 
  /**
   * Where to sort in?
   */
  function getSort(){
    return 139;
  }
 
  /**
   * Connect pattern to lexer
   */
  function connectTo($mode) {
    $this->Lexer->addSpecialPattern('{{indexmenu_n>.+?}}',$mode,'plugin_indexmenu_tag');
  }
      
  /**
   * Handle the match
   */
  function handle($match, $state, $pos, &$handler){
    $match = substr($match,14,-2);
    return array($match);
  }

  /**
   * Render output
   */
  function render($mode, &$renderer, $data) {
    if (is_numeric($data[0])) $renderer->meta['indexmenu_n'] = $data[0];;
  }
}