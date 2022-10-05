<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotesFixture
 */
class NotesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'requisition_id' => 1,
                'description' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'created' => '2022-08-12 14:32:36',
                'modified' => '2022-08-12 14:32:36',
            ],
        ];
        parent::init();
    }
}
