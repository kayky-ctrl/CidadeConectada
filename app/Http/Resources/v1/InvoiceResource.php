<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    private array $types = ['C' => 'Cartão', 'B' => 'Boleto', 'P' => 'Pix'];

    public function toArray(Request $request): array
    {
        $paid = $this->paid;

        return [
            'user' => [
                'firstName' => $this->user->firstName,
                'lastName' => $this->user->lastName,
                'fullname' => $this->user->firstName . ' ' . $this->user->lastName,
                'email' => $this->user->email,
            ],

            'type'=> $this->types[$this->type],

            'value' => 'R$ ' . number_format($this->value, 2, ',', '.'),

            'paid' => $paid ? 'Pago' : 'Não Pago',

            'PaymentDate' => $paid ? Carbon::parse($this->payment_date)->format('d/m/Y H:i') : null,
            'paymentSiunce' => $paid ? Carbon::parse($this->payment_date)->diffForHumans() : null,
        ];
    }
}
