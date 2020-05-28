<?php

namespace App\Admin\Controllers;


use App\Models\Category;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;
use Illuminate\Routing\Controller;

class CategoryController
{
    use HasResourceActions;
    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->title('分类')
            ->description('列表')
            ->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
//                    $form->action(admin_url('auth/menu'));

                    $menuModel = new Category();
//                    $permissionModel = config('admin.database.permissions_model');
//                    $roleModel = config('admin.database.roles_model');

                    $form->select('parent_id', '父级ID')->options($menuModel::selectOptions());
                    $form->text('title', '分类名称')->rules('required');
//                    $form->icon('icon', trans('admin.icon'))->default('fa-bars')->rules('required')->help($this->iconHelp());
//                    $form->text('uri', trans('admin.uri'));
//                    $form->multipleSelect('roles', trans('admin.roles'))->options($roleModel::all()->pluck('name', 'id'));
//                    if ((new $menuModel())->withPermission()) {
//                        $form->select('permission', trans('admin.permission'))->options($permissionModel::pluck('name', 'slug'));
//                    }
                    $form->hidden('_token')->default(csrf_token());

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });
    }

    /**
     * Redirect to edit page.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return redirect()->route('admin.auth.menu.edit', ['menu' => $id]);
    }

    /**
     * @return \Encore\Admin\Tree
     */
    protected function treeView()
    {
        $menuModel = new Category();

        $tree = new Tree(new $menuModel());

        $tree->disableCreate();

        $tree->branch(function ($branch) {
            $payload = "<strong>{$branch['title']}</strong>";

//            if (!isset($branch['children'])) {
//                if (url()->isValidUrl($branch['uri'])) {
//                    $uri = $branch['uri'];
//                } else {
//                    $uri = admin_url($branch['uri']);
//                }
//
//                $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\">$uri</a>";
//            }

            return $payload;
        });

        return $tree;
    }

    /**
     * Edit interface.
     *
     * @param string  $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title('分类')
            ->description('编辑')
            ->row($this->form()->edit($id));
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $menuModel = new Category();
//        $permissionModel = config('admin.database.permissions_model');
//        $roleModel = config('admin.database.roles_model');

        $form = new Form(new $menuModel());

        $form->display('id', 'ID');
        $form->select('parent_id', '父级ID')->options($menuModel::selectOptions());
        $form->text('title', '标题')->rules('required');
//        $form->icon('icon', trans('admin.icon'))->default('fa-bars')->rules('required')->help($this->iconHelp());
//        $form->text('uri', trans('admin.uri'));
//        $form->multipleSelect('roles', trans('admin.roles'))->options($roleModel::all()->pluck('name', 'id'));
//        if ($form->model()->withPermission()) {
//            $form->select('permission', trans('admin.permission'))->options($permissionModel::pluck('name', 'slug'));
//        }

//        $form->display('created_at', trans('admin.created_at'));
//        $form->display('updated_at', trans('admin.updated_at'));

        return $form;
    }

    /**
     * Help message for icon field.
     *
     * @return string
     */
    protected function iconHelp()
    {
        return 'For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>';
    }
}