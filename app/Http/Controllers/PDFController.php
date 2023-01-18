<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\User;
use App\Mail\email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Log;
//use App\User;
//use Mail;
use Log;
use App\Mail\EmailPDF;




class PDFController extends Controller {


    public function generatePDF() {
        $user = User::all();

        $data = [
            'users' => $user,
            'title' => 'Lista de Utilizadores',
            'date' => date('d/m/Y')
        ];


        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('myPDF.pdf');
    }


    /*public function emailPDF() {
        $user = User::all();
        $data = [
            'users' => $user,
            'title' => 'Lista de Utilizadores',
            'date' => date('d/m/Y')
        ];
        $pdf = PDF::loadView('pdf_attachment', $data);
        try {
            Mail::to('real@mail.com')->send(new EmailPDF($data));
            Mail::send('pdf_attachment', $data, function ($message) use ($pdf) {
                $message->to('real@mail.com')->subject($data ["title"] )->attachData($pdf->output(), "text.pdf");
            });
            Log::info('PDF sent to ' . 'real@mail.com');
        } catch (\Exception $e) {
            Log::error('Error sending PDF: ' . $e->getMessage());
        }
    }*/

    /*public function emailPDF() {
        $user = User::all();
        $data = [
            'users' => $user,
            'title' => 'Lista de Utilizadores',
            'date' => date('d/m/Y')
        ];
        $pdf = \PDF::loadView('pdf_attachment', $data);
        $pdf->setOptions(['binary' => '"C:\wkhtmltopdf\bin"']);

        $pdf_path = public_path().'/pdf/invoice.pdf';

        $pdf->save($pdf_path);
        try {
            Mail::to('real@mail.com')->send(new EmailPDF($data, $pdf_path));
            Log::info('PDF sent to ' . 'real@mail.com');
        } catch (\Exception $e) {
            Log::error('Error sending PDF: ' . $e->getMessage());
        }
    }*/

    public function emailPDF() {
        $user = User::all();
        $data = [
            'name' => Auth::user()->name,
            'title' => 'Lista de Utilizadores',
            'date' => date('d/m/Y')
        ];
        $pdf = PDF::loadView('pdf_attachment', $data);
        $pdf->setOptions(['encoding' => 'UTF-8']);
        try {
            Mail::send('pdf_attachment', $data, function ($message) use ($data, $pdf) {
                $message->to('real@mail.com')->subject($data["title"])->attachData($pdf->output(), "text.pdf");
            });
            Log::info('PDF sent to ' . 'real@mail.com');
        } catch (\Exception $e) {
            Log::error('Error sending PDF: ' . $e->getMessage());
        }
        return redirect('/home');
    }
}
