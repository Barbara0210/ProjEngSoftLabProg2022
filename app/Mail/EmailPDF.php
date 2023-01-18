<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPDF extends Mailable {
    use Queueable, SerializesModels;

    public $data;
    public $pdf_path;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $pdf_path) {
        $this->data = $data;
        $this->pdf_path = $pdf_path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('pdf_attachment')
            ->with('data', $this->data)
            ->attach($this->pdf_path, [
                'as' => 'invoice.pdf',
                'mime' => 'application/pdf',
            ])
            ->subject($this->data['title']);
    }
}
