<?php

namespace Database\Seeders;

use Dcat\Admin\Models;
use Illuminate\Database\Seeder;
use DB;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        Models\Menu::truncate();
        Models\Menu::insert(
            [
                [
                    "id" => 1,
                    "parent_id" => 0,
                    "order" => 1,
                    "title" => "Index",
                    "icon" => "feather icon-bar-chart-2",
                    "uri" => "/",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => NULL
                ],
                [
                    "id" => 2,
                    "parent_id" => 0,
                    "order" => 5,
                    "title" => "Admin",
                    "icon" => "feather icon-settings",
                    "uri" => "",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => "2024-01-07 16:48:53"
                ],
                [
                    "id" => 3,
                    "parent_id" => 2,
                    "order" => 6,
                    "title" => "Users",
                    "icon" => "",
                    "uri" => "auth/users",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => "2024-01-07 16:48:53"
                ],
                [
                    "id" => 4,
                    "parent_id" => 2,
                    "order" => 7,
                    "title" => "Roles",
                    "icon" => "",
                    "uri" => "auth/roles",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => "2024-01-07 16:48:53"
                ],
                [
                    "id" => 5,
                    "parent_id" => 2,
                    "order" => 8,
                    "title" => "Permission",
                    "icon" => "",
                    "uri" => "auth/permissions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => "2024-01-07 16:48:53"
                ],
                [
                    "id" => 6,
                    "parent_id" => 2,
                    "order" => 9,
                    "title" => "Menu",
                    "icon" => "",
                    "uri" => "auth/menu",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => "2024-01-07 16:48:53"
                ],
                [
                    "id" => 7,
                    "parent_id" => 2,
                    "order" => 10,
                    "title" => "Extensions",
                    "icon" => "",
                    "uri" => "auth/extensions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => "2024-01-07 16:48:53"
                ],
                [
                    "id" => 8,
                    "parent_id" => 0,
                    "order" => 2,
                    "title" => "站点",
                    "icon" => "fa-wordpress",
                    "uri" => "/sites",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 16:42:44",
                    "updated_at" => "2024-01-07 16:45:32"
                ],
                [
                    "id" => 9,
                    "parent_id" => 0,
                    "order" => 3,
                    "title" => "内容管理",
                    "icon" => "fa-file-text-o",
                    "uri" => NULL,
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 16:47:51",
                    "updated_at" => "2024-01-07 16:48:53"
                ],
                [
                    "id" => 10,
                    "parent_id" => 9,
                    "order" => 4,
                    "title" => "分类",
                    "icon" => "fa-certificate",
                    "uri" => "/categories",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 16:48:18",
                    "updated_at" => "2024-01-07 16:48:53"
                ],
                [
                    "id" => 11,
                    "parent_id" => 9,
                    "order" => 11,
                    "title" => "文章",
                    "icon" => "fa-file-word-o",
                    "uri" => "/posts",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2024-01-07 16:51:56",
                    "updated_at" => "2024-01-07 16:52:05"
                ]
            ]
        );

        Models\Permission::truncate();
        Models\Permission::insert(
            [
                [
                    "id" => 1,
                    "name" => "Auth management",
                    "slug" => "auth-management",
                    "http_method" => "",
                    "http_path" => "",
                    "order" => 1,
                    "parent_id" => 0,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => NULL
                ],
                [
                    "id" => 2,
                    "name" => "Users",
                    "slug" => "users",
                    "http_method" => "",
                    "http_path" => "/auth/users*",
                    "order" => 2,
                    "parent_id" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => NULL
                ],
                [
                    "id" => 3,
                    "name" => "Roles",
                    "slug" => "roles",
                    "http_method" => "",
                    "http_path" => "/auth/roles*",
                    "order" => 3,
                    "parent_id" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => NULL
                ],
                [
                    "id" => 4,
                    "name" => "Permissions",
                    "slug" => "permissions",
                    "http_method" => "",
                    "http_path" => "/auth/permissions*",
                    "order" => 4,
                    "parent_id" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => NULL
                ],
                [
                    "id" => 5,
                    "name" => "Menu",
                    "slug" => "menu",
                    "http_method" => "",
                    "http_path" => "/auth/menu*",
                    "order" => 5,
                    "parent_id" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => NULL
                ],
                [
                    "id" => 6,
                    "name" => "Extension",
                    "slug" => "extension",
                    "http_method" => "",
                    "http_path" => "/auth/extensions*",
                    "order" => 6,
                    "parent_id" => 1,
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => NULL
                ],
                [
                    "id" => 7,
                    "name" => "站点管理",
                    "slug" => "site_manager",
                    "http_method" => "",
                    "http_path" => "/sites*",
                    "order" => 7,
                    "parent_id" => 0,
                    "created_at" => "2024-01-08 03:36:03",
                    "updated_at" => "2024-01-08 03:36:03"
                ],
                [
                    "id" => 8,
                    "name" => "站点查看",
                    "slug" => "sites_view",
                    "http_method" => "GET",
                    "http_path" => "/sites/options*,/sites*",
                    "order" => 8,
                    "parent_id" => 0,
                    "created_at" => "2024-01-08 03:36:57",
                    "updated_at" => "2024-01-08 03:36:57"
                ],
                [
                    "id" => 9,
                    "name" => "分类管理",
                    "slug" => "cate_manager",
                    "http_method" => "",
                    "http_path" => "/categories*,/categories/options*",
                    "order" => 9,
                    "parent_id" => 0,
                    "created_at" => "2024-01-08 03:42:51",
                    "updated_at" => "2024-01-08 03:43:34"
                ],
                [
                    "id" => 10,
                    "name" => "分类查看",
                    "slug" => "cate_view",
                    "http_method" => "GET",
                    "http_path" => "/categories/options*,/categories*",
                    "order" => 10,
                    "parent_id" => 0,
                    "created_at" => "2024-01-08 03:43:24",
                    "updated_at" => "2024-01-08 03:43:24"
                ],
                [
                    "id" => 11,
                    "name" => "文章管理",
                    "slug" => "post_manager",
                    "http_method" => "",
                    "http_path" => "/posts*",
                    "order" => 11,
                    "parent_id" => 0,
                    "created_at" => "2024-01-08 03:46:35",
                    "updated_at" => "2024-01-08 03:46:35"
                ]
            ]
        );

        Models\Role::truncate();
        Models\Role::insert(
            [
                [
                    "id" => 1,
                    "name" => "Administrator",
                    "slug" => "administrator",
                    "created_at" => "2024-01-07 06:47:06",
                    "updated_at" => "2024-01-07 06:47:06"
                ],
                [
                    "id" => 2,
                    "name" => "运营",
                    "slug" => "ops",
                    "created_at" => "2024-01-08 03:38:12",
                    "updated_at" => "2024-01-08 03:38:12"
                ]
            ]
        );

        Models\Setting::truncate();
		Models\Setting::insert(
			[

            ]
		);

		Models\Extension::truncate();
		Models\Extension::insert(
			[

            ]
		);

		Models\ExtensionHistory::truncate();
		Models\ExtensionHistory::insert(
			[

            ]
		);

        // pivot tables
        DB::table('admin_permission_menu')->truncate();
		DB::table('admin_permission_menu')->insert(
			[
                [
                    "permission_id" => 7,
                    "menu_id" => 8,
                    "created_at" => "2024-01-08 03:36:03",
                    "updated_at" => "2024-01-08 03:36:03"
                ],
                [
                    "permission_id" => 8,
                    "menu_id" => 8,
                    "created_at" => "2024-01-08 03:36:57",
                    "updated_at" => "2024-01-08 03:36:57"
                ],
                [
                    "permission_id" => 9,
                    "menu_id" => 9,
                    "created_at" => "2024-01-08 03:42:51",
                    "updated_at" => "2024-01-08 03:42:51"
                ],
                [
                    "permission_id" => 9,
                    "menu_id" => 10,
                    "created_at" => "2024-01-08 03:42:51",
                    "updated_at" => "2024-01-08 03:42:51"
                ],
                [
                    "permission_id" => 10,
                    "menu_id" => 9,
                    "created_at" => "2024-01-08 03:43:24",
                    "updated_at" => "2024-01-08 03:43:24"
                ],
                [
                    "permission_id" => 10,
                    "menu_id" => 10,
                    "created_at" => "2024-01-08 03:43:24",
                    "updated_at" => "2024-01-08 03:43:24"
                ],
                [
                    "permission_id" => 11,
                    "menu_id" => 9,
                    "created_at" => "2024-01-08 03:46:35",
                    "updated_at" => "2024-01-08 03:46:35"
                ],
                [
                    "permission_id" => 11,
                    "menu_id" => 11,
                    "created_at" => "2024-01-08 03:46:35",
                    "updated_at" => "2024-01-08 03:46:35"
                ]
            ]
		);

        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "role_id" => 1,
                    "menu_id" => 1,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 2,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 3,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 4,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 5,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 6,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 7,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 8,
                    "created_at" => "2024-01-07 16:42:44",
                    "updated_at" => "2024-01-07 16:42:44"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 9,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 10,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 11,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 1,
                    "created_at" => "2024-01-08 03:38:12",
                    "updated_at" => "2024-01-08 03:38:12"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 8,
                    "created_at" => "2024-01-08 03:38:12",
                    "updated_at" => "2024-01-08 03:38:12"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 9,
                    "created_at" => "2024-01-08 03:44:26",
                    "updated_at" => "2024-01-08 03:44:26"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 10,
                    "created_at" => "2024-01-08 03:44:26",
                    "updated_at" => "2024-01-08 03:44:26"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 11,
                    "created_at" => "2024-01-08 03:46:51",
                    "updated_at" => "2024-01-08 03:46:51"
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "role_id" => 1,
                    "permission_id" => 2,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "permission_id" => 3,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "permission_id" => 4,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "permission_id" => 5,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "permission_id" => 6,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "permission_id" => 7,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "permission_id" => 8,
                    "created_at" => "2024-01-08 03:37:39",
                    "updated_at" => "2024-01-08 03:37:39"
                ],
                [
                    "role_id" => 1,
                    "permission_id" => 11,
                    "created_at" => "2024-01-08 03:46:44",
                    "updated_at" => "2024-01-08 03:46:44"
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 7,
                    "created_at" => "2024-01-08 03:38:12",
                    "updated_at" => "2024-01-08 03:38:12"
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 8,
                    "created_at" => "2024-01-08 03:38:12",
                    "updated_at" => "2024-01-08 03:38:12"
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 10,
                    "created_at" => "2024-01-08 03:44:26",
                    "updated_at" => "2024-01-08 03:44:26"
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 11,
                    "created_at" => "2024-01-08 03:46:51",
                    "updated_at" => "2024-01-08 03:46:51"
                ]
            ]
        );

        // finish
    }
}
