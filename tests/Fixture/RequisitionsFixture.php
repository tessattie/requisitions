<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RequisitionsFixture
 */
class RequisitionsFixture extends TestFixture
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
                'requisition_number' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-08-12 14:32:42',
                'modified' => '2022-08-12 14:32:42',
                'due_date' => '2022-08-12',
                'category_id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'location' => 'Lorem ipsum dolor sit amet',
                'full_name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'amount_requested' => 1,
                'amount_authorized' => 1,
                'archived' => 1,
                'rate' => 1,
                'status' => 1,
            ],
        ];
        parent::init();
    }
}
