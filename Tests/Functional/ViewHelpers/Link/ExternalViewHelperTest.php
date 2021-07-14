<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3\CMS\Fluid\Tests\Functional\ViewHelpers\Link;

use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class ExternalViewHelperTest extends FunctionalTestCase
{
    public function renderDataProvider(): array
    {
        return [
            'renderAddsHttpPrefixIfSpecifiedUriDoesNotContainScheme' => [
                '<f:link.external uri="www.some-domain.tld">some content</f:link.external>',
                '<a href="http://www.some-domain.tld">some content</a>',
            ],
            'renderAddsSpecifiedSchemeIfUriDoesNotContainScheme' => [
                '<f:link.external uri="www.some-domain.tld" defaultScheme="ftp">some content</f:link.external>',
                '<a href="ftp://www.some-domain.tld">some content</a>',
            ],
            'renderDoesNotAddEmptyScheme' => [
                '<f:link.external uri="www.some-domain.tld" defaultScheme="">some content</f:link.external>',
                '<a href="www.some-domain.tld">some content</a>',
            ],
        ];
    }

    /**
     * @test
     * @dataProvider renderDataProvider
     */
    public function render(string $template, string $expected): void
    {
        $view = new StandaloneView();
        $view->setTemplateSource($template);
        self::assertEquals($expected, $view->render());
    }
}
