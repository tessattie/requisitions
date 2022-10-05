<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DocumentsFixture
 */
class DocumentsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'location' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-08-12 14:32:29',
                'modified' => '2022-08-12 14:32:29',
                'user_id' => 1,
            ],
        ];
        parent::init();
    }
}
