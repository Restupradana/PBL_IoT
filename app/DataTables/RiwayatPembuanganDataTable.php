<?php

namespace App\DataTables;

use App\Models\RiwayatPembuangan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RiwayatPembuanganDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<RiwayatPembuangan> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('nama_tempat_sampah', function (RiwayatPembuangan $riwayat) {
            return $riwayat->tempatSampah ? $riwayat->tempatSampah->nama : 'Tidak tersedia';
        })
            ->addColumn('nama_petugas', function (RiwayatPembuangan $riwayat) {
                return $riwayat->pengguna ? $riwayat->pengguna->name : 'Tidak tersedia';
            })
            ->editColumn('jenis_sampah', function (RiwayatPembuangan $riwayat) {
                $jenisClasses = [
                    'plastik' => 'bg-blue-100 text-blue-800',
                    'residu' => 'bg-green-100 text-green-800',
                    'metal' => 'bg-yellow-100 text-yellow-800',
                    'organik' => 'bg-red-100 text-red-800',
                ];
                
                $class = $jenisClasses[strtolower($riwayat->jenis_sampah)] ?? 'bg-gray-100 text-gray-800';
                $label = ucfirst($riwayat->jenis_sampah);
                
                return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . $class . '">' . $label . '</span>';
            })
            ->editColumn('berat_sampah_dibuang', function (RiwayatPembuangan $riwayat) {
                return $riwayat->berat_sampah_dibuang . ' kg';
            })
            ->addColumn('status', function (RiwayatPembuangan $riwayat) {
                // Determine status based on weight and capacity
                $status = 'Normal';
                $statusClass = 'bg-green-100 text-green-800';
                
                if ($riwayat->tempatSampah) {
                    $kapasitasSaatIni = $riwayat->tempatSampah->kapasitas_saat_ini;
                    $kapasitasMaksimal = $riwayat->tempatSampah->kapasitas_maksimal;
                    $persentase = ($kapasitasSaatIni / $kapasitasMaksimal) * 100;
                    
                    if ($persentase >= 90) {
                        $status = 'Penuh';
                        $statusClass = 'bg-red-100 text-red-800';
                    } elseif ($persentase >= 70) {
                        $status = 'Hampir Penuh';
                        $statusClass = 'bg-yellow-100 text-yellow-800';
                    }
                }
                
                return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . $statusClass . '">' . $status . '</span>';
            })
            ->editColumn('waktu_pembuangan', function (RiwayatPembuangan $riwayat) {
                return $riwayat->waktu_pembuangan;
            })
            ->addColumn('action', function (RiwayatPembuangan $riwayat) {
                $viewBtn = '<a href="#" class="text-blue-600 hover:text-blue-900 mr-2">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>';
                
                return $viewBtn;
            })
            ->rawColumns(['jenis_sampah', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<RiwayatPembuangan>
     */
    public function query(RiwayatPembuangan $model): QueryBuilder
    {
        return $model->with(['tempatSampah', 'pengguna'])->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('riwayatpembuangan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(5, 'desc') // Order by waktu_pembuangan desc
                    ->lengthMenu([[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]])
                    ->pageLength(25)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('print'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                  ->title('ID')
                  ->width(60),
            Column::make('nama_tempat_sampah')
                  ->title('Nama Tempat Sampah')
                  ->searchable(true)
                  ->orderable(true),
            Column::make('nama_petugas')
                  ->title('Petugas')
                  ->searchable(true)
                  ->orderable(true),
            Column::make('jenis_sampah')
                  ->title('Kategori Sampah')
                  ->searchable(true)
                  ->orderable(true),
            Column::make('berat_sampah_dibuang')
                  ->title('Berat')
                  ->searchable(true)
                  ->orderable(true),
            Column::make('waktu_pembuangan')
                  ->title('Waktu Pembuangan')
                  ->searchable(true)
                  ->orderable(true),
            Column::computed('status')
                  ->title('Status')
                  ->searchable(false)
                  ->orderable(false),
            Column::computed('action')
                  ->title('Aksi')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'RiwayatPembuangan_' . date('YmdHis');
    }
}