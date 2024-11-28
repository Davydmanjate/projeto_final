<?php
namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function index()
    {
        // Recupera os logs de auditoria com paginação
        $audits = Audit::latest()->paginate(10);

        return view('audits', compact('audits'));
    }
}
