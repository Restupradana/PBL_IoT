<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\RiwayatPembuanganDataTable;

class RiwayatPembuanganController extends Controller
{
    public function index(RiwayatPembuanganDataTable $dataTable){
        return $dataTable->render('history.index');
    }
}
