<?php

namespace Jishadp\SaasRolesPermissions\Datatables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Jishadp\SaasRolesPermissions\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($model){
                $editUrl = route('saas.roles.edit', ['id' => encrypt($model->id)]);
                $permissionUrl = route('saas.roles.permissions', ['id' => encrypt($model->id)]);
                return '
                <a href="'.route('saas.roles.permissions',encrypt($model->id)).'" class="btn btn-primary btn-sm"> Permissions </a>
                <a href="javascript:void(0)" class="btn btn-primary btn-sm editButtonModal" data-action="' . $editUrl . '" title="Edit"> <i class="fas fa-edit"></i> </a>
                    <a action="' . route('saas.roles.delete', encrypt($model->id)) . '" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light deleteAction btn-sm"
                    title="Delete Group"> <i class="fas fa-trash-alt"></i>
                </a>';
            })

            ->addColumn('serial_number', function ($row) {
                static $counter = 0;
                $counter++;
                return request('start') + $counter;
            })
            ->rawColumns(['serial_number', 'action', 'whatsapp_no'])
            ->setRowId('id');

    }

    public function query(Role $model): QueryBuilder
    {
        return $model->latest('id');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('roles-table')
                    ->columns($this->getColumns())
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                    ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('serial_number')->title('Sl.')->width(50),
            Column::make('name')->title('Name'),
            Column::computed('action')
                ->exportable(true)
                ->printable(true)
                ->width(250)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Roles' . date('YmdHis');
    }
}
