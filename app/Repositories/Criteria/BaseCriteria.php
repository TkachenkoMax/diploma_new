<?php
namespace App\Repositories\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class BaseCriteria.
 */
abstract class BaseCriteria extends RequestCriteria
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * BaseCriteria constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Check "order_by" request item.
     *
     * @return mixed
     */
    protected function checkOrderBy()
    {
        if ($orderBy = $this->request->get('order_by')) {
            if (in_array($orderBy, $this->sortable)) {
                return $orderBy;
            }
        }

        return false;
    }
}
