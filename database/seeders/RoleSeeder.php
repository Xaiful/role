<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard-show',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role-create',
                    'role-list',
                    'role-edit',
                    'role-delete',
                ]
            ],
            [
                'group_name' => 'permission',
                'permissions' => [
                    'permission-list',
                    'permission-create',
                    'permission-edit',
                    'permission-delete',
                ]
            ],
            [
                'group_name' => 'user',
                'permissions' => [
                    'user-list',
                    'user-create',
                    'user-edit',
                    'user-delete',
                ]
            ],

            [
                'group_name' => 'Unit',
                'permissions' => [
                    'units-list',
                    'units-create',
                    'units-edit',
                    'units-delete',
                ]
            ],

            [
                'group_name' => 'Categories',
                'permissions' => [
                    'categories-list',
                    'categories-create',
                    'categories-edit',
                    'categories-delete',
                ]
            ],

            [
                'group_name' => 'Subategories',
                'permissions' => [
                    'subcategories-list',
                    'subcategories-create',
                    'subcategories-edit',
                    'subcategories-delete',
                ]
            ],

            [
                'group_name' => 'Raw_materials',
                'permissions' => [
                    'raw-materials-list',
                    'raw-materials-create',
                    'raw-materials-edit',
                    'raw-materials-delete',
                ]
            ],

            [
                'group_name' => 'rawmaterialshops',
                'permissions' => [
                    'rawmaterialshops-list',
                    'rawmaterialshops-create',
                    'rawmaterialshops-edit',
                    'rawmaterialshops-delete',
                ]
            ],

            [
                'group_name' => 'Product',
                'permissions' => [
                    'products-list',
                    'products-create',
                    'products-edit',
                    'products-delete',
                ]
            ],

            [
                'group_name' => 'Devision',
                'permissions' => [
                    'devisions-list',
                    'devisions-create',
                    'devisions-edit',
                    'devisions-delete',
                ]
            ],

            [
                'group_name' => 'District',
                'permissions' => [
                    'districts-list',
                    'districts-create',
                    'districts-edit',
                    'districts-delete',
                ]
            ],

            [
                'group_name' => 'SubDistrict',
                'permissions' => [
                    'subdistricts-list',
                    'subdistricts-create',
                    'subdistricts-edit',
                    'subdistricts-delete',
                ]
            ],
        ];
    

        $roleSuperAdmin = Role::create(['name' => 'Admin']);
        $roleNSM = Role::create(['name' => 'NSM']);
        $roleRSM = Role::create(['name' => 'RSM']);
        $roleASM = Role::create(['name' => 'ASM']);
        $roleSPO = Role::create(['name' => 'SPO']);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'web']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

        // Assign super admin role permission to superadmin user
        $admin = User::where('email', 'superadmin@gmail.com')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }

    }
}
