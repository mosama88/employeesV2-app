<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissions = [
        'الأعدادت العامه',
        'العطلات الرسميه',
        'الدرجات الوظيفية',
        'المسمى الوظيفى',
        'النيابات و الأدارات',
        'الموظفين',
        'أضافة موظف',
        'حذف الموظف',
        'تعديل الموظف',
        'المستخدمين',
        'قائمة المستخدمين',
        'الاجازات',
        'أضافة أجازه',
        'حذف الاجازه',
        'تعديل الاجازه',
        'عرض الموظفين',
        'المرفقات',
        'تحميل المرفق'
    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@dt.com',
            'password' => Hash::make('password'),
            'status'=>'مفعل',
        ]);

        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'User']);
        $role = Role::create(['name' => 'Super Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
