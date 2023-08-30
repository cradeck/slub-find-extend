<?php

namespace Slub\SlubFindExtend\ViewHelpers\Data;

/**
 *
 */

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class OrderedArrayToKvViewHelper extends AbstractViewHelper
{
    /**
     * Register arguments.
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('array', 'array', 'Array with keys and values', false, null);
        $this->registerArgument('translate', 'boolean', 'Should we try to translate data?', false, false);
        $this->registerArgument('translatekey', 'string', 'Where to find translation?', false);
        $this->registerArgument('translatekeyextension', 'string', 'Where to find translation?', false);
        $this->registerArgument('keeporiginalvalue', 'boolean', 'Should we keep original value?', false);
    }

    /**
     * @return array
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $result = [];

        $array = $arguments['array'];
        $translate = $arguments['translate'];
        $translatekey = $arguments['translatekey'];
        $translatekeyextension = $arguments['translatekeyextension'];
        $keeporiginalvalue = $arguments['keeporiginalvalue'];

        if ($array === null) {
            $array = $renderChildrenClosure();
        }

        if (is_array($array) && (count($array) === 0)) {
            return [];
        }

        if (is_array($array) || is_object($array))
        {
            foreach ($array as $key => $value) {
                $innerresult = [];
                $innerkey = '';
                $isKey = true;

                $keyValue = ($translate) ? \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($translatekey.$key, $translatekeyextension) : $key;
                if (strlen($keyValue) === 0) {
                    $keyValue = $key;
                }

                foreach ($value as $innervalue) {
                    if ($isKey === true) {
                        $innerkey = $innervalue;
                        $isKey = false;
                    } elseif ($isKey === false) {
                        $innerkeyValue = ($translate) ? \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($translatekey.$key.'.'.$innerkey, $translatekeyextension) : $innerkey;
                        if (strlen($innerkeyValue) === 0) {
                            $innerkeyValue = $innerkey;
                        }

                        if ($keeporiginalvalue) {
                            $innerresult[$innerkey] = [];
                            $innerresult[$innerkey]['translation'] = $innerkeyValue;
                            $innerresult[$innerkey]['values'] = $innervalue;
                        } else {
                            $innerresult[$innerkeyValue] = $innervalue;
                        }
                        $isKey = true;
                    }
                }

                if ($keeporiginalvalue) {
                    $result[$key] = [];
                    $result[$key]['translation'] = $keyValue;
                    $result[$key]['values'] = $innerresult;
                } else {
                    $result[$keyValue] = $innerresult;
                }
            }
        }

        return $result;
    }
}
