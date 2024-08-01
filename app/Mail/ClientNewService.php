<?php
namespace App\Mail;

use App\Models\User;
use App\Models\Order;
use DNS2D;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientNewService extends Mailable
{
    use SerializesModels;

    public User $user;
    public Order $order;

    public function __construct(User $user,Order $order)
    {

        $this->user = $user;
        $this->order = $order;
    }

    public function build():ClientNewService
    {
        $this->to($this->user->email);
        $this->attachData(base64_decode(DNS2D::getBarcodePNG(url('qr/'.$this->order->uuid), 'QRCODE',4.55,4.55)),'qr.png');

        return $this->view('emails.clientNewService');
    }
}
