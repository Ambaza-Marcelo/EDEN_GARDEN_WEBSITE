<?php
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolePermissionSeeder.
 *
 * @see https://spatie.be/docs/laravel-permission/v5/basic-usage/multiple-guards
 *
 * @package App\Database\Seeds
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Permission List as array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    // admin Permissions
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                ]
            ],

            [
                'group_name' => 'setting',
                'permissions' => [
                    // setting Permissions
                    'setting.create',
                    'setting.view',
                    'setting.edit',
                    'setting.delete',
                ]
            ],

            [
                'group_name' => 'actualite',
                'permissions' => [
                    // actualite Permissions
                    'actualite.create',
                    'actualite.view',
                    'actualite.edit',
                    'actualite.delete',
                ]
            ],

            [
                'group_name' => 'categorie_chambre',
                'permissions' => [
                    // categorie_chambre Permissions
                    'categorie_chambre.create',
                    'categorie_chambre.view',
                    'categorie_chambre.edit',
                    'categorie_chambre.delete',
                ]
            ],

            [
                'group_name' => 'categorie_restauration',
                'permissions' => [
                    // categorie_restauration Permissions
                    'categorie_restauration.create',
                    'categorie_restauration.view',
                    'categorie_restauration.edit',
                    'categorie_restauration.delete',
                ]
            ],

            [
                'group_name' => 'categorie_salle',
                'permissions' => [
                    // categorie_salle Permissions
                    'categorie_salle.create',
                    'categorie_salle.view',
                    'categorie_salle.edit',
                    'categorie_salle.delete',
                ]
            ],

            [
                'group_name' => 'salle',
                'permissions' => [
                    // salle Permissions
                    'salle.create',
                    'salle.view',
                    'salle.edit',
                    'salle.delete',
                ]
            ],

            [
                'group_name' => 'chambre',
                'permissions' => [
                    // chambre Permissions
                    'chambre.create',
                    'chambre.view',
                    'chambre.edit',
                    'chambre.delete',
                ]
            ],

            [
                'group_name' => 'restauration',
                'permissions' => [
                    // restauration Permissions
                    'restauration.create',
                    'restauration.view',
                    'restauration.edit',
                    'restauration.delete',
                ]
            ],

            [
                'group_name' => 'evenement',
                'permissions' => [
                    // evenement Permissions
                    'evenement.create',
                    'evenement.view',
                    'evenement.edit',
                    'evenement.delete',
                ]
            ],

            [
                'group_name' => 'paillote',
                'permissions' => [
                    // paillote Permissions
                    'paillote.create',
                    'paillote.view',
                    'paillote.edit',
                    'paillote.delete',
                ]
            ],

            [
                'group_name' => 'testimonial',
                'permissions' => [
                    // testimonial Permissions
                    'testimonial.create',
                    'testimonial.view',
                    'testimonial.edit',
                    'testimonial.delete',
                ]
            ],

            [
                'group_name' => 'team',
                'permissions' => [
                    // team Permissions
                    'team.create',
                    'team.view',
                    'team.edit',
                    'team.delete',
                ]
            ],

            [
                'group_name' => 'gallerie',
                'permissions' => [
                    // gallerie Permissions
                    'gallerie.create',
                    'gallerie.view',
                    'gallerie.edit',
                    'gallerie.delete',
                ]
            ],

            [
                'group_name' => 'reservation',
                'permissions' => [
                    // reservation Permissions
                    'reservation.create',
                    'reservation.view',
                    'reservation.confirm',
                    'reservation.edit',
                    'reservation.delete',
                ]
            ],

            [
                'group_name' => 'certification',
                'permissions' => [
                    // certification Permissions
                    'certification.create',
                    'certification.view',
                    'certification.edit',
                    'certification.delete',
                ]
            ],

            [
                'group_name' => 'messages',
                'permissions' => [
                    // messages Permissions
                    'messages.create',
                    'messages.view',
                    'messages.edit',
                    'messages.delete',
                ]
            ],

            [
                'group_name' => 'position',
                'permissions' => [
                    // position Permissions
                    'position.create',
                    'position.view',
                    'position.edit',
                    'position.delete',
                ]
            ],

            [
                'group_name' => 'slider',
                'permissions' => [
                    // slider Permissions
                    'slider.create',
                    'slider.view',
                    'slider.edit',
                    'slider.delete',
                ]
            ],

            [
                'group_name' => 'commentaire',
                'permissions' => [
                    // commentaire Permissions
                    'commentaire.create',
                    'commentaire.view',
                    'commentaire.edit',
                    'commentaire.publish',
                    'commentaire.delete',
                ]
            ],

            [
                'group_name' => 'about',
                'permissions' => [
                    // about Permissions
                    'about.create',
                    'about.view',
                    'about.edit',
                    'about.delete',
                ]
            ],
            
            [
                'group_name' => 'profile',
                'permissions' => [
                    // profile Permissions
                    'profile.view',
                    'profile.edit',
                ]
            ],
        ];

        // Do same for the admin guard for tutorial purposes
        $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'admin']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

        // Assign super admin role permission to superadmin user
        $admin = Admin::where('username', 'superadmin')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }
    }
}
