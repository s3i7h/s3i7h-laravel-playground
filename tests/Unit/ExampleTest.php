<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     * @noinspection PhpRedundantVariableDocTypeInspection
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function test_that_true_is_true(): void
    {
        /**
         * @var bool $someVariable
         */
        $someVariable = true;
        $this->assertTrue($someVariable);
    }
}
