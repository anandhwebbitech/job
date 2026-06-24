<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;


class AdminResumeController extends Controller
{
    //
    public function index()
    {
        return view('admin.resumes.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'resumes.*' => 'required|mimes:pdf,doc,docx|max:5120'
        ]);

        if ($request->hasFile('resumes')) {

            foreach ($request->file('resumes') as $file) {

                $fileName = time().'_'.$file->getClientOriginalName();

                $file->move(
                    public_path('uploads/resumes'),
                    $fileName
                );

                Resume::create([
                    'resume'   => $fileName,
                    'is_admin' => 1
                ]);
            }
        }   

        return back()->with(
            'success',
            'Resumes uploaded successfully.'
        );
    }
}
