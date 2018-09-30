<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\models\Order;
use App\Http\Traits\ControllerTraits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultController extends Controller
{
    use ControllerTraits;
    public function show(Request $request) :array
    {
        Cache::put('name',array(23,33,334,45),10);
        $user = $request->user;

        //$order = new Order();
        $res = Order::findOrderNo(123,['id','order_no']);
        //Order::query()->create(['order_no' => 111111]);
        pd_var($res->order_no,Cache::get('name'));
        // 给 $role_id = 4 添加权限
//        try{
//            (Role::findById(4))->givePermissionTo('permission_1');
//        }catch(\Exception $e){
//            return response()->json($this->apiResponseError(400,$e->getMessage()));
//        }


        // 给用户添加权限
        //$user = User::query()->find(41)->givePermissionTo('permission_1');

        pd_var(
            $request->route()->getAction(),
            $user->permissions->toArray(),
            $user->getAllPermissions()->toArray(),
            $user->getDirectPermissions()->toArray(),
            $user->getPermissionsViaRoles()->toArray());
        $role = Role::create(['name' => 'writer']);
        $permission = Permission::create(['name' => 'edit articles']);
        pd_var($role->givePermissionTo($permission));
        $role = new Role();
        $permission = new Permission();

        $res = $role->givePermissionTo('edit articles');
        pd($res);
    }
}
