<?php
/**
 * @author Semih Serhat Karakaya <karakayasemi@itu.edu.tr>
 *
 * @copyright Copyright (c) 2018, ownCloud GmbH
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace Tests\Core\Command\User;

use OC\Core\Command\User\ListUsers;
use Symfony\Component\Console\Tester\CommandTester;
use Test\TestCase;

/**
 * Class ListUsersTest
 *
 * @group DB
 */
class ListUsersTest extends TestCase
{
    /** @var CommandTester */
    private $commandTester;

    protected function setUp() {
        parent::setUp();

        \OC::$server->getUserManager()->createUser('user1','password');
        $command = new ListUsers(\OC::$server->getUserManager());
        $this->commandTester = new CommandTester($command);
    }

    protected function tearDown() {
        parent::tearDown();
        \OC::$server->getUserManager()->get('user1')->delete();
    }


    /**
     * @dataProvider inputProvider
     * @param array $input
     * @param string $expectedOutput
     */
    public function testCommandInput($input, $expectedOutput) {
        $this->commandTester->execute($input);
        $output = $this->commandTester->getDisplay();
        $this->assertContains($expectedOutput, $output);
    }

    public function inputProvider() {
        return [
            [[], 'user1'],
            [['search-pattern' => 'user'], 'user1']
        ];
    }

}