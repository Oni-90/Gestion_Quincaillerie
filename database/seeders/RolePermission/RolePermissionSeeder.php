<?php

    namespace Database\Seeders\RolePermission;

    use Illuminate\Database\Seeder;
    use App\Models\User;
    use App\Models\Admin;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class RolePermissionSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            //create user roles
            $adminRole = Role::create(['name' => 'admin']);
            $mangerRole = Role::create(['name' => 'manager']);
            $clientRole = Role::create(['name' => 'client']);


            //create user permissions(CRUD PERMISSIONS)
            $create_permission = Permission::create(['name' => 'create permission']);
            $read_permission = Permission::create(['name' => 'read permission']);
            $update_permission = Permission::create(['name' => 'update permission']);
            $delete_permission = Permission::create(['name' => 'delete permission']);

            //create permission manager(CRUD MANAGER)
            $create_manager = Permission::create(['name' => 'create manager']);
            $read_manager = Permission::create(['name' => 'read manager']);
            $update_manager = Permission::create(['name' => 'update manager']);
            $delete_manager = Permission::create(['name' => 'delete manager']);

            //create permission client(CRUD CLIENT)
            $create_client = Permission::create(['name' => 'create client']);
            $read_client = Permission::create(['name' => 'read client']);
            $update_client = Permission::create(['name' => 'update client']);
            $delete_client = Permission::create(['name' => 'delete client']);

            //create permission order(CRUD ORDER)
            $create_order = Permission::create(['name' => 'create order']);
            $read_order = Permission::create(['name' => 'read order']);
            $update_order = Permission::create(['name' => 'update order']);
            $delete_order = Permission::create(['name' => 'delete order']);

            //create permission sale(CRUD SALE)
            $create_sale = Permission::create(['name' => 'create sale']);
            $read_sale = Permission::create(['name' => 'read sale']);
            $update_sale = Permission::create(['name' => 'update sale']);
            $delete_sale = Permission::create(['name' => 'delete sale']);

            //create permission category(CRUD CATEGORY)
            $create_category = Permission::create(['name' => 'create category']);
            $read_category = Permission::create(['name' => 'read category']);
            $update_category = Permission::create(['name' => 'update category']);
            $delete_category = Permission::create(['name' => 'delete category']);

            //create permission product(CRUD PRODUCT)
            $create_product = Permission::create(['name' => 'create product']);
            $read_product = Permission::create(['name' => 'read product']);
            $update_product = Permission::create(['name' => 'update product']);
            $delete_product = Permission::create(['name' => 'delete product']);


            //create default admin account
            User::create([
                'email' => 'admin@gmail.com',
                // 'password' => '2efGq@dminp@sw0rd',@1Amnestio
                'password' => '@1Amnestio',
                'firstname' => 'Mc',
                'lastname' => 'NEAL',
                'phone' => '90000000',
                'type' => 'admin',
            ]) ;

            $user = User::find(1); //find user to create admin with user id

            //check that user isn't null before create admin
            if(!is_null($user)){
                Admin::create([
                    'user_id' => $user->id,
                    'username' => 'Administrateur',
                ]);
            }

            //assign permission to role admin
            $adminRole->givePermissionTo([
                //permission
                $create_permission,
                $read_permission,
                $update_permission,
                $delete_permission,

                //client
                $create_client,
                $read_client,
                $update_client,
                $delete_client,

                //manager
                $create_manager,
                $read_manager,
                $update_manager,
                $delete_manager,

                //product
                $create_product,
                $read_product,
                $update_product,
                $delete_product,

                //category
                $create_category,
                $read_category,
                $update_category,
                $delete_category,

                //order
                $create_order,
                $read_order,
                $update_order,
                $delete_order,

                //sale
                $create_sale,
                $read_sale,
                $update_sale,
                $delete_sale,
            ]);

            //assign permission to role manager
            $mangerRole->givePermissionTo([
                //product
                $create_product,
                $read_product,
                $update_product,

                //category
                $create_category,
                $read_category,
                $update_category,

                //order
                $create_order,
                $read_order,
                $update_order,

                //sale
                $create_sale,
                $read_sale,
                $update_sale,

                //manager
                $read_manager,
                $update_manager,
                $delete_manager,
            ]);

            //assign permission to role client
            $clientRole->givePermissionTo([
                //client
                $create_client,
                $read_client,
                $update_client,
                $delete_client,

                //product
                $read_product,

                //category
                $read_category,
            
                //sale
                $create_sale,
                $read_sale,
                $update_sale,
            ]);

            //assign role and permission to user if exist
            if(!is_null($user)){
                $user->assignRole($adminRole);

                $user->givePermissionTo(Permission::all());
            }
        }
    }
