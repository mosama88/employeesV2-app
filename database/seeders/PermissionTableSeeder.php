<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * List of permissions to add.
     */


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [
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
        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);
        }


    }
}
