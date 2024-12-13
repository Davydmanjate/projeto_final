<?php
namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function index()
    {
        // Recupera os logs de auditoria com paginação
        // $audits = Audit::latest()->paginate(10);
        $audits = Audit::all();

        return view('audits.index', compact('audits'));
    }
}
