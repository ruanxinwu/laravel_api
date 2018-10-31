<?php
namespace Logic;

use App\Http\models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderLogic extends BaseLogic
{
    protected $table = 'orders';

    /**
     * 根据主键 id 查询
     * @param $id
     * @param array $selects
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|
     * \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find($id,$selects = ['*'])
    {
        return Order::query()->select($selects)->find($id);
    }

    /**
     * 根据订单编号查询
     * @param $orderNo
     * @param array $selects
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function findOrderNo($orderNo,$selects = ['*'])
    {
        return Order::query()->select($selects)->where('order_no','=',$orderNo)->first();
    }

    /**
     * 插入数据
     * @param array $array
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function insert(array $array)
    {
        return Order::query()->create($array); //  create() 只有在模型类Order里面的$fillable属性设置为白名单才能被赋值
    }

    /**
     * 作用域
     * @param $status
     * @return mixed
     */
    public function scope($status)
    {
        return Order::popular($status)->get();
    }

}