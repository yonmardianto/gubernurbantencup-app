<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Models\Participant;
use App\Models\Setting;

use App\Traits\FileUpload;

use Auth;

use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{

    use FileUpload;


     /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user= Auth::user();

        $payments = Payment::where('manager_id', $user->id)->orderby('id', 'desc')->get();
        $lock = filter_var(Setting::where('key', 'lock application')->value('value'), FILTER_VALIDATE_BOOLEAN);
        return view('frontend.manager-dashboard.payments.index', compact('payments', 'lock'));
    }

      /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.manager-dashboard.payments.create');
    }


    public function store(Request $request)
    {

        $user = Auth::user();
        $messages = [
            'club.required' => 'Club wajib diisi',
            'file.required' => 'Bukti pembayaran wajib diupload',
            'file.max' => 'File bukti pembayaran maximum size 1MB',
            'description.required' => 'Deskripsi wajib diisi',
            'description.max' => 'Panjang deskripsi tidak boleh melebihi 255 karakter'
        ];

        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'file'=> ['required','mimes:jpg,jpeg,png', 'max:1024'],
            'club'=> ['required']
        ], $messages);


        $payment = Payment::create([
            'club' => $request->club,
            'description'=> $request->description,
            'manager_id'=> $user->id

        ]);

        if($request->file('file')){
            $this->uploadFile($request->file('file'), 'bukti-transfer', 'pembayaran_', $payment);
         }


        return Redirect::route('manager-team.payments.index')->with('success', 'Data bukti transfer anda berhasil disubmit');

    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);

         //Check exist foto ? delete it
         $documents = $payment->documents()->get();
         if(count($documents) > 0) {
             foreach($documents as $item){
                 //delete storage
                 $this->removeFile($item->path);
             }
         }

         //delete file on documents table
         $payment->documents()->delete();

         //delete
         $payment->delete();

         return Redirect::route('manager-team.payments.index')->with('success', 'Data payment berhasil dihapus');
    }

    public function getUserBuktiTransfer(string $user_id)
    {

        $payments = Payment::where('manager_id', $user_id)->get();
        $manager = User::where('id', $user_id)->first();
        return view('admin.clubs.payments.show', compact('payments', 'manager'));

    }



}
