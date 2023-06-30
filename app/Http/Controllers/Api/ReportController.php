<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fans;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $allReport = Report::query()->with(['users', 'fans'])
            ->where('content', 'like', "%{$search}%")
            ->orWhere('fans_id', 'like', "%{$search}%")
            ->paginate($perPage);
        return response([$allReport]);
    }

    public function receiveReport(Request $request)
    {
        $content = $request->validate([
            'content' => 'required|string',
            'fans_id' => 'required|integer'
        ]);
        $user = $request->user();
        if ($user) {
            $report = Report::create([
                'content' => $content['content'],
                'fans_id' => $content['fans_id'],
                'user_id' => $user->id
            ]);
            return response(['reportContent' => $report]);
        }
    }

    public function deleteReport($id)
    {
        $report = Report::where('id', $id)->first();
        if ($report) {
            $report->delete();
        }
    }
}
