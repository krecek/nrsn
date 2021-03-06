<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 *
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 * @package Nette\Latte\Macros
 */



/**
 * Macros for NForms.
 *
 * - {form name} ... {/form}
 * - {input name}
 * - {label name /} or {label name}... {/label}
 * - {formContainer name} ... {/formContainer}
 *
 * @author     David Grudl
 * @package Nette\Latte\Macros
 */
class NFormMacros extends NMacroSet
{

	public static function install(NLatteCompiler $compiler)
	{
		$me = new self($compiler);
		$me->addMacro('form',
			'NFormMacros::renderFormBegin($form = $_form = (is_object(%node.word) ? %node.word : $_control[%node.word]), %node.array)',
			'NFormMacros::renderFormEnd($_form)');
		$me->addMacro('label', array($me, 'macroLabel'), '?></label><?php');
		$me->addMacro('input', '$_input = (is_object(%node.word) ? %node.word : $_form[%node.word]); echo $_input->getControl()->addAttributes(%node.array)', NULL, array($me, 'macroAttrName'));
		$me->addMacro('formContainer', '$_formStack[] = $_form; $formContainer = $_form = (is_object(%node.word) ? %node.word : $_form[%node.word])', '$_form = array_pop($_formStack)');
		$me->addMacro('name', NULL, NULL, array($me, 'macroAttrName'));
	}


	/********************* macros ****************d*g**/


	/**
	 * {label ...} and optionally {/label}
	 */
	public function macroLabel(NMacroNode $node, NPhpWriter $writer)
	{
		$cmd = '$_input = is_object(%node.word) ? %node.word : $_form[%node.word]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(%node.array)';
		if ($node->isEmpty = (substr($node->args, -1) === '/')) {
			$node->setArgs(substr($node->args, 0, -1));
			return $writer->write($cmd);
		} else {
			return $writer->write($cmd . '->startTag()');
		}
	}


	/**
	 * <input n:name> or alias n:input
	 */
	public function macroAttrName(NMacroNode $node, NPhpWriter $writer)
	{
		if ($node->htmlNode->attrs) {
			$reset = array_fill_keys(array_keys($node->htmlNode->attrs), NULL);
			return $writer->write('$_input = (is_object(%node.word) ? %node.word : $_form[%node.word]); echo $_input->getControl()->addAttributes(%var)->attributes()', $reset);
		}
		return $writer->write('$_input = (is_object(%node.word) ? %node.word : $_form[%node.word]); echo $_input->getControl()->attributes()');
	}


	/********************* run-time writers ****************d*g**/


	/**
	 * Renders form begin.
	 * @return void
	 */
	public static function renderFormBegin(NForm $form, array $attrs)
	{
		$el = $form->getElementPrototype();
		$el->action = $action = (string) $el->action;
		$el = clone $el;
		if (strcasecmp($form->getMethod(), 'get') === 0) {
			list($el->action) = explode('?', $action, 2);
			if (($i = strpos($action, '#')) !== FALSE) {
				$el->action .= substr($action, $i);
			}
		}
		echo $el->addAttributes($attrs)->startTag();
	}


	/**
	 * Renders form end.
	 * @return string
	 */
	public static function renderFormEnd(NForm $form)
	{
		$s = '';
		if (strcasecmp($form->getMethod(), 'get') === 0) {
			$url = explode('?', $form->getElementPrototype()->action, 2);
			if (isset($url[1])) {
				list($url[1]) = explode('#', $url[1], 2);
				foreach (preg_split('#[;&]#', $url[1]) as $param) {
					$parts = explode('=', $param, 2);
					$name = urldecode($parts[0]);
					if (!isset($form[$name])) {
						$s .= NHtml::el('input', array('type' => 'hidden', 'name' => $name, 'value' => urldecode($parts[1])));
					}
				}
			}
		}

		foreach ($form->getComponents(TRUE, 'NHiddenField') as $control) {
			if (!$control->getOption('rendered')) {
				$s .= $control->getControl();
			}
		}

		if (iterator_count($form->getComponents(TRUE, 'NTextInput')) < 2) {
			$s .= '<!--[if IE]><input type=IEbug disabled style="display:none"><![endif]-->';
		}

		echo ($s ? "<div>$s</div>\n" : '') . $form->getElementPrototype()->endTag() . "\n";
	}

}
