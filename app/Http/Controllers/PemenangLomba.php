<?php

namespace App\Http\Controllers;

use App\Models\pemenang_lomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemenangLomba extends Controller
{
    public function imageUpload(Request $request) {
        $data = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
            'attachment' => 'file|mimes:pdf|max:2048', // Limit file types and size
            'nama_lomba' => 'required|string',
            'keterangan' => 'required|string',
            'nama_kelas' => 'required|string',
        ]);
    
        try {
            // Process attachment
            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $attachmentPath = $attachment->store('attachments');
            }
    
            // Save data to the database
            $pemenangLomba = new pemenang_lomba;
            if ($request->hasFile('image')) {
                $filename = $request->file('image')->getClientOriginalName(); 
                $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); 
                $getfileExtension = $request->file('image')->getClientOriginalExtension(); 
                $createnewFileName = time().'_'.str_replace(' ','_', $getfilenamewitoutext).'.'.$getfileExtension; 
                $img_path = $request->file('image')->storeAs('public/post_img', $createnewFileName); 
                $pemenangLomba->image = $createnewFileName; 
            }
            
            $pemenangLomba->nama_lomba = $data['nama_lomba'];
            $pemenangLomba->keterangan = $data['keterangan'];
            $pemenangLomba->nama_kelas = $data['nama_kelas'];
            $pemenangLomba->save();
    
            // Send email
            Mail::to($data['to'])->send(new SendEmail($data['subject'], $data['message'], $attachmentPath));
    
            return response()->json(['message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send email', 'error' => $e->getMessage()], 500);
        }
    }
}